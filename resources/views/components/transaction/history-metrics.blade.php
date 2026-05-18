@props([
    'stats' => [
        'totalTransactions' => 0,
        'totalRevenue' => 0,
        'avgRevenue' => 0,
        'totalItemsSold' => 0,
        'grossAmount' => 0,
    ],
])

@php
    $totalTransactions = (int) ($stats['totalTransactions'] ?? 0);
    $totalRevenue = (int) ($stats['totalRevenue'] ?? 0);

    $avgRevenue = (int) ($stats['avgRevenue'] ?? 0);
    $totalItemsSold = (int) ($stats['totalItemsSold'] ?? 0);
@endphp

{{-- Ubah parent grid menjadi xl:grid-cols-5 agar Card Omzet bisa mengambil porsi lebih lebar --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5 md:gap-6">

    {{-- Card 1: Total Transaksi --}}
    <div class="sm:col-span-2 xl:col-span-1 rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-theme-sm text-gray-500 dark:text-gray-400">Total Transaksi</p>
        <div class="mt-3 flex items-end justify-between">
            <h4 class="text-2xl font-bold text-gray-800 dark:text-white/90">
                {{ number_format($totalTransactions, 0, ',', '.') }}</h4>
        </div>
    </div>

    {{-- Card 2: Omzet Periode Ini (Gross + Net) --}}
    <div
        class="sm:col-span-2 xl:col-span-2 rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between">
            <p class="text-theme-sm text-gray-500 dark:text-gray-400 font-medium">Omzet Periode Ini</p>
            <span
                class="text-[10px] font-bold px-2 py-0.5 rounded bg-brand-50 text-brand-600 dark:bg-brand-500/10 uppercase tracking-widest">
                Gross + Net
            </span>
        </div>
        <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div class="rounded-xl bg-gray-50/50 p-3 dark:bg-gray-900/50">
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Gross Sales (Kotor)</p>
                <h4 class="text-xl font-black text-gray-800 dark:text-white/90 mt-1">
                    Rp{{ number_format((int) ($stats['grossAmount'] ?? 0), 0, ',', '.') }}
                </h4>
            </div>
            <div class="rounded-xl bg-gray-50/50 p-3 dark:bg-gray-900/50">
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Net Sales (Bersih)</p>
                <h4 class="text-xl font-black text-gray-800 dark:text-white/90 mt-1">
                    Rp{{ number_format($totalRevenue, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>

    {{-- Card 3: Rata-rata Omzet --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-theme-sm text-gray-500 dark:text-gray-400">Rata-rata Omzet</p>
        <div class="mt-3 flex items-end justify-between">
            <h4 class="text-2xl font-bold text-gray-800 dark:text-white/90">
                Rp{{ number_format($avgRevenue, 0, ',', '.') }}</h4>
        </div>
    </div>

    {{-- Card 4: Item Terjual --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-theme-sm text-gray-500 dark:text-gray-400">Item Terjual</p>
        <div class="mt-3 flex items-end justify-between">
            <h4 class="text-2xl font-bold text-gray-800 dark:text-white/90">
                {{ number_format($totalItemsSold, 0, ',', '.') }}</h4>
        </div>
    </div>
</div>
