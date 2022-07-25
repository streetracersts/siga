<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navio extends Model
{
    protected $primaryKey = 'id';
    protected $table ='navios';
    protected $fillable = [
        'nome',
        'bandeira',
        'porto_registro',
    ];
}
