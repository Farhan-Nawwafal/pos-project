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
                    // Always close mobile overlay on page change
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

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
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

        <div class="flex-1 transition-all duration-300 ease-in-out relative z-10 ml-0"
            :class="{
                'lg:ml-[90px]': true,
                'lg:ml-[290px] :ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'sm:translate-x-[0px]': $store.sidebar.isExpanded,
                'translate-x-0': !$store.sidebar.isExpanded
            }">



            @include('layouts.app-header')

            <div class="md:p-6">
                {{ $slot }}
            </div>
        </div>
    </div>

    <div x-data="posPrintModal" x-init="init()" x-show="open" class="fixed inset-0 z-[100000]"
        style="display: none;" aria-modal="true" role="dialog">
        <template x-if="open">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-black/50" @click="close()"></div>
                <div class="absolute inset-0 flex items-center justify-center p-4">
                    <div
                        class="relative flex max-h-[85vh] w-full max-w-2xl flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                        <div
                            class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                            <div>
                                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Cetak Struk</h3>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400"
                                    x-text="payload?.order?.code ? 'Kode: ' + payload.order.code : ''"></p>
                            </div>
                            <button type="button" @click="close()"
                                class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">Tutup</button>
                        </div>

                        <div class="min-h-0 flex-1 space-y-4 overflow-y-auto p-5">
                            <div
                                class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950">
                                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Pelanggan</p>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white/90"
                                            x-text="payload?.customer_name || '-'"></p>
                                    </div>
                                    <div class="sm:text-right">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white/90"
                                            x-text="payload?.order?.total ? ('Rp ' + Number(payload.order.total).toLocaleString('id-ID')) : '-'">
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-3 flex flex-wrap items-center gap-2">
                                    <span
                                        class="rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700 dark:bg-brand-500/15 dark:text-brand-300"
                                        x-text="context === 'pending' ? 'Pending tersimpan' : (context === 'midtrans' ? 'Online dibayar' : 'Checkout berhasil')"></span>
                                    <span
                                        class="rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-300"
                                        x-text="payload?.order?.order_type === 'dine_in' ? ('Dine-in' + (payload?.table_number ? (' • Meja ' + payload.table_number) : '')) : 'Take Away'"></span>
                                </div>
                            </div>

                            <div
                                class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Pilih Printer</p>
                                    <a href="{{ route('settings.index', ['section' => 'printers'], false) }}"
                                        wire:navigate @click="close()"
                                        class="text-xs font-semibold text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300">Pengaturan</a>
                                </div>

                                <div class="mt-3 flex items-center justify-between gap-3">
                                    <label
                                        class="inline-flex items-center gap-2 text-xs font-semibold text-gray-600 dark:text-gray-400">
                                        <input type="checkbox"
                                            class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900"
                                            x-model="showAllPrinters" />
                                        Tampilkan semua printer
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400"
                                        x-text="selectedSourceIds().length + ' dipilih'"></p>
                                </div>

                                <div class="mt-3 space-y-2">
                                    <template x-for="source in visibleSources()" :key="source.id">
                                        <div
                                            class="flex items-start justify-between gap-3 rounded-xl border border-gray-200 bg-gray-50 p-3 dark:border-gray-800 dark:bg-gray-950">
                                            <div class="flex min-w-0 items-start gap-3">
                                                <input type="checkbox"
                                                    class="mt-1 h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900"
                                                    :checked="!!selected[roleFromSourceId(source?.id)]"
                                                    @change="toggle(roleFromSourceId(source?.id))" />
                                                <div class="min-w-0">
                                                    <p class="truncate text-sm font-semibold text-gray-800 dark:text-white/90"
                                                        x-text="source.name"></p>
                                                    <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                                        <span x-text="String(source?.type || '').toUpperCase()"></span>
                                                        <span> • </span>
                                                        <span x-text="itemsForSource(source).length + ' item'"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="whitespace-nowrap rounded-full px-3 py-1 text-xs font-semibold"
                                                    :class="statusClass(printerStatus(source)?.key)"
                                                    x-text="printerStatus(source)?.label"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 p-5 dark:border-gray-800">
                            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                                <button type="button" :disabled="!canPrintSelected()" @click="printSelected()"
                                    class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition disabled:opacity-50">
                                    Cetak Sesuai Pilihan
                                </button>
                                <button type="button" :disabled="!canPrintKasirOnly()" @click="printKasirOnly()"
                                    class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03] disabled:opacity-50">
                                    Cetak Kasir Saja
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    @persist('toast-center')
        <x-common.toast-center />
    @endpersist

    <style>
        .flatpickr-calendar {
            z-index: 1000000 !important;
        }
    </style>

    @livewireScripts
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sources = @json($printerSourcesForJs ?? []);
            window.PRINTER_SOURCES = Array.isArray(sources) ? sources : [];
            if (window.PrinterManager?.configureSources) {
                window.PrinterManager.configureSources(window.PRINTER_SOURCES);
            }
        });

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('{{ route('admin.service-worker') }}');
            });
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('doPrintEndShift', (event) => {
                const data = Array.isArray(event) ? event[0] : event;
                const printData = window.ReceiptTemplates.endShiftReport(data);

                const sources = window.PrinterManager.sources || [];
                let targetRole = null;

                // 1. PRIORITAS UTAMA: Cari printer 'kasir' yang SEDANG TERHUBUNG (Ready)
                const readyKasir = sources.find(s => s.type && s.type.toLowerCase() === 'kasir' && window
                    .PrinterManager.isPrinterReady(s.role));

                if (readyKasir) {
                    targetRole = readyKasir.role;
                } else {
                    // 2. BACKUP 1: Kalau kasir gak ada yang terhubung, pakai SEMBARANG printer yang SEDANG TERHUBUNG
                    const anyReady = sources.find(s => window.PrinterManager.isPrinterReady(s.role));
                    if (anyReady) {
                        targetRole = anyReady.role;
                    } else {
                        // 3. BACKUP 2: Kalau nggak ada yang connect sama sekali, pakai config kasir (meskipun akan error offline nanti)
                        const fallbackKasir = sources.find(s => s.type && s.type.toLowerCase() === 'kasir');
                        targetRole = fallbackKasir ? fallbackKasir.role : (sources[0] ? sources[0].role :
                            null);
                    }
                }

                if (targetRole) {
                    try {
                        window.PrintQueue.add({
                            printerRole: targetRole,
                            data: printData
                        });
                    } catch (error) {
                        console.error("Gagal menambah antrean cetak:", error);
                    }
                } else {
                    alert("Tidak ada printer yang bisa digunakan!");
                }

                // Turunkan delay jadi 2.5 detik aja biar nunggunya nggak kelamaan, lalu paksa logout
                setTimeout(() => {
                    document.getElementById('logout-form').submit();
                }, 2500);
            });
        });
    </script>
</body>

</html>
