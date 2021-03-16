<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParagensEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('paragens_empresa', function (Blueprint $table) {
            $table->increments('pk_paragem');
            $table->string('descricao')->nullable(true);
            $table->string('ano')->nullable(true);
            $table->date('dia')->nullable(true);
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
        Schema::dropIfExists('paragens_empresa');
    }
}
