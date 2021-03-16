<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->increments('pk_mensagem');
            $table->integer('caixa')->unsigned()->nullable(); 
            $table->foreign('caixa')->references('pk_caixaEntrada')->on('caixa_entradas'); 
            $table->integer('caixaGrupo')->unsigned()->nullable(); 
            $table->foreign('caixaGrupo')->references('pk_caixaEntradaGrupo')->on('caixaMsgGrupo'); 
            $table->integer('remetente')->unsigned()->nullable(); 
            $table->foreign('remetente')->references('id')->on('users'); 
            $table->integer('lido')->nullable()->default(0);
            $table->string('mensagem');
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
        Schema::dropIfExists('mensagens');
    }
}
