<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicaoSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('requisicao_salas', function (Blueprint $table) {
            $table->increments('pk_requisicaosala');
            $table->date('data');
            $table->time('horaInicio');
            $table->time('horaFim');
            $table->string('requisitadoPor');
            $table->string('observacoes')->nullable(true);
            $table->integer('fk_sala')->unsigned()->nullable();
            $table->foreign('fk_sala')->references('pk_sala')->on('salas');
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
        Schema::dropIfExists('requisicao_salas');
    }
}
