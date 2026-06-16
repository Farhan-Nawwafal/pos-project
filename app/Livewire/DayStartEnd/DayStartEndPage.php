<?php

namespace App\Livewire\DayStartEnd; // Sesuaikan dengan nama folder Anda

use Livewire\Component;

class DayStartEndPage extends Component
{
    // 1. Deklarasikan variabel yang ada di wire:model pada UI
    public $starting_cash = 0;
    public $date_in;
    public $time_in;
    public $remarks;

    // 2. (Opsional) Isi nilai default saat halaman dimuat
    public function mount()
    {
        $this->date_in = date('Y-m-d'); // Otomatis tanggal hari ini
        $this->time_in = date('H:i');   // Otomatis jam saat ini
    }

    // 3. Fungsi yang akan dijalankan saat tombol diklik
    public function submitDayStart()
    {
        // Contoh validasi (pastikan uang berupa angka, dll)
        $this->validate([
            'starting_cash' => 'required|numeric',
            'date_in'       => 'required|date',
            'time_in'       => 'required',
        ]);

        // --- Nanti Anda bisa memasukkan logika simpan ke Database di sini ---
        // Contoh: Shift::create([...]);

        // Beri pesan sukses dan arahkan ke halaman transaksi/dashboard
        session()->flash('success', 'Berhasil melakukan Day Start!');
        return redirect()->route('transactions.index');
    }

    public function render()
    {
        // 4. KUNCI PENTING: Arahkan ke folder components
        return view('components.day-start-end.day-start-end-page');
    }
}