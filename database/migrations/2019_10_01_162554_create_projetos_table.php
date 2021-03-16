<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->increments('pk_projeto'); 
            $table->string('codProj');
            $table->string('nomeProjeto');
            $table->string('descricaoProjeto');
            $table->date('dataPrevistaInicio');
            $table->date('dataInicio')->nullable(true);
            $table->date('dataPrevistaFim')->nullable(true);
            $table->date('dataFim')->nullable(true);
            $table->decimal('custoPrevisto', 10, 2);
            $table->decimal('custoReal', 10, 2)->nullable(true)->default(0);
            $table->integer('horasPrevistas')->nullable(true);
            $table->integer('horasGastas')->nullable(true)->default(0);
            $table->text('observacoes')->nullable(true);
            $table->boolean('visivel')->default(1);
            $table->integer('fk_areaProj')->unsigned(); 
            $table->foreign('fk_areaProj')->references('pk_area')->on('areas'); 
            $table->integer('fk_urgencia')->unsigned(); 
            $table->foreign('fk_urgencia')->references('pk_urgencia')->on('urgencias'); 
            $table->integer('fk_criadoPor')->unsigned(); 
            $table->foreign('fk_criadoPor')->references('id')->on('users'); 
            $table->integer('fk_responsavel')->unsigned(); 
            $table->foreign('fk_responsavel')->references('id')->on('users'); 
            $table->integer('fk_cliente')->unsigned(); 
            $table->foreign('fk_cliente')->references('pk_cliente')->on('clientes');  
            $table->integer('fk_empresa')->unsigned(); 
            $table->foreign('fk_empresa')->references('pk_empresa')->on('empresas'); 
            $table->integer('fk_estadoproj')->unsigned(); 
            $table->foreign('fk_estadoproj')->references('pk_estadoProjeto')->on('estadoprojetos'); 
            $table->integer('fk_orcamento')->unsigned()->nullable(true); 
            $table->foreign('fk_orcamento')->references('pk_orcamento')->on('orcamentos'); 
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
        Schema::dropIfExists('projetos');
    }
}
