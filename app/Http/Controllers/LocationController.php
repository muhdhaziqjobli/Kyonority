<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        if (Auth::user()->user_detail->coord) {
            $coord = str_replace( ['(',')',' '], '', Auth::user()->user_detail->coord);
            $coord = explode(',', $coord);

            $latitude = $coord[0];
            $longitude = $coord[1];
        } else {
            // $ip = \Request::ip();
            $ip = "180.73.153.139";

            $location = \Location::get($ip);
            $latitude = $location->latitude;
            $longitude = $location->longitude;
        }

        $data = compact([
            'latitude',
            'longitude'
        ]);

        // dd($data);

        return view('location.create',$data);
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->user_detail->coord = $request->coord;
        $user->user_detail->save();

        return redirect('/dashboard')->with('success','Location Saved!');
    }
}