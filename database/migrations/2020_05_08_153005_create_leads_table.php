<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('pk_lead');
            $table->datetime('inicio');
            $table->datetime('fim');
            $table->string('objetivo');
            $table->string('notas')->nullable(true);
            $table->integer('fk_responsavel')->unsigned();
            $table->foreign('fk_responsavel')->references('id')->on('users');
            $table->integer('fk_potencialCliente')->unsigned();
            $table->foreign('fk_potencialCliente')->references('pk_potencialCliente')->on('potencialclientes');
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
        Schema::dropIfExists('leads');
    }
}
