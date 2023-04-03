<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oss', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_pessoa');
            $table->unsignedInteger('id_navio');
            $table->unsignedInteger('id_tipo_servico');
            $table->text('descricao_servico');
            $table->integer('status_os');
            $table->dateTime('data_hora_inicio')->nullable();
            $table->dateTime('data_hora_termino')->nullable();
            $table->unsignedInteger('km_inicial')->nullable();
            $table->unsignedInteger('km_final')->nullable();
            $table->text('obs')->nullable();
            $table->unsignedInteger('id_motorista');
            $table->timestamps();
        });                                                     
        Schema::table('oss', function (Blueprint $table) {
            $table->foreign('id_navio')->references('id')->on('navios');           
            $table->foreign('id_pessoa')->references('id')->on('pessoas');  
            $table->foreign('id_tipo_servico')->references('id')->on('tipo_servico');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oss');
    }
}
