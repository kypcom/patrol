<?php

namespace App\Http\Controllers;

use Laracasts\Flash\Flash;
use App\Casa;
use App\Evento;
use App\Calle;
use App\AutorizanCasa;
use Illuminate\Http\Request;
use App\Fraccionamiento;
use App\InvitadoEvento;
use App\Kypcom\DeleteData;


class EventoController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
        

    }
     public function index()
    {
       $frac=Session('frac');
        $fraccionamiento = Fraccionamiento::where('id',$frac)->value('fraccionamiento');
        $fraccionamiento= "Fraccionamiento ".$fraccionamiento;
    	
    	$eventos = Evento::join('casas','eventos.id_casa','casas.id')->join('calles','casas.id_calle','calles.id')->where('eventos.id_fraccionamiento',$frac)->select('eventos.id','numero','calle','evento','estatus','eventos.autoriza','inicia','termina')->get();

        return view('panel.evento.index',compact('eventos','fraccionamiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frac=Session('frac');
        $calles = Calle::where('id_fraccionamiento',$frac)->select('id','calle')->get();
        $casas = Casa::where('id_fraccionamiento',$frac)->select('id','numero','id_calle')->get();
        $autorizan= AutorizanCasa::join('casas','autorizan_casas.id_casa','casas.id')->where('casas.id_fraccionamiento',$frac)->select('id_casa','autoriza')->get();
       

      
       return view('panel.evento.create',compact('calles','casas','autorizan'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $frac=Session('frac');
        $evento = new Evento();
        $evento->id_fraccionamiento=$frac;
        $evento->id_casa=$request->id_casa;
        $evento->evento=$request->evento;
        $evento->estatus="Creado";
        $evento->autoriza=$request->autoriza;
        $evento->inicia=$request->fecha_i." ".$request->hora_i.":00";
        $evento->termina=$request->fecha_f." ".$request->hora_f.":00";
        $evento->hi=$request->hora_i;
        $evento->hf=$request->hora_f;
        $evento->save();

        // guardar invitados 
        for($i=0;$i<$request->n_invitados;$i++)
        {

            $cuenta=$i+1;
            $busqueda ="invitado_".$cuenta;
            $invitado = new InvitadoEvento();
            $invitado->id_evento =$evento->id;
            $invitado->invitado=$request[$busqueda];
            $invitado->save();

        }


         Flash::success("Se ha guardado el evento de forma exitosa");
      return redirect()->route('evento.index');

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
        

        $evento =Evento::join('casas','eventos.id_casa','casas.id')->join('calles','casas.id_calle','calles.id')->where('eventos.id',$id)->select('eventos.id','calle','numero','evento','autoriza','inicia','termina','hi','hf')->first();

        $invitados=InvitadoEvento::where('id_evento',$evento->id)->get();


        return view('panel.evento.edit',compact('evento','invitados','casa'));
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
        
        $evento = Evento::find($id);
        $evento->evento=$request->evento;
        $evento->inicia=$request->fecha_i." ".$request->hora_i.":00";
        $evento->termina=$request->fecha_f." ".$request->hora_f.":00";
        $evento->hi=$request->hora_i;
        $evento->hf=$request->hora_f;
        $evento->save();


        //BORRANDO INVITASOA PASADOS 

         $invitados=InvitadoEvento::where('id_evento',$evento->id)->get();

         foreach ($invitados as $item) {
            $invitado= InvitadoEvento::find($item->id);
            $invitado->delete();
         }

        // guardar invitados 
        for($i=0;$i<$request->n_invitados;$i++)
        {

            $cuenta=$i+1;
            $busqueda ="invitado_".$cuenta;
            $invitado = new InvitadoEvento();
            $invitado->id_evento =$evento->id;
            $invitado->invitado=$request[$busqueda];
            $invitado->save();

        }


         Flash::success("Se ha guardado el evento de forma exitosa");
      return redirect()->route('evento.index');

        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $frac=Session('frac');
        $delete = new DeleteData();
        $estatus = $delete->delete_evento($id,$frac);

        if($estatus==true)
        {
        Flash::success("Se ha eliminado el evento de forma exitosa");
        return redirect()->route('evento.index');

        }
        else{
        Flash::error("No tienes permiso de borrar este evento");
        return redirect()->route('evento.index');

        }



    }
}
