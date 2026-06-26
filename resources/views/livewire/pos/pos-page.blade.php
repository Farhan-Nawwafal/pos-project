<div class="flex flex-col h-full">
    {{-- Mode Dine In dan Belum Pilih Meja --}}
    @if ($orderType === 'dine_in' && !$selectedTableId)
        <div
            class="flex flex-col flex-1 min-h-0 bg-white dark:bg-gray-900 p-2 border border-gray-200 dark:border-gray-800 shadow-sm">

            {{-- HEADER SELECTION --}}
            <div class="flex flex-wrap items-center gap-2 mb-2 flex-shrink-0">
                <button type="button" wire:click="chooseOrderType('take_away')"
                    class="px-15 py-4 text-xs font-bold bg-brand-500 border border-gray-300 rounded-xs text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                    Quick Service
                </button>

                <button type="button" wire:click="$set('tableRange', '1-50')" @class([
                    'px-15 py-4 text-xs font-bold rounded-xs transition-all',
                    'bg-brand-500 text-white border border-brand-600', // Selalu biru
                ])>1 -
                    50</button>

                <button type="button" wire:click="$set('tableRange', '51-100')" @class([
                    'px-15 py-4 text-xs font-bold rounded-xs transition-all',
                    'bg-brand-500 text-white border border-brand-600', // Selalu biru
                ])>51 -
                    100</button>
            </div>

            {{-- KONTEN UTAMA (LIST TABLE) --}}
            <div class="flex-1 min-h-0 overflow-y-auto  border border-gray-200 pb-8 pr-14 pl-3 ">
                <div class="grid grid-cols-10 gap-3 md:gap-3 lg:gap-9 xl:gap-20">
                    @foreach ($this->tables as $t)
                        @php
                            $tableNumber = (int) filter_var($t['label'], FILTER_SANITIZE_NUMBER_INT);

                            // Default ke 1-50 jika belum di-set
                            [$min, $max] = explode('-', $tableRange ?? '1-50');

                            $shouldShow = $tableNumber >= (int) $min && $tableNumber <= (int) $max;

                            // Set status (asumsi status dikirim dari backend: available, booked, occupied, billed)
                            $status = strtolower($t['status'] ?? 'available');
                        @endphp

                        @if ($shouldShow)
                            <button type="button" wire:click="openSelectTableModal({{ (int) $t['id'] }})"
                                wire:key="table-item-{{ $t['id'] }}-{{ $status }}" @if (in_array($status, ['occupied', 'booked', 'billed']) && isset($t['occupied_at'])) x-data="{
                                    start: new Date('{{ $t['occupied_at'] }}').getTime(),
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
                                }" @endif @class([
                                            'flex flex-col items-center justify-center border transition-all shadow-sm group rounded-xs aspect-[4/3]',
                                            'bg-[#1086e1] border-[#0f75c7] hover:bg-[#0f75c7] text-white' =>
                                                $status === 'available',
                                            'bg-yellow-400 border-yellow-500 hover:bg-yellow-500 text-white' =>
                                                $status === 'booked',
                                            'bg-red-600 border-red-700 hover:bg-red-700 text-white' =>
                                                $status === 'occupied',
                                            'bg-green-500 border-green-600 hover:bg-green-600 text-white' =>
                                                $status === 'billed',
                                        ])>
                                <span class="text-sm font-bold group-hover:scale-110 transition-transform">{{ $t['label'] }}</span>
                                <span class="text-[10px] font-mono">
                                    @if (in_array($status, ['occupied', 'booked', 'billed']))
                                        <span x-text="display">00:00</span>
                                    @endif
                                </span>
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- 3. FOOTER LEGEND --}}
            <div class="flex-shrink-0 pt-8  ">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 text-xs font-bold bg-yellow-400 text-white "> > 0 minute</span>
                    <span class="px-2.5 py-1 text-xs font-bold bg-red-600 text-white "> > 0 minute</span>
                    <div class="flex flex-wrap items-center gap-x-45 gap-y-3">
                        {{-- Waktu --}}

                        {{-- Keterangan Status --}}
                        <div class="flex items-center gap-4 pl-20">
                            <div class="w-4 h-4 bg-[#1086e1]  border-[#0f75c7]"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Available</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="w-4 h-4 bg-yellow-400  border-yellow-500"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Booked</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="w-4 h-4 bg-red-600  border-red-700"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Occupied</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="w-4 h-4 bg-green-500  border-green-600"></div>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Billed</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        {{-- Mode Quick Service atau Dine In sudah pilih meja --}}
    @elseif ($orderType === 'take_away' || ($orderType === 'dine_in' && $selectedTableId))
        @if ($viewMode === 'menu')
            <div class="grid grid-cols-1 gap-6 p-2 md:grid-cols-12">

                {{-- SISI KIRI (KOLOM 7): AREA INPUT ATAS & GRID PRODUK --}}
                <div class="md:col-span-7 space-y-4">

                    {{-- BARIS 1: ORDER NOTES (Hanya di atas list produk) --}}
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">
                            Order Notes
                        </h3>
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1">
                                <input wire:model.live.debounce.300ms="search" type="text"
                                    placeholder="Information will be printed"
                                    class="w-full h-11 border border-gray-300 rounded-lg bg-white px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-900 dark:text-white dark:border-gray-700" />
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button"
                                    class="h-11 px-3 flex items-center justify-center bg-brand-500  text-white text-xs font-semibold rounded-sm border border-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white dark:border-gray-600 transition">Btn
                                    1</button>
                                <button type="button"
                                    class="h-11 px-3 flex items-center justify-center bg-brand-500 text-white text-xs font-semibold rounded-sm border border-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white dark:border-gray-600 transition">Btn
                                    2</button>
                                <button type="button"
                                    class="h-11 px-3 flex items-center justify-center bg-brand-500  text-white text-xs font-semibold rounded-sm transition shadow-sm">Btn
                                    3</button>
                            </div>
                        </div>
                    </div>

                    {{-- BARIS 2: SEARCH MENU & STEPPER (Hanya di atas list produk) --}}
                    <div>

                        <div class="flex items-center gap-2">
                            {{-- Kotak Input Search Menu --}}
                            <div class="relative flex-1">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 px-4 pointer-events-none bg-gray-200">
                                    <img src="/assets/icons/search.png" alt="Search" class="w-5 h-5 opacity-50 dark:invert">
                                </div>

                                <input wire:model.live.debounce.300ms="searchMenu" type="text" placeholder="Search menu / code"
                                    class="w-full h-11 border border-gray-300 rounded-lg bg-white pl-15 pr-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-900 dark:text-white dark:border-gray-700" />

                            </div>

                            {{-- Grup Kontrol Kanan (Refresh & Stepper Pagination Menu) --}}
                            <div class="flex items-center gap-2 shrink-0">
                                {{-- Tombol Refresh --}}
                                <button type="button"
                                    class="w-11 h-11 flex items-center justify-center bg-white border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 transition shadow-sm"
                                    title="Refresh">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </button>

                                {{-- Stepper Pagination Halaman Menu --}}
                                <div
                                    class="flex items-center justify-between h-11 bg-white border border-gray-300 rounded-lg px-2 dark:bg-gray-900 dark:border-gray-700 shadow-sm gap-3">
                                    {{-- Panah Kiri (Previous Page) --}}
                                    {{-- Kamu bisa pakai wire:click="previousPage" atau sejenisnya --}}
                                    <button type="button" wire:click="previousPage"
                                        class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:text-gray-400 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </button>

                                    {{-- Indikator Teks Halaman (Misal: 1 of 3) --}}
                                    <span class="text-sm font-bold text-gray-800 dark:text-white whitespace-nowrap">
                                        {{ $productPage }} of {{ ceil(count($this->productCards) / 16) }}
                                    </span>

                                    {{-- Panah Kanan (Next Page) --}}
                                    {{-- Kamu bisa pakai wire:click="nextPage" atau sejenisnya --}}
                                    <button type="button" wire:click="nextPage"
                                        class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:text-gray-400 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-800 my-2" />

                    {{-- Tombol kembali ke pilih meja (khusus dine in) --}}
                    @if ($orderType === 'dine_in' && $selectedTableId)
                        <div class="mb-4 flex items-center gap-3">
                            <button type="button" wire:click="$set('selectedTableId', null)"
                                class="px-3 py-1.5 text-xs font-bold bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                ← Ganti Meja
                            </button>
                            <span class="text-sm font-bold text-brand-700">
                                📍 Meja:
                                {{ collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? '-' }}
                            </span>
                        </div>
                    @else
                        
                        <div class="text-brand-500 font-semibold text-sm">
                            <h3>Menu</h3>
                        </div>
                    @endif
                        

                    {{-- Grid Produk --}}
                    @php
                        $perPage = 16;
                        $displayProducts = array_slice($this->productCards, ($productPage - 1) * $perPage, $perPage);
                    @endphp
                    <div wire:init="loadVariantStockStatuses"
                        class="grid grid-cols-4 gap-1 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4">
                        @forelse ($displayProducts as $product)
                            @php
                                $firstVariant = $product['variants'][0] ?? null;
                                $finalPrice = (int) round(
                                    (float) ($firstVariant['price_afterdiscount'] ?? ($firstVariant['price'] ?? 0)),
                                );
                            @endphp
                            <button type="button" wire:click="addToCart({{ (int) $product['id'] }})"
                                class="group flex min-h-[120px] w-full flex-col items-center justify-center overflow-hidden rounded-xs border border-transparent shadow-sm hover:shadow-md hover:brightness-105 transition active:scale-95"
                                style="background-color: #F07600;">
                                <div class="text-center flex flex-col items-center justify-center gap-1 p-3 w-full h-full">
                                    <p class="text-xs font-bold text-white line-clamp-2 uppercase leading-snug">
                                        {{ $product['name'] }}
                                    </p>
                                    <p class="text-sm font-bold text-white/90 mt-1">Rp
                                        {{ number_format($finalPrice, 0, ',', '.') }}
                                    </p>
                                </div>
                            </button>
                        @empty
                            <div class="col-span-full py-20 text-center">
                                <p class="text-sm text-gray-500">Tidak ada produk.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- SISI KANAN (KOLOM 5): TEMPAT TOMBOL BARU & AREA KERANJANG --}}
                <div class="md:col-span-5 ">

                    {{-- AREA SINKRONISASI TINGGI (TEMPAT TOMBOL BARU KAMU) --}}
                    <div class="min-h-[65px] flex items-center gap-1 pb-1">
                        {{-- Tombol Kiri (30%) --}}
                        <div class="w-[10%]">
                            <button type="button"
                                class="w-full h-11 bg-brand-500 text-white text-xs font-bold rounded-sm hover:bg-blue-700 transition shadow-sm">
                                Tombol 1
                            </button>
                        </div>

                        {{-- Tombol Kanan (70%) --}}
                        <div class="w-[90%]">
                            <button type="button"
                                class="w-full h-11 bg-brand-500 text-white text-xs rounded-sm hover:bg-blue-700 transition shadow-sm">
                                TAKE AWAY
                            </button>
                        </div>
                    </div>


                    {{-- Area Box Keranjang --}}
                    <div
                        class="md:sticky md:top-20 overflow-hidden border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                        {{-- Header Keranjang --}}
                        <div
                            class="flex items-center justify-between border-b border-gray-200 px-3 py-2 bg-gray-200 dark:border-gray-800">
                            <div class="flex items-center gap-3">
                                <span
                                    class="text-sm font-black text-gray-800 dark:text-white/90 w-8 text-center tracking-wider">
                                    Qty
                                </span>
                                <span class="text-gray-400 dark:text-gray-600 font-light">|</span>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white/90 tracking-wider">
                                    Menu
                                </h3>
                            </div>

                            {{-- Tombol Pending Transaksi di Ujung Kanan --}}
                            {{-- <button wire:click="$set('pendingOrdersModalOpen', true)"
                                class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                @if ($this->pendingTransactions->count() > 0)
                                <span
                                    class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full">
                                    {{ $this->pendingTransactions->count() }}
                                </span>
                                @endif
                            </button> --}}
                        </div>

                        <div class="p-4">
                            {{-- DAFTAR ITEM --}}
                            <div class="custom-scrollbar max-h-[440px] min-h-[450px] overflow-y-auto mb-4 pr-1">
                                <div class="space-y-3">
                                    @forelse ($cartItems as $idx => $item)
                                        @php
                                            $price = (int) ($item['price'] ?? 0);
                                            $qty = (int) ($item['quantity'] ?? 0);
                                        @endphp
                                        <div
                                            class="pb-3 border-b border-gray-100 dark:border-gray-800 last:border-0 flex flex-col gap-2">

                                            {{-- LAYOUT BARU: BARIS ATAS (QTY & DETAIL PRODUK) --}}
                                            <div class="flex items-start gap-3">
                                                {{-- Kolom Qty (Kiri) --}}
                                                <div class="w-8 shrink-0 text-center">
                                                    <span class="text-sm font-black text-brand-500 tabular-nums px-2 py-0.5 ">
                                                        {{ $qty }}
                                                    </span>
                                                </div>

                                                {{-- Kolom Detail Pesanan & Harga (Kanan) --}}
                                                <div class="min-w-0 flex-1 flex justify-between items-start gap-2">
                                                    {{-- Sisi Kiri: Nama Menu, Varian, & Rincian Harga --}}
                                                    <div class="min-w-0 flex-1">
                                                        <p
                                                            class="text-xs  text-brand-500 dark:text-white uppercase leading-tight truncate mb-1">
                                                            {{ $item['name'] }}
                                                        </p>
                                                        @if (!empty($item['variant_name']))
                                                            <p class="text-[5px] text-brand-500 italic mb-1">
                                                                {{ $item['variant_name'] }}
                                                            </p>
                                                        @endif

                                                        {{-- Rincian Harga sub-detail: @harga | total: hargaTotal --}}
                                                        <p
                                                            class="text-[11px]  text-brand-500 dark:text-gray-400 font-medium tracking-wide">
                                                            @<span>{{ number_format($price, 0, ',', '.') }}</span>
                                                            <span class="mx-1  text-gray-300 dark:text-gray-700">|</span>
                                                            <span class="font-bold text-gray-700 dark:text-gray-300">Total:
                                                                Rp
                                                                {{ number_format($qty * $price, 0, ',', '.') }}</span>
                                                        </p>
                                                    </div>

                                                    {{-- Sisi Kanan: Button Sampah (Sejajar Sempurna di Ujung Kanan Kolom Detail)
                                                    --}}
                                                    <div class="shrink-0">
                                                        <button type="button" wire:click="removeItem({{ $idx }})"
                                                            class="w-8 h-6 flex items-center justify-center text-white bg-red-700 transition"
                                                            title="Hapus Menu">
                                                            x
                                                        </button>
                                                    </div>
                                                    <div class="shrink-0">
                                                        <button type="button" wire:click="removeItem({{ $idx }})"
                                                            class="w-3 h-3 flex items-center justify-center text-gray-400 hover:text-red-500 active:text-red-700 transition"
                                                            title="Hapus Menu">
                                                            <img src="/assets/icons/info.png" alt="">
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="py-8 text-center text-xs text-gray-400">Belum ada menu dipilih
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            {{-- SUMMARY BAR --}}
                            @php $totalQty = collect($cartItems)->sum('quantity'); @endphp
                            <div class="dark:bg-gray-900">
                                <div class="py-3 grid grid-cols-3 divide-x divide-white/10 text-center items-center border-t">
                                    <div>
                                        <p class="text-[9px] uppercase font-bold text-black">Qty</p>
                                        <p class="text-base font-bold text-black leading-none">{{ $totalQty }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] uppercase font-bold text-black">Subtotal</p>
                                        <p class="text-sm font-bold text-black leading-none mt-1">
                                            {{ number_format($subtotal, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] uppercase font-bold text-black">Billing</p>
                                        <p class="text-base font-bold text-black leading-none">
                                            {{ number_format($total, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- INTERNAL ACTIONS BOX (DENGAN TIGA TOMBOL RATA SAAT EDITING MODE) --}}
                            <div class="space-y-2 mt-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                                @php
                                    $isEditing = $editingTransactionId !== null;
                                    $isDineIn = $orderType === 'dine_in';
                                @endphp

                                {{-- BARIS ATAS: Tiga Tombol Rata (Panah Atas, Panah Bawah, Save Order/Kirim Ke Dapur) --}}
                                <div class="grid grid-cols-3 gap-2 w-full">
                                    {{-- 1. Button Panah Atas --}}
                                    <button type="button"
                                        class="h-12 w-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 rounded-lg border border-gray-300 dark:border-gray-600 transition active:scale-95 shadow-sm">
                                        <img src="/assets/icons/arrow-up.png" width="30" height="30" alt="">
                                    </button>

                                    {{-- 2. Button Panah Bawah --}}
                                    <button type="button"
                                        class="h-12 w-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 rounded-lg border border-gray-300 dark:border-gray-600 transition active:scale-95 shadow-sm">
                                        <img src="/assets/icons/arrow-down.png" width="30" height="30" alt="">
                                    </button>

                                    {{-- 3. Button Utama: Save Order (Menyimpan pesanan gantung & kembali ke list denah meja)
                                    --}}
                                    <button type="button" wire:click="saveAsPending" @disabled(count($cartItems) === 0)
                                        class="w-full h-12 font-bold text-white rounded-lg bg-brand-500 hover:bg-brand-600 shadow-sm transition text-xs uppercase tracking-wider active:scale-95">
                                        Save Order
                                    </button>
                                </div>

                                {{-- BARIS BAWAH CADANGAN: HANYA MUNCUL JIKA STATUS TRANSAKSI SEDANG MENGEDIT (OCCUPIED) --}}
                                @if ($isEditing)
                                    <div class="grid grid-cols-3 gap-2 w-full mt-2">
                                        {{-- 1. Button Print Bill --}}
                                        <button type="button" wire:click="printBill"
                                            class="w-full h-11 bg-white border border-gray-300 text-gray-700 font-bold rounded-lg text-xs hover:bg-gray-50 transition active:scale-95 shadow-sm uppercase tracking-wide">
                                            Print Bill
                                        </button>

                                        {{-- 2. Button Split Bill --}}
                                        {{-- Silakan hubungkan wire:click ke method split bill kamu jika sudah ada --}}
                                        <button type="button" wire:click="$set('splitBillModalOpen', true)"
                                            class="w-full h-11 bg-white border border-gray-300 text-gray-700 font-bold rounded-lg text-xs hover:bg-gray-50 transition active:scale-95 shadow-sm uppercase tracking-wide">
                                            Split Bill
                                        </button>


                                        {{-- 3. Button Payment --}}
                                        <button type="button" wire:click="openCheckout" @disabled(count($cartItems) === 0)
                                            class="w-full h-11 flex items-center justify-center bg-[#1086e1] hover:bg-[#0f75c7] text-white font-bold rounded-lg text-xs transition active:scale-95 shadow-sm uppercase tracking-wide">
                                            Payment
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- HALAMAN SELECT PAYMENT METHOD (MUNCUL SAAT KLIK PAYMENT) --}}
            <div class="grid grid-cols-1 gap-6 p-2 md:grid-cols-12 animate-in fade-in duration-150">

                {{-- SISI KIRI (KOLOM 7): AREA INPUT STRUKTUR BAYAR & GRID PAYMENT --}}
                <div class="md:col-span-7 space-y-4">

                    {{-- LAPIS ATAS: BARIS 1 (INFO TABLE, MEMBER & BUTTON PROFILE / CHECK ONLINE) --}}
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">
                            Table & Member Info
                        </h3>
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1 flex gap-2">
                                <div class="w-1/3">
                                    <span
                                        class="h-11 w-full flex items-center bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white px-3 text-sm font-bold rounded-lg border border-gray-300 dark:border-gray-700">
                                        📍
                                        {{ collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? 'Walk-In' }}
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <input type="text" readonly wire:model="customerName"
                                        class="w-full h-11 border border-gray-300 rounded-lg bg-gray-50 px-4 text-sm dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 cursor-not-allowed" />
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button"
                                    class="h-11 px-3 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-semibold rounded-lg border border-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white dark:border-gray-600 transition shadow-sm">
                                    Profile
                                </button>
                                <button type="button"
                                    class="h-11 px-3 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition shadow-sm">
                                    Check Online Payment
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- LAPIS TENGAH: BARIS 2 (JUDUL SELECT PAYMENT METHOD & STEPPER HALAMAN) --}}
                    <div class="flex items-center justify-between pt-1">
                        <h3 class="text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300">
                            Select Payment Method
                        </h3>

                        <div class="flex items-center gap-2">
                            <div
                                class="flex items-center justify-between h-9 bg-white border border-gray-300 rounded-lg px-2 dark:bg-gray-900 dark:border-gray-700 shadow-sm gap-3">
                                <button type="button"
                                    class="p-1 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                </button>
                                <span class="text-xs font-bold text-gray-800 dark:text-white whitespace-nowrap">
                                    {{ $paymentPage }} of 1
                                </span>
                                <button type="button"
                                    class="p-1 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-800 my-2" />

                    {{-- LAPIS BAWAH: GRID KARTU METODE PEMBAYARAN (UKURAN & STYLE MIRIP PRODUK) --}}
                    <div
                        class="grid grid-cols-4 gap-1 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                        @php
                            $methods = [
                                ['id' => 'promo', 'name' => 'ADD PROMO', 'color' => '#E5E7EB', 'text' => '#1F2937'],
                                ['id' => 'cash', 'name' => 'CASH', 'color' => '#F07600', 'text' => '#FFFFFF'],
                                ['id' => 'card', 'name' => 'CARD', 'color' => '#1086e1', 'text' => '#FFFFFF'],
                                [
                                    'id' => 'compliment',
                                    'name' => 'COMPLIMENT',
                                    'color' => '#10B981',
                                    'text' => '#FFFFFF',
                                ],
                                ['id' => 'other', 'name' => 'OTHER COST', 'color' => '#6B7280', 'text' => '#FFFFFF'],
                            ];
                        @endphp

                        @foreach ($methods as $method)
                            {{-- Menggunakan inline array assignment bawaan Livewire agar sekali klik langsung mengubah 3 state
                            sekaligus --}}
                            <button type="button"
                                wire:click="$set('paymentMethod', '{{ $method['id'] }}'); $set('selectedPaymentLabel', '{{ $method['name'] }} Payment'); $set('paymentModalOpen', true);"
                                class="group flex min-h-[120px] w-full flex-col items-center justify-center overflow-hidden rounded-xs border border-transparent shadow-sm hover:shadow-md hover:brightness-105 transition active:scale-95"
                                style="background-color: {{ $method['color'] }};">
                                <div class="text-center p-3 w-full h-full flex items-center justify-center">
                                    <p class="text-xs font-black uppercase leading-snug tracking-wider"
                                        style="color: {{ $method['text'] }}">
                                        {{ $method['name'] }}
                                    </p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    <div
                        class="grid grid-cols-2 gap-4 mt-4 bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl border border-gray-200 dark:border-gray-800">

                        {{-- AREA KIRI --}}
                        <div class="space-y-3">
                            {{-- 1. Voucher Purchase --}}
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-1">
                                    Voucher Purchase
                                </label>
                                {{-- Input dipecah menjadi 2 kolom horizontal berjejer --}}
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" wire:model.live="voucherPaidCount" placeholder="Qty / Kode"
                                        class="w-full h-10 border border-gray-300 rounded-lg bg-white px-3 text-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-900 dark:text-white dark:border-gray-700" />
                                    <input type="number" wire:model.live="voucherPaidAmount" placeholder="Nominal Rp"
                                        class="w-full h-10 border border-gray-300 rounded-lg bg-white px-3 text-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-900 dark:text-white dark:border-gray-700" />
                                </div>
                            </div>

                            {{-- 3. Total Payment --}}
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-1">
                                    Total Payment
                                </label>
                                <input type="text" disabled
                                    value="{{ $cashReceived ? 'Rp ' . number_format((int) preg_replace('/\D+/', '', $cashReceived), 0, ',', '.') : '' }}"
                                    placeholder="Belum ada pembayaran"
                                    class="w-full h-10 border border-gray-300 font-bold text-gray-700 rounded-lg bg-gray-100 px-3 text-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 cursor-not-allowed" />
                            </div>
                        </div>

                        {{-- AREA KANAN --}}
                        <div class="space-y-3">
                            {{-- 2. Outstanding --}}
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-1">
                                    Outstanding
                                </label>
                                <input type="text" readonly placeholder="Rp 0"
                                    value="{{ number_format(max(0, $total - (int) preg_replace('/\D+/', '', $cashReceived ?? '0')), 0, ',', '.') }}"
                                    class="w-full h-10 border border-gray-300 rounded-lg bg-gray-100 px-3 text-xs font-semibold text-red-600 dark:bg-gray-800 dark:border-gray-700 cursor-not-allowed" />
                            </div>

                            {{-- 4. Change --}}
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-1">
                                    Change
                                </label>
                                <input type="text" readonly placeholder="Rp 0"
                                    value="{{ number_format((int) $cashChange, 0, ',', '.') }}"
                                    class="w-full h-10 border border-gray-300 rounded-lg bg-gray-100 px-3 text-xs font-bold text-green-600 dark:bg-gray-800 dark:border-gray-700 cursor-not-allowed" />
                            </div>
                        </div>

                    </div>
                </div>

                {{-- SISI KANAN (KOLOM 5): AREA PREVIEW STRUK & KENDALI UTAMA --}}
                <div class="md:col-span-5 space-y-4">

                    {{-- AREA SINKRONISASI TINGGI --}}
                    <div class="min-h-[148px] flex flex-col justify-end pb-1">
                        <button type="button" wire:click="$set('viewMode', 'menu')"
                            class="w-full h-11 bg-gray-500 hover:bg-gray-600 text-white text-xs font-bold rounded-lg transition shadow-sm uppercase tracking-wider">
                            ← Kembali ke Edit Menu Pesanan
                        </button>
                    </div>

                    {{-- Box Card Utama Preview Struk --}}
                    <div
                        class="md:sticky md:top-20 overflow-hidden border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03] rounded-xl flex flex-col">


                        {{-- Area Tampilan Simulasi Nota Belanja --}}
                        <div
                            class="p-4 flex-1 min-h-[440px] max-h-[440px] overflow-y-auto bg-gray-50 dark:bg-gray-950/40 rounded-b-xl border-b border-gray-200 dark:border-gray-800 font-mono text-[11px] leading-relaxed text-gray-800 dark:text-gray-300 select-none custom-scrollbar">

                            {{-- 1. HEADER STRUK --}}
                            <div class="text-center space-y-0.5">
                                <p class="font-bold text-xs uppercase text-gray-900 dark:text-white">
                                    {{ cache('setting')?->company_name ?? 'NAMA TOKO' }}
                                </p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                    {{ auth()->user()->cabang?->name ?? '-' }}
                                </p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 pb-1">Selamat Datang :)</p>
                            </div>

                            <div class="border-b border-dashed border-gray-300 dark:border-gray-700 my-2"></div>

                            {{-- 2. INFO TRANSAKSI --}}
                            <div class="space-y-0.5 text-[10px] text-gray-600 dark:text-gray-400">
                                <div class="flex"><span class="w-16 shrink-0">No</span><span>:
                                        {{ $editingTransactionId ?? 'PENDING' }}</span></div>
                                <div class="flex"><span class="w-16 shrink-0">Date</span><span>:
                                        {{ now()->format('d-m-Y') }}</span></div>
                                @if ($selectedTableId)
                                    <div class="flex"><span class="w-16 shrink-0">Table</span><span>:
                                            {{ collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? '-' }}</span>
                                    </div>
                                @endif
                                <div class="flex"><span class="w-16 shrink-0">Pax</span><span>:
                                        {{ $numberOfPax }}</span></div>
                                <div class="flex"><span class="w-16 shrink-0">Cashier</span><span>:
                                        {{ auth()->user()->name }}</span></div>
                            </div>

                            <div class="border-b border-dashed border-gray-300 dark:border-gray-700 my-2"></div>

                            {{-- 3. DAFTAR ITEM --}}
                            <div class="space-y-2">
                                @forelse ($cartItems as $item)
                                    <div class="space-y-0.5">
                                        <p class="truncate">
                                            {{ $item['name'] }}
                                            @if (!empty($item['variant_name']))
                                                <span class="text-[10px] text-gray-400">({{ $item['variant_name'] }})</span>
                                            @endif
                                        </p>
                                        <div class="flex justify-between">
                                            <span>{{ $item['quantity'] }}x
                                                {{ '@' . number_format($item['price'], 0, ',', '.') }}</span>
                                            <span class="tabular-nums font-medium text-gray-900 dark:text-white">
                                                {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                        @if (!empty($item['note']))
                                            <p class="text-[10px] text-orange-500 italic">* Notes: {{ $item['note'] }}
                                            </p>
                                        @endif
                                    </div>
                                @empty
                                    <div class="py-8 text-center text-gray-400 italic">Belum ada daftar item pesanan
                                    </div>
                                @endforelse
                            </div>

                            @php $totalQtyStruk = collect($cartItems)->sum('quantity'); @endphp
                            <p class="text-[10px] text-gray-500 pt-1">{{ $totalQtyStruk }}
                                item{{ $totalQtyStruk > 1 ? 's' : '' }}</p>

                            <div class="border-b border-dashed border-gray-300 dark:border-gray-700 my-2"></div>

                            {{-- 4. RINCIAN BIAYA --}}
                            <div class="space-y-1 text-gray-600 dark:text-gray-400">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span
                                        class="tabular-nums font-medium text-gray-900 dark:text-white">{{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                @if ($discountTotalAmount > 0)
                                    <div class="flex justify-between text-red-500">
                                        <span>Discount</span>
                                        <span class="tabular-nums">-{{ number_format($discountTotalAmount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                @if ($serviceAmount > 0)
                                    <div class="flex justify-between">
                                        <span>Service Charge ({{ number_format((float) $serviceRate, 0) }}%)</span>
                                        <span
                                            class="tabular-nums text-gray-900 dark:text-white">{{ number_format($serviceAmount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                @if ($taxAmount > 0)
                                    <div class="flex justify-between">
                                        <span>PB1 Total ({{ number_format((float) $taxRate, 0) }}%)</span>
                                        <span
                                            class="tabular-nums text-gray-900 dark:text-white">{{ number_format($taxAmount, 0, ',', '.') }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="border-b border-dashed border-gray-300 dark:border-gray-700 my-2"></div>

                            {{-- 5. TOTAL AKHIR --}}
                            <div class="space-y-1 text-gray-700 dark:text-gray-300">
                                <div class="flex justify-between">
                                    <span>Billing Total</span>
                                    <span
                                        class="tabular-nums font-medium text-gray-900 dark:text-white">{{ number_format($total - $roundingAmount, 0, ',', '.') }}</span>
                                </div>
                                @if ($roundingAmount != 0)
                                    <div class="flex justify-between">
                                        <span>Rounding</span>
                                        <span
                                            class="tabular-nums">{{ $roundingAmount > 0 ? '+' : '' }}{{ number_format($roundingAmount, 0, ',', '.') }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex justify-between items-center pt-2 text-gray-900 dark:text-white">
                                <span class="text-xs font-black uppercase tracking-wider">Grand Total</span>
                                <span class="text-sm font-black tabular-nums text-brand-600 dark:text-brand-400">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="border-b border-dashed border-gray-300 dark:border-gray-700 pt-2"></div>
                            <div class="text-center text-[9px] text-gray-400 pt-2 tracking-widest uppercase">
                                - Thank You -
                            </div>
                        </div>

                        {{-- KOTAK KONTROL DOCK BAWAH PEMBAYARAN (tidak diubah) --}}
                        <div class="p-4 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 space-y-2">
                            <div class="grid grid-cols-3 gap-2 w-full">
                                <button type="button"
                                    class="h-12 w-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg border border-gray-300 transition active:scale-95 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                </button>
                                <button type="button"
                                    class="h-12 w-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg border border-gray-300 transition active:scale-95 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                                <button type="button"
                                    class="w-full h-12 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-[10px] font-bold rounded-lg transition active:scale-95 uppercase leading-tight shadow-sm tracking-tighter">
                                    Purchase Voucher
                                </button>
                            </div>
                            <button type="button" wire:click="savePayment"
                                class="w-full h-14 bg-brand-500 hover:bg-brand-600 text-white font-black rounded-lg shadow-md transition text-sm tracking-widest active:scale-[0.98]">
                                Save Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- KONTEN END START --}}
        @if ($checkoutModalOpen)
            @php
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
            @endphp
            @teleport('body')
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
                                            Langkah {{ $checkoutStep }}/3</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            @if ($checkoutStep === 1)
                                                Data Pelanggan
                                            @elseif ($checkoutStep === 2)
                                                Diskon & Voucher
                                            @else
                                                Pembayaran
                                            @endif
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
                                                    {{ number_format((int) $subtotal, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Diskon</p>
                                                <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                    Rp
                                                    {{ number_format((int) ($discountTotalAmount ?? 0), 0, ',', '.') }}
                                                </p>
                                            </div>
                                            @if ($orderType !== 'take_away')
                                                <div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Service</p>
                                                    <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                        Rp {{ number_format((int) $serviceAmount, 0, ',', '.') }}</p>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Pajak PB1</p>
                                                <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                    Rp
                                                    {{ number_format((int) $taxAmount, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <div class="sm:text-right">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                                                <p class="mt-1 text-base font-bold text-gray-900 dark:text-white/90">Rp
                                                    {{ number_format((int) $total, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($checkoutStep === 1)
                                        <div
                                            class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Customer
                                            </p>
                                            <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    @can('members.view')
                                                        <label
                                                            class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Member
                                                            (Opsional)</label>
                                                        <select wire:model.live="memberId"
                                                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                            @disabled($cartLocked)>
                                                            <option value="">-</option>
                                                            @php
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
                                                            @endphp
                                                            @foreach ($this->members as $m)
                                                                @php
                                                                    $phoneLabel = '';
                                                                    if ($m->phone) {
                                                                        $phoneLabel = $canViewMemberPii
                                                                            ? (string) $m->phone
                                                                            : $maskPhone($m->phone);
                                                                    }
                                                                @endphp
                                                                <option value="{{ (int) $m->id }}">
                                                                    {{ $m->name }}{{ $phoneLabel !== '' ? ' (' . $phoneLabel . ')' : '' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <div
                                                            class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-xs text-gray-600 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-400">
                                                            Anda tidak memiliki akses untuk memilih member.
                                                        </div>
                                                    @endcan
                                                </div>
                                                <div>
                                                    <label
                                                        class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Nama</label>
                                                    <input wire:model.live="customerName" type="text"
                                                        aria-invalid="{{ $errors->has('customerName') ? 'true' : 'false' }}"
                                                        aria-describedby="{{ $errors->has('customerName') ? 'error-customerName' : '' }}"
                                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                        placeholder="Walk-in" @disabled($cartLocked) />
                                                    <x-common.input-error for="customerName" />
                                                </div>
                                                <div>
                                                    <label
                                                        class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Telepon
                                                        (Opsional)</label>
                                                    <input wire:model.live="customerPhone" type="text"
                                                        aria-invalid="{{ $errors->has('customerPhone') ? 'true' : 'false' }}"
                                                        aria-describedby="{{ $errors->has('customerPhone') ? 'error-customerPhone' : '' }}"
                                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                        placeholder="08xxxx" @disabled($cartLocked) />
                                                    <x-common.input-error for="customerPhone" />
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($checkoutStep === 2)
                                        <div
                                            class="mb-4 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Voucher
                                            </p>
                                            <div class="mt-3">
                                                <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Kode
                                                    Voucher (Opsional)</label>
                                                <input wire:model.live.debounce.500ms="voucherCodeInput" type="text"
                                                    aria-invalid="{{ $errors->has('voucherCodeInput') ? 'true' : 'false' }}"
                                                    aria-describedby="{{ $errors->has('voucherCodeInput') ? 'error-voucherCodeInput' : '' }}"
                                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 disabled:opacity-50 disabled:cursor-not-allowed"
                                                    placeholder="Masukkan kode voucher" @disabled($cartLocked) />
                                                <x-common.input-error for="voucherCodeInput" />
                                                @if (trim((string) ($voucherCodeInput ?? '')) !== '')
                                                    <p
                                                        class="mt-1 text-xs {{ $voucherValid ?? false ? 'text-success-600' : 'text-gray-500 dark:text-gray-400' }}">
                                                        {{ $voucherMessage }}
                                                    </p>
                                                @endif
                                                @if ($cartLocked && trim((string) ($voucherCodeInput ?? '')) !== '')
                                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Voucher
                                                        mengikuti pesanan self-order.</p>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($memberId && ($memberPoints > 0 || $pointsToRedeem > 0))
                                            <div
                                                class="mb-4 rounded-2xl border border-brand-200 bg-brand-50 p-4 dark:border-brand-800 dark:bg-brand-900/20">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p class="text-sm font-semibold text-brand-800 dark:text-brand-300">
                                                            Poin Member</p>
                                                        <p class="text-xs text-brand-600 dark:text-brand-400">
                                                            Tersedia: {{ number_format($memberPoints, 0, ',', '.') }}
                                                            Poin
                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <label class="inline-flex items-center cursor-pointer">
                                                            <input type="checkbox" wire:model.live="redeemPoints" class="sr-only peer"
                                                                @disabled($cartLocked)>
                                                            <div
                                                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-300 dark:peer-focus:ring-brand-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-brand-600">
                                                            </div>
                                                            <span
                                                                class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tukar</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                @if ($redeemPoints)
                                                    @if ($pointsToRedeem > 0)
                                                        <div class="mt-2 text-xs text-brand-700 dark:text-brand-300">
                                                            Menukar
                                                            <b>{{ number_format($pointsToRedeem, 0, ',', '.') }}</b>
                                                            poin =
                                                            Diskon <b>Rp
                                                                {{ number_format($pointDiscountAmount, 0, ',', '.') }}</b>
                                                        </div>
                                                    @elseif ($memberPoints < $minRedemptionPoints)
                                                        <div class="mt-2 text-xs text-error-600">
                                                            Minimal penukaran
                                                            {{ number_format($minRedemptionPoints, 0, ',', '.') }}
                                                            poin.
                                                        </div>
                                                    @endif
                                                @endif
                                                @if ($cartLocked && $pointsToRedeem > 0)
                                                    <div class="mt-2 text-xs text-brand-700 dark:text-brand-300">
                                                        Poin mengikuti pesanan self-order.
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        <div
                                            class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Diskon
                                                Manual
                                            </p>
                                            @can('discounts.manual.apply')
                                                <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2">
                                                    <div>
                                                        <label
                                                            class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Tipe</label>
                                                        <select wire:model.live="manualDiscountType"
                                                            aria-invalid="{{ $errors->has('manualDiscountType') ? 'true' : 'false' }}"
                                                            aria-describedby="{{ $errors->has('manualDiscountType') ? 'error-manualDiscountType' : '' }}"
                                                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                                            <option value="">-</option>
                                                            <option value="percent">Persen (%)</option>
                                                            <option value="fixed_amount">Nominal (Rp)</option>
                                                        </select>
                                                        <x-common.input-error for="manualDiscountType" />
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Nilai</label>
                                                        @if ($manualDiscountType === 'fixed_amount')
                                                            <input
                                                                x-data="currencyInput($wire.entangle('manualDiscountValue').live.debounce .500 ms)"
                                                                x-model="displayValue" @input="handleInput" type="text" inputmode="numeric"
                                                                aria-invalid="{{ $errors->has('manualDiscountValue') ? 'true' : 'false' }}"
                                                                aria-describedby="{{ $errors->has('manualDiscountValue') ? 'error-manualDiscountValue' : '' }}"
                                                                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                        @else
                                                            <input wire:model.live="manualDiscountValue" type="number" min="0"
                                                                aria-invalid="{{ $errors->has('manualDiscountValue') ? 'true' : 'false' }}"
                                                                aria-describedby="{{ $errors->has('manualDiscountValue') ? 'error-manualDiscountValue' : '' }}"
                                                                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                        @endif
                                                        <x-common.input-error for="manualDiscountValue" />
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <label
                                                            class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Catatan
                                                            (Opsional)</label>
                                                        <textarea wire:model.live="manualDiscountNote" rows="2"
                                                            aria-invalid="{{ $errors->has('manualDiscountNote') ? 'true' : 'false' }}"
                                                            aria-describedby="{{ $errors->has('manualDiscountNote') ? 'error-manualDiscountNote' : '' }}"
                                                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                                            placeholder="Contoh: kompensasi komplain"></textarea>
                                                        <x-common.input-error for="manualDiscountNote" />
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="mt-3 rounded-lg border border-gray-200 bg-white px-4 py-3 text-xs text-gray-600 dark:border-gray-800 dark:bg-white/[0.03] dark:text-gray-400">
                                                    Anda tidak memiliki izin untuk memberikan diskon manual.
                                                </div>
                                            @endcan
                                            @if (($manualDiscountAmount ?? 0) > 0)
                                                <div
                                                    class="mt-4 flex items-center justify-between rounded-xl bg-success-50 p-3 border border-success-100 dark:bg-success-900/20 dark:border-success-900/30">
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <span class="text-sm font-semibold text-success-700 dark:text-success-300">Total
                                                            Diskon</span>
                                                    </div>
                                                    <span class="text-sm font-bold text-success-700 dark:text-success-300">Rp
                                                        {{ number_format((int) $manualDiscountAmount, 0, ',', '.') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($checkoutStep === 3)
                                        <div class="space-y-4">
                                            {{-- Card Info Ringkasan --}}
                                            <div
                                                class="bg-blue-50 dark:bg-blue-900/20 p-5 rounded-2xl border border-blue-100 dark:border-blue-800">
                                                <div class="flex justify-between items-start mb-4">
                                                    <div>
                                                        <p
                                                            class="text-xs text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">
                                                            Meja</p>
                                                        <p class="text-xl font-black text-blue-900 dark:text-white">
                                                            {{ $customerName }}
                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p
                                                            class="text-xs text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">
                                                            Status</p>
                                                        <span @class([
                                                            'px-2 py-1 rounded text-[10px] font-bold uppercase',
                                                            'bg-orange-100 text-orange-700' => !$isFinalPayment,
                                                            'bg-[#1086e1]/10 text-[#1086e1] border border-[#1086e1]/20' => $isFinalPayment,
                                                        ])>
                                                            {{ $isFinalPayment ? 'Pelunasan / Bayar' : 'Dine In' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div
                                                    class="pt-4 border-t border-blue-200 dark:border-blue-700 flex justify-between items-center">
                                                    <span class="font-bold text-blue-900 dark:text-white text-lg">Total
                                                        Bill</span>
                                                    <span class="text-3xl font-black text-brand-600">
                                                        {{-- Jika Booking, tampilkan subtotal saja. Jika Bayar, tampilkan Total
                                                        (Setelah Pajak/Diskon) --}}
                                                        Rp
                                                        {{ number_format($isFinalPayment ? $total : $subtotal, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>

                                            @if ($isFinalPayment)
                                                {{-- FORM PEMBAYARAN LENGKAP (Hanya muncul saat mau BAYAR) --}}
                                                <div
                                                    class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-semibold text-gray-800 dark:text-white/90">
                                                            Pembayaran</p>
                                                        @if ($orderType !== 'take_away')
                                                            <div class="w-32">
                                                                <label
                                                                    class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Service
                                                                    (%)</label>
                                                                <div class="relative">
                                                                    <input wire:model.live="serviceRate" type="number" min="0" max="100"
                                                                        step="0.01"
                                                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-7 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <span class="text-gray-500 dark:text-gray-400">%</span>
                                                                    </div>
                                                                </div>
                                                                <x-common.input-error for="serviceRate" />
                                                            </div>
                                                        @endif
                                                        {{-- <div class="w-32">
                                                            <label
                                                                class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Service
                                                                (%)</label>
                                                            <div class="relative">
                                                                <input wire:model.live="serviceRate" type="number" min="0" max="100"
                                                                    step="0.01"
                                                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-7 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                                <div
                                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                    <span class="text-gray-500 dark:text-gray-400">%</span>
                                                                </div>
                                                            </div>
                                                            <x-common.input-error for="serviceRate" />
                                                        </div> --}}
                                                        <div class="w-32">
                                                            <label
                                                                class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Pajak
                                                                PB1 (%)</label>
                                                            <div class="relative">
                                                                <input wire:model.live="taxRate" type="number" min="0" max="100"
                                                                    step="0.01"
                                                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-7 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                                <div
                                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                    <span class="text-gray-500 dark:text-gray-400">%</span>
                                                                </div>
                                                            </div>
                                                            <x-common.input-error for="taxRate" />
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                        <div class="sm:col-span-2">
                                                            <label
                                                                class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Metode
                                                                Bayar</label>
                                                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                                                                @foreach ($paymentMethods as $pm)
                                                                                            <button type="button"
                                                                                                wire:click="$set('paymentMethod', '{{ $pm['id'] }}')"
                                                                                                class="flex flex-col items-center justify-center rounded-xl border p-3 text-center transition-all duration-200 hover:shadow-md
                                                                                                                                                                                                {{ $paymentMethod === $pm['id']
                                                                    ? 'border-brand-500 bg-brand-50 text-brand-700 ring-2 ring-brand-500/20 dark:border-brand-400 dark:bg-brand-900/20 dark:text-brand-300'
                                                                    : 'border-gray-200 bg-white text-gray-600 hover:border-brand-300 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-800' }}">
                                                                                                <div
                                                                                                    class="mb-2 flex h-8 w-8 items-center justify-center rounded-full
                                                                                                                                                                                                    {{ $paymentMethod === $pm['id'] ? 'bg-brand-100 text-brand-600 dark:bg-brand-900/40 dark:text-brand-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400' }}">
                                                                                                    @if ($pm['id'] === 'cash')
                                                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                                                            viewBox="0 0 24 24">
                                                                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                                stroke-width="2"
                                                                                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    @elseif($pm['id'] === 'qris')
                                                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                                                            viewBox="0 0 24 24">
                                                                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                                stroke-width="2"
                                                                                                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    @elseif(str_contains($pm['id'], 'food'))
                                                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                                                            viewBox="0 0 24 24">
                                                                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                                stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    @else
                                                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                                                            viewBox="0 0 24 24">
                                                                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                                stroke-width="2"
                                                                                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <span class="text-xs font-medium">{{ $pm['name'] }}</span>
                                                                                            </button>
                                                                @endforeach
                                                            </div>
                                                            <x-common.input-error for="paymentMethod"
                                                                class="mt-2 text-center text-xs text-error-600" />
                                                        </div>

                                                        @if ($paymentMethod === 'cash')
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
                                                                        x-model="displayValue" @input="handleInput" type="text"
                                                                        inputmode="numeric"
                                                                        aria-invalid="{{ $errors->has('cashReceived') ? 'true' : 'false' }}"
                                                                        aria-describedby="{{ $errors->has('cashReceived') ? 'error-cashReceived' : '' }}"
                                                                        class="dark:bg-dark-900 shadow-theme-xs h-12 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pl-10 text-lg font-bold text-gray-900 focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:focus:border-brand-400"
                                                                        placeholder="0" />
                                                                </div>
                                                                <x-common.input-error for="cashReceived" />

                                                                <!-- Quick Amount Suggestions -->
                                                                <div class="mt-3 flex flex-wrap gap-2">
                                                                    @foreach ([20000, 50000, 100000, 200000] as $amt)
                                                                        @if ($amt >= $total)
                                                                            <button type="button" wire:click="$set('cashReceived', '{{ $amt }}')"
                                                                                class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                                                Rp
                                                                                {{ number_format($amt, 0, ',', '.') }}
                                                                            </button>
                                                                        @endif
                                                                    @endforeach
                                                                    <button type="button" wire:click="$set('cashReceived', '{{ $total }}')"
                                                                        class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                                        Uang Pas
                                                                    </button>
                                                                </div>

                                                                <div class="mt-4 rounded-xl bg-gray-100 p-4 dark:bg-gray-800">
                                                                    <div class="flex justify-between items-center">
                                                                        <span class="text-sm text-gray-600 dark:text-gray-400">Total
                                                                            Tagihan</span>
                                                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">Rp
                                                                            {{ number_format($total, 0, ',', '.') }}</span>
                                                                    </div>
                                                                    <div
                                                                        class="mt-2 flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-700">
                                                                        <span
                                                                            class="text-base font-medium text-gray-800 dark:text-white/90">Kembalian</span>
                                                                        <span class="text-xl font-bold text-[#1086e1]">
                                                                            Rp
                                                                            {{ number_format((int) $cashChange, 0, ',', '.') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                {{-- TAMPILAN BOOKING (Hanya muncul saat klik PESAN pertama kali) --}}
                                                <div
                                                    class="p-6 bg-gray-100 dark:bg-gray-800 rounded-2xl text-center border-2 border-dashed border-gray-300 dark:border-gray-700">
                                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="border-t border-gray-200 bg-white px-6 py-4 dark:border-gray-800 dark:bg-gray-900">
                                    <div
                                        class="flex flex-col-reverse items-stretch justify-between gap-2 sm:flex-row sm:items-center">
                                        @if ($checkoutStep > 1)
                                            <button type="button" wire:click="prevStep"
                                                class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                                                Kembali
                                            </button>
                                        @else
                                            <button type="button" wire:click="$set('checkoutModalOpen', false)"
                                                class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                                                Batal
                                            </button>
                                        @endif

                                        @if ($checkoutStep < 3)
                                            <button type="button" wire:click="nextStep"
                                                class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                                                Lanjut
                                            </button>
                                        @else
                                            <button type="button" wire:click="checkout" wire:loading.attr="disabled" @class([
                                                'flex-[2] px-6 py-3 rounded-xl font-black transition text-lg text-white shadow-lg',
                                                'bg-[#1086e1] hover:bg-[#0f75c7]' => $isFinalPayment, // Jika Bayar - Header Blue
                                                'bg-blue-600 hover:bg-blue-700' => !$isFinalPayment, // Jika Booking
                                            ])>
                                                {{ $isFinalPayment ? 'Lunasi Sekarang' : 'Kirim Ke Dapur' }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endteleport
        @endif

        {{-- MODAL VOID ITEM --}}
        @if ($voidItemModalOpen)
            @teleport('body')
            <div class="fixed inset-0 z-[100001] flex items-center justify-center p-4">
                {{-- Backdrop dengan Blur --}}
                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="$set('voidItemModalOpen', false)">
                </div>

                <div
                    class="relative w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 animate-in fade-in zoom-in duration-200">

                    {{-- Header dengan Warna Merah Lembut --}}
                    <div class="bg-red-50 dark:bg-red-900/20 px-6 py-5 border-b border-red-100 dark:border-red-900/30">
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
                        {{-- Info Item yang akan dihapus --}}
                        @php
                            $itemToVoid = $cartItems[$voidItemIndex] ?? null;
                        @endphp

                        @if ($itemToVoid)
                            <div
                                class="mb-5 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700/50">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Item yang
                                    dipilih:</p>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-black text-gray-800 dark:text-white uppercase">
                                            {{ $itemToVoid['name'] }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $itemToVoid['variant_name'] ?? 'Porsi Standar' }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="text-xs font-bold text-red-500 bg-red-50 dark:bg-red-900/30 px-2 py-1 rounded-md">{{ $itemToVoid['quantity'] }}
                                            item</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="space-y-5">
                            {{-- Input Alasan --}}
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Alasan
                                    Penghapusan</label>
                                <textarea wire:model.live="voidItemReason" rows="2"
                                    class="w-full rounded-2xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-4 py-3 focus:ring-red-500 focus:border-red-500 dark:text-white transition shadow-sm"
                                    placeholder="Misal: Customer batal pesan, salah input menu..."></textarea>
                                @error('voidItemReason')
                                    <span class="text-[10px] font-bold text-red-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            {{-- Input PIN dengan Gaya Keamanan --}}
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-500 mb-1.5 uppercase tracking-wider text-center">PIN
                                    Otorisasi Manager</label>
                                <div class="relative">
                                    <input type="password" wire:model.live="voidItemPin" maxlength="6" inputmode="numeric"
                                        class="w-full h-14 text-center text-3xl font-black tracking-[0.5em] rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:border-red-500 focus:ring-red-500 dark:text-white transition"
                                        placeholder="••••••" />
                                </div>
                                @error('voidItemPin')
                                    <span class="text-[10px] font-bold text-red-500 mt-1 flex justify-center items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Footer Action --}}
                    <div class="p-4 bg-gray-50 dark:bg-gray-800/80 flex gap-3">
                        <button type="button" wire:click="$set('voidItemModalOpen', false)"
                            class="flex-1 h-12 font-bold text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-2xl transition">
                            Batal
                        </button>
                        <button type="button" wire:click="confirmVoidItem"
                            class="flex-[2] h-12 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-black shadow-lg shadow-red-500/30 uppercase tracking-wider transition active:scale-95">
                            Hapus Menu Sekarang
                        </button>
                    </div>
                </div>
            </div>
            @endteleport
        @endif
    @endif
    @if ($selectTableModalOpen)
        @teleport('body')
        <div class="fixed inset-0 z-[100005] flex items-center justify-center p-4" aria-modal="true" role="dialog">

            {{-- Backdrop Gelap Transparan --}}
            <div class="absolute inset-0 bg-black/40 transition-opacity" wire:click="$set('selectTableModalOpen', false)">
            </div>

            {{-- Box Card Modal --}}
            <div
                class="relative w-full max-w-lg overflow-hidden rounded-xl bg-white shadow-xl dark:bg-gray-900 border border-gray-200 dark:border-gray-800 animate-in fade-in zoom-in-95 duration-150">

                {{-- 1. HEADER MODAL --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-base font-bold text-gray-800 dark:text-white">
                        Book Table ({{ 'Table ' . $tableToSelectLabel ?? 'Table 1' }})
                    </h3>
                    <button type="button" wire:click="$set('selectTableModalOpen', false)"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- 2. KONTEN UTAMA MODAL --}}
                <div class="p-5 space-y-5">

                    {{-- Elemen A: Number of Pax --}}
                    <div>
                        <label
                            class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2 uppercase tracking-wide">
                            Number of pax
                        </label>
                        <input wire:model.defer="numberOfPax" type="number" min="1"
                            class="w-full h-11 border border-gray-300 rounded-lg bg-white px-4 text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:bg-gray-900 dark:text-white dark:border-gray-700"
                            placeholder="1" />

                        {{-- Baris Elemen Tombol Cepat (Persis di Bawah Input Sesuai Gambar POS) --}}
                        <div class="flex items-center gap-1.5 my-2 rounded-lg w-full overflow-x-auto custom-scrollbar">
                            {{-- Tombol Kurang (<) --}} <button type="button" wire:click="decrementPax"
                                class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded-md text-gray-600 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 transition shrink-0 font-bold active:scale-95 shadow-xs">
                                &lt;
                                </button>

                                {{-- Deretan Angka Pax Shortcut 1 sampai 5 --}}
                                @foreach ([1, 2, 3, 4, 5] as $amt)
                                    <button type="button" wire:click="$set('numberOfPax', {{ $amt }})" @class([
                                        'w-10 h-10 flex items-center justify-center text-sm font-bold rounded-md transition shrink-0 active:scale-95',
                                        'bg-brand-500 text-white shadow-xs' => $numberOfPax == $amt,
                                        'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 shadow-xs' =>
                                            $numberOfPax != $amt,
                                    ])>
                                        {{ $amt }}
                                    </button>
                                @endforeach

                                {{-- Tombol Tambah (>) --}}
                                <button type="button" wire:click="incrementPax"
                                    class="w-10 h-10 flex items-center justify-center bg-white border border-gray-300 rounded-md text-gray-600 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 transition shrink-0 font-bold active:scale-95 shadow-xs">
                                    &gt;
                                </button>
                        </div>
                    </div>

                    {{-- Elemen B: Sales Mode & Tipe Order --}}
                    <div>
                        <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-wide">
                            Sales Mode: <span class="text-gray-800 dark:text-white font-bold">Dine In</span>
                        </span>

                        {{-- Button Status Aktif Dine In --}}
                        <button type="button"
                            class="h-11 px-6 font-bold text-xs rounded-lg border-2 border-[#1086e1] bg-blue-50 text-[#1086e1] dark:bg-blue-950/30 dark:text-blue-400 transition cursor-default">
                            Dine In
                        </button>
                    </div>

                </div>

                {{-- 3. FOOTER ACTIONS (Dua Tombol Kanan Berjejer) --}}
                <div
                    class="border-t border-gray-200 bg-gray-50 px-5 py-3 dark:border-gray-800 dark:bg-gray-950 flex items-center justify-between">

                    {{-- Sisi Kiri: Tombol Close/Cancel --}}
                    <button type="button" wire:click="$set('selectTableModalOpen', false)"
                        class="h-10 px-4 text-xs font-bold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition">
                        Close
                    </button>

                    {{-- Sisi Kanan: Berjejer Horizontal --}}
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
        @endteleport
    @endif
    @if ($paymentModalOpen)
        @teleport('body')
        <div class="fixed inset-0 z-[100010] flex items-center justify-center p-4 animate-in fade-in duration-100"
            aria-modal="true" role="dialog">

            {{-- Backdrop Gelap Transparan --}}
            <div class="absolute inset-0 bg-black/40 backdrop-blur-xs" wire:click="$set('paymentModalOpen', false)">
            </div>

            {{-- Box Card Modal --}}
            <div
                class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-900 border border-gray-200 dark:border-gray-800 transform scale-100 transition-all">

                {{-- 1. HEADER MODAL (DINAMIS) --}}
                <div
                    class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800 bg-gray-50 dark:bg-gray-950">
                    <h3
                        class="text-sm font-black uppercase text-gray-800 dark:text-white tracking-wider flex items-center gap-2">
                        💳 {{ $selectedPaymentLabel }}
                    </h3>
                    <button type="button" wire:click="$set('paymentModalOpen', false)"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- 2. KONTEN UTAMA MODAL --}}
                <div class="p-5 space-y-4 bg-white dark:bg-gray-900">

                    {{-- LAYER A: 3 KOLOM KECIL (OUTSTANDING, CASH AMOUNT & REFRESH) --}}
                    <div class="flex items-end gap-2 w-full">
                        {{-- Kolom 1: Outstanding Display --}}
                        <div class="w-1/3 space-y-1">
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Outstanding</label>
                            <input type="text" readonly value="Rp {{ number_format($total, 0, ',', '.') }}"
                                class="w-full h-10 border border-gray-200 bg-gray-100 text-red-600 font-bold px-3 text-xs rounded-lg dark:bg-gray-800 dark:border-gray-700 cursor-not-allowed tabular-nums" />
                        </div>

                        {{-- Kolom 2: Cash Amount Input --}}
                        <div class="flex-1 space-y-1">
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Cash
                                Amount</label>
                            <input type="text" wire:model.live="cashReceived" placeholder="Masukkan Nominal"
                                class="w-full h-10 border border-brand-500 font-black text-sm text-gray-900 dark:text-white bg-white dark:bg-gray-950 px-3 rounded-lg focus:ring-1 focus:ring-brand-500 focus:border-brand-500" />
                        </div>

                        {{-- Kolom 3: Button Refresh --}}
                        <div class="shrink-0">
                            <button type="button" wire:click="$set('cashReceived', '{{ $total }}')" title="Reset Uang Pas"
                                class="h-10 w-11 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 rounded-lg border border-gray-300 dark:border-gray-600 transition active:scale-95 shadow-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- LAYER B: 3 KOLOM CARD REKOMENDASI UANG ACUAN (QUICK CASH PRESETS) --}}
                    <div class="space-y-1">
                        <label
                            class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Rekomendasi
                            Uang Pas</label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ([50000, 100000, 200000] as $presetAmt)
                                <button type="button" wire:click="$set('cashReceived', '{{ $presetAmt }}')"
                                    class="h-10 flex items-center justify-center border border-gray-200 hover:border-brand-500 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-bold rounded-lg transition active:scale-95 shadow-xs tabular-nums">
                                    Rp {{ number_format($presetAmt, 0, ',', '.') }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- LAYER C: REVISI 5 KOLOM 2 BARIS PRESET PECAHAN UANG INDONESIA --}}
                    <div class="space-y-1">
                        <label
                            class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">
                            Pecahan Uang Rupiah
                        </label>
                        <div class="grid grid-cols-5 gap-1.5">
                            @php
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
                            @endphp

                            @foreach ($moneyDenominations as $coin)
                                {{-- Menggunakan format angka biasa tanpa titik ke properti backend kasir --}}
                                <button type="button" wire:click="$set('cashReceived', {{ $coin['value'] }})"
                                    class="h-11 flex flex-col items-center justify-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 font-extrabold rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-brand-500 dark:hover:border-brand-500 transition active:scale-95 shadow-xs">
                                    <span class="text-xs tracking-tight">{{ $coin['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- 3. FOOTER ACTIONS (DUA TOMBOL DI UJUNG KANAN) --}}
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
        @endteleport
    @endif
</div>