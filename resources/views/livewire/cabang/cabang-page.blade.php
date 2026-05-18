<div class="p-6 space-y-6">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Create Modal --}}
    @if ($createModalOpen)
        <div class="fixed inset-0 z-[100000] flex items-center justify-center p-4" aria-modal="true" role="dialog">

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/50" wire:click="closeCreateModal"></div>

            {{-- Modal --}}
            <div
                class="relative w-full max-w-lg overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                            Tambah Cabang
                        </h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Tambahkan cabang baru untuk operasional bisnis Anda.
                        </p>
                    </div>
                    <button type="button" wire:click="closeCreateModal"
                        class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        Tutup
                    </button>
                </div>

                {{-- Form --}}
                <form wire:submit="createCabang" class="space-y-4 p-5">

                    {{-- Nama Cabang --}}
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">
                            Nama Cabang
                        </label>
                        <input wire:model.live="name" type="text"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            placeholder="Contoh: Cabang Jakarta" />
                        <x-common.input-error for="name" />
                    </div>

                    {{-- (Optional) Alamat --}}
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">
                            Alamat (Opsional)
                        </label>
                        <textarea wire:model.live="address" rows="3"
                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            placeholder="Alamat cabang..."></textarea>
                        <x-common.input-error for="address" />
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center">
                        <input wire:model.live="isActive" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500/20 dark:border-gray-700" />
                        <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                            Aktif
                        </label>
                    </div>

                    {{-- Action --}}
                    <div class="flex items-center justify-end gap-2">
                        <button type="button" wire:click="closeCreateModal"
                            class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                            Batal
                        </button>

                        <button type="submit"
                            class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif


    {{-- Modal Edit Cabang --}}
    @if ($editModalOpen)
        <div class="fixed inset-0 z-[100000] flex items-center justify-center p-4" aria-modal="true" role="dialog">

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/50" wire:click="closeEditModal"></div>

            {{-- Modal --}}
            <div
                class="relative w-full max-w-lg overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                            Edit Cabang
                        </h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Perbarui informasi cabang.
                        </p>
                    </div>
                    <button type="button" wire:click="closeEditModal"
                        class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        Tutup
                    </button>
                </div>

                {{-- Form --}}
                <form wire:submit.prevent="updateCabang" class="space-y-4 p-5">

                    {{-- Nama Cabang --}}
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">
                            Nama Cabang
                        </label>
                        <input wire:model.live="editingName" type="text"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        <x-common.input-error for="editingName" />
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-400">
                            Alamat (Opsional)
                        </label>
                        <textarea wire:model.live="editingAddress" rows="3"
                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"></textarea>
                        <x-common.input-error for="editingAddress" />
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center">
                        <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <input wire:model.live="editingIsActive" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500/20 dark:border-gray-700" />
                            Aktif
                        </label>
                    </div>

                    {{-- Action --}}
                    <div class="flex items-center justify-end gap-2">
                        <button type="button" wire:click="closeEditModal"
                            class="shadow-theme-xs inline-flex h-11 items-center justify-center rounded-lg border border-gray-300 bg-white px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                            Batal
                        </button>

                        <button type="submit"
                            class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex h-11 items-center justify-center rounded-lg px-4 text-sm font-semibold text-white transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Kelola Cabang</h2>
        <button wire:click="openCreateModal"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow-sm">
            Tambah Cabang
        </button>
    </div>

    <div class="overflow-x-auto bg-white shadow-md sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        Cabang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($cabang as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $cabang->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $item->is_active === 'active' ? 'Aktif' : 'Nonaktif' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button wire:click="startEdit({{ $item->id }})"
                                class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button wire:click="deleteCabang({{ $item->id }})"
                                onclick="return confirm('Yakin hapus?')"
                                class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-lg">Belum ada cabang.
                            Tambah yang
                            pertama!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $cabang->links() }}
    </div>
</div>
