<?php

namespace App\View\Components;

use App\Models\purchase;
use App\Models\supplier;
use Illuminate\View\Component;

class stockEntry extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $suppliers = purchase::with(['supplier','purchaseDetails'])->where('isStockInserted',false)->get();

        foreach ($suppliers as $key => $singlePurchase) {
                $singlePurchasedetails = $singlePurchase->purchaseDetails; 
                foreach ($singlePurchasedetails as $key => $singlePurchaseDetail) {
                    $product = $singlePurchaseDetail->product;
                    $singlePurchaseDetail["product_name"] = $product;
                }

        }
        return view('components.stock-entry',compact('suppliers'));
    }
}
