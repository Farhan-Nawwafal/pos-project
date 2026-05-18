<?php

namespace App\Models;

use App\Traits\BelongsToCabang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TransactionItem extends Model
{
    use BelongsToCabang;
    use LogsActivity;


    protected $fillable = [
        'cabang_id',
        'transaction_id',
        'parent_transaction_item_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price',
        'hpp_unit',
        'hpp_total',
        'subtotal',
        'voucher_discount_amount',
        'manual_discount_amount',
        'note',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['quantity', 'price', 'subtotal', 'product_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('transaksi_item');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Item pesanan telah {$eventName}";
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'price' => 'integer',
            'hpp_unit' => 'integer',
            'hpp_total' => 'integer',
            'subtotal' => 'integer',
            'voucher_discount_amount' => 'integer',
            'manual_discount_amount' => 'integer',
            'parent_transaction_item_id' => 'integer',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function parentTransactionItem(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_transaction_item_id');
    }

    public function childTransactionItems(): HasMany
    {
        return $this->hasMany(self::class, 'parent_transaction_item_id');
    }
}
