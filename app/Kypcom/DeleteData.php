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
use App\Calle;
use Auth;

class DeleteData 
{
   
	public function delete_evento($id,$frac)
	{

		$evento =Evento::find($id);

		if($evento->id_fraccionamiento === $frac)
		{
			$invitados = InvitadoEvento::where('id_evento',$evento->id)->get();

       		foreach ($invitados as $inv) {
       			$invitado =InvitadoEvento::find($inv->id);
       			$invitado->delete();
       		}

       		$evento->delete();

       		return true;

		}
		
		return false;

	} 

 	public function delete_casa($id,$frac)
 	{
 		$casa= Casa::find($id);

 		if($casa->id_fraccionamiento === $frac)
 		{
 		$autorizan=AutorizanCasa::where('id_casa',$casa->id)->get();
 		$invitados =InvitadoCasa::where('id_casa',$casa->id)->get();

 		foreach ($autorizan as $item) {
 			$autoriza = AutorizanCasa::find($item->id);
 			$autoriza->delete();
 		}
 		foreach ($invitados as $item) {
 			$invitado = InvitadoCasa::find($item->id);
 			$invitado->delete();
 		}

 		$casa->delete();
 		return true;
 		}	
 		return false;
 	}

 	

 	public function delete_calle($id,$frac)
 	{

 		$calle = Calle::find($id);

 		if($calle->id_fraccionamiento==$frac)
 		{
 			$calle->delete();

 			return true;
 		}

 		return false;

 	}

 	public function delete_reporte($id,$frac)
 	{
 		$reporte =Reporte::find($id);

 		if($reporte->id_fraccionamiento==$frac)
 		{
 			$comentarios = ReporteComentario::where('id_reporte',$reporte->id)->get();

 			foreach ($comentarios as $item) {
 				
 				$comentario= ReporteComentario::find($item->id);

 				$comentario->delete();

 			}

 			$reporte->foto='reportes/'.$reporte->foto;
 			\File::delete($reporte->foto);

 			$reporte->delete();

 			return true;
 		}

 		return false;
 	}

 	    public function delete_registros($frac)
    {

    
        $registros=Registro::where('id_fraccionamiento',$frac)->get();

        foreach ($registros as $item) {
           	$registro = Registro::find($item->id);

           	$placa='registros/'.$registro->foto_placas;
           	$guardia='registros/'.$registro->foto_guardia;
           	$id='registros/'.$registro->foto_id;
       		
       		\File::delete($placa,$guardia,$id);
           
       		$registro->delete();

           } 

           return true;  

    }

  
 











 }
