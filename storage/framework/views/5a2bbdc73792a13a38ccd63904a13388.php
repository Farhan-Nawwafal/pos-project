<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'deletedAmount' => 0,
    'voidItemAmount' => 0,
    'voidAmount' => 0,
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
    'deletedAmount' => 0,
    'voidItemAmount' => 0,
    'voidAmount' => 0,
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


<div
    class="rounded-3xl border border-gray-200 bg-white/50 p-4 md:p-6 dark:border-gray-800 dark:bg-gray-900/50 backdrop-blur-sm shadow-sm">
    <div class="space-y-4">
        
        <div
            class="rounded-2xl border border-error-100 bg-error-50/10 p-4 md:p-5 dark:border-error-900/20 dark:bg-error-900/5">
            
            <div class="flex items-center gap-2 mb-5 border-b border-error-100 dark:border-error-900/20 pb-3">
                <svg class="w-5 h-5 text-error-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p class="text-xs font-black text-error-700 dark:text-error-400 uppercase tracking-tighter">Audit
                    Potensi Fraud</p>
            </div>

            
            <div class="flex flex-col gap-3">

                
                <div
                    class="flex items-center justify-between p-4 rounded-xl bg-white dark:bg-gray-900 border border-error-50 dark:border-gray-800 shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Reduksi Qty</p>
                        <p class="text-[9px] text-gray-400 mt-0.5">Item dikurangi</p>
                    </div>
                    <h4 class="text-base font-black text-orange-600 tabular-nums">
                        -Rp<?php echo e(number_format((int) $deletedAmount, 0, ',', '.')); ?>

                    </h4>
                </div>

                
                <div
                    class="flex items-center justify-between p-4 rounded-xl bg-white dark:bg-gray-900 border border-error-50 dark:border-gray-800 shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Void Menu</p>
                        <p class="text-[9px] text-gray-400 mt-0.5">Satu baris dihapus</p>
                    </div>
                    <h4 class="text-base font-black text-red-500 tabular-nums">
                        -Rp<?php echo e(number_format((int) $voidItemAmount, 0, ',', '.')); ?>

                    </h4>
                </div>

                
                <div
                    class="flex items-center justify-between p-4 rounded-xl bg-white dark:bg-gray-900 border border-error-100 dark:border-gray-800 shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Void Total Bill</p>
                        <p class="text-[9px] text-gray-400 mt-0.5">Satu nota dibatalkan</p>
                    </div>
                    <h4 class="text-base font-black text-red-700 tabular-nums">
                        -Rp<?php echo e(number_format((int) $voidAmount, 0, ',', '.')); ?>

                    </h4>
                </div>

            </div>

            
            <p class="mt-4 text-[9px] text-gray-400 italic leading-tight px-1">
                *Data ini memantau aktivitas penghapusan item setelah pesanan tersimpan di sistem.
            </p>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\components\ecommerce\metric-summary.blade.php ENDPATH**/ ?>