<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	"usuario_id",
		"lat",
		"lng",
		"hora",
		"fecha"
    ];
    protected $hidden = [
    	"created_at",
    	"updated_at"
    ];
}
