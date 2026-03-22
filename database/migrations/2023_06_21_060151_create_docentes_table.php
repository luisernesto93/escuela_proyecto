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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_interno')->default('')->nullable();
            $table->string('nombres')->default('');
            $table->string('apellidos')->default('')->nullable();
            $table->string('documento')->default('')->nullable();
            $table->string('telefono');
            $table->string('observaciones')->default('')->nullable();
            $table->string('fecha_registro')->nullable();
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
        Schema::dropIfExists('docentes');
    }
};
