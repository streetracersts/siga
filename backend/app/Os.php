<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    protected $primaryKey = 'id';
    protected $table ='oss';
    protected $dateFormat = 'Y-m-d G:i:s';
    protected $dates = [
        'data_hora_inicio',
        'data_hora_termino'
    ];
    protected $fillable = [
        'id_pessoa',
        'id_navio',
        'id_tipo_servico',
        'descricao_servico',
        'data_hora_inicio',
        'data_hora_termino',
        'km_inicial',
        'km_final',
        'id_motorista',
        'status_os'
    ];
}
