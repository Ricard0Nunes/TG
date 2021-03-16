<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustosExtraProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('custos_extra_projetos', function (Blueprint $table) {
            $table->increments('pk_custoextra');
            $table->string('nomeProjeto');
            $table->string('nomeSprint');
            $table->integer('fk_projeto');
            $table->integer('fk_sprint');
            $table->string('descricao');
            $table->boolean('processado');
            $table->string('custo');
            $table->integer('fk_requisicao')->unsigned()->nullable(); //Foreign key da colaborador que criou o processo.
            $table->foreign('fk_requisicao')->references('pk_requisicao')->on('requisicoescarro'); //Criação da ligação à tabela colaborador.
            $table->integer('fk_empresa')->unsigned()->nullable(); //Foreign key da colaborador que criou o processo.
            $table->foreign('fk_empresa')->references('pk_empresa')->on('empresascomuns'); //Criação da ligação à tabela colaborador.
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
        Schema::dropIfExists('custos_extra_projetos');
    }
}
