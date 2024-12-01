<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ExpenseBilling
 *
 * @property int $id
 * @property float $value
 * @property bool $paid
 * @property int $expense_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property-read Expense $expense
 */
class ExpenseBilling extends Model
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
     * Gets billing expense
     */
    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }
}
