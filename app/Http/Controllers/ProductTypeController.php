<?php

namespace App\Http\Controllers;

use App\Models\productType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(productType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(productType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productType $productType)
    {
        $productType->name= $request->name;
        $productType->description= $request->description;
        $productType->save();
        
        $this->onlineSync('productType','update',$productType->id);
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(productType $productType)
    {
        $productType->delete();
        $this->onlineSync('productType','delete',$productType->id);
        return back();
    }
}
