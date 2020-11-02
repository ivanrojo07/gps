<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Interaccion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "usuario_id" => $this->usuario_id,
            "interaccion_id" => $this->interaccion_id,
            "lat_usuario" => $this->lat_usuario,
            "lng_usuario" => $this->lng_usuario,
            "lat_interaccion" => $this->lat_interaccion,
            "lng_interaccion" => $this->lng_interaccion,
            "distancia" => $this->distancia,
            "fecha" => $this->fecha,
            "hora" => $this->hora,
            "punto_usuario" => $this->punto_usuario,
            "punto_interaccion" => $this->punto_interaccion
        ];
    }
}
