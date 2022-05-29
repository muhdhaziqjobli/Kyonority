<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Donator;
use App\Models\Request as Req;

use Illuminate\Http\Request;
use DB;

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

    public function report()
    {
        $userCount     = User::count();
        $donatorCount  = Donator::count();
        $requestCount  = DB::table('requests')
                            ->where('is_active', '=', '1')
                            ->count();
        $adminCount    = DB::table('users')
                            ->where('is_admin', '=', '1')
                            ->count();
        $donationCount = DB::table('donator_request')
                            ->count();
        $monetaryCount = DB::table('donator_request')
                            ->where('type', 'monetary')
                            ->count();
        $aidCount      = DB::table('donator_request')
                            ->where('type', 'aid')
                            ->count();

        $totalDonation   = DB::table('donator_request')
                            ->sum('price');
        $highestDonation = DB::table('donator_request')
                            ->max('price');
        $netMonetary     = DB::table('donator_request')
                            ->where('type', 'monetary')
                            ->sum('price');
        $netAid          = DB::table('donator_request')
                            ->where('type', 'aid')
                            ->sum('price');

        $userCount = $userCount - $adminCount;

        $data = compact([
            'userCount',
            'donatorCount',
            'requestCount',
            'donationCount',
            'monetaryCount',
            'aidCount',
            'totalDonation',
            'highestDonation',
            'netMonetary',
            'netAid'
        ]);

        return view('admin.report', $data);
    }
}