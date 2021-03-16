<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PedidosPonto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('pedidoAlteracaoPonto', function (Blueprint $table) {
            $table->increments('pk_pedidoAlteracaoPonto'); 
            $table->string('dia')->nullable();
            $table->time('entradaManha')->nullable();
            $table->time('saidaManha')->nullable();
            $table->time('entradaTarde')->nullable();
            $table->time('saidaTarde')->nullable();
            $table->time('entradaManhaNova')->nullable();
            $table->time('saidaManhaNova')->nullable();
            $table->time('entradaTardeNova')->nullable();
            $table->time('saidaTardeNova')->nullable();
            $table->time('totalDia')->nullable();
            $table->time('tempoAlmoco')->nullable();
            $table->string('comentario')->nullable()->default(null);
            $table->integer('fk_tipo')->unsigned()->default(5);; 
            $table->foreign('fk_tipo')->references('pk_tipoPicagem')->on('tipopicagens');     
            $table->integer('fk_justificacao')->unsigned()->default(1);
            $table->foreign('fk_justificacao')->references('pk_justificacao')->on('justificacoes');    
            $table->integer('fk_pontoorigem')->unsigned()->nullable();
            $table->foreign('fk_pontoorigem')->references('pk_ponto')->on('registoPontos');    
            $table->boolean('estado')->default(0);
            $table->string('aprovadoPor')->nullable()->default(null);
            $table->string('nifempresa')->nullable();
            $table->string('ccuser')->nullable();
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
        //
    }
}
