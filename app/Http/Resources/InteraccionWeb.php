<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InteraccionWeb extends JsonResource
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
            "fecha" => $this->fecha,
            "info_usuario360" => ($this->info_usuario360 ? $this->info_usuario360 : null),
            "info_interaccion360" => ($this->info_interaccion360 ? $this->info_interaccion360 : null)
        ];
    }
}
