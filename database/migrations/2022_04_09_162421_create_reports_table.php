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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('user_count')->nullable();
            $table->integer('donator_count')->nullable();
            $table->integer('request_count')->nullable();
            $table->integer('donation_count')->nullable();
            $table->integer('monetary_count')->nullable();
            $table->integer('aid_count')->nullable();
            $table->double('total_donation', 5, 2)->nullable();
            $table->double('highest_donation', 5, 2)->nullable();
            $table->double('net_monetary', 5, 2)->nullable();
            $table->double('net_aid', 5, 2)->nullable();
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
        Schema::dropIfExists('reports');
    }
};
