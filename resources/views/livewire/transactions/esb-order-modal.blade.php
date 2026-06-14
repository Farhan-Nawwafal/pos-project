<div x-data="{ showEsbModal: false }" 
     x-init="window.showEsbModal = showEsbModal; $watch('showEsbModal', value => showEsbModal = value)"
     x-show="showEsbModal"
     class="fixed inset-0 z-[9999]" 
     x-cloak>

    <div @click="showEsbModal = false" class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="fixed top-0 right-0 h-full w-3/4 bg-white shadow-2xl p-6 overflow-y-auto transform transition-transform duration-300"
         :class="showEsbModal ? 'translate-x-0' : 'translate-x-full'">
        
        <h2 class="text-xl font-bold mb-4">ESB Order Report</h2>
        
        <button @click="showEsbModal = false" class="btn btn-error">Close</button>
    </div>
</div>