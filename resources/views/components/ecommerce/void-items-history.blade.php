@props(['items' => []])

<!-- BUAT MODAL SALES RECAPITULATION NITIP DISINI DULU -->
@include('components.pos-modal')

<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    
    <!-- Bagian Header Judul Card (Tetap diam di luar area scroll) -->
    <div class="flex items-center justify-between px-4 pt-4 pb-2 sm:px-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Riwayat Item Void</h3>
        <span class="rounded-full bg-error-50 px-2 py-0.5 text-[10px] font-bold text-error-600 dark:bg-error-500/15">SENSITIF</span>
    </div>

    <!-- Tempat Tombol Modal (Jika ingin tetap kelihatan, taruh di luar scroll) -->
    <div class="px-4 pb-2 sm:px-6">
        <button onclick="window.dispatchEvent(new Event('open-pos-modal'))" class="text-xs bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:text-white px-3 py-1.5 rounded border border-gray-300 dark:border-gray-700 ">
            Buka Modal
        </button>
    </div>

    <!-- Area Khusus Scroll Tabel (Hanya tabel yang akan bergeser ke bawah) -->
    <div class="overflow-y-auto max-h-50 px-4 pb-3 sm:px-6 custom-scrollbar">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="border-t border-gray-100 dark:border-gray-800">
                    <!-- KUNCI: Ditambahkan sticky, top-0, z-10, dan bg-white/bg-dark agar data tertutup saat scroll ke atas -->
                    <th class="sticky top-0 z-10 bg-white dark:bg-[#121212] py-3 text-left">
                        <p class="font-bold text-gray-500 text-theme-xs dark:text-gray-400">Produk</p>
                    </th>
                    <th class="sticky top-0 z-10 bg-white dark:bg-[#121212] py-3 text-left">
                        <p class="font-bold text-gray-500 text-theme-xs dark:text-gray-400">Alasan</p>
                    </th>
                    <th class="sticky top-0 z-10 bg-white dark:bg-[#121212] py-3 text-left">
                        <p class="font-bold text-gray-500 text-theme-xs dark:text-gray-400">Oleh</p>
                    </th>
                    <th class="sticky top-0 z-10 bg-white dark:bg-[#121212] py-3 text-right">
                        <p class="font-bold text-gray-500 text-theme-xs dark:text-gray-400">Waktu</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50/50 dark:hover:bg-gray-900/20 transition-colors">
                        <td class="py-3 whitespace-nowrap">
                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                {{ $item['product_name'] }}
                            </p>
                            <p class="text-gray-500 text-[10px]">{{ $item['code'] }} · {{ $item['variant'] }}</p>
                        </td>
                        <td class="py-3">
                            <p class="text-gray-600 text-theme-xs dark:text-gray-400 italic">"{{ $item['reason'] }}"</p>
                        </td>
                        <td class="py-3 whitespace-nowrap">
                            <p class="text-gray-700 text-theme-sm dark:text-gray-300">{{ $item['actor'] }}</p>
                        </td>
                        <td class="py-3 text-right whitespace-nowrap">
                            <p class="text-gray-500 text-theme-xs dark:text-gray-400">{{ $item['created_at'] }}</p>
                        </td>
                    </tr>
                @empty
                    <tr class="border-t border-gray-100 dark:border-gray-800">
                        <td colspan="4" class="py-6">
                            <p class="text-center text-theme-sm text-gray-500 dark:text-gray-400">Tidak ada penghapusan item.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>