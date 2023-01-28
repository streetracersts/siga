<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsHasPessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_has_pessoas', function (Blueprint $table) {
            $table->unsignedInteger('id_os');
            $table->unsignedInteger('id_pessoa');
            $table->timestamps();
        });
         Schema::table('os_has_pessoas', function (Blueprint $table) {            
            $table->foreign('id_os')->references('id')->on('oss');           
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
        Schema::dropIfExists('os_has_pessoas');
    }
}
