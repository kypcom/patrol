<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\Kypcom\GetData;
use ImageOptimizer;
use JWTAuth;
use App\User;
use App\Casa;
use Mail;
//use Notification;
//use App\Notifications\PushKypcom;

class AVisitasController extends Controller
{

   /* public function test_metodo(){
        $casa = Casa::find(2);
        $enviar = User::where('id',$casa->id_usuario)->value('email');
        $asunto= 'Nueva visita';
        $data=['visitante'=>"juan"];

    
         Mail::send('email.mail',$data,function($msj) use($asunto, $enviar){

            $msj->from('avisos@doorpatrol.com', 'Door Patrol');
            $msj->subject($asunto);
            $msj->to($enviar);/*->bcc('test@demo.kypcom.com');

              });

      


    }*/


     public function __construct(){
        $this->middleware('auth');
      
        

    }



    public function g_visitas()
    {
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];


        //OBTENER DATOS
    	$visitas = Registro::join('casas','registros.id_casa','casas.id')->join('calles','casas.id_calle','calles.id')->where('registros.id_fraccionamiento',$frac)->select('registros.id','nombre','foto_id','foto_placas','placas','modelo','color','registros.autoriza','estatus','foto_guardia','registros.updated_at','calle','numero','registros.created_at','familia','telefono','telefonod','nombre','tipo')->orderBy('registros.updated_at','DESC')->get();

        foreach ($visitas as $visita) {
          // $visita->foto_id="/registros/".$visita->foto_id;
          // $visita->foto_placas="/registros/".$visita->foto_placas;
          // $visita->foto_guardia="/registros/".$visita->foto_guardia;

            $visita->foto_id="/public/registros/".$visita->foto_id;
           $visita->foto_placas="/public/registros/".$visita->foto_placas;
           $visita->foto_guardia="/public/registros/".$visita->foto_guardia;
        }

        
    	return response()->json($visitas,200); 
    }

    public function create_visita()
    {

        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $frac = $payload['id_fraccionamiento'];


    	$data =  new GetData();
    	// obtener calles 
    	$calles = $data->get_calles($frac);
    	$casas= $data->get_casas($frac);
    	$invitados =$data->get_invitados($frac);
    	$autorizan = $data->get_autorizan($frac);
        $eventos= $data->get_eventos($frac);


    	//Generado objeto de respuesta
    	$respuesta = [
    		'calles'=>$calles,
    		'casas'=>$casas,
    		'invitados'=>$invitados,
    		'autorizan'=>$autorizan,
            'eventos'=>$eventos
    	];

    	return response()->json($respuesta,200);

    }

    public function store_visita(Request $request)
    {

        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];
       
    	
    	//CREAR NUEVA ENTRADA
    	$registro = new Registro();
    	$registro->id_fraccionamiento=$frac;
    	$registro->id_casa =(int)$request['id_casa'];
    	$registro->nombre =$request['nombre'];
    	$registro->placas =$request['placas'];
    	$registro->modelo =$request['modelo'];
    	$registro->color =$request['color'];
    	$registro->autoriza =$request['autoriza'];
        $registro->tipo = $request['tipo'];
    	$registro->id_guardia =$id_user;
    	$registro->estatus='ENTRADA';
    	//GENERADO DE FOTOS

    	if($request['fotoID']!=null)
    	{
    		 $file=$request['fotoID'];
    		 $name= time().$file->getClientOriginalName();
             $file->move(public_path().'/registros/',$name);
             $registro->foto_id=$name;

    	}
    	if($request['fotoPlaca']!=null)
    	{
    		$file=$request['fotoPlaca'];
    		 $name= time().$file->getClientOriginalName();
             $file->move(public_path().'/registros/',$name);
             $registro->foto_placas=$name;
    	}
    	if($request['fotoGuardia']!=null)
    	{
    		$file=$request['fotoGuardia'];
    		 $name= time().$file->getClientOriginalName();
             $file->move(public_path().'/registros/',$name);
             $registro->foto_guardia=$name;
    	}
    	$registro->save();


        //EMVIO DE MAIL

       /* $casa = Casa::find($registro->id_casa);
        $enviar = User::where('id',$casa->id_usuario)->value('email');
        $asunto= 'Nueva visita';
       
        $data=['visitante'=>$registro->nombre];

    
         Mail::send('email.mail',$data,function($msj) use($asunto, $enviar){

            $msj->from('avisos@doorpatrol.com', 'Door Patrol');
            $msj->subject($asunto);
            $msj->to($enviar);/*->bcc('test@demo.kypcom.com');*/

              //});*/

         //$usuario = User::find($casa->id_usuario);
      
     /* Notification::send($usuario,new PushKypcom('Tienes una nieva visita',$registro->nombre));*/

    	return response()->json(['fecha'=>$registro->created_at],200);


    }

   /* public function optimizar()
    {

        app(\Spatie\ImageOptimizer\OptimizerChain::class)->optimize('registros/fondo.jpg', 'registros/optimizado2.jpg');
        
        //ImageOptimizer::optimize('registros/fondo.jpg', 'registros/optimizado2.jpg');
        return dd('ok');
    }*/

    public function salidas($frac)
    {
        $gData= new GetData();
        $respuesta = $gData->get_salidas($frac);
        return response()->json(['salidas'=>$respuesta],200);

    }

    public function salir(Request $request)
    {

        
        //ACTIALIZAR REGISTRO
        $registro= Registro::find($request->registro);
        $registro->estatus="SALIO";
        $registro->save();

        //REGRESAR REGISTROS 
        $gData= new GetData();
        $respuesta = $gData->get_salidas($registro->id_fraccionamiento);
        return response()->json(['salidas'=>$respuesta],200);



    }


}
