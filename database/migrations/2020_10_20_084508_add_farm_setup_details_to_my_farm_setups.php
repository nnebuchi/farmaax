<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFarmSetupDetailsToMyFarmSetups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_farm_setups', function (Blueprint $table) {
            //
            $table->string('farm_id');
            $table->string('owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_farm_setups', function (Blueprint $table) {
            //
        });
    }
}
