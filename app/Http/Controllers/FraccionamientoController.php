<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fraccionamiento;
use Laracasts\Flash\Flash;
use Session;
use App\Kypcom\DeleteData;
use App\Calle;
use App\Casa;
use App\User;
use App\Evento;
use App\Reporte;
use Auth;

class FraccionamientoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
         $this->middleware('super');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $fraccionamientos=Fraccionamiento::get();

         session(['desarrollos' => $fraccionamientos]);
        return view('panel.desarrollo.index')->with('fraccionamientos',$fraccionamientos);
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
        $frac = new Fraccionamiento();
        $frac->fraccionamiento =$request->fraccionamiento;
        $frac->n_autorizan =$request->n_autorizan;
        $frac->n_confianza =$request->n_confianza;
        $frac->activo = $request->activo;

        $frac->save();

         Flash::success("Se ha guardado ".$frac->fraccionamiento." de forma exitosa");

        return redirect()->route('fraccionamiento.index');



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

        $frac = Fraccionamiento::find($id);
        $frac->fraccionamiento =$request->fraccionamiento;
        $frac->n_autorizan =$request->n_autorizan;
        $frac->n_confianza =$request->n_confianza;
        $frac->activo = $request->activo;

        $frac->save();

         Flash::warning("Se ha actualizado ".$frac->fraccionamiento." de forma exitosa");

        return redirect()->route('fraccionamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actual=Session('frac');
        $pertenece= Auth::user()->id_fraccionamiento;

        if($pertenece == $id)
        {
        Flash::warning("No puedes borrar el fraccionamiento al que perteces");
        return redirect()->route('fraccionamiento.index');

        }
        if($actual==$id)
        {
        Flash::warning("Cambia de fraccionamiento para borrar");
        return redirect()->route('fraccionamiento.index');
        }

        $frac=Fraccionamiento::find($id);
        $delete = new DeleteData();
        $calles = Calle::where('id_fraccionamiento',$frac->id)->get();
        $casas = Casa::where('id_fraccionamiento',$frac->id)->get();
        $usuarios = User::where('id_fraccionamiento',$frac->id)->get();
        $reportes =Reporte::where('id_fraccionamiento',$frac->id)->get();

          //BORRADO DE CASAS
        foreach ($casas as $casa) {
            //BORRADO DE EVENTOS DE LA CASA
            $eventos = Evento::where('id_casa',$casa->id)->get();

            foreach ($eventos as $evento) 
            {
             $estatus= $delete->delete_evento($evento->id,$frac->id);
            }

            //BORARR CASA
            $delete->delete_casa($casa->id,$frac->id);
        }

        //BORRADO DE CALLES
        foreach ($calles as $calle) {
            $delete->delete_calle($calle->id,$frac->id);
        }

        //BORRADO DE REPORTES
        foreach ($reportes as $reporte) {
            $delete->delete_reporte($reporte->id,$frac->id);
        }

        //BORRADO DE REGISTROS
        $delete->delete_registros($frac->id);

        //BORRADO DE USUARIOS
        foreach ($usuarios as $item) {
           $usuario = User::find($item->id);
           $usuario->delete();
        }

        //BYE FRACIONAMIENTO
        $frac->delete();

        Flash::warning("Se elmino el fraccionamiento y todos sus elementos");
        return redirect()->route('fraccionamiento.index');
        

    }
}
