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
        Schema::create('users', function (Blueprint $table) {
          $table->id();
          $table->string('name', 32);
          $table->string('email', 64);
          $table->float('credits', 8, 2)->default(0);
          $table->string('password', 32);
          $table->enum('rol', ['administrador', 'miembro']);
		      $table->unsignedBigInteger('addresses_id');
		      $table->foreign('addresses_id')->references('id')->on('addresses');
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
};
