<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aeroporto;

class AeroportoController extends Controller
{

    protected $aeroporto;


    function __construct(Aeroporto $aeroporto)
    {
        $this->aeroporto = $aeroporto;
    }


    public function index()
    {
        return $this->aeroporto->getAllAeroportos();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->aeroporto->createAeroporto($request);
    }


    public function show($id)
    {
        return $this->aeroporto->getById($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        return $this->aeroporto->updateAeroporto($request, $id);
    }


    public function destroy($id)
    {
        return $this->aeroporto->deleteAeroporto($id);
    }
}
