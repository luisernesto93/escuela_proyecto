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
        Schema::create('planestudios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resolucion_id');
            $table->string('area_formacion')->comment('nombre de la Carrera');
            $table->integer('horas_semanales');
            $table->integer('horas_mes');
            $table->integer('horas_gestion');
            $table->integer('carga_horaria');
            $table->foreign('resolucion_id')->references('id')->on('resolucions');
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
        Schema::dropIfExists('planestudios');
    }
};
