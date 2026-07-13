<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftReportController extends Controller
{
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

        // TAMBAHKAN KODE INI: Ambil data Sales By Menu
        $transactionIds = $transactions->pluck('id');
        $salesByMenus = TransactionItem::withoutGlobalScopes()
            ->whereNull('parent_transaction_item_id')
            ->whereIn('transaction_id', $transactionIds)
            ->select(
                'product_id',
                DB::raw('SUM(quantity) as total_qty'),
                DB::raw('SUM(subtotal) as subtotal')
            )
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_qty')
            ->get();

        // TAMBAHKAN JUGA customMenus (kosongkan dulu sesuai yang di Livewire)
        $customMenus = collect();

        // Kembalikan ke view cetak (tambahkan salesByMenus dan customMenus)
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
            'totalPayment',
            'salesByMenus',    // <-- Tambahkan ini
            'customMenus'      // <-- Tambahkan ini
        ));
    }
}