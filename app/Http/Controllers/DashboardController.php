<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investment;
use App\Http\Controllers\InvestmentController;
class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $referrals = $user->referrals()->latest()->get();
        $investment=Investment::where('user_id', Auth::user()->id)->sum('amount');
        return view('dashboard.index', compact('user', 'referrals','investment'));
    }
}

