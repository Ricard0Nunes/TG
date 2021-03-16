<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('pk_compra');
            $table->dateTime('dataCompra')->nullable(true);
            $table->dateTime('dataFechoCompra')->nullable(true);
            $table->dateTime('dataRecebimento')->nullable(true);
            $table->dateTime('dataPrevistaChega')->nullable(true);
            
            $table->float('preco', 7, 2)->nullable(true);
            $table->float('peso', 5, 2)->nullable(true);
            $table->integer('nArtigos')->nullable(true);
            $table->string('observacoes')->nullable(true);
            $table->integer('fk_fornecedor')->unsigned()->nullable(true); 
            $table->foreign('fk_fornecedor')->references('pk_fornecedor')->on('fornecedores'); 
            $table->integer('fk_estadoCompra')->unsigned()->nullable(true); 
            $table->foreign('fk_estadoCompra')->references('pk_estadocompra')->on('estado_compra'); 
            $table->integer('fk_responsavel')->unsigned()->nullable(true); 
            $table->foreign('fk_responsavel')->references('id')->on('users');
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
        Schema::dropIfExists('compra');
    }
}
