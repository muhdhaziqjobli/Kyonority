<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);

        $data = compact([
            'user'
        ]);

        return view('profile.show', $data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $data = compact([
            'user'
        ]);

        return view('profile.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user_detail = UserDetail::findOrFail($user->user_detail->id);

        $user_detail->update($request->all());

        return redirect()->route('profile.show', $id)->with('success','Editted successfully!');
    }
}