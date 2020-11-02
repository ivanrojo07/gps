<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Historial extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            "id" => $this->id,
            "usuario_id" => $this->usuario_id,
            "fecha" => $this->fecha,
            "puntos" =>  $this->puntos()->with("interacciones","interacciones.punto_interaccion")->orderBy("hora","asc")->get()
        ];
    }
}
