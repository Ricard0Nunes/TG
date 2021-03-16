<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelAcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_acessos', function (Blueprint $table) {
            $table->increments('pk_nivelAcesso');//Primary Key auto incrementada da tabela nivel_acesso
            $table->string('nivel');//Chave de designação de nivel de acesso do tipo String (Administrador, Cliente Utilizador, Cliente Gestor, Técnico e Gestor)
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
        Schema::dropIfExists('nivelAcesso');
    }
}
