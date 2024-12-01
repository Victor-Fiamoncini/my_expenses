<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Expense
 *
 * @property int $id
 * @property string $name
 * @property float $value
 * @property Carbon $payment_date
 * @property bool $paid
 * @property string $type
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $user
 * @property-read Collection|ExpenseInstallment[] $installments
 */
class Expense extends Model
{
    use HasFactory;

    public const MONTHLY = 'MONTHLY';

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
        'paid',
        'type',
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
        return $this->hasMany(ExpenseInstallment::class);
    }

    /**
     * Returns true if expense is monthly
     *
     * @return bool
     */
    public function isMonthly(): bool
    {
        return $this->type === Expense::MONTHLY;
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
