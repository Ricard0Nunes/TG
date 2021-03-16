<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->increments('pk_artigo');
            $table->string('sku');
            $table->string('descricao');
            $table->string('caracteristicas')->nullable(true);
            $table->float('precoCompra', 5, 2)->nullable(true);
            $table->string('foto')->nullable(true);
            $table->float('peso', 5, 2)->nullable(true);
            $table->boolean('descontinuado')->default(0);
            $table->boolean('tipoartigo')->nullable(true);
            $table->integer('fk_familiaartigos')->unsigned()->nullable(true); 
            $table->foreign('fk_familiaartigos')->references('pk_familiaartigos')->on('familia_artigos'); 
            $table->integer('fk_iva')->unsigned()->nullable(true); 
            $table->foreign('fk_iva')->references('pk_iva')->on('ivas'); 
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
        Schema::dropIfExists('artigos');
    }
}
