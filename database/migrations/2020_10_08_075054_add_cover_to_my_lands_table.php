<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoverToMyLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_lands', function (Blueprint $table) {
            //
            $table->string('landTitle');
            $table->string('address');
            $table->string('coverImage');
            $table->string('price');
            $table->string('state');
            $table->string('lga');
            $table->string('town');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_lands', function (Blueprint $table) {
            //
        });
    }
}
