<div class="mb-8 col-span-10">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold text-gray-800 dark:text-white">ESB Order Dashboard</h3>
        <span class="text-xs text-gray-500">Last Fetch: {{ now()->format('d-m-Y H:i') }}</span>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-6 items-end">
        <div class="col-span-1">
            <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Order Time</label>
            <input type="text" class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800" placeholder="13-05-2026 - 13-05-2026">
        </div>

        <div class="col-span-1">
            <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Branch</label>
            <select class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800">
                <option>- All -</option>
            </select>
        </div>

        <div class="col-span-1 lg:col-span-2">
            <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Filter</label>
            <input type="text" class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm" placeholder="Search list by order number, name, phone number, or address">
        </div>

        <div class="col-span-1">
            <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Payment Status</label>
            <select class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800">
                <option>- All -</option>
            </select>
        </div>

        <div class="col-span-1">
            <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Status</label>
            <select class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm dark:border-gray-700 dark:bg-gray-800">
                <option>New</option>
            </select>
        </div>
    </div>
</div>