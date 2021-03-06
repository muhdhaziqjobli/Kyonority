<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use Auth;
use DB;

class BankAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $bank_accounts = DB::table('bank_accounts')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $data = compact([
            'bank_accounts'
        ]);
        
        return view('bank_accounts.index', $data);
    }

    public function create()
    {
        if (Auth::user()->is_verified) {
            return view('bank_accounts.create');
        }
        else {
            return redirect('/dashboard')->withErrors('Account must be verified!');
        }
    }

    public function store(Request $request)
    {
        $request = BankAccount::create($request->all());

        return redirect('/dashboard')->with('success','Created successfully!');
    }

    public function destroy($id)
    {
        BankAccount::destroy($id);
        return back()->with('success','Deleted!');
    }
}