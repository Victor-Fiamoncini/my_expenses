<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Installment
 *
 * @property int         $id
 * @property float       $value
 * @property bool        $paid
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int         $expense_id
 * @property Expense     $expense
 *
 * @method static create(array $array)
 */
class Installment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'paid',
        'expense_id',
    ];

    /**
     * Gets installment expense
     *
     * @return BelongsTo
     */
    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }
}
