<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicaoEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('requisicao_equipamentos', function (Blueprint $table) {
            $table->increments('pk_requisicaoequipamento');
            $table->date('dataInicio');
            $table->date('dataFim')->nullable(true);
            $table->string('cpu');
            $table->string('peri')->nullable(true);
            $table->string('observacoes')->nullable(true);
            $table->string('requisitadoPor');
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
        Schema::dropIfExists('requisicao_equipamentos');
    }
}
