<div>
    <aside id="sidebar"
        class="fixed flex flex-col mt-0 top-0 px-0 left-0 bg-[#212C32] text-[#212C32] h-screen z-[9999] shadow-2xl shadow-black/10 dark:shadow-black/20 overflow-hidden"
        x-data="{
            openSubmenus: {},
            init() {
                this.initializeActiveMenus();
                document.addEventListener('livewire:navigated', () => {
                    this.initializeActiveMenus();
                });
                window.addEventListener('popstate', () => {
                    this.initializeActiveMenus();
                });
            },
            initializeActiveMenus() {
                this.openSubmenus = {};

                @foreach($menuGroups as $groupIndex => $menuGroup)
                    @foreach($menuGroup['items'] as $itemIndex => $item)
                        @if(isset($item['subItems']))
                            @foreach($item['subItems'] as $subItem)
                                if (this.isActive('{{ $subItem['path'] }}', {{ json_encode($subItem['exact'] ?? false) }}, {{ json_encode($subItem['exclude'] ?? []) }})) {
                                    this.openSubmenus['{{ $groupIndex }}-{{ $itemIndex }}'] = true;
                                }
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            },
            toggleSubmenu(groupIndex, itemIndex) {
                const key = groupIndex + '-' + itemIndex;
                const newState = !this.openSubmenus[key];

                // Close all other submenus when opening a new one
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
                    return window.location.pathname === '/';
                }
                if (Array.isArray(exclude) && exclude.length > 0) {
                    for (const ex of exclude) {
                        if (typeof ex === 'string' && ex !== '' && window.location.pathname.startsWith(ex)) {
                            return false;
                        }
                    }
                }
                if (exact) {
                    return window.location.pathname === path;
                }
                return window.location.pathname.startsWith(path);
            }
        }" :class="{
            'lg:w-[50px] lg:translate-x-0': !$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar
                .isMobileOpen,
            'w-[290px] translate-x-0 lg:w-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered || $store
                .sidebar.isMobileOpen,
            'w-0 -translate-x-full': !$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar
                .isMobileOpen
        }" {{--
        @mouseenter="window.innerWidth >= 1024 && !$store.sidebar.isExpanded ? $store.sidebar.setHovered(true) : null"
        @mouseleave="$store.sidebar.setHovered(false)"
        @click.outside="$store.sidebar.isMobileOpen ? $store.sidebar.toggleMobileOpen() : null"> --}}
        <!-- Logo Section -->
        <div class="pt-1 pb-1 bg-white/10 flex items-center gap-3" :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
            'justify-center' :
            'justify-start'">

            <a href="{{ route('dashboard', [], false) }}">

                <!-- Logo FULL -->
                <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                    x-transition class="dark:hidden" src="{{ asset('assets/images/esb-removebg.png') }}" alt="Logo"
                    width="140" />

                <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                    x-transition class="hidden dark:block" src="{{ asset('assets/images/esb-removebg.png') }}"
                    alt="Logo" width="140" />

                <!-- Logo ICON (WAJIB beda file) -->
                
                <img x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen"
                    x-transition src="{{ asset('assets/images/logoesb.png') }}" alt="Logo Icon" width="40" />
            </a>

            <div x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="ml-auto">
            </div>
        </div>

        @if ($canAccessPos)
            <div class="pb-0 mt-3" x-data="{ showTooltip: false }"
                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen || window.innerWidth >= 1024">

                <a href="{{ route('pos.index') }}" wire:navigate @mouseenter="showTooltip = true"
                    @mouseleave="showTooltip = false"
                    class="relative flex items-center w-full px-3 py-3 transition-all duration-300 ease-in-out rounded-xl group focus:outline-none focus:ring-2 focus:ring-offset-2"
                    :class="[
                    
                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'justify-center' : 'justify-start'
                ]">

                    <span class="flex items-center justify-center"
                        :class="isActive('{{ route('pos.index', [], false) }}') ? 'text-white' : 'text-gray-500 '">
                        <svg width="16" height="16" viewBox="0 0 1488 1206" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Border luar -->
                        <rect
                            x="110"
                            y="110"
                            width="1267"
                            height="986"
                            stroke="white"
                            stroke-width="70"
                        />

                        <!-- Kotak kiri -->
                        <rect
                            x="336.5"
                            y="320.5"
                            width="566"
                            height="348"
                            stroke="white"
                            stroke-width="70"
                        />

                        <!-- Sudut kiri atas -->
                        <rect
                            width="193"
                            height="192"
                            fill="white"
                        />

                        <!-- Sudut kanan atas -->
                        <rect
                            x="1295"
                            width="193"
                            height="192"
                            fill="white"
                        />

                        <!-- Sudut kiri bawah -->
                        <rect
                            y="1014"
                            width="193"
                            height="192"
                            fill="white"
                        />

                        <!-- Sudut kanan bawah -->
                        <rect
                            x="1295"
                            y="1014"
                            width="193"
                            height="192"
                            fill="white"
                        />

                        <!-- Bentuk kanan -->
                        <path
                            d="M1171.5 534H904V668H580V907.5H1171.5V534Z"
                            stroke="white"
                            stroke-width="43"
                        />
                    </svg>
                    </span>

                    <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="ml-3 text-sm font-bold tracking-wide whitespace-nowrap"
                        :class="isActive('{{ route('pos.index', [], false) }}') ? 'text-white' : 'text-gray-500 group-hover:text-white'">
                        Masuk Kasir
                    </span>

                    <div x-show="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) && showTooltip"
                        x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="absolute left-[4.5rem] z-[50] px-3 py-2 text-xs font-semibold text-white bg-gray-800 rounded-lg shadow-xl whitespace-nowrap">
                        Masuk Kasir
                        <div class="absolute w-2 h-2 bg-gray-500 rotate-45 -left-1 top-2.5"></div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Navigation Menu -->
        <div class="flex flex-1 min-h-0 flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
            <nav class="pb-6">
                <div class="flex flex-col gap-4">
                    @foreach ($menuGroups as $groupIndex => $menuGroup)
                        <div>
                            @if (trim((string) ($menuGroup['title'] ?? '')) !== '')
                                <h2 class="mb-4 text-xs uppercase flex leading-[20px] text-gray-500" :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar
                                                .isMobileOpen) ?
                                            'lg:justify-center' : 'justify-start'">
                                    <template
                                        x-if="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                                        <span>{{ $menuGroup['title'] }}</span>
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
                            @endif

                            <!-- Menu Items -->
                            <ul class="flex flex-col gap-1">
                                @foreach ($menuGroup['items'] as $itemIndex => $item)
                                    <li>
                                        @if (isset($item['subItems']))
                                            <!-- Menu Item with Submenu -->
                                            <button @click="toggleSubmenu({{ $groupIndex }}, {{ $itemIndex }})"
                                                class="menu-item group w-full" :class="[
                                                                isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }}) ?
                                                                'menu-item-active' : 'menu-item-inactive',
                                                                !$store.sidebar.isExpanded && !$store.sidebar.isHovered ?
                                                                'xl:justify-center' : 'xl:justify-start'
                                                            ]">

                                                <!-- Icon -->
                                                <span :class="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }}) ?
                                                                    'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                                    {!! \App\Helpers\MenuHelper::getIconSvg($item['icon']) !!}
                                                </span>

                                                <!-- Text -->
                                                <span
                                                    x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="menu-item-text flex items-center gap-2">
                                                    {{ $item['name'] }}
                                                    @if (!empty($item['new']))
                                                        <span class="absolute right-10" :class="isActive('{{ $item['path'] ?? '' }}',
                                                                                    {{ json_encode($item['exact'] ?? false) }}) ?
                                                                                'menu-dropdown-badge menu-dropdown-badge-active' :
                                                                                'menu-dropdown-badge menu-dropdown-badge-inactive'">
                                                            new
                                                        </span>
                                                    @endif
                                                </span>

                                                <!-- Chevron Down Icon -->
                                                <svg x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="ml-auto w-1 h-1 transition-transform duration-200" :class="{
                                                                    'rotate-180 text-gray-500': isSubmenuOpen({{ $groupIndex }},
                                                                        {{ $itemIndex }})
                                                                }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>

                                            <!-- Submenu -->
                                            <div
                                                x-show="isSubmenuOpen({{ $groupIndex }}, {{ $itemIndex }}) && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                                <ul class="mt-2 space-y-1 ml-9">
                                                    @foreach ($item['subItems'] as $subItem)
                                                        <li>
                                                            <a href="{{ $subItem['path'] }}" wire:navigate class="menu-dropdown-item"
                                                                :class="isActive('{{ $subItem['path'] }}',
                                                                                        {{ json_encode($subItem['exact'] ?? false) }},
                                                                                        {{ json_encode($subItem['exclude'] ?? []) }}) ?
                                                                                    'menu-dropdown-item-active' :
                                                                                    'menu-dropdown-item-inactive'">
                                                                {{ $subItem['name'] }}
                                                                <span class="flex items-center gap-1 ml-auto">
                                                                    @if (!empty($subItem['new']))
                                                                        <span
                                                                            :class="isActive('{{ $subItem['path'] }}',
                                                                                                        {{ json_encode($subItem['exact'] ?? false) }},
                                                                                                        {{ json_encode($subItem['exclude'] ?? []) }}
                                                                                                    ) ?
                                                                                                    'menu-dropdown-badge menu-dropdown-badge-active' :
                                                                                                    'menu-dropdown-badge menu-dropdown-badge-inactive'">
                                                                            new
                                                                        </span>
                                                                    @endif
                                                                    @if (!empty($subItem['pro']))
                                                                        <span
                                                                            :class="isActive('{{ $subItem['path'] }}',
                                                                                                        {{ json_encode($subItem['exact'] ?? false) }},
                                                                                                        {{ json_encode($subItem['exclude'] ?? []) }}
                                                                                                    ) ?
                                                                                                    'menu-dropdown-badge-pro menu-dropdown-badge-pro-active' :
                                                                                                    'menu-dropdown-badge-pro menu-dropdown-badge-pro-inactive'">
                                                                            pro
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <!-- Simple Menu Item -->
                                            <a href="{{ $item['path'] }}" wire:navigate class="menu-item group" :class="[
                                                                isActive('{{ $item['path'] }}',
                                                                    {{ json_encode($item['exact'] ?? false) }}) ?
                                                                'menu-item-active' :
                                                                'menu-item-inactive',
                                                                (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store
                                                                    .sidebar.isMobileOpen) ?
                                                                'xl:justify-center' :
                                                                'justify-start'
                                                            ]">

                                                <!-- Icon -->
                                                <span :class="isActive('{{ $item['path'] }}',
                                                                        {{ json_encode($item['exact'] ?? false) }}) ?
                                                                    'menu-item-icon-active' :
                                                                    'menu-item-icon-inactive'">
                                                    {!! \App\Helpers\MenuHelper::getIconSvg($item['icon']) !!}
                                                </span>

                                                <!-- Text -->
                                                <span
                                                    x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                                    class="menu-item-text flex items-center gap-2">
                                                    {{ $item['name'] }}
                                                    @if (!empty($item['new']))
                                                        <span
                                                            class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-brand-500 text-white">
                                                            new
                                                        </span>
                                                    @endif
                                                </span>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
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
                            {{ auth()->user()?->name ?? 'Pengguna' }}
                        </p>
                        <p class="text-xs text-gray-500 truncate dark:text-gray-400">{{ auth()->user()?->email ?? '' }}
                        </p>
                    </div>
                    {{-- <div
                        x-show="!($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)"
                        class="ml-auto">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 01 8 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div> --}}
                </div>

                <!-- END SHIFT BUTTON -->
                <div class="mt-3 px-3">
                    {{-- Ubah <a> menjadi <button> dan tambahkan wire:click --}}
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

                {{-- Pastikan Form Logout ini ada di dalam file yang sama (di bawah) --}}
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>

                <!-- Logout Only -->
                <script>
                    function endShift() {
                        if (confirm(
                            'Tutup shift dan cetak laporan tutup kasir? (nama kasir: {{ auth()->user()?->name }}, hari ini)')) {
                            // Demo end-shift data (real data in production)
                            const endShiftData = {
                                store: {
                                    name: 'ALAS BU YANTI',
                                    address: 'Jl. Raya Ciawi Prapatan No.6',
                                    logo_url: '/assets/images/logoesb.png'
                                },
                                cashier: '{{ auth()->user()?->name ?? 'Kasir' }}',
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
                            logoutForm.action = '{{ route('logout') }}';
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
        @php
            $canGuides = auth()->user()?->can('guides.view') ?? false;
        @endphp
        @if ($canGuides)
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

                <a href="{{ route('guides.index') }}" wire:navigate
                    class="bg-brand-500 text-theme-sm hover:bg-brand-600 mt-4 flex items-center justify-center rounded-lg p-3 font-medium text-white">
                    Buka Buku Panduan
                </a>
            </div>
        @endif
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