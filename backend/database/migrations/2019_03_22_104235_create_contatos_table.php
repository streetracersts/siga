<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_pessoa');
            $table->string('nome')->unique();
            $table->string('setor')->nullable();
            $table->string('contato_direto');
            $table->timestamps();
        });
        Schema::table('contatos', function (Blueprint $table) {
            $table->foreign('id_pessoa')->references('id')->on('pessoas');                     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatos');
    }
}
