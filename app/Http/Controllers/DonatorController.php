<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Request as Req;
use App\Models\Donator;
use App\Models\BankAccount;
use App\Models\UserDetail;
use App\Mail\ReceiptMail;
use DB;

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

    public function donate(Request $request, $donator_id, $request_id)
    {
        $donator = Donator::find($donator_id);
        $donator->requests()->attach($request_id, ['type' => $request->type, 'price' => $request->price]);

        $req = Req::find($request_id);

        //Send Receipt
        $date = date("jS F Y") . ", " . date("h:i:s A");
        $details = [
            'price' => $request->price,
            'date'  => $date,
            'receiver' => $req->user->user_detail->name
        ];
        \Mail::to($donator->email)->send(new ReceiptMail($details));

        return back()->with('success','Thank you for your contribution! Receipt will be emailed to you soon!');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $id_arr = [];

        $user_details = UserDetail::where(function($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        })->get();

        foreach ($user_details as $user_detail) {
            array_push($id_arr,$user_detail->user->request->id);
        }

        $requests = Req::find($id_arr)->where('is_active', 1);

        $data = compact([
            'requests'
        ]);

        return view('donators.index', $data);
    }

    public function filter(Request $request)
    {
        $filter = $request->filter;

        $requests = Req::where('is_active', 1)
                    ->where(function($query) use ($filter) {
                        $query->where('icons', 'like', "%{$filter}%");
                    })
                    ->get();

        $data = compact([
            'requests'
        ]);

        return view('donators.index', $data);
    }
}