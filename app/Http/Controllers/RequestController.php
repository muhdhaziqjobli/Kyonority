<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as Req;
use App\Models\User;
use Auth;

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

        if ($user->request()->exists()) {
            return redirect('/dashboard')->withErrors('User cannot have more than one request!');
        } else {
            // dd($request->all());
            $req = Req::create($request->all());

            return redirect('/dashboard')->with('success','Created successfully!');
        }
    }

    public function edit($id)
    {
        $request = Req::findOrFail($id);

        $data = compact([
            'request'
        ]);

        return view('requests.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $req = Req::findOrFail($id);
        $req->update($request->all());
        return redirect('/dashboard')->with('success','Editted successfully!');
    }

    public function update_status($id) {
        $request = Req::findOrFail($id);

        if (request('is_active') == '1') {
            if (!Auth::user()->is_verified) {
                dd('test');
                return redirect('/dashboard')->error('Account is unverified!');
            }
        }

        $request->is_active = request('is_active');
        $request->save();

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        Req::destroy($id);
        return back()->with('success','Deleted!');
    }
}
