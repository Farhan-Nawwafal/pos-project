<div class="flex flex-col h-full">
    {{-- Mode Dine In dan Belum Pilih Meja --}}
    @if ($orderType === 'dine_in' && !$selectedTableId)

        {{-- HEADER SELECTION --}}
        <div class="flex flex-wrap items-center gap-2 mb-4 flex-shrink-0">
            <button type="button" wire:click="chooseOrderType('take_away')"
                class="px-4 py-2 text-lg font-bold bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                Quick Service
            </button>
            <button type="button" wire:click="$set('tableRange', '1-50')" @class([
                'px-4 py-2 text-lg font-bold rounded-lg transition-all',
                'bg-brand-500 text-white border border-brand-600' => $tableRange === '1-50',
                'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300' =>
                    $tableRange !== '1-50',
            ])>1 - 50</button>
            <button type="button" wire:click="$set('tableRange', '51-100')" @class([
                'px-4 py-2 text-lg font-bold rounded-lg transition-all',
                'bg-brand-500 text-white border border-brand-600' =>
                    $tableRange === '51-100',
                'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300' =>
                    $tableRange !== '51-100',
            ])>51 -
                100</button>
        </div>

        <div
            class="flex flex-col flex-1 min-h-0 bg-white dark:bg-gray-900 p-4 border border-gray-200 dark:border-gray-800 shadow-sm">

            {{-- KONTEN UTAMA (LIST TABLE) --}}
            <div class="flex-1 min-h-0 overflow-y-auto">
                <div class="grid grid-cols-10 gap-3 md:gap-4 lg:gap-5 xl:gap-6">
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
                            <button type="button" wire:click="selectTable({{ (int) $t['id'] }})"
                                @if (in_array($status, ['occupied', 'booked', 'billed']) && isset($t['occupied_at'])) x-data="{
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
                                        }" @endif
                                @class([
                                    'flex flex-col items-center justify-center border transition-all shadow-sm group rounded-sm aspect-[4/3]',
                                    'bg-[#1086e1] border-[#0f75c7] hover:bg-[#0f75c7] text-white' =>
                                        $status === 'available',
                                    'bg-yellow-400 border-yellow-500 hover:bg-yellow-500 text-white' =>
                                        $status === 'booked',
                                    'bg-red-600 border-red-700 hover:bg-red-700 text-white' =>
                                        $status === 'occupied',
                                    'bg-green-500 border-green-600 hover:bg-green-600 text-white' =>
                                        $status === 'billed',
                                ])>
                                <span
                                    class="text-sm font-bold group-hover:scale-110 transition-transform">{{ $t['label'] }}</span>
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
            <div class="flex-shrink-0 pt-4 border-t border-gray-200 dark:border-gray-800">
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3">
                    {{-- Waktu --}}
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 text-xs font-bold bg-yellow-400 text-white rounded-md">>0 minute</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 text-xs font-bold bg-red-600 text-white rounded-md">>0 minute</span>
                    </div>

                    {{-- Keterangan Status --}}
                    <div class="flex items-center gap-1.5">
                        <div class="w-4 h-4 bg-[#1086e1] rounded border border-[#0f75c7]"></div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Available</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-4 h-4 bg-yellow-400 rounded border border-yellow-500"></div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Booked</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-4 h-4 bg-red-600 rounded border border-red-700"></div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Occupied</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-4 h-4 bg-green-500 rounded border border-green-600"></div>
                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Billed</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mode Quick Service atau Dine In sudah pilih meja --}}
    @elseif ($orderType === 'take_away' || ($orderType === 'dine_in' && $selectedTableId))
        {{-- Ambil grid produk + keranjang dari kode lama (dokumen 6) --}}
        <h3><b>Order Notes</b></h3>
        <div class="grid grid-cols-2">
            <div class="flex">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Information will be printed"
                class="w-full border border-gray-300 bg-white text-sm dark:bg-gray-900 dark:text-white p-2"
                />
                <img
                    src="/assets/icons/arrow-left-icon.svg"
                />
                <img
                    src="/assets/icons/arrow-left-icon.svg"
                />
                <img
                    src="/assets/icons/arrow-left-icon.svg"
                />
            </div>
            <div>

            </div>

        </div>
        <div class="grid grid-cols-1 gap-6 p-2 md:grid-cols-12">

            {{-- KIRI: List Produk --}}
            <div class="md:col-span-6">

                {{-- Tombol kembali ke pilih meja (khusus dine in) --}}
                @if ($orderType === 'dine_in' && $selectedTableId)
                    <div class="mb-4 flex items-center gap-3">
                        <button type="button" wire:click="$set('selectedTableId', null)"
                            class="px-3 py-1.5 text-xs font-bold bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            ← Ganti Meja
                        </button>
                        <span class="text-sm font-bold text-brand-700">
                            📍 Meja: {{ collect($this->tables)->firstWhere('id', $selectedTableId)['label'] ?? '-' }}
                        </span>
                    </div>
                @else
                    {{-- Tombol kembali ke dine in (dari quick service) --}}
                    <div class="mb-4">
                        <button type="button" wire:click="chooseOrderType('dine_in')"
                            class="px-3 py-1.5 text-xs font-bold bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            ← Kembali Dine In
                        </button>
                    </div>
                @endif

                {{-- Grid Produk (dari kode lama dokumen 6) --}}
                @php
                    $perPage = 16;
                    $displayProducts = array_slice($this->productCards, ($productPage - 1) * $perPage, $perPage);
                @endphp
                <div wire:init="loadVariantStockStatuses"
                    class="grid grid-cols-4 gap-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4">
                    @forelse ($displayProducts as $product)
                        @php
                            $firstVariant = $product['variants'][0] ?? null;
                            $finalPrice = (int) round(
                                (float) ($firstVariant['price_afterdiscount'] ?? ($firstVariant['price'] ?? 0)),
                            );
                        @endphp
                        <button type="button" wire:click="addToCart({{ (int) $product['id'] }})"
                            class="group flex min-h-[100px] w-full flex-col items-center justify-center overflow-hidden rounded-xl border border-transparent shadow-sm hover:shadow-md hover:brightness-105 transition active:scale-95"
                            style="background-color: #F07600;">
                            <div class="text-center flex flex-col items-center justify-center gap-1 p-3 w-full h-full">
                                <p class="text-sm font-bold text-white line-clamp-2 uppercase leading-snug">
                                    {{ $product['name'] }}
                                </p>
                                <p class="text-sm font-bold text-white/90 mt-1">
                                    Rp {{ number_format($finalPrice, 0, ',', '.') }}
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

            {{-- KANAN: Area Keranjang --}}
            <div class="md:col-span-6">
                <div
                    class="md:sticky md:top-20 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                    {{-- Header Keranjang --}}
                    <div
                        class="flex items-center justify-between border-b border-gray-200 px-5 py-3 dark:border-gray-800">
                        <h3 class="text-base font-bold text-gray-800 dark:text-white/90">Pesanan</h3>
                        <button wire:click="$set('pendingOrdersModalOpen', true)"
                            class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @if ($this->pendingTransactions->count() > 0)
                                <span
                                    class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full">{{ $this->pendingTransactions->count() }}</span>
                            @endif
                        </button>
                    </div>

                    <div class="p-4">
                        {{-- DAFTAR ITEM (TAMPILAN KHUSUS TABLET/SENTUH) --}}
                        <div class="custom-scrollbar max-h-[190px] min-h-[190px] overflow-y-auto mb-4 pr-1">
                            <div class="space-y-3">
                                @forelse ($cartItems as $idx => $item)
                                    @php
                                        $price = (int) ($item['price'] ?? 0);
                                        $qty = (int) ($item['quantity'] ?? 0);
                                    @endphp
                                    <div class="pb-3 border-b border-gray-100 dark:border-gray-800 last:border-0">
                                        {{-- Baris Atas: Nama & Harga --}}
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="min-w-0 flex-1">
                                                <p
                                                    class="text-xs font-bold text-gray-800 dark:text-white uppercase leading-tight truncate">
                                                    {{ $item['name'] }}
                                                </p>
                                                @if (!empty($item['variant_name']))
                                                    <p class="text-[10px] text-gray-500 italic">
                                                        {{ $item['variant_name'] }}</p>
                                                @endif
                                            </div>
                                            <div class="text-right ml-2">
                                                <p class="text-xs font-bold text-gray-800 dark:text-gray-200">
                                                    {{ number_format($qty * $price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Baris Bawah: Kontrol QTY & Void (Always Visible untuk Tablet) --}}
                                        <div class="flex justify-between items-center">
                                            <div
                                                class="inline-flex items-center p-0.5 bg-gray-100 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                                <button wire:click="decrement({{ $idx }})"
                                                    class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-brand-600 active:scale-95 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <span
                                                    class="w-8 text-center text-sm font-black text-brand-600 tabular-nums">{{ $qty }}</span>
                                                <button wire:click="increment({{ $idx }})"
                                                    class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-brand-600 active:scale-95 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>

                                            {{-- Tombol Hapus/Void --}}
                                            <button wire:click="removeItem({{ $idx }})"
                                                class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 active:text-red-700 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-8 text-center text-xs text-gray-400">Belum ada menu dipilih</div>
                                @endforelse
                            </div>
                        </div>

                        {{-- SUMMARY BAR (HORIZONTAL 1 BARIS) --}}
                        @php $totalQty = collect($cartItems)->sum('quantity'); @endphp
                        <div class="bg-gray-100 dark:bg-gray-900 rounded-xl p-3 mb-4 shadow-inner">
                            <div class="grid grid-cols-3 divide-x divide-white/10 text-center items-center">
                                <div>
                                    <p class="text-[9px] uppercase font-bold text-black">Qty</p>
                                    <p class="text-base font-black text-black leading-none">{{ $totalQty }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[9px] uppercase font-bold text-black">Subtotal</p>
                                    <p class="text-sm font-bold text-black leading-none mt-1">
                                        {{ number_format($subtotal, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] uppercase font-bold text-black">Billing</p>
                                    <p class="text-base font-black text-black leading-none">
                                        {{ number_format($total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL AKSI --}}
                        <div class="space-y-2">
                            @php
                                $isEditing = $editingTransactionId !== null;
                                $isDineIn = $orderType === 'dine_in';
                            @endphp

                            <div class="flex gap-2">
                                @if ($isEditing)
                                    <button wire:click="saveOrder"
                                        class="flex-1 h-12 bg-white border-2 border-blue-600 text-blue-600 font-bold rounded-xl text-xs hover:bg-blue-50 transition active:scale-95">
                                        Simpan Perubahan
                                    </button>
                                    <button type="button" wire:click="printBill"
                                        class="w-14 h-12 flex items-center justify-center bg-gray-100 text-gray-600 rounded-xl border border-gray-200 hover:bg-gray-200 transition active:scale-95">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                        </svg>
                                    </button>
                                @else
                                    <button wire:click="clearCart"
                                        class="flex-1 h-12 bg-white border border-gray-300 text-gray-500 font-bold rounded-xl text-xs hover:bg-gray-50 transition">
                                        Reset Keranjang
                                    </button>
                                @endif
                            </div>

                            <button wire:click="openCheckout" @disabled(count($cartItems) === 0)
                                @class([
                                    'w-full h-14 rounded-xl font-black text-white shadow-lg transition tracking-widest text-base active:scale-[0.98]',
                                    'bg-[#1086e1] hover:bg-[#0f75c7]' => $isDineIn && $isEditing,
                                    'bg-brand-500 hover:bg-brand-600' => !($isDineIn && $isEditing),
                                ])>
                                {{ $isDineIn ? ($isEditing ? 'Bayar Sekarang' : 'Kirim Ke Dapur') : 'Proses Bayar' }}
                            </button>
                        </div>
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
                                                <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">Rp
                                                    {{ number_format((int) $subtotal, 0, ',', '.') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Diskon</p>
                                                <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">Rp
                                                    {{ number_format((int) ($discountTotalAmount ?? 0), 0, ',', '.') }}</p>
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
                                                <p class="mt-1 text-sm font-semibold text-gray-800 dark:text-white/90">Rp
                                                    {{ number_format((int) $taxAmount, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="sm:text-right">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                                                <p class="mt-1 text-base font-bold text-gray-900 dark:text-white/90">Rp
                                                    {{ number_format((int) $total, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($checkoutStep === 1)
                                        <div
                                            class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Customer</p>
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
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Voucher</p>
                                            <div class="mt-3">
                                                <label
                                                    class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">Kode
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
                                                        <p
                                                            class="text-sm font-semibold text-brand-800 dark:text-brand-300">
                                                            Poin Member</p>
                                                        <p class="text-xs text-brand-600 dark:text-brand-400">
                                                            Tersedia: {{ number_format($memberPoints, 0, ',', '.') }} Poin
                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <label class="inline-flex items-center cursor-pointer">
                                                            <input type="checkbox" wire:model.live="redeemPoints"
                                                                class="sr-only peer" @disabled($cartLocked)>
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
                                                            <b>{{ number_format($pointsToRedeem, 0, ',', '.') }}</b> poin =
                                                            Diskon <b>Rp
                                                                {{ number_format($pointDiscountAmount, 0, ',', '.') }}</b>
                                                        </div>
                                                    @elseif ($memberPoints < $minRedemptionPoints)
                                                        <div class="mt-2 text-xs text-error-600">
                                                            Minimal penukaran
                                                            {{ number_format($minRedemptionPoints, 0, ',', '.') }} poin.
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
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white/90">Diskon Manual
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
                                                            <input x-data="currencyInput($wire.entangle('manualDiscountValue').live.debounce .500 ms)" x-model="displayValue"
                                                                @input="handleInput" type="text" inputmode="numeric"
                                                                aria-invalid="{{ $errors->has('manualDiscountValue') ? 'true' : 'false' }}"
                                                                aria-describedby="{{ $errors->has('manualDiscountValue') ? 'error-manualDiscountValue' : '' }}"
                                                                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                        @else
                                                            <input wire:model.live="manualDiscountValue" type="number"
                                                                min="0"
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
                                                        <svg class="w-5 h-5 text-success-600 dark:text-success-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span
                                                            class="text-sm font-semibold text-success-700 dark:text-success-300">Total
                                                            Diskon</span>
                                                    </div>
                                                    <span
                                                        class="text-sm font-bold text-success-700 dark:text-success-300">Rp
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
                                                            {{ $customerName }}</p>
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
                                                        {{-- Jika Booking, tampilkan subtotal saja. Jika Bayar, tampilkan Total (Setelah Pajak/Diskon) --}}
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
                                                                    <input wire:model.live="serviceRate" type="number"
                                                                        min="0" max="100" step="0.01"
                                                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-7 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                        <span
                                                                            class="text-gray-500 dark:text-gray-400">%</span>
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
                                                                <input wire:model.live="serviceRate" type="number"
                                                                    min="0" max="100" step="0.01"
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
                                                                <input wire:model.live="taxRate" type="number"
                                                                    min="0" max="100" step="0.01"
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
                                                                                <svg class="w-5 h-5" fill="none"
                                                                                    stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                                                    </path>
                                                                                </svg>
                                                                            @elseif($pm['id'] === 'qris')
                                                                                <svg class="w-5 h-5" fill="none"
                                                                                    stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                                                                    </path>
                                                                                </svg>
                                                                            @elseif(str_contains($pm['id'], 'food'))
                                                                                <svg class="w-5 h-5" fill="none"
                                                                                    stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                                                                                    </path>
                                                                                </svg>
                                                                            @else
                                                                                <svg class="w-5 h-5" fill="none"
                                                                                    stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2"
                                                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                                                    </path>
                                                                                </svg>
                                                                            @endif
                                                                        </div>
                                                                        <span
                                                                            class="text-xs font-medium">{{ $pm['name'] }}</span>
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
                                                                    <input x-data="currencyInput($wire.entangle('cashReceived').live)" x-model="displayValue"
                                                                        @input="handleInput" type="text"
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
                                                                            <button type="button"
                                                                                wire:click="$set('cashReceived', '{{ $amt }}')"
                                                                                class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                                                Rp {{ number_format($amt, 0, ',', '.') }}
                                                                            </button>
                                                                        @endif
                                                                    @endforeach
                                                                    <button type="button"
                                                                        wire:click="$set('cashReceived', '{{ $total }}')"
                                                                        class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                                        Uang Pas
                                                                    </button>
                                                                </div>

                                                                <div
                                                                    class="mt-4 rounded-xl bg-gray-100 p-4 dark:bg-gray-800">
                                                                    <div class="flex justify-between items-center">
                                                                        <span
                                                                            class="text-sm text-gray-600 dark:text-gray-400">Total
                                                                            Tagihan</span>
                                                                        <span
                                                                            class="text-sm font-semibold text-gray-900 dark:text-white">Rp
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
                                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    <p class="text-gray-600 dark:text-gray-300 font-medium">Pesanan akan
                                                        disimpan dan meja akan ditandai sebagai <span
                                                            class="text-red-600 font-bold">Terisi</span>.</p>
                                                    <p class="text-xs text-gray-400 mt-1">Pembayaran dilakukan nanti saat
                                                        pelanggan selesai makan.</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="border-t border-gray-200 bg-white px-6 py-4 dark:border-gray-800 dark:bg-gray-900">
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
                                            <button type="button" wire:click="checkout" wire:loading.attr="disabled"
                                                @class([
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
                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"
                    wire:click="$set('voidItemModalOpen', false)"></div>

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
                                            {{ $itemToVoid['name'] }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $itemToVoid['variant_name'] ?? 'Porsi Standar' }}</p>
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
                                <label
                                    class="block text-[10px] font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Alasan
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
                                    <input type="password" wire:model.live="voidItemPin" maxlength="6"
                                        inputmode="numeric"
                                        class="w-full h-14 text-center text-3xl font-black tracking-[0.5em] rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:border-red-500 focus:ring-red-500 dark:text-white transition"
                                        placeholder="••••••" />
                                </div>
                                @error('voidItemPin')
                                    <span
                                        class="text-[10px] font-bold text-red-500 mt-1 flex justify-center items-center gap-1">
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
</div>
