<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as pw;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Incorrect username or password.'
            ]);
        }

        session()->regenerate();

        return redirect('userProfile');
    }

    public function show()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function update()
    {
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required', 'confirmed',
                pw::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }
}
