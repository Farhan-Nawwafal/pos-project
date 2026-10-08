<?php
// app/Models/DayClosing.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayClosing extends Model
{
    protected $fillable = [
        'cabang_id',
        'closed_by_user_id',
        'closing_date',
        'closed_at',
        'total_net_sales',
        'total_bills',
    ];

    protected $casts = [
        'closed_at'    => 'datetime',
        'closing_date' => 'date',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by_user_id');
    }
}
