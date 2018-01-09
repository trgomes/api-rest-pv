<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = [
        'tipo'
    ];


    public function aeronaves(){
        return $this->belongsTo('App\Aeronave');
    }


    //Cadastra um novo voo
    public function createTipo($request){

        try
        {
            $tipo = new Tipo([
                'tipo' => $request->input('tipo')
            ]);

            $tipo->save();
            return response()->json(['response' => 'Tipo cadastrada com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['response' => 'Erro ao cadastrar!'],400);
        }

    }


    //Retorna todos os tipos de aeronaves cadastradas
    public function getAllTipos()
    {
        $tipos = Tipo::all();

        if(!$tipos)
        {
            return response()->json(['response' => 'Não existem tipo de aeronaves cadastrados'], 200);
        }

        return $tipos;
    }


}
