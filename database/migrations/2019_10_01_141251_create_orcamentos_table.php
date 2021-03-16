<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->increments('pk_orcamento');
            $table->string('numeroOrcamento'); 
            $table->integer('contador')->nullable(true);
            $table->string('ano')->nullable(true);
            $table->date('dataProposta')->nullable(true);
            $table->date('dataEnvioProposta')->nullable(true);
            $table->date('dataAdjudicacao')->nullable(true);
            $table->date('dataValidade')->nullable(true);
            $table->boolean('adjudicado')->default(0);
            $table->string('motivoNaoAdjudicacao')->nullable(true);
            $table->float('valorSemIva')->nullable(true); 
            $table->float('valorComIva')->nullable(true); 
            $table->float('valorDoIva')->nullable(true); 
            $table->float('desconto')->nullable(true);
            $table->string('observacoes')->nullable(true); 
            $table->string('condicoesEntrega')->nullable(true); 
            $table->string('condicoesPagamento')->nullable(true); 
            $table->integer('fk_orcamentoRevisao')->unsigned()->nullable(true); 
            $table->foreign('fk_orcamentoRevisao')->references('pk_orcamento')->on('orcamentos'); 
            $table->integer('fk_responsavel')->unsigned()->nullable(true); 
            $table->foreign('fk_responsavel')->references('id')->on('users'); 
            $table->integer('fk_cliente')->unsigned()->nullable(true); 
            $table->foreign('fk_cliente')->references('pk_cliente')->on('clientes'); 
            $table->integer('fk_potCliente')->unsigned()->nullable(true); 
            $table->foreign('fk_potCliente')->references('pk_potencialCliente')->on('potencialclientes'); 
            $table->integer('fk_prazo')->unsigned()->nullable(true); 
            $table->foreign('fk_prazo')->references('pk_prazo')->on('orc_prazos');  
            $table->integer('fk_estado')->unsigned()->nullable(true); 
            $table->foreign('fk_estado')->references('pk_orcEstado')->on('orc_estado'); 
            $table->integer('fk_tipo')->unsigned()->nullable(true); 
            $table->foreign('fk_tipo')->references('pk_orcTipo')->on('orc_tipos'); 
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
        Schema::dropIfExists('orcamentos');
    }
}
