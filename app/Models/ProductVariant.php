<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_size_id',
        'sku',
        'barcode',
        'cost',
        'price',
        'active',
        'created_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($productSeason) {
            $productSeason->created_by = auth()->id();
        });
    }

    public function isUsed(): bool
    {
        return $this->trialItems()->withTrashed()->exists() || $this->orderItems()->withTrashed()->exists();
    }

    public function trialItems(): HasMany
    {
        return $this->hasMany(TrialItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productSize(): BelongsTo
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
}
