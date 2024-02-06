<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'date',
        'return_date',
        'total_price',
        'observation',
        'created_by',
    ];

    protected $casts = [
        'date' => 'datetime',
        'return_date' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($trial) {
            $trial->created_by = User::where('global_id', auth()->user()->global_id)->first()->id;
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function trialItems(): HasMany
    {
        return $this->hasMany(TrialItem::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
