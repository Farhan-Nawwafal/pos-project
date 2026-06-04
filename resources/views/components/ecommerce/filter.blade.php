<div class="mb-8 w-full">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold text-gray-800 dark:text-white">ESB Order Dashboard</h3>
        <span class="text-xs text-gray-500">Last Fetch: {{ now()->format('d-m-Y H:i') }}</span>
    </div>

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

        <div class="col-span-5 grid grid-cols-1">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Filter</label>
            <input type="text" class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs" placeholder="Search...">
        </div>

        <div class="col-span-3 grid grid-cols-4 gap-1">
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
                <label class="block text-xs font-semibold text-gray-500 mb-1 ">Sync</label>
                <select class="w-full rounded-md border border-gray-300 bg-white p-1.5 text-xs">
                    <option>New</option>
                </select>
            </div>
        </div>
    </div>
</div>