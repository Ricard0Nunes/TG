<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('pk_alerta');
            $table->text('mensagem');
            $table->date('de');
            $table->date('a');
            $table->boolean('todos')->default(0);
            $table->string('users');
            $table->integer('fk_user')->nullable(true);
            $table->integer('fk_departamento')->nullable(true);
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
        Schema::dropIfExists('alerts');
    }
}
