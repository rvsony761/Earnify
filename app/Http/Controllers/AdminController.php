<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WithdrawalController;
use App\Models\Withdrawal;

class AdminController extends Controller
{   
    public function index()
    {   
        $baseQuery = User::where('is_admin', false);
        $users = (clone $baseQuery)
        ->with(['referrer', 'referrals'])
        ->withcount('referrals')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $total_users=(clone $baseQuery)->count();
        $totalEarnings = (clone $baseQuery)->sum('earnings');
        $totalReferrals = (clone $baseQuery)
                            ->whereNotNull('referred_by')->count();
        $topusers = User::withCount('referrals')
                ->where('is_admin', false)
                ->orderBy('earnings', 'desc')
                ->take(3)
                ->get();
        $newusers=User::where('is_admin', false)
                ->whereDate('created_at', today())
                ->get();
        $withdrawals = Withdrawal::with('user')->latest()->get();
        return view('admin.index',compact('users','total_users','totalEarnings','totalReferrals','topusers','newusers','withdrawals'));

    }
    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $user = $withdrawal->user;  // Get full user model
    
        if ($withdrawal->status != 'Pending') {
            return back()->with('error', 'Already processed');
        }
    
        if ($user->earnings >= $withdrawal->amount) {
            $user->earnings -= $withdrawal->amount;
            $user->save();
    
            $withdrawal->status = 'Approved';
            $withdrawal->save();
    
            return back()->with('success', 'Withdrawal Approved');
        } else {
            return back()->with('error', 'User has insufficient balance');
        }
    }
    
    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        if ($withdrawal->status != 'Pending') {
            return back()->with('error', 'Already processed');
        }
        $withdrawal->status = 'Rejected';
        $withdrawal->save();
        return back()->with('error', 'Withdrawal Rejected');
    }

}

