<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaixamensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixa_entradas', function (Blueprint $table) {
            $table->increments('pk_caixaEntrada');
            $table->integer('proprietario')->unsigned()->nullable(); //Foreign key da colaborador que criou o processo.
            $table->foreign('proprietario')->references('id')->on('users'); //Criação da ligação à tabela colaborador.
            $table->integer('destinatario')->unsigned()->nullable(); //Foreign key da colaborador que criou o processo.
            $table->foreign('destinatario')->references('id')->on('users'); //Criação da ligação à tabela colaborador.

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
        Schema::dropIfExists('caixa_entradas');
    }
}
