<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aeronave extends Model
{

    protected $fillable = [
        'matricula', 'tipo_id'
    ];


    public function tipo()
    {
        return $this->hasOne('App\Tipo');
    }


    public function voo(){
        return $this->belongsTo('App\Voo');
    }


    //Cadastra um novo voo
    public function createAeronave($request){
        
        try
        {
            $aeronave = new Aeronave([
                'matricula' => $request->input('matricula'),
                'tipo_id' => $request->input('tipo')
            ]);

            $aeronave->save();
            return response()->json(['response' => 'Aeronave cadastrada com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['response' => 'Erro ao cadastrar!'],400);
        }        

    }


    //Retorna todos as Aeronaves cadastradas
    public function getAllAeronaves()
    {
        $aeronaves = DB::table('aeronaves as a')
            ->join('tipos as t', 'a.tipo_id', '=', 't.id')
            ->select('a.id', 'a.matricula', 'a.tipo_id', 't.tipo')
            ->orderBy('a.id', 'desc')
            ->get();
        
        if(!$aeronaves)
        {
            return response()->json(['response' => 'Não existem aeronaves cadastrados'], 200);
        }
            
        return $aeronaves;

    }


    //Retorna apenas o voo especificado pelo ID
    public function getById($id)
    {
        $aeronave = DB::table('aeronaves as a')
            ->join('tipos as t', 'a.tipo_id', '=', 't.id')
            ->where('a.id', '=', $id)
            ->select('a.id', 'a.matricula', 'a.tipo_id', 't.tipo')
            ->orderBy('a.id', 'desc')
            ->get();
        
        if(!$aeronave)
        {
            return response()->json(['response' => 'Não existe aeronave cadastrada com o ID '.$id], 200);
        }

        $aeronave = json_encode($aeronave[0]);
        return $aeronave;
    }

    
    public function updateAeronave($request, $id){
        $aeronave = Aeronave::find($id);
        
        if(!$aeronave)
        {
            return response()->json(['response' => 'Aeronave não encontrado!'], 400);
        }                
                
        $aeronave->matricula = $request->input('matricula');
        $aeronave->tipo_id = $request->input('tipo_id');
        
        $aeronave->save();
        return response()->json($aeronave, 200);
    }


    //Exclui o voo especificado pelo ID
    public function deleteAeronave($id)
    {
        $aeronave = Aeronave::find($id);

        //Verifica se existe um voo com o ID informado
        if(!$aeronave)
        {
            return response()->json(['response' => 'Não existe aeronave cadastrada com o ID '.$id], 200);
        }

        try{
            $aeronave->delete();
            return response()->json(['response' => 'Aeronave excluida com sucesso'], 200);
        }
        catch (\Exception $e){
            return response()->json(['response' => 'Aeronave excluida com sucesso', 'exception' => $e->getMessage()], 200);
        }
    }
}
