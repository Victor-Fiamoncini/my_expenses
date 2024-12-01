<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SessionController extends Controller
{
    /**
     * Renders session.create view
     *
     * @return View
     */
    public function create(): View
    {
        return view('session.create');
    }

    /**
     * Stores a session
     *
     * @param StoreSessionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSessionRequest $request): RedirectResponse
    {
        $payload = $request->safe()->only(['email', 'password']);

        if (Auth::attempt($payload)) {
            $request->session()->regenerate();

            return redirect()->route('expenses.index');
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    }

    /**
     * Deletes a session
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('sessions.create');
    }
}
