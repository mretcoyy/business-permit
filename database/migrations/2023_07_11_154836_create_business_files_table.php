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
            $table->string('barangay_clearance');
            $table->string('zoning_clearance');
            $table->string('sanitary_clearance');
            $table->string('occupancy_permit');
            $table->string('environment_certificate');
            $table->string('community_tax_certificate');
            $table->string('real_property_tax_clearance');
            $table->string('fire_certificate');
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
        Schema::dropIfExists('business_files');
    }
}
