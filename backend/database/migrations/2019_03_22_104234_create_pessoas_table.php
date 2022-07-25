<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tipo_pessoa');
            $table->string('apelido')->unique();
            $table->string('nome_razao')->nullable();
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('rg')->nullable();
            $table->string('o_emissor')->nullable();
            $table->date('data_emissao')->nullable();
            $table->string('cnh')->nullable();
            $table->string('cnh_categoria')->nullable();
            $table->string('n_ctps')->nullable();
            $table->string('serie_ctps')->nullable();
            $table->string('pis')->nullable();
            $table->string('im')->nullable();
            $table->string('ie')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();;
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('pais')->nullable();
            $table->string('telefone1');
            $table->string('telefone2')->nullable();
            $table->string('email')->nullable();
            $table->text('obs')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
        Schema::table('pessoas', function (Blueprint $table) {
            $table->foreign('id_tipo_pessoa')->references('id')->on('tipo_pessoa');                     
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
