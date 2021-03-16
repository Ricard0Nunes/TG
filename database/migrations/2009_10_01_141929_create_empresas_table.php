<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('pk_empresa'); 
            $table->string('logo')->nullable(true);
            $table->integer('NISS')->unique()->nullable(true);;
            $table->integer('NIF')->unique(); 
            $table->string('nomeCompleto');
            $table->string('nomeAbreviado');
            $table->boolean('visivel')->default(1);
            $table->string('email');
            $table->string('morada');
            $table->string('contacto');
            $table->time('horarioAbertura');
            $table->time('horarioFecho');
            $table->text('observacoes')->nullable(true);
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
        Schema::dropIfExists('empresas');
    }
}
