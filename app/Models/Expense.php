<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Expense
 *
 * @property int                          $id
 * @property string                       $name
 * @property float                        $value
 * @property Carbon                       $payment_date
 * @property string                       $type
 * @property int                          $number_of_installments
 * @property bool                         $paid
 * @property Carbon|null                  $created_at
 * @property Carbon|null                  $updated_at
 * @property int                          $user_id
 * @property User                         $user
 * @property Collection<int, Installment> $installments
 *
 * @method static create(array $array)
 */
class Expense extends Model
{
    use HasFactory;

    public const string IN_INSTALLMENTS = 'IN_INSTALLMENTS';
    public const string SINGLE = 'SINGLE';

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
