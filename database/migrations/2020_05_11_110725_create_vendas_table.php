<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('pk_venda');
            $table->dateTime('dataVenda')->nullable(true);
            $table->dateTime('dataFechoVenda')->nullable(true);
            $table->dateTime('dataRecebimento')->nullable(true); 
            $table->float('preco', 7, 2)->nullable(true);
            $table->float('peso', 5, 2)->nullable(true);
            $table->integer('nArtigos')->nullable(true);
            $table->string('observacoes')->nullable(true);
            $table->integer('fk_cliente')->unsigned()->nullable(true); 
            $table->foreign('fk_cliente')->references('pk_cliente')->on('clientes'); 
            $table->integer('fk_estadovenda')->unsigned()->nullable(true); 
            $table->foreign('fk_estadovenda')->references('pk_estadovenda')->on('estado_vendas'); 
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
        Schema::dropIfExists('vendas');
    }
}
