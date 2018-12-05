<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use Session;
use Redirect;
use Auth;
use App\Fraccionamiento;

class LogController extends Controller
{
    //
    public function ingreso()
    {
    	 return view('log.log');
    }

    public function check(Request  $request)
    {
     
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]))
        {
           

            if(Auth::user()->id_rol =="1")
            {
                $mifrac=Auth::user()->id_fraccionamiento;
                $frac = Fraccionamiento::find($mifrac);

                if($frac != null)
                {
                    Session(['nombre_frac'=> $frac->fraccionamiento]);
                    Session(['frac'=> Auth::user()->id_fraccionamiento]);
                }
                else{
                    $desarrollo = Fraccionamiento::select('id','fraccionamiento')->orderBy('created_at','DESC')->first();

                    Session(['nombre_frac'=> $desarrollo->fraccionamiento]);
                    Session(['frac'=> $desarrollo->id]);
                }

                 return Redirect::to('fraccionamiento');
           
             }
             else if(Auth::user()->id_rol =="2")
             {
                 Session(['frac'=> Auth::user()->id_fraccionamiento]);
                return Redirect::to('users');
               
             }
             else
             {
             Session::flash('message-error','Sin acceso, bye');
            return Redirect::to('/');
             }

        }
        Session::flash('message-error','Datos incorrectos');
        return Redirect::to('/');
            
    }

        public function logout()
		{
    	Auth::logout();
  		  return Redirect::to('/');
		}



}
