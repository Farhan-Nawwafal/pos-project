<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['timeFilter' => 'today', 'orderTimeRange' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['timeFilter' => 'today', 'orderTimeRange' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="w-full bg-gray-200 mb-4">
    <div class="max-w-7xl  px-2 py-3 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-black">ESB Order Dashboard</h3>
        <span class="text-xs text-gray-500 ml-4">Last Fetch: <?php echo e(now()->format('d-m-Y H:i')); ?></span>
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

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($timeFilter === 'custom'): ?>
            <div class="col-span-2 animate-fade-in" wire:ignore>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Rentang Tanggal</label>
                <input type="text" id="dashboard-flatpickr-range" wire:model.live="orderTimeRange"
                    class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs text-gray-700 font-medium"
                    placeholder="Pilih Tanggal atau Range...">
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
            <?php
        $__assetKey = '2629368537-0';

        ob_start();
    ?>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <?php
        $__output = ob_get_clean();

        // If the asset has already been loaded anywhere during this request, skip it...
        if (in_array($__assetKey, \Livewire\Features\SupportScriptsAndAssets\SupportScriptsAndAssets::$alreadyRunAssetKeys)) {
            // Skip it...
        } else {
            \Livewire\Features\SupportScriptsAndAssets\SupportScriptsAndAssets::$alreadyRunAssetKeys[] = $__assetKey;

            // Check if we're in a Livewire component or not and store the asset accordingly...
            if (isset($this)) {
                \Livewire\store($this)->push('assets', $__output, $__assetKey);
            } else {
                \Livewire\Features\SupportScriptsAndAssets\SupportScriptsAndAssets::$nonLivewireAssets[$__assetKey] = $__output;
            }
        }
    ?>

        <div class="col-span-2">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Branch</label>
            <select class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs">
                <option>- All -</option>
            </select>
        </div>

        

        <div class="<?php echo e($timeFilter === 'custom' ? 'col-span-3' : 'col-span-5'); ?> transition-all duration-200">
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
    <?php
        $__scriptKey = '2629368537-1';
        ob_start();
    ?>
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
    <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
<?php /**PATH D:\Shaall\PROJECT\pos-project\resources\views/components/ecommerce/filter.blade.php ENDPATH**/ ?>