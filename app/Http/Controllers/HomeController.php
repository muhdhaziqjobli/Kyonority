<?php

namespace App\Http\Controllers;

use App\Models\Request;

class HomeController extends Controller
{
    public function home()
    {
        $requests = Request::where('is_active', 1)
                    ->get();

        // dd($requests);

        $data = compact([
            'requests'
        ]);

        return view('home', $data);
    }
}
