<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_managers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('manager_id');
            $table->string('phone');
            $table->string('Crop Farm');
            $table->string('Animal Farm');
            $table->string('Goat Farm');
            $table->string('Fish Farm');
            $table->string('Apple Farm');
            $table->string('Catfish Farm');
            $table->string('Poultry Farm');
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
        Schema::dropIfExists('farm_managers');
    }
}
