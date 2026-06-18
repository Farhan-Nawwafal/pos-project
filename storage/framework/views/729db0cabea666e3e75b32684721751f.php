<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'transactions' => 0,
    'transactionsDeltaPercent' => 0,
    'transactionsDeltaUp' => true,
    'revenueAmount' => 0,
    'grossAmount' => 0,
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
    'transactions' => 0,
    'transactionsDeltaPercent' => 0,
    'transactionsDeltaUp' => true,
    'revenueAmount' => 0,
    'grossAmount' => 0,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $transactionsDelta = (float) ($transactionsDeltaPercent ?? 0);
    $transactionsDeltaUp = (bool) ($transactionsDeltaUp ?? true);
    $transactionsDeltaText = rtrim(rtrim(number_format(abs($transactionsDelta), 2, '.', ''), '0'), '.') . '%';
?>



<div class="grid grid-cols-1 gap-4 sm:grid-cols-12 md:gap-6">
    <div class="sm:col-span-4 rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-theme-sm text-gray-500 dark:text-gray-400">Transaksi Hari Ini</p>
        <div class="mt-3 flex flex-col items-start gap-2 lg:flex-row lg:items-end lg:justify-between">
            <h4 class="text-title-sm font-bold text-gray-800 dark:text-white/90">
                <?php echo e(number_format((int) $transactions, 0, ',', '.')); ?>

            </h4>
            <div class="flex items-center gap-1">
                <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'text-theme-xs flex items-center gap-1 rounded-full px-2 py-0.5 font-medium',
                    'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500' => $transactionsDeltaUp,
                    'bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500' => !$transactionsDeltaUp,
                ]); ?>">
                    <?php echo e($transactionsDeltaUp ? '+' : '-'); ?><?php echo e($transactionsDeltaText); ?>

                </span>
            </div>
        </div>
    </div>

    <div class="sm:col-span-8 rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between">
            <p class="text-theme-sm text-gray-500 dark:text-gray-400 font-medium">Omzet Hari Ini</p>
        </div>
        <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div class="rounded-xl bg-gray-50/50 p-3 dark:bg-gray-900/50">
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Gross Sales</p>
                <h4 class="text-xl font-black text-gray-800 dark:text-white/90 mt-1">Rp<?php echo e(number_format((int) $grossAmount, 0, ',', '.')); ?></h4>
            </div>
            <div class="rounded-xl bg-gray-50/50 p-3 dark:bg-gray-900/50">
                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Net Sales</p>
                <h4 class="text-xl font-black text-gray-800 dark:text-white/90 mt-1">Rp<?php echo e(number_format((int) $revenueAmount, 0, ',', '.')); ?></h4>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Shaall\PROJECT\pos-project\resources\views/components/ecommerce/ecommerce-metrics.blade.php ENDPATH**/ ?>