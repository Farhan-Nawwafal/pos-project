<header
    class="sticky top-0 flex w-full bg-[#1086e1] border-[#0f75c7] z-[99999] dark:border-[#0c5fa3] dark:bg-[#0f75c7] xl:border-b"
    x-data="{
        isApplicationMenuOpen: false,
        toggleApplicationMenu() {
            this.isApplicationMenuOpen = !this.isApplicationMenuOpen;
        }
    }">
    <div class="flex flex-row items-center justify-between grow xl:flex-row xl:px-6">
        <div
            class="flex items-center justify-between w-full gap-2 px-3 py-3 border-b border-gray-200 dark:border-gray-800 sm:gap-4 xl:justify-normal xl:border-b-0 xl:px-0 lg:py-4">

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
                        class="hidden lg:flex items-center justify-center hover:bg-white/10 rounded-lg p-2 transition-colors"
                        @click="$store.sidebar.toggleExpanded()" aria-label="Toggle Sidebar">
                        <svg width="22" height="16" viewBox="0 0 20 14" fill="none">
                            <path d="M1 1H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <path d="M1 7H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <path d="M1 13H19" stroke="white" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>

                    <div class="flex flex-col px-3 py-2 border border-gray-300 rounded-lg bg-white/10 backdrop-blur-sm">
                        <span class="text-sm font-semibold text-white">
                            Cabang <?php echo e(auth()->user()->cabang->name ?? ''); ?>

                        </span>
                        <span class="text-xs text-gray-300">
                            <?php echo e(auth()->user()->email); ?>

                        </span>
                    </div>
                </div>

                <div class="absolute inset-x-0 flex justify-center pointer-events-none">
                    <div class="hidden md:block pointer-events-auto">
                        <span
                            class="flex flex-col px-3 py-2 border border-gray-300 rounded-lg bg-white/10 backdrop-blur-sm text-white shadow-sm">
                            <?php echo e(now()->translatedFormat('l, d F Y')); ?>

                        </span>
                    </div>
                </div>

                <div></div>
            </div>

            <div class="flex items-center gap-2 xl:hidden">
                <button
                    class="flex items-center justify-center text-white bg-white/10 border border-white/20 rounded-lg h-10 w-10 hover:bg-white/20 transition-colors"
                    @click="$store.theme.toggle()">
                    <svg class="hidden dark:block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10 1.5V3.5M10 16.5V18.5M18.5 10H16.5M3.5 10H1.5M16.01 3.99L14.6 5.4M5.4 14.6L3.99 16.01M16.01 16.01L14.6 14.6M5.4 5.4L3.99 3.99M10 5.25C7.4 5.25 5.25 7.4 5.25 10C5.25 12.6 7.4 14.75 10 14.75C12.6 14.75 14.75 12.6 14.75 10C14.75 7.4 12.6 5.25 10 5.25Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <svg class="dark:hidden" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 3C10.5 3 9.1 3.4 7.9 4.1C11.3 5.5 13.5 8.6 13.5 12.2C13.5 15.8 11.3 18.9 7.9 20.3C9.1 21 10.5 21.4 12 21.4C17 21.4 21 17.4 21 12.4C21 7.4 17 3.4 12 3Z"
                            fill="currentColor" />
                    </svg>
                </button>

                <?php if (isset($component)) { $__componentOriginal5244120b97535e1df999e479699c0de1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5244120b97535e1df999e479699c0de1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header.notification-dropdown','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header.notification-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5244120b97535e1df999e479699c0de1)): ?>
<?php $attributes = $__attributesOriginal5244120b97535e1df999e479699c0de1; ?>
<?php unset($__attributesOriginal5244120b97535e1df999e479699c0de1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5244120b97535e1df999e479699c0de1)): ?>
<?php $component = $__componentOriginal5244120b97535e1df999e479699c0de1; ?>
<?php unset($__componentOriginal5244120b97535e1df999e479699c0de1); ?>
<?php endif; ?>

                <div
                    class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg bg-white/10 backdrop-blur-sm">
                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm font-semibold text-white">ESB Order</span>
                        <span class="text-xs text-gray-300">Online</span>
                    </div>
                </div>
            </div>
        </div>

        <div :class="isApplicationMenuOpen ? 'flex' : 'hidden'"
            class="items-center justify-between w-full gap-4 px-5 py-4 xl:flex shadow-theme-md xl:justify-end xl:px-0 xl:shadow-none">
            <div class="flex items-center gap-1 2xsm:gap-3">
                <button
                    class="relative flex items-center justify-center text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:text-dark-900 h-11 w-11 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                    @click="$store.theme.toggle()">
                    <svg class="hidden dark:block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.99998 1.5415C10.4142 1.5415 10.75 1.87729 10.75 2.2915V3.5415C10.75 3.95572 10.4142 4.2915 9.99998 4.2915C9.58577 4.2915 9.24998 3.95572 9.24998 3.5415V2.2915C9.24998 1.87729 9.58577 1.5415 9.99998 1.5415ZM10.0009 6.79327C8.22978 6.79327 6.79402 8.22904 6.79402 10.0001C6.79402 11.7712 8.22978 13.207 10.0009 13.207C11.772 13.207 13.2078 11.7712 13.2078 10.0001C13.2078 8.22904 11.772 6.79327 10.0009 6.79327ZM5.29402 10.0001C5.29402 7.40061 7.40135 5.29327 10.0009 5.29327C12.6004 5.29327 14.7078 7.40061 14.7078 10.0001C14.7078 12.5997 12.6004 14.707 10.0009 14.707C7.40135 14.707 5.29402 12.5997 5.29402 10.0001ZM15.9813 5.08035C16.2742 4.78746 16.2742 4.31258 15.9813 4.01969C15.6884 3.7268 15.2135 3.7268 14.9207 4.01969L14.0368 4.90357C13.7439 5.19647 13.7439 5.67134 14.0368 5.96423C14.3297 6.25713 14.8045 6.25713 15.0974 5.96423L15.9813 5.08035ZM18.4577 10.0001C18.4577 10.4143 18.1219 10.7501 17.7077 10.7501H16.4577C16.0435 10.7501 15.7077 10.4143 15.7077 10.0001C15.7077 9.58592 16.0435 9.25013 16.4577 9.25013H17.7077C18.1219 9.25013 18.4577 9.58592 18.4577 10.0001ZM14.9207 15.9806C15.2135 16.2735 15.6884 16.2735 15.9813 15.9806C16.2742 15.6877 16.2742 15.2128 15.9813 14.9199L15.0974 14.036C14.8045 13.7431 14.3297 13.7431 14.0368 14.036C13.7439 14.3289 13.7439 14.8038 14.0368 15.0967L14.9207 15.9806ZM9.99998 15.7088C10.4142 15.7088 10.75 16.0445 10.75 16.4588V17.7088C10.75 18.123 10.4142 18.4588 9.99998 18.4588C9.58577 18.4588 9.24998 18.123 9.24998 17.7088V16.4588C9.24998 16.0445 9.58577 15.7088 9.99998 15.7088ZM5.96356 15.0972C6.25646 14.8043 6.25646 14.3295 5.96356 14.0366C5.67067 13.7437 5.1958 13.7437 4.9029 14.0366L4.01902 14.9204C3.72613 15.2133 3.72613 15.6882 4.01902 15.9811C4.31191 16.274 4.78679 16.274 5.07968 15.9811L5.96356 15.0972ZM4.29224 10.0001C4.29224 10.4143 3.95645 10.7501 3.54224 10.7501H2.29224C1.87802 10.7501 1.54224 10.4143 1.54224 10.0001C1.54224 9.58592 1.87802 9.25013 2.29224 9.25013H3.54224C3.95645 9.25013 4.29224 9.58592 4.29224 10.0001ZM4.9029 5.9637C5.1958 6.25659 5.67067 6.25659 5.96356 5.9637C6.25646 5.6708 6.25646 5.19593 5.96356 4.90303L5.07968 4.01915C4.78679 3.72626 4.31191 3.72626 4.01902 4.01915C3.72613 4.31204 3.72613 4.78692 4.01902 5.07981L4.9029 5.9637Z"
                            fill="currentColor" />
                    </svg>
                    <svg class="dark:hidden" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.4547 11.97L18.1799 12.1611C18.265 11.8383 18.1265 11.4982 17.8401 11.3266C17.5538 11.1551 17.1885 11.1934 16.944 11.4207L17.4547 11.97ZM8.0306 2.5459L8.57989 3.05657C8.80718 2.81209 8.84554 2.44682 8.67398 2.16046C8.50243 1.8741 8.16227 1.73559 7.83948 1.82066L8.0306 2.5459ZM12.9154 13.0035C9.64678 13.0035 6.99707 10.3538 6.99707 7.08524H5.49707C5.49707 11.1823 8.81835 14.5035 12.9154 14.5035V13.0035ZM16.944 11.4207C15.8869 12.4035 14.4721 13.0035 12.9154 13.0035V14.5035C14.8657 14.5035 16.6418 13.7499 17.9654 12.5193L16.944 11.4207ZM16.7295 11.7789C15.9437 14.7607 13.2277 16.9586 10.0003 16.9586V18.4586C13.9257 18.4586 17.2249 15.7853 18.1799 12.1611L16.7295 11.7789ZM10.0003 16.9586C6.15734 16.9586 3.04199 13.8433 3.04199 10.0003H1.54199C1.54199 14.6717 5.32892 18.4586 10.0003 18.4586V16.9586ZM3.04199 10.0003C3.04199 6.77289 5.23988 4.05695 8.22173 3.27114L7.83948 1.82066C4.21532 2.77574 1.54199 6.07486 1.54199 10.0003H3.04199ZM6.99707 7.08524C6.99707 5.52854 7.5971 4.11366 8.57989 3.05657L7.48132 2.03522C6.25073 3.35885 5.49707 5.13487 5.49707 7.08524H6.99707Z"
                            fill="currentColor" />
                    </svg>
                </button>

                <?php if (isset($component)) { $__componentOriginal5244120b97535e1df999e479699c0de1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5244120b97535e1df999e479699c0de1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header.notification-dropdown','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header.notification-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5244120b97535e1df999e479699c0de1)): ?>
<?php $attributes = $__attributesOriginal5244120b97535e1df999e479699c0de1; ?>
<?php unset($__attributesOriginal5244120b97535e1df999e479699c0de1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5244120b97535e1df999e479699c0de1)): ?>
<?php $component = $__componentOriginal5244120b97535e1df999e479699c0de1; ?>
<?php unset($__componentOriginal5244120b97535e1df999e479699c0de1); ?>
<?php endif; ?>
            </div>

            <div class="flex items-center">
                <div
                    class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg bg-white/10 backdrop-blur-sm">
                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm font-semibold text-white">ESB Order</span>
                        <span class="text-xs text-gray-300">Online</span>
                    </div>
                </div>
            </div>
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
</script>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\layouts\app-header.blade.php ENDPATH**/ ?>