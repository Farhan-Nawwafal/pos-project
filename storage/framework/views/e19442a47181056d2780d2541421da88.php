<?php app("livewire")->forceAssetInjection(); ?><div x-persist="<?php echo e('sidebar'); ?>">
<div>
    <aside id="sidebar"
        class="fixed flex flex-col left-0 bg-[#212C32] text-[#212C32] h-screen z-[9999] shadow-2xl shadow-black/10 dark:shadow-black/20 overflow-hidden"
        x-data="{
            openSubmenus: {},
            currentPath: window.location.pathname,

            init() {
                this.initializeActiveMenus();
                document.addEventListener('livewire:navigated', () => {
                    this.currentPath = window.location.pathname;
                    this.initializeActiveMenus();
                });
                window.addEventListener('popstate', () => {
                    this.currentPath = window.location.pathname;
                    this.initializeActiveMenus();
                });
            },
            initializeActiveMenus() {
                this.openSubmenus = {};

                <?php $__currentLoopData = $menuGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupIndex => $menuGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $menuGroup['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemIndex => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($item['subItems'])): ?>
                            <?php $__currentLoopData = $item['subItems']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                if (this.isActive('<?php echo e($subItem['path']); ?>', <?php echo e(json_encode($subItem['exact'] ?? false)); ?>, <?php echo e(json_encode($subItem['exclude'] ?? [])); ?>)) {
                                    this.openSubmenus['<?php echo e($groupIndex); ?>-<?php echo e($itemIndex); ?>'] = true;
                                }
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            },
            toggleSubmenu(groupIndex, itemIndex) {
                const key = groupIndex + '-' + itemIndex;
                const newState = !this.openSubmenus[key];
                if (newState) {
                    this.openSubmenus = {};
                }
                this.openSubmenus[key] = newState;
            },
            isSubmenuOpen(groupIndex, itemIndex) {
                const key = groupIndex + '-' + itemIndex;
                return this.openSubmenus[key] || false;
            },
            isActive(path, exact = false, exclude = []) {
                if (path === '/' || path === '') {
                    return this.currentPath === '/';
                }
                if (Array.isArray(exclude) && exclude.length > 0) {
                    for (const ex of exclude) {
                        if (typeof ex === 'string' && ex !== '' && this.currentPath.startsWith(ex)) {
                            return false;
                        }
                    }
                }
                if (exact) {
                    return this.currentPath === path;
                }
                return this.currentPath.startsWith(path);
            }
        }"
        :class="{
            'lg:w-[50px] lg:translate-x-0': !$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar
                .isMobileOpen,
            'w-[260px] translate-x-0 lg:w-[260px]': $store.sidebar.isExpanded || $store.sidebar.isHovered || $store
                .sidebar.isMobileOpen,
            'w-0 -translate-x-full': !$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar
                .isMobileOpen
        }" 
        <!-- Logo Section -->
        <div class="pt-1 pb-1 bg-brand-500/25 flex items-center gap-3" :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
            'justify-center' :
            'justify-start'">

            <a href="<?php echo e(route('dashboard', [], false)); ?>">

                <!-- Logo FULL -->
                <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                    x-transition class="dark:hidden m-2 "  src="<?php echo e(asset('assets/images/esblogo.png')); ?>" alt="Logo"
                    width="65" />

                <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                    x-transition class="hidden dark:block m-2 " src="<?php echo e(asset('assets/images/esblogo.png')); ?>"
                    alt="Logo" width="65" />

                <!-- Logo ICON (WAJIB beda file) -->
                
                <img x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen"
                    x-transition src="<?php echo e(asset('assets/images/logoesb.png')); ?>" alt="Logo Icon" width="40" />
            </a>

            <div x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="ml-auto">
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canAccessPos): ?>
            <div class="pb-1 mt-3" x-data="{ showTooltip: false }"
                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen || window.innerWidth >= 1024">

                <a href="<?php echo e(route('pos.index')); ?>" wire:navigate @mouseenter="showTooltip = true"
                    @mouseleave="showTooltip = false"
                    class="relative flex items-center w-full px-3 py-1 transition-all duration-300 ease-in-out rounded-xl group focus:outline-none focus:ring-2 focus:ring-offset-2"
                    :class="[
                    
                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'justify-center' : 'justify-start'
                ]">

                    <span class="flex items-center justify-center"
                        :class="isActive('<?php echo e(route('pos.index', [], false)); ?>') ? 'text-white' : 'text-gray-500'">
                        <svg width="14" height="14" viewBox="0 0 1488 1206" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Border luar -->
                            <rect
                                x="110"
                                y="110"
                                width="1267"
                                height="986"
                                stroke="currentColor"
                                stroke-width="70"
                            />

                            <!-- Kotak kiri -->
                            <rect
                                x="336.5"
                                y="320.5"
                                width="566"
                                height="348"
                                stroke="currentColor"
                                stroke-width="70"
                            />

                            <!-- Sudut kiri atas -->
                            <rect
                                width="193"
                                height="192"
                                fill="currentColor"
                            />

                            <!-- Sudut kanan atas -->
                            <rect
                                x="1295"
                                width="193"
                                height="192"
                                fill="currentColor"
                            />

                            <!-- Sudut kiri bawah -->
                            <rect
                                y="1014"
                                width="193"
                                height="192"
                                fill="currentColor"
                            />

                            <!-- Sudut kanan bawah -->
                            <rect
                                x="1295"
                                y="1014"
                                width="193"
                                height="192"
                                fill="currentColor"
                            />

                            <!-- Bentuk kanan -->
                            <path
                                d="M1171.5 534H904V668H580V907.5H1171.5V534Z"
                                stroke="currentColor"
                                stroke-width="43"
                            />
                        </svg>
                    </span>

                    
                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="ml-6.5 text-sm font-bold tracking-wide whitespace-nowrap transition-colors duration-200"
                        :class="isActive('<?php echo e(route('pos.index', [], false)); ?>') 
                            ? 'text-white' 
                            : 'text-gray-400 hover:text-white group-hover:text-white'">
                        Table List
                    </span>

                    
                    <div x-show="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) && showTooltip"
                        x-cloak 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="absolute left-[4.5rem] z-[50] px-3 py-2 text-xs font-semibold bg-gray-800 rounded-lg shadow-xl whitespace-nowrap transition-colors duration-200"
                        :class="isActive('<?php echo e(route('pos.index', [], false)); ?>') ? 'text-white font-bold' : 'text-gray-300'">
                        Table List
                        
                        <div class="absolute w-2 h-2 bg-gray-800 rotate-45 -left-1 top-2.5"></div>
                    </div>
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Navigation Menu -->
        <div class="flex flex-1 min-h-0 flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
            <nav class="pb-6">
                <div class="flex flex-col gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $menuGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupIndex => $menuGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim((string) ($menuGroup['title'] ?? '')) !== ''): ?>
                                <h2 class="mb-4 text-xs uppercase flex leading-[20px] text-gray-500" :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar
                                                .isMobileOpen) ?
                                            'lg:justify-center' : 'justify-start'">
                                    <template
                                        x-if="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                                        <span><?php echo e($menuGroup['title']); ?></span>
                                    </template>
                                    <template
                                        x-if="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                                fill="currentColor" />
                                        </svg>
                                    </template>
                                </h2>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Menu Items -->
                            <!-- Menu Items -->
                            <ul class="flex flex-col gap-1 w-full">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $menuGroup['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemIndex => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <li class="w-full flex justify-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($item['subItems'])): ?>
                                            <!-- Menu Item with Submenu -->
                                            <button @click="toggleSubmenu(<?php echo e($groupIndex); ?>, <?php echo e($itemIndex); ?>)"
                                                class="menu-item group w-full flex items-center transition-all duration-300" 
                                                :class="[
                                                    isSubmenuOpen(<?php echo e($groupIndex); ?>, <?php echo e($itemIndex); ?>) ? 'menu-item-active' : 'menu-item-inactive',
                                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 
                                                    'justify-center px-0' : 'justify-start px-3'
                                                ]">

                                                <!-- Icon -->
                                                <span class="flex items-center justify-center w-4 h-4" 
                                                    :class="isSubmenuOpen(<?php echo e($groupIndex); ?>, <?php echo e($itemIndex); ?>) ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                                    <?php echo \App\Helpers\MenuHelper::getIconSvg($item['icon']); ?>

                                                </span>

                                                <!-- Text -->
                                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="menu-item-text flex items-center gap-2 ml-3">
                                                    <?php echo e($item['name']); ?>

                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item['new'])): ?>
                                                        <span class="absolute right-10" :class="isActive('<?php echo e($item['path'] ?? ''); ?>', <?php echo e(json_encode($item['exact'] ?? false)); ?>) ? 'menu-dropdown-badge menu-dropdown-badge-active' : 'menu-dropdown-badge menu-dropdown-badge-inactive'">
                                                            new
                                                        </span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </span>

                                                <!-- Chevron Down Icon -->
                                                <svg x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="ml-auto w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180 text-gray-500': isSubmenuOpen(<?php echo e($groupIndex); ?>, <?php echo e($itemIndex); ?>) }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>

                                            <!-- Submenu (Hanya muncul jika sidebar melebar) -->
                                            <div x-show="isSubmenuOpen(<?php echo e($groupIndex); ?>, <?php echo e($itemIndex); ?>) && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)" class="w-full">
                                                <ul class="mt-2 space-y-1 ml-9">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $item['subItems']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                        <li>
                                                            <a href="<?php echo e($subItem['path']); ?>" wire:navigate class="menu-dropdown-item"
                                                                :class="isActive('<?php echo e($subItem['path']); ?>', <?php echo e(json_encode($subItem['exact'] ?? false)); ?>, <?php echo e(json_encode($subItem['exclude'] ?? [])); ?>) ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                                                <?php echo e($subItem['name']); ?>

                                                            </a>
                                                        </li>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php else: ?>
                                            <!-- Simple Menu Item -->
                                            <a href="<?php echo e($item['path']); ?>" wire:navigate.hover 
                                                class="menu-item group w-full flex items-center transition-all duration-300" 
                                                :class="[
                                                    isActive('<?php echo e($item['path']); ?>', <?php echo e(json_encode($item['exact'] ?? false)); ?>) ? 'menu-item-active' : 'menu-item-inactive',
                                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 
                                                    'justify-center px-0' : 'justify-start px-3'
                                                ]">

                                                <!-- Icon -->
                                                <span class="flex items-center justify-center w-4 h-4"
                                                    :class="isActive('<?php echo e($item['path']); ?>', <?php echo e(json_encode($item['exact'] ?? false)); ?>) ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                                    <?php echo \App\Helpers\MenuHelper::getIconSvg($item['icon']); ?>

                                                </span>

                                                <!-- Text -->
                                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="menu-item-text flex items-center gap-2 ml-3">
                                                    <?php echo e($item['name']); ?>

                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item['new'])): ?>
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-brand-500 text-white">
                                                            new
                                                        </span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </span>
                                            </a>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </nav>

            <!-- User Profile Section - Minimal -->
            <div class="mt-2 pt-4 pb-2 border-t border-gray-200 dark:border-gray-800">
                <!-- Profile Header - No hover effects -->
                <div class="flex items-center gap-3 p-3 rounded-xl justify-center">
                    <div class="flex-shrink-0">
                        <svg class="w-4 h-4 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                        class="min-w-0 flex-1">
                        <p class="font-semibold text-sm text-gray-500 truncate dark:text-white jus">
                            <?php echo e(auth()->user()?->name ?? 'Pengguna'); ?>

                        </p>
                        <p class="text-xs text-gray-500 truncate dark:text-gray-400"><?php echo e(auth()->user()?->email ?? ''); ?>

                        </p>
                    </div>
                    
                </div>

                <!-- END SHIFT BUTTON -->
                <div class="mt-3 px-3">
                    
                            <button type="button" wire:click="processEndShift"
                                wire:confirm="Yakin ingin menutup shift? Laporan akan dicetak dan Anda akan keluar dari aplikasi."
                                class="relative group w-full flex items-center justify-center gap-1 py-2 px-1 text-sm font-semibold text-orange-600  rounded-lg transition-colors dark:bg-orange-500/10 dark:text-orange-400 dark:border-orange-500/30 dark:hover:bg-orange-500/20"
                                x-data="{ showTooltip: false }" @mouseenter="showTooltip = true"
                                @mouseleave="showTooltip = false">

                                <svg class="w-4 h-4 flex-shrink-0" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>

                                <span
                                    x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-x-1"
                                    x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Tutup
                                    Shift</span>

                                <!-- Tooltip for collapsed state -->
                                <div x-show="showTooltip && !($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="absolute left-full ml-2 z-[50] px-3 py-2 text-xs font-semibold text-white bg-gray-800 rounded-lg shadow-xl whitespace-nowrap">
                                    Tutup Shift
                                    <div class="absolute w-2 h-2 bg-gray-800 -left-1 top-2 rotate-45"></div>
                                </div>
                            </button>
                </div>

                
                <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>" class="hidden">
                    <?php echo csrf_field(); ?>
                </form>

                <!-- Logout Only -->
                <script>
                    function endShift() {
                        if (confirm(
                            'Tutup shift dan cetak laporan tutup kasir? (nama kasir: <?php echo e(auth()->user()?->name); ?>, hari ini)')) {
                            // Demo end-shift data (real data in production)
                            const endShiftData = {
                                store: {
                                    name: 'ALAS BU YANTI',
                                    address: 'Jl. Raya Ciawi Prapatan No.6',
                                    logo_url: '/assets/images/logoesb.png'
                                },
                                cashier: '<?php echo e(auth()->user()?->name ?? 'Kasir'); ?>',
                                shift_open: '08:00',
                                shift_close: new Date().toLocaleTimeString('id-ID'),
                                total_sales: 1250000,
                                total_items: 85,
                                top_products: [{
                                    name: 'Nasi Goreng Spesial',
                                    qty: 12,
                                    total: 180000
                                },
                                {
                                    name: 'Ayam Bakar Madu',
                                    qty: 8,
                                    total: 120000
                                },
                                {
                                    name: 'Es Teh Manis',
                                    qty: 25,
                                    total: 62500
                                },
                                {
                                    name: 'Mie Goreng',
                                    qty: 6,
                                    total: 48000
                                },
                                {
                                    name: 'Tumis Kangkung',
                                    qty: 5,
                                    total: 35000
                                }
                                ],
                                items: [{
                                    product: {
                                        name: 'Nasi Goreng Spesial'
                                    },
                                    quantity: 12,
                                    price: 15000,
                                    subtotal: 180000
                                },
                                {
                                    product: {
                                        name: 'Ayam Bakar Madu'
                                    },
                                    quantity: 8,
                                    price: 15000,
                                    subtotal: 120000
                                }
                                ]
                            };

                            // Trigger print modal with end-shift context
                            window.dispatchEvent(new CustomEvent('pos-print-modal', {
                                detail: {
                                    payload: endShiftData,
                                    context: 'end-shift'
                                }
                            }));

                            // Auto logout
                            // POST logout (for admin domain)
                            const logoutForm = document.createElement('form');
                            logoutForm.method = 'POST';
                            logoutForm.action = '<?php echo e(route('logout')); ?>';
                            logoutForm.style.display = 'none';

                            const csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            logoutForm.appendChild(csrfInput);
                            document.body.appendChild(logoutForm);
                            logoutForm.submit();

                            console.log('End Shift triggered - printing + logout');
                        }
                    }
                </script>

                <!-- Logout Only -->

            </div>
        </div>
        <?php
            $canGuides = auth()->user()?->can('guides.view') ?? false;
        ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canGuides): ?>
            <div x-cloak x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                class="mx-auto mb-6 mt-4 w-full max-w-60 rounded-2xl border border-gray-200 bg-white px-4 py-5 dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex flex-col items-center justify-center gap-3 text-center">
                    <span
                        class="mt-0.5 hidden md:inline-flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500 text-white">
                        <svg class="h-1 w-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            Butuh panduan cepat?
                        </h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Baca buku panduan untuk memahami penggunaan aplikasi.
                        </p>
                    </div>
                </div>

                <a href="<?php echo e(route('guides.index')); ?>" wire:navigate
                    class="bg-brand-500 text-theme-sm hover:bg-brand-600 mt-4 flex items-center justify-center rounded-lg p-3 font-medium text-white">
                    Buka Buku Panduan
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </aside>

    <div x-show="($store.sidebar.isExpanded || $store.sidebar.isMobileOpen) && window.innerWidth < 1024"
        @click="$store.sidebar.toggleExpanded()"
        class="fixed inset-0 z-[999] bg-black/30 transition-opacity duration-300 lg:hidden"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <!-- Enhanced Full Screen Overlay - Click anywhere to close -->
    <div x-show="$store.sidebar.isMobileOpen" @click="$store.sidebar.toggleExpanded()"
        class="fixed inset-0 z-[999] bg-black/30 transition-opacity duration-300"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>
</div>
</div><?php /**PATH D:\farhan\projects\freelance\pos-restoran-v2\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>