<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numberOfInstallments = fake()->randomNumber(1, true);

        return [
            'name' => fake()->word(),
            'value' => fake()->randomFloat(2, 10, 1000),
            'payment_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'type' => $numberOfInstallments > 1 ? Expense::IN_INSTALLMENTS : Expense::SINGLE,
            'number_of_installments' => $numberOfInstallments,
            'paid' => fake()->boolean(),
        ];
    }
}
