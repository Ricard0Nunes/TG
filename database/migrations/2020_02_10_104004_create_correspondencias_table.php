<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrespondenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondencias', function (Blueprint $table) {
            $table->bigIncrements('pk_correspondencia');
            $table->string('remetente')->nullable(true);
            $table->string('ano')->nullable(true);
            $table->integer('contador')->nullable(true); 
            $table->boolean('interna')->default(1)->nullable(true);
            $table->string('diaRecebimento')->nullable(true);
            $table->integer('fk_recetor')->unsigned()->nullable(true); 
            $table->foreign('fk_recetor')->references('id')->on('users'); 
            $table->integer('fk_destinatario')->unsigned()->nullable(true); 
            $table->foreign('fk_destinatario')->references('id')->on('users'); 
            $table->string('cliente')->nullable(true);
            $table->string('localRecebimento')->nullable(true);
            $table->string('diaEntrega')->nullable(true);
            $table->string('diaConfirmacaoEntrega')->nullable(true);
            $table->boolean('entregue')->default(0)->nullable(true);
            $table->string('comentario')->nullable(true);
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
        Schema::dropIfExists('correspondencias');
    }
}
