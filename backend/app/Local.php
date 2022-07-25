<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $primaryKey = 'id';
    protected $table ='locais';
    protected $fillable = [
        'nome_local',
        'lat',
        'long',
    ];
}
