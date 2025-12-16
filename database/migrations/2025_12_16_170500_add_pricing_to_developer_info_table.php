<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricingToDeveloperInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_info', function (Blueprint $table) {
            $table->decimal('monthly_price', 10, 2)->default(39.00)->after('demo_valid_till');
            $table->decimal('one_time_price', 10, 2)->default(399.00)->after('monthly_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer_info', function (Blueprint $table) {
            $table->dropColumn(['monthly_price', 'one_time_price']);
        });
    }
}
