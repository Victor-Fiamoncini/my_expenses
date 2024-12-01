<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_creates_an_user(): void
    {
        $name = $this->faker()->name();
        $email = $this->faker()->email();
        $password = $this->faker()->password(minLength: 12);
        $phone = $this->faker()->phoneNumber();

        $response = $this->post(
            uri: route('users.store'),
            data: [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password,
                'phone' => $phone,
            ]
        );

        $response->assertRedirect(route('sessions.create'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', ['email' => $email]);
    }
}
