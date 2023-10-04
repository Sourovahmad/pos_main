<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotaionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotaions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('purchase_order_id')->default(0);
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('payment_system_id');

            $table->double('paid_amount',18,2)->default(0);
            $table->double('pre_due',18,2)->default(0);  
            $table->double('tax',18,2)->default(0);
            $table->double('due',18,2)->default(0);
            $table->double('discount',18,2)->default(0);
            $table->double('total',18,2)->default(0);

    
            $table->json('payment_details')->nullable();
            $table->double('stock_quantity_left_for_insert',18,2)->default(0);
            $table->boolean('isStockInserted')->default(false); // refer that is the stock entry happened.


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotaions');
    }
}
