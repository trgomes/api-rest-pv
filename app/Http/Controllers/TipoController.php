<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tipo;

class TipoController extends Controller
{

    protected $tipo;


    function __construct(Tipo $tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->tipo->getAllTipos();
    }


    public function store(Request $request)
    {
        return $this->tipo->createTipo($request);
    }


    public function show($id)
    {

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
