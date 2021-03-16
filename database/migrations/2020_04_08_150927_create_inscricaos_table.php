<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricaos', function (Blueprint $table) {
            $table->increments('pk_inscricao');

            $table->integer('fk_user')->unsigned();
            $table->foreign('fk_user')->references('id')->on('users');

            $table->integer('fk_formacao')->unsigned();
            $table->foreign('fk_formacao')->references('pk_formacao')->on('formacoes');

            $table->dateTime('data_inscricao');
            $table->string('avaliacao_user')->nullable(true);
            $table->string('avaliacao_formador')->nullable(true);
            $table->string('observacao')->nullable(true);
          
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
        Schema::dropIfExists('inscricaos');
    }
}
