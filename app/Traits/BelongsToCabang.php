<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToCabang
{
    /**
     * Boot trait ini otomatis saat Model dipanggil.
     */
    protected static function bootBelongsToCabang(): void
    {
        // 1. OTOMATIS FILTER: Saat ambil data (Select)
        static::addGlobalScope('cabang', function (Builder $builder) {
            if (auth()->check()) {
                // Hanya ambil data yang cabang_id-nya sama dengan user login
                $builder->where('cabang_id', auth()->user()->cabang_id);
            }
        });

        // 2. OTOMATIS ISI: Saat simpan data baru (Insert)
        static::creating(function ($model) {
            if (auth()->check() && !$model->cabang_id) {
                // Otomatis isi cabang_id sesuai user login jika belum diisi
                $model->cabang_id = auth()->user()->cabang_id;
            }
        });
    }
}
