<?php

namespace App\Http\Controllers;

use App\Models\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }
}
