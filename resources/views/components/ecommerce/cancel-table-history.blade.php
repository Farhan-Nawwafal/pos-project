@props(['cancelledTables' => []])

<div
    class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 mt-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Riwayat Cancel Table</h3>
        <span class="rounded-full bg-red-50 px-2 py-0.5 text-[10px] font-bold text-red-600 dark:bg-red-500/15">VOID
            PENUH</span>
    </div>

    <div class="max-w-full overflow-x-auto custom-scrollbar">
        <table class="min-w-full">
            <thead>
                <tr class="border-t border-gray-100 dark:border-gray-800">
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Waktu</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kasir</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No. Transaksi</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No. Meja</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Disetujui Oleh</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Alasan</p>
                    </th>
                    <th class="py-3 text-right">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Total Bill</p>
                    </th>
                    <th class="py-3 text-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Detail</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($cancelledTables as $row)
                    <tr
                        class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="text-gray-600 text-theme-xs dark:text-gray-400">
                                {{ $row['voided_at'] }}
                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                {{ $row['cashier'] }}
                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="font-mono text-xs text-gray-700 dark:text-gray-300">
                                {{ $row['transaction_code'] }}
                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <span
                                class="inline-flex items-center gap-1 rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 dark:bg-red-500/10 dark:text-red-400">
                                {{ $row['table_number'] ?? 'Quick Service' }}
                            </span>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="text-gray-700 text-theme-xs dark:text-gray-300">
                                {{ $row['approved_by'] ?? '-' }}
                            </p>
                        </td>
                        <td class="py-3 pr-4">
                            <p class="text-gray-600 text-theme-xs dark:text-gray-400 italic max-w-[200px] truncate"
                                title="{{ $row['void_reason'] }}">
                                "{{ $row['void_reason'] }}"
                            </p>
                        </td>
                        <td class="py-3 text-right whitespace-nowrap">
                            <p class="font-semibold text-gray-800 text-theme-sm dark:text-white/90">
                                Rp{{ number_format($row['total'], 0, ',', '.') }}
                            </p>
                        </td>
                        <td class="py-3 text-center">
                            <a href="{{ route('transactions.cancel-detail', $row['transaction_id']) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="border-t border-gray-100 dark:border-gray-800">
                        <td colspan="8" class="py-6">
                            <p class="text-center text-theme-sm text-gray-500 dark:text-gray-400">
                                Tidak ada cancel table dalam periode ini.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
