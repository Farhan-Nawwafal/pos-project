<?php

namespace App\Models;

use App\Traits\BelongsToCabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrinterSource extends Model
{
    use HasFactory;
    use BelongsToCabang;

    protected $fillable = [
        'cabang_id',
        'name',
        'type',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
