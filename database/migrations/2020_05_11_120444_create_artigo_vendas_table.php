<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtigoVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigos_venda', function (Blueprint $table) {
            $table->increments('pk_artigovenda');
            $table->float('precoTotal', 20, 2)->nullable(true);
            $table->float('precoUnitario', 20, 2)->nullable(true);
            $table->float('quantidade', 10, 2)->nullable(true);
            $table->string('observacoes')->nullable(true);
            $table->integer('fk_venda')->unsigned()->nullable(true); 
            $table->foreign('fk_venda')->references('pk_venda')->on('vendas'); 
            $table->integer('fk_artigo')->unsigned()->nullable(true); 
            $table->foreign('fk_artigo')->references('pk_artigo')->on('artigos');
            $table->integer('fk_tecnico')->unsigned()->nullable(true); 
            $table->foreign('fk_tecnico')->references('id')->on('users');
            $table->integer('fk_inventario')->unsigned()->nullable(true); 
            $table->foreign('fk_inventario')->references('pk_inventario')->on('inventarios');
            $table->boolean('acerto')->default(1);

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
        Schema::dropIfExists('artigo_vendas');
    }
}
