<?php

namespace App\Livewire\Transaction;

use App\Helpers\DataLabelHelper;
use App\Models\Transaction;
use App\Models\TransactionEvent;
use App\Models\TransactionItem;
use App\Services\Printing\PosPrintPayloadService;
use App\Support\Finance\NetSales;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class TransactionsPage extends Component
{
    use WithPagination;

    public string $title = 'Riwayat Transaksi';

    public string $searchNumber = '';

    public string $searchCustomer = '';

    public string $searchTable = '';

    public ?string $fromDate = null;

    public ?string $toDate = null;

    public string $rangePreset = 'today';

    public string $paymentStatus = '';

    public string $paymentMethod = '';

    public string $orderType = '';

    public string $sortField = 'created_at';

    public bool $sortAsc = false;

    public int $perPage = 15;

    public int $grossAmount = 0;

    public function mount(): void
    {
        $this->authorize('transactions.view');
        $this->setRange('today');
    }

    public function updatedSearchNumber(): void
    {
        $this->resetPage();
    }

    public function updatedSearchCustomer(): void
    {
        $this->resetPage();
    }

    public function updatedSearchTable(): void
    {
        $this->resetPage();
    }

    public function updatedFromDate(): void
    {
        $this->resetPage();
    }

    public function updatedToDate(): void
    {
        $this->resetPage();
    }

    public function updatedPaymentStatus(): void
    {
        $this->resetPage();
    }

    public function updatedPaymentMethod(): void
    {
        $this->resetPage();
    }

    public function updatedOrderType(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortField = $field;
            $this->sortAsc = true;
        }

        $this->resetPage();
    }

    public function setTransactionsRange(?string $from, ?string $to): void
    {
        if (! $from || ! $to) {
            return;
        }

        if ($from > $to) {
            [$from, $to] = [$to, $from];
        }

        $this->fromDate = $from;
        $this->toDate = $to;
        $this->rangePreset = 'custom';
        $this->resetPage();
    }

    public function setRange(string $preset): void
    {
        $today = CarbonImmutable::now();

        if ($preset === 'today') {
            $from = $today;
            $to = $today;
        } elseif ($preset === '7d') {
            $from = $today->subDays(6);
            $to = $today;
        } elseif ($preset === '30d') {
            $from = $today->subDays(29);
            $to = $today;
        } elseif ($preset === 'custom') {
            return;
        } else {
            return;
        }

        $this->fromDate = $from->format('Y-m-d');
        $this->toDate = $to->format('Y-m-d');

        $this->rangePreset = $preset;
        $this->resetPage();
    }

    protected function baseQuery(): Builder
    {
        $canViewPii = auth()->user()?->can('transactions.pii.view') ?? false;

        $query = Transaction::query()
            ->with(['member', 'diningTable', 'cashier'])

            // Search Code
            ->when($this->searchNumber !== '', function (Builder $query) {
                $query->where('code', 'like', '%'.$this->searchNumber.'%');
            })

            // Seacrh Nama Pelanggan
            ->when($this->searchCustomer !== '', function (Builder $query) use ($canViewPii) {
                $term = '%'.$this->searchCustomer.'%';
                $query->where(function (Builder $q) use ($term, $canViewPii) {
                    $q->where('name', 'like', $term);

                    if ($canViewPii) {
                        $q->orWhere('phone', 'like', $term)
                            ->orWhere('email', 'like', $term);
                    }
                });
            })

            // Search No Meja
            ->when($this->searchTable !== '', function (Builder $query) {
                $query->whereHas('dining_table_id', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->searchTable.'%');
                });
            })

            ->when($this->paymentStatus !== '', fn (Builder $query) => $query->where('payment_status', $this->paymentStatus))
            ->when($this->paymentMethod !== '', fn (Builder $query) => $query->where('payment_method', $this->paymentMethod))
            ->when($this->orderType !== '', fn (Builder $query) => $query->where('order_type', $this->orderType));

        if ($this->fromDate) {
            $query->whereDate('created_at', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('created_at', '<=', $this->toDate);
        }

        return $query;
    }

    protected function paymentStatusOptions(): array
    {
        return Transaction::query()
            ->select('payment_status')
            ->distinct()
            ->orderBy('payment_status')
            ->pluck('payment_status')
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => $value !== '')
            ->values()
            ->all();
    }

    protected function paymentMethodOptions(): array
    {
        return Transaction::query()
            ->select('payment_method')
            ->distinct()
            ->orderBy('payment_method')
            ->pluck('payment_method')
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => $value !== '')
            ->values()
            ->all();
    }

    protected function orderTypeOptions(): array
    {
        return ['take_away', 'dine_in'];
    }

    protected function stats(): array
    {
        $base = $this->baseQuery();

        $totalTransactions = (int) (clone $base)->count();

        $revenueQuery = (clone $base);
        if ($this->paymentStatus === '') {
            $revenueQuery->whereIn('payment_status', NetSales::postedPaymentStatuses());
        }

        $revenueCount = (int) (clone $revenueQuery)->count();
        $transactionIds = (clone $revenueQuery)->select('id');

        $grossAmount = (int) (clone $base)
            ->whereIn('payment_status', ['paid', 'pending', 'voided'])
            ->whereNull('voided_at')
            ->sum('total');

        $paidBase = (clone $base)->whereIn('payment_status', NetSales::postedPaymentStatuses());
        $paidCount = (int) (clone $paidBase)->count();
        $sub = DB::table('transactions as t')
            ->join('transaction_items as ti', 't.id', '=', 'ti.transaction_id')
            ->whereIn('t.id', $transactionIds)
            ->selectRaw('t.id as tx_id')
            ->selectRaw('COALESCE(t.refunded_amount, 0) as refunded_amount')
            ->selectRaw('COALESCE(SUM('.NetSales::itemNetExpr('ti').'), 0) as item_net')
            ->groupBy('tx_id', 'refunded_amount');

        $totalRevenue = (int) round((float) (DB::query()
            ->fromSub($sub, 'x')
            ->selectRaw('COALESCE(SUM('.NetSales::netPerTransactionExpr('x.item_net', 'x.refunded_amount').'), 0) as revenue')
            ->value('revenue') ?? 0));

        // 4. Rata-rata Omzet
        // Jika sedang filter 'Void', maka pembaginya adalah jumlah transaksi void
        $avgRevenue = $revenueCount > 0 ? (int) round($totalRevenue / $revenueCount) : 0;

        $itemsBase = (clone $base)->whereIn('payment_status', ['paid', 'settlement', 'capture', 'success', 'partial_refund']);
        $totalItemsSold = (int) TransactionItem::query()
            ->whereIn('transaction_id', $transactionIds)
            ->sum('quantity');

        return [
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'avgRevenue' => $avgRevenue,
            'totalItemsSold' => $totalItemsSold,
            'grossAmount' => $grossAmount,
        ];
    }

    private function buildPrintPayload(int $transactionId): ?array
    {
        return app(PosPrintPayloadService::class)->build($transactionId);
    }

    public function printTransaction(int $transactionId): void
    {
        $actor = auth()->user();
        if (! $actor || ! $actor->can('transactions.print')) {
            $this->dispatch('toast', type: 'error', message: 'Anda tidak punya akses untuk mencetak struk.');

            return;
        }

        $payload = $this->buildPrintPayload($transactionId);
        if (! $payload) {
            $this->dispatch('toast', type: 'error', message: 'Transaksi tidak ditemukan.');

            return;
        }

        $this->dispatch('pos-print-modal', payload: $payload, context: 'transactions');
    }

    protected function getVoidItemsHistory(): array
    {
        // Mengambil event 'void_item' terbaru
        $events = TransactionEvent::query()
            ->where('action', 'void_item')
            ->with(['transaction', 'actor'])
            ->latest()
            ->limit(10)
            ->get();

        return $events->map(function ($event) {
            $meta = (array) $event->meta;

            return [
                'product_name' => $meta['item_name'] ?? '-',
                'variant' => $meta['variant'] ?? '-',
                'reason' => $meta['reason'] ?? '-',
                'actor' => $event->actor?->name ?? 'System',
                'code' => $event->transaction?->code ?? '-',
                'created_at' => optional($event->created_at)->format('d M, H:i') ?? '-',
            ];
        })->all();
    }

    public function exportData()
    {
        // Logika Penamaan File
        $from = $this->fromDate;
        $to = $this->toDate;

        $filename = 'SR_'.$from;
        if ($from !== $to) {
            $filename .= '_'.$to;
        }
        $filename .= '.csv';

        // Ambil query dasar dengan semua filter yang sedang aktif
        $query = $this->baseQuery()
            ->with(['member', 'diningTable', 'cashier'])
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');

        //  VALIDASI (Cek apakah ada datanya)
        if ($query->count() === 0) {
            // Tampilkan warning/error toast dan hentikan proses export
            $this->dispatch('toast', type: 'error', message: 'Tidak ada transaksi yang dapat di-export.');

            return;
        }

        // Kembalikan Response berupa Stream Download CSV
        return response()->streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'w');

            // Header Kolom CSV
            fputcsv($handle, [
                'Transaction Number',
                'Date',
                'Customer',
                'Table',
                'Visit Purpose',
                'Grand Total',
                'Status',
                'Payment Method',
                'Payment Time',
                'Payment By',
            ]);

            // Ambil data per chunk (500 data)
            $query->chunk(500, function ($transactions) use ($handle) {
                foreach ($transactions as $trx) {

                    $customer = (string) ($trx->member?->name ?? ($trx->name ?? '-'));
                    $table = $trx->dining_table_id ? $trx->dining_table_id : 'Quick Service';
                    $purpose = $trx->order_type === 'dine_in' ? 'Dine in' : 'Take away';

                    $paymentStatusLabel = DataLabelHelper::enum((string) ($trx->payment_status ?? ''), 'payment_status');
                    $paymentMethodLabel = DataLabelHelper::enum((string) ($trx->payment_method ?? ''), 'payment_method');

                    $paymentTime = $trx->paid_at ? $trx->paid_at->format('H:i:s') : '-';
                    $paymentBy = $trx->cashier?->name ?? '-';

                    fputcsv($handle, [
                        $trx->code,
                        optional($trx->created_at)->format('d-m-Y'),
                        $customer,
                        $table,
                        $purpose,
                        (int) $trx->total,
                        $paymentStatusLabel,
                        $paymentMethodLabel,
                        $paymentTime,
                        $paymentBy,
                    ]);
                }
            });

            fclose($handle);

        }, $filename);
    }

    public function render(): View
    {
        $this->authorize('transactions.view');

        // Filter log berdasarkan cabang user yang sedang login
        $deletedItemLogs = Activity::where('log_name', 'deleted_item')
            // Laravel bisa melakukan query langsung ke dalam kolom JSON properties
            ->where('properties->cabang_id', auth()->user()->cabang_id)
            ->latest()
            ->with('causer')
            ->limit(50)
            ->get();

        $paymentStatusOptions = $this->paymentStatusOptions();
        $paymentMethodOptions = $this->paymentMethodOptions();

        $transactions = $this->baseQuery()
            ->withCount('transactionItems')
            ->withSum('transactionItems as items_quantity_sum', 'quantity')
            ->withSum('transactionItems as hpp_total_sum', 'hpp_total')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        $stats = $this->stats();

        return view('livewire.transactions.transactions-page', [
            'transactions' => $transactions,
            'paymentStatusOptions' => $paymentStatusOptions,
            'paymentMethodOptions' => $paymentMethodOptions,
            'orderTypeOptions' => $this->orderTypeOptions(),
            'stats' => $stats,
            'grossAmount' => $stats['grossAmount'],
            'voidItems' => $this->getVoidItemsHistory(),
            'deletedItemLogs' => $deletedItemLogs,
        ])->layout('layouts.app', ['title' => $this->title]);
    }
}
