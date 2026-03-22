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
        Schema::create('modalidad_pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gestion_id');

            $table->string('descripcion');
            $table->decimal('monto_pagar', 8, 2)->default(0);
            $table->tinyInteger('estado')->default(1);

            $table->foreign('gestion_id')->references('id')->on('gestions');

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
        Schema::dropIfExists('modalidad_pagos');
    }
};
