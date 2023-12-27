<?php

namespace Modules\Authentication\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        \auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return \redirect()->route('login');
    }
}
