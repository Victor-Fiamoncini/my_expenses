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

    public function test_it_creates_an_expense(): void
    {
        $name = $this->faker()->name();
        $paymentDate = $this->faker()->dateTime();
        $userId = User::factory()->create()->id;
        $value = $this->faker->randomFloat(2);

        $expense = new Expense([
            'name' => $name,
            'payment_date' => $paymentDate,
            'user_id' => $userId,
            'value' => $value,
        ]);
        $expense->save();

        $this->assertEquals($name, $expense->name);
        $this->assertEquals($paymentDate, $expense->payment_date);
        $this->assertEquals($userId, $expense->user->id);
        $this->assertEquals($value, $expense->value);
    }
}
