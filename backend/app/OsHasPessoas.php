<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OsHasPessoas extends Model
{
    protected $table ='os_has_pessoas';
    protected $fillable = [
        'id_os',
        'id_pessoa'
    ];
}
