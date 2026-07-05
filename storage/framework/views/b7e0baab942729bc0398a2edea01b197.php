<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasPages()): ?>
    <?php
        $current = (int) $paginator->currentPage();
        $last = (int) $paginator->lastPage();
        $pageName = (string) $paginator->getPageName();

        $pages = [1];

        if ($current <= 2) {
            $pages[] = 2;
        } elseif ($current >= $last - 1) {
            $pages[] = max(1, $last - 1);
        } else {
            $pages[] = $current;
        }

        $pages[] = $last;
        $pages = array_values(array_unique(array_filter($pages, fn ($p) => is_int($p) && $p >= 1 && $p <= $last)));
        sort($pages);
    ?>
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between gap-3 rounded-2xl border border-gray-200 bg-white px-3 py-3">
        <div class="text-xs font-semibold text-gray-600">
            Menampilkan <?php echo e(number_format($paginator->firstItem() ?? 0, 0, ',', '.')); ?>–<?php echo e(number_format($paginator->lastItem() ?? 0, 0, ',', '.')); ?> dari <?php echo e(number_format($paginator->total(), 0, ',', '.')); ?>

        </div>

        <div class="flex items-center gap-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
                <span aria-disabled="true" aria-label="Sebelumnya" class="inline-flex items-center rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-xs font-bold text-gray-400">
                    Sebelumnya
                </span>
            <?php else: ?>
                <button type="button" wire:click="previousPage('<?php echo e($pageName); ?>')" rel="prev" class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-700 hover:bg-gray-50">
                    Sebelumnya
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="hidden items-center gap-1 sm:flex">
                <?php $prevShown = 0; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prevShown > 0 && $page > $prevShown + 1): ?>
                        <span aria-disabled="true" class="px-2 py-2 text-xs font-bold text-gray-400">…</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page === $current): ?>
                        <span aria-current="page" class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl bg-primary-60 px-3 text-xs font-extrabold text-white">
                            <?php echo e($page); ?>

                        </span>
                    <?php else: ?>
                        <button type="button" wire:click="gotoPage(<?php echo e($page); ?>, '<?php echo e($pageName); ?>')" class="inline-flex h-9 min-w-9 items-center justify-center rounded-xl border border-gray-200 bg-white px-3 text-xs font-bold text-gray-700 hover:bg-gray-50">
                            <?php echo e($page); ?>

                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php $prevShown = $page; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
                <button type="button" wire:click="nextPage('<?php echo e($pageName); ?>')" rel="next" class="inline-flex items-center rounded-xl bg-primary-60 px-3 py-2 text-xs font-bold text-white hover:bg-primary-70">
                    Berikutnya
                </button>
            <?php else: ?>
                <span aria-disabled="true" aria-label="Berikutnya" class="inline-flex items-center rounded-xl bg-gray-100 px-3 py-2 text-xs font-bold text-gray-400">
                    Berikutnya
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </nav>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\pagination\self-order.blade.php ENDPATH**/ ?>