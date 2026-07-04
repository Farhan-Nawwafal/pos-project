<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function cabang() {
        return $this->belongsTo(Cabang::class);
    }

    public function startedBy() {
        return $this->belongsTo(User::class, 'started_by_user_id');
    }

    public function endedBy() {
        return $this->belongsTo(User::class, 'ended_by_user_id');
    }
}
