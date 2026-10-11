<?php

namespace App\Livewire\Reports;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class VoidReportPage extends Component
{
    use WithPagination;

    public string $search        = '';
    public string $startDate     = '';
    public string $endDate       = '';
    public string $orderTypeFilter = '';
    public int    $perPage       = 10;

    public ?Transaction $selectedTransaction = null;
    public bool $showDetailModal = false;

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate   = now()->endOfMonth()->format('Y-m-d');
    }

    // Reset ke halaman 1 setiap kali filter berubah
    public function updated(string $property): void
    {
        if (in_array($property, ['search', 'orderTypeFilter', 'startDate', 'endDate', 'perPage'])) {
            $this->resetPage();
        }
    }

    // ─── Query Dasar ────────────────────────────────────────────────────────────

    protected function baseQuery()
    {
        $cabangId = Auth::user()?->cabang_id;

        return Transaction::query()
            ->whereNotNull('voided_at')
            ->when($cabangId, fn($q) => $q->where('cabang_id', $cabangId))
            ->when($this->search, function ($query) {
                $term = '%' . trim($this->search) . '%';

                $query->where(function ($q) use ($term) {
                    // 1. No Nota / Kode Transaksi
                    $q->where('code', 'like', $term)
                        // 2. Jenis Order
                        ->orWhere('order_type', 'like', $term)
                        // 3. Nama Meja (di simpan dalam string JSON additional_info)
                        ->orWhere('additional_info', 'like', $term)
                        // 4. Nama Kasir (Relasi user)
                        ->orWhereHas('user', function ($u) use ($term) {
                            $u->where('name', 'like', $term);
                        })
                        // 5. Otorisasi Void (Relasi voidedBy)
                        ->orWhereHas('voidedBy', function ($v) use ($term) {
                            $v->where('name', 'like', $term);
                        })
                        // 6. Nama Produk
                        ->orWhereHas('items.product', function ($p) use ($term) {
                            $p->where('name', 'like', $term);
                        });
                });
            })
            ->when(
                $this->orderTypeFilter,
                fn($q) => $q->where('order_type', $this->orderTypeFilter)
            )
            ->whereDate('voided_at', '>=', $this->startDate)
            ->whereDate('voided_at', '<=', $this->endDate);
    }

    // ─── Computed Properties ─────────────────────────────────────────────────

    #[Computed]
    public function summary(): array
    {
        $row = $this->baseQuery()
            ->selectRaw('COALESCE(SUM(subtotal), 0) as total_void, COUNT(*) as total_transaksi')
            ->first();

        return [
            'total_void'      => (float) ($row->total_void ?? 0),
            'total_transaksi' => (int)   ($row->total_transaksi ?? 0),
        ];
    }

    #[Computed]
    public function transactions()
    {
        return $this->baseQuery()
            ->with([
                'items.product:id,name',
                'voidedBy:id,name',
                'user:id,name',
            ])
            ->latest('voided_at')
            ->paginate($this->perPage);
    }

    #[Computed]
    public function orderTypes(): array
    {
        return Transaction::query()
            ->whereNotNull('voided_at')
            ->when(Auth::user()?->cabang_id, fn($q, $id) => $q->where('cabang_id', $id))
            ->distinct()
            ->pluck('order_type')
            ->filter()
            ->sort()
            ->values()
            ->toArray();
    }

    // ─── Helper Methods ──────────────────────────────────────────────────────

    /**
     * Format daftar produk: "Salmon Skin" atau "Salmon Skin, +8"
     * ⚠️  Sesuaikan ->items jika nama relationship berbeda
     */
    public function formatProducts(Transaction $transaction): string
    {
        $items = $transaction->items; // ⚠️  Ganti jika nama relationship berbeda

        if (!$items || $items->isEmpty()) {
            return '-';
        }

        $firstName = $items->first()->product?->name ?? '(produk dihapus)';
        $remaining = $items->count() - 1;

        if ($remaining <= 0) {
            return e($firstName);
        }

        return e($firstName) . ', <span class="font-semibold text-teal-600 dark:text-teal-400">+' . $remaining . '</span>';
    }

    /**
     * Ambil nama meja dari additional_info (JSON)
     * Kembalikan null jika tidak ada
     */
    public function getMejaName(Transaction $transaction): ?string
    {
        $info = $transaction->additional_info;

        if (!$info) {
            return null;
        }

        $decoded = is_string($info)
            ? json_decode($info, true)
            : (array) $info;

        return $decoded['table_name'] ?? $decoded['table'] ?? $decoded['name'] ?? null;
    }

    public function showDetail(int $transactionId): void
    {
        $this->selectedTransaction = Transaction::with([
            'items.product',
            'user',
            'voidedBy'
        ])->find($transactionId);

        $this->showDetailModal = true;
    }

    public function closeDetail(): void
    {
        $this->showDetailModal = false;
        $this->selectedTransaction = null;
    }

    public function render()
    {
        return view('livewire.reports.void-report-page')
            ->layout('layouts.app', ['title' => 'Laporan Void']);
    }
}
