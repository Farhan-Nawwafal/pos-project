<div
    x-data="{ showModal: false }"
    x-show="showModal"
    x-on:open-pos-modal.window="showModal = true"
    x-on:keydown.escape.window="showModal = false"
    class="relative z-[99999]" 
    style="display: none;"
>
    <div
        x-show="showModal"
        x-transition
        class="fixed inset-0 bg-black/50"
    ></div>

    <div class="fixed inset-0 z-[999] overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div
                x-show="showModal"
                x-on:click.away="showModal = false"
                x-transition
                class="w-full max-w-4xl bg-white rounded-md shadow-2xl overflow-hidden"
            >
                <div class="bg-blue-500 text-white px-5 py-3.5">
                    <h2 class="text-lg font-semibold tracking-wide">
                        Sales Recapitulation - SABYCB177868018494 - 1
                    </h2>
                    <p class="text-sm mt-0.5 opacity-90">
                        DINE IN
                    </p>
                </div>

                <div class="bg-white overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top" style="width: 25%;">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Member</label>
                                <input type="text" value="No Member" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top" style="width: 25%;">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Pax Total</label>
                                <input type="text" value="1" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top" style="width: 25%;">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Sales Date In</label>
                                <input type="text" value="13-05-2026, 20:49:44" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top" style="width: 25%;">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Sales Date Out</label>
                                <input type="text" value="13-05-2026, 20:50:41" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                        </tr>

                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Waiter</label>
                                <input type="text" value="KASIR" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Cashier</label>
                                <input type="text" value="KASIR" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top" colspan="2">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Additional Info</label>
                                <input type="text" value="test web bagas" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                        </tr>

                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Name</label>
                                <input type="text" value="" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="text" value="" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top" colspan="2">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Email</label>
                                <input type="text" value="" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                        </tr>

                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top" colspan="2">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Linked Sales Number</label>
                                <input type="text" value="-" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top" colspan="2">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Linked Table</label>
                                <input type="text" value="Meja 12" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                        </tr>

                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Subtotal</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Bill Discount</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Menu Discount</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Voucher Discount Total</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                        </tr>

                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Delivery Cost</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Order Fee</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Platform Fee</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Voucher Purchase</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                        </tr>

                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Service Charge</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">PB1</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top" colspan="2">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Linked Total</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                        </tr>

                        <tr>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Grand Total</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right font-bold cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Payment Total</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right font-bold cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Change</label>
                                <input type="text" value="0" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded text-right cursor-not-allowed">
                            </td>
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Remarks</label>
                                <input type="text" value="-" readonly class="w-full px-3 py-2 text-sm border border-gray-300 bg-gray-100 text-gray-700 rounded cursor-not-allowed">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 flex justify-between items-center rounded-b-md">
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-gray-300 text-gray-500 text-sm font-medium rounded cursor-not-allowed hover:bg-gray-300 transition">
                            📄 Reprint Receipt
                        </button>
                        <button class="px-4 py-2 bg-gray-300 text-gray-500 text-sm font-medium rounded cursor-not-allowed hover:bg-gray-300 transition">
                            ❌ Void Sales
                        </button>
                    </div>

                    <button
                        @click="showModal = false"
                        class="px-5 py-2 bg-[#DD4B39]  text-white text-sm font-medium rounded transition-colors"
                    >
                        ✕ Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\POS PROJECT FINAL\pos-project\resources\views/components/pos-modal.blade.php ENDPATH**/ ?>