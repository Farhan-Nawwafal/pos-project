<div class="grid grid-cols-1 gap-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">Shift Logs</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Shift Logs List</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="custom-scrollbar overflow-x-auto border-b border-gray-200 px-3 py-4 dark:border-gray-800">
            <div class="flex flex-col xl:flex-row gap-3 w-full">

                <div class="flex flex-col gap-1.5 w-full xl:w-auto">
                    <div class="relative w-full">
                        <x-common.date-range-picker-shift-log
                            :from="$fromDate"
                            :to="$toDate"
                            wire-from-model="fromDate"
                            wire-to-model="toDate"
                            class="w-full" />
                    </div>
                </div>

                <div class="flex flex-col gap-1.5 flex-1">
                    <div class="relative w-full">
                        <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z"
                                    fill="" />
                            </svg>
                        </span>
                        <input wire:model.live.debounce.400ms="searchNumber" type="text"
                            placeholder="Cari Nama Kasir atau Waktu Shift mulai/akhir..."
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-8 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[850px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                </div>
            </div>
        </div>

        <div class="custom-scrollbar overflow-x-auto px-3">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-center">Starting Shift</th>
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">Started By</th>
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-right">Starting Cash</th>
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">Ending Shift</th>
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">Ended By</th>
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-end">Expected Cash</th>
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-end">Actual Cash</th>
                        <th class="font-bold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-end">Difference Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($shiftLogs as $sl)
                    <tr class="hover:bg-gray-200 hover:dark:bg-gray-900">
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90 text-center">
                            <p>
                                {{ $sl['starting_shift'] }}
                            </p>
                        </td>
                        </td>
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90">
                            <p>{{ $sl['started_by'] }}</p>
                        </td>
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90 text-end">
                            <p>{{ number_format((int) $sl['starting_cash'], 0, ',', '.') }}</p>
                        </td>
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90 text-center">
                            <p>{{ $sl['ending_shift'] }}</p>
                        </td>
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90">
                            <p>{{ $sl['ended_by'] }}</p>
                        </td>
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90 text-end">
                            <p>{{ number_format((int) $sl['expected_cash'], 0, ',', '.') }}</p>
                        </td>
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90 text-end">
                            <p>{{ number_format((int) $sl['actual_cash'], 0, ',', '.') }}</p>
                        </td>
                        <td class="px-2 py-2 font-light text-gray-800 dark:text-white/90 text-end">
                            <p>{{ number_format((int) $sl['difference_total'], 0, ',', '.') }}</p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $canActions ? 10 : 9 }}" class="px-5 py-10">
                            <p class="text-center text-sm text-gray-500 dark:text-gray-400">Transaksi tidak
                                ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>