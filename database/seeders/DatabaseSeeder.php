<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Installment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password1234'),
        ]);

        Expense::factory()
            ->count(2)
            ->has(
                Installment::factory()
                    ->count(5)
                    ->state(new Sequence(['paid' => false, 'value' => 119.998])),
                'installments'
            )
            ->create([
                'number_of_installments' => 5,
                'type' => Expense::IN_INSTALLMENTS,
                'user_id' => $user->id,
                'value' => 599.99,
            ]);
    }
}
