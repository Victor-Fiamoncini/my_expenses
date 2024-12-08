<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;

    public const IN_INSTALLMENTS = 'IN_INSTALLMENTS';
    public const SINGLE = 'SINGLE';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
        'payment_date',
        'type',
        'number_of_installments',
        'paid',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'payment_date' => 'datetime',
    ];

    /**
     * Gets expense user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets expense installments
     *
     * @return HasMany
     */
    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    /**
     * Returns true if expense is in installments
     *
     * @return bool
     */
    public function isInInstallments(): bool
    {
        return $this->type === Expense::IN_INSTALLMENTS;
    }

    /**
     * Returns true if expense is single
     *
     * @return bool
     */
    public function isSingle(): bool
    {
        return $this->type === Expense::SINGLE;
    }
}
