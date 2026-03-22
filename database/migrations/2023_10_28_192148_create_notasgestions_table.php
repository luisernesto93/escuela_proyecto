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
        Schema::create('notasgestions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gestion_id');
            $table->unsignedBigInteger('carrera_id');
            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('docente_id');

            $table->integer('nota1')->nullable();
            $table->integer('nota2')->nullable();
            $table->integer('nota3')->nullable();
            $table->integer('promedio')->nullable();
            $table->integer('prueba_recuperatoria')->nullable();
            $table->integer('nota_final')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('usuario')->nullable();

            $table->foreign('gestion_id')->references('id')->on('gestions');
            $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->foreign('libro_id')->references('id')->on('libros');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->tinyInteger('estado')->default(1);

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
        Schema::dropIfExists('notasgestions');
    }
};
