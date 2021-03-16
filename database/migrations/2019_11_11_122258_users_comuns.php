<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersComuns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('usersComuns', function (Blueprint $table) {
            $table->increments('pk_user'); 
            $table->integer('BI')->unique(); 
            $table->integer('nifempresa');
            $table->integer('sigla');
            $table->string('nome');
            $table->integer('saldo')->default(0);
            $table->integer('anoAnt')->default(0);
            $table->integer('ano')->default(0);
            $table->integer('anoProx')->default(0);
            $table->boolean('requisicaoEquipamento')->default(0);
            $table->boolean('visivel')->default(1);

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
        //
    }
}
