<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('veiculos', function (Blueprint $table) {
            $table->increments('pk_veiculo');
            $table->string('dataMatricula');
            $table->string('matricula');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('kms');
            $table->integer('autonomia');
            $table->string('localizacao')->nullable();
            $table->integer('nifEmpresa')->nullable();
            $table->boolean('ativo')->default(0);
            $table->boolean('visivel')->default(0);
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
        Schema::connection('geraltg')->dropIfExists('veiculos');
    }
}
