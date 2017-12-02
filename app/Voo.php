<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voo extends Model
{
    
    public function aeronave(){
        return $this->hasOne('App\Aeronave');
    }

    public function aeroportoOrigem(){
        return $this->hasOne('App\Aeroporto');        
    }

    public function aeroportoDestino(){
        return $this->hasOne('App\Aeroporto');
    }

}
