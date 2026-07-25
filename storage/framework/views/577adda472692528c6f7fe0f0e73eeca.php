<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['cancelledTables' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['cancelledTables' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cancelledTables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr
                        class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="text-gray-600 text-theme-xs dark:text-gray-400">
                                <?php echo e($row['voided_at']); ?>

                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                <?php echo e($row['cashier']); ?>

                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="font-mono text-xs text-gray-700 dark:text-gray-300">
                                <?php echo e($row['transaction_code']); ?>

                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <span
                                class="inline-flex items-center gap-1 rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 dark:bg-red-500/10 dark:text-red-400">
                                <?php echo e($row['table_number'] ?? 'Quick Service'); ?>

                            </span>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="text-gray-700 text-theme-xs dark:text-gray-300">
                                <?php echo e($row['approved_by'] ?? '-'); ?>

                            </p>
                        </td>
                        <td class="py-3 pr-4">
                            <p class="text-gray-600 text-theme-xs dark:text-gray-400 italic max-w-[200px] truncate"
                                title="<?php echo e($row['void_reason']); ?>">
                                "<?php echo e($row['void_reason']); ?>"
                            </p>
                        </td>
                        <td class="py-3 text-right whitespace-nowrap">
                            <p class="font-semibold text-gray-800 text-theme-sm dark:text-white/90">
                                Rp<?php echo e(number_format($row['total'], 0, ',', '.')); ?>

                            </p>
                        </td>
                        <td class="py-3 text-center">
                            <a href="<?php echo e(route('transactions.cancel-detail', $row['transaction_id'])); ?>"
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr class="border-t border-gray-100 dark:border-gray-800">
                        <td colspan="8" class="py-6">
                            <p class="text-center text-theme-sm text-gray-500 dark:text-gray-400">
                                Tidak ada cancel table dalam periode ini.
                            </p>
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH D:\Shaall\PROJECT\pos-project\resources\views/components/ecommerce/cancel-table-history.blade.php ENDPATH**/ ?>