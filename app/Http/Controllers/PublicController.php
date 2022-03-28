<?php

namespace App\Http\Controllers;

use App\ReferralEarning;
use App\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    public function allUserReferral()
    {
        $users = User::all();
        return view('admin.users.referral')->with('users', $users);
    }
    public function withdrawalRequest()
    {
        // $withdrawals = Withdrawal::all();
        // return view('admin.user-withdrawals')->with('users', $withdrawals);
    }
    public function showUserReferral($id)
    {
        $user =    User::findOrFail($id);
        $userEarning = ReferralEarning::where('user_id', $id)->paginate(15);
        $total = $userEarning->sum('amount');
        return view('admin.users.show-referral')->with(['user' => $user, 'total' => $total, 'earnings' => $userEarning]);
    }
}
