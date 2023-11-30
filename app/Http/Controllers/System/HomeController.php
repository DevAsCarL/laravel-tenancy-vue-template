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
    public function index2()
    {
        return Inertia::render('System/Home/Index');
    }
}
