<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Renders user.create view
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.create');
    }

    /**
     * Stores a user
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $payload = $request->safe()->only(['email', 'name', 'password', 'phone']);

        User::create([
            'email' => $payload['email'],
            'name' => $payload['name'],
            'password' => Hash::make($payload['password']),
            'phone' => $payload['phone'],
        ]);

        return redirect()
            ->route('sessions.create')
            ->with('success', "$request->name, your registration was completed!");
    }
}
