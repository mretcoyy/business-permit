<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('business_name');
            $table->string('trade_name');
            $table->string('business_number');
            $table->string('building_name')->nullable();
            $table->string('unit_no')->nullable();
            $table->string('street');
            $table->string('barangay');
            $table->string('subdivision');
            $table->string('city');
            $table->string('province');
            $table->string('contact_number');
            $table->string('email_address');
            $table->string('pin');
            $table->string('business_area');
            $table->string('number_of_employees');
            $table->string('number_of_employees_in_lgu');
            $table->string('emergency_contact_person');
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
        Schema::dropIfExists('business_information');
    }
}
