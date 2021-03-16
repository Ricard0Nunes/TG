<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjdepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projdeps', function (Blueprint $table) {
            $table->increments('pk_projDep'); 
            $table->boolean('visivel')->default(1);
            $table->integer('fk_projeto')->unsigned(); 
            $table->foreign('fk_projeto')->references('pk_projeto')->on('projetos'); 
            $table->integer('fk_departamento')->unsigned(); 
            $table->foreign('fk_departamento')->references('pk_departamento')->on('departamentos'); 
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
        Schema::dropIfExists('projdeps');
    }
}
