<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenciamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  Schema::enableForeignKeyConstraints();
        Schema::connection('licenciamento')->create('licenciamento', function (Blueprint $table) {
            $table->increments('pk_licenciamento');
            $table->string('codigoAtivacao');
            $table->date('dataLicenca');
            $table->integer('nUsers');
            $table->string('versao')->nullable(true)->default(0);
            $table->boolean('visivel')->default(1);
            $table->integer('fk_sn')->unsigned(); 
            $table->foreign('fk_sn')->references('pk_serial')->on('serial'); 
            $table->integer('fk_empresa')->unsigned(); 
            $table->foreign('fk_empresa')->references('pk_empresa')->on('empresas_licenciamento'); 
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
        Schema::connection('another')->dropIfExists('Licenciamento');
    }
}
