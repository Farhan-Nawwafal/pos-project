    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Halaman Shift Log</h1>

        <div class="mb-6 flex gap-2">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Cari nama kasir..."
                class="border border-gray-300 rounded-lg px-4 py-2 w-full max-w-md dark:bg-gray-800 dark:border-gray-700">

            <button
                wire:click="bersihkanPencarian"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                Reset
            </button>
        </div>

        <p class="mb-4 text-sm text-gray-500">Anda sedang mencari: <strong class="text-brand-500">{{ $search }}</strong></p>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4">ID Shift</th>
                        <th class="px-6 py-4">Nama Kasir</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($shiftLogs as $log)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">#{{ $log['id'] }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $log['cashier_name'] }}</td>
                        <td class="px-6 py-4">{{ $log['status'] }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($log['total'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>