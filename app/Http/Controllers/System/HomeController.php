<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('System/Clients/Index');
    }
}
