<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUser($id)
    {
    	try{
    		$response = Http::post(env("CLARO_URL"),[
	            "id360" => $id
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
	    	return null;
    	}
    	catch(Exception $exception){
    		dd($exception);
    		return null;
    	}
    }


}
