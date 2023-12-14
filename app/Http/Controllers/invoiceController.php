<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class invoiceController extends Controller
{
    public function create_invoice($purchaseId){
        $purchase = purchase::find($purchaseId);

        $html = ['id' => $purchase->id, 'html' => View::make('invoice')->render()];
        return response()->json([
            "data" => $html
        ]);
    }


    public function generateOrder(Request $request){

        $orderId = $request->order_id;
        
    }
}
