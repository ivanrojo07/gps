<?php

namespace App\Observers;

use App\Models\Historial;
use App\Models\Interaccion;
use App\Models\Punto;
use App\Models\PuntoInteraccion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PuntoObserver
{
    /**
     * Handle the punto "created" event.
     *
     * @param  \App\Models\Punto  $punto
     * @return void
     */
    public function created(Punto $punto)
    {
        //
        $historial = Historial::firstOrCreate([
            "usuario_id"=>$punto->usuario_id,
            "fecha" =>$punto->fecha
        ]);
        $punto->historial_id = $historial->id;
        $punto->save();
        $hora_inicio = $punto->hora;
        $hora_fin = Carbon::parse($punto->hora)->addHours(3)->toTimeString();
        // dd($hora_fin->toTimeString());
        $fecha = $punto->fecha;
        $puntos = Punto::whereDate("fecha",$fecha)->whereTime("hora",">=",$hora_inicio)->whereTime("hora","<=",$hora_fin)->where("usuario_id","!=",$punto->usuario_id)->get();
            // https://es.stackoverflow.com/questions/117887/calcular-distancia-entre-dos-puntos-api-google-maps-php
        $radio = 6371000;
        $r_lat0 = deg2rad($punto->lat);
        $r_lng0 = deg2rad($punto->lng);


        foreach ($puntos as $p) {
            $r_lat = deg2rad($p->lat);
            $r_lng = deg2rad($p->lng);
            $lonDelta = $r_lng - $r_lng0;
            $distancia = ($radio *
                acos(
                    cos($r_lat0) * cos($r_lat) * cos($lonDelta) +
                    sin($r_lat0) * sin($r_lat)
                )
            );
            if($distancia <= 50.0){
                $hora_1 = Carbon::create($punto->hora);
                $hora_2 = Carbon::create($p->hora);
                $tiempo = $hora_1->diffInSeconds($hora_2);
                $interaccion = Interaccion::firstOrCreate([
                    "usuario_id"=>$punto->usuario_id,
                    "interaccion_id" => $p->usuario_id,
                    "fecha" =>$punto->fecha
                ]);
                $punto_interaccion = PuntoInteraccion::create([
                    "distancia" => $distancia,
                    "punto_usuario_id" => $punto->id,
                    "punto_interaccion_id" => $p->id,
                    "interaccion_id" => $interaccion->id,
                    "tiempo" => date("H:i:s",$tiempo),
                ]);
                
            }
        }
    }

    /**
     * Handle the punto "updated" event.
     *
     * @param  \App\Models\Punto  $punto
     * @return void
     */
    public function updated(Punto $punto)
    {
        //
    }

    /**
     * Handle the punto "deleted" event.
     *
     * @param  \App\Models\Punto  $punto
     * @return void
     */
    public function deleted(Punto $punto)
    {
        //
    }

    /**
     * Handle the punto "restored" event.
     *
     * @param  \App\Models\Punto  $punto
     * @return void
     */
    public function restored(Punto $punto)
    {
        //
    }

    /**
     * Handle the punto "force deleted" event.
     *
     * @param  \App\Models\Punto  $punto
     * @return void
     */
    public function forceDeleted(Punto $punto)
    {
        //
    }
}
