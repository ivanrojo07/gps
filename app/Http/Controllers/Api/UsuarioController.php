<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //

    public function __invoke($usuario_id)
    {
    	
    	$response = $this->getUser($usuario_id);
    	if ($response) {
	    	return response()->json(['data'=>$response],200);
    		
    	}
    	else{
    		return response()->json(['data'=>null],404);
    	}
    }
}
