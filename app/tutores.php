<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tutores extends Model
{

    protected $fillable = [
        'ID_TUTOR',

        'NOMBRE',
        'CORREO',
    ];


    protected $primaryKey = 'ID_TUTOR';
    public $timestamps = false;

    public function usuario(){
        return $this->morphOne('\App\User', 'userable');
    }

}
