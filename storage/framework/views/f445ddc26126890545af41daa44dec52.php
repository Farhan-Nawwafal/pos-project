<div class="space-y-6 grid grid-cols-1">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">Pergerakan Stok</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Catat waste, pemakaian non-penjualan, dan koreksi input. Untuk koreksi periodik gunakan Stock Opname.</p>
        </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory.movements.create', 'inventory.movements.manage', 'inventory.manage'])): ?>
                <button type="button" wire:click="openCreateMovementModal" class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                    Tambah Pergerakan
                </button>
            <?php endif; ?>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 text-sm text-gray-700 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-300">
        <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
            <div>
                <p class="font-semibold">Stock Opname</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Koreksi berkala berdasarkan hitung fisik (selisih sistem vs fisik).</p>
            </div>
            <div>
                <p class="font-semibold">Waste / Pemakaian</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kejadian harian seperti rusak/expired, staff meal, sampling, produksi/prep.</p>
            </div>
            <div>
                <p class="font-semibold">Penyesuaian</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Koreksi input (mis. salah satuan), bukan pengganti waste/opname.</p>
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
                    <input wire:model.live.debounce.400ms="search" type="text" placeholder="Cari catatan/ref..." class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden sm:w-[240px] sm:min-w-[240px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                <select wire:model.live="filterIngredientId" class="shadow-theme-xs h-11 rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                    <option value="">Semua bahan</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($ingredient->id); ?>"><?php echo e($ingredient->name); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <select wire:model.live="filterType" class="shadow-theme-xs h-11 rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                    <option value="">Semua tipe</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $typeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <select wire:model.live="filterSupplierId" class="shadow-theme-xs h-11 rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                    <option value="">Semua supplier</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->name); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>

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
            </div>
            
        </div>

        <div class="custom-scrollbar overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Waktu</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Bahan</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Supplier</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Qty</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Harga/unit</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Ref</th>
                        <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $qty = (float) $movement->quantity;
                            $qtyText = \App\Support\Number\QuantityFormatter::format(abs($qty));
                            $ingredientUnit = (string) ($movement->ingredient?->unit ?? '');
                            $when = $movement->happened_at ?? $movement->created_at;

                            $typeLabel = $typeOptions[$movement->type] ?? (string) $movement->type;
                            $typeBadgeClass = match ((string) $movement->type) {
                                'purchase' => 'bg-success-50 text-success-600 border-success-200 dark:bg-success-500/10 dark:text-success-500 dark:border-success-500/20',
                                'sale_consumption' => 'bg-error-50 text-error-600 border-error-200 dark:bg-error-500/10 dark:text-error-500 dark:border-error-500/20',
                                'sale_reversal' => 'bg-success-50 text-success-600 border-success-200 dark:bg-success-500/10 dark:text-success-500 dark:border-success-500/20',
                                'usage' => 'bg-error-50 text-error-600 border-error-200 dark:bg-error-500/10 dark:text-error-500 dark:border-error-500/20',
                                'waste' => 'bg-error-50 text-error-600 border-error-200 dark:bg-error-500/10 dark:text-error-500 dark:border-error-500/20',
                                'adjustment' => 'bg-brand-50 text-brand-600 border-brand-200 dark:bg-brand-500/10 dark:text-brand-400 dark:border-brand-500/20',
                                'opname_adjustment' => 'bg-warning-50 text-warning-700 border-warning-200 dark:bg-warning-500/10 dark:text-warning-400 dark:border-warning-500/20',
                                default => 'bg-gray-50 text-gray-700 border-gray-200 dark:bg-white/[0.03] dark:text-gray-300 dark:border-gray-800',
                            };

                            $refType = (string) ($movement->reference_type ?? '');
                            $refId = (int) ($movement->reference_id ?? 0);
                            $refCode = $refType !== '' && $refId > 0 ? (string) (($refCodes[$refType][$refId] ?? '') ?: '') : '';
                            $refText = $refType !== '' && $refId > 0 ? $refType.'#'.$refId : '-';

                            if ($refType === 'transactions' && $refCode !== '') {
                                $refText = 'Transaksi '.$refCode;
                            } elseif ($refType === 'purchases' && $refCode !== '') {
                                $refText = 'Pembelian '.$refCode;
                            } elseif ($refType === 'stock_opnames' && $refCode !== '') {
                                $refText = 'Opname '.$refCode;
                            }

                            $refUrl = null;
                            if ($refType === 'transactions' && $refId) {
                                $refUrl = route('transactions.show', ['transaction' => $refId]);
                            } elseif ($refType === 'purchases' && $refId) {
                                $refUrl = route('purchases.edit', ['purchase' => $refId]);
                            } elseif ($refType === 'stock_opnames' && $refId) {
                                $refUrl = route('stock-opnames.edit', ['stockOpname' => $refId]);
                            }
                        ?>
                        <tr>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90"><?php echo e(optional($when)->format('d M Y')); ?></p>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($movement->ingredient?->name ?? '-'); ?></p>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center rounded-full border px-2 py-0.5 text-theme-xs font-semibold <?php echo e($typeBadgeClass); ?>"><?php echo e($typeLabel); ?></span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($movement->note); ?></p>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($movement->supplier?->name ?? '-'); ?></p>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <p class="text-sm font-semibold <?php echo e($qty < 0 ? 'text-error-600 dark:text-error-500' : 'text-success-600 dark:text-success-500'); ?>">
                                    <?php echo e($qty < 0 ? '-' : '+'); ?><?php echo e($qtyText); ?><?php echo e($ingredientUnit !== '' ? ' '.$ingredientUnit : ''); ?>

                                </p>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($movement->unit_cost !== null ? 'Rp'.number_format((float) $movement->unit_cost, 0, ',', '.') : '-'); ?></p>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($refUrl): ?>
                                    <a href="<?php echo e($refUrl); ?>" class="text-sm font-medium text-brand-600 hover:underline dark:text-brand-400">
                                        <?php echo e($refText); ?>

                                    </a>
                                <?php else: ?>
                                    <p class="text-sm text-gray-800 dark:text-white/90"><?php echo e($refText); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['inventory.movements.delete', 'inventory.movements.manage', 'inventory.manage'])): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDelete && $movement->reference_type === null && $movement->reference_id === null): ?>
                                        <button type="button" wire:click="openDeleteConfirm(<?php echo e((int) $movement->id); ?>)" class="shadow-theme-xs inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                                            Hapus
                                        </button>
                                    <?php else: ?>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">-</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php else: ?>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">-</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal8333c7520247d01ca05cd625bf80e31f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8333c7520247d01ca05cd625bf80e31f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.empty-table-row','data' => ['colspan' => '8','message' => 'Pergerakan stok belum ada.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.empty-table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => '8','message' => 'Pergerakan stok belum ada.']); ?>
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
            <?php echo e($movements->links('livewire.pagination.admin')); ?>

        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($createMovementModalOpen): ?>
        <div class="fixed inset-0 z-[100000] flex items-center justify-center p-4" aria-modal="true" role="dialog">
            <div class="absolute inset-0 bg-black/50" wire:click="closeCreateMovementModal"></div>
            <div class="relative w-full max-w-4xl overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Tambah Pergerakan</h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Gunakan tipe yang tepat agar laporan tidak rancu.</p>
                    </div>
                    <button type="button" wire:click="closeCreateMovementModal" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        Tutup
                    </button>
                </div>

                <form wire:submit="createMovement" class="grid grid-cols-1 gap-4 p-5 lg:grid-cols-6">
                    <div class="lg:col-span-2">
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Bahan</label>
                        <select wire:model.live="ingredientId" aria-invalid="<?php echo e($errors->has('ingredientId') ? 'true' : 'false'); ?>" aria-describedby="<?php echo e($errors->has('ingredientId') ? 'error-ingredientId' : ''); ?>" class="shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            <option value="">Pilih bahan</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($ingredient->id); ?>"><?php echo e($ingredient->name); ?> (<?php echo e($ingredient->unit); ?>)</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'ingredientId']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'ingredientId']); ?>
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

                    <div class="lg:col-span-1">
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Tipe</label>
                        <select wire:model.live="type" class="shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $createTypeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type === 'waste'): ?>
                                Catat barang rusak/expired/hilang (kerugian stok).
                            <?php elseif($type === 'usage'): ?>
                                Catat pemakaian non-penjualan (staff meal, sampling, produksi/prep).
                            <?php else: ?>
                                Catat koreksi input (mis. salah satuan) dan jelaskan di catatan.
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </div>

                    <div class="lg:col-span-1">
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Arah</label>
                        <select wire:model.live="direction" class="shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400" <?php if($type !== 'adjustment'): echo 'disabled'; endif; ?>>
                            <option value="in">Masuk</option>
                            <option value="out">Keluar</option>
                        </select>
                    </div>

                    <div class="lg:col-span-1">
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Qty</label>
                        <input wire:model.live="quantity" type="text" inputmode="decimal" aria-invalid="<?php echo e($errors->has('quantity') ? 'true' : 'false'); ?>" aria-describedby="<?php echo e($errors->has('quantity') ? 'error-quantity' : ''); ?>" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" placeholder="0" />
                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'quantity']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'quantity']); ?>
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

                    <div class="lg:col-span-1">
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Tanggal</label>
                        <?php if (isset($component)) { $__componentOriginal2890f45fb5b66d590d53f4065c50558d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2890f45fb5b66d590d53f4065c50558d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.date-picker','data' => ['wireModel' => 'happenedAt']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.date-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire-model' => 'happenedAt']); ?>
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
                    </div>

                    <div class="lg:col-span-2">
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Harga per Unit (Opsional)</label>
                        <?php if (isset($component)) { $__componentOriginald69271f1dfc0ddf0507c6c7ef7e709e0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69271f1dfc0ddf0507c6c7ef7e709e0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.rupiah-input','data' => ['wireModel' => 'unitCost','placeholder' => '0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.rupiah-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire-model' => 'unitCost','placeholder' => '0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69271f1dfc0ddf0507c6c7ef7e709e0)): ?>
<?php $attributes = $__attributesOriginald69271f1dfc0ddf0507c6c7ef7e709e0; ?>
<?php unset($__attributesOriginald69271f1dfc0ddf0507c6c7ef7e709e0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69271f1dfc0ddf0507c6c7ef7e709e0)): ?>
<?php $component = $__componentOriginald69271f1dfc0ddf0507c6c7ef7e709e0; ?>
<?php unset($__componentOriginald69271f1dfc0ddf0507c6c7ef7e709e0); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'unitCost']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'unitCost']); ?>
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

                    <div class="lg:col-span-4">
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Catatan</label>
                        <input wire:model.live="note" type="text" class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" placeholder="Wajib. Contoh: Expired, Staff meal, Salah input unit, Barang rusak..." />
                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'note']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'note']); ?>
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

                    <div class="lg:col-span-6 flex items-center justify-end gap-2">
                        <button type="button" wire:click="closeCreateMovementModal" class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                            Batal
                        </button>
                        <button type="submit" class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($deleteConfirmOpen): ?>
        <div class="fixed inset-0 z-[100000] flex items-center justify-center p-4" aria-modal="true" role="dialog">
            <div class="absolute inset-0 bg-black/50" wire:click="closeDeleteConfirm"></div>
            <div class="relative w-full max-w-lg overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Hapus Pergerakan Stok</h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pergerakan stok manual akan dihapus permanen.</p>
                    </div>
                    <button type="button" wire:click="closeDeleteConfirm" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        Tutup
                    </button>
                </div>
                <div class="p-5">
                    <div class="rounded-xl border border-error-200 bg-error-50 p-4 text-sm text-error-700 dark:border-error-500/30 dark:bg-error-500/10 dark:text-error-200">
                        Pastikan Anda memang ingin menghapus data ini.
                    </div>
                    <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:justify-end">
                        <button type="button" wire:click="closeDeleteConfirm" class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                            Batal
                        </button>
                        <button type="button" wire:click="deleteMovement" class="bg-error-600 shadow-theme-xs hover:bg-error-700 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\inventory\inventory-movements-page.blade.php ENDPATH**/ ?>