<div class="w-full bg-gray-200 mb-8">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <h3 class="text-lg font-bold text-gray-500">ESB Order Dashboard</h3>
        <span class="text-xs text-gray-500">Last Fetch: <?php echo e(now()->format('d-m-Y H:i')); ?></span>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 mb-8">
    <div class="grid grid-cols-12 gap-4 items-end">
        
        <div class="col-span-2">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Order Time</label>
            <input type="text" class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs" placeholder="13-05-2026 - 13-05-2026">
        </div>

        <div class="col-span-2">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Branch</label>
            <select class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs">
                <option>- All -</option>
            </select>
        </div>

        <div class="col-span-5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Filter</label>
            <input type="text" class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs" placeholder="Search...">
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
</div><?php /**PATH D:\farhan\project-freelance\pos-restoran-v2\resources\views/components/ecommerce/filter.blade.php ENDPATH**/ ?>