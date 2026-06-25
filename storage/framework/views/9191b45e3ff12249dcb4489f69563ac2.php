<div x-data x-show="$store.sidebar.isEsbModalOpen" 
     class="fixed inset-0 z-[50000]" 
     x-cloak>

    <div @click="$store.sidebar.isEsbModalOpen = false" 
         x-show="$store.sidebar.isEsbModalOpen" 
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/20 z-[49999]">
    </div>

    <div class="fixed top-0 right-0 h-full w-full max-w-2xl bg-white dark:bg-gray-900 shadow-2xl p-6 transform transition-transform duration-300 z-[50000] border-l border-gray-200 dark:border-gray-800 flex flex-col"
         x-show="$store.sidebar.isEsbModalOpen"
         x-transition:enter="transition-transform ease-out duration-300" 
         x-transition:enter-start="translate-x-full" 
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition-transform ease-in duration-300" 
         x-transition:leave-start="translate-x-0" 
         x-transition:leave-end="translate-x-full">
        
        <div class="flex justify-between items-center mb-6 border-b pb-4 dark:border-gray-700">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                <i class="bi bi-receipt"></i> ESB Order Report
            </h2>
            <button @click="$store.sidebar.isEsbModalOpen = false" class="text-gray-500 hover:text-gray-800 dark:text-gray-400">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto">
            <div class="flex gap-6 border-b border-gray-200 dark:border-gray-700 mb-6">
                <button class="pb-3 border-b-2 border-blue-600 text-sm font-semibold text-blue-600">Full Service</button>
                <button class="pb-3 text-sm text-gray-500 hover:text-gray-700">Quick Service</button>
            </div>

            <div class="grid grid-cols-6 gap-2 text-[10px] font-bold text-gray-400 uppercase py-2 border-b">
                <div class="col-span-1">Bill #</div>
                <div class="col-span-1">Date</div>
                <div class="col-span-1">ESB #</div>
                <div class="col-span-1">Table</div>
                <div class="col-span-2 text-right">Payment</div>
            </div>
            
            <div class="py-10 text-center text-gray-400 text-sm italic">
                No Data Available
            </div>
        </div>

        <div class="border-t pt-4 mt-4">
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg text-sm font-semibold transition">
                <i class="bi bi-arrow-repeat"></i> SYNC USER
            </button>
        </div>
    </div>
</div><?php /**PATH D:\POS PROJECT FINAL\pos-project\resources\views/livewire/transactions/esb-order-modal.blade.php ENDPATH**/ ?>