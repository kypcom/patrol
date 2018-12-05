<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kypcom\GetData;
use App\Kypcom\SetData;
use JWTAuth;

class AReportesController extends Controller
{
    //
     public function __construct(){
        $this->middleware('auth');
      
        

    }

    public function reportes()
    {
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $frac = $payload['id_fraccionamiento'];

    	$data = new GetData();
    	$reportes= $data->get_reportes($frac);
    	return response()->json($reportes,200);

    }
      public function reporte($reporte)
    {
    	$data = new GetData();

    	$repor= $data->get_reporte($reporte);
    	$comentarios = $data->get_comentarios($reporte);

    	return response()->json(['reporte'=>$repor,'comentarios'=>$comentarios],200);

    }

    public  function add_coment(Request $request)
    {
    	
    	//OBTENER INFO DEL TOKEN
    	$payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];

        //AGREGAR EL COMENTARIO 

     
    	
    	$data = new SetData();
    	 $data->add_coment($request->reporte,$request->comentario,$id_user);

    	//REGRESAR COMENTARIOS
    	$gData = new GetData();
    	$comentarios = $gData->get_comentarios($request['reporte']);

    	return response()->json(['comentarios'=>$comentarios],200);



    }

     public  function add_resuelto(Request $request)
    {

    	//OBTENER INFO DEL TOKEN
    	$payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];

        //ACTUALIZAR REPORTE
    	$sData = new SetData();
    	$sData->add_resuelto($request['reporte'],$request['resolucion'],$id_user);

    	//REGRESAR REPORTE
    	$gData = new GetData();
    	$repor= $gData->get_reporte($request['reporte']);

    	return response()->json(['reporte'=>$repor],200);
	
    }

        public function add_reporte(Request $request)
         {

            //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];

        //HAY IMAGEN 
        if($request['imagen']!=null)
        {
            $foto=$request['imagen'];
        }
        else
        {
            $foto="no";
        }
        //ACTUALIZAR REPORTE
        $sData = new SetData();
        $sData->add_reporte($request['reporte'],$request['prioridad'],$foto,$id_user,$request['titulo']);

        //REGRESAR TODOS LOS REPORTES
        $data = new GetData();
        $reportes= $data->get_reportes($frac);
        return response()->json($reportes,200);


         }
}
