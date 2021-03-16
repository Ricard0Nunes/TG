<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sigla');
            $table->string('name');
            $table->string('nomeCompleto')->nullable(true);
            $table->string('email')->unique();//email profissional
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('sexo')->nullable(true); 
            $table->date('dtnsc')->nullable(true); 
            $table->string('morada')->nullable(true);
            $table->string('foto')->nullable(true);
            $table->string('emailPessoal')->nullable(true);
            $table->string('contactoPessoal')->nullable(true);
            $table->string('contactoProfissional')->nullable(true);
            $table->string('contactoEmergencia')->nullable(true);
            $table->string('custoHora')->nullable(true);
            $table->string('bi')->nullable(true)->unique();
            $table->string('nif')->nullable(true)->unique();
            $table->string('segSocial')->nullable(true)->unique();
            $table->boolean('visivel')->nullable(true)->default(1); 
            $table->boolean('subcontratado')->nullable(true)->default(0); 
            $table->boolean('status')->nullable(true)->default(0); 
            $table->float('salarioBase',2)->nullable(true)->default(0); 
            $table->string('iban')->nullable(true);
            $table->date('validadecc')->nullable(true); 
            $table->boolean('cartaConducao')->nullable(true)->default(0); 
            $table->boolean('estadoCivil')->nullable(true)->default(0); 
            $table->string('numeroFilhos')->nullable(true)->default(0); 
            $table->date('dataInicioContrato')->nullable(true); 
            $table->date('dataFimContrato')->nullable(true); 
            $table->integer('fk_cargo')->unsigned()->nullable(true); 
            $table->foreign('fk_cargo')->references('pk_cargo')->on('cargos'); 
            $table->integer('fk_departamento')->unsigned()->nullable(true); 
            $table->foreign('fk_departamento')->references('pk_departamento')->on('departamentos'); 
            $table->integer('fk_nivelAcesso')->unsigned()->nullable(true); 
            $table->foreign('fk_nivelAcesso')->references('pk_nivelAcesso')->on('nivel_acessos'); 
            $table->integer('fk_horario')->unsigned()->nullable(true); 
            $table->foreign('fk_horario')->references('pk_horario')->on('horarios'); 
            $table->integer('fk_empresa')->unsigned()->nullable(true); 
            $table->string('nifEmpregador')->nullable(true);
            $table->string('skype')->nullable(true);
            $table->string('pin')->nullable(true)->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
