<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtigoOrcamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigo_orcamento', function (Blueprint $table) {
          
                $table->increments('pk_artigoorcamento');
                $table->float('quantidade')->nullable(true); 
                $table->float('precounitario')->nullable(true); 
                $table->float('valorSemIva')->nullable(true); 
                $table->float('valorDoIva')->nullable(true);  
                $table->float('totalComIva')->nullable(true); 
                $table->float('desconto')->nullable(true);
                $table->float('valordesconto')->nullable(true);
                $table->string('observacoes')->nullable(true); 
                $table->boolean('visivelobs')->default(0);
                $table->integer('fk_iva')->unsigned()->nullable(true); 
                $table->foreign('fk_iva')->references('pk_iva')->on('ivas'); 
                $table->integer('fk_artigo')->unsigned()->nullable(true); 
                $table->foreign('fk_artigo')->references('pk_artigo')->on('artigos'); 
                $table->integer('fk_orcamento')->unsigned()->nullable(true); 
                $table->foreign('fk_orcamento')->references('pk_orcamento')->on('orcamentos'); 
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
        Schema::dropIfExists('artigo_orcamento');
    }
}
