<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'legal_name',
        'date_of_birth',
        'cpf',
        'rg',
        'email',
        'phone1',
        'phone2',
        'zip_code',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'active',
        'observation',
        'created_by',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->created_by = User::where('global_id', auth()->user()->global_id)->first()->id;
        });
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
