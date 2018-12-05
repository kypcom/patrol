<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;
use Hash;
use Session;
use App\Fraccionamiento;
use Auth;

class UserController extends Controller
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

        $rol = Auth::user()->id_rol;
     if($rol===1)
     {

         $users=User::where('id_fraccionamiento',$frac)->get();
     }
     else
     {
         $users=User::where('id_fraccionamiento',$frac)->where('id_rol',"!=",1)->get();
     }

        return view('panel.usuario.index',compact('fraccionamiento'))->with('users',$users);
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

        $nemail=User::where('email',$request->email)->value('email');
        if($nemail !="")
        {
             Flash::warning("El email ya pertenece a otro usuario");

           
        return redirect()->route('users.index');
        }
        $user = new User($request->all());

        $user->id_fraccionamiento=$frac;
        $user->id_rol=$request->rol_id;
        $user->password=Hash::make($request->password);

       
        $user->save();
        Flash::success("Se ha guardado ".$user->name." de forma exitosa");

        return redirect()->route('users.index');
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

        $nemail=User::where('email',$request->email)->where('id','!=',$id)->value('email');
        if($nemail !="")
        {
             Flash::warning("El email ya pertenece a otro usuario");

           
        return redirect()->route('users.index');
        }
      

        $user = User::find($id);
        $user->name=$request->name;
        $user->id_rol=$request->rol_id;
        $user->id_fraccionamiento=$frac;
        $user->password=Hash::make($request->password);
        $user->save();
        Flash::success("Se ha guardado ".$user->name." de forma exitosa");

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $frac=Session('frac');

        if($user->id_fraccionamiento==$frac)
        {
            $user->delete();
        Flash::success("Se ha borrado ".$user->name." de forma exitosa");
        return redirect()->route('users.index');
        }
        Flash::error("No tienes permisos para borrar este usuario");
        return redirect()->route('users.index');
        
        
    }

    public function change_frac($frac)
    {
        $desarrollo = Fraccionamiento::find($frac);

        Session(['nombre_frac'=> $desarrollo->fraccionamiento]);
        Session(['frac'=> $desarrollo->id]);

        return redirect()->route('users.index');

    }
}
