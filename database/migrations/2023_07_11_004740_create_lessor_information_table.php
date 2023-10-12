<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessorInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessor_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->double('monthly_rental', 20, 6);
            $table->string('house_number');
            $table->string('street')->nullable();
            $table->string('barangay');
            $table->string('subdivision')->nullable();
            $table->string('city');
            $table->string('province');
            $table->string('contact_number');
            $table->string('email_address');
            $table->timestamps();

            $table->foreign('business_id')
                ->references('id')
                ->on('business')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessor_information');
    }
}
