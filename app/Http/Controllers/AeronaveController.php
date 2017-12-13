<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aeronave;

class AeronaveController extends Controller
{

    protected $aeronave;


    function __construct(Aeronave $aeronave)
    {
        $this->aeronave = $aeronave;
    }


    public function index()
    {
        return $this->aeronave->getAllAeronaves();
        
    }


    public function store(Request $request)
    {
        return $this->aeronave->createAeronave($request);
    }


    public function show($id)
    {
        return $this->aeronave->getById($id);        
    }


    public function update(Request $request, $id)
    {
        return $this->aeronave->updateAeronave($request, $id);
    }


    public function destroy($id)
    {
        return $this->aeronave->deleteAeronave($id);       
    }
}
