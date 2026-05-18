<?php

namespace App\Models;

use App\Traits\BelongsToCabang;
use Illuminate\Database\Eloquent\Model;

class OperatingExpense extends Model
{
    use BelongsToCabang;

    protected $fillable = [
        'cabang_id',
        'expense_date',
        'category',
        'amount',
        'note',
        'created_by_user_id',
    ];

    protected function casts(): array
    {
        return [
            'expense_date' => 'date',
            'amount' => 'integer',
            'created_by_user_id' => 'integer',
        ];
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
