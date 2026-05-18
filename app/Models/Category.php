<?php

namespace App\Models;

use App\Traits\BelongsToCabang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BelongsToCabang;

    protected $guarded = [];


    protected $fillable = ['cabang_id', 'name'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
