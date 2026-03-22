<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_inscripcion_becas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inscripcion_id');
            $table->unsignedBigInteger('beca_id');
            $table->decimal('porcentaje', 8, 2)->nullable()->default(0);
            $table->tinyInteger('estado')->nullable()->default(1);

            $table->foreign('inscripcion_id')->references('id')->on('inscripcions');
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
        Schema::dropIfExists('detalle_inscripcion_becas');
    }
};
