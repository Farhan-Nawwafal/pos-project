<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'showClose' => true,
]));

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

foreach (array_filter(([
    'title' => '',
    'showClose' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<<<<<<<< HEAD:storage/framework/views/a9d69b6eeaa3e6bb88684819437fb73e.php
<tr>
    <td colspan="<?php echo e((int) $colspan); ?>" class="px-5 py-10">
        <p class="text-center text-sm text-gray-500 dark:text-gray-400"><?php echo e($message); ?></p>
    </td>
</tr>
<?php /**PATH D:\POS PROJECT FINAL\pos-project\resources\views/components/common/empty-table-row.blade.php ENDPATH**/ ?>
========
<div x-show="open" x-cloak class="fixed inset-0 px-4 z-[70] flex items-center justify-center sm:items-center sm:p-4">
    <div class="absolute inset-0 bg-black/50" @click="<?php echo e($showClose ? 'open = false' : ''); ?>"></div>
    <div class="relative w-full overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl max-w-sm sm:rounded-2xl">
        <div class="p-5">
            <?php echo e($slot); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\components\modal.blade.php ENDPATH**/ ?>
>>>>>>>> 77fab1855109285eb057b892225d4a691dd8446b:storage/framework/views/b28d22a8a83fc3799285e6b0f285b57a.php
