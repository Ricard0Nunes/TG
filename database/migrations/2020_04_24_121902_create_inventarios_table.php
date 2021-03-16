<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->increments('pk_inventario');
            $table->float('quantidade', 5, 2)->nullable(true);
            $table->float('ultimoPrecoCompra', 5, 2)->nullable(true);
            $table->integer('fk_armazem')->unsigned()->nullable(true); 
            $table->foreign('fk_armazem')->references('pk_armazem')->on('armazens'); 
            $table->integer('fk_artigo')->unsigned()->nullable(true); 
            $table->foreign('fk_artigo')->references('pk_artigo')->on('artigos');
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
        Schema::dropIfExists('inventarios');
    }
}
