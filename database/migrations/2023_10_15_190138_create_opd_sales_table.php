<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpdSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_sales', function (Blueprint $table) {
            $table->id();
          
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('payment_system_id');
            $table->double('paid_amount',18,2)->default(0);
            $table->double('tax',18,2)->default(0);
            $table->double('cost',18,2)->default(0);
            $table->double('pre_due',18,2)->default(0);
            $table->double('due',18,2)->default(0);
            $table->double('discount',18,2)->default(0);
            $table->double('profit',18,2)->default(0);
            $table->double('total',18,2)->default(0);
     
            $table->json('payment_details')->nullable();

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
        Schema::dropIfExists('opd_sales');
    }
}
