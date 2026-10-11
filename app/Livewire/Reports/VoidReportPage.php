<?php

namespace App\Livewire\Reports;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    // Query Helper untuk mengambil data ter-filter sesuai filter tanggal, search, dan order_type
    protected function getExportQuery()
    {
        return Transaction::with(['items.product', 'user', 'voidedBy'])
            ->where('cabang_id', auth()->user()->cabang_id)
            ->whereNotNull('voided_at')
            ->when($this->startDate && $this->endDate, function ($q) {
                $q->whereBetween('voided_at', [
                    $this->startDate . ' 00:00:00',
                    $this->endDate . ' 23:59:59'
                ]);
            })
            ->when($this->orderTypeFilter, function ($q) {
                $q->where('order_type', $this->orderTypeFilter);
            })
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('code', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', fn($u) => $u->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhere('void_reason', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('voided_at', 'desc');
    }

    // 1. EKSPOR PDF
    public function exportPdf()
    {
        $transactions = $this->getExportQuery()->get();

        $summary = [
            'total_void' => $transactions->sum('subtotal'),
            'total_transaksi' => $transactions->count(),
        ];

        $pdf = Pdf::loadView('pdf.void-report-pdf', [
            'transactions' => $transactions,
            'summary' => $summary,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ])->setPaper('a4', 'landscape');

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Laporan_Void_' . $this->startDate . '_s-d_' . $this->endDate . '.pdf'
        );
    }

    // 2. EKSPOR EXCEL (Native Streamed CSV/Excel)
    public function exportExcel(): StreamedResponse
    {
        $fileName = 'Laporan_Void_' . $this->startDate . '_s-d_' . $this->endDate . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM untuk Excel
            fputs($handle, "\xEF\xBB\xBF");

            // Header Kolom
            fputcsv($handle, [
                'No Nota',
                'Tanggal Void',
                'Tanggal Order',
                'Kasir',
                'Otorisasi',
                'Produk Void',
                'Subtotal Void (Rp)',
                'Jenis Order',
                'Alasan Void'
            ]);

            // Rows
            $this->getExportQuery()->chunk(200, function ($transactions) use ($handle) {
                foreach ($transactions as $t) {
                    $products = $t->items->map(function ($item) {
                        return ($item->product?->name ?? 'Produk') . ' (x' . ($item->quantity ?? 1) . ')';
                    })->implode(', ');

                    fputcsv($handle, [
                        $t->code,
                        $t->voided_at ? \Carbon\Carbon::parse($t->voided_at)->format('d/m/Y H:i') : '-',
                        \Carbon\Carbon::parse($t->created_at)->format('d/m/Y H:i'),
                        $t->user?->name ?? '-',
                        $t->voidedBy?->name ?? '-',
                        $products ?: '-',
                        $t->subtotal ?? 0,
                        $t->order_type === 'dine_in' ? 'Dine In' : ($t->order_type === 'take_away' ? 'Take Away' : ($t->order_type ?? '-')),
                        $t->void_reason ?? '-'
                    ]);
                }
            });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function render()
    {
        return view('livewire.reports.void-report-page')
            ->layout('layouts.app', ['title' => 'Laporan Void']);
    }
}
