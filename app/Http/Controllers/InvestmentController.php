<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Investment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;

class InvestmentController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
        'amount' => 'required|numeric|min:1|max:100000000',
    ]);

    $user = Auth::user();
    $amount = $request->input('amount');
    #-----------For only 10% add krne k liye -----------------------
    $parentBonus = 0;
    // if ($user->referred_by) {
    //     $parent = User::find($user->referred_by);

    //     if ($parent) {
    //         $parentBonus = $amount * 0.10;  // 10% bonus
    //         $parent->earnings += $parentBonus;
    //         $parent->save();
    //     }
    // }

    Investment::create([
        'user_id' => $user->id,
        'amount' => $amount,
        'parent_bonus' => 0,
    ]);
    $this->bonusdistribute($user->id, $amount);
    return redirect()->route('user.dashboard')->with('success', 'Investment Successful!');
    }
    public function bonusdistribute($id,$investmentAmount,$level=0,$max_level=10,$percentage=[10,9,8,7,6,5,4,3,2,1])
    {

        if($level>$max_level)
        {
            return;
        }
        $user = User::find($id);
        if($user && $user->referred_by)
        {   
            $parent=User::find($user->referred_by);
            if($parent)
            {
                $bonuspercentage=$percentage[$level]??0;
                $bonus=($investmentAmount/100)*$bonuspercentage;
                $parent->earnings+=$bonus;
                $parent->save();
            }
            $this->bonusdistribute($parent->id,$investmentAmount,$level+1,$max_level,$percentage);
        }
        
    }
}