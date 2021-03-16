<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCaixaMsgsGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixaMsgGrupo', function (Blueprint $table) {
            $table->increments('pk_caixaEntradaGrupo');
            $table->integer('proprietario')->unsigned()->nullable(); 
            $table->foreign('proprietario')->references('id')->on('users');
            $table->string('participantes')->nullable(); 
            $table->string('titulo')->nullable();
            $table->integer('fk_projeto')->unsigned()->nullable(true);
            $table->foreign('fk_projeto')->references('pk_projeto')->on('projetos'); 
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
        Schema::dropIfExists('caixaMsgsGrupo');
    }
}
