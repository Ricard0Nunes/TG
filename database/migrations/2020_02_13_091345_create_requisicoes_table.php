<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('requisicoescarro', function (Blueprint $table) {
            $table->increments('pk_requisicao');
            $table->date('dataPartida')->nullable(true);
            $table->time('partidaPrevista')->nullable(true);
            $table->time('chegadaPrevista')->nullable(true);
            $table->string('rota')->nullable(true);
            $table->string('requisitadoPor')->nullable(true);
            $table->text('ocupantes')->nullable(true);
            $table->string('aprovadpPor')->nullable(true);
            $table->text('motivo')->nullable(true);//projetos/empresa
            $table->boolean('validado')->default(0);
            $table->time('horaPartida')->nullable(true);
            $table->time('horaChegada')->nullable(true);
            $table->string('kmIniciais')->nullable(true);
            $table->string('kmFinais')->nullable(true);
            $table->string('kmtotal')->nullable(true);
            $table->string('autonomiaInicial')->nullable(true);
            $table->string('autonomiaFinal')->nullable(true);
            $table->string('localPartida')->nullable(true);
            $table->string('localChegada')->nullable(true);
            $table->string('gastosCombustivel')->nullable(true);
            $table->string('gastosPortagens')->nullable(true);
            $table->string('gastosOutros')->nullable(true);
            $table->string('gastosEstacionamento')->nullable(true);
            $table->string('notas')->nullable(true);
            $table->integer('fk_veiculo')->unsigned()->nullable(); //Foreign key da colaborador que criou o processo.
            $table->foreign('fk_veiculo')->references('pk_veiculo')->on('veiculos'); //Criação da ligação à tabela colaborador.
    
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
        Schema::connection('geraltg')->dropIfExists('requisicaos');
    }
}
