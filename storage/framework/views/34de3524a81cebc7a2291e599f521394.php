<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['transactions' => []]));

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

foreach (array_filter((['transactions' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $rows = $transactions ?? [];

    $getStatusClasses = function (string $status) {
        $base = 'rounded-full px-2 py-0.5 text-theme-xs font-medium';

        return match ($status) {
            'paid' => $base . ' bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500',
            'pending' => $base . ' bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400',
            default => $base . ' bg-gray-50 text-gray-600 dark:bg-gray-500/15 dark:text-gray-400',
        };
    };
?>
<div x-data x-show="$store.sidebar.isEsbModalOpen" class="fixed inset-0 z-[50000]" x-cloak>
    <div @click="$store.sidebar.isEsbModalOpen = false" class="fixed inset-0 bg-black/20 z-[49999]"></div>

    <div class="fixed top-0 right-0 h-full w-full max-w-[70%] bg-white shadow-2xl p-3 z-[50000] border-l flex flex-col"
        x-show="$store.sidebar.isEsbModalOpen" x-transition:enter="transition-transform duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0">

        <div class="flex justify-between items-center mb-4 border-b pb-4">
            <h2 class="text-sm font-bold">ESB Order Report</h2>
            <button @click="$store.sidebar.isEsbModalOpen = false" class="text-gray-500"><i
                    class="bi bi-x-lg"></i></button>
        </div>

        <div class="flex-1 overflow-y-auto">
            <table class="w-full text-left">
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="border-t text-xs">
                            <td class="p-3"><?php echo e($row['code'] ?? '-'); ?></td>
                            <td class="p-3"><?php echo e($row['customer'] ?? '-'); ?></td>
                            <td class="p-3 text-right"><?php echo e($row['total'] ?? '-'); ?></td>
                            <td class="p-3 text-center">
                                <span class="<?php echo e($getStatusClasses(strtolower($row['payment_status'] ?? ''))); ?>">
                                    <?php echo e($row['payment_status'] ?? '-'); ?>

                                </span>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="4" class="py-10 text-center">No Data Available</td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH D:\farhan\projects\project-freelance\pos-restoran-v2\resources\views/livewire/transactions/esb-order-modal.blade.php ENDPATH**/ ?>