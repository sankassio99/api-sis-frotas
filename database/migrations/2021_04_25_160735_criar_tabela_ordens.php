<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaOrdens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->string('origem');
            $table->string('destino');
            $table->date('data');
            $table->time('hora');
            $table->double('distancia');
            $table->integer('veiculo_id');
            $table->integer('condutor_id');

            $table->foreign('veiculo_id')
                ->references('id')
                ->on('veiculos');

            $table->foreign('condutor_id')
                ->references('id')
                ->on('condutors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens');
    }
}
