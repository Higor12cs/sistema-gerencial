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
        'product_id',
        'quantity',
        'quantity_returned',
        'unit_price',
        'total_price',
        'created_by',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($trialItem) {
            $trialItem->created_by = User::where('global_id', auth()->user()->global_id)->first()->id;
        });
    }

    public function trial(): BelongsTo
    {
        return $this->belongsTo(Trial::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
