<?php

namespace App\Kypcom;
use App\Fraccionamiento;
use App\Calle;
use App\Casa;
use App\InvitadoCasa;
use App\AutorizanCasa;
use App\Registro;
use App\Reporte;
use App\ReporteComentario;
use App\Evento;
use App\InvitadoEvento;


class GetData 
{
      
     public function get_calles($frac)
    {
    	$calles = Calle::where('id_fraccionamiento',$frac)->select('id','calle')->get();

    	return $calles;

    }

      public function get_casas($frac)
    {
    	$calles = Calle::where('id_fraccionamiento',$frac)->select('id')->get();
    	$respuesta =[];
    	foreach ($calles as  $calle) {

    	$casas = Casa::where('id_calle',$calle->id)->select('id','numero','familia','telefono','telefonod','id_calle')->get();

    	$obj=['id_calle'=>$calle->id, 'casas'=>$casas];


   		 array_push($respuesta, $obj);
    	}


    	return $respuesta;

    }

         public function get_invitados($frac)
    {

    	$casas = Casa::where('id_fraccionamiento',$frac)->select('id')->get();
    	$respuesta =[];
    	foreach ($casas as  $casa) {

    	$invitados = InvitadoCasa::where('id_casa',$casa->id)->where('invitado_casas.activo','si')->select('id','invitado','id_casa')->get();

    	$obj=['id_casa'=>$casa->id, 'invitados'=>$invitados];


   		 array_push($respuesta, $obj);
    	}

    	return $respuesta;

    }

           public function get_autorizan($frac)
    {

    	$casas = Casa::where('id_fraccionamiento',$frac)->select('id')->get();
    	$respuesta =[];
    	foreach ($casas as  $casa) {

    	$autorizan = AutorizanCasa::where('id_casa',$casa->id)->where('autorizan_casas.activo','si')->select('id','autoriza','id_casa')->get();

    	$obj=['id_casa'=>$casa->id, 'autoriza'=>$autorizan];


   		 array_push($respuesta, $obj);
    	}

    	return $respuesta;

    }

    public function get_visita($id)
    {
        $visita= Registro::join('casas','registros.id_casa','casas.id')->join('calles','casas.id_calle','calles.id')->join('users','registros.id_guardia','users.id')->where('registros.id',$id)->select('casas.numero','calles.calle','registros.nombre','foto_id','foto_placas','modelo','color','foto_guardia','autoriza','estatus','registros.created_at','registros.updated_at','casas.familia')->first();
        $visita->foto_id="/public/registros/".$visita->foto_id;
           $visita->foto_placas="/public/registros/".$visita->foto_placas;
           $visita->foto_guardia="/public/registros/".$visita->foto_guardia;
   

        return $visita;
    }

    public function get_reportes($frac)
    {
        $reportes = Reporte::where('id_fraccionamiento',$frac)->where('activo','si')->orderBy('created_at','DESC')->get();
        foreach ($reportes as $reporte) {


           //$reporte->foto = '/reportes/'.$reporte->foto;
            $reporte->foto = '/public/reportes/'.$reporte->foto;
        }

        return $reportes;   

    }

    public function get_reporte($reporte)
    {

        $reporte = Reporte::find($reporte);
        $reporte->foto = '/public/reportes/'.$reporte->foto;
        return $reporte;


    }

    public function get_comentarios($reporte)
    {

        $comentarios = ReporteComentario::where('id_reporte',$reporte)->get();

        return $comentarios;


    }

    public function get_salidas($frac)
    {
        $registros = Registro::where('id_fraccionamiento',$frac)->where('estatus','ENTRADA')->select('id','nombre','placas','modelo','color')->get();

        return $registros;
    }


    //OBTIENE LAS CASAS Y SU INFO DADO UN FRACCIONAMIENTO
  public function get_casas_info($frac)
  {

    //BUSCAR CASAS 
    $casas = Casa::join('calles','casas.id_calle','calles.id')->where('casas.id_fraccionamiento',$frac)->select('casas.id','numero','familia','telefono','telefonod','id_calle','calle')->get();

    //AGREGAR INFO DE  INVITADOS Y AUTORIZAN 

    $respuesta=[];

    foreach ($casas as $casa) {

        $invitados = InvitadoCasa::where('id_casa',$casa->id)->where('activo','si')->select('id','invitado')->get();
        $autorizan =AutorizanCasa::where('id_casa',$casa->id)->where('activo','si')->select('id','autoriza','activo')->get();
        $eventos = Evento::where('id_casa',$casa->id)->where('estatus','creado')->select('evento','autoriza','i_compuesta')->get();

        $obj=['casa'=>$casa,'autorizan'=>$autorizan,'invitados'=>$invitados,'eventos'=>$eventos];
        array_push($respuesta, $obj);

    }

    return $respuesta;

  }

  public function get_eventos($frac)
  {

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now('America/Mexico_City'); 
        $date->addDay(7);   
        $date->toDateTimeString();    

       

        $eventos = Evento::join('casas','eventos.id_casa','casas.id')->join('calles','casas.id_calle','calles.id')->where('eventos.id_fraccionamiento',$frac)->where('eventos.estatus','Creado')->where('i_compuesta', '<=', $date)->select('eventos.id','id_casa','evento','autoriza','inicia','termina','hi','hf','calle','numero')->get();

         $respuesta=[];

         foreach ($eventos as $evento) {
            $invitados= InvitadoEvento::where('id_evento',$evento->id)->count('id');


             $obj=['evento'=>$evento,'invitados'=>$invitados];
             array_push($respuesta, $obj);
         }

        return $respuesta;

  }





}
