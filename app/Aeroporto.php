<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeroporto extends Model
{

    protected $fillable = [
        'nome',
    ];


    public function vooOrigem(){
        return $this->belongsTo('App\Voo','origem_id');
    }

    
    public function vooDestino(){
        return $this->belongsTo('App\Voo','destino_id');
    }


    //Cadastra um novo voo
    public function createAeroporto($request){
        
        try
        {
            $aeroporto = new Aeroporto([
                'nome' => $request->input('nome')
            ]);

            $aeroporto->save();
            return response()->json(['response' => 'Aeroporto cadastrada com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['response' => 'Erro ao cadastrar!'],400);
        }        

    }


    //Retorna todos as aeroportos cadastradas
    public function getAllaeroportos()
    {
        $aeroportos = Aeroporto::all();        
        
        if(!$aeroportos)
        {
            return response()->json(['response' => 'Não existem aeroportos cadastrados'], 200);
        }
            
        return $aeroportos;
    }


    //Retorna apenas o voo especificado pelo ID
    public function getById($id)
    {
        $Aeroporto = Aeroporto::find($id);
        
        if(!$Aeroporto)
        {
            return response()->json(['response' => 'Não existe Aeroporto cadastrada com o ID '.$id], 200);
        }
            
        return $Aeroporto;
    }

    
    public function updateAeroporto($request, $id){
        $Aeroporto = Aeroporto::find($id);
        
        if(!$Aeroporto)
        {
            return response()->json(['response' => 'Aeroporto não encontrado!'], 400);
        }                
                
        $Aeroporto->nome = $request->input('nome');
        
        
        $Aeroporto->save();
        return response()->json($Aeroporto, 200);
        
    }


    //Exclui o voo especificado pelo ID
    public function deleteAeroporto($id)
    {
        $Aeroporto = Aeroporto::find($id);

        //Verifica se existe um voo com o ID informado
        if(!$Aeroporto)
        {
            return response()->json(['response' => 'Não existe Aeroporto cadastrada com o ID '.$id], 200);
        }

        try{
            $Aeroporto->delete();
            return response()->json(['response' => 'Aeroporto excluido com sucesso'], 200);
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
        

        
    }
}
