<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calle;
use App\Fraccionamiento;
use Laracasts\Flash\Flash;
use App\Kypcom\DeleteData;
use App\Casa;
use App\Evento;

class CalleController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
        

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $frac=Session('frac');
           $fraccionamiento = Fraccionamiento::where('id',$frac)->value('fraccionamiento');
        $fraccionamiento= "Fraccionamiento ".$fraccionamiento;
        $calles = Calle::join('fraccionamientos','calles.id_fraccionamiento','fraccionamientos.id')->where('calles.id_fraccionamiento',$frac)->select('calle','calles.id','fraccionamientos.fraccionamiento')->get();

        return view('panel.calle.index',compact('calles','fraccionamiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $frac=Session('frac');
        $calle = new Calle();
        $calle->calle=$request->calle;
        $calle->id_fraccionamiento=$frac;
        $calle->save();

         Flash::success("Se ha guardado ".$calle->calle." de forma exitosa");

        return redirect()->route('calle.index');


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
        //
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
        //
        $frac=Session('frac');
        $calle =  Calle::find($id);
        $calle->calle=$request->calle;
        $calle->id_fraccionamiento=$frac;
        $calle->save();
        Flash::success("Se ha actualizado ".$calle->calle." de forma exitosa");
        return redirect()->route('calle.index');
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

        $casas = Casa::where('id_calle',$id)->where('id_fraccionamiento',$frac)->get();

        //BORRADO DE CASAS
        foreach ($casas as $casa) {
            //BORRADO DE EVENTOS DE LA CASA
            $eventos = Evento::where('id_casa',$casa->id)->get();

            foreach ($eventos as $evento) 
            {
             $estatus= $delete->delete_evento($evento->id,$frac);
            }

            //BORARR CASA
            $estatus= $delete->delete_casa($casa->id,$frac);
        }

        //BORRADO DE CALLE

        $estatus= $delete->delete_calle($id,$frac);

        if($estatus==true)
        {
        Flash::success("Se ha eliminado la calle de forma exitosa");
        return redirect()->route('calle.index');
        }
        else{
             Flash::error("Sin permisos");
        return redirect()->route('calle.index');
        }




        
    }
}
