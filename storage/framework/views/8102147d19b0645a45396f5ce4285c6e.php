<div class="flex min-h-screen flex-col font-poppins bg-gray-50 pb-10">
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('self-order.components.page-title-nav', ['title' => 'Riwayat Transaksi','hasBack' => true,'hasFilter' => false]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4115523221-0', $__key);

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

    <div class="container mx-auto px-4 mt-4 space-y-3">
        <?php $transactions = $this->transactions; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transactions->isEmpty()): ?>
            <div class="bg-white border border-gray-200 rounded-2xl p-4">
                <div class="text-sm font-semibold text-gray-900">Belum ada transaksi</div>
                <div class="text-xs text-gray-600 mt-1">Riwayat transaksi member akan tampil di sini.</div>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a
                        wire:navigate
                        href="<?php echo e(route('self-order.member.transactions.show', ['transaction' => $trx->id])); ?>"
                        class="block rounded-2xl bg-white border border-gray-100 p-4 shadow-sm hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="text-sm font-bold text-gray-900 truncate"><?php echo e((string) $trx->code); ?></div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <?php echo e(optional($trx->created_at)->format('d/m/Y H:i')); ?>

                                    <span class="mx-1">•</span>
                                    <?php echo e(\App\Helpers\DataLabelHelper::enum($trx->channel ?? null, 'channel')); ?>

                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    Bayar: <?php echo e(\App\Helpers\DataLabelHelper::enum($trx->payment_status ?? null, 'payment_status')); ?>

                                </div>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((int) ($trx->points_earned ?? 0) > 0 || (int) ($trx->points_redeemed ?? 0) > 0): ?>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((int) ($trx->points_earned ?? 0) > 0): ?>
                                            <span>Poin +<?php echo e(number_format((int) $trx->points_earned, 0, ',', '.')); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((int) ($trx->points_earned ?? 0) > 0 && (int) ($trx->points_redeemed ?? 0) > 0): ?>
                                            <span class="mx-1">•</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((int) ($trx->points_redeemed ?? 0) > 0): ?>
                                            <span>Poin -<?php echo e(number_format((int) $trx->points_redeemed, 0, ',', '.')); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="shrink-0 text-right">
                                <div class="text-xs text-gray-500">Total</div>
                                <div class="text-sm font-bold text-primary-60">
                                    Rp <?php echo e(number_format((int) ($trx->total ?? 0), 0, ',', '.')); ?>

                                </div>
                            </div>
                        </div>
                    </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div class="pt-2">
                <?php echo e($transactions->links('livewire.pagination.self-order')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\self-order\members\transactions.blade.php ENDPATH**/ ?>