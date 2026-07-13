@props(['cancelledTables' => []])

<div
    class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 mt-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Riwayat Cancel Table</h3>
        <span
            class="rounded-full bg-red-50 px-2 py-0.5 text-[10px] font-bold text-red-600 dark:bg-red-500/15">VOID PENUH</span>
    </div>

    <div class="max-w-full overflow-x-auto custom-scrollbar">
        <table class="min-w-full">
            <thead>
                <tr class="border-t border-gray-100 dark:border-gray-800">
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Waktu</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kasir</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No. Transaksi</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No. Meja</p>
                    </th>
                    <th class="py-3 text-left pr-4">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Disetujui Oleh</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Alasan</p>
                    </th>
                    <th class="py-3 text-right">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Total Bill</p>
                    </th>
                    <th class="py-3 text-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Detail</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($cancelledTables as $row)
                    <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="text-gray-600 text-theme-xs dark:text-gray-400">
                                {{ $row['voided_at'] }}
                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                {{ $row['cashier'] }}
                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="font-mono text-xs text-gray-700 dark:text-gray-300">
                                {{ $row['transaction_code'] }}
                            </p>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <span
                                class="inline-flex items-center gap-1 rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-700 dark:bg-red-500/10 dark:text-red-400">
                                {{ $row['table_number'] ?? 'Quick Service' }}
                            </span>
                        </td>
                        <td class="py-3 pr-4 whitespace-nowrap">
                            <p class="text-gray-700 text-theme-xs dark:text-gray-300">
                                {{ $row['approved_by'] ?? '-' }}
                            </p>
                        </td>
                        <td class="py-3 pr-4">
                            <p class="text-gray-600 text-theme-xs dark:text-gray-400 italic max-w-[200px] truncate"
                                title="{{ $row['void_reason'] }}">
                                "{{ $row['void_reason'] }}"
                            </p>
                        </td>
                        <td class="py-3 text-right whitespace-nowrap">
                            <p class="font-semibold text-gray-800 text-theme-sm dark:text-white/90">
                                Rp{{ number_format($row['total'], 0, ',', '.') }}
                            </p>
                        </td>
                        <td class="py-3 text-center">
                            <button
                                onclick="openCancelTableDetail({{ json_encode($row) }})"
                                class="inline-flex items-center gap-1 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="border-t border-gray-100 dark:border-gray-800">
                        <td colspan="8" class="py-6">
                            <p class="text-center text-theme-sm text-gray-500 dark:text-gray-400">
                                Tidak ada cancel table dalam periode ini.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL DETAIL CANCEL TABLE --}}
<div id="cancel-table-detail-modal"
    class="fixed inset-0 z-[200000] hidden items-center justify-center p-4">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        onclick="closeCancelTableDetail()"></div>

    {{-- Box Modal --}}
    <div
        class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-900 border border-gray-200 dark:border-gray-800 animate-in fade-in zoom-in-95 duration-150">

        {{-- Header --}}
        <div class="flex items-center justify-between bg-[#DD4B39] px-5 py-4">
            <div>
                <h3 class="text-base font-bold text-white tracking-wide">Detail Cancel Table</h3>
                <p id="modal-transaction-code" class="text-red-100 text-xs mt-0.5 font-mono"></p>
            </div>
            <button onclick="closeCancelTableDetail()"
                class="text-white/70 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Info Baris --}}
        <div class="grid grid-cols-2 gap-3 px-5 py-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">No. Meja</p>
                <p id="modal-table-number" class="text-sm font-bold text-gray-800 dark:text-white mt-0.5"></p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Waktu Void</p>
                <p id="modal-voided-at" class="text-sm text-gray-700 dark:text-gray-300 mt-0.5"></p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kasir</p>
                <p id="modal-cashier" class="text-sm text-gray-700 dark:text-gray-300 mt-0.5"></p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Disetujui Oleh</p>
                <p id="modal-approved-by" class="text-sm text-gray-700 dark:text-gray-300 mt-0.5"></p>
            </div>
            <div class="col-span-2">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Alasan Pembatalan</p>
                <p id="modal-void-reason"
                    class="text-sm text-red-600 dark:text-red-400 italic mt-0.5"></p>
            </div>
        </div>

        {{-- List Item --}}
        <div class="px-5 py-3">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3">Item yang di-void</p>
            <div id="modal-items-list" class="space-y-2 max-h-[240px] overflow-y-auto custom-scrollbar pr-1">
                {{-- Diisi via JS --}}
            </div>
        </div>

        {{-- Footer Total --}}
        <div class="flex items-center justify-between px-5 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <p class="text-sm font-bold text-gray-700 dark:text-gray-300">Total Bill</p>
            <p id="modal-total"
                class="text-xl font-black text-[#DD4B39]"></p>
        </div>
    </div>
</div>

<script>
    function openCancelTableDetail(data) {
        const modal = document.getElementById('cancel-table-detail-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Isi data header
        document.getElementById('modal-transaction-code').textContent = data.transaction_code ?? '-';
        document.getElementById('modal-table-number').textContent = data.table_number ?? 'Quick Service';
        document.getElementById('modal-voided-at').textContent = data.voided_at ?? '-';
        document.getElementById('modal-cashier').textContent = data.cashier ?? '-';
        document.getElementById('modal-approved-by').textContent = data.approved_by ?? '-';
        document.getElementById('modal-void-reason').textContent = '"' + (data.void_reason ?? '-') + '"';
        document.getElementById('modal-total').textContent =
            'Rp' + Number(data.total).toLocaleString('id-ID');

        // Render item list
        const itemsList = document.getElementById('modal-items-list');
        itemsList.innerHTML = '';

        const items = data.items ?? [];
        if (items.length === 0) {
            itemsList.innerHTML =
                '<p class="text-xs text-gray-400 italic text-center py-4">Tidak ada data item.</p>';
            return;
        }

        items.forEach(function(item) {
            const subtotal = item.qty * item.price;
            const el = document.createElement('div');
            el.className =
                'flex items-start justify-between gap-3 p-2.5 rounded-lg bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700';
            el.innerHTML = `
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-semibold text-gray-800 dark:text-white truncate">${item.name}</p>
                    <p class="text-[10px] text-gray-500 mt-0.5">
                        ${item.qty}x &nbsp;@&nbsp;Rp${Number(item.price).toLocaleString('id-ID')}
                    </p>
                </div>
                <p class="text-xs font-bold text-gray-800 dark:text-white whitespace-nowrap">
                    Rp${Number(subtotal).toLocaleString('id-ID')}
                </p>
            `;
            itemsList.appendChild(el);
        });
    }

    function closeCancelTableDetail() {
        const modal = document.getElementById('cancel-table-detail-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
