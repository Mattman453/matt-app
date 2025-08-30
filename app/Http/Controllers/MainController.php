<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function homeView(Request $request) {
        return Inertia::render('Home', []);
    }
}
