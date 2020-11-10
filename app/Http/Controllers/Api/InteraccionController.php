<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InteraccionCollection;
use App\Models\Interaccion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
        $interacciones = Interaccion::where("usuario_id",$usuario_id)->whereDate("fecha",">=",$fecha_fin)->whereDate("fecha","<=",$fecha)->whereHas("punto_interaccions",function(Builder $query) use ($distancia,$tiempo){
            $query->where("punto_interaccions.distancia","<=",$distancia)->whereTime("punto_interaccions.tiempo","<=",$tiempo);;
        })->orderBy("fecha","ASC")->with(["punto_interaccions"=>function($query) use ($distancia,$tiempo){
            $query->where("punto_interaccions.distancia","<=",$distancia)->whereTime("punto_interaccions.tiempo","<=",$tiempo);
        }])->get();

        // dd($interacciones);
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
    	// $interacciones =  Interaccion::where("usuario_id",$usuario_id)->where("interaccion_id",$interaccion_id)->whereDate("fecha", ">=",$fecha_fin)->whereDate("fecha","<=",$fecha)->get();
    	// $data = new InteraccionCollection($interacciones);
    	// return response()->json($data);


    }

    public function interaccion(Interaccion $interaccion)
    {

        $info_usuario = $interaccion->info_usuario360;
        $info_interaccion = $interaccion->info_interaccion360;
        // dd($info_interaccion);
        $puntos = $interaccion->punto_interaccions()->with("punto_usuario","punto_interaccion")->get();
        return response()->json(["interaccion"=>$interaccion,"puntos"=>$puntos,"info_usuario"=>$info_usuario,'info_interaccion'=>$info_interaccion]);
    }

    
}
