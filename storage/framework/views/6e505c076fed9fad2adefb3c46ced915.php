<?php $__env->startComponent('layouts.self-order'); ?>
    <style>
        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }
            html, body {
                width: 80mm;
                margin: 0;
                padding: 0;
                background: #ffffff;
            }
            #receipt-paper {
                width: 80mm;
                max-width: 80mm;
                margin: 0 auto;
            }
            .receipt-card {
                border: none;
                border-radius: 0;
                box-shadow: none;
                background: #ffffff;
            }
            .receipt-header {
                background: #ffffff;
                color: #000000;
                padding: 8px 12px;
            }
            .receipt-header h1,
            .receipt-header p {
                color: #000000;
            }
            .receipt-body {
                padding: 8px 12px;
                color: #000000;
            }
            .receipt-muted {
                color: #4b5563;
            }
            .receipt-item {
                background: transparent;
                padding: 6px 0;
                border-radius: 0;
            }
            .receipt-total {
                color: #000000;
            }
        }
    </style>
    <div class="min-h-screen bg-gray-50 font-poppins flex items-center justify-center p-4 print:bg-white print:p-0 print:min-h-0">
    <div id="receipt-paper" class="w-full max-w-md print:max-w-none print:w-[80mm]">
        <div class="rounded-3xl overflow-hidden bg-white shadow-sm border border-gray-200 receipt-card">
            <div class="text-center p-6 bg-primary-60 receipt-header">
                <h1 class="text-2xl font-bold text-white print:text-black">Struk Pembayaran</h1>
                <p class="text-sm text-white/80 print:text-black">Terima kasih atas pesanan Anda!</p>
            </div>

            <!-- Transaction Info -->
            <div class="p-6 space-y-4 receipt-body">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500 receipt-muted">Kode Transaksi</p>
                        <p class="font-semibold text-gray-900"><?php echo e($transaction->code); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 receipt-muted">Tanggal</p>
                        <p class="font-semibold text-gray-900"><?php echo e($transaction->updated_at->format('d/m/Y H:i')); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-500 receipt-muted">Nama Pelanggan</p>
                        <p class="font-semibold text-gray-900"><?php echo e($transaction->name); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 receipt-muted">Nomor Meja</p>
                        <p class="font-semibold text-gray-900"><?php echo e(optional($transaction->diningTable)->table_number ?? '-'); ?></p>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-dashed border-gray-200"></div>

                <!-- Order Items -->
                <div>
                    <h2 class="font-semibold text-gray-900 mb-2 receipt-total">Detail Pesanan</h2>
                    <ul class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $transaction->transactionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <li class="flex items-start justify-between text-sm p-3 rounded-lg bg-gray-50 receipt-item">
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-800"><?php echo e($it->quantity); ?>x <?php echo e(optional($it->product)->name); ?></p>
                                    <?php
                                        $variantDisplay = \App\Support\Products\ItemNameFormatter::displayVariantName((int) $it->product_id, $it->variant?->name);
                                    ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($variantDisplay !== ''): ?>
                                        <p class="text-xs text-gray-500 receipt-muted">(<?php echo e($variantDisplay); ?>)</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="font-medium text-gray-800 whitespace-nowrap">
                                    Rp<?php echo e(number_format($it->subtotal, 0, ',', '.')); ?>

                                </div>
                            </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                </div>

                <!-- Divider -->
                <div class="border-t border-dashed border-gray-200"></div>

                <!-- Totals -->
                <div class="space-y-2 text-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-gray-600 receipt-muted">Subtotal</p>
                        <p class="font-semibold text-gray-900">Rp<?php echo e(number_format($transaction->subtotal, 0, ',', '.')); ?></p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->voucher_discount_amount > 0): ?>
                    <div class="flex items-center justify-between text-success-600">
                        <p class="receipt-muted">Diskon Voucher<?php echo e(! empty($transaction->voucher_code) ? ' ('.$transaction->voucher_code.')' : ''); ?></p>
                        <p class="font-semibold">-Rp<?php echo e(number_format($transaction->voucher_discount_amount, 0, ',', '.')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->manual_discount_amount > 0): ?>
                    <div class="flex items-center justify-between text-success-600">
                        <p class="receipt-muted">Diskon Manual</p>
                        <p class="font-semibold">-Rp<?php echo e(number_format($transaction->manual_discount_amount, 0, ',', '.')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->point_discount_amount > 0): ?>
                    <div class="flex items-center justify-between text-success-600">
                        <p class="receipt-muted">Diskon Poin (<?php echo e(number_format($transaction->points_redeemed, 0, ',', '.')); ?> Poin)</p>
                        <p class="font-semibold">-Rp<?php echo e(number_format($transaction->point_discount_amount, 0, ',', '.')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->tax_amount > 0): ?>
                    <div class="flex items-center justify-between">
                        <p class="text-gray-600 receipt-muted">Pajak PB1 (<?php echo e($transaction->tax_percentage); ?>%)</p>
                        <p class="font-semibold text-gray-900">Rp<?php echo e(number_format($transaction->tax_amount, 0, ',', '.')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($transaction->payment_fee_amount ?? 0) > 0): ?>
                    <div class="flex items-center justify-between">
                        <p class="text-gray-600 receipt-muted">Biaya Admin</p>
                        <p class="font-semibold text-gray-900">Rp<?php echo e(number_format($transaction->payment_fee_amount, 0, ',', '.')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->rounding_amount != 0): ?>
                    <div class="flex items-center justify-between">
                        <p class="text-gray-600 receipt-muted">Pembulatan</p>
                        <p class="font-semibold text-gray-900">Rp<?php echo e(number_format($transaction->rounding_amount, 0, ',', '.')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="flex items-center justify-between text-base">
                        <p class="font-bold text-gray-900 receipt-total">Total</p>
                        <p class="font-bold text-primary-60 receipt-total">Rp<?php echo e(number_format($transaction->total, 0, ',', '.')); ?></p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->points_earned > 0): ?>
                    <div class="mt-2 flex items-center justify-center rounded-lg bg-green-50 p-2 text-center text-sm font-medium text-green-700">
                        Anda mendapatkan <?php echo e(number_format($transaction->points_earned, 0, ',', '.')); ?> Poin dari transaksi ini!
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex items-center justify-center gap-4 print:hidden">
            <a href="<?php echo e(route('self-order.scan')); ?>" wire:navigate class="rounded-full px-6 py-3 text-sm font-bold text-gray-700 bg-white border-2 border-gray-200 hover:bg-gray-50">
                Kembali
            </a>
            <button onclick="window.print()" class="rounded-full bg-primary-60 text-white px-8 py-3 text-sm font-bold shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                Cetak / Unduh
            </button>
        </div>
    </div>
</div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\self-order\payment\receipt.blade.php ENDPATH**/ ?>