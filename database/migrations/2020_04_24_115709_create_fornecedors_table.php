<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('pk_fornecedor'); 
            $table->string('NIF')->unique(); 
            $table->string('nomeCompleto');
            $table->string('nomeAbreviado');
            $table->boolean('visivel')->default(1);
            $table->string('email');
            $table->string('morada');
            $table->string('contacto');
            $table->integer('avaliacao')->nullable(true);
            $table->text('observacoes')->nullable(true);
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
        Schema::dropIfExists('fornecedors');
    }
}
