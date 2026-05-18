<?php

namespace App\Livewire\Layouts;

use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Sidebar extends Component
{
    public $menuGroups = [];
    public $canAccessPos = false;

    public function mount()
    {
        // Pindahkan logika pengisian menu kamu ke sini
        // Saya buatkan contoh strukturnya, isi sesuai menu asli kamu:
        $this->menuGroups = config('menu'); // atau ambil dari tempat kamu menyimpan data menu
        $this->canAccessPos = auth()->user()?->can('pos.access') ?? false;
    }

    public function processEndShift(): void
    {
        $user = auth()->user();
        $now = now();

        $items = TransactionItem::query()
            ->whereHas('transaction', function ($q) {
                $q->whereDate('created_at', now()->today())
                    ->whereIn('payment_status', ['paid', 'settlement'])
                    ->whereNull('voided_at');
            })
            ->select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->with('product:id,name')
            ->groupBy('product_id')
            ->get()
            ->map(fn($item) => [
                'name' => $item->product?->name ?? 'Produk Terhapus',
                'total_qty' => (int) $item->total_qty
            ]);

        $reportData = [
            'cashier_name' => $user->name,
            'open_time'    => $now->startOfDay()->format('d-m-Y H:i'),
            'close_time'   => $now->format('d-m-Y H:i'),
            'items'        => $items->toArray(),
            'total_all_qty' => $items->sum('total_qty'),
        ];

        // Dispatch event ke browser
        $this->dispatch('doPrintEndShift', $reportData);
    }

    public function render(): View
    {
        // Arahkan ke file blade sidebar kamu
        return view('layouts.sidebar');
    }
}
