<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\InvitadoEvento;
use App\Registro;
use Illuminate\Support\Facades\Storage;
use App\Reporte;
use Notification;
use App\User;
use Auth;
      use Mail;



use App\Notifications\PushKypcom;



class ServiciosController extends Controller
{
    

    public function close_evento()
    {
    	$carbon = new \Carbon\Carbon();
        $date = $carbon->now('America/Mexico_City');    
        $date->toDateTimeString();  

        $eventos=Evento::where('f_compuesta','<=',$date)->where('estatus',"!=","Cerrado")->get();

        foreach ($eventos as $item) {
           	$evento = Evento::find($item->id);
           	$evento->estatus="Cerrado";
           	$evento->save();
           } 

           return 'ok';  

    }

    public function clear_evento()
    {

    	$carbon = new \Carbon\Carbon();
        $date = $carbon->now('America/Mexico_City');    
        $date = $date->subDay(1);  //2011-01-01 00:00:00
       //$date = $date->subYears(4);  //2011-01-01 00:00:00
        $date->toDateTimeString();  

        $eventos=Evento::where('f_compuesta','<=',$date)->get();

        foreach ($eventos as $item) {
           	$evento = Evento::find($item->id);
       		

       		$invitados = InvitadoEvento::where('id_evento',$evento->id)->get();

       		foreach ($invitados as $inv) {
       			$invitado =InvitadoEvento::find($inv->id);
       			$invitado->delete();
       		}

       		$evento->delete();

           } 

           return 'ok';  

    }

    public function clear_registro()
    {

    	$carbon = new \Carbon\Carbon();
        $date = $carbon->now('America/Mexico_City');    
        $date = $date->subDay(4);  //2011-01-01 00:00:00
       //$date = $date->subYears(4);  //2011-01-01 00:00:00
        $date->toDateTimeString();  

        $registros=Registro::where('created_at','<=',$date)->get();

        foreach ($registros as $item) {
           	$registro = Registro::find($item->id);

           	$placa='registros/'.$registro->foto_placas;
           	$guardia='registros/'.$registro->foto_guardia;
           	$id='registros/'.$registro->foto_id;
       		
       		\File::delete($placa,$guardia,$id);
           
       		$registro->delete();

           } 

           return 'ok';  

    }

    public function inactive_report()
    {
    	$carbon = new \Carbon\Carbon();
        $date = $carbon->now('America/Mexico_City');    
        $date = $date->subDay(1);  //2011-01-01 00:00:00
       //$date = $date->subYears(4);  //2011-01-01 00:00:00
        $date->toDateTimeString(); 

        $reportes = Reporte::where('estatus','Resuelto')->where('updated_at',"<=",$date)->get();

        foreach ($reportes as $item) {
        	$reporte = Reporte::find($item->id);
        	$reporte->activo="no";
        	$reporte->save();
        }

        return "ok";
    }

    /*public function test_push()
    {
      $usuario = User::find(7);
      $mensaje=['title'=>'Tienes una nueva visita','body'=>'juan'];
      Notification::send($usuario,new PushKypcom('Tienes una nieva visita','Juan camaney'));
      return 'ok';
    }*/

    public function test_push()
    {
       $data=['visitante'=>'jorge'];

     $asunto= 'Nueva visita';
     $enviar="aaron@kypcom.com";
         Mail::send('email.mail',$data,function($msj) use($asunto, $enviar){

            $msj->from('avisos@doorpatrol.com', 'Door Patrol');
            $msj->subject($asunto);
            $msj->to($enviar);/*->bcc('test@demo.kypcom.com');*/

              });

         return dd('ok');
    }
}
