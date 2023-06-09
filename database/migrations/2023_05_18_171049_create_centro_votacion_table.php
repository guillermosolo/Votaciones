<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentroVotacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_votacion', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('municipio_id');
            $table->string('nombre');
            $table->smallInteger('JRV')->default(0);
            $table->Integer('empadronados')->default(0);
            $table->string('sector',1);
            $table->primary(['id','municipio_id']);
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->unique(['nombre','municipio_id']);
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
        Schema::dropIfExists('centro_votacion');
    }
}
