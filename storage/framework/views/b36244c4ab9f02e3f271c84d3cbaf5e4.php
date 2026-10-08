<div class="w-full bg-white">

    
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
            <a href="<?php echo e(route('print.shift.out')); ?>" target="_blank"
                class="flex items-center gap-1.5 px-4 py-2 bg-[#428bca] hover:bg-[#3071a9] text-white text-xs font-semibold rounded transition-colors no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.056 48.056 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>
                Print Shift Out
            </a>
            <button
                type="button"
                wire:click="confirmEndDay"
                <?php if($isDayClosed): echo 'disabled'; endif; ?>
                class="flex items-center gap-1.5 px-4 py-2 text-white text-xs font-semibold rounded transition-colors
                    <?php echo e($isDayClosed ? 'bg-gray-400 cursor-not-allowed opacity-60' : 'bg-[#d9534f] hover:bg-[#c9302c]'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <?php echo e($isDayClosed ? 'Day Closed' : 'End Day'); ?>

            </button>
        </div>
    </div>



    
    <div class="px-4 pt-4 pb-2">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
            <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid grid-cols-3 gap-4 mb-3">

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">
                    Outlet
                </label>

                <input type="text" readonly value="<?php echo e(optional($currentUser->cabang)->name ?? '-'); ?>"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">
                    Started By
                </label>

                <input type="text" readonly value="<?php echo e($currentUser->name); ?>"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">
                    Starting Shift
                </label>

                <input type="text" readonly
                    value="<?php echo e($currentShift
                        ? $currentShift->started_at->format('d-m-Y H:i:s')
                        : $currentUser->last_login_at?->format('d-m-Y H:i:s') ?? '-'); ?>"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">
            </div>

        </div>

        <div class="mb-4">

            <label class="block text-xs font-semibold text-gray-700 mb-1">
                Starting Cash
            </label>

            <div class="w-1/3">

                <input type="text" readonly
                    value="<?php echo e(number_format($currentShift->starting_cash ?? 0, 0, ',', '.')); ?>"
                    class="w-full text-sm border-gray-300 bg-gray-50 rounded px-2 py-1">

            </div>

        </div>

    </div>

    
    
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
                        <?php echo e($currentShift && $currentShift->ended_at ? \Carbon\Carbon::parse($currentShift->ended_at)->format('d-m-Y H:i:s') : '-'); ?>

                    </td>
                    <td class="px-4 py-4 text-gray-800 font-medium">
                        <?php echo e($currentShift && $currentShift->endedBy ? $currentShift->endedBy->name : '-'); ?>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    
    <div class="mb-6 mx-4">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Recapitulation</span>
        </div>
        <table class="w-full border-collapse border border-gray-300 text-sm bg-white rounded-b">
            <tbody>
                <tr>
                    <td class="px-4 py-2 text-gray-700">Sales Total</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($salesTotal, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Discount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($discount, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">ManualDiscount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($manualDiscount, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Voucher Discount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($voucherDiscount, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Point Discount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($pointDiscount, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Promotion Discount</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($promotionDiscount, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Compliment</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($complimentAmount, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Void Sales</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($voidSales, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Pending Sales</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($pendingSales, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Service Charge</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($serviceCharge, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Tax</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($tax, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Payment Fee</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($paymentFee, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Rounding</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($rounding, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Refunded</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($refundedAmount, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="font-bold">
                    <td class="px-4 py-2 text-gray-700">Net Sales</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        Rp <?php echo e(number_format($netSales, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-gray-700">Number Of Bills</td>
                    <td class="px-4 py-2 text-right text-gray-700">
                        <?php echo e($numberOfBills); ?>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    
    <div class="mb-6 mx-4">
        <div class="px-4 py-2 bg-[#428bca]">
            <span class="text-sm font-semibold text-white">Sales Payment Recapitulation</span>
        </div>
        <table class="w-full border-collapse border border-gray-300 text-sm bg-white rounded-b">
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $paymentRecaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2 text-gray-700 uppercase">
                            <?php echo e($payment->payment_method ?? 'TIDAK DIKETAHUI'); ?>

                        </td>
                        <td class="px-4 py-2 text-right text-gray-700">
                            <?php echo e(number_format($payment->total_amount, 0, ',', '.')); ?>

                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr class="border-b border-gray-200">
                        <td colspan="2" class="px-4 py-2 text-center text-gray-500 italic">Belum ada transaksi
                            pembayaran.
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <tr class="bg-gray-50">
                    <td class="px-4 py-2 font-bold text-gray-900 uppercase">Total</td>
                    <td class="px-4 py-2 text-right font-bold text-gray-900">
                        <?php echo e(number_format($totalPayment, 0, ',', '.')); ?>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $salesByMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <trclass="border-b border-gray-200">
                    
                    <td class="px-4 py-2 text-gray-700"><?php echo e($item->product->name ?? 'Produk Dihapus'); ?></td>
                    <td class="px-4 py-2 text-center text-gray-700"><?php echo e($item->total_qty); ?></td>
                    <td class="px-4 py-2 text-right text-gray-700">Rp
                        <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                    </td>
                    <td class="px-4 py-2 text-right text-gray-700">Rp
                        <?php echo e(number_format($item->manual_discount, 0, ',', '.')); ?>

                    </td>
                    <td class="px-4 py-2 text-right text-gray-700">Rp
                        <?php echo e(number_format($item->voucher_discount, 0, ',', '.')); ?>

                    </td>
                    <td class="px-4 py-2 text-right text-gray-700">Rp
                        <?php echo e(number_format($item->menu_discount + $item->voucher_discount, 0, ',', '.')); ?>

                    </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="3" class="text-center italic text-gray-500 py-4">Tidak ada data penjualan
                            menu.
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2 text-gray-700"><?php echo e($custom->item_name ?? 'Item Kustom'); ?></td>
                        <td class="px-4 py-2 text-center text-gray-700"><?php echo e($custom->total_qty); ?></td>
                        <td class="px-4 py-2 text-right text-gray-700">Rp
                            <?php echo e(number_format($custom->total_amount, 0, ',', '.')); ?>

                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr class="border-b border-gray-200">
                        <td colspan="3" class="px-4 py-2 text-center text-gray-500 italic">Tidak ada custom menu.
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tableSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="border-b border-gray-200">
                        
                        <td class="px-4 py-2 text-gray-700">Meja <?php echo e($section->table_number); ?></td>
                        <td class="px-4 py-2 text-right text-gray-700 font-medium">
                            <?php echo e(number_format($section->bill, 0, ',', '.')); ?>

                        </td>
                        <td class="px-4 py-2 text-right text-gray-700 font-medium">Rp
                            <?php echo e(number_format($section->value, 0, ',', '.')); ?>

                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="2" class="text-center italic">Tidak ada transaksi meja</td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showEndDayConfirm): ?>
    <template x-teleport="<?php echo e('body'); ?>">
        <div class="fixed inset-0 z-[100035] flex items-center justify-center p-4"
             <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'endday-modal'; ?>wire:key="endday-modal">
            <div class="absolute inset-0 bg-black/40" wire:click="cancelEndDay"></div>

            <div class="relative bg-white rounded-lg shadow-2xl w-full max-w-md mx-4 overflow-hidden animate-in fade-in zoom-in-95 duration-150">

                
                <div class="bg-red-600 px-5 py-3 text-white">
                    <h3 class="text-base font-bold tracking-wide">Konfirmasi End Day</h3>
                </div>

                
                <div class="p-6">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-2">
                                Sistem akan <strong>mencetak struk penutupan</strong> hari ini via printer Bluetooth.
                            </p>
                            <p class="text-sm text-red-600 font-semibold">
                                ⚠ Setelah cetak berhasil, Anda akan otomatis <strong>logout</strong>
                                dan transaksi baru tidak bisa masuk hari ini.
                            </p>
                        </div>
                    </div>

                    <div id="endday-print-status"
                        class="hidden mb-4 p-3 rounded text-sm text-center font-medium bg-blue-50 text-blue-700">
                        Mengirim ke printer...
                    </div>
                </div>

                
                <div class="flex items-center justify-end gap-2 px-5 py-3 border-t border-gray-200 bg-gray-50">
                    <button
                        wire:click="cancelEndDay"
                        class="h-9 px-5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-bold rounded transition active:scale-95">
                        ✖ Batal
                    </button>
                    <button
                        id="endday-print-btn"
                        onclick="handleEndDayPrint()"
                        class="h-9 px-5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                        🖨 Cetak & End Day
                    </button>
                </div>
            </div>
        </div>
    </template>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<div
    x-data="{ show: false, message: '' }"
    x-on:endday-error.window="
        message = $event.detail[0]?.message ?? $event.detail.message ?? 'Terjadi kesalahan';
        show = true;
        setTimeout(() => show = false, 5000)
    "
    x-show="show"
    x-transition
    class="fixed bottom-6 right-6 z-50 bg-red-600 text-white text-sm px-5 py-3 rounded-lg shadow-lg max-w-sm"
    style="display:none;">
    <span x-text="message"></span>
</div>


<script>
async function handleEndDayPrint() {
    const btn    = document.getElementById('endday-print-btn');
    const status = document.getElementById('endday-print-status');

    if (!btn) return;

    // Disable tombol supaya tidak diklik dua kali
    btn.disabled = true;
    status.classList.remove('hidden');
    status.textContent = 'Menghubungkan ke printer...';

    try {
        // 1. Ambil printer kasir dari PrinterManager
        const kasirRole = _getKasirRole();
        if (!kasirRole) {
            throw new Error('Printer kasir belum dikonfigurasi.');
        }

        // 2. Pastikan printer siap
        if (!window.PrinterManager?.isPrinterReady(kasirRole)) {
            status.textContent = 'Menyambungkan printer...';
            const reconnected = await window.PrinterManager?.reconnectRole(kasirRole);
            if (!reconnected) {
                throw new Error('Printer kasir tidak bisa terhubung. Pastikan printer menyala dan dekat.');
            }
        }

        // 3. Generate data struk End Day
        status.textContent = 'Mencetak struk...';
        const payload = _getEndDayPayload();
        const receiptData = _buildEndDayReceipt(payload);

        // 4. Kirim ke PrintQueue dan tunggu selesai
        await _printAndWait(kasirRole, receiptData);

        // 5. Print sukses → beritahu Livewire
        status.textContent = '✅ Berhasil! Logging out...';
        status.classList.remove('bg-blue-50', 'text-blue-700');
        status.classList.add('bg-green-50', 'text-green-700');

        // Beri jeda sebentar supaya kasir bisa lihat status
        await new Promise(r => setTimeout(r, 1200));

        Livewire.dispatch('onEndDayPrintSuccess');

    } catch (err) {
        console.error('[EndDay] Print error:', err);
        btn.disabled = false;
        status.classList.remove('hidden', 'bg-blue-50', 'text-blue-700');
        status.classList.add('bg-red-50', 'text-red-700');
        status.textContent = '❌ ' + (err.message || 'Cetak gagal.');

        // Beritahu Livewire gagal → modal ditutup, toast muncul
        Livewire.dispatch('onEndDayPrintFailed', { reason: err.message || '' });
    }
}

/**
 * Ambil payload yang sudah di-dispatch dari Livewire (disimpan sementara di window).
 */
function _getEndDayPayload() {
    return window._endDayPayload || {};
}

/**
 * Cari role printer kasir dari PrinterManager.
 */
function _getKasirRole() {
    const sources = window.PrinterManager?.sources || [];
    const kasirSource = sources.find(s => String(s.type).toLowerCase() === 'kasir');
    return kasirSource ? kasirSource.role : null;
}

/**
 * Build ESC/POS bytes untuk struk End Day.
 * Pakai ReceiptTemplates pattern yang sudah ada di project.
 */
function _buildEndDayReceipt(payload) {
    // Karena ReceiptTemplates.customerCopy butuh format order tertentu,
    // kita pakai raw ESC/POS langsung untuk End Day
    const lines = [];
    const c = payload.closing || {};
    const store = payload.store || {};

    const center = (text, width = 32) => {
        const pad = Math.max(0, Math.floor((width - text.length) / 2));
        return ' '.repeat(pad) + text;
    };
    const line = (left, right, width = 32) => {
        const gap = Math.max(1, width - left.length - right.length);
        return left + ' '.repeat(gap) + right;
    };
    const divider = '-'.repeat(32);

    const encode = (text) => new TextEncoder().encode(text + '\n');

    const ESC = 0x1B;
    const GS  = 0x1D;

    // ESC/POS commands
    const INIT       = new Uint8Array([ESC, 0x40]);
    const ALIGN_C    = new Uint8Array([ESC, 0x61, 0x01]);
    const ALIGN_L    = new Uint8Array([ESC, 0x61, 0x00]);
    const BOLD_ON    = new Uint8Array([ESC, 0x45, 0x01]);
    const BOLD_OFF   = new Uint8Array([ESC, 0x45, 0x00]);
    const SIZE_BIG   = new Uint8Array([GS,  0x21, 0x11]);
    const SIZE_NORM  = new Uint8Array([GS,  0x21, 0x00]);
    const FEED_CUT   = new Uint8Array([ESC, 0x64, 0x05, GS, 0x56, 0x41, 0x10]);

    const fmt = (n) => 'Rp ' + Number(n || 0).toLocaleString('id-ID');

    const chunks = [
        INIT,
        ALIGN_C, SIZE_BIG, BOLD_ON,
        encode(store.name || 'END OF DAY'),
        SIZE_NORM, BOLD_OFF,
        encode(store.address || ''),
        encode(store.phone || ''),
        ALIGN_L,
        encode(divider),
        BOLD_ON, encode('LAPORAN PENUTUPAN HARI'), BOLD_OFF,
        encode(divider),
        encode(line('Tanggal', c.date || '')),
        encode(line('Waktu',   c.time || '')),
        encode(line('Kasir',   c.closed_by || '')),
        encode(line('Outlet',  c.outlet || '')),
        encode(divider),
        BOLD_ON, encode('REKAP PENJUALAN'), BOLD_OFF,
        encode(line('Sales Total',    fmt(c.sales_total))),
        encode(line('Diskon',         fmt(c.discount))),
        encode(line('Service Charge', fmt(c.service_charge))),
        encode(line('Pajak',          fmt(c.tax))),
        encode(line('Void Sales',     fmt(c.void_sales))),
        encode(divider),
        BOLD_ON,
        encode(line('NET SALES', fmt(c.net_sales))),
        encode(line('Jumlah Bill', String(c.total_bills || 0))),
        BOLD_OFF,
        encode(divider),
    ];

    // Payment recaps
    if (Array.isArray(payload.payment_recaps) && payload.payment_recaps.length > 0) {
        chunks.push(BOLD_ON, encode('METODE PEMBAYARAN'), BOLD_OFF);
        payload.payment_recaps.forEach(p => {
            chunks.push(encode(line(p.method || '-', fmt(p.amount))));
        });
        chunks.push(encode(divider));
    }

    chunks.push(
        ALIGN_C,
        encode(''),
        encode('*** END OF DAY ***'),
        encode('Terima kasih'),
        encode(''),
        FEED_CUT
    );

    // Gabungkan semua chunk jadi satu Uint8Array
    const total = chunks.reduce((sum, c) => sum + c.length, 0);
    const result = new Uint8Array(total);
    let offset = 0;
    chunks.forEach(c => { result.set(c, offset); offset += c.length; });

    return result;
}

/**
 * Tambahkan ke PrintQueue dan tunggu sampai job selesai (resolve/reject).
 */
function _printAndWait(printerRole, data) {
    return new Promise((resolve, reject) => {
        // Listen event sukses/gagal dari PrintQueue
        // BARU — sesuai PrintQueue
        const onSuccess = (e) => {
            if (e.detail?.printerRole !== printerRole) return;
            cleanup();
            resolve();
        };
        const onFailed = (e) => {
            if (e.detail?.printerRole !== printerRole) return;
            cleanup();
            reject(new Error(e.detail?.message || 'Print gagal'));
        };
        const cleanup = () => {
            window.removeEventListener('printer-job-success', onSuccess);
            window.removeEventListener('printer-job-failed',  onFailed);
        };

        window.addEventListener('printer-job-success', onSuccess);
        window.addEventListener('printer-job-failed',  onFailed);

        // Timeout 30 detik
        setTimeout(() => {
            cleanup();
            reject(new Error('Timeout: printer tidak merespons dalam 30 detik.'));
        }, 30000);

        window.PrintQueue.add({ printerRole, data });
    });
}

// Tangkap payload dari Livewire dispatch
document.addEventListener('livewire:initialized', () => {
    Livewire.on('endday-trigger-print', (data) => {
        window._endDayPayload = Array.isArray(data) ? data[0] : (data?.payload ?? data);
    });
});
</script>
</div>

<?php /**PATH D:\farhan\projects\freelance\pos-restoran-v2\resources\views/components/day-start-end/day-start-end-page.blade.php ENDPATH**/ ?>