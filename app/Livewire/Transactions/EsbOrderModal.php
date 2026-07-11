<?php

namespace App\Livewire\Transaction;

use Livewire\Component;

class EsbOrderModal extends Component
{
    // Agar property @props(['transactions' => []]) dari kodenmu tidak error,
    // kita definisikan variabel penampungnya di sini
    public array $transactions = [];

    public function render()
    {
        return view('livewire.transactions.esb-order-modal');
    }
}
