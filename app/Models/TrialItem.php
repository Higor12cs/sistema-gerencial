<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrialItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'trial_id',
        'product_variant_id',
        'transaction_type',
        'transaction_date',
        'quantity',
        'unit_price',
        'total_price',
        'created_by',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($trialItem) {
            $trialItem->created_by = auth()->id();
        });
    }

    public function trial(): BelongsTo
    {
        return $this->belongsTo(Trial::class);
    }

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
