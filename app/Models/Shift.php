<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';

    protected $guarded = ['id'];

    protected $casts = [
        'starting_cash' => 'decimal:2',
        'started_at'    => 'datetime',
        'ended_at'      => 'datetime',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function startedBy()
    {
        return $this->belongsTo(User::class, 'started_by_user_id');
    }

    public function endedBy()
    {
        return $this->belongsTo(User::class, 'ended_by_user_id');
    }
}
