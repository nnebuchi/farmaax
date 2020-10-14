<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('username')->unique();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('lawyer')->default('no');
            $table->string('realtor')->default('no');
            $table->string('farm_manager')->default('no');
            $table->string('marketer')->default('no');
            $table->string('ref_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('isAdmin')->default(0);

            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
