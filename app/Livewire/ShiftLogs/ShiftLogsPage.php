<?php

namespace App\Livewire\ShiftLogs;

use Livewire\Component;
// use App\Models\ShiftLog; // Pastikan model ini sudah ada nantinya

class ShiftLogsPage extends Component
{
    // 1. PUBLIC PROPERTY (Mirip 'State')
    // Variabel ini akan menampung apa yang diketik user di kolom pencarian
    public $search = '';

    // 2. ACTIONS / METHOD
    // Contoh fungsi yang bisa dipanggil langsung dari tombol HTML
    public function bersihkanPencarian()
    {
        $this->search = '';
    }

    public function render()
    {
        // 3. AMBIL DATA (Logika Controller masuk ke sini)
        // Ini contoh query sederhana. Akan otomatis memfilter setiap kali $search berubah.

        /* $dataShift = ShiftLog::where('cashier_name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->get(); 
        */

        // Karena kita belum tahu isi database-nya, kita pakai data dummy dulu untuk testing:
        $dataShift = [
            ['id' => 1, 'cashier_name' => 'Faishal', 'status' => 'Closed', 'total' => 1500000],
            ['id' => 2, 'cashier_name' => 'Budi', 'status' => 'Open', 'total' => 500000],
        ];

        // Kirim data ke view (persis seperti Controller biasa)
        return view('livewire.shift-logs.index', [
            'shiftLogs' => $dataShift
        ]);
    }
}
