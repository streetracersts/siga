<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPessoa extends Model
{
    protected $table ='tipo_pessoa';
    protected $fillable = [
        'id',
        'tipo'
    ];
}
