<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrucaoProducaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrucao_producaos', function (Blueprint $table) {
          
            $table->increments('pk_instrucaoProducao');
            $table->integer('duracaoProducao')->nullable(true); 
            $table->text('guiaProducao')->nullable(true); 
            $table->float('custoPrevisto')->nullable(true); 
            $table->string('observacoes')->nullable(true); 
            $table->boolean('ativo')->default(1);
            $table->integer('fk_produto')->unsigned()->nullable(true); 
            $table->foreign('fk_produto')->references('pk_artigo')->on('artigos'); 
            $table->integer('fk_criadoPor')->unsigned()->nullable(true); 
            $table->foreign('fk_criadoPor')->references('id')->on('users'); 
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
        Schema::dropIfExists('instrucao_producaos');
    }
}
