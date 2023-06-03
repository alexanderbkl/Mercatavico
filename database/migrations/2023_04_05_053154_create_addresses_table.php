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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('city', 64);
            $table->string('cp', 5);
            $table->string('address', 64);
            $table->unsignedBigInteger('user_id')->nullable(); // Adding user_id foreign key
            $table->unsignedBigInteger('cities_id')->nullable(); // hacer que sea nullable
            $table->foreign('cities_id')->references('id')->on('cities');
            $table->foreign('user_id')->references('id')->on('users'); // Adding user_id foreign key
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
        Schema::dropIfExists('user_addresses');
    }
};