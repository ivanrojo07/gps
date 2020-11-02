<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InteraccionCollection;
use App\Models\Interaccion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InteraccionController extends Controller
{
    //

    public function getInteraccion(Request $request){
    	$request->validate([
    		"usuario_id" => "required|numeric",
    		"fecha" => "required|date|date_format:Y-m-d",
    		"dias" => "nullable|numeric|max:15",
            "distancia" => "required|numeric|max:50",
            "tiempo" => "required|date_format:H:i:s"
    	]);
    	$usuario_id = $request->usuario_id;
    	$fecha = $request->fecha;
    	$dias = $request->dias ? $request->dias : "15";
    	$fecha_fin = Carbon::parse($fecha)->subDays($dias)->toDateString();
        $distancia = $request->distancia;
        $tiempo = $request->tiempo;
        // dd($fecha_fin);
    	$interacciones = Interaccion::where("usuario_id",$usuario_id)->whereDate("fecha", ">=",$fecha_fin)->whereDate("fecha","<=",$fecha)->whereTime("hora", "<=",$tiempo)->where("distancia","<=",$distancia)->has("punto_usuario")->orderBy("interaccion_id",'ASC')->orderBy("fecha","ASC")->orderBy('hora',"ASC")->get();
        $data = new InteraccionCollection($interacciones);
    	return response()->json($data);

    }

    public function historialInteracciion(Request $request){
    	$request->validate([
    		"fecha" => "required|date|date_format:Y-m-d",
    		"dias" => "nullable|numeric|max:15",
    		"usuario_id" => "required|numeric",
    		"interaccion_id" => "required|numeric"
    	]);
    	$usuario_id = $request->usuario_id;
    	$interaccion_id = $request->interaccion_id;
    	$fecha = $request->fecha;
    	$dias = $request->dias ? $request->dias : "15";
    	$fecha_fin = Carbon::parse($fecha)->subDays($dias)->toDateString();
    	$interacciones =  Interaccion::where("usuario_id",$usuario_id)->where("interaccion_id",$interaccion_id)->whereDate("fecha", ">=",$fecha_fin)->whereDate("fecha","<=",$fecha)->get();
    	$data = new InteraccionCollection($interacciones);
    	return response()->json($data);


    }

    
}
