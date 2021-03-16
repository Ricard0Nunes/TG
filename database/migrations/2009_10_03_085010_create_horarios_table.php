<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('pk_horario'); 
            $table->string('descricao');
            $table->time('horaEntrada');
            $table->time('horaSaida');
            $table->time('duracaoAlmoco');
            $table->time('almocoApartir');
            $table->time('almocoAte');
            $table->time('horasDiarias');
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
        Schema::dropIfExists('horarios');
    }
}
