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
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_inscripcion');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('gestion_id');
            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->unsignedBigInteger('turno_id');
            $table->unsignedBigInteger('modalidad_pago_id');
            $table->string('nro_deposito_glosa')->nullable();
            $table->string('nombre_inscriptor')->nullable();
            $table->unsignedBigInteger('canal_publicitario_id');
            $table->unsignedBigInteger('beca_id')->nullable();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('gestion_id')->references('id')->on('gestions');
            $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->foreign('turno_id')->references('id')->on('turnos');
            $table->foreign('modalidad_pago_id')->references('id')->on('modalidad_pagos');
            $table->foreign('canal_publicitario_id')->references('id')->on('canal_publicitarios');
            $table->tinyInteger('estado')->default(1);
            $table->foreign('beca_id')->references('id')->on('becas');
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
        Schema::dropIfExists('inscripcions');
    }
};
