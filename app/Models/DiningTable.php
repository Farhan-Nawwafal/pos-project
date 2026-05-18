<?php

namespace App\Models;

use App\Traits\BelongsToCabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiningTable extends Model
{
    use HasFactory;
    use BelongsToCabang;

    protected $fillable = [
        'cabang_id',
        'table_number',
        'image',
        'qr_value',
    ];

    protected $casts = [
        'occupied_at' => 'datetime', // Tambahkan baris ini
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getNameAttribute(): string
    {
        return (string) $this->table_number;
    }
}
