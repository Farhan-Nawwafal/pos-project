<header
    class="sticky flex w-full bg-[#3C8DBC] border-[#3C8DBC] z-[99999] dark:border-[#3C8DBC] dark:bg-[#3C8DBC] xl:border-b"
    style="height: 50px;" x-data="{
        isApplicationMenuOpen: false,
        isProfileOpen: false, /* State baru untuk Dropdown Profil */
        toggleApplicationMenu() {
            this.isApplicationMenuOpen = !this.isApplicationMenuOpen;
        }
    }">
    <div class="flex flex-row items-center justify-between grow xl:flex-row xl:px-5">
        <div
            class="flex items-center justify-between w-full gap-1 px-1 py-1 border-b border-gray-200 dark:border-gray-800 sm:gap-2 xl:justify-normal xl:border-b-0 xl:px-0 lg:py-0">

            <button
                class="flex lg:hidden items-center justify-center w-10 h-10 text-white rounded-lg hover:bg-white/20 transition-colors"
                :class="{ 'bg-white/20': $store.sidebar.isMobileOpen }" @click="$store.sidebar.toggleExpanded()"
                aria-label="Toggle Sidebar">

                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-6">
                    <button class="hidden lg:flex items-center justify-center rounded-lg p-2 transition-colors"
                        @click="$store.sidebar.toggleExpanded()" aria-label="Toggle Sidebar">
                        <svg width="18" height="16" viewBox="0 0 20 14" fill="none">
                            <path d="M1 1H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <path d="M1 7H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <path d="M1 13H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                    <div
                        class="flex items-center gap-1 px-3 py-1 border border-gray-300 rounded-2xl bg-white backdrop-blur-sm">
                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                        <div class="flex flex-col leading-tight">
                            <span class="text-sm text-green-500">Enable</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 ml-1 ">
                        <i class="bi bi-exclamation-triangle-fill text-white text-sm "></i>

                        <button @click="$store.sidebar.toggleEsbModal()" class="btn text-white text-sm">
                            ESB Order Notification
                        </button>
                    </div>

                    
                    <i class="bi bi-bell-fill text-white absolute right-160  pointer-events-none"></i>

                    <div class="absolute inset-x-0 gap-3 flex items-center justify-end mr-40 pointer-events-none">
                        <div x-data="{ now: new Date() }" x-init="setInterval(() => now = new Date(), 1000)"
                            class="text-sm text-white flex items-center justify-end gap-2">

                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="w-3.5 h-3.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 12"></polyline>
                            </svg>

                            <span
                                x-text="now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })"></span>

                            <span x-text="now.toLocaleTimeString('id-ID', { hour12: false })" class="font-mono"></span>

                        </div>
                        <div class="flex items-center gap-1 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M 12 2 A 1 1 0 0 0 11.289062 2.296875 L 1.203125 11.097656 A 0.5 0.5 0 0 0 1 11.5 A 0.5 0.5 0 0 0 1.5 12 L 4 12 L 4 20 C 4 20.552 4.448 21 5 21 L 9 21 C 9.552 21 10 20.552 10 20 L 10 14 L 14 14 L 14 20 C 14 20.552 14.448 21 15 21 L 19 21 C 19.552 21 20 20.552 20 20 L 20 12 L 22.5 12 A 0.5 0.5 0 0 0 23 11.5 A 0.5 0.5 0 0 0 22.796875 11.097656 L 12.716797 2.3027344 A 1 1 0 0 0 12.710938 2.296875 A 1 1 0 0 0 12 2 z" />
                            </svg>

                            <span class="text-sm uppercase">
                                Cabang <?php echo e(auth()->user()->cabang->name ?? ''); ?>

                            </span>
                        </div>
                        <div class="flex items-center gap-1 text-white text-xs uppercase">
                            <i class="bi bi-display"></i>
                            <span class="flex flex-col text-sm text-white">
                                <?php echo e(auth()->user()->role); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 relative">
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="flex items-center">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="flex items-center gap-1 text-white/90 hover:text-white text-sm py-2 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4">
                                <path d="M16.5 5.5 A 9 9 0 1 1 7.5 5.5"></path>
                                <line x1="12" y1="4" x2="12" y2="10"></line>
                            </svg>
                            Sign Out
                        </button>
                    </form>

                    <div class="relative">

                        <button @click="isProfileOpen = !isProfileOpen" @click.away="isProfileOpen = false"
                            class="flex items-center gap-1.5 text-white/90  text-sm font-medium py-1 px-2 rounded-lg transition-all">

                            <img src="/assets/icons/men.png" alt="Search" class="w-4 h-4  ">

                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="w-3.5 h-3.5 transition-transform duration-200"
                                :class="isProfileOpen ? 'rotate-180' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <div x-show="isProfileOpen" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute top-full right-0 mt-3 flex flex-col items-center w-40 bg-brand-500 rounded-lg shadow-xl py-1 z-[100000] text-white text-center"
                            style="display: none;">

                            <a href="#"
                                class="flex items-center justify-center w-full px-4 py-2 text-sm uppercase hover:bg-white/10 transition-colors">
                                <span><?php echo e(auth()->user()->role); ?></span>
                            </a>
                            <a href="#"
                                class="flex items-center justify-center w-full px-4 py-2 text-sm uppercase hover:bg-white/10 transition-colors">
                                <span><?php echo e(auth()->user()->cabang->name ?? ''); ?></span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</header><?php /**PATH D:\Shaall\PROJECT\pos-project\resources\views/layouts/app-header.blade.php ENDPATH**/ ?>