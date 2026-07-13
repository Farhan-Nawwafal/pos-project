<div class="w-full bg-white">

    {{-- Header --}}
    <div class="flex items-center justify-between px-4 py-3 bg-gray-100 ">
        <span class="text-sm font-semibold text-gray-800">Current Shift</span>
        <div class="flex items-center gap-2">
            <button type="button" wire:click="endShift"
                class="flex items-center gap-1.5 px-4 py-2 bg-[#428bca] hover:bg-[#3071a9] text-white text-xs font-semibold rounded transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 12H9m0 0l3-3m-3 3l3 3" />
                </svg>
                End Shift
            </button>
            <a href="{{ route('print.shift.out') }}" target="_blank"
                class="flex items-center gap-1.5 px-4 py-2 bg-[#428bca] hover:bg-[#3071a9] text-white text-xs font-semibold rounded transition-colors no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.056 48.056 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>
                Print Shift Out
            </a>
            <button type="button"
                class="flex items-center gap-1.5 px-4 py-2 bg-[#428bca] hover:bg-[#3071a9] text-white text-xs font-semibold rounded transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                End Day
            </button>
        </div>
    </div>

    {{-- Form Fields --}}
    <div class="px-4 pt-4 pb-2">

        @if(session()->has('success'))
            <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-4 mb-3">

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">
                    Outlet
                </label>

                <input type="text" readonly value="{{ optional($currentUser->cabang)->name ?? '-' }}"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">
                    Started By
                </label>

                <input type="text" readonly value="{{ $currentUser->name }}"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">
                    Starting Shift
                </label>

                <input type="text" readonly value="{{ $currentShift
    ? $currentShift->started_at->format('d-m-Y H:i:s')
    : ($currentUser->last_login_at?->format('d-m-Y H:i:s') ?? '-') }}"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">
            </div>

        </div>

        <div class="mb-4">

            <label class="block text-xs font-semibold text-gray-700 mb-1">
                Starting Cash
            </label>

            <div class="w-1/3">

                <input type="text" readonly value="{{ number_format($currentShift->starting_cash ?? 0, 0, ',', '.') }}"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">

            </div>

        </div>

    </div>

    {{-- Shift Detail Section --}}
    {{-- Shift Detail Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden bg-white">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Shift Detail</span>
        </div>
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-1/2">End Shift Time</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700 w-1/2">Ended By</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-4 text-gray-800 font-medium">
                        {{ $currentShift && $currentShift->ended_at ? \Carbon\Carbon::parse($currentShift->ended_at)->format('d-m-Y H:i:s') : '-' }}
                    </td>
                    <td class="px-4 py-4 text-gray-800 font-medium">
                        {{ $currentShift && $currentShift->endedBy ? $currentShift->endedBy->name : '-' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Sales Recapitulation Section --}}
    <div class="mb-6 mx-4">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Recapitulation</span>
        </div>
        <table class="w-full border-collapse border border-gray-300 text-sm bg-white rounded-b">
            <tbody>
                <tr>
                    <td class="px-4 py-2 text-gray-700">Sales Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($salesTotal, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Discount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($discount, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">ManualDiscount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($manualDiscount, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Voucher Discount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($voucherDiscount, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Point Discount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($pointDiscount, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Service Charge</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($serviceCharge, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Tax</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($tax, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Payment Fee</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($paymentFee, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Rounding</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($rounding, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Refunded</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($refundedAmount, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="font-bold">
                    <td class="px-4 py-2 text-gray-700">Net Sales</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp {{ number_format($netSales, 0, ',', '.') }}
                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Number Of Bills</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        {{ $numberOfBills }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Sales Payment Recapitulation --}}
    <div class="mb-6 mx-4">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Payment Recapitulation</span>
        </div>
        <table class="w-full border-collapse border border-gray-300 text-sm bg-white rounded-b">
            <tbody>
                @forelse($paymentRecaps as $payment)
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2 text-gray-700 uppercase">{{ $payment->payment_method ?? 'TIDAK DIKETAHUI' }}
                        </td>
                        <td class="px-4 py-2 text-right text-gray-700">
                            {{ number_format($payment->total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200">
                        <td colspan="2" class="px-4 py-2 text-center text-gray-500 italic">Belum ada transaksi pembayaran.
                        </td>
                    </tr>
                @endforelse
                <tr class="bg-gray-50">
                    <td class="px-4 py-2 font-bold text-gray-900 uppercase">Total</td>
                    <td class="px-4 py-2 text-right font-bold text-gray-900">
                        {{ number_format($totalPayment, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Sales Menu Section (Yang Awalnya Hardcoded Sekarang Dinamis) --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden bg-white">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Menu</span>
        </div>
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-3 text-left font-semibold text-gray-800">Menu</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-800">Qty</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Subtotal</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Manual Discount</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Voucher Discount</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Menu Discount</th>
                    <!-- <th class="px-4 py-3 text-right font-semibold text-gray-800">Grand Total</th> -->
                </tr>
            </thead>
            <tbody>
                @forelse($salesByMenus as $item)
                    <trclass="border-b border-gray-200">
                        {{-- Menggunakan $item->product->name sesuai dengan relasi model --}}
                        <td class="px-4 py-2 text-gray-700">{{ $item->product->name ?? 'Produk Dihapus' }}</td>
                        <td class="px-4 py-2 text-center text-gray-700">{{ $item->total_qty }}</td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp
                            {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp
                            {{ number_format($item->manual_discount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp
                            {{ number_format($item->voucher_discount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp
                            {{ number_format($item->menu_discount + $item->voucher_discount, 0, ',', '.') }}
                        </td>
                        </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center italic text-gray-500 py-4">Tidak ada data penjualan menu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Non Sales By Menu Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden bg-white">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Non Sales By Menu</span>
        </div>
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-3 text-left font-semibold text-gray-800">Description</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-800 w-24">Qty</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800 w-32">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="px-4 py-4 text-center text-gray-500 italic">Kosong</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Custom Menu Sales Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden bg-white">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Custom Menu Sales</span>
        </div>
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-300">
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Custom Item Name</th>
                    <th class="px-4 py-2 text-center font-semibold text-gray-800">Qty</th>
                    <th class="px-4 py-2 text-right font-semibold text-gray-800">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customMenus as $custom)
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2 text-gray-700">{{ $custom->item_name ?? 'Item Kustom' }}</td>
                        <td class="px-4 py-2 text-center text-gray-700">{{ $custom->total_qty }}</td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp
                            {{ number_format($custom->total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200">
                        <td colspan="3" class="px-4 py-2 text-center text-gray-500 italic">Tidak ada custom menu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Sales By Table Section --}}
    <div class="mx-4 mb-10 border border-gray-300 rounded overflow-hidden bg-white">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales By Table Section</span>
        </div>
        <table class="w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-300">
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Table Section</th>
                    <th class="px-4 py-2 text-right font-semibold text-gray-800">Bills</th>
                    <th class="px-4 py-2 text-right font-semibold text-gray-800">Value</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tableSections as $section)
                    <tr class="border-b border-gray-200">
                        {{-- Panggil section_name yang kita buat di join query --}}
                        <td class="px-4 py-2 text-gray-700">Meja {{ $section->table_number }}</td>
                        <td class="px-4 py-2 text-right text-gray-700 font-medium">
                            {{ number_format($section->bill, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-right text-gray-700 font-medium">Rp
                            {{ number_format($section->value, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center italic">Tidak ada transaksi meja</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>