<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmCostAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_cost_analyses', function (Blueprint $table) {
            $table->id();
            $table->string('farm_type');
            $table->string('clearing');
            $table->string('seeding');
            $table->string('transport');
            $table->string('planting');
            $table->string('weeding');
            $table->string('total');
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
        Schema::dropIfExists('farm_cost_analyses');
    }
}
