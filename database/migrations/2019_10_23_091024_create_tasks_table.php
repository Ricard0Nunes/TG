<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table){
            $table->increments('id');
            $table->string('text');
            $table->integer('duration');
            $table->float('progress');
            $table->dateTime('start_date');
            $table->integer('parent');
            $table->integer('tipo'); 
            $table->string('textColor')->nullable(true)->default(null); 
            $table->string('color')->nullable(true)->default(null); 
            $table->dateTime('horaInicioPrev')->nullable(true); 
            $table->dateTime('end_date')->nullable(true); 
            $table->dateTime('horaInicio')->nullable(true); 
            $table->dateTime('horaFimPrev')->nullable(true); 
            $table->time('duracaoHorasReal')->nullable(true)->default('00:00:00');
            $table->time('duracaoHorasEstimado')->nullable(true)->default('00:00:00');
            $table->decimal('custoPrevisto', 10, 2)->nullable(true); ;
            $table->decimal('custoReal', 10, 2)->nullable(true)->default(0);
            $table->string('descricao')->nullable(true); 
            $table->text('relatorio')->nullable(true); 
            $table->string('observação')->nullable(true); 
            $table->boolean('validado')->nullable(true); 
            $table->integer('fk_tecnico')->unsigned()->nullable(true);
            $table->foreign('fk_tecnico')->references('id')->on('users'); 
            $table->integer('fk_projeto')->unsigned()->nullable(true);
            $table->foreign('fk_projeto')->references('pk_projeto')->on('projetos'); 
            $table->integer('fk_estadoIntervencao')->unsigned()->nullable(true); 
            $table->foreign('fk_estadoIntervencao')->references('pk_estadoIntervencoes')->on('estadointervencoes'); 
            $table->integer('origem')->nullable(true);
            $table->boolean('fechado')->nullable(true)->default(0);
            $table->integer('fk_departamento')->unsigned()->nullable(true);; 
            $table->foreign('fk_departamento')->references('pk_departamento')->on('departamentos'); 
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
