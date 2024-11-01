<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class drives extends Model
{
    protected $fillable = [
        'ID_DRIVE',
        'ID_CASA',
        'LIGA'
    ];
    protected $primaryKey = 'ID_DRIVE';
    public $timestamps = false;

}
