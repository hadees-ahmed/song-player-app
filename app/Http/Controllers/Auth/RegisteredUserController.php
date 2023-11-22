<?php

namespace App\Http\Controllers\Auth;

use App\Events\RecordLoginTime;
use App\Http\Controllers\Controller;
use App\Listeners\UserLoggedIn;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $timezones = timezone_identifiers_list();
        return view('auth.register', compact('timezones'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'timezone' => ['required', Rule::in(array_flip(timezone_identifiers_list()))]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'timezone' => timezone_identifiers_list()[$request->input('timezone', 'UTC')]
        ]);

        event(new Registered($user));
        Auth::login($user);
        event(new RecordLoginTime($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
