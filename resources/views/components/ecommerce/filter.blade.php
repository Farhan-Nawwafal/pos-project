@props(['timeFilter' => 'today', 'orderTimeRange' => ''])

<div class="w-full bg-gray-200 mb-4">
    <div class="max-w-7xl  px-2 py-3 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-black">ESB Order Dashboard</h3>
        <span class="text-xs text-gray-500 ml-4">Last Fetch: {{ now()->format('d-m-Y H:i') }}</span>
    </div>
</div>

<div class="max-w-7xl mx-auto mb-8">
    <div class="grid grid-cols-12 gap-4 items-end">

        <div class="col-span-2">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Order Time</label>
            <select wire:model.live="timeFilter"
                class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs font-medium text-gray-700">
                <option value="today">Hari Ini</option>
                <option value="7_days">7 Hari Terakhir</option>
                <option value="30_days">30 Hari Terakhir</option>
                <option value="this_month">Bulan Ini (1 Bulan)</option>
                <option value="3_months">3 Bulan Terakhir</option>
                <option value="6_months">6 Bulan Terakhir</option>
                <option value="1_year">1 Tahun Terakhir</option>
                <option value="custom">Kustom Tanggal...</option>
            </select>
        </div>

        {{-- Input Flatpickr Hanya Muncul Jika Opsi "custom" Dipilih --}}
        @if ($timeFilter === 'custom')
            <div class="col-span-2 animate-fade-in" wire:ignore>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Rentang Tanggal</label>
                <input type="text" id="dashboard-flatpickr-range" wire:model.live="orderTimeRange"
                    class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs text-gray-700 font-medium"
                    placeholder="Pilih Tanggal atau Range...">
            </div>
        @endif

        {{-- Tambahkan script inisialisasi Flatpickr tepat di bawah box div filternya --}}
        @assets
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @endassets

        <div class="col-span-2">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Branch</label>
            <select class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs">
                <option>- All -</option>
            </select>
        </div>

        {{-- <div class="col-span-5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Filter</label>
            <input type="text" class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs"
                placeholder="Search...">
        </div> --}}

        <div class="{{ $timeFilter === 'custom' ? 'col-span-3' : 'col-span-5' }} transition-all duration-200">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Filter</label>
            <input type="text" class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs"
                placeholder="Search...">
        </div>

        <div class="col-span-3 grid grid-cols-3 gap-2">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Payment</label>
                <select class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs">
                    <option>- All -</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                <select class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs">
                    <option>New</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Sync</label>
                <select class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs">
                    <option>New</option>
                </select>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        // Gunakan hook Livewire agar re-inisialisasi berjalan lancar saat elemen muncul/hilang
        $wire.on('init-flatpickr', () => {
            setTimeout(() => {
                const el = document.getElementById("dashboard-flatpickr-range");
                if (el) {
                    flatpickr(el, {
                        mode: "range",
                        dateFormat: "Y-m-d",
                        altInput: true,
                        altFormat: "d-m-Y",
                        maxDate: "today",
                        onChange: function(selectedDates, dateStr, instance) {
                            $wire.set('orderTimeRange', dateStr);
                        }
                    });
                }
            }, 50);
        });
    </script>
@endscript
