<?php

namespace App\Kypcom;
use App\Casa;
use App\InvitadoCasa;
use App\AutorizanCasa;
use App\Registro;
use App\Reporte;
use App\ReporteComentario;
use App\Evento;
use App\InvitadoEvento;


class ColonoGet 
{

      

    public function get_visita($id_casa)
    {
        $visita= Registro::join('casas','registros.id_casa','casas.id')->join('calles','casas.id_calle','calles.id')->join('users','registros.id_guardia','users.id')->where('registros.id',$id)->select('casas.numero','calles.calle','registros.nombre','foto_id','foto_placas','modelo','color','foto_guardia','autoriza','estatus','registros.created_at','registros.updated_at')->first();

        return $visita;
    }

    public function get_reportes($frac)
    {
        $reportes = Reporte::where('id_fraccionamiento',$frac)->where('activo','si')->get();
        foreach ($reportes as $reporte) {


           //$reporte->foto = '/reportes/'.$reporte->foto;
            $reporte->foto = '/public/reportes/'.$reporte->foto;
        }

        return $reportes;   

    }

    public function get_reporte($reporte)
    {

        $reporte = Reporte::find($reporte);
        //$reporte->foto = '/reportes/'.$reporte->foto;
         $reporte->foto = '/public/reportes/'.$reporte->foto;
        return $reporte;


    }

    public function get_comentarios($reporte)
    {

        $comentarios = ReporteComentario::where('id_reporte',$reporte)->get();

        return $comentarios;


    }




    //OBTIENE LAS CASAS Y SU INFO DADO UN FRACCIONAMIENTO
  public function get_misdatos($frac,$id_user)
  {

    //BUSCAR CASAS 
    $casa = Casa::join('calles','casas.id_calle','calles.id')->where('casas.id_fraccionamiento',$frac)->where('casas.id_usuario',$id_user)->select('casas.id','numero','familia','telefono','telefonod','id_calle','calle')->first();

    //AGREGAR INFO DE  INVITADOS Y AUTORIZAN 
        $invitados = InvitadoCasa::where('id_casa',$casa->id)->select('id','invitado','activo')->get();
        $autorizan =AutorizanCasa::where('id_casa',$casa->id)->select('id','autoriza','activo')->get();

        $respuesta=['casa'=>$casa,'autorizan'=>$autorizan,'invitados'=>$invitados];
        

    return $respuesta;

  }

   public function get_eventos($casa,$frac)
  {

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now('America/Mexico_City');    
        $date=$date->toDateString();

        $eventos = Evento::where('id_fraccionamiento',$frac)->where('id_casa',$casa)->select('id','id_casa','evento','autoriza','inicia','termina','hi','hf','estatus','i_compuesta','f_compuesta')->orderBy('i_compuesta','DESC')->get();

         $respuesta=[];

         foreach ($eventos as $evento) {
            $invitados= InvitadoEvento::where('id_evento',$evento->id)->select('id','invitado')->get();


             $obj=['evento'=>$evento,'invitados'=>$invitados];
             array_push($respuesta, $obj);
         }

        return $respuesta;

  }






}
