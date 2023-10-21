<?php

namespace App\Http\Controllers;

use App\Models\opdSale;
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
        $requestData = [];
        $sellType = $request->sell_type;

            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
        
            $startDate = Carbon::parse($validated['start_date']);
            $endDate = Carbon::parse($validated['end_date'])->endOfDay(); 



        if($request->user == "all"){
            $requestData['user'] = "all";

            if($sellType == "opd"){
                $statements = opdSale::whereBetween('created_at', [$startDate, $endDate])->with(['user','customer'])->get();
            }elseif($sellType == "ipd"){
                $statements = order::whereBetween('created_at', [$startDate, $endDate])->with(['user','customer'])->get();
            }

        }else{
            $requestData['user'] = $request->user;

            if($sellType == "opd"){
                $statements = opdSale::whereBetween('created_at', [$startDate, $endDate])->where("user_id", $request->user)->with(['user','customer'])->get();
            }elseif($sellType == "ipd"){
                $statements = order::whereBetween('created_at', [$startDate, $endDate])->where("user_id", $request->user)->with(['user','customer'])->get();
            }
        }

        if($sellType == 'all'){
            
            if($request->user == "all"){
               $ipdOrders = order::whereBetween('created_at', [$startDate, $endDate])->with(['user','customer'])->get();
               $opdOrders = opdSale::whereBetween('created_at', [$startDate, $endDate])->with(['user','customer'])->get();
               $statements = $ipdOrders->merge($opdOrders);
            }else{
                $ipdOrders = order::whereBetween('created_at', [$startDate, $endDate])->where("user_id", $request->user)->with(['user','customer'])->get();
                $opdOrders = opdSale::whereBetween('created_at', [$startDate, $endDate])->where("user_id", $request->user)->with(['user','customer'])->get();
                $statements = $ipdOrders->merge($opdOrders);
            }
        }

        $users =  User::all();
        return view('statements.sell',compact('statements','users','request'));
    }


    public function purchaseStatement(Request $request){
        $startDate = '';
        $endDate = '';
        $requestData = [];

            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
        
            $startDate = Carbon::parse($validated['start_date']);
            $endDate = Carbon::parse($validated['end_date'])->endOfDay(); 
        if($request->user == "all"){
            $requestData['user'] = "all";
                $statements = purchase::whereBetween('created_at', [$startDate, $endDate])->with(['user','supplier'])->get();
        }else{
               $requestData['user'] = $request->user;

                $statements = purchase::whereBetween('created_at', [$startDate, $endDate])->where("user_id", $request->user)->with(['user','supplier'])->get();
          
        }
        $users =  User::all();
        return view('statements.purchase',compact('statements','users','request'));
    }
}
