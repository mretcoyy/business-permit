<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalFeeColumnToBusinessFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_fees', function (Blueprint $table) {
            $table->decimal('total_fee',23,6)->default(0.000000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_fees', function (Blueprint $table) {
            Schema::dropIfExists('total_fee');

        });
    }
}
