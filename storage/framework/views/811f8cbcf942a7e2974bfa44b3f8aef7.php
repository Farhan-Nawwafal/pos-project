<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'for',
    'bag' => null,
    'id' => null,
    'class' => 'mt-1 text-xs text-error-600',
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
    'for',
    'bag' => null,
    'id' => null,
    'class' => 'mt-1 text-xs text-error-600',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $key = (string) $for;
    $errorId = $id ? (string) $id : ('error-' . preg_replace('/[^a-zA-Z0-9\-_]+/', '-', $key));
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = [$key, $bag];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p id="<?php echo e($errorId); ?>" class="<?php echo e($class); ?>" role="alert"><?php echo e($message); ?></p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<<<<<<<< HEAD:storage/framework/views/64584bd1876da745aab14733b40efb61.php
<?php /**PATH D:\farhan\projects\project-freelance\pos-restoran-v2\resources\views/components/common/input-error.blade.php ENDPATH**/ ?>
========
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\components\common\input-error.blade.php ENDPATH**/ ?>
>>>>>>>> 77fab1855109285eb057b892225d4a691dd8446b:storage/framework/views/811f8cbcf942a7e2974bfa44b3f8aef7.php
