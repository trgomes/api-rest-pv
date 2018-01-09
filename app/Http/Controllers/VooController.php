<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voo;

class VooController extends Controller
{    

    protected $voo;

    function __construct(Voo $voo)
    {
        $this->voo = $voo;
    }


    public function index()
    {
        return $this->voo->getAllVoos();       
    }


    //Armazena / Cadastra voo
    public function store(Request $request)
    {
        return $this->voo->createVoo($request);        
    }

    //Retorna voo especifico
    public function show($id)
    {
        return $this->voo->getById($id);
        
    }

    // Update voo
    public function update(Request $request, $id)
    {
        return $this->voo->updateVoo($request, $id);
    }

    // Delete voo
    public function destroy($id)
    {
        return $this->voo->deleteVoo($id);        
    }
}
