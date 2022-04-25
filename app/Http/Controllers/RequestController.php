<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as Req;
use App\Models\User;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('requests.create');
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        if ($user->user_detail()->exists()) {
            return redirect('/dashboard')->withErrors('User cannot have more than one request!');
        } else {
            $request = Req::create($request->all());

            return redirect('/dashboard')->with('success','Created successfully!');
        }
    }

    public function update_status($id) {
        $request = Req::findOrFail($id);

        $request->is_active = request('is_active');
        $request->save();

        return redirect()->route('dashboard');
    }
}
