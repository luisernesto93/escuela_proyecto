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
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_estudio_id');
            $table->unsignedBigInteger('carrera_id');
            $table->string('sigla');
            $table->string('nombre_materia');
            $table->integer('horas')->nullable();
            $table->integer('nivel')->nullable();
            $table->integer('orden')->nullable();
            $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->foreign('plan_estudio_id')->references('id')->on('planestudios');
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
};
