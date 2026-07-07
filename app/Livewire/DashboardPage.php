<?php

namespace App\Livewire;

use App\Models\MonthlyRevenueTarget;
use App\Models\Transaction;
use App\Models\TransactionEvent;
use App\Models\TransactionItem;
use App\Support\Finance\NetSales;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class DashboardPage extends Component
{
    public int $todayGrossAmount = 0;

    public string $title = 'E-commerce Dashboard';

    public int $transactionsCount = 0;

    public float $transactionsDeltaPercent = 0.0;

    public bool $transactionsDeltaUp = true;

    public float $monthlyTargetProgressPercent = 0.0;

    public float $monthlyTargetDeltaPercent = 0.0;

    public bool $monthlyTargetDeltaUp = true;

    public int $monthlyTargetAmount = 0;

    public int $monthlyRevenueAmount = 0;

    public int $todayRevenueAmount = 0;

    public int $totalDeletedAmount = 0;

    public int $totalVoidItemAmount = 0;

    public int $totalVoidAmount = 0;

    public array $statisticsSeries = [];

    public array $statisticsCategories = [];

    public ?string $statisticsFrom = null;

    public ?string $statisticsTo = null;

    public array $bestSellingProducts = [];

    public array $latestTransactions = [];

    public array $voidItems = [];

    public string $orderTimeRange = '';

    public string $timeFilter = 'today';

    public function mount(): void
    {
        $this->authorize('dashboard.access');

        // Set default filter awal grafik ke 7 hari terakhir
        $now = now();
        $this->statisticsFrom = $now->subDays(6)->toDateString();
        $this->statisticsTo = $now->toDateString();

        // Ambil data dashboard pertama kali (default data hari ini)
        $this->loadDashboardData();
    }

    public function updatedTimeFilter(): void
    {
        if ($this->timeFilter === 'custom') {
            $this->orderTimeRange = ''; // Reset custom range string
            $this->dispatch('init-flatpickr'); // Trigger skrip JS Flatpickr di blade
        } else {
            $this->loadDashboardData();
        }
    }

    public function updatedOrderTimeRange(): void
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData(): void
    {
        $currentCabangId = auth()->user()->cabang_id;
        $now = now();

        // Evaluasi dan config logic filter waktu (Shortcut & Custom)
        if ($this->timeFilter === 'custom' && !empty($this->orderTimeRange)) {
            $dates = explode(' to ', $this->orderTimeRange);
            if (count($dates) === 2) {
                $start = Carbon::parse($dates[0])->startOfDay();
                $end = Carbon::parse($dates[1])->endOfDay();
            } else {
                $start = Carbon::parse($dates[0])->startOfDay();
                $end = Carbon::parse($dates[0])->endOfDay();
            }
        } else {
            // Skenario Pilihan Cepat (Shortcut Macrogroups) permintaan client
            switch ($this->timeFilter) {
                case '7_days':
                    $start = $now->copy()->subDays(6)->startOfDay();
                    $end = $now->copy()->endOfDay();
                    break;
                case '30_days':
                    $start = $now->copy()->subDays(29)->startOfDay();
                    $end = $now->copy()->endOfDay();
                    break;
                case 'this_month':
                    $start = $now->copy()->startOfMonth();
                    $end = $now->copy()->endOfMonth();
                    break;
                case '3_months':
                    $start = $now->copy()->subMonths(3)->startOfDay();
                    $end = $now->copy()->endOfDay();
                    break;
                case '6_months':
                    $start = $now->copy()->subMonths(6)->startOfDay();
                    $end = $now->copy()->endOfDay();
                    break;
                case '1_year':
                    $start = $now->copy()->subYear()->startOfDay();
                    $end = $now->copy()->endOfDay();
                    break;
                case 'today':
                default:
                    $start = $now->copy()->startOfDay();
                    $end = $now->copy()->endOfDay();
                    break;
            }
        }

        // Sinkronisasi data visual jangkauan grafik mengikuti filter yang berjalan aktif
        $this->statisticsFrom = $start->toDateString();
        $this->statisticsTo = $end->toDateString();

        // 2. QUERY METRIKS DATABASE (Tetap mengalir aman menggunakan variabel $start dan $end yang baru)
        $this->todayRevenueAmount = $this->getRevenueBetween($start, $end);

        $this->todayGrossAmount = (int) Transaction::query()
            ->where('cabang_id', $currentCabangId)
            ->whereBetween('created_at', [$start, $end])
            ->whereIn('payment_status', ['paid', 'settlement', 'success', 'partial_refund'])
            ->whereNull('voided_at')
            ->sum('total');

        $this->transactionsCount = Transaction::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();

        // Perhitungan delta pembanding (periode sebelumnya yang sama panjangnya)
        $daysDiff = $start->diffInDays($end) + 1;
        $previousStart = $start->copy()->subDays($daysDiff);
        $previousEnd = $end->copy()->subDays($daysDiff);

        $previousCount = Transaction::query()
            ->whereBetween('created_at', [$previousStart, $previousEnd])
            ->count();

        $deltaTransactions = $this->transactionsCount - $previousCount;
        $this->transactionsDeltaPercent = $this->calculateDeltaPercent($this->transactionsCount, $previousCount);
        $this->transactionsDeltaUp = $deltaTransactions >= 0;

        // Memuat komponen chart, widget, dan summary log fraud lainnya
        $this->loadMonthlyTargetWidget();
        $this->loadStatisticsForRange();
        $this->bestSellingProducts = $this->getBestSellingProductsForRange($start, $end);
        $this->latestTransactions = $this->getLatestTransactionsForRange($start, $end);

        $itemLogs = Activity::where('log_name', 'deleted_item')
            ->where('properties->cabang_id', $currentCabangId)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $this->totalDeletedAmount = $itemLogs->where('properties.type', 'reduced')->sum(function ($log) {
            return ($log->getExtraProperty('old_qty') - $log->getExtraProperty('new_qty')) * $log->getExtraProperty('price');
        });

        $this->totalVoidItemAmount = $itemLogs->where('properties.type', 'removed')->sum(function ($log) {
            return $log->getExtraProperty('old_qty') * $log->getExtraProperty('price');
        });

        $this->totalVoidAmount = (int) Transaction::whereNotNull('voided_at')
            ->where('cabang_id', $currentCabangId)
            ->whereBetween('created_at', [$start, $end])
            ->sum('subtotal');
    }

    public function render(): View
    {
        return view('livewire.dashboard-page')
            ->layout('layouts.app', ['title' => $this->title]);
    }

    public function setStatisticsRange(string $from, string $to): void
    {
        $this->statisticsFrom = $from;
        $this->statisticsTo = $to;
        $this->loadStatisticsForRange();
    }

    protected function getRevenueBetween(Carbon $from, Carbon $to): int
    {
        return (int) round(NetSales::netSalesBetween($from, $to));
    }

    protected function calculatePercent(int $value, int $target): float
    {
        if ($target <= 0) {
            return 0.0;
        }
        return min(100.0, round(($value / $target) * 100, 2));
    }

    protected function calculateDeltaPercent(int $current, int $previous): float
    {
        if ($previous <= 0) {
            return $current > 0 ? 100.0 : 0.0;
        }
        return round((($current - $previous) / $previous) * 100, 2);
    }

    protected function formatCurrency(int|float|string $amount): string
    {
        if (is_string($amount) && is_numeric($amount)) {
            $amount = str_contains($amount, '.') ? (float) $amount : (int) $amount;
        }
        $decimals = is_float($amount) ? 2 : 0;
        return 'Rp' . number_format((float) $amount, $decimals, ',', '.');
    }

    protected function getBestSellingProductsForRange(Carbon $from, Carbon $to): array
    {
        $rows = TransactionItem::query()
            ->selectRaw('product_id, SUM(quantity) as sold')
            ->whereHas('transaction', function ($query) use ($from, $to) {
                $query->whereIn('payment_status', ['paid', 'settlement', 'capture', 'success', 'partial_refund'])
                    ->whereBetween('created_at', [$from, $to]);
            })
            ->groupBy('product_id')
            ->orderByDesc('sold')
            ->with(['product'])
            ->limit(5)
            ->get();

        return $rows->map(function (TransactionItem $item): array {
            $product = $item->product;
            return [
                'name' => $product?->name ?? '-',
                'image' => $product?->image ?? '/images/product/product-01.jpg',
                'sold' => (int) ($item->getAttribute('sold') ?? 0),
            ];
        })->all();
    }

    protected function getLatestTransactionsForRange(Carbon $from, Carbon $to): array
    {
        $items = Transaction::query()
            ->whereBetween('created_at', [$from, $to])
            ->with(['member'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return $items->map(function (Transaction $transaction): array {
            $customerName = $transaction->member?->name ?: ($transaction->name ?: '-');
            $customerPhone = $transaction->phone ?: '-';

            return [
                'code' => (string) $transaction->code,
                'customer' => $customerName,
                'phone' => $customerPhone,
                'order_type' => (string) $transaction->order_type,
                'total' => $this->formatCurrency($transaction->total),
                'payment_status' => (string) $transaction->payment_status,
                'created_at' => optional($transaction->created_at)->format('d M Y H:i') ?? '-',
            ];
        })->all();
    }

    protected function loadMonthlyTargetWidget(): void
    {
        $now = now();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $monthStart->copy()->endOfMonth();

        $this->monthlyRevenueAmount = $this->getRevenueBetween($monthStart, $monthEnd);

        $lastMonthStart = $monthStart->copy()->subMonthNoOverflow()->startOfMonth();
        $lastMonthEnd = $lastMonthStart->copy()->endOfMonth();
        $lastMonthRevenue = $this->getRevenueBetween($lastMonthStart, $lastMonthEnd);

        $target = MonthlyRevenueTarget::query()
            ->where('year', $now->year)
            ->where('month', $now->month)
            ->value('amount');

        $this->monthlyTargetAmount = (int) ($target ?? 0);

        $this->monthlyTargetProgressPercent = $this->calculatePercent($this->monthlyRevenueAmount, $this->monthlyTargetAmount);
        $this->monthlyTargetDeltaPercent = $this->calculateDeltaPercent($this->monthlyRevenueAmount, $lastMonthRevenue);
        $this->monthlyTargetDeltaUp = $this->monthlyRevenueAmount >= $lastMonthRevenue;
        $this->dispatch('monthly-target-updated', progressPercent: $this->monthlyTargetProgressPercent);
    }

    protected function loadStatisticsForRange(): void
    {
        if (empty($this->statisticsFrom) || empty($this->statisticsTo)) {
            return;
        }

        $from = Carbon::parse($this->statisticsFrom)->startOfDay();
        $to = Carbon::parse($this->statisticsTo)->endOfDay();

        if ($from->greaterThan($to)) {
            [$from, $to] = [$to, $from];
        }

        $days = $from->diffInDays($to) + 1;

        if ($days <= 90) {
            $rows = NetSales::netSalesByDay($from, $to);
            $categories = [];
            $revenue = [];

            $cursor = $from->copy()->startOfDay();
            while ($cursor->lte($to)) {
                $key = $cursor->toDateString();
                $categories[] = $cursor->format('d M');
                $revenue[] = (int) round((float) ($rows[$key] ?? 0));
                $cursor->addDay();
            }

            $this->statisticsCategories = $categories;
            $this->statisticsSeries = [
                ['name' => 'Revenue', 'data' => $revenue],
            ];
            $this->dispatch('statistics-updated', series: $this->statisticsSeries, categories: $this->statisticsCategories);
            return;
        }

        $rows = NetSales::netSalesByMonth($from, $to);
        $categories = [];
        $revenue = [];

        $cursor = $from->copy()->startOfMonth();
        $end = $to->copy()->startOfMonth();
        while ($cursor->lte($end)) {
            $key = $cursor->format('Y-m-01');
            $categories[] = $cursor->format('M Y');
            $revenue[] = (int) round((float) ($rows[$key] ?? 0));
            $cursor->addMonthNoOverflow();
        }

        $this->statisticsCategories = $categories;
        $this->statisticsSeries = [
            ['name' => 'Revenue', 'data' => $revenue],
        ];
        $this->dispatch('statistics-updated', series: $this->statisticsSeries, categories: $this->statisticsCategories);
    }
}
