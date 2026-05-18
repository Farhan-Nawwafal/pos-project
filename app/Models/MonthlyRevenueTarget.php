<?php

namespace App\Models;

use App\Traits\BelongsToCabang;
use Illuminate\Database\Eloquent\Model;

class MonthlyRevenueTarget extends Model
{
    use BelongsToCabang;

    protected $fillable = [
        'cabang_id',
        'year',
        'month',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'month' => 'integer',
            'amount' => 'integer',
        ];
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
