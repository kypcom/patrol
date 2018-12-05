<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\Casa;
use App\Calle;
use App\Fraccionamiento;
use App\Kypcom\GetData;

class VisitaController extends Controller
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
    	
    	$visitas = Registro::join('casas','registros.id_casa','casas.id')->join('calles','casas.id_calle','calles.id')->where('registros.id_fraccionamiento',$frac)->select('calle','numero','registros.id','tipo','nombre','autoriza','placas','color','registros.created_at','registros.updated_at','estatus')->get();

        return view('panel.visita.index',compact('visitas','fraccionamiento'));
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
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = new GetData();

        $visita= $data->get_visita($id);


        return view('panel.visita.show',compact('visita'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
