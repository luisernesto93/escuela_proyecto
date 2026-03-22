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
        Schema::create('prerequisitos', function (Blueprint $table) {
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('materia_prerequisito_id')->nullable()->defalut(0);
            $table->primary(['materia_id']);

            $table->foreign('materia_id')->references('id')->on('materias');
            $table->foreign('materia_prerequisito_id')->references('id')->on('materias');
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
        Schema::dropIfExists('prerequisitos');
    }
};
