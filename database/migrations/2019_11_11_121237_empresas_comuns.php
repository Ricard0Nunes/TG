<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmpresasComuns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('empresasComuns', function (Blueprint $table) {
            $table->increments('pk_empresa'); 
            $table->integer('NIF')->unique(); 
            $table->string('nomeCompleto');
            $table->string('nomeAbreviado');
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
        //
    }
}
