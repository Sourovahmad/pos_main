<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->unique();
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->double('due', 18, 2)->default(0.00);
            $table->json('data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
       //  all are showable name phone address company editable 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
