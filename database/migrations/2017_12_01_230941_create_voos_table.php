<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero', 20);
            $table->date('data'); 
            $table->integer('aeronave_id')->unsigned();
            $table->integer('origem_id')->unsigned();
            $table->integer('destino_id')->unsigned();
            // Foreign Key table aeronaves
            $table->foreign('aeronave_id')
            ->references('id')
            ->on('aeronaves'); 
            // Foreign Key table aeroportos
            $table->foreign('origem_id')
            ->references('id')
            ->on('aeroportos');
            // Foreign Key table aeroportos
            $table->foreign('destino_id')
            ->references('id')
            ->on('aeroportos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voos');
    }
}
