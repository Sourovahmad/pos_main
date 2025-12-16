<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_info', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('demo_owner_account');
            $table->string('address');
            $table->string('license_key', 32)->unique();
            $table->date('demo_valid_till');
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
        Schema::dropIfExists('developer_info');
    }
}
