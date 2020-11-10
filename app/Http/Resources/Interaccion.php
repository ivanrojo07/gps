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
        return [
            "id" => $this->id,
            "usuario_id" => $this->usuario_id,
            "interaccion_id" => $this->interaccion_id,
            "tiempo" => $this->tiempo,
            "punto_interacciones"=> $this->punto_interaccions->load(['punto_usuario','punto_interaccion'])->makeHidden(["punto_usuario_id",'punto_interaccion_id','interaccion_id','created_at','updated_at'])
        ];
    }
}
