<?php
    $fmtCurrency = fn ($value) => 'Rp'.number_format((float) $value, 0, ',', '.');
    $fmtPercent = fn ($value) => number_format((float) $value, 1, ',', '.').'%';
    $canViewPii = (bool) ($canViewPii ?? false);
?>

<div class="space-y-6">
    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">Laporan Performa Member</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Pantau kontribusi revenue, profit, dan loyalitas member.</p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
            <a
                href="<?php echo e(route('reports.member-performance.excel', ['from' => (string) ($fromDate ?? ''), 'to' => (string) ($toDate ?? ''), 'paymentScope' => (string) ($paymentScope ?? 'paid')])); ?>"
                class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]"
            >
                Export Excel
            </a>
            <?php if (isset($component)) { $__componentOriginal0f75a9e682f4dfdf6a00b8cfac5a7028 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f75a9e682f4dfdf6a00b8cfac5a7028 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.date-range-picker','data' => ['preset' => $rangePreset,'from' => $fromDate,'to' => $toDate,'wireFromModel' => 'fromDate','wireToModel' => 'toDate','class' => 'flex flex-col gap-3 sm:flex-row sm:items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.date-range-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['preset' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rangePreset),'from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fromDate),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toDate),'wire-from-model' => 'fromDate','wire-to-model' => 'toDate','class' => 'flex flex-col gap-3 sm:flex-row sm:items-center']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f75a9e682f4dfdf6a00b8cfac5a7028)): ?>
<?php $attributes = $__attributesOriginal0f75a9e682f4dfdf6a00b8cfac5a7028; ?>
<?php unset($__attributesOriginal0f75a9e682f4dfdf6a00b8cfac5a7028); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f75a9e682f4dfdf6a00b8cfac5a7028)): ?>
<?php $component = $__componentOriginal0f75a9e682f4dfdf6a00b8cfac5a7028; ?>
<?php unset($__componentOriginal0f75a9e682f4dfdf6a00b8cfac5a7028); ?>
<?php endif; ?>

            <select wire:model.live="paymentScope" class="shadow-theme-xs h-11 rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                <option value="paid">Hanya Paid</option>
                <option value="all">Semua Status</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 md:gap-6">
        <?php
            $cards = [
                ['label' => 'Revenue Member', 'value' => $overview['memberRevenue'] ?? 0, 'fmt' => $fmtCurrency],
                ['label' => 'Profit Member', 'value' => $overview['memberProfit'] ?? 0, 'fmt' => $fmtCurrency],
                ['label' => 'Margin Member', 'value' => $overview['memberMarginPercent'] ?? 0, 'fmt' => $fmtPercent],
                ['label' => 'Transaksi Member', 'value' => $overview['memberTxCount'] ?? 0, 'fmt' => fn($v) => number_format((float) $v, 0, ',', '.')],
                ['label' => 'Active Member', 'value' => $overview['activeMembers'] ?? 0, 'fmt' => fn($v) => number_format((float) $v, 0, ',', '.')],
                ['label' => 'Repeat Rate', 'value' => $overview['repeatRatePercent'] ?? 0, 'fmt' => $fmtPercent],
            ];
        ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                <p class="text-theme-sm text-gray-500 dark:text-gray-400"><?php echo e($card['label']); ?></p>
                <h4 class="mt-3 text-2xl font-bold text-gray-800 dark:text-white/90"><?php echo e(($card['fmt'])($card['value'])); ?></h4>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($card['label'] === 'Revenue Member'): ?>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Share: <?php echo e(number_format((float) ($overview['memberSharePercent'] ?? 0), 1, ',', '.')); ?>%
                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($card['label'] === 'Profit Member'): ?>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        HPP: <?php echo e($fmtCurrency((float) ($overview['memberHpp'] ?? 0))); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] xl:col-span-2">
            <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Trend Revenue</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Perbandingan revenue member vs non-member per hari.</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                        Coverage HPP: <?php echo e(number_format((float) ($overview['hppCoveragePercent'] ?? 0), 1, ',', '.')); ?>%
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div id="chartThree" data-series='<?php echo json_encode($chartSeries, 15, 512) ?>' data-categories='<?php echo json_encode($chartCategories, 15, 512) ?>'></div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Catatan</h3>
            </div>
            <div class="p-5 space-y-3 text-sm text-gray-600 dark:text-gray-300">
                <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-800 dark:bg-gray-900">
                    Avg Order Member: <?php echo e($fmtCurrency((float) ($overview['avgOrder'] ?? 0))); ?>

                </div>
                <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-800 dark:bg-gray-900">
                    Item terjual (member): <?php echo e(number_format((int) ($overview['memberQty'] ?? 0), 0, ',', '.')); ?>

                </div>
                <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-800 dark:bg-gray-900">
                    Repeat rate = member dengan ≥ 2 transaksi / active member
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Peta Persebaran Member</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Titik mewakili kab/kota (centroid), warna berdasarkan jumlah member aktif.</p>
                </div>
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-1 text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                        <span class="h-2 w-2 rounded-full" style="background:#94a3b8"></span> 0
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-1 text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                        <span class="h-2 w-2 rounded-full" style="background:#ef4444"></span> 1–5
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-1 text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                        <span class="h-2 w-2 rounded-full" style="background:#f59e0b"></span> 6–20
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-1 text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                        <span class="h-2 w-2 rounded-full" style="background:#22c55e"></span> 21+
                    </span>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="relative">
                <div wire:ignore id="memberMap" class="h-[420px] w-full overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800" data-markers='<?php echo json_encode($regionMarkers, 15, 512) ?>'></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($regionMarkers) === 0): ?>
                    <div class="absolute inset-0 flex items-center justify-center rounded-xl bg-white/70 px-6 text-center backdrop-blur-sm dark:bg-gray-900/70">
                        <p class="text-sm text-gray-600 dark:text-gray-300">Belum ada data wilayah (pastikan member punya Wilayah + GeoJSON, dan ada transaksi pada periode).</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
            <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Top Member (berdasarkan revenue)</h3>
        </div>
        <div class="custom-scrollbar overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Member</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Transaksi</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Qty</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Revenue</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Profit</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Margin</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Avg</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Last</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $topMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td class="px-5 py-4">
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90"><?php echo e($row['name']); ?></p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canViewPii): ?>
                                    <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($row['phone'] ?? $row['email'] ?? '-'); ?></p>
                                <?php else: ?>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">-</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e(number_format((int) $row['tx_count'], 0, ',', '.')); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e(number_format((int) $row['qty'], 0, ',', '.')); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($fmtCurrency($row['revenue'])); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white/90"><?php echo e($fmtCurrency($row['profit'])); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e(number_format((float) $row['margin_percent'], 1, ',', '.')); ?>%</p>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($fmtCurrency((float) $row['avg_order'])); ?></p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($row['last_purchase_at'] ? \Carbon\CarbonImmutable::parse($row['last_purchase_at'])->format('d M Y') : '-'); ?></p>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal8333c7520247d01ca05cd625bf80e31f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8333c7520247d01ca05cd625bf80e31f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.empty-table-row','data' => ['colspan' => '8','message' => 'Belum ada data.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.empty-table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => '8','message' => 'Belum ada data.']); ?>
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
    </div>
</div>
<?php /**PATH D:\Shaall\PROJECT\pos-project\resources\views/livewire/reports/member-performance-report-page.blade.php ENDPATH**/ ?>