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
        Schema::table('carreras', function (Blueprint $table) {
            $table->unsignedBigInteger('facultad_id')->nullable();
            $table->foreign('facultad_id')->references('id')->on('facultads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carreras', function (Blueprint $table) {

            $table->dropForeign(['facultad_id']);
            $table->dropColumn('facultad_id');
        });
    }
};
