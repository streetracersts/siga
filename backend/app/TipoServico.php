<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoServico extends Model
{
    protected $primaryKey = 'id';
    protected $table ='tipo_servico';
    protected $fillable = [
        'tipo',
        'descricao'
    ];
}
