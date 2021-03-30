<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaProdutoInstrucaoProducaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_produto__instrucao_producaos', function (Blueprint $table) {
            $table->increments('pk_listaProduto');
            $table->float('quantidade')->nullable(true);  
            $table->string('observacoes')->nullable(true); 
            $table->integer('fk_produto')->unsigned()->nullable(true); 
            $table->foreign('fk_produto')->references('pk_artigo')->on('artigos'); 
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
        Schema::dropIfExists('lista_produto__instrucao_producaos');
    }
}
