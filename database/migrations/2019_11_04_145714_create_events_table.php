<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('geraltg')->create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('subject')->nullable(true); ;
            $table->string('fk_tecnico')->nullable(true); 
            $table->string('color')->nullable(true); 
            $table->string('obs')->nullable(true); 
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
        Schema::dropIfExists('events');
    }
}
