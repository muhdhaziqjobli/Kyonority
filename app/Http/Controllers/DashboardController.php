<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $unverified_users = User::where('is_verified')->orWhere('is_verified', false)->get();

            $data = compact([
                'unverified_users'
            ]);

            return view('admin.dashboard',$data);
        }

        else if (Auth::user()->user_detail) {
            $user = Auth::user();

            if ($user->request) {
                $icons = $user->request->icons;

                $data = compact([
                    'user',
                    'icons'
                ]);
            } else {
                $data = compact([
                    'user'
                ]);
            }

            return view('dashboard', $data);
        } 
        
        else {
            return redirect('/user-details/create');
        }
    }
}
