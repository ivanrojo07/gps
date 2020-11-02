<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Punto as PuntoResource;
use App\Http\Resources\PuntoCollection;
use App\Models\Punto;
use Carbon\Carbon;
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
        // dd($request->all());
        $punto = Punto::create($request->all());
        // dd($punto);
        $response = new PuntoResource($punto);
        return response()->json(["punto"=>$response],201);
    }

    public function interacciones(Request $request)
    {
        $request->validate([
            "fecha" => "required|date|date_format:Y-m-d",
            "dias" => "nullable|numeric|max:15",
            "usuario_id" => "required|numeric",
        ]);
        $usuario_id = $request->usuario_id;
        $fecha = $request->fecha;
        $dias = $request->dias ? $request->dias : "15";
        $fecha_fin = Carbon::parse($fecha)->subDays($dias)->toDateString();

        $puntos = Punto::where("usuario_id",$usuario_id)->whereDate("fecha", ">=",$fecha_fin)->whereDate("fecha","<=",$fecha)->has('interacciones')->with(["interacciones","interacciones.punto_interaccion"])->orderBy("fecha")->get();
        $data = new PuntoCollection($puntos);
        return response($data,201);
    }
}
