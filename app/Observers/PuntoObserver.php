<?php

namespace App\Observers;

use App\Models\Historial;
use App\Models\Interaccion;
use App\Models\Punto;
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
        $hora_fin = Carbon::parse($punto->hora)->addMinutes(15)->toTimeString();
        // dd($hora_fin->toTimeString());
        $fecha = $punto->fecha;
        $puntos = Punto::whereDate("fecha",$fecha)->whereTime("hora",">=",$hora_inicio)->whereTime("hora","<=",$hora_fin)->where("usuario_id","!=",$punto->usuario_id)->distinct("usuario_id")->get();
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
            if($distancia <= 15.0){
                $interaccions = Interaccion::createMany([
                    "usuario_id" => $punto->usuario_id,
                    "interaccion_id" => $p->usuario_id,
                    "lat_usuario" => $punto->lat,
                    "lng_usuario" => $punto->lng,
                    "lat_interaccion" =>$p->lat,
                    "lng_interaccion" =>$p->lng,
                    "distancia" => $distancia,
                    "hora" => $punto->hora,
                    "fecha" => $punto->fecha,
                    "punto_usuario_id" => $punto->id,
                    "punto_interaccion_id" => $p->id,
                ],[
                    "usuario_id" => $p->usuario_id,
                    "interaccion_id" => $punto->usuario_id,
                    "lat_usuario" => $p->lat,
                    "lng_usuario" => $p->lng,
                    "lat_interaccion" =>$punto->lat,
                    "lng_interaccion" =>$punto->lng,
                    "distancia" => $distancia,
                    "hora" => $p->hora,
                    "fecha" => $p->fecha,
                    "punto_usuario_id" => $p->id,
                    "punto_interaccion_id" => $punto->id,
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
