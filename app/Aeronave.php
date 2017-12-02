<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{

    protected $fillable = [
        'matricula', 'tipo'
    ];

    public function voo(){
        return $this->belongsTo('App\Voo');
    }


    //Cadastra um novo voo
    public function createAeronave($request){
        
        try
        {
            $aeronave = new Aeronave([
                'matricula' => $request->input('matricula'),
                'tipo' => $request->input('tipo')
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
        $aeronaves = Aeronave::all();        
        
        if(!$aeronaves)
        {
            return response()->json(['response' => 'Não existem aeronaves cadastrados'], 200);
        }
            
        return $aeronaves;
    }


    //Retorna apenas o voo especificado pelo ID
    public function getById($id)
    {
        $aeronave = Aeronave::find($id);
        
        if(!$aeronave)
        {
            return response()->json(['response' => 'Não existe aeronave cadastrada com o ID '.$id], 200);
        }
            
        return $aeronave;
    }

    
    public function updateAeronave($request, $id){
        $aeronave = Aeronave::find($id);
        
        if(!$aeronave)
        {
            return response()->json(['response' => 'Aeronave não encontrado!'], 400);
        }                
                
        $aeronave->matricula = $request->input('matricula');
        $aeronave->tipo = $request->input('tipo');
        
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

        $aeronave->delete();

        return response()->json(['response' => 'Aeronave excluida com sucesso'], 200);
    }
}
