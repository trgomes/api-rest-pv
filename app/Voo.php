<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Voo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero', 'data', 'hora', 'aeronave_id', 'origem_id', 'destino_id'
    ];


    public function aeronave()
    {
        return $this->hasOne('App\Aeronave');
    }


    public function aeroportoOrigem()
    {
        return $this->hasOne('App\Aeroporto');        
    }


    public function aeroportoDestino()
    {
        return $this->hasOne('App\Aeroporto');
    }

    //Cadastra um novo voo
    public function createVoo($request){

        try
        {
            $voo = new Voo([
                'numero' => $request->input('numero'),
                'data' => $request->input('data'),
                'hora' => $request->input('hora'),
                'aeronave_id' => $request->input('aeronave_id'),
                'origem_id'=> $request->input('origem_id'),
                'destino_id' => $request->input('destino_id')
            ]);

            $voo->save();
            return response()->json(['response' => 'Voo cadastrado com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['response' => 'Erro ao cadastrar!'],400);
        }        

    }


    //Retorna todos os voos
    public function getAllVoos()
    {
        $voos = DB::table('voos as v')
            ->join('aeronaves as a', 'v.aeronave_id', '=', 'a.id')
            ->join('aeroportos as ao', 'v.origem_id', '=', 'ao.id') 
            ->join('aeroportos as ad', 'v.destino_id', '=', 'ad.id')          
            ->select('v.id','v.numero','v.data','v.hora','a.matricula', 'a.tipo', 'ao.nome as origem', 'ad.nome as destino')
            ->get();

            //Verifica se existe um voo com o ID informado
        if(!$voos)
        {
            return response()->json(['response' => 'Não existem voos cadastrados'], 200);
        }
            
        return $voos;
    }


    //Retorna apenas o voo especificado pelo ID
    public function getById($id)
    {
        $voo = DB::table('voos as v')
            ->join('aeronaves as a', 'v.aeronave_id', '=', 'a.id')
            ->join('aeroportos as ao', 'v.origem_id', '=', 'ao.id') 
            ->join('aeroportos as ad', 'v.destino_id', '=', 'ad.id') 
            ->where('v.id', '=', $id)         
//            ->select('v.id','v.numero','v.data','v.hora','a.matricula', 'a.tipo', 'ao.nome as origem', 'ad.nome as destino')
            ->select('v.*','a.*', 'ao.id as origem_id', 'ao.nome as origem', 'ad.id as destino_id','ad.nome as destino')
            ->get();

        //Verifica se existe um voo com o ID informado
        if(!$voo)
        {
            return response()->json(['response' => 'Não existe voo cadastrado com o ID '.$id], 200);
        }
            
        return $voo;
    }

    //Retorna o voo de acordo como a ID do aeroporto
    public function getByAirport($id)
    {
        $voo = DB::table('voos as v')
        ->join('aeronaves as a', 'v.aeronave_id', '=', 'a.id')
        ->join('aeroportos as ao', 'v.origem_id', '=', 'ao.id') 
        ->join('aeroportos as ad', 'v.destino_id', '=', 'ad.id') 
        ->where('ao.id', '=', $id)         
        ->select('v.id','v.numero','v.data','v.hora','a.matricula', 'a.tipo', 'ao.nome as origem', 'ad.nome as destino')            
        ->get();

        //Verifica se existe um voo com o ID informado
        if(!$voo)
        {
            return response()->json(['response' => 'Não existe voo cadastrado com o ID '.$id], 200);
        }
            
        return $voo;
    }


    public function updateVoo($request, $id){
        $voo = Voo::find($id);
        
        if(!$voo)
        {
            return response()->json(['response' => 'Voo não encontrado!'], 400);
        }                
              
        $voo->numero = $request->input('numero');
        $voo->data = $request->input('data');
        $voo->hora = $request->input('hora');
        $voo->aeronave_id = $request->input('aeronave_id');
        $voo->origem_id = $request->input('origem_id');
        $voo->destino_id = $request->input('destino_id');
        
        $voo->save();
        return response()->json($voo, 200);
    }


    //Exclui o voo especificado pelo ID
    public function deleteVoo($id){
        $voo = Voo::find($id);

        //Verifica se existe um voo com o ID informado
        if(!$voo)
        {
            return response()->json(['response' => 'Não existe voo cadastrado com o ID '.$id], 200);
        }

        $voo->delete();

        return response()->json(['response' => 'Voo excluido com sucesso'], 200);
    }

}