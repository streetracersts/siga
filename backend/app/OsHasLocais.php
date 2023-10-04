<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OsHasLocais extends Model
{
    protected $table ='os_has_locais';
    protected $fillable = [
        'id_os',
        'id_local'
    ];
}
