<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('pk_departamento');
            $table->string('descricao');
            $table->string('abreviatura');
            $table->integer('fk_empresa')->unsigned()->nullable(true); 
            $table->foreign('fk_empresa')->references('pk_empresa')->on('empresas'); 
            $table->boolean('visivel')->default(1);

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
        Schema::dropIfExists('departamentos');
    }
}
