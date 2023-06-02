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
        Schema::create('sellers', function (Blueprint $table) {
          $table->id();
          $table->float('cred_total', 8, 2);
          $table->boolean('payback');
          $table->enum('calificate', ['muy malo', 'malo', 'bueno', 'muy bueno']);
          $table->unsignedBigInteger('users_id');
          $table->foreign('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('sellers');
    }
};
