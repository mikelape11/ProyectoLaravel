<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaIncidencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profesor');
            $table->string('fecha');
            $table->string('aula');
            $table->string('hora');
            $table->string('equipo');
            $table->unsignedBigInteger('id_profesor');
            $table->string('id_averia');
            $table->string('estado');
            $table->string('opinion');
            $table->foreign('id_profesor')->references('id')->on('users');
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
        Schema::dropIfExists('incidencias');
    }
}
