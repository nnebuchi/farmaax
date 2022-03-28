<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->integer('manager_id')->nullable();
            $table->string('farm_type'); // like fish farms and others
            $table->string('farm_category');
            $table->string('cover_image');
            $table->boolean('approved')->default(0);
            $table->string('turn_over_date')->nullable();
            $table->string('hand_over_date')->nullable();
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
        Schema::dropIfExists('farms');
    }
}
