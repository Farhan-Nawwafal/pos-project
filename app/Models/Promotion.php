<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cabang_id',
        'name',
        'type',
        'discount_type',
        'discount_value',
        'max_discount',
        'min_subtotal',
        'payment_method',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'float',
        'max_discount'   => 'float',
        'min_subtotal'   => 'float',
        'start_date'     => 'datetime',
        'end_date'       => 'datetime',
        'is_active'      => 'boolean',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class);
    }

    // ── Scopes ────────────────────────────────────────────────

    /** Hanya promo yang sedang aktif dan belum expired */
    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->where(fn($q) => $q->whereNull('start_date')->orWhere('start_date', '<=', now()))
            ->where(fn($q) => $q->whereNull('end_date')->orWhere('end_date', '>=', now()));
    }

    /** Filter cabang: ambil promo global (null) + promo cabang user */
    public function scopeForBranch($query, ?int $cabangId)
    {
        return $query->where(
            fn($q) =>
            $q->whereNull('cabang_id')->orWhere('cabang_id', $cabangId)
        );
    }

    // ── Helpers ───────────────────────────────────────────────

    /**
     * Hitung nominal diskon berdasarkan subtotal.
     * Return nilai potongan (bukan total akhir).
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($subtotal < $this->min_subtotal) return 0;

        if ($this->discount_type === 'percentage') {
            $cut = $subtotal * ($this->discount_value / 100);
            return $this->max_discount ? min($cut, $this->max_discount) : $cut;
        }

        // flat
        return min($this->discount_value, $subtotal);
    }

    /** Label singkat untuk ditampilkan di UI */
    public function getDiscountLabelAttribute(): string
    {
        if ($this->discount_type === 'percentage') {
            $label = "{$this->discount_value}%";
            if ($this->max_discount) {
                $label .= '; Max. ' . number_format($this->max_discount, 0, ',', '.');
            }
            return $label;
        }

        return 'Rp ' . number_format($this->discount_value, 0, ',', '.');
    }
}
