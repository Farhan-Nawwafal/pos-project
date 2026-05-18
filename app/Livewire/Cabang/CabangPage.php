<?php

namespace App\Livewire\Cabang;

use App\Models\Cabang;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Request;

class CabangPage extends Component
{
    use WithPagination;

    public $name, $address, $isActive = false;

    public $editingId, $editingName, $editingAddress, $editingIsActive;

    public $createModalOpen = false;
    public $editModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'nullable|string',
        'isActive' => 'boolean',
    ];

    public function render()
    {
        return view('livewire.cabang.cabang-page', [
            'cabang' => Cabang::latest()->paginate(10)
        ]);
    }

    public function openCreateModal()
    {
        $this->reset(['name', 'address', 'isActive']);
        $this->isActive = true;
        $this->createModalOpen = true;
    }

    public function closeCreateModal()
    {
        $this->createModalOpen = false;
    }

    public function createCabang()
    {
        $this->validate();
        $isActive = $this->isActive ? 'active' : 'inactive';

        Cabang::create([
            'name' => $this->name,
            'address' => $this->address,
            'is_active' => $isActive,
        ]);

        $this->closeCreateModal();
        $this->dispatch('toast', type: 'success', message: 'Cabang berhasil ditambahkan.');
    }

    public function startEdit($id)
    {
        $cabang = Cabang::findOrFail($id);

        $this->editingId = $cabang->id;
        $this->editingName = $cabang->name;
        $this->editingAddress = $cabang->address;
        $this->editingIsActive = $cabang->is_active;

        $this->editModalOpen = true;
    }

    public function closeEditModal()
    {
        $this->editModalOpen = false;
    }

    public function updateCabang()
    {
        $this->validate([
            'editingName' => 'required|string|max:255',
            'editingAddress' => 'nullable|string',
            'editingIsActive' => 'boolean',
        ]);

        $cabang = Cabang::find($this->editingId);

        if (!$cabang) {
            $this->dispatch('toast', type: 'error', message: 'Cabang tidak ditemukan.');
            return;
        }

        $cabang->update([
            'name' => $this->editingName,
            'address' => $this->editingAddress,
            'is_active' => $this->editingIsActive ? 'active' : 'inactive',
        ]);

        $this->closeEditModal();
        $this->dispatch('toast', type: 'success', message: 'Konversi berhasil ditambahkan.');
    }

    public function deleteCabang($id)
    {
        Cabang::findOrFail($id)->delete();

        $this->dispatch('toast', type: 'success', message: 'Cabang berhasil dihapus.');
    }
}
