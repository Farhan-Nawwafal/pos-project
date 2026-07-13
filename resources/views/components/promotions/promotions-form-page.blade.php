<div class="space-y-6">
    {{-- Breadcrumb / Header --}}
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ $isEdit ? 'Ubah Promosi' : 'Buat Promosi Baru' }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Isi detail program promosi potongan belanja untuk POS Kasir.
            </p>
        </div>
        <div>
            <a href="{{ route('promotions.index') }}" wire:navigate
                class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                Kembali
            </a>
        </div>
    </div>

    {{-- Form Container --}}
    <form wire:submit="save"
        class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] space-y-6">

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            {{-- Nama Promosi --}}
            <div class="space-y-2 col-span-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Promosi <span
                        class="text-red-500">*</span></label>
                <input type="text" wire:model="name" placeholder="Contoh: Promo Grand Opening Desember"
                    class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm shadow-theme-xs focus:border-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Cabang Terkait --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Berlaku di Cabang</label>
                <select wire:model="cabang_id"
                    class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm bg-white shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="">Semua Cabang (Global)</option>
                    @foreach ($cabangs as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                    @endforeach
                </select>
                @error('cabang_id')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tipe Pengunjung --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Pengunjung <span
                        class="text-red-500">*</span></label>
                <select wire:model="type"
                    class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm bg-white shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="public">Public (Semua Pengunjung)</option>
                    <option value="member">Member (Hanya Terdaftar)</option>
                </select>
                @error('type')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tipe Potongan --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Potongan Diskon <span
                        class="text-red-500">*</span></label>
                <select wire:model.live="discount_type"
                    class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm bg-white shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="percentage">Persentase (%)</option>
                    <option value="flat">Nominal Tetap (Rupiah)</option>
                </select>
                @error('discount_type')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Nilai Potongan --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nilai Potongan <span
                        class="text-red-500">*</span></label>
                <div class="relative">
                    <span
                        class="absolute top-1/2 {{ $discount_type === 'percentage' ? 'right-4' : 'left-4' }} -translate-y-1/2 text-sm text-gray-400 font-medium">
                        {{ $discount_type === 'percentage' ? '%' : 'Rp' }}
                    </span>
                    <input type="number" step="any" wire:model="discount_value"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white {{ $discount_type === 'flat' ? 'pl-11' : '' }}" />
                </div>
                @error('discount_value')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Batas Maksimal Diskon (Hanya muncul jika tipenya percentage) --}}
            @if ($discount_type === 'percentage')
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Maksimal Potongan Diskon
                        (Optional)</label>
                    <div class="relative">
                        <span
                            class="absolute top-1/2 left-4 -translate-y-1/2 text-sm text-gray-400 font-medium">Rp</span>
                        <input type="number" step="any" wire:model="max_discount"
                            placeholder="Kosongkan jika tidak dibatasi"
                            class="h-11 w-full rounded-lg border border-gray-300 pl-11 pr-4 text-sm shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                    </div>
                    @error('max_discount')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            {{-- Minimal Subtotal Belanja --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Minimal Belanja (Subtotal)</label>
                <div class="relative">
                    <span class="absolute top-1/2 left-4 -translate-y-1/2 text-sm text-gray-400 font-medium">Rp</span>
                    <input type="number" step="any" wire:model="min_subtotal"
                        class="h-11 w-full rounded-lg border border-gray-300 pl-11 pr-4 text-sm shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                </div>
                @error('min_subtotal')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Metode Pembayaran --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran Khusus
                    (Optional)</label>
                <select wire:model="payment_method"
                    class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm bg-white shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="">Semua Metode Pembayaran</option>
                    <option value="CASH">Cash</option>
                    <option value="CARD">Card</option>
                    <option value="QRIS">QRIS</option>
                </select>
                @error('payment_method')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tanggal Mulai --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai Berlaku</label>
                <input type="datetime-local" wire:model="start_date"
                    class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('start_date')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tanggal Selesai --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Berakhir</label>
                <input type="datetime-local" wire:model="end_date"
                    class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm shadow-theme-xs focus:border-brand-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                @error('end_date')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Status Keaktifan --}}
            <div class="space-y-2 col-span-1 md:col-span-2 pt-2">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" wire:model="is_active"
                        class="h-5 w-5 rounded border-gray-300 text-brand-500 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900" />
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktifkan Master Promosi
                        Sekarang</span>
                </label>
                @error('is_active')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-6 dark:border-gray-800">
            <a href="{{ route('promotions.index') }}" wire:navigate
                class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-5 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                Batal
            </a>
            <button type="submit"
                class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-6 text-sm font-semibold text-white transition">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Promosi' }}
            </button>
        </div>
    </form>
</div>
