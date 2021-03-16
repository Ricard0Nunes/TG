<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoscomclientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactoscomclientes', function (Blueprint $table) {
            $table->increments('pk_contactoscomclientes');   
            $table->dateTime('dataContacto');
            $table->dateTime('proximoContacto');
            $table->string('mensagem')->nullable(true);
            $table->string('mensagemCliente')->nullable(true);
            $table->string('parecer')->nullable(true);
            $table->integer('fk_tipo_contacto')->unsigned();
            $table->foreign('fk_tipo_contacto')->references('pk_tipo_contacto')->on('tipo_contactos');
            $table->integer('fk_responsavel')->unsigned();
            $table->foreign('fk_responsavel')->references('id')->on('users');
            $table->integer('fk_lead')->unsigned();
            $table->foreign('fk_lead')->references('pk_lead')->on('leads');  
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
        Schema::dropIfExists('contactoscomclientes');
    }
}
