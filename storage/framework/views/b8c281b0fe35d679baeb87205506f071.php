<div class="flex flex-col h-full">
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'dine_in' && !$selectedTableId): ?>
        <div
            class="flex flex-col flex-none  bg-white dark:bg-gray-900 p-5 border border-gray-200 dark:border-gray-800 shadow-sm">

            
            <!-- Kontainer Induk Baru: Membuat kedua grup elemen sejajar kiri-kanan dan vertikal di tengah -->
            <div class="flex items-center justify-between w-full mb-1 flex-shrink-0">

                <!-- Grup Tombol Menu (Kiri) -->
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" wire:click="chooseOrderType('take_away')"
                        class="px-10 py-4 text-xs uppercase font-bold bg-brand-500 border border-gray-300 rounded-sm text-white ">
                        Quick Service
                    </button>

                    <button type="button" wire:click="$set('tableRange', '1-50')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'px-15 py-4 text-xs font-bold rounded-sm transition-all',
                        'bg-brand-500 text-white border border-brand-600',
                    ]); ?>">1 - 50</button>

                    <button type="button" wire:click="$set('tableRange', '51-100')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'px-15 py-4 text-xs font-bold rounded-sm transition-all',
                        'bg-brand-500 text-white border border-brand-600',
                    ]); ?>">51 - 100</button>
                </div>

                <!-- Grup Navigasi Halaman (Kanan) -->
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-500">Page 1 of 1</span>
                    <button type="button"
                        class="w-9 h-9 flex items-center justify-center bg-brand-500 text-white rounded">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <button type="button"
                        class="w-9 h-9 flex items-center justify-center bg-brand-500 text-white rounded">‹</button>
                    <button type="button"
                        class="w-9 h-9 flex items-center justify-center bg-brand-500 text-white rounded">›</button>
                </div>

            </div>
            
            <div class="flex-none min-h-0 overflow-y-auto  border border-gray-200 pb-8 pr-14 pl-3 ">
                <div class="grid grid-cols-10 gap-3 md:gap-3 lg:gap-6 xl:gap-20">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $tableNumber = (int) filter_var($t['label'], FILTER_SANITIZE_NUMBER_INT);

                            // Default ke 1-50 jika belum di-set
                            [$min, $max] = explode('-', $tableRange ?? '1-50');

                            $shouldShow = $tableNumber >= (int) $min && $tableNumber <= (int) $max;

                            // Set status (asumsi status dikirim dari backend: available, booked, occupied, billed)
                            $status = strtolower($t['status'] ?? 'available');
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shouldShow): ?>
                            <button type="button" wire:click="openSelectTableModal(<?php echo e((int) $t['id']); ?>)"
                                <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'table-item-'.e($t['id']).'-'.e($status).''; ?>wire:key="table-item-<?php echo e($t['id']); ?>-<?php echo e($status); ?>"
                                <?php if(in_array($status, ['occupied', 'booked', 'billed']) && isset($t['occupied_at'])): ?> x-data="{
                                    start: new Date('<?php echo e($t['occupied_at']); ?>').getTime(),
                                    display: '00:00',
                                    init() {
                                        setInterval(() => {
                                            let diff = Math.floor((new Date().getTime() - this.start) / 1000);
                                            if (diff < 0) diff = 0;
                                            let h = Math.floor(diff / 3600);
                                            let m = Math.floor((diff % 3600) / 60);
                                            let s = diff % 60;
                                            this.display = (h > 0 ? h.toString().padStart(2, '0') + ':' : '') + m.toString().padStart(2, '0') + ':' + s.toString().padStart(2, '0');
                                        }, 1000);
                                    }
                                }" <?php endif; ?>
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                    'flex flex-col items-center justify-center border transition-all shadow-sm group rounded-xs aspect-[1]',
                                    'bg-[#3C8CBC] border-[#3C8CBC] hover:bg-[#3C8CBC] text-white' =>
                                        $status === 'available',
                                    'bg-yellow-400 border-yellow-500 hover:bg-yellow-500 text-white' =>
                                        $status === 'booked',
                                    'bg-[#DD4B39] border-[#DD4B39] hover:bg-[#DD4B39] text-white' =>
                                        $status === 'occupied',
                                    'bg-green-500 border-green-600 hover:bg-green-600 text-white' =>
                                        $status === 'billed',
                                ]); ?>">
                                <span
                                    class="text-xs group-hover:scale-110 transition-transform"><?php echo e($t['label']); ?></span>
                                <span class="text-[8px] font-mono">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($status, ['occupied', 'booked', 'billed'])): ?>
                                        <span x-text="display">00:00</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span>
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            
            <div class="flex-shrink-0 pt-8  ">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 text-xs font-bold bg-yellow-400 text-white "> > 0 minute</span>
                    <span class="px-2.5 py-1 text-xs font-bold bg-[#DD4B39] text-white "> > 0 minute</span>
                    <div class="flex flex-wrap items-center gap-x-45 gap-y-3">
                        

                        
                        <div class="flex items-center gap-4 pl-40">
                            <div class="w-4 h-4 bg-[#3C8DBC]  border-[#3C8DBC]"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Available</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-4 h-4 bg-yellow-400  border-yellow-500"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Booked</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-4 h-4 bg-[#DD4B39]  border-[#DD4B39]"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Occupied</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-4 h-4 bg-green-500  border-green-600"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Billed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <?php elseif($orderType === 'take_away' && $showQuickServiceWaitlist): ?>
        <div class="flex flex-col flex-1 min-h-0 bg-white border border-gray-200 shadow-sm">

            
            <div class="flex items-center justify-between px-2 py-2 border-b border-gray-200">
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" wire:click="chooseOrderType('take_away')"
                        class="px-10 py-4 text-xs font-bold bg-brand-500 border border-gray-300 rounded-xs text-white">
                        Quick Service
                    </button>
                    <button type="button" wire:click="chooseOrderType('dine_in')"
                        class="px-15 py-4 text-xs font-bold rounded-xs bg-[#3C8DBC] text-white">
                        1 - 50
                    </button>
                    <button type="button" wire:click="chooseOrderType('dine_in')"
                        class="px-15 py-4 text-xs font-bold rounded-xs bg-[#3C8DBC] text-white">
                        51 - 100
                    </button>
                    
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-500">Page 1 of 1</span>
                    <button type="button"
                        class="w-9 h-9 flex items-center justify-center bg-brand-500 text-white rounded">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <button type="button"
                        class="w-9 h-9 flex items-center justify-center bg-brand-500 text-white rounded">‹</button>
                    <button type="button"
                        class="w-9 h-9 flex items-center justify-center bg-brand-500 text-white rounded">›</button>
                </div>
            </div>

            
            <div class="flex items-center justify-between px-4 py-3 bg-gray-100 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700">Quick Service List</h3>
                <button type="button" wire:click="openAddQuickService"
                    class="px-4 py-2 bg-[#3C8DBC] text-white text-xs font-bold rounded flex items-center gap-1.5 transition active:scale-95">
                    + Add Quick Service
                </button>
            </div>

            
            <div class="flex-1 overflow-y-auto">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->quickServicePendingList->isEmpty()): ?>
                    <div class="h-full flex items-center justify-center text-sm text-gray-500"
                        style="min-height: calc(100dvh - 220px);">
                        No quick service found
                    </div>
                <?php else: ?>
                    <div class="divide-y divide-gray-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->quickServicePendingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <button type="button" wire:click="selectQuickServicePending(<?php echo e((int) $qs->id); ?>)"
                                class="w-full flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition text-left">
                                <div>
                                    <p class="text-sm font-bold text-gray-800"><?php echo e($qs->name); ?></p>
                                    <p class="text-xs text-gray-500">
                                        <?php echo e($qs->code); ?> • <?php echo e($qs->transaction_items_count); ?> item
                                        • <?php echo e($qs->created_at->format('d-m-Y H:i')); ?>

                                    </p>
                                </div>
                                <span class="text-sm font-bold text-brand-600">
                                    Rp <?php echo e(number_format($qs->total, 0, ',', '.')); ?>

                                </span>
                            </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="px-4 py-2 border-t border-gray-200 text-right text-xs text-gray-400">
                0 of <?php echo e($this->quickServicePendingList->count()); ?>

            </div>
        </div>
        
    <?php elseif($orderType === 'take_away' || ($orderType === 'dine_in' && $selectedTableId)): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($viewMode === 'menu'): ?>
            <div class="grid grid-cols-1 gap-2 p-2 md:grid-cols-12" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'view-mode-menu'; ?>wire:key="view-mode-menu">

                
                <div class="md:col-span-7 space-y-1">

                    
                    <div>
                        
                        <div class="grid grid-cols-14 gap-2 mt-1 space-y-1">
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'dine_in' && $selectedTableId): ?>
                                <h3 class="col-span-2 text-xs font-black tracking-wide text-black ">
                                    Table:
                                </h3>
                                <div class="col-span-4"> 
                                    <h3 class="text-xs font-black tracking-wide text-black ">
                                        Additional info / Cust. name
                                    </h3>
                                </div>

                                
                            <?php elseif($orderType === 'take_away'): ?>
                                <div class="col-span-14">
                                    <h3 class="text-xs font-bold tracking-wide text-gray-500 dark:text-gray-400">
                                        Order Notes
                                    </h3>
                                </div>

                                
                            <?php else: ?>
                                <div class="col-span-14">
                                    <h3 class="text-xs font-bold tracking-wide text-gray-500 dark:text-gray-400">
                                        Order Notes
                                    </h3>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div class="grid grid-cols-14 gap-2 items-center">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType == 'dine_in' && $selectedTableId): ?>
                                <div class="col-span-2">
                                    <span
                                        class="block w-full text-gray-900 dark:text-white h-8 border border-gray-300 rounded-sm px-2 py-1 bg-gray-50 dark:bg-gray-800">
                                        <?php echo e($selectedTableId); ?>

                                    </span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            
                            <div
                                class="<?php echo e($orderType == 'dine_in' && $selectedTableId ? 'col-span-12' : 'col-span-14'); ?> flex items-center gap-1">
                                <input wire:model.live.debounce.300ms="orderNotes" type="text"
                                    placeholder="Information will be printed on checker printout"
                                    class="w-full h-8 px-2 border border-gray-300 bg-white text-xs rounded-sm transition outline-none" />

                                <div class="flex items-center gap-1 shrink-0">
                                    <button type="button" wire:click="$set('phoneNumberModalOpen', true)"
                                        class="h-8 px-5 bg-brand-500 text-white text-xs font-semibold rounded-sm border transition">
                                        <img src="/assets/icons/call.png" width="15" height="15"
                                            alt="Up">
                                    </button>
                                    <button type="button" wire:click="$set('editMemberModalOpen', true)"
                                        class="h-8 px-5 bg-brand-500 text-white text-xs font-semibold rounded-sm border transition">
                                        <img src="/assets/icons/contact.png" alt="Search" class="w-5 h-5  ">
                                    </button>
                                    <button type="button" wire:click="openEditTableModal"
                                        class="h-8 px-5 bg-brand-500 text-white text-xs font-semibold rounded-sm border transition">
                                        <img src="/assets/icons/men.png" alt="Search" class="w-3 h-3  ">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="border border-gray-200 shadow-sm rounded-sm  bg-gray-100 ">
                        <div>
                            <div class="flex items-center pl-2 pr-2 pt-0.5">
                                <div class="relative flex-1">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-2 px-2 pointer-events-none bg-gray-200 border border-gray-300">
                                        <img src="/assets/icons/search.png" alt="Search"
                                            class="w-3 h-3 opacity-50 dark:invert">
                                    </div>
                                    <input wire:model.live.debounce.300ms="search" type="text"
                                        placeholder="Information will be printed on checker printout"
                                        class="w-full h-8 px-2 pl-15 border border-gray-300 bg-white text-xs rounded-l-sm transition outline-none" />
                                </div>
                                <button type="button"
                                    class="w-12 h-8 flex items-center justify-center bg-brand-500 border transition rounded-r-sm"
                                    title="Refresh">
                                    <img src="/assets/icons/resett.png" width="15" height="15"
                                        alt="Up">
                                </button>
                                <div class="flex items-center gap-2 shrink-0">
                                    <div class="flex items-center justify-between h-11 px-2 gap-3">
                                        <button type="button" wire:click="previousPage"
                                            class="p-2.5 rounded-sm text-white bg-brand-500 border border-gray-300 rounded-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-3 h-3 ">
                                                <path d="M9 4L2 12L9 20V15H22V9H9V4Z" />
                                            </svg>
                                        </button>
                                        <span class="text-sm  text-gray-800 dark:text-white whitespace-nowrap">
                                            <?php echo e($productPage); ?> of <?php echo e(ceil(count($this->productCards) / 16)); ?>

                                        </span>
                                        <button type="button" wire:click="nextPage"
                                            class="p-2.5 rounded-sm text-white bg-brand-500 border border-gray-300 rounded-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-3 h-3 rotate-180">
                                                <path d="M9 4L2 12L9 20V15H22V9H9V4Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="text-brand-500 font-bold text-xs p-2">
                            <h3>Menu</h3>
                        </div>

                        
                        <?php
                            $perPage = 16;
                            $displayProducts = array_slice(
                                $this->productCards,
                                ($productPage - 1) * $perPage,
                                $perPage,
                            );
                        ?>
                        <div wire:init="loadVariantStockStatuses"
                            class="grid grid-cols-4 gap-1.5 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4 bg-white p-2 h-[475px]">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $displayProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php
                                    $firstVariant = $product['variants'][0] ?? null;
                                    $finalPrice = (int) round(
                                        (float) ($firstVariant['price_afterdiscount'] ?? ($firstVariant['price'] ?? 0)),
                                    );
                                ?>
                                <button type="button" wire:click="addToCart(<?php echo e((int) $product['id']); ?>)"
                                    class="group flex h-[110px] w-full flex-col items-center justify-center overflow-hidden rounded-sm border border-transparent shadow-sm hover:shadow-md hover:brightness-105 transition active:scale-95"
                                    style="background-color: #F39C12;">
                                    <div class="text-center flex flex-col items-center justify-center  w-full h-full">
                                        <p class="text-xs text-white line-clamp-2 leading-snug">
                                            <?php echo e($product['name']); ?>

                                        </p>
                                        <p class="text-xs text-white/90">
                                            (<?php echo e(number_format($finalPrice, 0, ',', '.')); ?>)
                                        </p>
                                    </div>
                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <div class="col-span-full py-20 text-center">
                                    <p class="text-sm text-gray-500 ">Tidak ada produk.</p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'take_away'): ?>
                            <div class="grid grid-cols-3 w-full gap-1">
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider transition-colors duration-200 hover:text-gray-600">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="3" width="8" height="8" rx="2" />
                                        <rect x="13" y="3" width="8" height="8" rx="2" />
                                        <rect x="3" y="13" width="8" height="8" rx="2" />
                                        <rect x="13" y="13" width="8" height="8" rx="2" />
                                    </svg>
                                    Merge Table
                                </button>
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <polyline points="5 9 2 12 5 15"></polyline>
                                        <polyline points="9 5 12 2 15 5"></polyline>
                                        <polyline points="15 19 12 22 9 19"></polyline>
                                        <polyline points="19 9 22 12 19 15"></polyline>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <line x1="12" y1="2" x2="12" y2="22"></line>
                                    </svg>

                                    
                                    Move Table</button>
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <polyline points="19 5 22 8 19 11"></polyline>
                                        <line x1="2" y1="8" x2="22" y2="8"></line>

                                        <polyline points="5 13 2 16 5 19"></polyline>
                                        <line x1="2" y1="16" x2="22" y2="16"></line>
                                    </svg>
                                    Move Item</button>
                            </div>
                            <div class="grid grid-cols-3 w-full pointer-events-none">
                                <button type="button" wire:click="$set('cancelTableModalOpen', true)"
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="8" y1="5" x2="8" y2="20"></line>
                                        <line x1="11" y1="5" x2="11" y2="20"></line>
                                        <line x1="13" y1="5" x2="13" y2="20"></line>
                                        <line x1="16" y1="5" x2="16" y2="20"></line>
                                    </svg>

                                    Cancel Table
                                </button>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'dine_in' && $selectedTableId): ?>
                            <div class="grid grid-cols-3 w-full gap-1">
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider transition-colors duration-200 ">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="3" width="8" height="8" rx="2" />
                                        <rect x="13" y="3" width="8" height="8" rx="2" />
                                        <rect x="3" y="13" width="8" height="8" rx="2" />
                                        <rect x="13" y="13" width="8" height="8" rx="2" />
                                    </svg>
                                    Merge Table</button>
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider transition-colors duration-200">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <polyline points="5 9 2 12 5 15"></polyline>
                                        <polyline points="9 5 12 2 15 5"></polyline>
                                        <polyline points="15 19 12 22 9 19"></polyline>
                                        <polyline points="19 9 22 12 19 15"></polyline>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <line x1="12" y1="2" x2="12" y2="22"></line>
                                    </svg>
                                    Move Table</button>
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <polyline points="19 5 22 8 19 11"></polyline>
                                        <line x1="2" y1="8" x2="22" y2="8"></line>

                                        <polyline points="5 13 2 16 5 19"></polyline>
                                        <line x1="2" y1="16" x2="22" y2="16"></line>
                                    </svg>
                                    Move Item</button>
                            </div>
                            <div class="grid grid-cols-3 w-full gap-1">
                                <button type="button" wire:click="$set('cancelTableModalOpen', true)"
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-white rounded-xs  shadow-sm text-xs tracking-wider bg-[#DD4B39] ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="8" y1="5" x2="8" y2="20"></line>
                                        <line x1="11" y1="5" x2="11" y2="20"></line>
                                        <line x1="13" y1="5" x2="13" y2="20"></line>
                                        <line x1="16" y1="5" x2="16" y2="20"></line>
                                    </svg>
                                    Cancel Table</button>
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-gray-400 rounded-xs bg-gray-200 shadow-sm text-xs tracking-wider transition-colors duration-200">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                    </svg>
                                    Link Table</button>
                                <button type="button" wire:click="saveAsPending" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                    class="w-full h-10 flex items-center justify-center gap-2 font-bold text-white rounded-xs bg-brand-500 shadow-sm text-xs tracking-wider transition-colors duration-200 ">
                                    <img src="/assets/icons/printer.png" width="14" height="14"
                                        alt="Up">
                                    Checker</button>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div> 

                
                <div class="md:col-span-5 pt-3 space-y-1">
                    
                    <div class="flex items-center gap-1">
                        <div class="w-[10%]">
                            <button type="button" wire:click="$set('deliveryCostModalOpen', true)"
                                class="w-full flex items-center justify-center h-8 font-bold text-white rounded-sm bg-brand-500 shadow-sm">
                                <img src="/assets/icons/money.png" width="15" height="15" alt="Up">
                            </button>
                        </div>
                        <div class="w-[90%]">
                            <button type="button"
                                class="w-full h-8 bg-brand-500 text-white text-xs font-semibold rounded-sm transition shadow-sm uppercase">
                                <?php echo e($orderType === 'take_away' ? 'TAKE AWAY' : 'DINE IN'); ?>

                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-1">
                        <div class="w-[70%]">
                            <input type="text" placeholder="Promotion Description"
                                wire:model="promotionDescription" readonly
                                class="w-full h-8 px-2 border border-gray-300 bg-gray-50 text-xs rounded-sm transition shadow-sm outline-none cursor-not-allowed font-medium text-gray-700" />
                        </div>
                        <div class="w-[30%]">
                            <button type="button" wire:click="$set('promotionModalOpen', true)"
                                class="w-full flex items-center justify-center h-8 gap-2 font-bold text-white text-xs bg-brand-500 hover:bg-brand-600 rounded-sm transition shadow-sm active:scale-95">
                                <img src="/assets/icons/star.png" width="13" height="13" alt="Up">
                                <span>Add Promotion</span>
                            </button>
                        </div>
                    </div>

                    
                    <div
                        class="flex flex-col max-h-[620px] min-h-[620px] border border-gray-300 bg-white rounded-sm overflow-hidden shadow-sm">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($cartItems) > 0): ?>
                            <div
                                class="flex items-center gap-3 bg-gray-200 py-2 px-3 border-b border-gray-300 shrink-0">
                                <span
                                    class="text-xs font-black text-gray-800 w-8 text-center tracking-wider">Qty</span>
                                <h3 class="text-xs font-black text-gray-800 tracking-wider">Menu</h3>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                            <div class="space-y-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="flex items-start gap-3" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'cart-item-'.e($idx).''; ?>wire:key="cart-item-<?php echo e($idx); ?>">
                                        <div class="w-8 shrink-0 text-center">
                                            <span
                                                class="text-[10px] font-black text-brand-500 tabular-nums"><?php echo e($item['quantity']); ?></span>
                                        </div>
                                        <div class="min-w-0 flex-1 flex justify-between items-start gap-2">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-[10px] text-brand-500 uppercase truncate">
                                                    <?php echo e($item['name']); ?>

                                                </p>
                                                <p class="text-[10px] text-brand-500 font-bold">
                                                    <?php echo e(number_format((int) $item['price'], 0, ',', '.')); ?> | Total:
                                                    <?php echo e(number_format($item['quantity'] * (int) $item['price'], 0, ',', '.')); ?>

                                                </p>
                                            </div>
                                            <div class="flex items-center gap-2 shrink-0">
                                                <button type="button" wire:click="removeItem(<?php echo e($idx); ?>)"
                                                    class="w-6 h-5 bg-[#DD4B39] text-white text-[10px] rounded-xs font-bold  flex items-center justify-center">
                                                    X
                                                </button>

                                                <button type="button" title="Last created:"
                                                    class="group relative w-3 h-3 bg-gray-400 text-white text-[11px] rounded-full font-bold flex items-center justify-center transition-colors">
                                                    <span class="leading-none">i</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <div
                                        class="h-full flex items-center justify-center py-12 text-center text-xs text-gray-400 italic">
                                        No Item Selected</div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <?php $totalQty = collect($cartItems)->sum('quantity'); ?>
                        <div class=" border-t border-gray-200 shrink-0 p-2 ">
                            <div class="grid grid-cols-3 items-center justify-end text-right py-1 gap-40">
                                <div>
                                    <p class="text-[9px] text-black font-bold  ">Total</p>
                                    <p class="text-[10px]  text-black"><?php echo e($totalQty); ?></p>
                                </div>
                                <div>
                                    <p class="text-[9px] text-black font-bold  ">Subtotal</p>
                                    <p class="text-[10px]  text-black">
                                        <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

                                    </p>
                                </div>
                                <div>
                                    <p class="text-[9px] text-black font-bold  ">Billing Total</p>
                                    <p class="text-[10px]  text-black">
                                        <?php echo e(number_format($total, 0, ',', '.')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-1 ">
                            <?php
                                $isEditing = $editingTransactionId !== null;
                                $isDineIn = $orderType === 'dine_in';
                            ?>

                            
                            <div class="grid grid-cols-4 space-y-1 w-full divide-x divide-black/20">
                                <div class="col-span-1">
                                    <button type="button"
                                        class="w-full flex items-center justify-center h-10 text-white rounded-xs bg-brand-500 shadow-sm transition active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="w-[14px] h-[14px] rotate-90">
                                            <path d="M10 6L4 12L10 18V14H20V10H10V6Z" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="col-span-1">
                                    <button type="button"
                                        class="w-full flex items-center justify-center h-10 text-white rounded-xs bg-brand-500 shadow-sm transition active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="w-[14px] h-[14px] rotate-90">
                                            <path d="M14 6L20 12L14 18V14H4V10H14V6Z" />
                                        </svg>
                                    </button>
                                </div>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType === 'dine_in'): ?>
                                    <div class="col-span-2">
                                        <button type="button" wire:click="saveAsPending"
                                            <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                            class="w-full flex items-center justify-center h-10 gap-2 text-white text-xs  bg-brand-500 shadow-sm">
                                            <svg width="15" height="15" viewBox="0 0 24 24"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2v12m0 0l-4-4m4 4l4-4" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <rect x="3" y="16" width="18" height="6" rx="2" />
                                                <circle cx="17" cy="19" r="1" fill="white" />
                                                <circle cx="20" cy="19" r="1" fill="white" />
                                            </svg>
                                            <span>Save Order</span>
                                        </button>
                                    </div>

                                    
                                <?php elseif($orderType === 'take_away'): ?>
                                    <div class="col-span-2">
                                        <button type="button" wire:click="printBill"
                                            class="w-full flex items-center justify-center h-10 gap-2  text-white text-xs  bg-brand-500 shadow-sm">
                                            <img src="/assets/icons/printer.png" width="14" height="14"
                                                alt="Up">
                                            <span>Print Bill</span>
                                        </button>
                                    </div>

                                    <div class="col-span-4">
                                        <button type="button" wire:click="saveAsPending"
                                            <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                            class="w-full flex items-center justify-center h-10 gap-2  text-white text-xs  bg-brand-500 shadow-sm">
                                            <svg width="15" height="15" viewBox="0 0 24 24"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2v12m0 0l-4-4m4 4l4-4" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <rect x="3" y="16" width="18" height="6" rx="2" />
                                                <circle cx="17" cy="19" r="1" fill="white" />
                                                <circle cx="20" cy="19" r="1" fill="white" />
                                            </svg>
                                            <span>Save Order</span>
                                        </button>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isEditing): ?>
                                <div class="grid grid-cols-3 w-full divide-x divide-black/20 ">
                                    <button type="button" wire:click="printBill"
                                        class="w-full flex items-center justify-center h-10 gap-2  text-white text-xs  bg-brand-500 shadow-sm">
                                        <img src="/assets/icons/printer.png" width="14" height="14"
                                            alt="Up">
                                        <span>Print Bill</span>
                                    </button>
                                    <button type="button" wire:click="openSplitBill"
                                        class="w-full flex items-center justify-center h-10 gap-2 text-white text-xs bg-brand-500 shadow-sm">
                                        <svg width="14" height="14" viewBox="0 0 64 64" fill="none"
                                            stroke="currentColor" stroke-width="5" stroke-linecap="round"
                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="12" y="8" width="40" height="48" rx="4"
                                                ry="4" />

                                            <polyline points="20 18 25 23 32 16" />
                                            <polyline points="20 28 25 33 32 26" />
                                            <polyline points="20 38 25 43 32 36" />

                                            <line x1="38" y1="18" x2="46" y2="18" />
                                            <line x1="38" y1="28" x2="46" y2="28" />
                                            <line x1="38" y1="38" x2="46" y2="38" />
                                            <line x1="20" y1="48" x2="46" y2="48" />
                                        </svg>
                                        Split Bill
                                    </button>
                                    <button type="button" wire:click="openCheckout" <?php if(count($cartItems) === 0): echo 'disabled'; endif; ?>
                                        class="w-full flex items-center justify-center h-10 gap-2 text-white text-xs bg-brand-500
                                        shadow-sm">

                                        <img src="/assets/icons/dollar-symbol.png" width="12" height="12"
                                            alt="Payment" class="filter invert">

                                        Payment
                                    </button>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            
            <div class="grid grid-cols-1 gap-2 p-2 md:grid-cols-12 animate-in fade-in duration-150"
                <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'view-mode-payment'; ?>wire:key="view-mode-payment">
                
                <div class="md:col-span-9 space-y-1">
                    
                    <div>
                        
                        <div class="grid grid-cols-14 gap-1.5 mb-1">
                            <div class="col-span-2">
                                <h3 class="text-xs font-black tracking-wide text-gray-700 dark:text-gray-300">
                                    Table
                                </h3>
                            </div>
                            <div class="col-span-12">
                                <h3 class="text-xs font-black tracking-wide text-black dark:text-white">
                                    Member
                                </h3>
                            </div>
                        </div>

                        
                        <div class="flex items-center gap-1">
                            <div class="relative flex-1 flex gap-1.5 grid grid-cols-12">
                                
                                <div class="col-span-2">
                                    <span
                                        class="h-8 w-full flex items-center bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white px-2 text-sm font-bold rounded-sm border border-gray-300 dark:border-gray-700 whitespace-nowrap overflow-hidden text-ellipsis">
                                        <?php echo e(collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? 'Walk-In'); ?>

                                    </span>
                                </div>
                                
                                <div class="col-span-10">
                                    <input type="text" readonly wire:model="customerName"
                                        class="w-full h-8 border border-gray-300 rounded-sm bg-gray-50 px-4 text-sm dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 cursor-not-allowed" />
                                </div>
                            </div>

                            
                            <div class="flex items-center gap-1 shrink-0">
                                <button type="button" wire:click="$set('editMemberModalOpen', true)"
                                    class="h-8 px-5 bg-brand-500 text-white text-xs font-semibold rounded-sm border transition flex items-center justify-center">
                                    <img src="/assets/icons/contact.png" alt="Search" class="w-5 h-5">
                                </button>
                                <button type="button"
                                    class="h-8 px-3 flex items-center justify-center bg-brand-500 text-white text-xs font-semibold rounded-sm transition shadow-sm whitespace-nowrap">
                                    Check Online Payment
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div class=" border bg-gray-100 rounded-sm">
                        <div class="flex items-center justify-between p-2 ">
                            <h3 class="text-md font-semibold tracking-wide text-gray-700 dark:text-gray-300">Select
                                Payment Method</h3>
                            <div class="flex items-center ">
                                <div class="flex items-center justify-between h-9  gap-1">
                                    <div class="flex items-center justify-between h-11 gap-3">
                                        <button type="button" wire:click="previousPage"
                                            class="p-3 rounded-sm text-white bg-brand-500 border border-gray-300 rounded-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-3 h-3 ">
                                                <path d="M9 4L2 12L9 20V15H22V9H9V4Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <span
                                        class="text-xs font-bold text-gray-800 whitespace-nowrap"><?php echo e($paymentPage); ?>

                                        of 1</span>
                                    <div class="flex items-center justify-between h-11 px-2 gap-3">
                                        <button type="button" wire:click="previousPage"
                                            class="p-3 rounded-sm text-white bg-brand-500 border border-gray-300 rounded-lg transition">

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-3 h-3 rotate-180">
                                                <path d="M9 4L2 12L9 20V15H22V9H9V4Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div
                            class="grid grid-cols-6 gap-1 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4 bg-white shadow-sm rounded-b-sm p-2 pb-40 ">
                            <?php
                                $methods = [
                                    ['id' => 'promo', 'name' => 'ADD PROMO', 'color' => '#F39C12', 'text' => '#FFFFFF'],
                                    ['id' => 'cash', 'name' => 'CASH', 'color' => '#3C8DBC', 'text' => '#FFFFFF'],
                                    ['id' => 'card', 'name' => 'CARD', 'color' => '#3C8DBC', 'text' => '#FFFFFF'],
                                    [
                                        'id' => 'compliment',
                                        'name' => 'COMPLIMENT',
                                        'color' => '#3C8DBC',
                                        'text' => '#FFFFFF',
                                    ],
                                    [
                                        'id' => 'other',
                                        'name' => 'OTHER COST',
                                        'color' => '#3C8DBC',
                                        'text' => '#FFFFFF',
                                    ],
                                ];
                            ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button type="button"
                                    <?php if($method['id'] === 'compliment'): ?> wire:click="$set('complimentModalOpen', true)"
                            <?php elseif($method['id'] === 'card'): ?> wire:click="openCardPaymentModal" <?php elseif($method['id'] === 'other'): ?>
                                wire:click="openOtherCostModal" <?php else: ?>
                                    wire:click="$set('paymentMethod', '<?php echo e($method['id']); ?>'); $set('selectedPaymentLabel', '<?php echo e($method['name']); ?> Payment'); $set('paymentModalOpen', true);" <?php endif; ?>
                                    class="group flex min-h-[150px] w-full flex-col items-center justify-center overflow-hidden rounded-xs border border-transparent shadow-sm hover:shadow-md hover:brightness-105 transition active:scale-95"
                                    style="background-color: <?php echo e($method['color']); ?>;">
                                    <div class="text-center p-3 w-full h-full flex items-center justify-center">
                                        <p class="text-xs font-black uppercase leading-snug tracking-wider"
                                            style="color: <?php echo e($method['text']); ?>">
                                            <?php echo e($method['name']); ?>

                                        </p>
                                    </div>
                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2  gap-1  bg-white p-2 rounded-sm border border-gray-200 ">
                        <div class="space-y-1 ">
                            <div>
                                <label class="block text-[11px] font-bold text-black tracking-wider">Voucher Purchase</label>
                                <div class="grid grid-cols-6 gap-2">
                                    <!-- Ditambahkan text-right -->
                                    <input type="text" wire:model.live="voucherPaidCount" placeholder="0"
                                        class="col-span-1 w-full h-10 border border-gray-300 rounded-sm bg-gray-200 px-3 text-right text-xs font-bold" />

                                    <!-- Ditambahkan text-right -->
                                    <input type="number" wire:model.live="voucherPaidAmount" placeholder="0"
                                        class="col-span-5 w-full h-10 border border-gray-300 rounded-sm bg-gray-200 text-right text-xs font-bold" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-[11px]  text-black font-bold tracking-wider">Total Payment</label>
                                <!-- Ditambahkan text-right -->
                                <input type="text" disabled
                                    value="<?php echo e($cashReceived ? 'Rp ' . number_format((int) preg_replace('/\D+/', '', $cashReceived), 0, ',', '.') : ''); ?>"
                                    placeholder="0"
                                    class="w-full h-10 border border-gray-300 font-bold text-gray-700 rounded-sm bg-gray-200 px-3 text-right text-sm cursor-not-allowed" />
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div>
                                <label class="block text-[11px] font-bold text-black  tracking-wider">Outstanding</label>
                                <!-- Ditambahkan text-right -->
                                <input type="text" readonly placeholder="Rp 0"
                                    value="<?php echo e(number_format(max(0, $total - (int) preg_replace('/\D+/', '', $cashReceived ?? '0')), 0, ',', '.')); ?>"
                                    class="w-full h-10 border border-gray-300 rounded-sm bg-gray-200 px-3 text-right text-xs font-semibold text-black cursor-not-allowed" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-black  tracking-wider">Change</label>
                                <!-- Ditambahkan text-right -->
                                <input type="text" readonly placeholder="Rp 0"
                                    value="<?php echo e(number_format((int) $cashChange, 0, ',', '.')); ?>"
                                    class="w-full h-10 border border-gray-300 rounded-sm bg-gray-200 px-3 text-right text-xs font-bold text-black cursor-not-allowed" />
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="md:col-span-3 space-y-1 ">
                    

                    <div
                        class="overflow-hidden border border-gray-200 bg-white p-8 pb-15 pt-4 shadow-sm rounded-xs flex flex-col">
                        <div
                            class="p-4 flex-1 min-h-[550px] max-h-[440px] overflow-y-auto bg-gray-50 font-mono text-[11px] leading-relaxed custom-scrollbar border border-black">

                            <?php
                                $isDineIn = $orderType === 'dine_in';
                                $isQuickService = !$isDineIn;
                                $tableLabel = $selectedTableId
                                    ? collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? '-'
                                    : '-';
                                $infoText = $isDineIn ? $tableLabel : $editingTransactionId ?? 'PENDING';
                                $purposeText = $isDineIn ? 'DINE IN' : 'TAKE AWAY';
                            ?>

                            
                            <div class="text-center space-y-0.5 ">
                                <p class=" text-xs uppercase text-black">
                                    <?php echo e(cache('setting')?->company_name ?? 'ALAS BU YANTI'); ?>

                                </p>
                                <p class="text-[10px] text-black leading-snug px-2">
                                    <?php echo e(auth()->user()->cabang?->address ?? (cache('setting')?->address ?? 'Jl. Raya Ciawi Prapatan No.6')); ?>

                                </p>
                                <p class="text-[10px] text-black pb-1">Selamat Datang :)</p>
                            </div>

                            <div class="border-b border-dashed border-black my-1"></div>

                            
                            <div class="space-y-0.5 text-[10px] text-black">
                                <div class="flex"><span class="w-20 shrink-0">No</span><span>:
                                        <?php echo e($this->receiptCode); ?></span></div>
                                <div class="flex"><span class="w-20 shrink-0">Date</span><span>:
                                        <?php echo e(now()->format('d-m-Y')); ?></span></div>
                                <div class="flex"><span class="w-20 shrink-0">Server</span><span>:
                                        <?php echo e(auth()->user()->name); ?></span></div>
                                <div class="flex"><span class="w-20 shrink-0">Table</span><span>:
                                        <?php echo e($isDineIn ? $tableLabel : '-'); ?></span></div>
                                <div class="flex"><span class="w-20 shrink-0">Pax</span><span>:
                                        <?php echo e($numberOfPax); ?></span></div>
                                <div class="flex"><span class="w-20 shrink-0">Cashier</span><span>:
                                        <?php echo e(auth()->user()->name); ?></span></div>
                                <div class="flex"><span class="w-20 shrink-0">Print</span><span>:
                                        0</span></div>
                            </div>

                            <div class="border-b border-dashed border-black my-1"></div>

                            
                            <div class="space-y-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="space-y-0.5">
                                        <p class="truncate">
                                            <?php echo e($item['name']); ?>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item['variant_name'])): ?>
                                                <span class="text-gray-400">(<?php echo e($item['variant_name']); ?>)</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </p>
                                        <div class="flex justify-between">
                                            <span><?php echo e($item['quantity']); ?>x
                                                <?php echo e('@' . number_format($item['price'], 0, ',', '.')); ?></span>
                                            <span class="tabular-nums font-medium text-gray-900">
                                                <?php echo e(number_format($item['quantity'] * $item['price'], 0, ',', '.')); ?>

                                            </span>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>

                            <div class="border-b border-dashed border-black my-1"></div>

                            
                            <?php
                                $totalQtyStruk = collect($cartItems)->sum('quantity');
                                $currentCompliment = (int) ($this->appliedComplimentAmount ?? 0);
                            ?>
                            <div class=" text-gray-700">
                                <p class="text-[10px] text-black"><?php echo e($totalQtyStruk); ?> items</p>
                                <div class="border-b border-dashed border-black my-1"></div>
                                <div class="flex justify-end gap-2">
                                    <span>Subtotal</span>
                                    <span
                                        class="tabular-nums  text-black"><?php echo e(number_format($subtotal, 0, ',', '.')); ?></span>
                                </div>

                                <div class="flex justify-end gap-2">
                                    <span>Delivery Cost</span>
                                    <span class="tabular-nums text-black">0</span>
                                </div>

                                <div class="flex justify-end gap-2">
                                    <span>Order Fee</span>
                                    <span class="tabular-nums text-black">0</span>
                                </div>


                                    <div class="flex justify-end gap-2">
                                        <span>Menu Discount</span>
                                        <span
                                            class="tabular-nums text-black">-<?php echo e(number_format($discountTotalAmount, 0, ',', '.')); ?></span>
                                    </div>


                                

                                    <div class="flex justify-end gap-2">
                                        <span>Service Charge</span>
                                        <span
                                            class="tabular-nums text-black"><?php echo e(number_format($serviceAmount, 0, ',', '.')); ?></span>
                                    </div>


                                

                                    <div class="flex justify-end gap-2">
                                        <span>PB1 Total</span>
                                        <span
                                            class="tabular-nums text-black"><?php echo e(number_format($taxAmount, 0, ',', '.')); ?></span>
                                    </div>


                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentCompliment > 0): ?>
                                    <div class="flex justify-end gap-2 text-red-600 font-bold">
                                        <span>Compliment</span>
                                        <span
                                            class="tabular-nums">-<?php echo e(number_format($currentCompliment, 0, ',', '.')); ?></span>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="border-b border-dashed border-black my-1"></div>

                            
                            <div class="text-gray-700">
                                <div class="flex justify-end gap-2">
                                    <span>Billing Total</span>
                                    <span
                                        class="tabular-nums text-black"><?php echo e(number_format($total, 0, ',', '.')); ?></span>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <span>Voucher Purchase</span>
                                    <span class="tabular-nums text-black">0</span>
                                </div>
                            </div>

                            <div class="border-b border-dashed border-black my-1"></div>

                            
                            <?php
                                $currentCompliment = (int) ($this->appliedComplimentAmount ?? 0);
                                $grandTotal = max(0, $total - $currentCompliment);

                                $statusText = match ($paymentMethod === 'paid' ? 'paid' : 'pending') {
                                    'paid' => '--- Thank You ---',
                                    'voided' => '--- Void ---',
                                    default => '--- Not Paid ---',
                                };
                            ?>

                            <div class="flex justify-end items-center gap-2 text-black mb-5">
                                <span class="text-[10px] tracking-wider">Grand Total</span>
                                <span class="text-[10px] tabular-nums ">
                                    <?php echo e(number_format(max(0, $grandTotal), 0, ',', '.')); ?>

                                </span>
                            </div>

                            <div class="border-b border-dashed border-black"></div>

                            <div class="text-center text-[10px] font-semibold text-black pt-1 tracking-wide">
                                <?php echo e($statusText); ?>

                            </div>
                        </div>
                    </div>
                    <div class=" bg-white space-y-1">
                        <div class="grid grid-cols-4 w-full">
                            <button type="button"
                                class="col-span-1 h-10 w-full text-white flex items-center justify-center bg-brand-500 rounded-sm border border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-3 h-3 ">
                                    <path d="M9 4L2 12L9 20V15H22V9H9V4Z" />
                                </svg>
                            </button>
                            <button type="button"
                                class="col-span-1 h-10 w-full flex text-white items-center justify-center bg-brand-500 rounded-sm border border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-3 h-3 rotate-180">
                                    <path d="M9 4L2 12L9 20V15H22V9H9V4Z" />
                                </svg>
                            </button>
                            <button type="button"
                                class="col-span-2 w-full h-10 flex items-center justify-center gap-2  text-white rounded-xs bg-brand-500 shadow-sm text-xs tracking-wider transition-colors duration-200"
                                wire:click="$set('purchaseVoucherModalOpen', true)">
                                <img src="/assets/icons/gift.png" width="15" height="15" alt="Up">
                                Purchase Voucher
                            </button>
                        </div>
                        <button type="button" wire:click="savePayment"
                            class="w-full flex items-center gap-2 justify-center h-10 text-white rounded-xs bg-brand-500 shadow-sm transition active:scale-95 text-xs">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2v12m0 0l-4-4m4 4l4-4" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <rect x="3" y="16" width="18" height="6" rx="2" />
                                <circle cx="17" cy="19" r="1" fill="white" />
                                <circle cx="20" cy="19" r="1" fill="white" />
                            </svg>
                            Save Payment
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($checkoutModalOpen): ?>
            <?php
                $paymentMethods = [
                    ['id' => 'cash', 'name' => 'Tunai'],
                    ['id' => 'qris', 'name' => 'QRIS'],
                    ['id' => 'transfer_bank', 'name' => 'Transfer Bank'],
                    ['id' => 'gofood', 'name' => 'GoFood'],
                    ['id' => 'grab_food', 'name' => 'GrabFood'],
                    ['id' => 'shopee_food', 'name' => 'ShopeeFood'],
                ];
                // 1. Definisikan variabelnya di sini agar bisa dibaca oleh seluruh kode di bawahnya
                $isDineIn = $orderType === 'dine_in';
                $isEditing = $editingTransactionId !== null;
                $isFinalPayment = $orderType === 'take_away' || ($isDineIn && $isEditing);
                $directToStep3 = $isDineIn;
            ?>
            <template x-teleport="<?php echo e('body'); ?>">
                <div class="fixed inset-0 z-[100000] overflow-y-auto" aria-modal="true" role="dialog">
                    <div class="fixed inset-0 bg-black/50" wire:click="$set('checkoutModalOpen', false)"></div>
                    <div class="relative flex min-h-full items-center justify-center p-4 sm:items-center">
                        <div
                            class="relative flex w-full max-w-2xl max-h-[85vh] flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                            <div class="min-h-0 flex flex-1 flex-col">
                                <div class="min-h-0 flex flex-col">
                                    <div
                                        class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Checkout -
                                                Langkah <?php echo e($checkoutStep); ?>/3</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($checkoutStep === 1): ?>
                                                    Data Pelanggan
                                                <?php elseif($checkoutStep === 2): ?>
                                                    Diskon & Voucher
                                                <?php else: ?>
                                                    Pembayaran
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </p>
                                        </div>
                                        <button type="button" wire:click="$set('checkoutModalOpen', false)"
                                            class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                            Tutup
                                        </button>
                                    </div>

                                    <div class="min-h-0 flex-1 overflow-y-auto p-6 pb-24">
                                        <div
                                            class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950 mb-6">
                                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-5">
                                                <div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Subtotal</p>
                                                    <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                        Rp
                                                        <?php echo e(number_format((int) $subtotal, 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Diskon</p>
                                                    <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                        Rp
                                                        <?php echo e(number_format((int) ($discountTotalAmount ?? 0), 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType !== 'take_away'): ?>
                                                    <div>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">Service</p>
                                                        <p
                                                            class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                            Rp <?php echo e(number_format((int) $serviceAmount, 0, ',', '.')); ?></p>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Pajak PB1</p>
                                                    <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                        Rp
                                                        <?php echo e(number_format((int) $taxAmount, 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                                <div class="sm:text-right">
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                                                    <p class="mt-1 text-base font-bold text-gray-900 dark:text-white/90">Rp
                                                        <?php echo e(number_format((int) $total, 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($checkoutStep === 1): ?>
                                            <div
                                                class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                                <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Customer
                                                </p>
                                                <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                    <div class="sm:col-span-2">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('members.view')): ?>
                                                            <label
                                                                class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Member
                                                                (Opsional)</label>
                                                            <select wire:model.live="memberId"
                                                                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                                <?php if($cartLocked): echo 'disabled'; endif; ?>>
                                                                <option value="">-</option>
                                                                <?php
                                                                    $user = auth()->user();
                                                                    $canViewMemberPii =
                                                                        (bool) ($user && method_exists($user, 'can')
                                                                            ? $user->can('members.pii.view')
                                                                            : false);
                                                                    $maskPhone = function ($phone): string {
                                                                        $phone = trim((string) ($phone ?? ''));
                                                                        if ($phone === '') {
                                                                            return '';
                                                                        }
                                                                        $len = strlen($phone);
                                                                        if ($len <= 4) {
                                                                            return str_repeat('*', max(0, $len - 1)) .
                                                                                substr($phone, -1);
                                                                        }

                                                                        return substr($phone, 0, 2) .
                                                                            str_repeat('*', max(0, $len - 6)) .
                                                                            substr($phone, -4);
                                                                    };
                                                                ?>
                                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                                    <?php
                                                                        $phoneLabel = '';
                                                                        if ($m->phone) {
                                                                            $phoneLabel = $canViewMemberPii
                                                                                ? (string) $m->phone
                                                                                : $maskPhone($m->phone);
                                                                        }
                                                                    ?>
                                                                    <option value="<?php echo e((int) $m->id); ?>">
                                                                        <?php echo e($m->name); ?><?php echo e($phoneLabel !== '' ? ' (' . $phoneLabel . ')' : ''); ?>

                                                                    </option>
                                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                            </select>
                                                        <?php else: ?>
                                                            <div
                                                                class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-xs text-gray-600 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-400">
                                                                Anda tidak memiliki akses untuk memilih member.
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Nama</label>
                                                        <input wire:model.live="customerName" type="text"
                                                            aria-invalid="<?php echo e($errors->has('customerName') ? 'true' : 'false'); ?>"
                                                            aria-describedby="<?php echo e($errors->has('customerName') ? 'error-customerName' : ''); ?>"
                                                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                            placeholder="Walk-in" <?php if($cartLocked): echo 'disabled'; endif; ?> />
                                                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'customerName']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerName']); ?>
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
                                                        <label
                                                            class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Telepon
                                                            (Opsional)</label>
                                                        <input wire:model.live="customerPhone" type="text"
                                                            aria-invalid="<?php echo e($errors->has('customerPhone') ? 'true' : 'false'); ?>"
                                                            aria-describedby="<?php echo e($errors->has('customerPhone') ? 'error-customerPhone' : ''); ?>"
                                                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                            placeholder="08xxxx" <?php if($cartLocked): echo 'disabled'; endif; ?> />
                                                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'customerPhone']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'customerPhone']); ?>
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
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($checkoutStep === 2): ?>
                                            <div
                                                class="mb-4 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                                <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Voucher
                                                </p>
                                                <div class="mt-3">
                                                    <label
                                                        class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Kode
                                                        Voucher (Opsional)</label>
                                                    <input wire:model.live.debounce.500ms="voucherCodeInput"
                                                        type="text"
                                                        aria-invalid="<?php echo e($errors->has('voucherCodeInput') ? 'true' : 'false'); ?>"
                                                        aria-describedby="<?php echo e($errors->has('voucherCodeInput') ? 'error-voucherCodeInput' : ''); ?>"
                                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 disabled:opacity-50 disabled:cursor-not-allowed"
                                                        placeholder="Masukkan kode voucher"
                                                        <?php if($cartLocked): echo 'disabled'; endif; ?> />
                                                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'voucherCodeInput']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'voucherCodeInput']); ?>
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
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim((string) ($voucherCodeInput ?? '')) !== ''): ?>
                                                        <p
                                                            class="mt-1 text-xs <?php echo e($voucherValid ?? false ? 'text-success-600' : 'text-gray-500 dark:text-gray-400'); ?>">
                                                            <?php echo e($voucherMessage); ?>

                                                        </p>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartLocked && trim((string) ($voucherCodeInput ?? '')) !== ''): ?>
                                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Voucher
                                                            mengikuti pesanan self-order.</p>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            </div>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($memberId && ($memberPoints > 0 || $pointsToRedeem > 0)): ?>
                                                <div
                                                    class="mb-4 rounded-2xl border border-brand-200 bg-brand-50 p-4 dark:border-brand-800 dark:bg-brand-900/20">
                                                    <div class="flex items-center justify-between">
                                                        <div>
                                                            <p
                                                                class="text-sm font-semibold text-brand-800 dark:text-brand-300">
                                                                Poin Member</p>
                                                            <p class="text-xs text-brand-600 dark:text-brand-400">
                                                                Tersedia: <?php echo e(number_format($memberPoints, 0, ',', '.')); ?>

                                                                Poin
                                                            </p>
                                                        </div>
                                                        <div class="text-right">
                                                            <label class="inline-flex items-center cursor-pointer">
                                                                <input type="checkbox" wire:model.live="redeemPoints"
                                                                    class="sr-only peer" <?php if($cartLocked): echo 'disabled'; endif; ?>>
                                                                <div
                                                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-300 dark:peer-focus:ring-brand-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-brand-600">
                                                                </div>
                                                                <span
                                                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tukar</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($redeemPoints): ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pointsToRedeem > 0): ?>
                                                            <div class="mt-2 text-xs text-brand-700 dark:text-brand-300">
                                                                Menukar
                                                                <b><?php echo e(number_format($pointsToRedeem, 0, ',', '.')); ?></b>
                                                                poin =
                                                                Diskon <b>Rp
                                                                    <?php echo e(number_format($pointDiscountAmount, 0, ',', '.')); ?></b>
                                                            </div>
                                                        <?php elseif($memberPoints < $minRedemptionPoints): ?>
                                                            <div class="mt-2 text-xs text-error-600">
                                                                Minimal penukaran
                                                                <?php echo e(number_format($minRedemptionPoints, 0, ',', '.')); ?>

                                                                poin.
                                                            </div>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartLocked && $pointsToRedeem > 0): ?>
                                                        <div class="mt-2 text-xs text-brand-700 dark:text-brand-300">
                                                            Poin mengikuti pesanan self-order.
                                                        </div>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            <div
                                                class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950">
                                                <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Diskon
                                                    Manual
                                                </p>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discounts.manual.apply')): ?>
                                                    <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2">
                                                        <div>
                                                            <label
                                                                class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Tipe</label>
                                                            <select wire:model.live="manualDiscountType"
                                                                aria-invalid="<?php echo e($errors->has('manualDiscountType') ? 'true' : 'false'); ?>"
                                                                aria-describedby="<?php echo e($errors->has('manualDiscountType') ? 'error-manualDiscountType' : ''); ?>"
                                                                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                                                <option value="">-</option>
                                                                <option value="percent">Persen (%)</option>
                                                                <option value="fixed_amount">Nominal (Rp)</option>
                                                            </select>
                                                            <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'manualDiscountType']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'manualDiscountType']); ?>
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
                                                            <label
                                                                class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Nilai</label>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($manualDiscountType === 'fixed_amount'): ?>
                                                                <input x-data="currencyInput($wire.entangle('manualDiscountValue').live.debounce .500 ms)" x-model="displayValue"
                                                                    @input="handleInput" type="text" inputmode="numeric"
                                                                    aria-invalid="<?php echo e($errors->has('manualDiscountValue') ? 'true' : 'false'); ?>"
                                                                    aria-describedby="<?php echo e($errors->has('manualDiscountValue') ? 'error-manualDiscountValue' : ''); ?>"
                                                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                            <?php else: ?>
                                                                <input wire:model.live="manualDiscountValue" type="number"
                                                                    min="0"
                                                                    aria-invalid="<?php echo e($errors->has('manualDiscountValue') ? 'true' : 'false'); ?>"
                                                                    aria-describedby="<?php echo e($errors->has('manualDiscountValue') ? 'error-manualDiscountValue' : ''); ?>"
                                                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                            <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'manualDiscountValue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'manualDiscountValue']); ?>
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
                                                        <div class="sm:col-span-2">
                                                            <label
                                                                class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Catatan
                                                                (Opsional)</label>
                                                            <textarea wire:model.live="manualDiscountNote" rows="2"
                                                                aria-invalid="<?php echo e($errors->has('manualDiscountNote') ? 'true' : 'false'); ?>"
                                                                aria-describedby="<?php echo e($errors->has('manualDiscountNote') ? 'error-manualDiscountNote' : ''); ?>"
                                                                class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                                placeholder="Contoh: kompensasi komplain"></textarea>
                                                            <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'manualDiscountNote']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'manualDiscountNote']); ?>
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
                                                <?php else: ?>
                                                    <div
                                                        class="mt-3 rounded-lg border border-gray-200 bg-white px-4 py-3 text-xs text-gray-600 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-400">
                                                        Anda tidak memiliki izin untuk memberikan diskon manual.
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($manualDiscountAmount ?? 0) > 0): ?>
                                                    <div
                                                        class="mt-4 flex items-center justify-between rounded-xl bg-success-50 p-3 border border-success-100 dark:bg-success-900/20 dark:border-success-900/30">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-5 h-5 text-success-600 dark:text-success-400"
                                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                </path>
                                                            </svg>
                                                            <span
                                                                class="text-sm font-semibold text-success-700 dark:text-success-300">Total
                                                                Diskon</span>
                                                        </div>
                                                        <span
                                                            class="text-sm font-bold text-success-700 dark:text-success-300">Rp
                                                            <?php echo e(number_format((int) $manualDiscountAmount, 0, ',', '.')); ?></span>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($checkoutStep === 3): ?>
                                            <div class="space-y-4">
                                                
                                                <div
                                                    class="bg-blue-50 dark:bg-blue-900/20 p-5 rounded-2xl border border-blue-100 dark:border-blue-800">
                                                    <div class="flex justify-between items-start ">
                                                        <div>
                                                            <p
                                                                class="text-xs text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">
                                                                Menu</p>
                                                            <p class="text-xl font-black text-blue-900 dark:text-white">
                                                                <?php echo e($customerName); ?>

                                                            </p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p
                                                                class="text-xs text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">
                                                                Status</p>
                                                            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                                'px-2 py-1 rounded text-[10px] font-bold uppercase',
                                                                'bg-orange-100 text-orange-700' => !$isFinalPayment,
                                                                'bg-[#3C8DBC]/10 text-[#3C8DBC] border border-[#3C8DBC]/20' => $isFinalPayment,
                                                            ]); ?>">
                                                                <?php echo e($isFinalPayment ? 'Pelunasan / Bayar' : 'Dine In'); ?>

                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="pt-4 border-t border-blue-200 dark:border-blue-700 flex justify-between items-center">
                                                        <span class="font-bold text-blue-900 dark:text-white text-lg">Total
                                                            Bill</span>
                                                        <span class="text-3xl font-black text-brand-600">
                                                            
                                                            Rp
                                                            <?php echo e(number_format($isFinalPayment ? $total : $subtotal, 0, ',', '.')); ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isFinalPayment): ?>
                                                    
                                                    <div
                                                        class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                                        <div class="flex items-center justify-between">
                                                            <p
                                                                class="text-sm font-semibold text-gray-800 dark:text-white/90">
                                                                Pembayaran</p>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderType !== 'take_away'): ?>
                                                                <div class="w-32">
                                                                    <label
                                                                        class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Service
                                                                        (%)</label>
                                                                    <div class="relative">
                                                                        <input wire:model.live="serviceRate"
                                                                            type="number" min="0" max="100"
                                                                            step="0.01"
                                                                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-7 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                                        <div
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                            <span
                                                                                class="text-gray-500 dark:text-gray-400">%</span>
                                                                        </div>
                                                                    </div>
                                                                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'serviceRate']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'serviceRate']); ?>
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
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                            
                                                            <div class="w-32">
                                                                <label
                                                                    class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Pajak
                                                                    PB1 (%)</label>
                                                                <div class="relative">
                                                                    <input wire:model.live="taxRate" type="number"
                                                                        min="0" max="100" step="0.01"
                                                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-7 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <span
                                                                            class="text-gray-500 dark:text-gray-400">%</span>
                                                                    </div>
                                                                </div>
                                                                <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'taxRate']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'taxRate']); ?>
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
                                                        <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                            <div class="sm:col-span-2">
                                                                <label
                                                                    class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Metode
                                                                    Bayar</label>
                                                                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                                        <button type="button"
                                                                            wire:click="$set('paymentMethod', '<?php echo e($pm['id']); ?>')"
                                                                            class="flex flex-col items-center justify-center rounded-xl border p-3 text-center transition-all duration-200 hover:shadow-md
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php echo e($paymentMethod === $pm['id']
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ? 'border-brand-500 bg-brand-50 text-brand-700 ring-2 ring-brand-500/20 dark:border-brand-400 dark:bg-brand-900/20 dark:text-brand-300'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            : 'border-gray-200 bg-white text-gray-600 hover:border-brand-300 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-800'); ?>">
                                                                            <div
                                                                                class="mb-2 flex h-8 w-8 items-center justify-center rounded-full
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php echo e($paymentMethod === $pm['id'] ? 'bg-brand-100 text-brand-600 dark:bg-brand-900/40 dark:text-brand-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400'); ?>">
                                                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pm['id'] === 'cash'): ?>
                                                                                    <svg class="w-5 h-5" fill="none"
                                                                                        stroke="currentColor"
                                                                                        viewBox="0 0 24 24">
                                                                                        <path stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                                                        </path>
                                                                                    </svg>
                                                                                <?php elseif($pm['id'] === 'qris'): ?>
                                                                                    <svg class="w-5 h-5" fill="none"
                                                                                        stroke="currentColor"
                                                                                        viewBox="0 0 24 24">
                                                                                        <path stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                                                                        </path>
                                                                                    </svg>
                                                                                <?php elseif(str_contains($pm['id'], 'food')): ?>
                                                                                    <svg class="w-5 h-5" fill="none"
                                                                                        stroke="currentColor"
                                                                                        viewBox="0 0 24 24">
                                                                                        <path stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                                                                                        </path>
                                                                                    </svg>
                                                                                <?php else: ?>
                                                                                    <svg class="w-5 h-5" fill="none"
                                                                                        stroke="currentColor"
                                                                                        viewBox="0 0 24 24">
                                                                                        <path stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                                                        </path>
                                                                                    </svg>
                                                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                            </div>
                                                                            <span
                                                                                class="text-xs font-medium"><?php echo e($pm['name']); ?></span>
                                                                        </button>
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                                </div>
                                                                <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'paymentMethod','class' => 'mt-2 text-center text-xs text-error-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'paymentMethod','class' => 'mt-2 text-center text-xs text-error-600']); ?>
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

                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentMethod === 'cash'): ?>
                                                                <div class="sm:col-span-2">
                                                                    <label
                                                                        class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Uang
                                                                        Diterima</label>
                                                                    <div class="relative">
                                                                        <div
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                            <span
                                                                                class="text-gray-500 dark:text-gray-400 font-semibold">Rp</span>
                                                                        </div>
                                                                        <input x-data="currencyInput($wire.entangle('cashReceived').live)"
                                                                            x-model="displayValue" @input="handleInput"
                                                                            type="text" inputmode="numeric"
                                                                            aria-invalid="<?php echo e($errors->has('cashReceived') ? 'true' : 'false'); ?>"
                                                                            aria-describedby="<?php echo e($errors->has('cashReceived') ? 'error-cashReceived' : ''); ?>"
                                                                            class="dark:bg-dark-900 shadow-theme-xs h-12 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pl-10 text-lg font-bold text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:focus:border-brand-400"
                                                                            placeholder="0" />
                                                                    </div>
                                                                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'cashReceived']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'cashReceived']); ?>
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

                                                                    <!-- Quick Amount Suggestions -->
                                                                    <div class="mt-3 flex flex-wrap gap-2">
                                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [20000, 50000, 100000, 200000]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($amt >= $total): ?>
                                                                                <button type="button"
                                                                                    wire:click="$set('cashReceived', '<?php echo e($amt); ?>')"
                                                                                    class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                                                    Rp
                                                                                    <?php echo e(number_format($amt, 0, ',', '.')); ?>

                                                                                </button>
                                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                                        <button type="button"
                                                                            wire:click="$set('cashReceived', '<?php echo e($total); ?>')"
                                                                            class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                                            Uang Pas
                                                                        </button>
                                                                    </div>

                                                                    <div
                                                                        class="mt-4 rounded-xl bg-gray-100 p-4 dark:bg-gray-800">
                                                                        <div class="flex justify-between items-center">
                                                                            <span
                                                                                class="text-sm text-gray-600 dark:text-gray-400">Total
                                                                                Tagihan</span>
                                                                            <span
                                                                                class="text-sm font-semibold text-gray-900 dark:text-white">Rp
                                                                                <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                                                                        </div>
                                                                        <div
                                                                            class="mt-2 flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-700">
                                                                            <span
                                                                                class="text-base font-medium text-gray-800 dark:text-white/90">Kembalian</span>
                                                                            <span class="text-xl font-bold text-[#3C8CBC]">
                                                                                Rp
                                                                                <?php echo e(number_format((int) $cashChange, 0, ',', '.')); ?>

                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    
                                                    <div
                                                        class="p-6 bg-gray-100 dark:bg-gray-800 rounded-2xl text-center border-2 border-dashed border-gray-300 dark:border-gray-700">
                                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                        </svg>
                                                        <p class="text-gray-600 dark:text-gray-300 font-medium">Pesanan
                                                            akan
                                                            disimpan dan meja akan ditandai sebagai <span
                                                                class="text-red-600 font-bold">Terisi</span>.</p>
                                                        <p class="text-xs text-gray-400 mt-1">Pembayaran dilakukan nanti
                                                            saat
                                                            pelanggan selesai makan.</p>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <div
                                        class="border-t border-gray-200 bg-white px-6 py-4 dark:border-gray-800 dark:bg-gray-900">
                                        <div
                                            class="flex flex-col-reverse items-stretch justify-between gap-2 sm:flex-row sm:items-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($checkoutStep > 1): ?>
                                                <button type="button" wire:click="prevStep"
                                                    class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                                                    Kembali
                                                </button>
                                            <?php else: ?>
                                                <button type="button" wire:click="$set('checkoutModalOpen', false)"
                                                    class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                                                    Batal
                                                </button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($checkoutStep < 3): ?>
                                                <button type="button" wire:click="nextStep"
                                                    class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                                                    Lanjut
                                                </button>
                                            <?php else: ?>
                                                <button type="button" wire:click="checkout"
                                                    wire:loading.attr="disabled" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                        'flex-[2] px-6 py-3 rounded-xl font-black transition text-lg text-white shadow-lg',
                                                        'bg-[#3C8DBC] ' => $isFinalPayment, // Jika Bayar - Header Blue
                                                        'bg-blue-600' => !$isFinalPayment, // Jika Booking
                                                    ]); ?>">
                                                    <?php echo e($isFinalPayment ? 'Lunasi Sekarang' : 'Kirim Ke Dapur'); ?>

                                                </button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($voidItemModalOpen): ?>
            <template x-teleport="<?php echo e('body'); ?>">
                <div class="fixed inset-0 z-[100001] flex items-center justify-center p-4">
                    
                    <div class="absolute inset-0 bg-gray-900/60 " wire:click="$set('voidItemModalOpen', false)">
                    </div>

                    <div
                        class="relative w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 animate-in fade-in zoom-in duration-200">

                        
                        <div
                            class="bg-red-50 dark:bg-red-900/20 px-6 py-5 border-b border-red-100 dark:border-red-900/30">
                            <div class="flex items-center gap-3 text-red-600 dark:text-red-400">
                                <div class="p-2 bg-red-100 dark:bg-red-800/40 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-black uppercase tracking-tight">Otorisasi Void Item</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            
                            <?php
                                $itemToVoid = $cartItems[$voidItemIndex] ?? null;
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($itemToVoid): ?>
                                <div
                                    class="mb-5 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Item
                                        yang
                                        dipilih:</p>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-black text-gray-800 dark:text-white uppercase">
                                                <?php echo e($itemToVoid['name']); ?>

                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <?php echo e($itemToVoid['variant_name'] ?? 'Porsi Standar'); ?>

                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span
                                                class="text-xs font-bold text-red-500 bg-red-50 dark:bg-red-900/30 px-2 py-1 rounded-sm"><?php echo e($itemToVoid['quantity']); ?>

                                                item</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="space-y-5">
                                
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Alasan
                                        Penghapusan</label>
                                    <textarea wire:model.live="voidItemReason" rows="2"
                                        class="w-full rounded-2xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-4 py-3 focus:ring-red-500 focus:border-red-500 dark:text-white transition shadow-sm"
                                        placeholder="Misal: Customer batal pesan, salah input menu..."></textarea>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['voidItemReason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-[10px] font-bold text-red-500 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <?php echo e($message); ?>

                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-500 mb-1.5 uppercase tracking-wider text-center">PIN
                                        Otorisasi Manager</label>
                                    <div class="relative">
                                        <input type="password" wire:model.live="voidItemPin" maxlength="6"
                                            inputmode="numeric"
                                            class="w-full h-14 text-center text-3xl font-black tracking-[0.5em] rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:border-red-500 focus:ring-red-500 dark:text-white transition"
                                            placeholder="••••••" />
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['voidItemPin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span
                                            class="text-[10px] font-bold text-red-500 mt-1 flex justify-center items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <?php echo e($message); ?>

                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        
                        <div class="p-4 bg-gray-50 dark:bg-gray-800/80 flex gap-3">
                            <button type="button" wire:click="$set('voidItemModalOpen', false)"
                                class="flex-1 h-12 font-bold text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-2xl transition">
                                Batal
                            </button>
                            <button type="button" wire:click="confirmVoidItem"
                                class="flex-[2] h-12 bg-[#DD4B39] text-white rounded-2xl font-black shadow-lg shadow-red-500/30 uppercase tracking-wider transition active:scale-95">
                                Hapus Menu Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectTableModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 z-[100005] flex items-center justify-center p-4" aria-modal="true"
                role="dialog">

                
                <div class="absolute inset-0 bg-black/40 transition-opacity"
                    wire:click="$set('selectTableModalOpen', false)">
                </div>

                
                <div
                    class="relative w-full max-w-lg overflow-hidden rounded-xl bg-white shadow-xl dark:bg-gray-900 border border-gray-200 dark:border-gray-800 animate-in fade-in zoom-in-95 duration-150">

                    
                    <div
                        class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                        <h3 class="text-base font-bold text-gray-800 dark:text-white">
                            Book Table (<?php echo e('Table ' . $tableToSelectLabel ?? 'Table 1'); ?>)
                        </h3>
                        <button type="button" wire:click="$set('selectTableModalOpen', false)"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    
                    <div class="p-5 space-y-5">

                        
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2 uppercase tracking-wide">
                                Number of pax
                            </label>
                            <input wire:model.defer="numberOfPax" type="number" min="1"
                                class="w-full h-11 border border-gray-300 rounded-lg bg-white px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-900 dark:text-white dark:border-gray-700"
                                placeholder="1" />

                            
                            <div
                                class="flex items-center gap-1.5 my-2 rounded-lg w-full overflow-x-auto custom-scrollbar">
                                 <button type="button" wire:click="decrementPax"
                                    class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded-md text-gray-600 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 transition shrink-0 font-bold active:scale-95 shadow-xs">
                                    &lt;
                                </button>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [1, 2, 3, 4, 5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <button type="button" wire:click="$set('numberOfPax', <?php echo e($amt); ?>)"
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'w-10 h-10 flex items-center justify-center text-sm font-bold rounded-sm transition shrink-0 active:scale-95',
                                            'bg-brand-500 text-white shadow-xs' => $numberOfPax == $amt,
                                            'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 shadow-xs' =>
                                                $numberOfPax != $amt,
                                        ]); ?>">
                                        <?php echo e($amt); ?>

                                    </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                
                                <button type="button" wire:click="incrementPax"
                                    class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded-sm text-gray-600 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 transition shrink-0 font-bold active:scale-95 shadow-xs">
                                    &gt;
                                </button>
                            </div>
                        </div>

                        
                        <div>
                            <span
                                class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-wide">
                                Sales Mode: <span class="text-gray-800 dark:text-white font-bold">Dine In</span>
                            </span>

                            
                            <button type="button"
                                class="h-11 px-6 font-bold text-xs rounded-lg border-2 border-[#3C8DBC] bg-blue-50 text-[#3C8DBC] dark:bg-blue-950/30 dark:text-blue-400 transition cursor-default">
                                Dine In
                            </button>
                        </div>

                    </div>

                    
                    <div
                        class="border-t border-gray-200 bg-gray-50 px-5 py-3 dark:border-gray-800 dark:bg-gray-950 flex items-center justify-between">

                        
                        <button type="button" wire:click="$set('selectTableModalOpen', false)"
                            class="h-10 px-4 text-xs font-bold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition">
                            Close
                        </button>

                        
                        <div class="flex items-center gap-2">
                            <button type="button" wire:click="confirmSelectTable('booking')"
                                class="h-10 px-4 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-xs font-bold rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                                Book Table
                            </button>

                            <button type="button" wire:click="confirmSelectTable('order')"
                                class="h-10 px-4 bg-brand-500 hover:bg-brand-600 text-white text-xs font-bold rounded-lg shadow-sm transition">
                                Book & Order
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 z-[100010] flex items-center justify-center p-4 animate-in fade-in duration-100"
                aria-modal="true" role="dialog">

                
                <div class="absolute inset-0 bg-black/40 " wire:click="$set('paymentModalOpen', false)">
                </div>

                
                <div
                    class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transform scale-100 transition-all">

                    
                    <div
                        class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800 bg-gray-50 dark:bg-gray-950">
                        <h3
                            class="text-sm font-black uppercase text-gray-800 dark:text-white tracking-wider flex items-center gap-2">
                            💳 <?php echo e($selectedPaymentLabel); ?>

                        </h3>
                        <button type="button" wire:click="$set('paymentModalOpen', false)"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    
                    <div class="p-5 space-y-4 bg-white dark:bg-gray-900">

                        
                        <div class="flex items-end gap-2 w-full">
                            
                            <div class="w-1/3 space-y-1">
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Outstanding</label>
                                <input type="text" readonly value="Rp <?php echo e(number_format($total, 0, ',', '.')); ?>"
                                    class="w-full h-10 border border-gray-200 bg-gray-100 text-red-600 font-bold px-3 text-xs rounded-lg dark:bg-gray-800 dark:border-gray-700 cursor-not-allowed tabular-nums" />
                            </div>

                            
                            <div class="flex-1 space-y-1">
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Cash
                                    Amount</label>
                                <input type="text" wire:model.live="cashReceived" placeholder="Masukkan Nominal"
                                    class="w-full h-10 border border-brand-500 font-black text-sm text-gray-900 dark:text-white bg-white dark:bg-gray-950 px-3 rounded-lg focus:ring-1 focus:ring-brand-500 focus:border-brand-500" />
                            </div>

                            
                            <div class="shrink-0">
                                <button type="button" wire:click="$set('cashReceived', '<?php echo e($total); ?>')"
                                    title="Reset Uang Pas"
                                    class="h-10 w-11 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 rounded-lg border border-gray-300 dark:border-gray-600 transition active:scale-95 shadow-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        
                        <div class="space-y-1">
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Rekomendasi
                                Uang Pas</label>
                            <div class="grid grid-cols-3 gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [50000, 100000, 200000]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $presetAmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <button type="button" wire:click="$set('cashReceived', '<?php echo e($presetAmt); ?>')"
                                        class="h-10 flex items-center justify-center border border-gray-200 hover:border-brand-500 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-bold rounded-lg transition active:scale-95 shadow-xs tabular-nums">
                                        Rp <?php echo e(number_format($presetAmt, 0, ',', '.')); ?>

                                    </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="space-y-1">
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">
                                Pecahan Uang Rupiah
                            </label>
                            <div class="grid grid-cols-5 gap-1.5">
                                <?php
                                    $moneyDenominations = [
                                        ['value' => 100000, 'label' => '100000'],
                                        ['value' => 75000, 'label' => '75000'],
                                        ['value' => 50000, 'label' => '50000'],
                                        ['value' => 20000, 'label' => '20000'],
                                        ['value' => 10000, 'label' => '10000'],
                                        ['value' => 5000, 'label' => '5000'],
                                        ['value' => 2000, 'label' => '2000'],
                                        ['value' => 1000, 'label' => '1000'],
                                        ['value' => 500, 'label' => '500'],
                                        ['value' => 100, 'label' => '100'],
                                    ];
                                ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $moneyDenominations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    
                                    <button type="button" wire:click="$set('cashReceived', <?php echo e($coin['value']); ?>)"
                                        class="h-11 flex flex-col items-center justify-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 font-extrabold rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-brand-500 dark:hover:border-brand-500 transition active:scale-95 shadow-xs">
                                        <span class="text-xs tracking-tight"><?php echo e($coin['label']); ?></span>
                                    </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>

                    </div>

                    
                    <div
                        class="border-t border-gray-200 bg-gray-50 dark:border-gray-800 dark:bg-gray-950 px-5 py-3 flex items-center justify-end gap-2">
                        <button type="button" wire:click="$set('paymentModalOpen', false)"
                            class="h-10 px-5 text-xs font-bold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition uppercase tracking-wide">
                            Cancel
                        </button>
                        <button type="button" wire:click="$set('paymentModalOpen', false)"
                            class="h-10 px-6 bg-brand-500 hover:bg-brand-600 text-white text-xs font-black rounded-lg shadow-sm transition uppercase tracking-wider active:scale-95">
                            Apply
                        </button>
                    </div>

                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($splitBillModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 z-[100015] flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-gray-900/50 " wire:click="$set('splitBillModalOpen', false)">
                </div>

                <div
                    class="relative w-full max-w-2xl h-[50vh] flex flex-col overflow-hidden rounded-sm bg-white shadow-2xl   animate-in ">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white">
                        <h3 class="text-base font-bold tracking-wide">Split Bill</h3>
                    </div>

                    
                    <div class="flex-1 flex min-h-0 divide-x divide-gray-200 dark:divide-gray-800">

                        
                        <div class="w-1/2 flex flex-col p-3 bg-gray-50 dark:bg-gray-950/40">
                            <div
                                class="flex border-b border-gray-200 bg-gray-200 dark:bg-gray-800 px-3 py-2 font-bold text-xs text-gray-700 dark:text-gray-300">
                                <span class="w-12 text-center">Qty</span>
                                <span class="flex-1 pl-4">Menu</span>
                            </div>

                            <div class="flex-1 overflow-y-auto  mt-1 custom-scrollbar">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cIdx => $cItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cItem['quantity'] > 0): ?>
                                        
                                        <div class="flex items-center justify-between p-1  rounded-lg shadow-xs">
                                            <div class="flex items-center flex-1 min-w-0">
                                                <span
                                                    class="w-8 text-center text-xs  text-gray-800 dark:text-white"><?php echo e($cItem['quantity']); ?></span>
                                                <div class="pl-4 truncate">
                                                    <p class="text-[10px]  text-gray-800 dark:text-white ">
                                                        <?php echo e($cItem['name']); ?>

                                                    </p>
                                                    <p class="text-[10px] text-gray-600 font-bold ">
                                                        @ <?php echo e(number_format($cItem['price'], 0, ',', '.')); ?> | Total:
                                                        <?php echo e(number_format($cItem['quantity'] * $cItem['price'], 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <button type="button" wire:click="moveItemToSplit(<?php echo e($cIdx); ?>)"
                                                class="w-12 h-8 flex items-center justify-center bg-[#3C8DBC] text-white rounded font-bold shadow-xs text-sm">
                                                +
                                            </button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                            <div class="pt-3">
                                <button type="button"
                                    class="px-4 stream h-9 bg-[#3C8DBC] text-white text-xs rounded shadow-sm flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-4 h-4 shrink-0" alt="Pencil">
                                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                        <path d="m15 5 3 3" />
                                    </svg>
                                    <span>Rename Bill</span>
                                </button>
                            </div>
                        </div>

                        
                        <div class="w-1/2 flex flex-col p-4 bg-white dark:bg-gray-900">

                            
                            <div
                                class="flex flex-wrap border-b border-gray-200 dark:border-gray-800 gap-1 overflow-x-auto shrink-0 custom-scrollbar">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $splitBills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bIdx => $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <?php $itemCount = collect($bill['items'])->sum('quantity'); ?>
                                    <button type="button" wire:click="$set('activeSplitTab', <?php echo e($bIdx); ?>)"
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'px-4 py-2 text-xs font-bold transition-all border-b-2 -mb-[1px]',
                                            'border-[#3C8DBC] text-[#3C8DBC]' => $activeSplitTab == $bIdx,
                                            'border-transparent text-gray-400 hover:text-gray-600' =>
                                                $activeSplitTab != $bIdx,
                                        ]); ?>">
                                        <?php echo e($bill['name']); ?> (<?php echo e($itemCount); ?>)
                                    </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>

                            
                            <div class="flex-1 overflow-y-auto  mt-1 custom-scrollbar">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($splitBills[$activeSplitTab]) && count($splitBills[$activeSplitTab]['items']) > 0): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $splitBills[$activeSplitTab]['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sIdx => $sItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="flex items-center justify-between p-1  rounded-lg">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-[8px]  text-gray-800 dark:text-white uppercase">
                                                    <?php echo e($sItem['name']); ?>

                                                </p>
                                                <p class="text-[8px] text-gray-500 font-bold mt-0.5">
                                                    <?php echo e($sItem['quantity']); ?>x | @
                                                    <?php echo e(number_format($sItem['price'], 0, ',', '.')); ?>

                                                </p>
                                            </div>
                                            <button type="button"
                                                wire:click="removeSplitItem(<?php echo e($activeSplitTab); ?>, <?php echo e($sIdx); ?>)"
                                                class="text-xs text-red-500 hover:text-red-700 font-bold px-2">
                                                X Batalkan
                                            </button>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php else: ?>
                                    <div class="h-full flex items-center justify-center text-xs text-gray-400 italic">
                                        Belum ada menu di <?php echo e($splitBills[$activeSplitTab]['name'] ?? 'Bill ini'); ?>. Klik
                                        tombol (+) di kiri untuk memindahkan.
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div class="pt-3 flex justify-end">
                                <button type="button" wire:click="deleteSplitBill(<?php echo e($activeSplitTab); ?>)"
                                    class="px-4 h-9 bg-[#DD4B39] text-white text-xs rounded shadow-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="8" y1="5" x2="8" y2="20"></line>
                                        <line x1="11" y1="5" x2="11" y2="20"></line>
                                        <line x1="13" y1="5" x2="13" y2="20"></line>
                                        <line x1="16" y1="5" x2="16" y2="20"></line>
                                    </svg>
                                    Delete Bill
                                </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($splitBills[$activeSplitTab]) && count($splitBills[$activeSplitTab]['items']) > 0): ?>
                                    <button type="button" wire:click="paySplitBill(<?php echo e($activeSplitTab); ?>)"
                                        class="px-4 h-9 bg-green-500  text-white text-xs font-black rounded shadow-sm flex items-center gap-1 uppercase tracking-wider">
                                        Pay This Bill (Rp
                                        <?php echo e(number_format(collect($splitBills[$activeSplitTab]['items'])->sum(fn($i) => $i['quantity'] * $i['price']), 0, ',', '.')); ?>)
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                    </div>

                    
                    <div
                        class="border-t border-gray-200 bg-gray-50 dark:border-gray-800 dark:bg-gray-950 px-5 py-3 flex items-center justify-between shrink-0">
                        <button type="button" wire:click="addSplitBill"
                            class="h-10 px-4 bg-[#3C8DBC]  text-white text-xs  rounded-lg shadow-sm flex items-center gap-1">
                            + Add Bill
                        </button>

                        <div class="flex items-center gap-2">
                            <button type="button" wire:click="$set('splitBillModalOpen', false)"
                                class="h-10 px-5 bg-[#DD4B39] text-white text-xs rounded-lg shadow-sm flex items-center gap-1">
                                ✖ Close
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cancelTableModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100020]">
                
                <div class="absolute inset-0 bg-black/40 backdrop-blur-xs"
                    wire:click="$set('cancelTableModalOpen', false)">
                </div>

                
                <div
                    class="relative bg-white dark:bg-gray-900 rounded-3xl shadow-xl w-full max-w-md p-6 animate-in fade-in zoom-in-95 duration-150 border border-gray-100 dark:border-gray-800">

                    <div class="mb-4">
                        <h2
                            class="text-lg font-black text-gray-800 dark:text-white uppercase tracking-tight flex items-center gap-2">
                            <span class="text-red-500">⚠</span> Cancel Table (Void Transaksi)
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">Membatalkan seluruh pesanan pada meja ini secara permanen.
                        </p>
                    </div>

                    <hr class="mb-4 border-gray-100 dark:border-gray-800">

                    <div class="space-y-4">
                        
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Cancel
                                Notes (Alasan Pembatalan)</label>
                            <input type="text" wire:model.live="cancelTableReason"
                                class="w-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm rounded-2xl p-3 focus:border-red-500 focus:ring-1 focus:ring-red-500 dark:text-white transition"
                                placeholder="Masukkan alasan pembatalan meja...">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cancelTableReason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-[10px] font-bold text-red-500 mt-1 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-500 mb-1.5 uppercase tracking-wider text-center">PIN
                                Otorisasi Manager</label>
                            <div class="relative">
                                <input type="password" wire:model.live="cancelTablePin" maxlength="6"
                                    inputmode="numeric"
                                    class="w-full h-12 text-center text-2xl font-black tracking-[0.5em] rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:border-red-500 focus:ring-red-500 dark:text-white transition"
                                    placeholder="•••••••••" />
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cancelTablePin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-[10px] font-bold text-red-500 mt-1 flex justify-center items-center gap-1">
                                    <?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-100 dark:border-gray-800">

                    
                    <div class="flex justify-between items-center gap-3">
                        <button wire:click="$set('cancelTableModalOpen', false)" type="button"
                            class="flex-1 h-11 font-bold text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-2xl transition text-sm">
                            ✕ Batal
                        </button>
                        <button wire:click="confirmCancel" type="button"
                            class="flex-[2] h-11 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-black uppercase tracking-wider text-sm shadow-md shadow-red-500/20 transition active:scale-95">
                            Void Transaksi ✓
                        </button>
                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($quickServiceModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100030]">
                
                <div class="absolute inset-0 bg-black/40 bg-opacity-50"
                    wire:click="$set('quickServiceModalOpen', false)">
                </div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-xl overflow-hidden border border-gray-200 animate-in fade-in zoom-in-95 duration-150 font-sans">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white">
                        <h3 class="text-base font-bold tracking-wide">Quick Service</h3>
                    </div>

                    
                    <div class="p-6 space-y-6">

                        
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700">Number of Pax</label>

                            
                            <div class="flex justify-center">
                                <input wire:model="numberOfPax" type="number" min="1"
                                    class="w-32 h-10 border border-gray-300 rounded text-center text-lg font-semibold focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white dark:text-gray-900" />
                            </div>

                            
                            <div class="flex items-center justify-center gap-1">
                                 <button type="button" wire:click="decrementPax"
                                    class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded text-[#3C8DBC] hover:bg-gray-50 font-bold transition shadow-sm active:scale-95">
                                    &lt;
                                </button>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [1, 2, 3, 4, 5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paxAmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <button type="button" wire:click="$set('numberOfPax', <?php echo e($paxAmt); ?>)"
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'w-10 h-10 flex items-center justify-center text-sm font-bold rounded transition shadow-sm active:scale-95',
                                            'bg-[#3C8DBC] text-white' => $numberOfPax == $paxAmt,
                                            'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' =>
                                                $numberOfPax != $paxAmt,
                                        ]); ?>">
                                        <?php echo e($paxAmt); ?>

                                    </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                
                                <button type="button" wire:click="incrementPax"
                                    class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded text-[#3C8DBC] hover:bg-gray-50 font-bold transition shadow-sm active:scale-95">
                                    &gt;
                                </button>
                            </div>
                        </div>

                        
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700">Sales Mode</label>

                            <div class="grid grid-cols-3 gap-2">
                                
                                <button type="button" wire:click="$set('quickServiceSalesMode', 'dine_in')"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'h-11 border text-xs font-bold rounded transition active:scale-95 shadow-xs uppercase tracking-wider',
                                        'border-[#3C8DBC] bg-blue-50 text-[#3C8DBC]' =>
                                            $quickServiceSalesMode === 'dine_in',
                                        'border-gray-200 bg-white text-gray-600 hover:bg-gray-50' =>
                                            $quickServiceSalesMode !== 'dine_in',
                                    ]); ?>">
                                    Dine In
                                </button>

                                
                                <button type="button" wire:click="$set('quickServiceSalesMode', 'gofood')"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'h-11 border text-xs font-bold rounded transition active:scale-95 shadow-xs uppercase tracking-wider',
                                        'border-[#3C8DBC] bg-blue-50 text-[#3C8DBC]' =>
                                            $quickServiceSalesMode === 'gofood',
                                        'border-gray-200 bg-white text-gray-600 hover:bg-gray-50' =>
                                            $quickServiceSalesMode !== 'gofood',
                                    ]); ?>">
                                    GoFood
                                </button>

                                
                                <button type="button" wire:click="$set('quickServiceSalesMode', 'take_away')"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'h-11 border text-xs font-bold rounded transition active:scale-95 shadow-xs uppercase tracking-wider',
                                        'border-[#3C8DBC] bg-blue-50 text-[#3C8DBC]' =>
                                            $quickServiceSalesMode === 'take_away',
                                        'border-gray-200 bg-white text-gray-600 hover:bg-gray-50' =>
                                            $quickServiceSalesMode !== 'take_away',
                                    ]); ?>">
                                    Takeaway
                                </button>
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        
                        <div class="flex justify-end items-center gap-2 pt-2">
                            <button type="button" wire:click="$set('scanInputModalOpen', true)"
                                class="h-10 px-4 bg-[#3C8DBC]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1 active:scale-95 transition">
                                📋 Scan / Input
                            </button>

                            
                            <button type="button"
                                wire:click="$set('orderType', '<?php echo e($quickServiceSalesMode); ?>'); $set('quickServiceModalOpen', false); $set('showQuickServiceWaitlist', false);"
                                class="h-10 px-6 bg-gray-300 hover:bg-[#3C8DBC] hover:text-white text-gray-700 text-xs font-black rounded shadow-sm flex items-center gap-1 active:scale-95 transition uppercase tracking-wider">
                                ✓ Apply
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($scanInputModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100040]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('scanInputModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-xl overflow-hidden border border-gray-200 animate-in fade-in zoom-in-95 duration-150 font-sans text-gray-800">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white flex items-center gap-3">
                        <button type="button" wire:click="$set('scanInputModalOpen', false)"
                            class="text-white hover:text-white/80 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                        </button>
                        <h3 class="text-base font-bold tracking-wide">Scan/Input</h3>
                    </div>

                    
                    <div class="p-6 space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Input Order ID</label>
                        <p class="text-sm font-semibold italic text-[#3C8DBC]">
                            Only paid transaction of ESB Order QS that can be input
                        </p>

                        <div class="flex items-stretch gap-2 pt-1">
                            <input type="text" wire:model.defer="esbOrderIdInput"
                                class="flex-1 h-11 border border-gray-300 rounded px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                placeholder="Please input Order ID ESB Order" />
                            <button type="button" wire:click="applyEsbOrderScan"
                                class="h-11 px-6 bg-[#3C8DBC]  text-white text-sm font-bold rounded shadow-sm transition active:scale-95 shrink-0">
                                Apply
                            </button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['esbOrderIdInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($phoneNumberModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100025]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('phoneNumberModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden animate-in fade-in zoom-in-95 duration-150">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white">
                        <h3 class="text-base font-bold tracking-wide">Customer Phone Number</h3>
                    </div>

                    
                    <div class="p-6 space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Phone Number</label>
                        <input type="text" wire:model.defer="customerPhone"
                            class="w-full h-11 border border-gray-300 rounded px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                            placeholder="8xx xxx xxx" />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['customerPhone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-xs font-bold text-red-500"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <hr class="border-gray-200">

                    
                    <div class="px-5 py-3 flex justify-end items-center gap-2">
                        <button type="button" wire:click="$set('phoneNumberModalOpen', false)"
                            class="h-10 px-5 border border-[#DD4B39] text-red-500 text-xs font-bold rounded hover:bg-red-50 transition active:scale-95">
                            Cancel
                        </button>
                        <button type="button" wire:click="$set('phoneNumberModalOpen', false)"
                            class="h-10 px-6 bg-[#3C8DBC]  text-white text-xs font-bold rounded shadow-sm transition active:scale-95">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editMemberModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100026]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('editMemberModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-2xl overflow-hidden  animate-in fade-in zoom-in-95 duration-150 flex flex-col max-h-[85vh]">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white shrink-0">
                        <h3 class="text-base font-bold tracking-wide">
                            Edit Member
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTableId): ?>
                                (<?php echo e('Table'); ?>

                                <?php echo e(collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? ''); ?>)
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </h3>
                    </div>

                    
                    <div class="p-5 space-y-3 flex-1 overflow-y-auto">
                        <h4 class="text-sm text-gray-700">Regular Member</h4>

                        
                        <div class="text-center py-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($memberId): ?>
                                <?php $selectedMember = $this->filteredMembers->firstWhere('id', $memberId); ?>
                                <p class="text-lg font-bold text-gray-800">
                                    <?php echo e($selectedMember->name ?? '-'); ?>

                                </p>
                                <p class="text-xs text-gray-500"><?php echo e($selectedMember->phone ?? ''); ?></p>
                            <?php else: ?>
                                <p class="text-lg text-gray-700">- No Selected Regular Member -</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div class="flex items-stretch gap-0 border border-gray-300 rounded overflow-hidden">
                            <div class="px-3 flex items-center bg-gray-50 border-r border-gray-300">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="memberSearch"
                                class="flex-1 h-11 px-3 text-sm outline-none border-0"
                                placeholder="Search Regular Member" />
                            <button type="button" wire:click="$set('memberSearch', '')"
                                class="w-12 bg-brand-500 hover:bg-blue-700 text-white flex items-center justify-center transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </button>
                        </div>

                        
                        <div class="min-h-[180px]">
                            <?php
                                $perPageMember = 5;
                                $totalMembers = $this->filteredMembers->count();
                                $totalMemberPages = max(1, (int) ceil($totalMembers / $perPageMember));
                                $pagedMembers = $this->filteredMembers
                                    ->forPage($memberListPage, $perPageMember)
                                    ->values();
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pagedMembers->isEmpty()): ?>
                                <div class="h-[180px] flex items-center justify-center text-sm text-gray-500">
                                    No member found
                                </div>
                            <?php else: ?>
                                <div class="divide-y divide-gray-100  rounded">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pagedMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <button type="button" wire:click="$set('memberId', <?php echo e((int) $m->id); ?>)"
                                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                'w-full text-left px-4 py-2.5 text-sm transition',
                                                'bg-blue-50 text-[#3C8DBC] font-bold' => $memberId == $m->id,
                                                'hover:bg-gray-50 text-gray-700' => $memberId != $m->id,
                                            ]); ?>">
                                            <?php echo e($m->name); ?>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($m->phone): ?>
                                                <span class="text-xs text-gray-400 ml-1">(<?php echo e($m->phone); ?>)</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </button>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div class="flex items-center justify-end gap-3 text-xs text-gray-500">
                            <span><?php echo e($totalMembers > 0 ? ($memberListPage - 1) * $perPageMember + 1 : 0); ?> of
                                <?php echo e($totalMembers); ?></span>
                            <div class="flex items-center gap-1">
                                <button type="button" wire:click="$set('memberListPage', 1)"
                                    class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-700 disabled:opacity-30"
                                    <?php if($memberListPage <= 1): echo 'disabled'; endif; ?>>
                                    ⏮
                                </button>
                                <button type="button"
                                    wire:click="$set('memberListPage', <?php echo e(max(1, $memberListPage - 1)); ?>)"
                                    class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-700 disabled:opacity-30"
                                    <?php if($memberListPage <= 1): echo 'disabled'; endif; ?>>
                                    ‹
                                </button>
                                <button type="button"
                                    wire:click="$set('memberListPage', <?php echo e(min($totalMemberPages, $memberListPage + 1)); ?>)"
                                    class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-700 disabled:opacity-30"
                                    <?php if($memberListPage >= $totalMemberPages): echo 'disabled'; endif; ?>>
                                    ›
                                </button>
                                <button type="button" wire:click="$set('memberListPage', <?php echo e($totalMemberPages); ?>)"
                                    class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-700 disabled:opacity-30"
                                    <?php if($memberListPage >= $totalMemberPages): echo 'disabled'; endif; ?>>
                                    ⏭
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="px-5 py-3 border-t border-gray-100 flex justify-between items-center shrink-0">
                        <button type="button" wire:click="clearRegularMember"
                            class="h-10 px-4 bg-[#DD4B39]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✖ Clear Regular Member
                        </button>
                        <button type="button" wire:click="$set('editMemberModalOpen', false)"
                            class="h-10 px-6 bg-[#3C8DBC]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✓ Apply
                        </button>
                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($deliveryCostModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100027]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('deliveryCostModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden  animate-in fade-in zoom-in-95 duration-150">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white">
                        <h3 class="text-base font-bold tracking-wide">Delivery Cost</h3>
                    </div>

                    
                    <div class="p-6 space-y-4">

                        
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-gray-700">Input Delivery Cost</label>
                            <input type="text" wire:model.live="deliveryCost" inputmode="numeric"
                                class="w-full h-11 border border-gray-300 rounded px-4 text-sm text-right focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                placeholder="0" />
                        </div>

                        
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-gray-700">Input Order Fee</label>
                            <input type="text" wire:model.live="orderFee" inputmode="numeric"
                                class="w-full h-11 border border-gray-300 rounded px-4 text-sm text-right focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                placeholder="0" />
                        </div>

                        
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-gray-700">Platform Fee</label>
                            <input type="text" readonly value="<?php echo e(number_format($platformFee, 0, ',', '.')); ?>"
                                class="w-full h-11 border border-gray-300 rounded px-4 text-sm text-right bg-gray-100 text-gray-600 cursor-not-allowed" />
                        </div>
                    </div>

                    
                    <div class="px-5 py-3 border-t border-gray-100 flex justify-end items-center">
                        <button type="button" wire:click="$set('deliveryCostModalOpen', false)"
                            class="h-10 px-6 bg-[#3C8DBC]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✓ Apply
                        </button>
                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editTableModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100028]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('editTableModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden  animate-in fade-in zoom-in-95 duration-150">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white">
                        <h3 class="text-base font-bold tracking-wide">
                            Edit Table
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTableId): ?>
                                (<?php echo e(collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? ''); ?>)
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </h3>
                    </div>

                    
                    <div class="p-6 space-y-3">
                        <label class="block text-sm font-bold text-gray-700">Number of Pax</label>

                        
                        <div class="flex justify-center">
                            <input wire:model.live="numberOfPax" type="number" min="1"
                                class="w-32 h-10 border border-gray-300 rounded text-center text-lg font-semibold focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white text-gray-900" />
                        </div>

                        
                        <div class="flex items-center justify-center gap-1">
                            <button type="button" wire:click="decrementPax"
                                class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded text-[#3C8DBC] hover:bg-gray-50 font-bold transition shadow-sm active:scale-95">
                                &lt;
                            </button>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [1, 2, 3, 4, 5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paxAmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button type="button" wire:click="$set('numberOfPax', <?php echo e($paxAmt); ?>)"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'w-10 h-10 flex items-center justify-center text-sm font-bold rounded transition shadow-sm active:scale-95',
                                        'bg-[#3C8DBC] text-white' => $numberOfPax == $paxAmt,
                                        'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' =>
                                            $numberOfPax != $paxAmt,
                                    ]); ?>">
                                    <?php echo e($paxAmt); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                            <button type="button" wire:click="incrementPax"
                                class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded text-[#3C8DBC] hover:bg-gray-50 font-bold transition shadow-sm active:scale-95">
                                &gt;
                            </button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['numberOfPax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-xs font-bold text-red-500 block text-center"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <div class="px-5 py-3 border-t border-gray-100 flex justify-end items-center">
                        <button type="button" wire:click="applyEditTablePax"
                            class="h-10 px-6 bg-[#3C8DBC]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✓ Apply
                        </button>
                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($complimentModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100029]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('complimentModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-2xl overflow-hidden  animate-in fade-in zoom-in-95 duration-150">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white">
                        <h3 class="text-base font-bold tracking-wide">Complimentary</h3>
                    </div>

                    
                    <div class="p-6 space-y-5">

                        
                        <div class="grid grid-cols-3 gap-3 items-end">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-gray-700">Outstanding</label>
                                <input type="text" readonly
                                    value="<?php echo e(number_format($this->outstandingAfterCompliment, 0, ',', '.')); ?>"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm text-right bg-gray-100 text-gray-600 cursor-not-allowed" />
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-gray-700">Compliment Percentage</label>
                                <input type="text" wire:model.live.debounce.300ms="complimentPercentage"
                                    inputmode="numeric"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm text-right focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                    placeholder="0" />
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-gray-700">Compliment Amount</label>
                                <div class="flex items-stretch gap-1">
                                    <input type="text" wire:model.live.debounce.300ms="complimentAmount"
                                        inputmode="numeric"
                                        class="flex-1 h-11 border border-gray-300 rounded px-4 text-sm text-right focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                        placeholder="0" />
                                    <button type="button"
                                        wire:click="$set('complimentAmount', '<?php echo e($total); ?>')"
                                        class="h-11 px-3 bg-[#3C8DBC]  text-white text-xs font-bold rounded shrink-0 transition active:scale-95">
                                        Get Outstanding
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['complimentAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-gray-700 flex items-center gap-1">
                                Compliment Notes
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </label>
                            <textarea wire:model.live="complimentNotes" rows="3" maxlength="100"
                                class="w-full border border-green-400 rounded px-4 py-3 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white resize-none"
                                placeholder="Masukkan alasan compliment..."></textarea>
                            <p class="text-xs text-green-600 text-right">
                                100/<?php echo e(strlen($complimentNotes)); ?> Characters
                            </p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['complimentNotes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="px-5 py-3 border-t border-gray-100 flex justify-end items-center gap-2">
                        <button type="button" wire:click="$set('complimentModalOpen', false)"
                            class="h-10 px-5 bg-[#DD4B39]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✖ Cancel
                        </button>
                        <button type="button" wire:click="applyCompliment"
                            class="h-10 px-6 bg-gray-300 hover:bg-[#3C8DBC] hover:text-white text-gray-500 hover:text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✓ Apply
                        </button>
                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cardDetailModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100025]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('cardDetailModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-xl max-h-[90vh] flex flex-col overflow-hidden  animate-in fade-in zoom-in-95 duration-150">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white shrink-0">
                        <h3 class="text-base font-bold tracking-wide">Card Payment</h3>
                    </div>

                    
                    <div class="p-6 space-y-4 text-gray-800 overflow-y-auto flex-1">

                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5 min-w-0">
                                <label class="block text-sm font-bold text-gray-700">Outstanding</label>
                                <input type="text" readonly value="<?php echo e(number_format($total, 0, ',', '.')); ?>"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm text-right bg-gray-100 text-gray-600 cursor-not-allowed" />
                            </div>

                            <div class="space-y-1.5 min-w-0">
                                <label class="block text-sm font-bold text-gray-700">Card Amount</label>
                                <div class="flex items-stretch gap-1">
                                    <input type="text" wire:model.live="cardAmount" inputmode="numeric"
                                        class="flex-1 min-w-0 h-11 border border-brand-500 rounded px-4 text-sm text-right focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white" />
                                    <button type="button" wire:click="setCardOutstandingAmount"
                                        class="h-11 px-3 bg-[#3C8DBC]  text-white text-xs font-bold rounded shrink-0 transition active:scale-95">
                                        Get Outstanding
                                    </button>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cardAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5 min-w-0">
                                <label class="block text-sm font-bold text-gray-700">Card Number</label>
                                <input type="text" wire:model.live="cardNumber"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                    placeholder="First 6 digit and last 4 digit of card number">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cardNumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="space-y-1.5 min-w-0">
                                <label class="block text-sm font-bold text-gray-700">Verification Code</label>
                                <input type="text" wire:model.live="cardVerificationCode"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                    placeholder="Verification code from EDC">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cardVerificationCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5 min-w-0">
                                <label class="block text-sm font-bold text-gray-700">Bank Name</label>
                                <input type="text" wire:model.live="cardBankName"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                    placeholder="Name of the bank that issued the card">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cardBankName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="space-y-1.5 min-w-0">
                                <label class="block text-sm font-bold text-gray-700">Account Name</label>
                                <input type="text" wire:model.live="cardAccountName"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                    placeholder="Name on the card">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cardAccountName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5 min-w-0">
                                <label class="block text-sm font-bold text-gray-700">Self Order ID</label>
                                <input type="text" wire:model.live="cardSelfOrderId"
                                    class="w-full h-11 border border-gray-300 rounded px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white"
                                    placeholder="Self Order ID">
                            </div>
                        </div>
                    </div>

                    
                    <div
                        class="px-5 py-3 flex justify-end items-center gap-2 bg-gray-50 border-t border-gray-200 shrink-0">
                        <button type="button" wire:click="$set('cardDetailModalOpen', false)"
                            class="h-10 px-5 bg-[#DD4B39]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✖ Cancel
                        </button>
                        <button type="button" wire:click="applyCardPayment"
                            class="h-10 px-6 bg-[#3C8DBC]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✓ Apply
                        </button>
                    </div>

                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($otherCostModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 flex items-center justify-center p-4 z-[100029]">
                
                <div class="absolute inset-0 bg-black/40" wire:click="$set('otherCostModalOpen', false)"></div>

                
                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-md mx-auto max-h-[90vh] flex flex-col overflow-hidden overflow-x-hidden animate-in fade-in zoom-in-95 duration-150">

                    
                    <div class="bg-[#3C8DBC] px-5 py-3 text-white shrink-0">
                        <h3 class="text-base font-bold tracking-wide">Other Cost - Non Sales</h3>
                    </div>

                    
                    <div class="p-6 space-y-4 text-gray-800 overflow-y-auto flex-1">

                        
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-gray-700">Subtotal Transaction</label>
                            <input type="text" readonly value="<?php echo e(number_format($total, 0, ',', '.')); ?>"
                                class="w-full h-11 border border-gray-300 rounded px-4 text-sm text-right bg-gray-100 text-gray-600 cursor-not-allowed" />
                        </div>

                        
                        <div class="space-y-1.5">
                            <label class="flex items-center gap-1 text-sm font-bold text-gray-700">
                                Notes
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </label>
                            <textarea wire:model.live="otherCostNotes" rows="4" maxlength="100"
                                class="w-full border border-green-400 rounded px-4 py-3 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 bg-white resize-none"
                                placeholder="Masukkan catatan biaya..."></textarea>
                            <p class="text-xs text-green-600 text-right">
                                100/<?php echo e(strlen($otherCostNotes)); ?> Characters
                            </p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['otherCostNotes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-xs font-bold text-red-500 block"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    
                    <div
                        class="px-5 py-3 flex justify-end items-center gap-2 bg-gray-50 border-t border-gray-200 shrink-0">
                        <button type="button" wire:click="$set('otherCostModalOpen', false)"
                            class="h-10 px-5 bg-[#DD4B39]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✖ Cancel
                        </button>
                        <button type="button" wire:click="applyOtherCost"
                            class="h-10 px-6 bg-[#3C8DBC]  text-white text-xs font-bold rounded shadow-sm flex items-center gap-1.5 transition active:scale-95">
                            ✓ Apply
                        </button>
                    </div>

                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotionModalOpen): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-data
            x-on:keydown.escape.window="$wire.set('promotionModalOpen', false)">
            <div class="bg-white rounded-md shadow-xl w-[700px] max-h-[90vh] flex flex-col overflow-hidden">

                
                <div class="bg-brand-500 px-5 py-3">
                    <h2 class="text-white font-semibold text-base">Promotion List</h2>
                </div>

                
                <div class="flex items-center gap-3 px-5 py-3 border-b border-gray-200">
                    <div class="relative flex-1">
                        <input type="text" wire:model.live.debounce.300ms="promotionSearch"
                            placeholder="Search...."
                            class="w-full h-9 pl-3 pr-8 border border-gray-300 rounded text-xs outline-none focus:border-brand-400" />
                        <svg class="absolute right-2 top-2.5 w-4 h-4 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                        </svg>
                    </div>
                    <div class="w-48">
                        <select wire:model.live="promotionTypeFilter"
                            class="w-full h-9 px-2 border border-gray-300 rounded text-xs outline-none focus:border-brand-400 bg-white">
                            <option value="">Promotion Type</option>
                            <option value="public">Public</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                </div>

                
                <div class="flex-1 overflow-y-auto">
                    <table class="w-full text-xs">
                        <thead class="sticky top-0 bg-white border-b border-gray-200">
                            <tr>
                                <th class="text-left px-4 py-2 font-semibold text-gray-700 whitespace-nowrap">End Date
                                </th>
                                <th class="text-left px-4 py-2 font-semibold text-gray-700 whitespace-nowrap">
                                    Promotion Name</th>
                                <th class="text-left px-4 py-2 font-semibold text-gray-700 whitespace-nowrap">Type
                                </th>
                                <th class="text-left px-4 py-2 font-semibold text-gray-700 whitespace-nowrap">Min.
                                    Subtotal</th>
                                <th class="text-left px-4 py-2 font-semibold text-gray-700 whitespace-nowrap">Discount
                                </th>
                                <th class="text-left px-4 py-2 font-semibold text-gray-700 whitespace-nowrap">Payment
                                    Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr wire:click="selectPromotion(<?php echo e($promo->id); ?>)"
                                    class="border-b border-gray-100 cursor-pointer transition
                               <?php echo e($selectedPromotionId === $promo->id ? 'bg-blue-50 border-l-2 border-l-brand-500' : 'hover:bg-gray-50'); ?>">
                                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                        <?php echo e($promo->end_date ? \Carbon\Carbon::parse($promo->end_date)->format('d-m-Y H:i') : '-'); ?>

                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-800"><?php echo e($promo->name); ?></td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-0.5 rounded text-xs font-medium
                                <?php echo e($promo->type === 'public' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700'); ?>">
                                            <?php echo e(ucfirst($promo->type)); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        <?php echo e(number_format($promo->min_subtotal, 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        <?php echo e($promo->discount_label); ?>

                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        <?php echo e($promo->payment_method ?? '-'); ?>

                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                                        Tidak ada promosi tersedia
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <div
                    class="flex items-center justify-end px-5 py-2 border-t border-gray-100 text-xs text-gray-500 gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->promotions->hasPages()): ?>
                        <span><?php echo e($this->promotions->firstItem()); ?> - <?php echo e($this->promotions->lastItem()); ?> of
                            <?php echo e($this->promotions->total()); ?></span>
                        <button wire:click="$set('promotionPage', 1)"
                            <?php echo e($this->promotions->onFirstPage() ? 'disabled' : ''); ?>

                            class="px-1 disabled:opacity-40">|&lt;</button>
                        <button wire:click="previousPromotionPage"
                            <?php echo e($this->promotions->onFirstPage() ? 'disabled' : ''); ?>

                            class="px-1 disabled:opacity-40">&lt;</button>
                        <button wire:click="nextPromotionPage"
                            <?php echo e($this->promotions->hasMorePages() ? '' : 'disabled'); ?>

                            class="px-1 disabled:opacity-40">&gt;</button>
                        <button wire:click="$set('promotionPage', <?php echo e($this->promotions->lastPage()); ?>)"
                            <?php echo e($this->promotions->hasMorePages() ? '' : 'disabled'); ?>

                            class="px-1 disabled:opacity-40">&gt;|</button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="flex items-center justify-between px-5 py-3 border-t border-gray-200 bg-gray-50">
                    <button type="button" wire:click="$set('promotionModalOpen', false)"
                        class="px-4 py-1.5 border border-red-400 text-red-500 text-xs rounded hover:bg-red-50 transition">
                        Close
                    </button>
                    <div class="flex items-center gap-2">
                        <button type="button" wire:click="removePromotion"
                            class="flex items-center gap-1 px-4 py-1.5 bg-gray-200 text-gray-500 text-xs rounded transition
                           <?php echo e($selectedPromotionId ? 'hover:bg-gray-300 cursor-pointer' : 'opacity-50 cursor-not-allowed'); ?>"
                            <?php echo e($selectedPromotionId ? '' : 'disabled'); ?>>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Remove Promotion
                        </button>
                        <button type="button" wire:click="applyPromotion"
                            class="flex items-center gap-1 px-4 py-1.5 bg-gray-200 text-gray-500 text-xs rounded transition
                           <?php echo e($selectedPromotionId ? 'hover:bg-green-500 hover:text-white cursor-pointer' : 'opacity-50 cursor-not-allowed'); ?>"
                            <?php echo e($selectedPromotionId ? '' : 'disabled'); ?>>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Apply
                        </button>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($purchaseVoucherModalOpen): ?>
        <template x-teleport="<?php echo e('body'); ?>">
            <div class="fixed inset-0 z-[100035] flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-black/40" wire:click="$set('purchaseVoucherModalOpen', false)"></div>

                <div
                    class="relative bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden border border-gray-200 animate-in fade-in zoom-in-95 duration-150">

                    
                    <div class="bg-brand-500 px-5 py-3 text-white shrink-0">
                        <h3 class="text-base font-bold tracking-wide">Purchase Voucher</h3>
                    </div>

                    
                    <div class="flex border-b border-gray-200 shrink-0">
                        <button type="button"
                            class="flex-1 py-2.5 text-xs font-bold bg-brand-500 text-white border-b-2 bg-brand-500">
                            List Voucher Offline
                        </button>
                        <button type="button"
                            class="flex-1 py-2.5 text-xs font-bold text-gray-500 hover:bg-gray-50 transition">
                            Selected Vouchers (<?php echo e(count($selectedVouchers)); ?>)
                        </button>
                    </div>

                    
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-200 shrink-0">
                        <input type="text" wire:model.live.debounce.300ms="voucherSearchInput"
                            placeholder="Search by Voucher ID"
                            class="flex-1 h-9 px-3 border border-gray-300 rounded text-xs outline-none focus:border-[#3C8DBC]" />
                        <button type="button"
                            class="h-9 px-4 bg-gray-600 hover:bg-gray-700 text-white text-xs font-bold rounded flex items-center gap-1.5 transition active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                            </svg>
                            Search
                        </button>
                        <button type="button" wire:click="clearAllSelectedVouchers"
                            class="h-9 px-4 bg-[#DD4B39] hover:bg-red-600 text-white text-xs font-bold rounded flex items-center gap-1.5 transition active:scale-95">
                            Clear All Selected
                        </button>
                    </div>

                    
                    <div class="flex-1 overflow-y-auto">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->availableVouchers->isEmpty()): ?>
                            <div class="h-full flex items-center justify-center py-20 text-sm text-gray-400">
                                No voucher found
                            </div>
                        <?php else: ?>
                            <table class="w-full text-xs">
                                <thead class="sticky top-0 bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="w-10 px-3 py-2"></th>
                                        <th class="text-left px-3 py-2 font-semibold text-gray-700">Voucher ID</th>
                                        <th class="text-left px-3 py-2 font-semibold text-gray-700">Campaign</th>
                                        <th class="text-left px-3 py-2 font-semibold text-gray-700">Nominal</th>
                                        <th class="text-left px-3 py-2 font-semibold text-gray-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->availableVouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <?php
                                            $isHabis =
                                                $vc->usage_limit_total !== null &&
                                                $vc->times_redeemed >= $vc->usage_limit_total;
                                        ?>
                                        <tr wire:click="toggleSelectVoucher(<?php echo e($vc->id); ?>)"
                                            class="cursor-pointer transition hover:bg-gray-50
                        <?php echo e(in_array($vc->id, $selectedVouchers) ? 'bg-blue-50' : ''); ?>">

                                            <td class="px-3 py-2 text-center">
                                                <input type="checkbox" readonly
                                                    <?php echo e(in_array($vc->id, $selectedVouchers) ? 'checked' : ''); ?>

                                                    class="rounded border-gray-300 text-[#3C8DBC] pointer-events-none" />
                                            </td>

                                            <td class="px-3 py-2 font-mono font-bold text-gray-800">
                                                <?php echo e($vc->code); ?>

                                            </td>

                                            <td class="px-3 py-2 text-gray-600">
                                                <?php echo e($vc->campaign?->name ?? '-'); ?>

                                            </td>

                                            <td class="px-3 py-2 text-gray-600">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vc->campaign): ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vc->campaign->discount_type === 'percent'): ?>
                                                        <?php echo e($vc->campaign->discount_value); ?>%
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($vc->campaign->max_discount_amount): ?>
                                                            <span class="text-gray-400 text-[10px]">
                                                                (Max Rp
                                                                <?php echo e(number_format($vc->campaign->max_discount_amount, 0, ',', '.')); ?>)
                                                            </span>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php else: ?>
                                                        Rp <?php echo e(number_format($vc->campaign->discount_value, 0, ',', '.')); ?>

                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </td>

                                            <td class="px-3 py-2">
                                                <span
                                                    class="px-2 py-0.5 rounded text-[10px] font-bold
                                <?php echo e($isHabis ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'); ?>">
                                                    <?php echo e($isHabis ? 'Habis' : 'Available'); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </tbody>
                            </table>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <div
                        class="flex items-center justify-end gap-2 px-4 py-2 border-t border-gray-200 text-xs text-gray-500 shrink-0">
                        <?php $vouchers = $this->availableVouchers; ?>
                        <span><?php echo e($vouchers->total() > 0 ? $vouchers->firstItem() . ' - ' . $vouchers->lastItem() : '0'); ?>

                            of <?php echo e($vouchers->total()); ?></span>
                        <button wire:click="$set('voucherListPage', 1)" <?php if($vouchers->onFirstPage()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">|‹</button>
                        <button wire:click="$set('voucherListPage', <?php echo e(max(1, $voucherListPage - 1)); ?>)"
                            <?php if($vouchers->onFirstPage()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">‹</button>
                        <button
                            wire:click="$set('voucherListPage', <?php echo e(min($vouchers->lastPage(), $voucherListPage + 1)); ?>)"
                            <?php if(!$vouchers->hasMorePages()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">›</button>
                        <button wire:click="$set('voucherListPage', <?php echo e($vouchers->lastPage()); ?>)"
                            <?php if(!$vouchers->hasMorePages()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">›|</button>
                    </div>

                    
                    <div
                        class="flex items-center justify-end gap-2 px-4 py-2 border-t border-gray-200 text-xs text-gray-500 shrink-0">
                        <span><?php echo e($this->availableVouchers->firstItem() ?? 0); ?> of
                            <?php echo e($this->availableVouchers->total()); ?></span>
                        <button wire:click="$set('voucherListPage', 1)" <?php if($this->availableVouchers->onFirstPage()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">|‹</button>
                        <button wire:click="$set('voucherListPage', <?php echo e(max(1, $voucherListPage - 1)); ?>)"
                            <?php if($this->availableVouchers->onFirstPage()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">‹</button>
                        <button
                            wire:click="$set('voucherListPage', <?php echo e(min($this->availableVouchers->lastPage(), $voucherListPage + 1)); ?>)"
                            <?php if(!$this->availableVouchers->hasMorePages()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">›</button>
                        <button wire:click="$set('voucherListPage', <?php echo e($this->availableVouchers->lastPage()); ?>)"
                            <?php if(!$this->availableVouchers->hasMorePages()): echo 'disabled'; endif; ?>
                            class="w-7 h-7 flex items-center justify-center border rounded disabled:opacity-30 hover:bg-gray-50">›|</button>
                    </div>

                    
                    <div
                        class="flex items-center justify-end gap-2 px-4 py-3 border-t border-gray-200 bg-gray-50 shrink-0">
                        <button type="button" wire:click="$set('purchaseVoucherModalOpen', false)"
                            class="h-10 px-5 bg-[#DD4B39] text-white text-xs font-bold rounded flex items-center gap-1.5 transition active:scale-95">
                            ✖ Cancel
                        </button>
                        <button type="button" wire:click="applyPurchaseVoucher"
                            class="h-10 px-6 bg-[#3C8DBC] hover:bg-blue-700 text-white text-xs font-bold rounded flex items-center gap-1.5 transition active:scale-95">
                            ✔ Apply
                        </button>
                    </div>
                </div>
            </div>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\farhan\projects\freelance\pos-restoran-v2\resources\views/livewire/pos/pos-page.blade.php ENDPATH**/ ?>