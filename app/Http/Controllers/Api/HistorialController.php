<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Historial;
use App\Http\Resources\Historial as HistorialResource;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    //

    /**
     * Muestra los puntos de un dia.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $request->validate([
        	"usuario_id" => "required|numeric",
        	"fecha" => "required|date|date_format:Y-m-d",
        ]);

        $usuario_id = $request->usuario_id;
        $fecha = $request->fecha;
        $historial = Historial::where("fecha",$fecha)->where("usuario_id", $usuario_id)->first();
        if($historial){
            $response = new HistorialResource($historial);
            return response()->json(["data"=>$response],200);
        }
        else{
            return response()->json(["data"=>null],200);
        }

    }
}
