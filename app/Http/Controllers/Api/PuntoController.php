<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Punto;
use Illuminate\Http\Request;

class PuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            "usuario_id"=>"required|numeric",
            "lat"=>"required|numeric",
            "lng" => "required|numeric",
            "fecha" => "required|date|date_format:Y-m-d",
            "hora" => "required|date_format:H:i:s",

        ];
        $request->validate($rules);
        $punto = Punto::create($request->all());
        return response()->json(["punto"=>$punto],201);
    }

    
}
