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
        Schema::create('resolucions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_resolucion');
            $table->unsignedBigInteger('gestion_id');
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('gestion_id')->references('id')->on('gestions');
            $table->foreign('carrera_id')->references('id')->on('carreras');
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
        Schema::dropIfExists('resolucions');
    }
};
