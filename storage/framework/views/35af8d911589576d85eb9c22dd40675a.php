<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'colspan' => 1,
    'message' => 'Tidak ada data.',
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
    'colspan' => 1,
    'message' => 'Tidak ada data.',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<tr>
    <td colspan="<?php echo e((int) $colspan); ?>" class="px-5 py-10">
        <p class="text-center text-sm text-gray-500 dark:text-gray-400"><?php echo e($message); ?></p>
    </td>
</tr>
<<<<<<<< HEAD:storage/framework/views/35af8d911589576d85eb9c22dd40675a.php
<?php /**PATH D:\farhan\projects\project-freelance\pos-restoran-v2\resources\views/components/common/empty-table-row.blade.php ENDPATH**/ ?>
========
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\components\common\empty-table-row.blade.php ENDPATH**/ ?>
>>>>>>>> 77fab1855109285eb057b892225d4a691dd8446b:storage/framework/views/0686d7c8cf671670f85bc5d210a91d5c.php
