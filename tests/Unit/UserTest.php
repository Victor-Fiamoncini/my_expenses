<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_creates_an_user(): void
    {
        $name = $this->faker()->name();
        $email = $this->faker()->email();
        $password = $this->faker()->password(minLength: 12);
        $phone = $this->faker()->phoneNumber();

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
        ]);
        $user->save();

        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($phone, $user->phone);
        $this->assertTrue(Hash::check($password, $user->password));
    }
}
