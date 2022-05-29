<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Request as Req;
use App\Models\Donator;
use App\Models\BankAccount;

class DonatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('donator')->except(['login', 'authenticate', 'register', 'register_donator']);
    }

    public function register()
    {
        return view('donators.register');
    }

    public function register_donator (Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:donators,email'],
            'password' => ['required', 'confirmed'],
        ]);

        $donator = new Donator;

        $donator->email = $request->email;
        $donator->password = Hash::make($request->password);
        $donator->phone_number = $request->phone_number;

        $donator->save();

        return redirect('/donators/login')->with('success','Created successfully! Please log in with your new account.');
    }

    public function login()
    {
        return view('donators.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('donator')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('donators/index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function index()
    {
        $requests = Req::where('is_active', 1)
                    ->get();

        // dd($requests);

        $data = compact([
            'requests'
        ]);

        return view('donators.index', $data);
    }

    public function get_bank(Request $request)
    {
        $bank = BankAccount::find($request->id);
        return response()->json($bank, 200);
    }
}