<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // kg/gm/dozon/ton
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('product_type_id');
            $table->double('value',18,6); /// equvalent value of base unit
            $table->longText('description')->nullable();
            $table->json('data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        // all are editable and showable
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
