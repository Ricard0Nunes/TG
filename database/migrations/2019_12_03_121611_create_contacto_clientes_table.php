<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactoClientes', function (Blueprint $table) {
            $table->increments('pk_contacto');
            $table->string('nome')->nullable(true);
            $table->string('funcao')->nullable(true);
            $table->string('contacto1')->nullable(true);
            $table->string('contacto2')->nullable(true);
            $table->string('email')->nullable(true);
            $table->integer('fk_cliente')->unsigned()->nullable(true); 
            $table->foreign('fk_cliente')->references('pk_cliente')->on('clientes'); 
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
        Schema::dropIfExists('contacto_clientes');
    }
}
