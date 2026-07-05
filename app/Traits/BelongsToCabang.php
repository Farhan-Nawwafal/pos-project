<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema; // pakai ketika nanti ada model yang tidak memiliki kolom cabang_id

trait BelongsToCabang
{
    /**
     * Boot trait ini otomatis saat Model dipanggil.
     */
    // protected static function bootBelongsToCabang(): void
    // {
    //     // 1. OTOMATIS FILTER: Saat ambil data (Select)
    //     static::addGlobalScope('cabang', function (Builder $builder) {
    //         if (auth()->check()) {
    //             // Hanya ambil data yang cabang_id-nya sama dengan user login
    //             $builder->where('cabang_id', auth()->user()->cabang_id);
    //         }
    //     });

    //     // 2. OTOMATIS ISI: Saat simpan data baru (Insert)
    //     static::creating(function ($model) {
    //         if (auth()->check() && !$model->cabang_id) {
    //             // Otomatis isi cabang_id sesuai user login jika belum diisi
    //             $model->cabang_id = auth()->user()->cabang_id;
    //         }
    //     });
    // }

    protected static function bootBelongsToCabang(): void
    {
        static::addGlobalScope('cabang', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where(
                    $builder->getModel()->getTable() . '.cabang_id',
                    auth()->user()->cabang_id
                );
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && !$model->cabang_id) {
                $model->cabang_id = auth()->user()->cabang_id;
            }
        });
    }

    // pakai ketika nanti ada model yang tidak memiliki kolom cabang_id
//     protected static function bootBelongsToCabang(): void
// {
//     static::addGlobalScope('cabang', function (Builder $builder) {

//         if (!auth()->check()) {
//             return;
//         }

//         $table = $builder->getModel()->getTable();

//         if (Schema::hasColumn($table, 'cabang_id')) {
//             $builder->where(
//                 "{$table}.cabang_id",
//                 auth()->user()->cabang_id
//             );
//         }
//     });

//     static::creating(function ($model) {

//         if (
//             auth()->check()
//             && empty($model->cabang_id)
//             && Schema::hasColumn($model->getTable(), 'cabang_id')
//         ) {
//             $model->cabang_id = auth()->user()->cabang_id;
//         }
//     });
// }
}
