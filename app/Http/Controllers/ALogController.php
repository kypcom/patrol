<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterAuthRequest;
use App\User;
use App\Fraccionamiento;


class ALogController extends Controller
{
    //


    public function check()
    {

        $payload = JWTAuth::parseToken()->getPayload();
        $rol = $payload['id_rol'];
        $id_frac= $payload['id_fraccionamiento'];
        $frac=Fraccionamiento::find($id_frac);
        if($frac->activo =="si")
        {
             return response()->json(['access'=>$rol],200);     
        }
        else{
            return response()->json(['error'=>'inactivo'],401);
        }
        
    }


    public function signin(Request $request)
    {
    	$data =$request->json()->all();

       

        $credentials=['email'=>$data['email'],'password'=>$data['password']];
    	//$credentials = $request->only('email', 'password');
        //return $credentials;

        //return $credentials;


    	try{

    		if(!$token = JWTAuth::attempt($credentials))
    		{
    			return response()->json(['error'=>'Invalido'],401);
    		}

    	}
    	catch(JWTException $e)
    	{
    		return response()->json(['error'=>'No token'],500);
    	}

        $frac =User::where('email',$credentials['email'])->value('id_fraccionamiento');
        $rol=User::where('email',$credentials['email'])->value('id_rol');
        $name =  User::where('email',$credentials['email'])->value('name');
    	return response()->json(['token'=>$token,'section'=>$rol,'frac'=>$frac,'name'=>$name],200);	
    }



        public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }


}
