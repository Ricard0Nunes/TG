<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('salas', function (Blueprint $table) {
            $table->increments('pk_sala');
            $table->string('nome');
            $table->string('local');
            $table->string('lotacao');
            $table->string('custo');
            $table->string('nifEmpresa')->nullable();
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
        Schema::connection('geraltg')->dropIfExists('salas');
    }
}
