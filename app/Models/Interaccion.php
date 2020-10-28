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
		"hora"
    ];

    protected $hidden = [
    	"created_at",
    	"updated_at"
    ];
}
