<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('stock-opnames.index')); ?>" wire:navigate class="shadow-theme-xs inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Kembali
                </a>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">Stock Opname</h2>
            </div>
        </div>

        <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isLocked): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory.opnames.create', 'inventory.opnames.edit', 'inventory.opnames.manage', 'inventory.manage'])): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($stockOpnameId ? $canEdit : $canCreate)): ?>
                        <button type="button" wire:click="saveDraft" class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-medium text-white transition">
                            Simpan Draft
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory.opnames.refresh_system_stocks', 'inventory.opnames.manage', 'inventory.manage'])): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($stockOpnameId ? $canEdit : $canCreate) && $canRefresh): ?>
                        <button type="button" wire:click="refreshSystemStocks" class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Refresh Stok Sistem
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory.opnames.post', 'inventory.opnames.manage', 'inventory.manage'])): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canPost): ?>
                        <button type="button" wire:click="openPostConfirm" class="bg-emerald-600 shadow-theme-xs hover:bg-emerald-700 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-medium text-white transition" <?php if(count($items) === 0): echo 'disabled'; endif; ?>>
                            Posting
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory.opnames.cancel', 'inventory.opnames.manage', 'inventory.manage'])): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stockOpnameId && $canCancel): ?>
                        <button type="button" wire:click="openCancelConfirm" class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-error-200 bg-white px-4 text-sm font-semibold text-error-700 hover:bg-error-50 dark:border-error-500/30 dark:bg-gray-900 dark:text-error-400 dark:hover:bg-error-500/10">
                            Batalkan
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 text-sm text-gray-700 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-300">
        <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
            <div>
                <p class="font-semibold">Tujuan</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Sinkronkan stok sistem dengan stok fisik hasil hitung.</p>
            </div>
            <div>
                <p class="font-semibold">Kapan dipakai</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Koreksi berkala (mingguan/bulanan). Kejadian harian seperti rusak/expired/staff meal gunakan Pergerakan Stok.</p>
            </div>
            <div>
                <p class="font-semibold">Finalisasi</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Saat difinalisasi, sistem membuat penyesuaian stok berdasarkan selisih.</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div>
                <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Kode</label>
                <input wire:model.live="code" type="text" aria-invalid="<?php echo e($errors->has('code') ? 'true' : 'false'); ?>" aria-describedby="<?php echo e($errors->has('code') ? 'error-code' : ''); ?>" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" <?php if($isLocked): echo 'disabled'; endif; ?> />
                <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'code']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'code']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
            </div>
            <div>
                <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Tanggal Hitung</label>
                <?php if (isset($component)) { $__componentOriginal2890f45fb5b66d590d53f4065c50558d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2890f45fb5b66d590d53f4065c50558d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.date-picker','data' => ['wireModel' => 'countedAt','disabled' => $isLocked]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.date-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire-model' => 'countedAt','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isLocked)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2890f45fb5b66d590d53f4065c50558d)): ?>
<?php $attributes = $__attributesOriginal2890f45fb5b66d590d53f4065c50558d; ?>
<?php unset($__attributesOriginal2890f45fb5b66d590d53f4065c50558d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2890f45fb5b66d590d53f4065c50558d)): ?>
<?php $component = $__componentOriginal2890f45fb5b66d590d53f4065c50558d; ?>
<?php unset($__componentOriginal2890f45fb5b66d590d53f4065c50558d); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'countedAt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'countedAt']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
            </div>
            <div>
                <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Status</label>
                <input value="<?php echo e($isPosted ? 'Posted' : ($isCancelled ? 'Cancelled' : 'Draft')); ?>" type="text" class="shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-gray-50 px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400" readonly />
            </div>
        </div>

        <div class="mt-4">
            <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Catatan</label>
            <input wire:model.live="note" type="text" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" <?php if($isLocked): echo 'disabled'; endif; ?> />
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'items','class' => 'text-sm text-error-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'items','class' => 'text-sm text-error-600']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>

    <?php
        $itemsCount = count($items);
        $adjustmentCount = 0;
        $sumPositive = 0.0;
        $sumNegative = 0.0;
        foreach ($items as $row) {
            $variance = (float) (\App\Support\Number\QuantityParser::parse($row['counted_qty'] ?? null) ?? 0) - (float) ($row['system_qty'] ?? 0);
            if (abs($variance) >= 0.0005) {
                $adjustmentCount++;
                if ($variance > 0) {
                    $sumPositive += $variance;
                } else {
                    $sumNegative += abs($variance);
                }
            }
        }
    ?>
    <div class="rounded-2xl border border-gray-200 bg-white px-5 py-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
            <div class="text-sm text-gray-700 dark:text-gray-300">
                Total item: <span class="font-semibold"><?php echo e(number_format($itemsCount, 0, ',', '.')); ?></span>
            </div>
            <div class="text-sm text-gray-700 dark:text-gray-300">
                Item selisih: <span class="font-semibold"><?php echo e(number_format($adjustmentCount, 0, ',', '.')); ?></span>
            </div>
            <div class="text-sm text-gray-700 dark:text-gray-300">
                Total penyesuaian: <span class="font-semibold text-success-600 dark:text-success-500">+<?php echo e(\App\Support\Number\QuantityFormatter::format($sumPositive)); ?></span> / <span class="font-semibold text-error-600 dark:text-error-500">-<?php echo e(\App\Support\Number\QuantityFormatter::format($sumNegative)); ?></span>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="hidden sm:block">
            <div class="custom-scrollbar overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                            <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bahan</th>
                            <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Stok Sistem</th>
                            <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Stok Fisik</th>
                            <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Selisih</th>
                            <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Catatan</th>
                            <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $ingredientId = (int) ($row['ingredient_id'] ?? 0);
                                $unit = '-';
                                $name = '';
                                foreach ($ingredients as $ingredient) {
                                    if ((int) $ingredient['id'] === $ingredientId) {
                                        $unit = $ingredient['unit'];
                                        $name = (string) $ingredient['name'];
                                        break;
                                    }
                                }
                                $systemQty = (float) ($row['system_qty'] ?? 0);
                                $countedQty = (float) (\App\Support\Number\QuantityParser::parse($row['counted_qty'] ?? null) ?? 0);
                                $variance = $countedQty - $systemQty;
                                $hasVariance = abs($variance) >= 0.0005;
                            ?>
                            <tr class="<?php echo e($hasVariance ? 'bg-brand-50/50 dark:bg-brand-500/5' : ''); ?>">
                                <td class="px-5 py-4">
                                    <select wire:model.live="items.<?php echo e($i); ?>.ingredient_id" aria-invalid="<?php echo e($errors->has('items.'.$i.'.ingredient_id') ? 'true' : 'false'); ?>" aria-describedby="<?php echo e($errors->has('items.'.$i.'.ingredient_id') ? 'error-items-'.$i.'-ingredient_id' : ''); ?>" class="shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400" <?php if($isLocked): echo 'disabled'; endif; ?>>
                                        <option value="">Pilih bahan</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <option value="<?php echo e($ingredient['id']); ?>"><?php echo e($ingredient['name']); ?> (<?php echo e($ingredient['unit']); ?>)</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'items.'.$i.'.ingredient_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('items.'.$i.'.ingredient_id')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90"><?php echo e(\App\Support\Number\QuantityFormatter::format((float) ($row['system_qty'] ?? 0))); ?> <?php echo e($unit); ?></p>
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <input wire:model.live="items.<?php echo e($i); ?>.counted_qty" type="text" inputmode="decimal" aria-invalid="<?php echo e($errors->has('items.'.$i.'.counted_qty') ? 'true' : 'false'); ?>" aria-describedby="<?php echo e($errors->has('items.'.$i.'.counted_qty') ? 'error-items-'.$i.'-counted_qty' : ''); ?>" class="dark:bg-dark-900 shadow-theme-xs h-11 w-32 rounded-lg border border-gray-300 bg-transparent px-3 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 text-right" <?php if($isLocked): echo 'disabled'; endif; ?> />
                                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'items.'.$i.'.counted_qty']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('items.'.$i.'.counted_qty')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ingredientId === 0): ?>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">-</p>
                                    <?php else: ?>
                                        <p class="text-sm font-semibold <?php echo e($hasVariance ? ($variance > 0 ? 'text-success-600 dark:text-success-500' : 'text-error-600 dark:text-error-500') : 'text-gray-600 dark:text-gray-400'); ?>">
                                            <?php echo e($hasVariance ? ($variance > 0 ? '+' : '') : ''); ?><?php echo e(\App\Support\Number\QuantityFormatter::format($variance)); ?> <?php echo e($unit); ?>

                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td class="px-5 py-4">
                                    <input wire:model.live="items.<?php echo e($i); ?>.note" type="text" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" <?php if($isLocked): echo 'disabled'; endif; ?> />
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isLocked): ?>
                                        <button type="button" x-on:click.prevent="$dispatch('confirm', { message: 'Hapus item ini?', method: 'removeItem', args: [<?php echo e($i); ?>] })" class="shadow-theme-xs inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                            Hapus
                                        </button>
                                    <?php else: ?>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">-</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal8333c7520247d01ca05cd625bf80e31f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8333c7520247d01ca05cd625bf80e31f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.empty-table-row','data' => ['colspan' => '6','message' => 'Belum ada item opname. Klik “Tambah Item”.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.empty-table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => '6','message' => 'Belum ada item opname. Klik “Tambah Item”.']); ?>
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

        <div class="sm:hidden">
            <div class="space-y-3 p-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $ingredientId = (int) ($row['ingredient_id'] ?? 0);
                        $unit = '-';
                        $name = '';
                        foreach ($ingredients as $ingredient) {
                            if ((int) $ingredient['id'] === $ingredientId) {
                                $unit = $ingredient['unit'];
                                $name = (string) $ingredient['name'];
                                break;
                            }
                        }
                        $systemQty = (float) ($row['system_qty'] ?? 0);
                        $countedQty = (float) (\App\Support\Number\QuantityParser::parse($row['counted_qty'] ?? null) ?? 0);
                        $variance = $countedQty - $systemQty;
                        $hasVariance = abs($variance) >= 0.0005;
                    ?>
                    <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900 <?php echo e($hasVariance ? 'ring-1 ring-brand-500/20' : ''); ?>">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Item <?php echo e(number_format($i + 1, 0, ',', '.')); ?></p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isLocked): ?>
                                <button type="button" x-on:click.prevent="$dispatch('confirm', { message: 'Hapus item ini?', method: 'removeItem', args: [<?php echo e($i); ?>] })" class="text-sm font-semibold text-error-700 hover:text-error-800 dark:text-error-400 dark:hover:text-error-300">
                                    Hapus
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="mt-3 space-y-3">
                            <div>
                                <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Bahan</label>
                                <select wire:model.live="items.<?php echo e($i); ?>.ingredient_id" aria-invalid="<?php echo e($errors->has('items.'.$i.'.ingredient_id') ? 'true' : 'false'); ?>" aria-describedby="<?php echo e($errors->has('items.'.$i.'.ingredient_id') ? 'error-items-'.$i.'-ingredient_id' : ''); ?>" class="shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300" <?php if($isLocked): echo 'disabled'; endif; ?>>
                                    <option value="">Pilih bahan</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($ingredient['id']); ?>"><?php echo e($ingredient['name']); ?> (<?php echo e($ingredient['unit']); ?>)</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'items.'.$i.'.ingredient_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('items.'.$i.'.ingredient_id')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div class="rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 dark:border-gray-800 dark:bg-gray-950/30">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Stok Sistem</p>
                                    <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90"><?php echo e(\App\Support\Number\QuantityFormatter::format($systemQty)); ?> <?php echo e($unit); ?></p>
                                </div>
                                <div>
                                    <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Stok Fisik</label>
                                    <input wire:model.live="items.<?php echo e($i); ?>.counted_qty" type="text" inputmode="decimal" aria-invalid="<?php echo e($errors->has('items.'.$i.'.counted_qty') ? 'true' : 'false'); ?>" aria-describedby="<?php echo e($errors->has('items.'.$i.'.counted_qty') ? 'error-items-'.$i.'-counted_qty' : ''); ?>" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-3 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 text-right" <?php if($isLocked): echo 'disabled'; endif; ?> />
                                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'items.'.$i.'.counted_qty']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('items.'.$i.'.counted_qty')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm dark:border-gray-800 dark:bg-gray-950/30">
                                <p class="text-gray-600 dark:text-gray-300">Selisih</p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ingredientId === 0): ?>
                                    <p class="font-semibold text-gray-500 dark:text-gray-400">-</p>
                                <?php else: ?>
                                    <p class="font-semibold <?php echo e($hasVariance ? ($variance > 0 ? 'text-success-600 dark:text-success-500' : 'text-error-600 dark:text-error-500') : 'text-gray-600 dark:text-gray-400'); ?>">
                                        <?php echo e($hasVariance ? ($variance > 0 ? '+' : '') : ''); ?><?php echo e(\App\Support\Number\QuantityFormatter::format($variance)); ?> <?php echo e($unit); ?>

                                    </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Catatan</label>
                                <input wire:model.live="items.<?php echo e($i); ?>.note" type="text" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" <?php if($isLocked): echo 'disabled'; endif; ?> />
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="py-10">
                        <p class="text-center text-sm text-gray-500 dark:text-gray-400">Belum ada item opname. Klik “Tambah Item”.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isLocked): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory.opnames.create', 'inventory.opnames.edit', 'inventory.opnames.manage', 'inventory.manage'])): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($stockOpnameId ? $canEdit : $canCreate)): ?>
            <button type="button" wire:click="addItem" class="shadow-theme-md w-full inline-flex h-11 items-center justify-center rounded-lg border border-brand-400 bg-brand-50 px-4 text-sm font-medium text-brand-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                + Tambah Item
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($postConfirmOpen && ! $isLocked): ?>
        <div class="fixed inset-0 z-[100000] flex items-center justify-center p-4" aria-modal="true" role="dialog">
            <div class="absolute inset-0 bg-black/50" wire:click="closePostConfirm"></div>
            <div class="relative w-full max-w-lg overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Posting Stock Opname</h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Aksi ini akan menyimpan draft dan membuat penyesuaian stok.</p>
                    </div>
                    <button type="button" wire:click="closePostConfirm" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        Tutup
                    </button>
                </div>
                <div class="p-5">
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700 dark:border-gray-800 dark:bg-gray-950/40 dark:text-gray-300">
                        Pastikan stok fisik sudah benar. Setelah diposting, dokumen akan menjadi readonly.
                    </div>
                    <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:justify-end">
                        <button type="button" wire:click="closePostConfirm" class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                            Batal
                        </button>
                        <button type="button" wire:click="post" class="bg-emerald-600 shadow-theme-xs hover:bg-emerald-700 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition" <?php if(count($items) === 0): echo 'disabled'; endif; ?>>
                            Posting Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cancelConfirmOpen && ! $isLocked): ?>
        <div class="fixed inset-0 z-[100000] flex items-center justify-center p-4" aria-modal="true" role="dialog">
            <div class="absolute inset-0 bg-black/50" wire:click="closeCancelConfirm"></div>
            <div class="relative w-full max-w-lg overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Batalkan Stock Opname</h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Opname draft akan ditandai cancelled dan tidak bisa diposting.</p>
                    </div>
                    <button type="button" wire:click="closeCancelConfirm" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        Tutup
                    </button>
                </div>
                <div class="p-5">
                    <div class="rounded-xl border border-error-200 bg-error-50 p-4 text-sm text-error-700 dark:border-error-500/30 dark:bg-error-500/10 dark:text-error-200">
                        Pastikan Anda memang ingin membatalkan dokumen ini.
                    </div>
                    <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:justify-end">
                        <button type="button" wire:click="closeCancelConfirm" class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                            Batal
                        </button>
                        <button type="button" wire:click="cancelOpname" class="bg-error-600 shadow-theme-xs hover:bg-error-700 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                            Batalkan Opname
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (isset($component)) { $__componentOriginald17d2374eec346425c271e2667ac66ae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald17d2374eec346425c271e2667ac66ae = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.confirm-modal','data' => ['confirmLabel' => 'Ya, hapus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.confirm-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['confirm-label' => 'Ya, hapus']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald17d2374eec346425c271e2667ac66ae)): ?>
<?php $attributes = $__attributesOriginald17d2374eec346425c271e2667ac66ae; ?>
<?php unset($__attributesOriginald17d2374eec346425c271e2667ac66ae); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald17d2374eec346425c271e2667ac66ae)): ?>
<?php $component = $__componentOriginald17d2374eec346425c271e2667ac66ae; ?>
<?php unset($__componentOriginald17d2374eec346425c271e2667ac66ae); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\inventory\stock-opname-form-page.blade.php ENDPATH**/ ?>