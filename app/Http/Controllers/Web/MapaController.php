<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Interaccion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    //

	public function showMapa(Request $request)
	{
		return view('mapa');
	}

    public function setPuntos(Request $request)
    {
    	$request->validate([
    		"usuario_id" => "required|numeric",
    		"fecha" => "required|date|date_format:Y-m-d",
    		"dias" => "nullable|numeric|max:15",
            "distancia" => "required|numeric|max:50",
            "tiempo" => "required|date_format:H:i"
    	]);
    	$usuario_id = $request->usuario_id;
    	$fecha = $request->fecha;
    	$dias = $request->dias ? $request->dias : "15";
    	$fecha_fin = Carbon::parse($fecha)->subDays($dias)->toDateString();
        $distancia = $request->distancia;
        $tiempo = $request->tiempo;
        $interacciones = Interaccion::where("usuario_id",$usuario_id)->whereDate("fecha",">=",$fecha_fin)->whereDate("fecha","<=",$fecha)->whereHas("punto_interaccions",function(Builder $query) use ($distancia,$tiempo){
            $query->where("punto_interaccions.distancia","<=",$distancia)->whereTime("punto_interaccions.tiempo","<=",$tiempo);;
        })->orderBy("fecha","ASC")->get();

        return view("mapa",['interacciones'=>$interacciones,"distancia"=>$distancia,"tiempo"=>$tiempo]);
    }

    public function showHistorico(Request $request){
        return view("historico");

    }
    public function setHistorico(Request $request){
        return view("historico");
        
    }
}
