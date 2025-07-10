<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        return view('withdrawal.withdrawal');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'=> 'required|numeric|min:50|max:999999999',
            'payment_method'=> 'required|string|max:255',
            'payment_detail'=> 'required|string|max:255',
        ]);
        $user = Auth::user();
        if ($user->earnings >= $request->amount) {
            Withdrawal::create([
                'user_id'=> $user->id,
                'amount'=> $request->amount,
                'payment_method'=> $request->payment_method,
                'payment_detail'=> $request->payment_detail,
                'status' => 'Pending',
            ]);
            return back()->with('success', 'Withdrawal request submitted!');
        } else {
            return back()->with('error', 'Insufficient balance.');
        }
    }
    
}
