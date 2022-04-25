<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\User;

class UserDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('user_details');
    }

    public function store(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user->user_detail()->exists()) {
            return redirect('/dashboard')->withErrors('User cannot have more than one detail!');
        } else {
            $userDetail = UserDetail::create($request->all());

            return redirect('/dashboard');
        }
    }
}
