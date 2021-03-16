<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('processamentos', function (Blueprint $table) {
            $table->increments('pk_processamento');
            $table->string('userBi')->nullable(true);
            $table->string('nome')->nullable(true);
            $table->string('nifEmpresa')->nullable(true);
            $table->string('intervaloProcessamento')->nullable(true);
            $table->string('mes')->nullable(true);
            $table->integer('diasTrabalhados')->nullable(true);
            $table->integer('diasUteis')->nullable(true);
            $table->integer('ferias')->nullable(true);
            $table->integer('diasSubsidioAlimentacao')->nullable(true);
            $table->integer('diasFaltasInjustificadas')->nullable(true);
            $table->integer('diasFaltasComRetribuicao')->nullable(true);
            $table->integer('diasFaltasSemRetribuicao')->nullable(true);
            $table->string('observacoes')->nullable(true);



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
        Schema::connection('geraltg')->dropIfExists('processamentos');
    }
}
