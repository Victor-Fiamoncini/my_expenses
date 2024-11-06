<?php

namespace Tests\Unit;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_calculates_total_expense_value(): void
    {
        $name = $this->faker()->name();
        $paymentDate = $this->faker()->dateTime();
        $value = $this->faker->randomFloat(2);

        $expense = Expense::factory()->create([
            'name' => $name,
            'payment_date' => $paymentDate,
            'user_id' => User::factory(),
            'value' => $value,
        ]);

        $this->assertEquals($name, $expense->name);
        $this->assertEquals($paymentDate, $expense->payment_date);
        $this->assertEquals($value, $expense->value);
    }
}
