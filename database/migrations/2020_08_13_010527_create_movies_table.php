<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->integer('año');
            $table->string('titulo',50);
            $table->string('duracion',8);
            $table->string('sinopsis');
            $table->string('imagen')->default('noimagen.jpg');

            $table->boolean('condicion')->default(1);

            $table->unsignedBigInteger('id_actor');

            $table->foreign('id_actor')->references('id')->on('actors');
            
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
        Schema::dropIfExists('movies');
    }
}
