<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotencialclientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potencialclientes', function (Blueprint $table) {
            $table->increments('pk_potencialCliente'); 
            $table->integer('NIF')->unique(); 
            $table->string('nomeCompleto');
            $table->string('nomeAbreviado');
            $table->boolean('visivel')->default(1);
            $table->boolean('convertido')->default(0);
            $table->string('email');
            $table->string('morada');
            $table->string('contacto');
            $table->string('contactoAlternativo')->nullable(true);
            $table->text('observacoes')->nullable(true);
            $table->integer('fk_criador')->unsigned(); 
            $table->foreign('fk_criador')->references('id')->on('users'); 
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
        Schema::dropIfExists('potencialcliente');
    }
}
