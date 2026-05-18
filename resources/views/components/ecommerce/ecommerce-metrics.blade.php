@props([
    'transactions' => 0,
    'transactionsDeltaPercent' => 0,
    'transactionsDeltaUp' => true,
    'revenueAmount' => 0,
    'grossAmount' => 0,
])

@php
    $transactionsDelta = (float) ($transactionsDeltaPercent ?? 0);
    $transactionsDeltaUp = (bool) ($transactionsDeltaUp ?? true);
    $transactionsDeltaText = rtrim(rtrim(number_format(abs($transactionsDelta), 2, '.', ''), '0'), '.') . '%';
@endphp

<div class="grid grid-cols-1 gap-4 sm:grid-cols-12 md:gap-6">

    <div
        class="sm:col-span-4 rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-theme-sm text-gray-500 dark:text-gray-400">Transaksi Hari Ini</p>

        <div class="mt-3 flex flex-col items-start gap-2 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h4 class="text-title-sm font-bold text-gray-800 dark:text-white/90">
                    {{ number_format((int) $transactions, 0, ',', '.') }}
                </h4>
            </div>

            <div class="flex items-center gap-1">
                <span @class([
                    'text-theme-xs flex items-center gap-1 rounded-full px-2 py-0.5 font-medium',
                    'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500' => $transactionsDeltaUp,
                    'bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500' => !$transactionsDeltaUp,
                ])>
                    {{ $transactionsDeltaUp ? '+' : '-' }}{{ $transactionsDeltaText }}
                </span>
                <span class="text-[10px] text-gray-500 dark:text-gray-400">vs Kemarin</span>
            </div>
        </div>
    </div>

    <div
        class="sm:col-span-8 rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between">
            <p class="text-theme-sm text-gray-500 dark:text-gray-400 font-medium">Omzet Hari Ini</p>
            <span
                class="text-[10px] font-bold px-2 py-0.5 rounded bg-brand-50 text-brand-600 dark:bg-brand-500/10 uppercase tracking-widest">
                Gross + Net
            </span>
        </div>

        {{-- Grid di dalam card omzet supaya Gross dan Net bisa berdampingan kalau layar lebar --}}
        <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
            {{-- Gross Amount --}}
            <div class="rounded-xl bg-gray-50/50 p-3 dark:bg-gray-900/50">
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Gross Sales (Kotor)</p>
                <h4 class="text-xl font-black text-gray-800 dark:text-white/90 mt-1">
                    Rp{{ number_format((int) $grossAmount, 0, ',', '.') }}
                </h4>
            </div>

            {{-- Net Amount --}}
            <div class="rounded-xl bg-gray-50/50 p-3 dark:bg-gray-900/50">
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Net
                    Sales (Bersih)</p>
                <h4 class="text-xl font-black text-gray-800 dark:text-white/90 mt-1">
                    Rp{{ number_format((int) $revenueAmount, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>
</div>
