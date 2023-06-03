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
        Schema::create('products', function (Blueprint $table) {
          $table->id();
          $table->float('price', 8, 2);
          $table->string('title', 32);
          $table->integer('stock');
          $table->string('description', 63);
          $table->string('foto', 200);
          $table->enum('status', ['pagado', 'rechazado', 'no pagado']);
          $table->unsignedBigInteger('user_id');
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};