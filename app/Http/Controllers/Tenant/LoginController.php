<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginStore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        $isProd = \app()->environment('production');

        return \inertia('Tenant/Login/Show', [
            'email' => ! $isProd ? \env('SEED_ADMIN_EMAIL') : '',
            'password' => ! $isProd ? '123456' : '',
            'remember' => ! $isProd ? true : false,
            'redirect' => $request->query('redirect', ''),
            'appName' => config('app.name'),
        ]);
    }

    public function store(LoginStore $request)
    {
        \throw_if(
            ! \auth()->attempt($request->only('email', 'password'), $request->only('remember')),
            ValidationException::withMessages([
                'email' => \__('auth.failed'),
            ])
        );

        $request->session()->regenerate();

        if ($request->validated('redirect')) {
            return \redirect()->to($request->validated('redirect'));
        }

        return \redirect()->route('home');
    }
}
