<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Casa;
use JWTAuth;
use App\Kypcom\GetData;

class AGeneralController extends Controller
{
    //
   
    public function get_casas()
    {
    	//OBTENER INFO DEL TOKEN
    	$payload = JWTAuth::parseToken()->getPayload();
        $id_frac = $payload['id_fraccionamiento'];

        $gData= new GetData();

        $respuesta = $gData->get_casas_info($id_frac);


        return response()->json($respuesta,200);
    }
    public function g_eventos()
    {
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_frac = $payload['id_fraccionamiento'];

        $gData= new GetData();

        $respuesta= $gData->get_eventos($id_frac);

        return response()->json($respuesta,200);

    }
}
