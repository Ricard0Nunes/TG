<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmCampanhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_campanhas', function (Blueprint $table) {
            $table->increments('pk_campanha');

            $table->integer('fk_tipo_campanha')->unsigned();
            $table->foreign('fk_tipo_campanha')->references('pk_tipo_campanha')->on('crm_tipo_campanhas');

            $table->integer('fk_responsavel')->unsigned();
            $table->foreign('fk_responsavel')->references('id')->on('users');
            
            $table->dateTime('dataInicio');
            $table->dateTime('dataFim');


            $table->string('observacoes')->nullable(true);
            $table->integer('eficacia')->nullable(true);


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
        Schema::dropIfExists('crm_campanhas');
    }
}
