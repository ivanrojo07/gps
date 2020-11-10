<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Punto extends JsonResource
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
            "id" =>$this->id,
            "usuario_id" =>$this->usuario_id,
            "lat" => $this->lat,
            "lng" => $this->lng,
            "hora" => $this->hora,
            "fecha" => $this->fecha,
            "tiempo" =>$this->tiempo,
            "interacciones" => $this->punto_interaccions
        ];
    }
}
