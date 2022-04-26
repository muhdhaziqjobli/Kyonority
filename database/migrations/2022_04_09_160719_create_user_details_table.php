<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('coord')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('income', 8, 2)->nullable();
            $table->string('occupation')->nullable();
            $table->integer('household_member')->nullable();
            $table->string('bio')->nullable();
            $table->string('files')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};
