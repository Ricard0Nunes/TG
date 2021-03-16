<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicinas', function (Blueprint $table) {
            $table->bigIncrements('pk_medicina');
            $table->string('tipoExame')->nullable(true);
            $table->date('dataExame')->nullable(true);
            $table->string('resultado')->nullable(true);
            $table->date('proxExame')->nullable(true);
            $table->integer('fk_tecnico')->unsigned()->nullable(true); 
            $table->foreign('fk_tecnico')->references('id')->on('users'); 
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
        Schema::dropIfExists('medicina');
    }
}
