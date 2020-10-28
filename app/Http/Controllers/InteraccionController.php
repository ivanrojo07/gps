<?php

namespace App\Http\Controllers;

use App\Models\Interaccion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InteraccionController extends Controller
{
    //

    public function getInteraccion($usuario_id,Request $request){
    	$request->validate([
    		"fecha" => "required|date|date_format:Y-m-d",
    		"dias" => "nullable|numeric|max:15"
    	]);
    	$fecha = $request->fecha;
    	$dias = $request->dias ? $request->dias : "15";
    	$fecha_fin = Carbon::parse($fecha)->subDays($dias)->toDateString();
        // dd($fecha_fin);
    	$interacciones = Interaccion::where("usuario_id",$usuario_id)->whereDate("fecha", ">=",$fecha_fin)->whereDate("fecha","<=",$fecha)->distinct("interaccion_id")->get();
        return response()->json(["data"=>$interacciones]);

    }
}
