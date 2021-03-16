<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtigoscomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigos_compra', function (Blueprint $table) {
            $table->increments('pk_artigocompra');
            $table->float('precoTotal', 5, 2)->nullable(true);
            $table->float('precoUnitario', 5, 2)->nullable(true);
            $table->float('quantidade', 5, 2)->nullable(true);
            $table->integer('fk_compra')->unsigned()->nullable(true); 
            $table->foreign('fk_compra')->references('pk_compra')->on('compras'); 
            $table->integer('fk_artigo')->unsigned()->nullable(true); 
            $table->foreign('fk_artigo')->references('pk_artigo')->on('artigos');
            $table->integer('fk_tecnico')->unsigned()->nullable(true); 
            $table->foreign('fk_tecnico')->references('id')->on('users');
            $table->boolean('acerto')->default(1);
            $table->integer('fk_inventario')->unsigned()->nullable(true); 
            $table->foreign('fk_inventario')->references('pk_inventario')->on('inventarios');

            $table->string('observacoes')->nullable(true);
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
        Schema::dropIfExists('artigoscompras');
    }
}
