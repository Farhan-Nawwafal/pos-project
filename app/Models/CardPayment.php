<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardPayment extends Model
{
    protected $fillable = [
        'transaction_id',
        'cabang_id',
        'amount',
        'card_number',
        'verification_code',
        'bank_name',
        'account_name',
        'self_order_id',
    ];

    // Relasi balik ke Transaksi
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
