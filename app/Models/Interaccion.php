<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    use HasFactory;


    protected $fillable= [
    	"usuario_id",
		"interaccion_id",
		"lat_usuario",
		"lng_usuario",
        "lat_interaccion",
        "lng_interaccion",
		"distancia",
		"fecha",
        "hora",
		"punto_usuario_id",
        "punto_interaccion_id"
    ];

    protected $hidden = [
    	"created_at",
    	"updated_at",
        "punto_usuario_id",
        "punto_interaccion_id"
    ];

    public function punto_usuario(){
        return $this->hasOne('App\Models\Punto', 'id', 'punto_usuario_id');
    }

    public function punto_interaccion(){
        return $this->hasOne('App\Models\Punto', 'id', 'punto_interaccion_id');
    }
}
