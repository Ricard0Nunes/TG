<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicencaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenca', function (Blueprint $table) {
            $table->increments('pk_licenca');
            $table->string('detentor');
            $table->string('chaveInstalacao');
            $table->string('licenca');
            $table->date('dataLicenca');
            $table->date('dataExpiracao');
            $table->integer('nUsers');
            $table->string('tipoLicenca');
            $table->string('email');
            $table->string('contacto');
            $table->string('versao');
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
        Schema::dropIfExists('licenca');
    }
}
