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
use App\User;



class SetData 
{
  

	public function add_coment($reporte,$coment,$id_user)
	{
		$usuario = User::find($id_user);
		$comentario = new ReporteComentario();
    	$comentario->comentario= $coment;
    	$comentario->id_reporte=(int)$reporte;

    	//es un colono 
    	if($usuario->id_rol==3)
    	{
    		$casa= Casa::join('calles','casas.id_calle','calles.id')->where('id_usuario',$usuario->id)->select('casas.id','numero','calle')->first();
    		$comentario->comento="COLONO";
    		$comentario->id_casa=$casa->id;
    		$comentario->id_comento=(int)$usuario->id;
            $comentario->calle=$casa->calle;
            $comentario->numero=$casa->numero;

    	}
    	//es un guardia

    	if($usuario->id_rol==4)
    	{
    		$comentario->comento="GUARDIA";
    		$comentario->id_comento=(int)$usuario->id;
    	}
    	
    	$comentario->save();

    	return $comentario;	
	}

	public function add_resuelto($repor,$resolucion,$id_user)
	{
		$usuario = User::find($id_user);
		$reporte = Reporte::find($repor);
    	$reporte->resolucion=$resolucion;
    	$reporte->estatus="Resuelto";
    	$reporte->id_resolvio=$usuario->id;
    	$reporte->save();
    	return $reporte;

	}

    public function add_reporte($report,$prioridad,$imagen,$id,$titulo)
    {
        $user = User::find($id);
        $reporte = new Reporte();

        if($user->id_rol==3)
        {
            $casa= Casa::join('calles','casas.id_calle','calles.id')->where('id_usuario',$user->id)->select('casas.id','calle','numero')->first();
            $reporte->id_casa=$casa->id;
            $reporte->creado='COLONO';
            $reporte->calle=$casa->calle;
            $reporte->numero=$casa->numero;    
        }
        else if($user->id_rol==4)
        {
            $reporte->creado='GUARDIA';
        }
        else{
             $reporte->creado='ADMINISTRADOR';
        }
       
        $reporte->id_fraccionamiento=$user->id_fraccionamiento;
        $reporte->prioridad = $prioridad;
        $reporte->estatus="Pendiente";
        $reporte->activo="si";
        $reporte->titulo =$titulo;
        $reporte->descripcion=$report;

        //HAY UNA IMAGEN
        if($imagen != "no")
        {
                $file= $imagen;
               $name= time().$file->getClientOriginalName();
               $file->move(public_path().'/reportes/',$name);
               $reporte->foto=$name;
        }
        else
        {
             $reporte->foto="default_img.png";
        }

        $reporte->save();

        return $reporte;

    }



}


