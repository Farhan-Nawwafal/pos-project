<header
    class="sticky flex w-full bg-[#3C8DBC] border-[#3C8DBC] z-[99999] dark:border-[#3C8DBC] dark:bg-[#3C8DBC] xl:border-b"
    style="height: 50px;" x-data="{
        isApplicationMenuOpen: false,
        isProfileOpen: false,
        toggleApplicationMenu() {
            this.isApplicationMenuOpen = !this.isApplicationMenuOpen;
        }
    }">
    <div class="flex items-center justify-between w-full px-4 h-full">
        
        <!-- ==================== ZONA KIRI ==================== -->
        <!-- Toggle Sidebar & Status Enable -->
        <div class="flex items-center gap-3 shrink-0">
            <!-- Mobile Sidebar Toggle -->
            <button
                class="flex lg:hidden items-center justify-center w-8 h-8 text-white rounded-lg hover:bg-white/20 transition-colors"
                :class="{ 'bg-white/20': $store.sidebar.isMobileOpen }" @click="$store.sidebar.toggleExpanded()"
                aria-label="Toggle Sidebar">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Sidebar Toggle -->
            <button class="hidden lg:flex items-center justify-center rounded-lg p-2 transition-colors hover:bg-white/10"
                @click="$store.sidebar.toggleExpanded()" aria-label="Toggle Sidebar">
                <svg width="18" height="16" viewBox="0 0 20 14" fill="none">
                    <path d="M1 1H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M1 7H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M1 13H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>

            <!-- Status Enable -->
            <div class="flex items-center gap-1.5 px-2 py-1 border border-gray-300 rounded-2xl bg-white select-none shrink-0">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-xs font-semibold text-green-500">Enable</span>
            </div>
            <div class="flex items-center gap-1.5 text-white text-sm shrink-0">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <button @click="$store.sidebar.toggleEsbModal()" class=" text-left truncate max-w-[150px] sm:max-w-none">
                    ESB Order Notification
                </button>
            </div>
        </div>

        <!-- ==================== ZONA TENGAH ==================== -->
        <!-- Notifikasi & Waktu Real-time (Akan mengalir rapi di tengah) -->
        <div class="flex items-center justify-center gap-3 mx-3 grow overflow-hidden">
            <!-- Order Notification -->
            

            <!-- Bell Icon -->
           
        </div>

        <!-- ==================== ZONA KANAN ==================== -->
        <!-- Info Cabang, Role, & Aksi Akun -->
        <div class="flex items-center gap-3 shrink-0">
            <!-- Info Cabang & Role -->
            <div class="hidden lg:flex items-center gap-2 text-white text-xs">
                 <i class="bi bi-bell-fill text-white shrink-0 cursor-pointer  pr-1.5"></i>

            <!-- Live Clock (Akan otomatis disembunyikan di layar HP kecil agar tidak sesak) -->
            <div x-data="{ now: new Date() }" x-init="setInterval(() => now = new Date(), 1000)"
                class="hidden md:flex items-center gap-1 text-sm text-white shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round" class="w-3.5 h-3.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 12"></polyline>
                </svg>
                <span x-text="now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })"></span>
                <span x-text="now.toLocaleTimeString('id-ID', { hour12: false })" class="font-mono"></span>
            </div>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M 12 2 A 1 1 0 0 0 11.289062 2.296875 L 1.203125 11.097656 A 0.5 0.5 0 0 0 1 11.5 A 0.5 0.5 0 0 0 1.5 12 L 4 12 L 4 20 C 4 20.552 4.448 21 5 21 L 9 21 C 9.552 21 10 20.552 10 20 L 10 14 L 14 14 L 14 20 C 14 20.552 14.448 21 15 21 L 19 21 C 19.552 21 20 20.552 20 20 L 20 12 L 22.5 12 A 0.5 0.5 0 0 0 23 11.5 A 0.5 0.5 0 0 0 22.796875 11.097656 L 12.716797 2.3027344 A 1 1 0 0 0 12.710938 2.296875 A 1 1 0 0 0 12 2 z" />
                    </svg>
                    <span class="uppercase truncate max-w-[120px] gap-1">
                        <?php echo e(auth()->user()->cabang->name ?? ''); ?>

                    </span>
                </div>
                <div class="flex items-center gap-1">
                    <i class="bi bi-display"></i>
                    <span class="uppercase "><?php echo e(auth()->user()->role); ?></span>
                </div>
            </div>

            <!-- Sign Out Button -->
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="flex items-center">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="flex items-center gap-1 text-white/90 hover:text-white text-xs py-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" class="w-3 h-3">
                        <path d="M16.5 5.5 A 9 9 0 1 1 7.5 5.5"></path>
                        <line x1="12" y1="4" x2="12" y2="10"></line>
                    </svg>
                    <span class="hidden sm:inline">Sign Out</span>
                </button>
            </form>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button @click="isProfileOpen = !isProfileOpen" @click.away="isProfileOpen = false"
                    class="flex items-center gap-1 text-white/90 text-xs font-medium py-1 transition-all">
                    <img src="/assets/icons/men.png" alt="Profile" class="w-3 h-3  object-cover">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-2 h-2">
                        <!-- Segitiga luar (mengikuti warna teks/Tailwind) -->
                        <polygon points="12,22 1,3 23,3" fill="currentColor" />
                        
                        <!-- Garis & Titik di dalam (selalu berwarna putih) -->
                        <line x1="12" y1="7" x2="12" y2="13" stroke="white" stroke-width="2" stroke-linecap="round" />
                        <circle cx="12" cy="16.5" r="1" fill="white" />
                    </svg>
                </button>

                <!-- Dropdown Card -->
                <div x-show="isProfileOpen" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute top-full right-0 mt-2 flex flex-col items-center w-44 bg-[#3C8DBC] border border-white/20 rounded-lg shadow-xl py-1 z-[100000] text-white text-center"
                    style="display: none;">
                    
                    
                    <a href="#" class="flex items-center justify-center w-full px-4 py-2 text-xs uppercase transition-colors">
                        <span><?php echo e(auth()->user()->role); ?></span>
                    </a>
                    <a href="#" class="flex items-center justify-center w-full px-4 py-2 text-xs uppercase transition-colors">
                        <span><?php echo e(auth()->user()->cabang->name ?? ''); ?></span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</header><?php /**PATH D:\farhan\projects\freelance\pos-restoran-v2\resources\views/layouts/app-header.blade.php ENDPATH**/ ?>