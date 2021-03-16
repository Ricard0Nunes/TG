<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('pk_cliente'); 
            $table->string('NIF')->unique(); 
            $table->bigInteger('NISS')->nullable(true); 
            $table->string('nomeCompleto');
            $table->string('nomeAbreviado');
            $table->boolean('visivel')->default(1);
            $table->string('email');
            $table->string('morada');
            $table->string('contacto');
            $table->string('logo')->nullable(true);
            $table->string('contactoAlternativo')->nullable(true);
            $table->boolean('RGPD')->default(0);
            $table->string('nomeAbreviadoRGPD')->nullable(true);
            $table->string('nomeCompletoRGPD')->nullable(true);
            $table->string('emailRGPD')->nullable(true);
            $table->string('moradaRGPD')->nullable(true);
            $table->string('contactoRGPD')->nullable(true);
            $table->string('contactoAlternativoRGPD')->nullable(true);
            $table->string('dadosRGPD')->nullable(true);
            $table->text('observacoes')->nullable(true);
            $table->integer('fk_potencialCliente')->unsigned()->nullable(true); 
            $table->foreign('fk_potencialCliente')->references('pk_potencialCliente')->on('potencialclientes'); 
            $table->integer('fk_empresa')->unsigned()->nullable(true); 
            $table->foreign('fk_empresa')->references('pk_empresa')->on('empresas'); 
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
        Schema::dropIfExists('cliente');
    }
}
