<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Casa;
use App\Calle;
use App\Fraccionamiento;
use App\Reporte;
use App\ReporteComentario;
use App\Kypcom\DeleteData;
//use Illuminate\Support\Facades\Storage;

class ReporteController extends Controller
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
    	
    	$reportes = Reporte::where('reportes.id_fraccionamiento',$frac)->select('calle','numero','prioridad','estatus','created_at','creado','id')->get();

        return view('panel.reporte.index',compact('reportes','fraccionamiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creacion del reporte
        $frac=Session('frac');

        $reporte = new Reporte();
        $reporte->creado='ADMINISTRADOR';
        $reporte->id_fraccionamiento=$frac;
        $reporte->prioridad = $request->prioridad;
        $reporte->estatus="Pendiente";
        $reporte->activo="si";
        $reporte->descripcion=$request->descripcion;
        if($request->hasFile('foto'))
        {
        	  $file= $request->file('foto');
               $name= time().$file->getClientOriginalName();
               $file->move(public_path().'/reportes/',$name);
               $reporte->foto=$name;
        }

		$reporte->save();

         Flash::success("Se ha guardado el reporte de forma exitosa");
      return redirect()->route('reporte.index');

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
    	$reporte =Reporte::find($id);
   ///$foto="reportes/".$reporte->foto;
            $foto="public/reportes/".$reporte->foto;
    	$comentarios = ReporteComentario::where('id_reporte',$id)->get();
    	$id_rep=$reporte->id;

        return view('panel.reporte.edit',compact('reporte','comentarios','foto','id_rep'));
    }

    public function add_coment(Request $request)
    {
    	$comentario = new ReporteComentario();
    	$comentario->comentario= $request->comentario;
    	$comentario->id_reporte=$request->id_rep;
    	$comentario->comento="ADMINISTRADOR";
    	$comentario->save();

         Flash::success("Se ha agregado el comentario de forma exitosa");

    	  return redirect()->route('reporte.edit',$request->id_rep);

    	//return self::edit($request->id_rep);


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
    	$reporte = Reporte::find($id);
    	$reporte->resolucion=$request->resolucion;
    	$reporte->prioridad=$request->prioridad;
    	$reporte->estatus=$request->estatus;

    	
		

    	
    	 if($request->hasFile('foto'))
        {
        	//borrado de foto anterior
        \File::delete('reportes/'.$reporte->foto);
        //gurdando nuevocontenido

        		$file= $request->file('foto');
               $name= time().$file->getClientOriginalName();
               $file->move(public_path().'/reportes/',$name);
               $reporte->foto=$name;
        	
        }
        $reporte->save();
        

         Flash::success("Se ha actualizado el reporte de forma exitosa");
        return redirect()->route('reporte.edit',$reporte->id);


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

         $estatus = $delete->delete_reporte($id,$frac);

         if($estatus==true)
         {

         Flash::success("Se ha eliminado el reporte de forma exitosa");
        return redirect()->route('reporte.index');
         }
         else{

         Flash::error("Sin permisos ");
        return redirect()->route('reporte.index');
         }
    }
}
