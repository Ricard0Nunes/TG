<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaMaoObraInstrucaoProducaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_mao_obra__instrucao_producaos', function (Blueprint $table) {
            $table->increments('pk_listaMaoObra');
            $table->integer('ordem')->nullable(true);  //ordem que é para realizar
            $table->integer('duracao')->nullable(true);  
            $table->string('observacoes')->nullable(true); 
            $table->integer('fk_departamento')->unsigned()->nullable(true); 
            $table->foreign('fk_departamento')->references('pk_departamento')->on('departamentos'); 
            $table->integer('fk_cargo')->unsigned()->nullable(true); 
            $table->foreign('fk_cargo')->references('pk_cargo')->on('cargos'); 
            $table->integer('fk_instrucaoProducao')->unsigned()->nullable(true); 
            $table->foreign('fk_instrucaoProducao')->references('pk_instrucaoProducao')->on('instrucao_producaos'); 
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
        Schema::dropIfExists('lista_mao_obra__instrucao_producaos');
    }
}
