<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_creates_an_expense(): void
    {
        /** @var User */
        $user = User::factory()->create()->first();

        $name = $this->faker()->name();
        $paymentDate = (string) $this->faker()->dateTime()->format('Y-m-d');
        $type = $this->faker()->randomElement(['MONTHLY', 'SINGLE']);
        $value = $this->faker->randomFloat(2);

        $response = $this->actingAs($user)->post(
            uri: route('expenses.store'),
            data: [
                'name' => $name,
                'payment_date' => $paymentDate,
                'type' => $type,
                'value' => $value,
            ]
        );

        $response->assertRedirect(route('expenses.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('expenses', ['name' => $name]);
    }
}
