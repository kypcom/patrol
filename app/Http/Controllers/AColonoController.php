<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kypcom\ColonoGet;
use App\Kypcom\SetData;
use App\User;
use App\Casa;
use App\InvitadoCasa;
use App\AutorizanCasa;
use App\Registro;
use App\Evento;
use App\InvitadoEvento;
use JWTAuth;
use Notification;
use Auth;

class AColonoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
      
        

    }
    public function misdatos()
    {
    	//OBTENER INFO DEL TOKEN
    	$payload = JWTAuth::parseToken()->getPayload();
        $id_frac = $payload['id_fraccionamiento'];
        $id_user= $payload['id'];

        $gData = new ColonoGet();

        $respuesta = $gData->get_misdatos($id_frac,$id_user);

         return response()->json($respuesta,200);
    }

    public function update_invitado($invi)
    {
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_frac = $payload['id_fraccionamiento'];
        $id_user= $payload['id'];

        $casa=Casa::where('id_fraccionamiento',$id_frac)->where('id_usuario',$id_user)->value('id');

        $invitado = InvitadoCasa::find($invi);

        //VERIFICAR QUE SEA EL MISMO USUARIO AL QUE PERTENECE 
        if($casa==$invitado->id_casa)
        {
            if($invitado->activo=="si")
            {
                $invitado->activo="no";
            }
            else{
                $invitado->activo="si";
            }

            $invitado->save();

              //OBTENER INVITADOS 

            $invitados = InvitadoCasa::where('id_casa',$casa)->select('id','invitado','activo')->get();

            return response()->json($invitados,200);

        }
        else
        {
             return response()->json(['error'=>'bye'],200);
        }

    }

    public function update_autoriza($auto)
    {
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_frac = $payload['id_fraccionamiento'];
        $id_user= $payload['id'];

        $casa=Casa::where('id_fraccionamiento',$id_frac)->where('id_usuario',$id_user)->value('id');

        $autotiza = AutorizanCasa::find($auto);

        //VERIFICAR QUE SEA EL MISMO USUARIO AL QUE PERTENECE 
        if($casa==$autotiza->id_casa)
        {
            if($autotiza->activo=="si")
            {
                $autotiza->activo="no";
            }
            else{
                $autotiza->activo="si";
            }

            $autotiza->save();

              //OBTENER INVITADOS 

            $autotizan = AutorizanCasa::where('id_casa',$casa)->select('id','autoriza','activo')->get();

            return response()->json($autotizan,200);

        }
        else
        {
             return response()->json(['error'=>'bye'],200);
        }



    }

    public function update_name(Request $request)
    {
        $data =$request->json()->all();
         //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_frac = $payload['id_fraccionamiento'];
        $id_user= $payload['id'];

        $casa=Casa::where('id_fraccionamiento',$id_frac)->where('id_usuario',$id_user)->value('id');

        if($data['tipo']=="frecuente")
        {
            $invitado= InvitadoCasa::find($data['id_nombre']);
            if($invitado->id_casa==$casa)
            {
                $invitado->invitado= $data['nombre'];
                $invitado->save();
            }
            
            $invitados = InvitadoCasa::where('id_casa',$casa)->select('id','invitado','activo')->get();

            return response()->json(['tipo'=>'invitado','invitados'=>$invitados],200);



        }
        if($data['tipo']=="autoriza")
        {
            $autoriza= AutorizanCasa::find($data['id_nombre']);
            if($autoriza->id_casa==$casa)
            {
                $autoriza->autoriza= $data['nombre'];
                $autoriza->save();
            }

            $autotizan = AutorizanCasa::where('id_casa',$casa)->select('id','autoriza','activo')->get();

            return response()->json(['tipo'=>'autoriza','autorizan'=>$autotizan],200);
            
        }



         return response()->json(['error'=>'bye'],401);

    }




     public function g_visitas()
    {
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];

         $casa=Casa::where('id_fraccionamiento',$frac)->where('id_usuario',$id_user)->value('id');


        //OBTENER DATOS
        $visitas = Registro::where('registros.id_fraccionamiento',$frac)->where('id_casa',$casa)->select('registros.id','nombre','registros.autoriza','estatus','registros.updated_at','registros.created_at')->orderBy('registros.updated_at','DESC')->get();

        
        return response()->json($visitas,200); 
    }

    public function auto_evento()
    {
           //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];

        $casa=Casa::where('id_fraccionamiento',$frac)->where('id_usuario',$id_user)->value('id');

        $autorizan = AutorizanCasa::where('id_casa',$casa)->where('activo','si')->select('id','autoriza')->get();

        return response()->json($autorizan,200); 

    }

    public function create_evento(Request $request)
    {

        $data =$request->json()->all();
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];

        $casa=Casa::where('id_fraccionamiento',$frac)->where('id_usuario',$id_user)->value('id');
 

        $evento = new Evento();

        $evento->evento =$data['evento'];
        $evento->inicia=$data['inicia'];
        $evento->termina=$data['termina'];
        $evento->id_fraccionamiento=$frac;
        $evento->hi=$data['hi'];
        $evento->hf=$data['hf'];
        $evento->id_casa= $casa;
        $evento->estatus="Creado";
        $evento->i_compuesta=$data['inicia']." ".$data['hi'];
        $evento->f_compuesta=$data['termina']." ".$data['hf'];
        $evento->autoriza=$data['autoriza'];

        $evento->save();

        $invitados = $data['invitados'];

        foreach ($invitados as $inv) {

            $i_evento= new InvitadoEvento ();
            $i_evento->invitado = $inv['invitado'];
            $i_evento->id_evento = $evento->id;
            $i_evento->save();
        }



        return response()->json($evento,200); 

    }

    public function g_eventos()
    {
        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];

        $casa=Casa::where('id_fraccionamiento',$frac)->where('id_usuario',$id_user)->value('id');

        $gData= new ColonoGet();

        $respuesta= $gData->get_eventos($casa,$frac);
        return response()->json($respuesta,200); 


    }

    public function cancel_evento( $evento)
    {


        //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];

        $casa=Casa::where('id_fraccionamiento',$frac)->where('id_usuario',$id_user)->value('id');

        $evento= Evento::find($evento);

        if($evento->id_casa == $casa)
        {
            $evento->estatus="Cancelado";
            $evento->save();
        }

        $gData= new ColonoGet();

        $respuesta= $gData->get_eventos($casa,$frac);

         return response()->json($respuesta,200); 


    }

    public function update_invitados_evento(Request $request)
    {

         $data =$request->json()->all();
         //OBTENER INFO DEL TOKEN
        $payload = JWTAuth::parseToken()->getPayload();
        $id_user = $payload['id'];
        $frac=$payload['id_fraccionamiento'];

        $casa=Casa::where('id_fraccionamiento',$frac)->where('id_usuario',$id_user)->value('id');

        $evento = $data['evento'];

        if($evento['id_casa'] == $casa)
        {

            //BORRAR INVITADOS VIEJOS 
            $invitasos_viejos= InvitadoEvento::where('id_evento',$evento['id'])->select('id')->get();

            foreach ($invitasos_viejos as $invitado) {

               $viejo = InvitadoEvento::find($invitado->id);
               $viejo->delete();
            }


            //AGREGA NUEVOS INVITADOS

            $invitados =$data['invitados'];
            foreach ($invitados as $inv) {


                $invitado = new InvitadoEvento();
                $invitado->invitado=$inv['invitado'];
                $invitado->id_evento=$evento['id'];
                $invitado->save();
            }

        }

        //RETORNO DE EVENTOS ACTUALIZADOS

         $gData= new ColonoGet();

        $respuesta= $gData->get_eventos($casa,$frac);

         return response()->json($respuesta,200); 


    }

    public function store_push(Request $request)    
    {


        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);

        

        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh']; 
        $user = Auth::user();
        $user->updatePushSubscription($endpoint, $key, $token);

        return $request;
        
        return response()->json(['success' => true],200);
    }

}

