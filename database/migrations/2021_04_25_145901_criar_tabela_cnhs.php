<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaCnhs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnhs', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('cpf');
            $table->string('rg');
            $table->date('dataNacimento');
            $table->enum('categoria', ['A', 'B', 'C', 'D', 'E']);
            $table->integer('condutor_id');
    
            $table->foreign('condutor_id')->onDelete('cascade')
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
        Schema::dropIfExists('cnhs');
    }
}
