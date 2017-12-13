<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Voo extends Model
{

    protected $fillable = [
        'numero', 'data', 'hora', 'aeronave_id', 'origem_id', 'destino_id'
    ];

    protected $guarded = [
        'timestamps'
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
            return response()->json(['response' => 'Erro ao cadastrar!', 'request' => $request, 'error' => $e->getMessage()], 400);

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
            ->orderBy('v.id','desc')
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
            ->select('v.id','v.numero','v.data','v.hora','v.aeronave_id', 'v.origem_id', 'v.destino_id')
            ->get();

        //Verifica se existe um voo com o ID informado
        if(!$voo)
        {
            return response()->json(['response' => 'Não existe voo cadastrado com o ID '.$id], 200);
        }

        $voo = json_encode($voo[0]);
        return $voo;
    }

    public function updateVoo($request, $id){

        $voo = Voo::find($id);
        
        if(!$voo)
        {
            return response()->json(['response' => 'Voo não encontrado!', 'dados' => $voo], 400);
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