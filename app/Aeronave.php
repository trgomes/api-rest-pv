<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
    public function voo(){
        return $this->belongsTo('App\Voo');
    }
}
