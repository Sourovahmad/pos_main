<?php

namespace App\Http\Controllers;

use App\Models\opdSale;
use App\Http\Requests\StoreopdSaleRequest;
use App\Http\Requests\UpdateopdSaleRequest;
use App\Models\opdOrderDetails;
use App\Models\paymentSystem;
use App\Models\Product;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use NumberToWords\NumberToWords;
use Spatie\Permission\Models\Role;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;

class OpdSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $paymentSystems = paymentSystem::all(); 
        return view('product.order.opd',compact('roles','paymentSystems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreopdSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new opdSale;
        $order->user_id= Auth::user()->id;   //auth must be added here
        $order->customer_id=$request->order['customer_id'];
        $order->payment_system_id= $request->order['payment_system_id'];
        $order->paid_amount= $request->order['paid_amount'];
        $order->tax= $request->order['tax'];
        $order->cost =0;
        $order->pre_due=$request->order['pre_due'];
        $order->discount=$request->order['discount'];
        $order->profit =0;
        $order->total=$request->order['total'];
        
        $order->save();
        if( auth()->user()->hasPermissionTo('Allow Customer Due')){
            
            $order->due=$request->order['due'];
            
            $customer = $order->customer;
            $customer->due = $order->due;
            $customer->save();
            
            $this->onlineSync('customer','update',$customer->id);
        }
        else{
            $order->discount += $request->order['due'];
            $order->due= 0;
        }




        // invoice generator
        $logo = EscposImage::load("{{asset('images/logo.png')}}", false);
        $connector = new WindowsPrintConnector("yourPrintername");
        $printer = new Printer($connector);
        $settings = setting::first();

            /* Print top logo */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> graphics($logo);






        /* Name of shop */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text($settings->website_name."\n");
        $printer -> selectPrintMode();
        $printer -> text($settings->address."\n");
        $printer -> text($settings->email."\n");
        $printer -> text($settings->phone."\n");
        $printer -> text("-----------------------------\n");
        $printer -> feed();



        /* Title of receipt */
        $printer -> setEmphasis(true);
        $printer -> text("OPD SALE INVOICE\n");
        $printer -> setEmphasis(false);


        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> setEmphasis(true);
        $printer -> text("ITEMS\n");
        $printer -> setEmphasis(false);
        $printer -> text("-----------------------------\n");


        $printer -> text("Name  Price Quantity\n");
                
        $cost=0;
        $profit=0;
        $productCount = 0;
       
        $requestProducts = $request->order_details;

        foreach($requestProducts as $product){

            $orderDetail = new opdOrderDetails;
            $databaseProduct = Product::find($product['id']);
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['id'];
            $orderDetail->price = $product['price'] ;
            $orderDetail->quantity = $product['quantity'];
            $orderDetail->discount = $product['discount'];
            $orderDetail->tax = $product['tax'];
            $orderDetail->cost = $product['cost'];
            $orderDetail->total = $product['total'];
            $orderDetail->profit = $product['profit'];
            $cost += $product['cost'];
            $profit += ($product['price'] - $databaseProduct->cost_per_unit) * $product['quantity'];
            $productCount += $orderDetail->quantity;
             $orderDetail->save();


            $databaseProduct->stock = $databaseProduct->stock - $product['quantity'];
            if( $databaseProduct->stock <0){
                $databaseProduct->stock =0;
            }
            $databaseProduct->save();

             $this->onlineSync('orderDetail','create',$orderDetail->id);
             $this->onlineSync('Product','update',$databaseProduct->id);

            // product Analysis start
            $this->productAnalysis($orderDetail);
            // product Analysis end


            // product info for invoice 

            $prodcutInfoText = $databaseProduct->name . " " .$product['price'] . " " .$product['quantity'] . "\n";
            $printer -> text($$prodcutInfoText);



        }

        $printer -> text("-----------------------------\n");
        $printer->feed();

        $order->cost =$cost;
        $order->profit =$profit;
        $order->save();

        Log::info("total sell profit for this order", ["profit" => $profit]);


        $this->onlineSync('order','create',$order->id);

        


        // calculation Analysis start
        $this->calculationAnalysis($order);
        // calculation Analysis end


        // employee Analysis start
        $this->employeeAnalysis($profit);
        // employee Analysis end

        // sell Analysis start
        $this->sellAnalysis($order,$productCount);
        // sell Analysis end



        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $totalNumberInWord =  $numberTransformer->toWords($order->total);



        
        $htmlData = [
            "products" => $requestProducts,
            "purchase" => $order,
            'totalNumberInWord' => $totalNumberInWord
        ];




        // print using thermal printer
        // generate invoice




        $printer -> text("-----------------------------\n");
        $printer -> text("Total Price  : ".$order->total . "\n");
        $printer -> text("Total Price in words  : ".$totalNumberInWord . "\n");
        $printer -> text("Thank You\n");




        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> barcode($order->id, Printer::BARCODE_CODE39);
        $printer -> feed();
        $printer -> text($order->id);
        $printer -> feed(1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);



        $printer->cut();
        $printer -> close();





  
        return response()->json([
            "html" => $html,
            "purchse" => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\opdSale  $opdSale
     * @return \Illuminate\Http\Response
     */
    public function show(opdSale $opdSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\opdSale  $opdSale
     * @return \Illuminate\Http\Response
     */
    public function edit(opdSale $opdSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateopdSaleRequest  $request
     * @param  \App\Models\opdSale  $opdSale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateopdSaleRequest $request, opdSale $opdSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\opdSale  $opdSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(opdSale $opdSale)
    {
        //
    }
}
