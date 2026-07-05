<div class="flex min-h-screen flex-col font-poppins bg-gray-50 pb-10">
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('self-order.components.page-title-nav', ['title' => 'Detail Transaksi','hasBack' => true,'backTransactions' => true,'hasFilter' => false]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-121370769-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    <div class="container mx-auto px-4 mt-4 space-y-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $transaction): ?>
            <div class="bg-white border border-gray-200 rounded-2xl p-4">
                <div class="text-sm font-semibold text-gray-900">Transaksi tidak ditemukan</div>
                <div class="text-xs text-gray-600 mt-1">Silakan kembali ke riwayat transaksi.</div>
            </div>
        <?php else: ?>
            <div class="rounded-2xl bg-white border border-gray-100 p-4 shadow-sm space-y-2">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="text-sm font-bold text-gray-900"><?php echo e((string) $transaction->code); ?></div>
                        <div class="text-xs text-gray-500 mt-1">
                            <?php echo e(optional($transaction->created_at)->format('d/m/Y H:i')); ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->diningTable): ?>
                                <span class="mx-1">•</span>
                                Meja #<?php echo e((string) $transaction->diningTable->table_number); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="shrink-0 text-right">
                        <div class="text-xs text-gray-500">Total</div>
                        <div class="text-sm font-bold text-primary-60">
                            Rp <?php echo e(number_format((int) ($transaction->total ?? 0), 0, ',', '.')); ?>

                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-2">
                    <div class="rounded-xl bg-gray-50 border border-gray-200 p-3">
                        <div class="text-[10px] text-gray-500">Status Pembayaran</div>
                        <div class="text-xs font-bold text-gray-900 mt-1"><?php echo e(\App\Helpers\DataLabelHelper::enum($transaction->payment_status ?? null, 'payment_status')); ?></div>
                    </div>
                    <div class="rounded-xl bg-gray-50 border border-gray-200 p-3">
                        <div class="text-[10px] text-gray-500">Metode Bayar</div>
                        <div class="text-xs font-bold text-gray-900 mt-1"><?php echo e(\App\Helpers\DataLabelHelper::enum($transaction->payment_method ?? null, 'payment_method')); ?></div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white border border-gray-100 p-4 shadow-sm">
                <div class="text-sm font-bold text-gray-900">Item</div>

                <div class="mt-3 space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $transaction->transactionItems->whereNull('parent_transaction_item_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="border-b border-gray-100 pb-3 last:border-b-0 last:pb-0">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="text-sm font-semibold text-gray-900 truncate">
                                        <?php echo e((string) ($item->product?->name ?? '')); ?>

                                        <?php
                                            $variantDisplay = \App\Support\Products\ItemNameFormatter::displayVariantName((int) $item->product_id, $item->variant?->name);
                                        ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($variantDisplay !== ''): ?>
                                            <span class="text-xs text-gray-500">- <?php echo e($variantDisplay); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_string($item->note) && trim($item->note) !== ''): ?>
                                        <div class="text-xs text-gray-500 mt-1">Catatan: <?php echo e((string) $item->note); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="shrink-0 text-right">
                                    <div class="text-xs text-gray-500">x<?php echo e((int) ($item->quantity ?? 0)); ?></div>
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp <?php echo e(number_format((int) ($item->subtotal ?? 0), 0, ',', '.')); ?>

                                    </div>
                                </div>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->childTransactionItems && $item->childTransactionItems->count() > 0): ?>
                                <div class="mt-2 space-y-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $item->childTransactionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="flex items-start justify-between gap-3 pl-4">
                                            <div class="min-w-0">
                                                <div class="text-xs font-semibold text-gray-700 truncate">
                                                    <?php echo e((string) ($child->product?->name ?? '')); ?>

                                                    <?php
                                                        $childVariantDisplay = \App\Support\Products\ItemNameFormatter::displayVariantName((int) $child->product_id, $child->variant?->name);
                                                    ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($childVariantDisplay !== ''): ?>
                                                        <span class="text-[11px] text-gray-500">- <?php echo e($childVariantDisplay); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="shrink-0 text-right">
                                                <div class="text-[11px] text-gray-500">x<?php echo e((int) ($child->quantity ?? 0)); ?></div>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <div class="rounded-2xl bg-white border border-gray-100 p-4 shadow-sm space-y-2">
                <div class="text-sm font-bold text-gray-900">Ringkasan</div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Subtotal</div>
                    <div class="font-semibold text-gray-900">Rp <?php echo e(number_format((int) ($transaction->subtotal ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Diskon Voucher</div>
                    <div class="font-semibold text-gray-900">Rp <?php echo e(number_format((int) ($transaction->voucher_discount_amount ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Diskon Manual</div>
                    <div class="font-semibold text-gray-900">Rp <?php echo e(number_format((int) ($transaction->manual_discount_amount ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Diskon Poin</div>
                    <div class="font-semibold text-gray-900">Rp <?php echo e(number_format((int) ($transaction->point_discount_amount ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Poin Dipakai</div>
                    <div class="font-semibold text-gray-900"><?php echo e(number_format((int) ($transaction->points_redeemed ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Poin Didapat</div>
                    <div class="font-semibold text-gray-900"><?php echo e(number_format((int) ($transaction->points_earned ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Pajak</div>
                    <div class="font-semibold text-gray-900">Rp <?php echo e(number_format((int) ($transaction->tax_amount ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Biaya</div>
                    <div class="font-semibold text-gray-900">Rp <?php echo e(number_format((int) ($transaction->payment_fee_amount ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="text-gray-600">Pembulatan</div>
                    <div class="font-semibold text-gray-900">Rp <?php echo e(number_format((int) ($transaction->rounding_amount ?? 0), 0, ',', '.')); ?></div>
                </div>

                <div class="pt-2 border-t border-gray-100 flex items-center justify-between">
                    <div class="text-sm font-bold text-gray-900">Total</div>
                    <div class="text-sm font-bold text-primary-60">Rp <?php echo e(number_format((int) ($transaction->total ?? 0), 0, ',', '.')); ?></div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\self-order\members\transaction-show.blade.php ENDPATH**/ ?>