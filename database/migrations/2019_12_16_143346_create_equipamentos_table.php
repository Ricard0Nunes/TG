<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('equipamentos', function (Blueprint $table) {
            $table->increments('pk_equipamento');
            $table->string('marca')->nullable(true); 
            $table->string('modelo')->nullable(true); 
            $table->string('codigo')->nullable(true); 
            $table->date('dataAquisicao')->nullable(true); 
            $table->boolean('requisitado')->nullable(true); 
            $table->string('fornecedor')->nullable(true); 
            $table->string('observacoes')->nullable(true); 
            $table->string('fatura')->nullable(true); 
            $table->string('status')->nullable(true); 
            $table->string('SI')->nullable(true); 
            $table->string('numeroSerie')->nullable(true); 
            $table->string('defeito')->nullable(true); 
            $table->integer('nifEmpresa')->nullable(true); 
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
        Schema::connection('geraltg')->dropIfExists('equipamentos');
    }
}
