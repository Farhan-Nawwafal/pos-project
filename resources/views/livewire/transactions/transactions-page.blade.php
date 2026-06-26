<div x-data="{ activeTab: 'overview' }" class="flex flex-col pl-4 pr-4 ">
        
        <div class="max-w-7xl  px-2 py-3 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-black">Sales Recapitulation</h3>
        </div>
        
    <div class="flex flex-col relative z-10">
        
        <div class="flex gap-1">
            <button @click="activeTab = 'overview'"
                :class="activeTab === 'overview' ? 'bg-white dark:bg-gray-900 text-gray-800 dark:text-white font-bold border-t border-x border-gray-200 dark:border-gray-800 z-10' : 'bg-gray-50 dark:bg-gray-800/50 text-gray-500 hover:text-gray-700 hover:bg-gray-100 border-transparent border-t border-x'"
                class="rounded-t-lg px-6 py-2.5 text-sm transition-all duration-200 focus:outline-none relative -mb-[1px]">
                Sales Overview
            </button>

            <button @click="activeTab = 'online'"
                :class="activeTab === 'online' ? 'bg-white dark:bg-gray-900 text-gray-800 dark:text-white font-bold border-t border-x border-gray-200 dark:border-gray-800 z-10' : 'bg-gray-50 dark:bg-gray-800/50 text-gray-500 hover:text-gray-700 hover:bg-gray-100 border-transparent border-t border-x'"
                class="rounded-t-lg px-6 py-2.5 text-sm transition-all duration-200 focus:outline-none relative -mb-[1px]">
                Online Payment
            </button>
        </div>
    </div>

    <div x-show="activeTab === 'overview'" x-transition.opacity.duration.300ms class="grid grid-cols-1 gap-6">
        <div
            class="overflow-hidden rounded-l rounded-tl-none border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="custom-scrollbar overflow-x-auto border-b border-gray-200 px-3 py-4 dark:border-gray-800">
                <div class="flex flex-col xl:flex-row gap-3 w-full">

                    <div class="flex flex-col gap-1.5 flex-1 xl:flex-none xl:w-[210px]">
                        <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Date</label>
                        <div class="relative w-full">
                            <x-common.date-range-picker-transaction :from="$fromDate" :to="$toDate"
                                wire-from-model="fromDate" wire-to-model="toDate" class="w-full" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5 flex-1 xl:flex-none">
                        <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Transaction Number</label>
                        <div class="relative w-full">
                            <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="16" height="16" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z"
                                        fill="" />
                                </svg>
                            </span>
                            <input wire:model.live.debounce.400ms="searchNumber" type="text"
                                placeholder="Cari Transaksi..."
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-7 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-10 text-xs text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[145px] xl:min-w-[100px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5 flex-1 xl:flex-none">
                        <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Customer</label>
                        <div class="relative w-full">
                            <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="16" height="16" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z"
                                        fill="" />
                                </svg>
                            </span>
                            <input wire:model.live.debounce.400ms="searchCustomer" type="text"
                                placeholder="Cari Pelanggan..."
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-7 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-10 text-xs text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[145px] xl:min-w-[100px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5 flex-1 xl:flex-none">
                        <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Table</label>
                        <div class="relative w-full">
                            <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="16" height="16" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z"
                                        fill="" />
                                </svg>
                            </span>
                            <input wire:model.live.debounce.400ms="searchTable" type="text" placeholder="Cari Meja..."
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-7 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-10 text-xs text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[145px] xl:min-w-[100px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                        <div class="flex flex-col gap-3 sm:flex-row w-full">

                            <div class="flex flex-col gap-1.5 flex-1 sm:flex-none">
                                <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Status</label>
                                <select wire:model.live="paymentStatus"
                                    class="shadow-theme-xs h-7 w-full rounded-lg border border-gray-300 bg-white px-4 text-xs text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 xl:w-[125px] xl:min-w-[100px]">
                                    <option value="">Semua Status</option>
                                    @foreach ($paymentStatusOptions as $status)
                                        <option value="{{ $status }}">
                                            {{ \App\Helpers\DataLabelHelper::enum($status, 'payment_status') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col gap-1.5 flex-1 sm:flex-none">
                                <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Payment Method</label>
                                <select wire:model.live="paymentMethod"
                                    class="shadow-theme-xs h-7 w-full rounded-lg border border-gray-300 bg-white px-4 text-xs text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 xl:w-[125px] xl:min-w-[100px]">
                                    <option value="">Semua Metode</option>
                                    @foreach ($paymentMethodOptions as $method)
                                        <option value="{{ $method }}">
                                            {{ \App\Helpers\DataLabelHelper::enum($method, 'payment_method') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col gap-1.5 flex-1 sm:flex-none">
                                <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Visit Purpose</label>
                                <select wire:model.live="orderType"
                                    class="shadow-theme-xs h-7 w-full rounded-lg border border-gray-300 bg-white px-4 text-xs text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 xl:w-[125px] xl:min-w-[100px]">
                                    <option value="">Semua Tipe</option>
                                    @foreach ($orderTypeOptions as $type)
                                        <option value="{{ $type }}">{{ $type === 'dine_in' ? 'Dine in' : 'Take away' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            @php
                $canActions =
                    (bool) (auth()->user()?->can('transactions.details') || auth()->user()?->can('transactions.print'));
            @endphp
            <div class="custom-scrollbar overflow-x-auto px-3">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-left text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                Transaction Number</th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-center text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                <button type="button" wire:click="sortBy('created_at')"
                                    class="flex w-full justify-center items-center gap-2">
                                    Date
                                </button>
                            </th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-left text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                Customer
                            </th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-center text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-center">
                                Table</th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-center text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-center">
                                Visit Purpose</th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-right text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                <button type="button" wire:click="sortBy('total')"
                                    class="ml-auto flex items-center justify-end gap-2">
                                    Grand Total
                                </button>
                            </th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-left text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                Status</th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-left text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                Payment Method</th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-left text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                Payment Time</th>
                            <th
                                class="text-xs font-extrabold py-2 px-2 text-left text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                                Payment By</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($transactions as $transaction)
                            @php
                                $customer = (string) ($transaction->member?->name ?? ($transaction->name ?? '-'));
                                $orderType = (string) ($transaction->order_type ?? '');
                                $paymentMethodKey = (string) ($transaction->payment_method ?? '');
                                $paymentMethodLabel = \App\Helpers\DataLabelHelper::enum(
                                    $paymentMethodKey,
                                    'payment_method',
                                );
                                $paymentStatusKey = (string) ($transaction->payment_status ?? '');
                                $paymentStatusLabel = \App\Helpers\DataLabelHelper::enum(
                                    $paymentStatusKey,
                                    'payment_status',
                                );
                            @endphp
                            <tr class="hover:bg-gray-200 hover:dark:bg-gray-900">
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90">
                                    <p>
                                        {{ $transaction->code }}
                                    </p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90 text-center">
                                    <div class="space-y-1">
                                        <p>
                                            {{ optional($transaction->created_at)->format('d-m-Y') }}
                                        </p>
                                    </div>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90">
                                    <p>{{ $customer }}</p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90 text-center">
                                    <p>{{ $transaction->dining_table_id ? $transaction->dining_table_id : 'Quick Service' }}
                                    </p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90 text-center">
                                    <p>{{ $orderType === 'dine_in' ? 'Dine in' : 'Take away' }}</p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90 text-right">
                                    <p">Rp{{ number_format((int) $transaction->total, 0, ',', '.') }}</p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90">
                                    <p>{{ $paymentStatusLabel }}</p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90">
                                    <p>{{ $paymentMethodLabel }}</p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90">
                                    <p>{{ $transaction->paid_at ? $transaction->paid_at->format('H:i:s') : '-' }}</p>
                                </td>
                                <td class="text-xs px-2 py-2 font-normal text-gray-800 dark:text-white/90">
                                    <p>{{ $transaction->cashier->name ?? '-' }}</p>
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
            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                {{ $transactions->links('livewire.pagination.admin') }}
            </div>
        </div>
        <x-ecommerce.void-items-history :items="$voidItems" />

        <div class="mt-8">
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Audit Deleted Items</h3>
                    <span
                        class="rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-bold text-orange-700">PENGAWASAN</span>
                </div>
                <div class="custom-scrollbar overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50">
                                <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 uppercase">Kasir</th>
                                <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                <th class="px-5 py-4 text-center text-xs font-medium text-gray-500 uppercase">Perubahan
                                    Qty
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($deletedItemLogs as $log)
                                <tr>
                                    <td
                                        class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400 text-center">
                                        {{ $log->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-sm font-bold text-gray-800 dark:text-white">
                                        {{ $log->causer->name ?? 'System' }}
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $log->getExtraProperty('product') }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <div class="inline-flex items-center gap-2">
                                            <span
                                                class="text-gray-400 line-through">{{ $log->getExtraProperty('old_qty') }}</span>
                                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                            <span class="font-black text-orange-600 dark:text-orange-400 text-lg">
                                                {{ $log->getExtraProperty('new_qty') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-10 text-center text-gray-500">Tidak ada item yang
                                        dikurangi atau dihapus.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="activeTab === 'online'" style="display: none;" x-transition.opacity.duration.300ms
        class="grid grid-cols-1 gap-6">

        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 text-center dark:border-gray-800 dark:bg-white/[0.03]">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white/90">Data Online Payment</h3>
            <p class="mt-2 text-sm text-gray-500">Tampilan tabel Online Payment akan berada di sini.</p>
        </div>

    </div>

</div>