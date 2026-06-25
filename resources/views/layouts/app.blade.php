<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.APP_AUTHENTICATED = @json(auth()->check());
        window.APP_CAN_CASHIER_ORDERS = @json(auth()->user()?->can('pos.access') ?? false);
    </script>

    <title>{{ $title ?? 'Dashboard' }} | Restaurant - Alas Bu Yanti</title>
    <link rel="icon" href="{{ asset('assets/images/logoesb.png') }}" type="image/png">
    <link rel="manifest" href="{{ route('admin.manifest') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script>
        window.PRINTER_DEBUG = false;
    </script>

    <script defer src="{{ asset('js/notification-system/notification-manager.js') }}"></script>

    @php $v = time(); @endphp
    <script defer src="{{ asset('js/printer-system/bluetooth-service.js') }}?v={{ $v }}"></script>
    <script defer src="{{ asset('js/printer-system/receipt-templates.js') }}?v={{ $v }}"></script>
    <script defer src="{{ asset('js/printer-system/print-queue.js') }}?v={{ $v }}"></script>
    <script defer src="{{ asset('js/printer-system/printer-manager.js') }}?v={{ $v }}"></script>
    <script defer src="{{ asset('js/printer-system/printer-ui.js') }}?v={{ $v }}"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                        'light';
                    this.theme = savedTheme || systemTheme;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const body = document.body;
                    if (this.theme === 'dark') {
                        html.classList.add('dark');
                        if (body) body.classList.add('dark', 'bg-gray-900');
                    } else {
                        html.classList.remove('dark');
                        if (body) body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });

            Alpine.store('sidebar', {
                isEsbModalOpen: false, 
                toggleEsbModal() {
                    this.isEsbModalOpen = !this.isEsbModalOpen;
                },
                get isExpanded() {
                    const saved = localStorage.getItem('sidebar-expanded');
                    return saved === null ? window.innerWidth >= 1024 : saved !== 'false';
                },
                set isExpanded(val) {
                    localStorage.setItem('sidebar-expanded', val);
                },
                isMobileOpen: false,
                isHovered: false,
                isMobile: window.innerWidth <= 820,
                updateMobile() {
                    this.isMobile = window.innerWidth <= 820;
                },
                restoreState() {
                    const saved = localStorage.getItem('sidebar-expanded');
                    const width = window.innerWidth;
                    if (saved !== null) {
                        this.isExpanded = saved !== 'false';
                    }
                    if (width <= 820) {
                        this.isMobileOpen = false;
                        this.isExpanded = false;
                    }
                    this.isHovered = false;
                },
                toggleExpanded() {
                    const width = window.innerWidth;
                    if (width <= 820) {
                        this.isMobileOpen = !this.isMobileOpen;
                        this.isExpanded = this.isMobileOpen;
                    } else {
                        this.isExpanded = !this.isExpanded;
                        this.isMobileOpen = false;
                    }
                },
                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                },
                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },
                setHovered(val) {
                    if (window.innerWidth >= 1024 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>
</head>

<body x-data="{ 'loaded': true }" x-init="const checkResponsive = () => {
    $store.sidebar.updateMobile();
    const width = window.innerWidth;
    if (width <= 820) {
        $store.sidebar.isExpanded = false;
        $store.sidebar.isMobileOpen = false;
    } else {
        const saved = localStorage.getItem('sidebar-expanded');
        if (saved !== null) {
            $store.sidebar.isExpanded = saved !== 'false';
        } else if (width >= 1024) {
            $store.sidebar.isExpanded = true;
        }
        $store.sidebar.isMobileOpen = false;
    }
};
checkResponsive();
window.addEventListener('resize', checkResponsive);" class="antialiased">
    <x-common.preloader />
    <x-common.loading-bar />

    <div class="min-h-screen xl:flex">
        @include('layouts.backdrop')
        <livewire:layouts.sidebar />

        <div class="flex-1 transition-all duration-300 ease-in-out relative z-10 ml-0" :class="{
                'lg:ml-[60px]': true,
                'lg:ml-[0px] :ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'sm:translate-x-[0px]': $store.sidebar.isExpanded,
                'translate-x-0': !$store.sidebar.isExpanded
            }">

            <div x-show="$store.sidebar.isExpanded && window.innerWidth >= 1024"
                @click="$store.sidebar.toggleExpanded()" class="fixed inset-0 z-[999] bg-gray-900/50"></div>

            @include('layouts.app-header')

            <div class="md:p-0">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Modal POS Print -->
    <div x-data="posPrintModal" x-init="init()" x-show="open" class="fixed inset-0 z-[100000]" style="display: none;"
        aria-modal="true" role="dialog">
        <template x-if="open">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-black/50" @click="close()"></div>
                <div class="absolute inset-0 flex items-center justify-center p-4">
                    <div class="relative flex max-h-[85vh] w-full max-w-2xl flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                            <div>
                                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Cetak Struk</h3>
                            </div>
                            <button type="button" @click="close()" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400">Tutup</button>
                        </div>
                        <!-- Konten modal print lainnya ... -->
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Modal Baru: ESB Order Report -->
   @include('livewire.transactions.esb-order-modal')

    @persist('toast-center')
    <x-common.toast-center />
    @endpersist

    <style>
        .flatpickr-calendar { z-index: 1000000 !important; }
        [x-cloak] { display: none !important; }
    </style>

    @livewireScripts
    @stack('scripts')

    <script>
        // Sisa script aslinya tetap sama...
        document.addEventListener('DOMContentLoaded', () => {
            const sources = @json($printerSourcesForJs ?? []);
            window.PRINTER_SOURCES = Array.isArray(sources) ? sources : [];
            if (window.PrinterManager?.configureSources) {
                window.PrinterManager.configureSources(window.PRINTER_SOURCES);
            }
        });
        // ... (lanjutan script asli Anda)
    </script>
</body>
</html>