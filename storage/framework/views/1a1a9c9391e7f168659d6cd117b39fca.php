<header
    class="sticky flex w-full bg-[#1086e1] border-[#0f75c7] z-[99999] dark:border-[#0c5fa3] dark:bg-[#0f75c7] xl:border-b"
    style="height: 60px;" x-data="{

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
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-3">
                    <button
                        class="hidden lg:flex items-center justify-center rounded-lg p-2 transition-colors"
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
                    <div class="flex flex-col">
                        <span class="text-sm text-white">ESB Order Notification</span>
                    </div>
                    <div class="absolute inset-x-0 gap-7 flex items-center justify-end mr-30 pointer-events-none">
                        <div x-data="{ now: new Date() }" x-init="setInterval(() => now = new Date(), 1000)"
                            class="text-sm text-white text-right">

                            <span
                                x-text="now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })"></span>
                            <span x-text="now.toLocaleTimeString('id-ID', { hour12: false })"
                                class="font-mono ml-2"></span>
                        </div>
                        <div>
                            <span class="flex flex-col text-sm text-white">
                                Cabang <?php echo e(auth()->user()->cabang->name ?? ''); ?>

                            </span>
                        </div>
                        <div>

                            <span class="flex flex-col text-sm text-white">
                                <?php echo e(auth()->user()->role); ?>

                            </span>
                        </div>
                        

                    </div>


                    
                </div>
                <div class="flex items-center gap-2">
                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="flex items-center">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="text-white/90 hover:text-white text-sm font-semibold px-3 py-2 rounded-lg  transition-colors">
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