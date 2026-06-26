<div class="grid grid-cols-1 gap-6">
    <div class="w-full bg-gray-200">
        <div class="max-w-7xl px-2 py-3 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-black">Shift Log List</h3>

        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="custom-scrollbar overflow-x-auto border-b border-gray-200 px-3 py-4 dark:border-gray-800">
            <div class="flex flex-col xl:flex-row gap-3 w-full">

                <div class="flex flex-col gap-1.5 w-full xl:w-auto">
                    <div class="relative w-full">
                        <?php if (isset($component)) { $__componentOriginale1aa5bf8429dc92b5f60f59d2b5c5d73 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1aa5bf8429dc92b5f60f59d2b5c5d73 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.date-range-picker-shift-log','data' => ['from' => $fromDate,'to' => $toDate,'wireFromModel' => 'fromDate','wireToModel' => 'toDate','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.date-range-picker-shift-log'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fromDate),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toDate),'wire-from-model' => 'fromDate','wire-to-model' => 'toDate','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1aa5bf8429dc92b5f60f59d2b5c5d73)): ?>
<?php $attributes = $__attributesOriginale1aa5bf8429dc92b5f60f59d2b5c5d73; ?>
<?php unset($__attributesOriginale1aa5bf8429dc92b5f60f59d2b5c5d73); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1aa5bf8429dc92b5f60f59d2b5c5d73)): ?>
<?php $component = $__componentOriginale1aa5bf8429dc92b5f60f59d2b5c5d73; ?>
<?php unset($__componentOriginale1aa5bf8429dc92b5f60f59d2b5c5d73); ?>
<?php endif; ?>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5 flex-1">
                    <div class="relative w-full">
                        <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="fill-current" width="16" height="16" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z"
                                    fill="" />
                            </svg>
                        </span>
                        <input wire:model.live.debounce.400ms="searchNumber" type="text"
                            placeholder="Cari Nama Kasir atau Waktu Shift mulai/akhir..."
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-7 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[850px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                </div>
            </div>
        </div>

        <div class="custom-scrollbar overflow-x-auto px-3">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-center">
                            Starting Shift</th>
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                            Started By</th>
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-right">
                            Starting Cash</th>
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                            Ending Shift</th>
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200">
                            Ended By</th>
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-end">
                            Expected Cash</th>
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-end">
                            Actual Cash</th>
                        <th
                            class="text-xs font-extrabold py-2 px-2 text-gray-900 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 text-end">
                            Difference Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $shiftLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-gray-200 hover:dark:bg-gray-900">
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90 text-center">
                                <p>
                                    <?php echo e($sl['starting_shift']); ?>

                                </p>
                            </td>
                            </td>
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90">
                                <p><?php echo e($sl['started_by']); ?></p>
                            </td>
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90 text-end">
                                <p><?php echo e(number_format((int) $sl['starting_cash'], 0, ',', '.')); ?></p>
                            </td>
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90 text-center">
                                <p><?php echo e($sl['ending_shift']); ?></p>
                            </td>
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90">
                                <p><?php echo e($sl['ended_by']); ?></p>
                            </td>
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90 text-end">
                                <p><?php echo e(number_format((int) $sl['expected_cash'], 0, ',', '.')); ?></p>
                            </td>
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90 text-end">
                                <p><?php echo e(number_format((int) $sl['actual_cash'], 0, ',', '.')); ?></p>
                            </td>
                            <td class="px-2 py-2 text-xs font-normal text-gray-800 dark:text-white/90 text-end">
                                <p><?php echo e(number_format((int) $sl['difference_total'], 0, ',', '.')); ?></p>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="<?php echo e($canActions ? 10 : 9); ?>" class="px-5 py-10">
                                <p class="text-center text-sm font-normal text-gray-500 dark:text-gray-400">Transaksi tidak
                                    ditemukan.</p>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><?php /**PATH D:\POS PROJECT FINAL\pos-project\resources\views/livewire/shift-logs/index.blade.php ENDPATH**/ ?>