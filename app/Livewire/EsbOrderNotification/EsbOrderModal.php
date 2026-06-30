<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Transaction;

// Nama kelas tetap EsbOrderModal, namun pastikan render path-nya pas!
class EsbOrderModal extends Component
{
    public $rows = []; 

    public function mount()
    {
        // Di screenshot Anda sebelumnya memakai 'EsbOrder', di teks memakai 'Transaction'
        // Pastikan Anda memanggil Model yang BENAR dan memiliki data di database Anda.
        $this->rows = Transaction::latest()->limit(50)->get()->toArray();
    }

    public function getStatusClasses($statusKey)
    {
        return match($statusKey) {
            'paid' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function render()
    {
        // Jika file blade Anda ada di resources/views/livewire/transactions/esb-order-modal.blade.php
        return view('livewire.transactions.esb-order-modal');
    }
}