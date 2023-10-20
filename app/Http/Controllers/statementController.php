<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class statementController extends Controller
{
    public function sellStatement(Request $request){

        $startDate = '';
        $endDate = '';

        if(!is_null($request->start_date)){

            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
        
            $startDate = Carbon::parse($validated['start_date']);
            $endDate = Carbon::parse($validated['end_date'])->endOfDay(); 
    
    
        } else {
            $startDate = Carbon::today()->startOfDay();
            $endDate = Carbon::today()->endOfDay();
        }

        if($request->user == "all"){
            $statements = order::whereBetween('created_at', [$startDate, $endDate])->get();
        }else{
            $statements = order::whereBetween('created_at', [$startDate, $endDate])->where("user_id", $request->user)->get();
        }




        $users =  User::all();
        return view('statements.sell',compact('statements','users','request'));
    }


    public function purchaseStatement(Request $request){
        $purchases = purchase::all();
        return view('statements.purchase',compact('purchases'));
    }
}
