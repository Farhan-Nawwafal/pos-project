<?php

namespace App\Livewire\DayStartEnd;

use Livewire\Component;
use App\Models\Shift;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DayStartEndPage extends Component
{
    /**
     * Shift & User
     */
    public ?Shift $currentShift = null;
    public $currentUser;

    /**
     * Sales Recapitulation
     */
    public int $salesTotal = 0;
    public int $manualDiscount = 0;
    public int $pointDiscount = 0;
    public int $tax = 0;
    public int $paymentFee = 0;
    public int $rounding = 0;
    public int $refundedAmount = 0;
    public int $discount = 0;
    public int $menuDiscount = 0;
    public int $voucherDiscount = 0;
    public int $autoDiscount = 0;
    public int $deliveryCost = 0;
    public int $orderFee = 0;
    public int $platformFee = 0;
    public int $serviceCharge = 0;
    public int $pb1 = 0;
    public int $linkedTotal = 0;
    public int $netSales = 0;
    public int $voidSales = 0;
    public int $pendingSales = 0;
    public int $numberOfBills = 0;
    public int $totalPayment = 0;

    /**
     * Report Data
     */
    public $paymentRecaps;
    public $salesByMenus;
    public $customMenus;
    public $tableSections;

    // public function mount()
    // {
    //     $this->currentUser = Auth::user();

    //     if (!$this->currentUser) {
    //         abort(403);
    //     }

    //     $this->paymentRecaps = collect();
    //     $this->salesByMenus = collect();
    //     $this->customMenus = collect();
    //     $this->tableSections = collect();

    //     $this->currentShift = Shift::with([
    //         'cabang',
    //         'startedBy',
    //         'endedBy'
    //     ])
    //         ->where('cabang_id', $this->currentUser->cabang_id)
    //         ->where('status', 'open')
    //         ->latest('started_at')
    //         ->first();

    //     dd($this->currentShift);

    //     if ($this->currentShift) {
    //         $this->calculateRecapitulation();
    //     }
    // }


    public function mount()
    {
        $this->currentUser = Auth::user();

        $this->paymentRecaps = collect();
        $this->salesByMenus = collect();
        $this->customMenus = collect();
        $this->tableSections = collect();

        $this->currentShift = Shift::with([
            'cabang',
            'startedBy',
            'endedBy'
        ])
            ->where('cabang_id', $this->currentUser->cabang_id)
            // Ganti where('status', 'open') dengan mengambil shift terbaru hari ini
            ->whereDate('started_at', Carbon::today())
            ->latest('id')
            ->first();

        // sementara tanpa cek shift
        $this->calculateRecapitulation();
    }
    public function endShift()
    {
        if (!$this->currentShift || $this->currentShift->status !== 'open') {
            return;
        }

        $this->currentShift->update([
            'ended_at' => now(),
            'ended_by_user_id' => Auth::id(),
            'status' => 'closed',
        ]);

        $this->currentShift->refresh();

        $this->currentShift->load([
            'cabang',
            'startedBy',
            'endedBy',
        ]);

        $this->calculateRecapitulation();

        session()->flash('success', 'Shift berhasil diakhiri.');
    }

    // SALES RECAPITULATION
    public function calculateRecapitulation()
    {
        // 1. Tambahkan filter whereDate hari ini di Base Query
        $baseQuery = Transaction::query()
            ->where('cabang_id', $this->currentUser->cabang_id)
            ->whereDate('created_at', Carbon::today()) // <-- Filter Hari Ini
            ->where('payment_status', 'paid')
            ->whereNull('voided_at');

        // Ambil transaksi sekali saja
        $transactions = $baseQuery->get();

        // Simpan jika nanti diperlukan
        $this->transactions = $transactions;

        // Jika belum ada transaksi hari ini
        if ($transactions->isEmpty()) {
            $this->salesTotal = 0;
            $this->discount = 0;
            $this->menuDiscount = 0;
            $this->voucherDiscount = 0;
            $this->autoDiscount = 0;
            $this->deliveryCost = 0;
            $this->orderFee = 0;
            $this->platformFee = 0;
            $this->serviceCharge = 0;
            $this->pb1 = 0;
            $this->linkedTotal = 0;
            $this->netSales = 0;
            $this->voidSales = 0;
            $this->pendingSales = 0;
            $this->numberOfBills = 0;

            return;
        }

        // ===============================
        // Sales Recapitulation
        // ===============================

        $this->salesTotal = $transactions->sum('subtotal');
        $this->discount = $transactions->sum('discount_total_amount');
        $this->manualDiscount = $transactions->sum('manual_discount_amount');
        $this->voucherDiscount = $transactions->sum('voucher_discount_amount');
        $this->pointDiscount = $transactions->sum('point_discount_amount');
        $this->serviceCharge = $transactions->sum('service_amount');
        $this->tax = $transactions->sum('tax_amount');
        $this->paymentFee = $transactions->sum('payment_fee_amount');
        $this->rounding = $transactions->sum('rounding_amount');
        $this->refundedAmount = $transactions->sum('refunded_amount');
        $this->netSales = $transactions->sum('total');
        $this->numberOfBills = $transactions->count();

        /*
         * Kolom ini BELUM ADA di database
         */
        $this->menuDiscount = 0;
        $this->autoDiscount = 0;
        $this->deliveryCost = 0;
        $this->platformFee = 0;
        $this->linkedTotal = 0;

        /*
         * Void & Pending (Tambahkan filter hari ini juga)
         */
        $this->voidSales = Transaction::where('cabang_id', $this->currentUser->cabang_id)
            ->whereDate('created_at', Carbon::today()) // <-- Filter Hari Ini
            ->whereNotNull('voided_at')
            ->sum('total');

        $this->pendingSales = Transaction::where('cabang_id', $this->currentUser->cabang_id)
            ->whereDate('created_at', Carbon::today()) // <-- Filter Hari Ini
            ->where('payment_status', 'pending')
            ->sum('total');

        // ===============================
        // Payment Recapitulation
        // ===============================

        $this->paymentRecaps = Transaction::query()
            ->where('cabang_id', $this->currentUser->cabang_id)
            ->whereDate('created_at', Carbon::today()) // <-- Filter Hari Ini
            ->where('payment_status', 'paid')
            ->whereNull('voided_at')
            ->select(
                'payment_method',
                DB::raw('COUNT(id) as total_transaction'),
                DB::raw('SUM(total) as total_amount')
            )
            ->groupBy('payment_method')
            ->orderBy('payment_method')
            ->get();

        $this->totalPayment = $this->paymentRecaps->sum('total_amount');

        // ===============================
        // Sales By Menu
        // ===============================
        // Tidak perlu ditambah whereDate karena id transaksinya ($transactionIds) 
        // sudah difilter dari $baseQuery yang hanya mengambil hari ini.

        $transactionIds = $transactions->pluck('id');

        $this->salesByMenus = TransactionItem::withoutGlobalScopes()
            ->whereNull('parent_transaction_item_id')
            ->whereIn('transaction_id', $transactionIds)
            ->select(
                'product_id',
                DB::raw('SUM(quantity) as total_qty'),
                DB::raw('SUM(subtotal) as subtotal'),
                DB::raw('SUM(manual_discount_amount) as manual_discount'),
                DB::raw('SUM(voucher_discount_amount) as voucher_discount'),
                DB::raw('SUM(manual_discount_amount + voucher_discount_amount) as menu_discount')
            )
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_qty')
            ->get();

        // ===============================
        // Custom Menu
        // ===============================

        $this->customMenus = collect();

        // ===============================
        // Sales By Table Section
        // ===============================

        $this->tableSections = Transaction::query()
            ->where('cabang_id', $this->currentUser->cabang_id)
            ->whereDate('created_at', Carbon::today()) // <-- Filter Hari Ini
            ->where('payment_status', 'paid')
            ->whereNull('voided_at')
            ->whereNotNull('dining_table_id')
            ->with('diningTable')
            ->get()
            ->groupBy('dining_table_id')
            ->map(function ($transactions) {

                $table = $transactions->first()->diningTable;

                return (object) [
                    'table_number' => $table?->table_number ?? '-',
                    'bill' => $transactions->count(),
                    'value' => $transactions->sum('total'),
                ];
            })
            ->sortBy('table_number')
            ->values();
    }

    public function print(Request $request)
    {
        $currentUser = Auth::user();

        // 1. Ambil Shift Saat Ini (Atau Shift Terakhir Hari Ini)
        $currentShift = Shift::with(['cabang', 'startedBy', 'endedBy'])
            ->where('cabang_id', $currentUser->cabang_id)
            ->whereDate('started_at', Carbon::today())
            ->latest('id')
            ->first();

        if (!$currentShift) {
            return back()->with('error', 'Tidak ada data shift hari ini untuk dicetak.');
        }

        // 2. Base Query Transaksi Hari Ini
        $baseQuery = Transaction::query()
            ->where('cabang_id', $currentUser->cabang_id)
            ->whereDate('created_at', Carbon::today())
            ->where('payment_status', 'paid')
            ->whereNull('voided_at');

        $transactions = $baseQuery->get();

        // 3. Kalkulasi Sales Recapitulation
        $salesTotal = $transactions->sum('subtotal');
        $discount = $transactions->sum('discount_total_amount');
        $tax = $transactions->sum('tax_amount');
        $serviceCharge = $transactions->sum('service_amount');
        $netSales = $transactions->sum('total');
        $numberOfBills = $transactions->count();

        // 4. Kalkulasi Payment Recapitulation
        $paymentRecaps = Transaction::query()
            ->where('cabang_id', $currentUser->cabang_id)
            ->whereDate('created_at', Carbon::today())
            ->where('payment_status', 'paid')
            ->whereNull('voided_at')
            ->select(
                'payment_method',
                DB::raw('SUM(total) as total_amount')
            )
            ->groupBy('payment_method')
            ->orderBy('payment_method')
            ->get();

        $totalPayment = $paymentRecaps->sum('total_amount');

        // Kembalikan ke view cetak
        return view('components.day-start-end.shift-out', compact(
            'currentShift',
            'currentUser',
            'salesTotal',
            'discount',
            'tax',
            'serviceCharge',
            'netSales',
            'numberOfBills',
            'paymentRecaps',
            'totalPayment'
        ));
    }

    public function render()
    {
        return view('components.day-start-end.day-start-end-page');
    }

}