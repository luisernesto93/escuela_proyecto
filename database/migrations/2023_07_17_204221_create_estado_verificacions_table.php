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
        Schema::create('estado_verificacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id')->default(0);
            $table->tinyInteger('compromiso_titulo')->default(0);
            $table->tinyInteger('ci_estado')->default(0);
            $table->tinyInteger('foto_estado')->default(0);
            $table->tinyInteger('folder_estado')->default(0);
            $table->tinyInteger('certificado_estado')->default(0);
            $table->tinyInteger('pago_folder_estado')->default(0);
            $table->tinyInteger('estado')->default(1);
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
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
        Schema::dropIfExists('estado_verificacions');
    }
};
