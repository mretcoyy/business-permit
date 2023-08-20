<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('barangay_clearance')->nullable();
            $table->string('zoning_clearance')->nullable();
            $table->string('sanitary_clearance')->nullable();
            $table->string('occupancy_permit')->nullable();
            $table->string('environment_certificate')->nullable();
            $table->string('community_tax_certificate')->nullable();
            $table->string('real_property_tax_clearance')->nullable();
            $table->string('fire_certificate')->nullable();
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
        Schema::dropIfExists('business_files');
    }
}
