<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use Auth;
use DB;

class BankAccountController extends Controller
{
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
        return view('bank_accounts.create');
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