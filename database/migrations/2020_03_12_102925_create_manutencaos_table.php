<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('manutencaos', function (Blueprint $table) {

            $table->increments('pk_manutencao');

            $table->dateTime('dataInicio');
            $table->dateTime('dataFim')->nullable(true);
            $table->string('descricaoProblema')->nullable(true);
            $table->string('resolucaoProblema')->nullable(true);
            $table->string('observacoes')->nullable(true);
            $table->dateTime('proximaVerificacao')->nullable(true);
            $table->integer('tecnico');
            $table->boolean('concluido')->default(0);

            $table->integer('fk_tipo')->unsigned();
            $table->foreign('fk_tipo')->references('pk_tipo')->on('tipo_manutencao');

            $table->integer('fk_equipamento')->unsigned()->nullable(true);
            $table->foreign('fk_equipamento')->references('pk_equipamento')->on('equipamentos');

            $table->integer('fk_veiculo')->unsigned()->nullable(true);
            $table->foreign('fk_veiculo')->references('pk_veiculo')->on('veiculos');
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
        Schema::dropIfExists('manutencaos');
    }
}
