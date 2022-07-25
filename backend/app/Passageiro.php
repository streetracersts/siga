<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passageiro extends Model
{
    protected $primaryKey = 'id';
    protected $table ='passageiros';
    protected $fillable = [
        'nome',
        'documento',
    ];
}
