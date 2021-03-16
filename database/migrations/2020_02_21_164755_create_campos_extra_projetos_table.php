<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamposExtraProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campos_extra_projetos', function (Blueprint $table) {
            $table->increments('pk_campoextra');
            $table->string('descricao');
            $table->string('valor');
            $table->integer('fk_projeto')->unsigned()->nullable(); //Foreign key da colaborador que criou o processo.
            $table->foreign('fk_projeto')->references('pk_projeto')->on('projetos'); //Criação da ligação à tabela colab
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
        Schema::dropIfExists('campos_extra_projetos');
    }
}
