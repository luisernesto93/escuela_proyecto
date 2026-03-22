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
        //add_foreign_key_estudiantes
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->unsignedBigInteger('genero_id')->nullable()->before('created_at');
            $table->unsignedBigInteger('expedicion_ci_id')->nullable()->before('created_at');
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');
            $table->foreign('expedicion_ci_id')->references('id')->on('expedicion_cis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropForeign(['genero_id']);
            $table->dropColumn('genero_id');
            $table->dropForeign(['expedicion_ci_id']);
            $table->dropColumn('expedicion_ci_id');
        });
    }
};
