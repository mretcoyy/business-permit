<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInformationDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_information_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('code');
            $table->string('line_of_business');
            $table->string('number_of_units');
            $table->decimal('capitalization', 23, 6);
            $table->decimal('essential', 23, 6)->default(0.000000);
            $table->decimal('non_essential', 23, 6)->default(0.000000);
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
        Schema::dropIfExists('business_information_detail');
    }
}
