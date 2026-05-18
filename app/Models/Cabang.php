<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'is_active'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relasi ke Produk
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Relasi ke Transaksi
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
