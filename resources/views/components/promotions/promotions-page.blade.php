<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white/90">Promotions</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola program promosi cabang, tipe potongan, dan pantau
                masa aktifnya.</p>
        </div>
        <div class="flex items-center gap-2">
            @can('promotions.manage')
                <a href="{{ route('promotions.create') }}" wire:navigate
                    class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                    Buat Promosi
                </a>
            @endcan
        </div>
    </div>

    {{-- Search & Filter Section --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
        <div class="relative flex-1 sm:flex-none">
            <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z" />
                </svg>
            </span>
            <input wire:model.live.debounce.400ms="search" type="text" placeholder="Cari promosi..."
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden sm:w-[320px] sm:min-w-[320px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
        </div>

        <select wire:model.live="status"
            class="shadow-theme-xs h-11 rounded-lg border border-gray-300 bg-white px-4 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
            <option value="">Semua Status</option>
            <option value="running">Sedang Berjalan</option>
            <option value="active">Master Aktif</option>
            <option value="inactive">Master Nonaktif</option>
        </select>
    </div>

    {{-- Logika Summary Card Dinamis --}}
    @php
        $now = now();
        $countRunning = 0;
        $countPublic = 0;
        $countMember = 0;

        foreach ($allPromotions as $p) {
            $isRunning =
                (bool) $p->is_active &&
                (!$p->start_date || $p->start_date->lte($now)) &&
                (!$p->end_date || $p->end_date->gte($now));

            if ($isRunning) {
                $countRunning++;
            }
            if ($p->type === 'public') {
                $countPublic++;
            }
            if ($p->type === 'member') {
                $countMember++;
            }
        }
    @endphp

    {{-- Summary Cards Grid --}}
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-xs text-gray-500 dark:text-gray-400">Total Promosi</p>
            <p class="mt-1 text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ number_format($allPromotions->count(), 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-xs text-gray-500 dark:text-gray-400">Sedang Berjalan</p>
            <p class="mt-1 text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ number_format($countRunning, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-xs text-gray-500 dark:text-gray-400">Tipe Public</p>
            <p class="mt-1 text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ number_format($countPublic, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <p class="text-xs text-gray-500 dark:text-gray-400">Tipe Member</p>
            <p class="mt-1 text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ number_format($countMember, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Data Table Section --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="custom-scrollbar overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama
                            Promosi</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tipe
                            Pengunjung</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Masa
                            Berlaku</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Aturan
                            Belanja</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Potongan
                            Diskon</th>
                        <th class="px-5 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Metode
                            Bayar</th>
                        @can('promotions.manage')
                            <th class="px-5 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($promotions as $p)
                        @php
                            $isRunning =
                                (bool) $p->is_active &&
                                (!$p->start_date || $p->start_date->lte($now)) &&
                                (!$p->end_date || $p->end_date->gte($now));
                        @endphp
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.01] transition-colors">
                            <td class="px-5 py-4">
                                <div class="space-y-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $p->name }}
                                    </p>
                                    <span
                                        class="inline-flex rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $isRunning ? 'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' }}">
                                        {{ $isRunning ? 'Sedang Berjalan' : ($p->is_active ? 'Aktif (Menunggu)' : 'Nonaktif') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">
                                <span
                                    class="rounded-sm px-2 py-0.5 text-xs font-medium {{ $p->type === 'public' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($p->type) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">
                                <div class="text-xs space-y-0.5">
                                    <p><span class="text-gray-400">Mulai:</span>
                                        {{ $p->start_date ? $p->start_date->format('d M Y H:i') : '-' }}</p>
                                    <p><span class="text-gray-400">Selesai:</span>
                                        {{ $p->end_date ? $p->end_date->format('d M Y H:i') : '-' }}</p>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">
                                <p class="text-xs">Min. Belanja: <span class="font-medium">Rp
                                        {{ number_format($p->min_subtotal, 0, ',', '.') }}</span></p>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90 font-medium">
                                {{ $p->discount_label }}
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $p->payment_method ?? 'Semua Metode' }}
                            </td>
                            @can('promotions.manage')
                                <td class="px-5 py-4 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('promotions.edit', ['promotion' => $p->id]) }}" wire:navigate
                                            class="shadow-theme-xs inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                            Ubah
                                        </a>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <x-common.empty-table-row colspan="7" message="Belum ada data promosi tersedia." />
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
            {{ $promotions->links('livewire.pagination.admin') }}
        </div>
    </div>
</div>
