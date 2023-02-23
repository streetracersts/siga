<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $primaryKey = 'id';
    protected $table ='contatos';
    protected $fillable = [
        'id_pessoa',
        'nome',
        'setor',
        'contato_direto',
    ];
}
