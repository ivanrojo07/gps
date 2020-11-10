<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Interaccion extends Model
{
    use HasFactory;


    protected $fillable= [
    	"usuario_id",
		"interaccion_id",
        "fecha"
    ];

    protected $hidden = [
    	"created_at",
    	"updated_at"
    ];

    public function punto_interaccions()
    {
        return $this->hasMany('App\Models\PuntoInteraccion',"interaccion_id","id");
    }


    public function getTiempoAttribute()
    {

        $primer_punto = $this->punto_interaccions->first();
        $ultimo_punto = $this->punto_interaccions->last();
        $hora_1 = Carbon::create($primer_punto->punto_usuario->hora);
        $hora_2 = Carbon::create($ultimo_punto->punto_usuario->hora);
        if ($hora_1 >= $hora_2) {
            $tiempo = $hora_1->diffInSeconds($hora_2)+1;
            
        }
        else{
            $tiempo = $hora_2->diffInSeconds($hora_1)+1;
        }
        return date("H:i:s",$tiempo);
         

    }

    public function getInfoUsuario360Attribute(){
        $response = Http::post(env("CLARO_URL"),[
            "id360" => $this->usuario_id
        ]);
        if ($response->ok()) {
            if ($response->json()["success"]) {
                $array = $response->json();
                // dd($array["icon"]);
                $obj = [
                    "nombre" => $array["nombre"],
                    "apellido_paterno" => $array["apellido_paterno"],
                    "apellido_materno" => $array["apellido_materno"],
                    "icon" => (isset($array["icon"]) ? $array["icon"] : "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"),
                    "image" => (isset($array["img"]) ? $array["img"] : "/images/user.png"),
                ];
                return $obj;

            }
            return null;
        }
        return $response->body();
    }

    public function getInfoInteraccion360Attribute(){
        $response = Http::post(env("CLARO_URL"),[
            "id360" => $this->interaccion_id
        ]);
        if ($response->ok()) {
            if ($response->json()["success"]) {
                $array = $response->json();
                // dd($array["icon"]);
                $obj = [
                    "nombre" => $array["nombre"],
                    "apellido_paterno" => $array["apellido_paterno"],
                    "apellido_materno" => $array["apellido_materno"],
                    "icon" => (isset($array["icon"]) ? $array["icon"] : "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"),
                    "image" => (isset($array["img"]) ? $array["img"] : "/images/user.png"),
                ];
                return $obj;

            }
            return null;
        }
        return $response->body();
    }
}
