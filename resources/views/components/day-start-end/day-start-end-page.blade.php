<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="w-full bg-white">

    {{-- Header --}}
    <div class="flex items-center justify-between px-4 py-3 bg-gray-100 border border-gray-300">
        <span class="text-sm font-semibold text-gray-800">Current Shift</span>
        <div class="flex items-center gap-2">
            <button type="button"
                class="flex items-center gap-1.5 px-4 py-2 bg-[#428bca] hover:bg-[#3071a9] text-white text-xs font-semibold rounded transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 12H9m0 0l3-3m-3 3l3 3" />
                </svg>
                End Shift
            </button>
            <button type="button"
                class="flex items-center gap-1.5 px-4 py-2 bg-[#428bca] hover:bg-[#3071a9] text-white text-xs font-semibold rounded transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.056 48.056 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>
                Print Shift Out
            </button>
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

        {{-- Row 1: Outlet | Started By | Starting Shift --}}
        <div class="grid grid-cols-3 gap-4 mb-3">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Outlet</label>
                <input type="text" value="ALAS BU YANTI - CIAWI BOGOR" readonly
                    class="w-full px-2 py-1.5 text-xs bg-gray-100 border border-gray-300 rounded text-gray-700 cursor-default focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Started By</label>
                <input type="text" value="KASIR" readonly
                    class="w-full px-2 py-1.5 text-xs bg-gray-100 border border-gray-300 rounded text-gray-700 cursor-default focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Starting Shift</label>
                <input type="text" value="13-05-2026 08:07:24" readonly
                    class="w-full px-2 py-1.5 text-xs bg-gray-100 border border-gray-300 rounded text-gray-700 text-right cursor-default focus:outline-none">
            </div>
        </div>

        {{-- Row 2: Starting Cash --}}
        <div class="mb-4">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Starting Cash</label>
            <div class="w-1/3">
                <input type="text" value="0" readonly
                    class="w-full px-2 py-1.5 text-xs bg-gray-100 border border-gray-300 rounded text-gray-700 text-right cursor-default focus:outline-none">
            </div>
        </div>

    </div>

    {{-- Shift Detail Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">
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
                    <td colspan="2" class="px-4 py-6"></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Sales Recapitulation Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">

        {{-- Section Header --}}
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Recapitulation</span>
        </div>

        {{-- Table --}}
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Description</th>
                    <th class="px-4 py-2 text-right font-semibold text-gray-700 w-40">Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- Pending Sales --}}
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-800 font-medium">Pending Sales</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Sales Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">10.077.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Discount Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Voucher Discount Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>

                {{-- Net Sales --}}
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-800 font-medium">Net Sales</td>
                    <td class="px-4 py-2 text-right text-gray-700">10.077.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Delivery Cost Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Order Fee Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Service Charge</td>
                    <td class="px-4 py-2 text-right text-gray-700">454.700</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">PB1</td>
                    <td class="px-4 py-2 text-right text-gray-700">1.007.700</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Platform Fee</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-10 text-gray-600 italic">Voucher Sales Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>

                {{-- Gross Sales --}}
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-800 font-medium">Gross Sales</td>
                    <td class="px-4 py-2 text-right font-semibold text-gray-800">11.540.200</td>
                </tr>

                {{-- Pax Total --}}
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Pax Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">41</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Average Net Sales per Pax</td>
                    <td class="px-4 py-2 text-right text-gray-700">245.780</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Average Gross Sales per Pax</td>
                    <td class="px-4 py-2 text-right text-gray-700">245.780</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Number of Bills</td>
                    <td class="px-4 py-2 text-right text-gray-700">41</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Average Net Sales per Bill</td>
                    <td class="px-4 py-2 text-right text-gray-700">245.780</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Average Gross Sales per Bill</td>
                    <td class="px-4 py-2 text-right text-gray-700">245.780</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Cancel Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">10.000</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-800 font-medium">Void Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                </tr>
            </tbody>
        </table>

    </div>

    {{-- Sales Payment Recapitulation Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Payment Recapitulation</span>
        </div>
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-2 text-left font-semibold text-gray-800">Payment Method</th>
                    <th class="px-4 py-2 text-right font-semibold text-gray-800">Payment Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700 font-medium">CASH</td>
                    <td class="px-4 py-2 text-right text-gray-700">807.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700 font-medium">EDC BRI</td>
                    <td class="px-4 py-2 text-right text-gray-700">2.254.200</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700 font-medium">QRIS BRI</td>
                    <td class="px-4 py-2 text-right text-gray-700">8.479.000</td>
                </tr>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <td class="px-4 py-3 font-bold text-gray-800">TOTAL</td>
                    <td class="px-4 py-3 text-right font-bold text-gray-800">11.540.200</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="px-4 py-3 font-bold text-gray-800">OVER VOUCHER VALUE</td>
                    <td class="px-4 py-3 text-right font-bold text-gray-800">0</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Sales Menu Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Menu</span>
        </div>
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-3 text-left font-semibold text-gray-800">Menu</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-800">Qty</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Subtotal</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Menu Discount</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Service Charge</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">PB1</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800">Grand Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">AYAM BKR KPG</td>
                    <td class="px-4 py-2 text-center text-gray-700">7</td>
                    <td class="px-4 py-2 text-right text-gray-700">231.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">11.550</td>
                    <td class="px-4 py-2 text-right text-gray-700">23.100</td>
                    <td class="px-4 py-2 text-right text-gray-700">265.650</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Air Putih</td>
                    <td class="px-4 py-2 text-center text-gray-700">4</td>
                    <td class="px-4 py-2 text-right text-gray-700">8.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">300</td>
                    <td class="px-4 py-2 text-right text-gray-700">800</td>
                    <td class="px-4 py-2 text-right text-gray-700">9.100</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Air Putih Es</td>
                    <td class="px-4 py-2 text-center text-gray-700">2</td>
                    <td class="px-4 py-2 text-right text-gray-700">6.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">300</td>
                    <td class="px-4 py-2 text-right text-gray-700">600</td>
                    <td class="px-4 py-2 text-right text-gray-700">6.900</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Ayam Bakar Madu</td>
                    <td class="px-4 py-2 text-center text-gray-700">7</td>
                    <td class="px-4 py-2 text-right text-gray-700">203.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">8.700</td>
                    <td class="px-4 py-2 text-right text-gray-700">20.300</td>
                    <td class="px-4 py-2 text-right text-gray-700">232.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Ayam Gr Kampung</td>
                    <td class="px-4 py-2 text-center text-gray-700">12</td>
                    <td class="px-4 py-2 text-right text-gray-700">348.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">14.500</td>
                    <td class="px-4 py-2 text-right text-gray-700">34.800</td>
                    <td class="px-4 py-2 text-right text-gray-700">397.300</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Ayam Kremes</td>
                    <td class="px-4 py-2 text-center text-gray-700">12</td>
                    <td class="px-4 py-2 text-right text-gray-700">300.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">13.750</td>
                    <td class="px-4 py-2 text-right text-gray-700">30.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">343.750</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Bakwan Jagung</td>
                    <td class="px-4 py-2 text-center text-gray-700">27</td>
                    <td class="px-4 py-2 text-right text-gray-700">135.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">6.250</td>
                    <td class="px-4 py-2 text-right text-gray-700">13.500</td>
                    <td class="px-4 py-2 text-right text-gray-700">154.750</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Bebek Bakar</td>
                    <td class="px-4 py-2 text-center text-gray-700">2</td>
                    <td class="px-4 py-2 text-right text-gray-700">84.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">4.200</td>
                    <td class="px-4 py-2 text-right text-gray-700">8.400</td>
                    <td class="px-4 py-2 text-right text-gray-700">96.600</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Bebek Kremes</td>
                    <td class="px-4 py-2 text-center text-gray-700">4</td>
                    <td class="px-4 py-2 text-right text-gray-700">160.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">6.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">16.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">182.000</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-700">Empal Serundeng</td>
                    <td class="px-4 py-2 text-center text-gray-700">16</td>
                    <td class="px-4 py-2 text-right text-gray-700">560.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">0</td>
                    <td class="px-4 py-2 text-right text-gray-700">24.500</td>
                    <td class="px-4 py-2 text-right text-gray-700">56.000</td>
                    <td class="px-4 py-2 text-right text-gray-700">640.500</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- BARU: Sales By Menu Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales By Menu</span>
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
                {{-- Kategori Utama --}}
                <tr class="border-b border-gray-200">
                    <td colspan="3" class="px-4 py-2 text-gray-700 font-medium">MAKANAN</td>
                </tr>

                {{-- Sub Kategori: ANEKA DAGING --}}
                <tr class="border-b border-gray-200">
                    <td colspan="3" class="px-4 py-2 pl-8 text-gray-700">ANEKA DAGING</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Empal Serundeng</td>
                    <td class="px-4 py-2 text-center text-gray-700">16</td>
                    <td class="px-4 py-2 text-right text-gray-700">560.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-8 text-gray-700">Total - ANEKA DAGING</td>
                    <td class="px-4 py-2 text-center text-gray-700">16</td>
                    <td class="px-4 py-2 text-right text-gray-700">560.000</td>
                </tr>

                {{-- Sub Kategori: ANEKA GORENGAN --}}
                <tr class="border-b border-gray-200">
                    <td colspan="3" class="px-4 py-2 pl-8 text-gray-700">ANEKA GORENGAN</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Bakwan Jagung</td>
                    <td class="px-4 py-2 text-center text-gray-700">27</td>
                    <td class="px-4 py-2 text-right text-gray-700">135.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Mendoan</td>
                    <td class="px-4 py-2 text-center text-gray-700">17</td>
                    <td class="px-4 py-2 text-right text-gray-700">85.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Perkedel</td>
                    <td class="px-4 py-2 text-center text-gray-700">16</td>
                    <td class="px-4 py-2 text-right text-gray-700">96.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Peye Udang Gr</td>
                    <td class="px-4 py-2 text-center text-gray-700">2</td>
                    <td class="px-4 py-2 text-right text-gray-700">50.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Tahu Bacem</td>
                    <td class="px-4 py-2 text-center text-gray-700">6</td>
                    <td class="px-4 py-2 text-right text-gray-700">30.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Tahu Goreng</td>
                    <td class="px-4 py-2 text-center text-gray-700">17</td>
                    <td class="px-4 py-2 text-right text-gray-700">68.000</td>
                </tr>
                <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                    <td class="px-4 py-2 pl-12 text-gray-700">Tempe Bacem</td>
                    <td class="px-4 py-2 text-center text-gray-700">13</td>
                    <td class="px-4 py-2 text-right text-gray-700">65.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Tempe Goreng</td>
                    <td class="px-4 py-2 text-center text-gray-700">17</td>
                    <td class="px-4 py-2 text-right text-gray-700">68.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-8 text-gray-700">Total - ANEKA GORENGAN</td>
                    <td class="px-4 py-2 text-center text-gray-700">115</td>
                    <td class="px-4 py-2 text-right text-gray-700">597.000</td>
                </tr>

                {{-- Sub Kategori: ANEKA IKAN --}}
                <tr class="border-b border-gray-200">
                    <td colspan="3" class="px-4 py-2 pl-8 text-gray-700">ANEKA IKAN</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Gurame Bakar</td>
                    <td class="px-4 py-2 text-center text-gray-700">3</td>
                    <td class="px-4 py-2 text-right text-gray-700">315.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Gurame Goreng</td>
                    <td class="px-4 py-2 text-center text-gray-700">1</td>
                    <td class="px-4 py-2 text-right text-gray-700">100.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Gurame Pecak</td>
                    <td class="px-4 py-2 text-center text-gray-700">1</td>
                    <td class="px-4 py-2 text-right text-gray-700">100.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Ikan Asin Gabus</td>
                    <td class="px-4 py-2 text-center text-gray-700">1</td>
                    <td class="px-4 py-2 text-right text-gray-700">14.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 pl-12 text-gray-700">Ikan Baby</td>
                    <td class="px-4 py-2 text-center text-gray-700">2</td>
                    <td class="px-4 py-2 text-right text-gray-700">54.000</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 pl-12 text-gray-700">Ikan Barakuda</td>
                    <td class="px-4 py-2 text-center text-gray-700">1</td>
                    <td class="px-4 py-2 text-right text-gray-700">40.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700 font-medium">Total - MAKANAN</td>
                    <td class="px-4 py-2 text-center text-gray-700">541</td>
                    <td class="px-4 py-2 text-right text-gray-700">9.000.000</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Non Sales By Menu Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">
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
                    <td colspan="3" class="px-4 py-4"></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Custom Menu Sales Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Custom Menu Sales</span>
        </div>
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-3 text-left font-semibold text-gray-800 w-1/4">Sales Number</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-800">Custom Menu Name</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-800 w-24">Qty</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800 w-32">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="px-4 py-4"></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Sales By Table Section --}}
    <div class="mx-4 mb-4 border border-gray-300 rounded overflow-hidden">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales By Table Section</span>
        </div>
        <table class="w-full text-xs">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-3 text-left font-semibold text-gray-800">Table Section</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-800 w-32">Bill</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-800 w-32">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">1-50</td>
                    <td class="px-4 py-2 text-center text-gray-700">26</td>
                    <td class="px-4 py-2 text-right text-gray-700">6.354.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">51-100</td>
                    <td class="px-4 py-2 text-center text-gray-700">1</td>
                    <td class="px-4 py-2 text-right text-gray-700">713.000</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Quick Service</td>
                    <td class="px-4 py-2 text-center text-gray-700">14</td>
                    <td class="px-4 py-2 text-right text-gray-700">3.010.000</td>
                </tr>
                <tr class="bg-gray-50 border-t border-gray-300">
                    <td class="px-4 py-3 font-bold text-gray-800">TOTAL</td>
                    <td class="px-4 py-3 text-center font-bold text-gray-800">41</td>
                    <td class="px-4 py-3 text-right font-bold text-gray-800">10.077.000</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>