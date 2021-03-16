<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacoes', function (Blueprint $table) {
            $table->increments('pk_formacao');

            $table->integer('fk_formador')->unsigned()->nullable(true);
            $table->foreign('fk_formador')->references('id')->on('users');
            
            $table->string('nome_formacao');
            $table->string('nome_formador')->nullable(true);
            $table->string('entidade_formacao');
            $table->string('dataInicio');
            $table->string('dataFim')->nullable(true);
            $table->integer('horas_formacao');
            $table->string('local_formacao');
            $table->integer('numero_vagas');
            $table->boolean('interno')->default(1);
            $table->string('eficacia_formacao')->nullable(true);
            $table->string('custo_formacao')->nullable(true);
            $table->integer('estado')->nullable(true)->default(0);

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
        Schema::dropIfExists('formacoes');
    }
}
