<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificaçõesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->increments('pk_notificacao'); 
            $table->string('descricao');
            $table->boolean('lida');
            $table->integer('fk_tipoNotificacao')->unsigned();
            $table->foreign('fk_tipoNotificacao')->references('pk_tipoNotificacao')->on('tiponotificacoes');   
            $table->integer('fk_user')->nulable(true)->unsigned();
            $table->foreign('fk_user')->references('id')->on('users');   
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
        Schema::dropIfExists('notificacoes');
    }
}
