<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandForSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_for_sales', function (Blueprint $table) {
            $table->id();
            $table->string('landTitle');
            $table->string('address');
            $table->integer('seller_id');
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->string('buyer_id')->nullable();
            $table->string('coverImage');
            $table->string('price');
            $table->string('state');
            $table->string('lga');
            $table->string('town');

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
        Schema::dropIfExists('land_for_sales');
    }
}
