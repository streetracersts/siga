<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'pessoas';
	//protected $dates = ['data_nascimento'];
    protected $fillable = [
    	'id_tipo_pessoa',
    	'apelido',
    	'nome_razao',
		'cpf',
		'cnpj',
		'rg',
		'o_emissor',
		'data_emissao',
		'cnh',
		'cnh_categoria',
		'n_ctps',
		'serie_ctps',
		'pis',
    	'im', 
		'ie',
		'data_nascimento',
    	'cep',
    	'endereco',
    	'numero',
    	'complemento',
    	'bairro',
    	'cidade',
    	'uf',
    	'pais',
    	'telefone1',
		'telefone2',
		'email',
		'obs',
		'status'
	];
}
