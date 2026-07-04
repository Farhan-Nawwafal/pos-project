<?php
    $fmtCurrency = fn ($value) => 'Rp'.number_format((float) $value, 0, ',', '.');
?>

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">Laporan Persediaan</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Ringkasan stok dan nilai persediaan per bahan baku.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4 md:gap-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Total Nilai Persediaan</p>
            <h4 class="mt-3 text-2xl font-bold text-gray-800 dark:text-white/90"><?php echo e($fmtCurrency((float) ($summary['valueTotal'] ?? 0))); ?></h4>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Coverage Unit Cost</p>
            <h4 class="mt-3 text-2xl font-bold text-gray-800 dark:text-white/90"><?php echo e(number_format((float) ($summary['coveragePercent'] ?? 0), 1, ',', '.')); ?>%</h4>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                <?php echo e(number_format((int) ($summary['movementCostLines'] ?? 0), 0, ',', '.')); ?>/<?php echo e(number_format((int) ($summary['movementLines'] ?? 0), 0, ',', '.')); ?> baris
            </p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Stok Paling Sedikit</p>
            <div class="mt-3 space-y-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = ($lowestStocks ?? collect())->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $stock = (float) ($row->stock_on_hand ?? 0);
                        $unit = (string) ($row->unit ?? '');
                    ?>
                    <div class="flex items-center justify-between gap-3">
                        <p class="min-w-0 truncate text-sm font-semibold text-gray-800 dark:text-white/90"><?php echo e((string) ($row->name ?? '')); ?></p>
                        <p class="whitespace-nowrap text-sm font-semibold text-error-700 dark:text-error-400">
                            <?php echo e(\App\Support\Number\QuantityFormatter::format($stock)); ?><?php echo e($unit !== '' ? ' '.$unit : ''); ?>

                        </p>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <p class="text-sm font-semibold text-gray-800 dark:text-white/90">-</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Stok Paling Banyak</p>
            <div class="mt-3 space-y-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = ($highestStocks ?? collect())->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $stock = (float) ($row->stock_on_hand ?? 0);
                        $unit = (string) ($row->unit ?? '');
                    ?>
                    <div class="flex items-center justify-between gap-3">
                        <p class="min-w-0 truncate text-sm font-semibold text-gray-800 dark:text-white/90"><?php echo e((string) ($row->name ?? '')); ?></p>
                        <p class="whitespace-nowrap text-sm font-semibold text-success-700 dark:text-success-400">
                            <?php echo e(\App\Support\Number\QuantityFormatter::format($stock)); ?><?php echo e($unit !== '' ? ' '.$unit : ''); ?>

                        </p>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <p class="text-sm font-semibold text-gray-800 dark:text-white/90">-</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex flex-col justify-between gap-4 border-b border-gray-200 px-5 py-4 sm:flex-row sm:items-center dark:border-gray-800">
            <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                <div class="relative flex-1 sm:flex-none">
                    <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z" fill="" />
                        </svg>
                    </span>
                    <input wire:model.live.debounce.400ms="search" type="text" placeholder="Cari bahan..." class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden sm:w-[320px] sm:min-w-[320px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                    <input wire:model.live="includeZero" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900" />
                    Tampilkan stok 0
                </label>
            </div>
            <a
                href="<?php echo e(route('inventory-reports.valuation.excel', ['includeZero' => (bool) ($includeZero ?? true), 'search' => (string) ($search ?? '')])); ?>"
                class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]"
            >
                Export Excel
            </a>
        </div>

        <div class="custom-scrollbar overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bahan</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Unit</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Stok</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">HPP/Unit</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Nilai Persediaan</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Avg HPP</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $stock = (float) ($row->stock_on_hand ?? 0);
                            $value = (float) ($row->stock_value ?? 0);
                            $unit = (string) ($row->unit ?? '');
                            $cost = (float) ($row->cost_price ?? 0);
                            $avg = abs($stock) >= 0.0005 ? ($value / $stock) : null;
                            $movementLines = (int) ($row->movement_lines ?? 0);
                            $movementCostLines = (int) ($row->movement_cost_lines ?? 0);
                            $coverage = $movementLines > 0 ? ($movementCostLines / $movementLines) * 100 : 100.0;
                        ?>
                        <tr>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90"><?php echo e((string) ($row->name ?? '')); ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e((string) ($row->sku ?? '')); ?></p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($coverage < 99.9): ?>
                                    <p class="mt-1 text-xs font-medium text-warning-700 dark:text-warning-400">Ada movement tanpa unit cost</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($unit); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white/90"><?php echo e(\App\Support\Number\QuantityFormatter::format($stock)); ?><?php echo e($unit !== '' ? ' '.$unit : ''); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($fmtCurrency($cost)); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white/90"><?php echo e($fmtCurrency($value)); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($avg === null ? '-' : $fmtCurrency($avg)); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <a href="<?php echo e(route('inventory-reports.stock-card', ['ingredientId' => (int) $row->id])); ?>" wire:navigate class="shadow-theme-xs inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                    Kartu Stok
                                </a>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal8333c7520247d01ca05cd625bf80e31f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8333c7520247d01ca05cd625bf80e31f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.empty-table-row','data' => ['colspan' => '7','message' => 'Belum ada data.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.empty-table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => '7','message' => 'Belum ada data.']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8333c7520247d01ca05cd625bf80e31f)): ?>
<?php $attributes = $__attributesOriginal8333c7520247d01ca05cd625bf80e31f; ?>
<?php unset($__attributesOriginal8333c7520247d01ca05cd625bf80e31f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8333c7520247d01ca05cd625bf80e31f)): ?>
<?php $component = $__componentOriginal8333c7520247d01ca05cd625bf80e31f; ?>
<?php unset($__componentOriginal8333c7520247d01ca05cd625bf80e31f); ?>
<?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
            <?php echo e($ingredients->links('livewire.pagination.admin')); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\inventory\inventory-valuation-page.blade.php ENDPATH**/ ?>