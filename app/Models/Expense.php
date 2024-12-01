<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 */
class Expense extends Model
{
    use HasFactory;

    const MONTHLY = 'MONTHLY';

    const SINGLE = 'SINGLE';

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
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns true if expense is monthly
     */
    public function isMonthly(): bool
    {
        return $this->type === Expense::MONTHLY;
    }

    /**
     * Returns true if expense is single
     */
    public function isSingle(): bool
    {
        return $this->type === Expense::SINGLE;
    }
}
