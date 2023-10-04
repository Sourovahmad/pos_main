<?php

namespace App\Http\Controllers;

use App\Models\quotaion;
use App\Http\Requests\UpdatequotaionRequest;
use App\Models\paymentSystem;
use App\Models\Product;
use App\Models\purchase;
use App\Models\quotationDetail;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NumberToWords\NumberToWords;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\View;

class QuotaionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(! auth()->user()->hasPermissionTo('Purchase Page')){
            return abort(401);
        }  


        $monthStart = Carbon:: now()->format('Y-m-01 00:00:00');
        $monthEnd = Carbon:: now()->format('Y-m-31 23:59:59');
        if(! is_null($request->month)){
            $monthStart = Carbon:: parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd = Carbon:: parse($request->month)->format('Y-m-31 23:59:59');
        }
        $roles = Role::all();
        $month = Carbon:: parse($monthStart)->format('F, Y');
        $purchases= quotaion::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();

        
        $settings = setting::where('table_name', 'purchases')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);


        $dataArray = [
            'settings' => $settings,
            'items' => $purchases,
            'page_name' => 'Quotation',
        ];

        return view('quotation.index',compact('dataArray','month','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! auth()->user()->hasPermissionTo('Purchase Create Page')){
            return abort(401);
        }  
        
        $roles = Role::all();
        $paymentSystems = paymentSystem::all();
        return view('quotation.create',compact('paymentSystems','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorequotaionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = new quotaion;
        $purchase->user_id= Auth::user()->id; 

        $purchase->supplier_id=$request->purchase['supplier_id'];
        $purchase->payment_system_id= $request->purchase['payment_system_id'];
        $purchase->paid_amount= $request->purchase['paid_amount'];
        $purchase->pre_due=$request->purchase['pre_due'];
        $purchase->discount=$request->purchase['discount'];
        $purchase->total=$request->purchase['total'];
        
        $purchase->save();




        // update the orderr id

        $updatePurchase = quotaion::find($purchase->id);
        $orderIdUniqueu = $purchase->id .now()->format('Ymd');
        $updatePurchase->purchase_order_id = $orderIdUniqueu;
        $updatePurchase->save();
  

        $productCount = 0;
       
        $requestProducts = $request->purchase_details;

        foreach($requestProducts as $product){

            $purchaseDetail = new quotationDetail;
            $databaseProduct = Product::find($product['id']);
            $purchaseDetail->purchase_id = $purchase->id;
            $purchaseDetail->product_id = $product['id'];
            $purchaseDetail->price = $product['price'];
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->discount = $product['discount'];
            $purchaseDetail->total = $product['total'];
            $productCount += $purchaseDetail->quantity;
            $purchaseDetail->sell_price = $databaseProduct->price_per_unit;
            $purchaseDetail->save();

        }

        $purchase->save();


        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
       $totalNumberInWord =  $numberTransformer->toWords($purchase->total);

        $htmlData = [
            "products" => $requestProducts,
            "purchase" => $purchase,
            "purchase_order_id" => $orderIdUniqueu,
            'totalNumberInWord' => $totalNumberInWord
        ];
        // generate invoice
        $html = ['id' => $purchase->id, 'html' => View::make('invoice.quotation')->with('data', $htmlData)->render()];
  

        return response()->json([
            "html" => $html,
            "purchse" => $purchase
        ]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quotaion  $quotaion
     * @return \Illuminate\Http\Response
     */
    public function show(quotaion $quotaion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quotaion  $quotaion
     * @return \Illuminate\Http\Response
     */
    public function edit(quotaion $quotaion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatequotaionRequest  $request
     * @param  \App\Models\quotaion  $quotaion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatequotaionRequest $request, quotaion $quotaion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quotaion  $quotaion
     * @return \Illuminate\Http\Response
     */
    public function destroy(quotaion $quotaion)
    {
        //
    }
}
