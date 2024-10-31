<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class areas extends Model
{
    protected $fillable = [
        'ID_AREA',
        'NOMBRE'
    ];
    protected $primaryKey = 'ID_AREA';
    public $timestamps = false;

}
