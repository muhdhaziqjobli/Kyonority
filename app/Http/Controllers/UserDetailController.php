<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;

class UserDetailController extends Controller
{
    public function create()
    {
        return view('user_details');
    }

    public function store(Request $request)
    {
        $company = UserDetail::create($request->all());

        return redirect('/dashboard');
    }
}
