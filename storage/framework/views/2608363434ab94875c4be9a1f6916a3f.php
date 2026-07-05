<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['message']));

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

foreach (array_filter((['message']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="bg-white/[2%] border border-neutral-200 dark:border-neutral-800 rounded-md w-full p-5 uppercase text-sm text-center font-mono shadow-xs text-neutral-600 dark:text-neutral-400">
    <span class="text-neutral-400 dark:text-neutral-600">// </span><?php echo e($message); ?>

</div>
<<<<<<<< HEAD:storage/framework/views/b4e736e801efe890135fe405ab003b28.php
<?php /**PATH D:\POS PROJECT FINAL\pos-project\vendor\laravel\framework\src\Illuminate\Foundation\Providers/../resources/exceptions/renderer/components/empty-state.blade.php ENDPATH**/ ?>
========
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\vendor\laravel\framework\src\Illuminate\Foundation\resources\exceptions\renderer\components\empty-state.blade.php ENDPATH**/ ?>
>>>>>>>> 77fab1855109285eb057b892225d4a691dd8446b:storage/framework/views/2608363434ab94875c4be9a1f6916a3f.php
