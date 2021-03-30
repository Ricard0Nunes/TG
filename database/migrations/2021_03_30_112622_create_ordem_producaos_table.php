<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemProducaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_producaos', function (Blueprint $table) {
            $table->increments('pk_ordemProducao');
            $table->integer('duracaoProducaoPrevista')->nullable(true); 
            $table->integer('duracaoProducaoReal')->nullable(true); 
            $table->float('custoPrevisto')->nullable(true);
            $table->float('custoReal')->nullable(true); 
            $table->time('dataInicio')->nullable(true); 
            $table->time('dataFim')->nullable(true); 
            $table->string('localProducao')->nullable(true); 
            $table->string('observacoes')->nullable(true); 
            $table->integer('fk_inventario')->unsigned()->nullable(true); 
            $table->foreign('fk_inventario')->references('pk_inventario')->on('inventarios'); 
            $table->integer('fk_responsavelProducao')->unsigned()->nullable(true); 
            $table->foreign('fk_responsavelProducao')->references('id')->on('users'); 
            $table->integer('fk_responsavelQualidade')->unsigned()->nullable(true); 
            $table->foreign('fk_responsavelQualidade')->references('id')->on('users'); 
            $table->integer('fk_instrucaoProducao')->unsigned()->nullable(true); 
            $table->foreign('fk_instrucaoProducao')->references('pk_instrucaoProducao')->on('instrucao_producaos'); 
            $table->integer('fk_estadoOrdemProducao')->unsigned()->nullable(true); 
            $table->foreign('fk_estadoOrdemProducao')->references('pk_estadoOrdemProducao')->on('estado_ordem_producaos'); 
            $table->integer('fk_projeto')->unsigned()->nullable(true);
            $table->foreign('fk_projeto')->references('pk_projeto')->on('projetos'); 
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
        Schema::dropIfExists('ordem_producaos');
    }
}
