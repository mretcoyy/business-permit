<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BusinessStatus;

class AddNewColumnInBusinessDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_detail', function (Blueprint $table) {
            $table->string('business_status')->after('status')->default(BusinessStatus::BPLOAPPROVAL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_detail', function (Blueprint $table) {
            //
        });
    }
}
