<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellAnalysisYearliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_analysis_yearlies', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->double('count',18,2)->default(0);
            $table->double('product_count',18,2)->default(0);
            $table->double('cost',18,2)->default(0);
            $table->double('amount',18,2)->default(0);
            $table->double('discount',18,2)->default(0);
            $table->double('return',18,2)->default(0);
            $table->double('due',18,2)->default(0);
            $table->double('cash_received',18,2)->default(0);
            $table->json('data')->nullable();
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
        Schema::dropIfExists('sell_analysis_yearlies');
    }
}
