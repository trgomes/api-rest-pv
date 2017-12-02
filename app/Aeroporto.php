<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeroporto extends Model
{
    public function vooOrigem(){
        return $this->belongsTo('App\Voo','origem_id');
    }

    public function vooDestino(){
        return $this->belongsTo('App\Voo','destino_id');
    }
}
