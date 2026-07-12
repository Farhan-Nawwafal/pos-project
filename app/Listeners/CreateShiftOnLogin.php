<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Shift;
use Carbon\Carbon;

class CreateShiftOnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        // Pastikan user memiliki cabang_id sebelum membuat shift
        if (!$user->cabang_id) {
            return;
        }

        // Cek apakah sudah ada shift yang statusnya masih 'open' untuk cabang ini
        // Ini penting agar jika user logout lalu login lagi, shift tidak dobel
        $existingShift = Shift::where('cabang_id', $user->cabang_id)
            ->where('status', 'open')
            ->first();

        // Jika belum ada shift yang buka, kita buat data shift baru
        if (!$existingShift) {
            Shift::create([
                'cabang_id'          => $user->cabang_id,
                'started_by_user_id' => $user->id,
                'started_at'         => Carbon::now(),
                'starting_cash'      => 0, // Sesuai permintaan default 0
                'status'             => 'open', // Mengikuti kondisi query di Livewire
            ]);
        }
    }
}