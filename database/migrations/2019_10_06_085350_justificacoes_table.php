<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JustificacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('justificacoes', function (Blueprint $table) {
            $table->increments('pk_justificacao');
            $table->string('descricao');
            $table->boolean('duracaoHoras')->nullable(true)->default(0);
            $table->boolean('comRetribuicao')->nullable(true)->default(0);
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
        Schema::connection('geraltg')->dropIfExists('justificacoes');
            //
        
    }
}
