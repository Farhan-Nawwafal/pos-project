<div class="px-4 py-6 max-w-3xl mx-auto space-y-6">

    
    <div>
        <a href="<?php echo e(route('transactions.index')); ?>"
            class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Riwayat Transaksi
        </a>
    </div>

    
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between bg-[#DD4B39] px-6 py-4">
            <div>
                <h1 class="text-base font-bold text-white tracking-wide">Detail Cancel Table</h1>
                <p class="text-red-100 text-xs mt-0.5 font-mono"><?php echo e($transaction->code); ?></p>
            </div>
            <span class="rounded-full bg-white/20 px-3 py-1 text-xs font-bold text-white uppercase tracking-wider">
                VOID
            </span>
        </div>

        
        <div
            class="grid grid-cols-2 gap-4 px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/40 sm:grid-cols-3">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">No. Meja</p>
                <p class="text-sm font-bold text-gray-800 dark:text-white mt-1">
                    <?php echo e($transaction->diningTable?->table_number ?? 'Quick Service'); ?>

                </p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Waktu Void</p>
                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                    <?php echo e($transaction->voided_at?->format('d/m/Y H:i') ?? '-'); ?>

                </p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kasir</p>
                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1"><?php echo e($cashierName); ?></p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Disetujui Oleh</p>
                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1"><?php echo e($approvedBy); ?></p>
            </div>
            <div class="col-span-2 sm:col-span-2">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Alasan Pembatalan</p>
                <p class="text-sm text-red-600 dark:text-red-400 italic mt-1">"<?php echo e($transaction->void_reason); ?>"</p>
            </div>
        </div>
    </div>

    
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
            <h2 class="text-sm font-bold text-gray-800 dark:text-white">Item yang Di-void</h2>
        </div>

        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/40">
                        <th class="text-left px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Produk
                        </th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Qty
                        </th>
                        <th class="text-right px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Harga
                        </th>
                        <th class="text-right px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-3">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white"><?php echo e($item['name']); ?></p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['variant']): ?>
                                    <p class="text-xs text-gray-500 mt-0.5"><?php echo e($item['variant']); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($item['qty']); ?></span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    Rp<?php echo e(number_format($item['price'], 0, ',', '.')); ?>

                                </span>
                            </td>
                            <td class="px-6 py-3 text-right">
                                <span class="text-sm font-semibold text-gray-800 dark:text-white">
                                    Rp<?php echo e(number_format($item['subtotal'], 0, ',', '.')); ?>

                                </span>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                Tidak ada data item.
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div
            class="flex items-center justify-between px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/40">
            <p class="text-sm font-bold text-gray-700 dark:text-gray-300">Total Bill</p>
            <p class="text-xl font-black text-[#DD4B39]">
                Rp<?php echo e(number_format((int) $transaction->total, 0, ',', '.')); ?>

            </p>
        </div>
    </div>

</div>
<?php /**PATH D:\farhan\projects\freelance\pos-restoran-v2\resources\views/livewire/transactions/cancel-table-detail-page.blade.php ENDPATH**/ ?>