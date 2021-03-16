<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('registoPontos', function (Blueprint $table) {
            $table->increments('pk_ponto'); 
            $table->string('dia')->nullable();
            $table->date('data')->nullable();
            $table->time('entradaManha')->nullable();
            $table->time('saidaManha')->nullable();
            $table->time('entradaTarde')->nullable();
            $table->time('saidaTarde')->nullable();
            $table->time('totalDia')->nullable();
            $table->time('tempoAlmoco')->nullable();
            $table->string('comentario')->nullable()->default(null);
            $table->integer('fk_tipo')->unsigned(); 
            $table->foreign('fk_tipo')->references('pk_tipoPicagem')->on('tipopicagens');     
            $table->integer('fk_justificacao')->unsigned()->default(0);
            $table->foreign('fk_justificacao')->references('pk_justificacao')->on('justificacoes');    
            $table->integer('nifempresa');
            $table->integer('empresapicagem');
            $table->integer('ccuser');
            $table->boolean('estado')->default(0);
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
        Schema::connection('geraltg')->dropIfExists('registoPontos');
    }
}
