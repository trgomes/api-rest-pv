<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getAllVoos(){
        $voos = DB::table('voos as v')
            ->join('aeronaves as a', 'v.aeronave_id', '=', 'a.id')
            ->join('aeroportos as ao', 'v.origem_id', '=', 'ao.id') 
            ->join('aeroportos as ad', 'v.destino_id', '=', 'ad.id')          
            ->select('v.id','v.numero','v.data','v.hora','a.matricula', 'a.tipo', 'ao.nome as origem', 'ad.nome as destino')
            ->get();
            
        return $voos;
    }

    public function getById($id){
        $voo = DB::table('voos as v')
            ->join('aeronaves as a', 'v.aeronave_id', '=', 'a.id')
            ->join('aeroportos as ao', 'v.origem_id', '=', 'ao.id') 
            ->join('aeroportos as ad', 'v.destino_id', '=', 'ad.id') 
            ->where('v.id', '=', $id)         
            ->select('v.id','v.numero','v.data','v.hora','a.matricula', 'a.tipo', 'ao.nome as origem', 'ad.nome as destino')            
            ->get();
            
        return $voo;
    }

}
