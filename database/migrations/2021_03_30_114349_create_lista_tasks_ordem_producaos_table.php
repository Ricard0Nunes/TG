<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaTasksOrdemProducaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_tasks_ordem_producaos', function (Blueprint $table) {
            $table->increments('pk_listaTasksOrdemProducao');
            $table->integer('fk_ordemProducao')->unsigned()->nullable(true);
            $table->foreign('fk_ordemProducao')->references('pk_ordemProducao')->on('ordem_producaos');   
            $table->integer('fk_tasks')->unsigned()->nullable(true);
            $table->foreign('fk_tasks')->references('id')->on('tasks'); 
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
        Schema::dropIfExists('lista_tasks_ordem_producaos');
    }
}
