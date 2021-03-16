<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAusenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('ausencias', function (Blueprint $table) {
            $table->increments('pk_ausencia');
            $table->string('biuser')->nullable(true);
            $table->string('start')->nullable(true);
            $table->string('end')->nullable(true);
            $table->boolean('estado')->default(0);
            $table->string('aprovadoPor')->nullable(true);
            $table->integer('fk_justificacao')->unsigned()->nullable(true); 
            $table->foreign('fk_justificacao')->references('pk_justificacao')->on('justificacoes'); 
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
        Schema::connection('geraltg')->dropIfExists('ausencias');
    }
}
