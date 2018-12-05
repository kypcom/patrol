<?php

namespace App\Http\Controllers;
use App\Casa;
use App\InvitadoCasa;
use App\AutorizanCasa;
use App\Calle;
use Laracasts\Flash\Flash;
use App\User;
use App\Fraccionamiento;
use App\Kypcom\DeleteData;
use App\Evento;


use Illuminate\Http\Request;

class CasaController extends Controller
{
    //
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
       

    }


    public function index()
    {       $frac=Session('frac');
           $fraccionamiento = Fraccionamiento::where('id',$frac)->value('fraccionamiento');
        $fraccionamiento= "Fraccionamiento ".$fraccionamiento;

        //return $casas =Casa::get();
    	$casas = Casa::join('calles','casas.id_calle','calles.id')->join('fraccionamientos','casas.id_fraccionamiento','fraccionamientos.id')->where('casas.id_fraccionamiento',$frac)->select('casas.numero','casas.telefono','fraccionamientos.fraccionamiento','calles.calle','casas.id','casas.activo','familia')->get();
        //return $casas;
        return view('panel.casa.index',compact('usuariosd','calles','casas','fraccionamiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frac=Session('frac');
        $usuariosd=[]; 
        $calles = Calle::where('id_fraccionamiento', $frac)->select('id','calle')->get();
            //Buscar usuarios
        $usuarios=User::where('id_fraccionamiento', $frac)->where('id_rol',3)->select('id','name')->get();

        //numeros permitudos en fraccionamiento
        $n_autorizan=Fraccionamiento::where('id', $frac)->value('n_autorizan');
        $n_invitados=Fraccionamiento::where('id', $frac)->value('n_confianza');

        //agregar usuarios disponibles 
        foreach ($usuarios as $usuario) {
            # code...
            $casa = Casa::where('id_usuario',$usuario->id)->value('id');
            if($casa == "")
            {
                array_push($usuariosd, $usuario);
            }

        }// fin de armado de usuarios

      
       return view('panel.casa.create',compact('usuariosd','calles','n_autorizan','n_invitados'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creacion de la casa
        $frac=Session('frac');

        $n_autorizan=Fraccionamiento::where('id', $frac)->value('n_autorizan');
        $n_invitados=Fraccionamiento::where('id', $frac)->value('n_confianza');

        $casa = new Casa();
        $casa->id_fraccionamiento= $frac;
        $casa->id_calle=$request->id_calle;
        $casa->id_usuario=$request->id_usuario;
        $casa->telefono=$request->telefono;
        $casa->telefonod=$request->telefonod;
        $casa->familia=$request->familia;
        $casa->numero=$request->numero;
        if($request['activo'] == 'on')
        {
            $casa->activo="si";
            
        }

        $casa->save();


        //agregar personas que autorizan 

        for($i=0;$i<$n_autorizan;$i++)
        {
            $nombre="autorizado_".$i;
            $check="autorizado_check".$i;

            $autoriza = new AutorizanCasa();
            $autoriza->id_casa=$casa->id;
            $autoriza->autoriza=$request[$nombre];
            if($request[$check]=='on')
            {
                $autoriza->activo="si";
            }
          

            $autoriza->save();


        }

        //agregar invitado de confianza

             for($i=0;$i<$n_invitados;$i++)
        {
            $nombre="invitado_".$i;
            $check="invitado_check".$i;
            $invitado = new InvitadoCasa();
            $invitado->id_casa=$casa->id;
            $invitado->invitado=$request[$nombre];
            if($request[$check]=='on')
            {
                $invitado->activo="si";
            }
        

            $invitado->save();


        }

         Flash::success("Se ha guardado la casa: ".$casa->numero." de forma exitosa");
      return redirect()->route('casa.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $frac=Session('frac');
          $usuariosd=[]; 
        $autorizan = AutorizanCasa::where('id_casa',$id)->get();
        $invitados= InvitadoCasa::where('id_casa',$id)->get();
       $casa = Casa::join('calles','casas.id_calle','calles.id')->join('fraccionamientos','casas.id_fraccionamiento','fraccionamientos.id')->where('casas.id',$id)->select('casas.numero','casas.telefono','fraccionamientos.fraccionamiento','calles.calle','casas.id','casas.activo','familia','telefonod','casas.id_usuario')->first();

       $usr= User::find($casa->id_usuario);
      

           //Buscar usuarios
        $usuarios=User::where('id_fraccionamiento', $frac)->where('id_rol',3)->select('id','name')->get();

       //agregar usuarios disponibles 
        foreach ($usuarios as $usuario) {
            # code...
            $casas = Casa::where('id_usuario',$usuario->id)->value('id');
            if($casas == "")
            {
                array_push($usuariosd, $usuario);
            }

        }// fin de armado de usuarios

 

        return view('panel.casa.edit',compact('autorizan','invitados','casa','usuariosd','usr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $frac=Session('frac');
        $autorizan=AutorizanCasa::where('id_casa',$id)->get();
        $invitados=InvitadoCasa::where('id_casa',$id)->get();

        //return $request->all();

        $casa = Casa::Find($id);

        $casa->id_usuario=$request->id_usuario;
        $casa->telefono=$request->telefono;
        $casa->telefonod=$request->telefonod;
        $casa->familia=$request->familia;
        if($request['activo'] == 'on')
        {
            $casa->activo="si";
            
        }

        $casa->save();

        //agregar personas que autorizan 

      foreach ($autorizan as $item) {
          # code...
      
            $nombre="autoriza_".$item->id;
            $check="autorizado_check".$item->id;

            $item->autoriza=$request[$nombre];


            if($request[$check]=='on')
            {
                $item->activo="si";
            }
            else
            {
               $item->activo="no";
            }
          
            $item->save();

        }

        //agregar invitado de confianza

           foreach ($invitados as $item) 
           {
            $nombre="invitado_".$item->id;
            $check="invitado_check".$item->id;

            $item->invitado=$request[$nombre];
            if($request[$check]=='on')
            {
                $item->activo="si";
            } else
            {
               $item->activo="no";
            }
          
            $item->save();



        }

         Flash::success("Se ha actualizado la casa: ".$casa->numero." de forma exitosa");
        return redirect()->route('casa.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //BORRADP DE CASA / AUTORIZAN  / EVENTOS 

        $frac=Session('frac');
        $delete= new DeleteData();

        $estatus;

        $eventos = Evento::where('id_casa',$id)->get();

        foreach ($eventos as $evento) {
             $estatus= $delete->delete_evento($evento->id,$frac);
        }

        if($estatus==true)
        {
            $estatus= $delete->delete_casa($id,$frac);

            if($estatus==true)
            {
            Flash::success("Se ha borrado la casa y su información de forma exitosa");
            return redirect()->route('casa.index');
            }
            else
            {
            Flash::error("Error al borrar la casa, sin permiso");
            return redirect()->route('casa.index');
            }
        }else
        {
              Flash::error("Error al borrar la casa, sin permiso");
            return redirect()->route('casa.index');
        }


    }
}
