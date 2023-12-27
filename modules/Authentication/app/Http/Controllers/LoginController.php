<?php

namespace Modules\Authentication\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Authentication\app\Http\Requests\Login\LoginStore;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        $isProd = \app()->environment('production');

        return \inertia('Tenant/Login/Show', [
            'email' => !$isProd ? \env('SEED_ADMIN_TENANCY_EMAIL') : '',
            'password' => !$isProd ? 'dsjoe280811$' : '',
            'remember' => !$isProd ? true : false,
            'redirect' => $request->query('redirect', ''),
            'appName' => config('app.name'),
        ]);
    }

    public function store(LoginStore $request)
    {
        \throw_if(
            !$this->validateLogin($request->only('email', 'password'), $request->only('remember')),
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

    private function validateLogin($credencials, $remember)
    {
        [$identifier, $password] = array_values($credencials);
        $person = Person::where('email', $identifier)->first();

        return $person && Hash::check($password, $person->user->password) && auth()->login($person->user);
    }
}
