<header
    class="sticky flex w-full bg-[#1086e1] border-[#0f75c7] z-[99999] dark:border-[#0c5fa3] dark:bg-[#0f75c7] xl:border-b"
    style="height: 45px;" x-data="{

        isApplicationMenuOpen: false,
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

                <!-- Plain white 3-lines hamburger (always, no X toggle) -->
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-3">
                    <button class="hidden lg:flex items-center justify-center rounded-lg p-2 transition-colors"
                        @click="$store.sidebar.toggleExpanded()" aria-label="Toggle Sidebar">
                        <svg width="22" height="16" viewBox="0 0 20 14" fill="none">
                            <path d="M1 1H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <path d="M1 7H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <path d="M1 13H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                    <div
                        class="flex items-center gap-1 px-3 py-1 border border-gray-300 rounded-xl bg-white backdrop-blur-sm">
                        <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                        <div class="flex flex-col leading-tight">
                            <span class="text-sm text-green-500">Enable</span>

                        </div>

                    </div>
                    <div class="flex items-center gap-1 ml-1">
                        <i class="bi bi-exclamation-triangle-fill text-white text-sm "></i>

                        <button @click="$dispatch('open-esb-modal')" class="btn text-white text-sm">
                            ESB Order Notification
                        </button>
                    </div>

                    
                    <i class="bi bi-bell-fill text-white justify-end absolute inset-x-0  flex items-center justify-end mr-146"></i>

                    <div class="absolute inset-x-0 gap-3 flex items-center justify-end mr-30 pointer-events-none">
                        <div x-data="{ now: new Date() }" x-init="setInterval(() => now = new Date(), 1000)"
                            class="text-sm text-white text-right">
                            <i class="bi bi-clock text-xs gap-0.5"></i>
                            <span
                                x-text="now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })"></span>
                            <span x-text="now.toLocaleTimeString('id-ID', { hour12: false })"
                                class="font-mono ml-2"></span>
                        </div>
                        <div class="flex items-center gap-1 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M 12 2 A 1 1 0 0 0 11.289062 2.296875 L 1.203125 11.097656 A 0.5 0.5 0 0 0 1 11.5 A 0.5 0.5 0 0 0 1.5 12 L 4 12 L 4 20 C 4 20.552 4.448 21 5 21 L 9 21 C 9.552 21 10 20.552 10 20 L 10 14 L 14 14 L 14 20 C 14 20.552 14.448 21 15 21 L 19 21 C 19.552 21 20 20.552 20 20 L 20 12 L 22.5 12 A 0.5 0.5 0 0 0 23 11.5 A 0.5 0.5 0 0 0 22.796875 11.097656 L 12.716797 2.3027344 A 1 1 0 0 0 12.710938 2.296875 A 1 1 0 0 0 12 2 z" />
                            </svg>

                            <span class="text-sm">
                                Cabang <?php echo e(auth()->user()->cabang->name ?? ''); ?>

                            </span>
                        </div>
                        <div class="flex items-center gap-1 text-white text-xs">
                            <i class="bi bi-display"></i>
                            <span class="flex flex-col text-sm text-white">
                                <?php echo e(auth()->user()->role); ?>

                            </span>
                        </div>


                    </div>


                    
                </div>
                <div class="flex items-center gap-1">
                    <i class="bi bi-power text-white "></i>

                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="flex items-center">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="text-white/90 hover:text-white text-sm   py-2 rounded-lg  transition-colors">
                            Sign Out
                        </button>
                    </form>
                </div>
                
        </div>
</header>

<script>
    // 1. Variabel untuk filter printer (dari revisi sebelumnya)
    window.PRINTER_SOURCES = <?php echo json_encode($printerSourcesForJs ?? [], 15, 512) ?>;

    // 2. Variabel untuk pembulatan (Nomor 2 yang kamu tanyakan)
    window.APP_SETTINGS = <?php echo json_encode($appSettings ?? ['rounding_base' => 0], 15, 512) ?>;

    // Inisialisasi PrinterManager jika sudah ter-load
    if (window.PrinterManager) {
        window.PrinterManager.configureSources(window.PRINTER_SOURCES);
    }

    console.log("Global Settings & Printer Cabang Berhasil Dimuat.");
</script><?php /**PATH D:\POS PROJECT FINAL\pos-project\resources\views/layouts/app-header.blade.php ENDPATH**/ ?>