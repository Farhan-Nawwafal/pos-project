<?php

namespace App\Livewire\Promotions;

use App\Models\Promotion;
use Livewire\Component;
use Livewire\WithPagination;

class PromotionsPage extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public int $daysBeforeExpiry = 7;
    public int $quotaThreshold = 5;

    public function mount()
    {
        // Proteksi Lapis Kedua: Jika kasir coba tembak URL, langsung blokir
        abort_if(!auth()->user()->can('promotions.view'), 403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $now = now();

        $promotions = Promotion::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->status, function ($q) use ($now) {
                if ($this->status === 'active') {
                    $q->where('is_active', true);
                } elseif ($this->status === 'inactive') {
                    $q->where('is_active', false);
                } elseif ($this->status === 'running') {
                    $q->where('is_active', true)
                        ->where(fn($sub) => $sub->whereNull('start_date')->orWhere('start_date', '<=', $now))
                        ->where(fn($sub) => $sub->whereNull('end_date')->orWhere('end_date', '>=', $now));
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $allPromotions = Promotion::query()->get();

        return view('components.promotions.promotions-page', [
            'promotions' => $promotions,
            'allPromotions' => $allPromotions,
        ])->layout('layouts.app');
    }
}
