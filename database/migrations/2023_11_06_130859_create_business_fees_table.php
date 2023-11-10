<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->decimal('business_tax',23,6)->default(0.000000);
            $table->decimal('mayors_permit',23,6);
            $table->decimal('occupational_permit',23,6);
            $table->decimal('subscription_other',23,6)->default(0.000000);
            $table->decimal('environmental_clearance',23,6)->default(0.000000);
            $table->decimal('sanitary_permit_fee',23,6)->default(0.000000);
            $table->decimal('zoning_fee',23,6)->default(0.000000);
            $table->tinyInteger('status')->default(0);
            $table->string('user_id')->nullable();
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
        Schema::dropIfExists('business_fees');
    }
}
