<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function user_index()
    {
        $users = User::all();

        $data = compact([
            'users'
        ]);

        return view('users.index',$data);
    }

    public function unverified_users()
    {
        $unverified_users = User::where('is_verified')->orWhere('is_verified', false)->get();

        $data = compact([
            'unverified_users'
        ]);

        return view('users.unverified_users',$data);
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);

        $user->is_verified = request('is_verified');
        $user->save();

        return redirect()->route('admin.unverified_users');
    }
}
