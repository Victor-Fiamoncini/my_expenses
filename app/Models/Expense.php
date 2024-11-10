<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Expense
 *
 * @property int $id
 * @property string $name
 * @property float $value
 * @property string $payment_date
 * @property string $paid
 * @property string $type
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property-read \App\Models\User $user
 *
 * @mixin \Eloquent
 */
class Expense extends Model
{
    use HasFactory;

    const MONTHLY = 'MONTHLY';

    const SINGLE = 'SINGLE';

    protected $fillable = [
        'name',
        'value',
        'payment_date',
        'paid',
        'type',
        'user_id',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isMonthly(): bool
    {
        return $this->type === Expense::MONTHLY;
    }

    public function isSingle(): bool
    {
        return $this->type === Expense::SINGLE;
    }
}
