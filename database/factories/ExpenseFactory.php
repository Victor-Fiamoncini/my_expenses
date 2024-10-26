<?php

namespace Database\Factories;

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
        return [
            'name' => fake()->word(),
            'value' => fake()->randomFloat(2, 10, 1000),
            'payment_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'paid' => fake()->boolean(),
        ];
    }
}
