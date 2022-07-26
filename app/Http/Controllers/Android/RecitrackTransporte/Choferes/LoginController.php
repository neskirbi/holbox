<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chofer;

class LoginController extends Controller
{
    function Login(Request $request){
        if(strlen($request->telefono)==0 || $request->telefono==null){
            $request['error']='¡Error en el telefono(Campo Vacío)!';
            return $request;
        }
        if(strlen($request->pass)==0 || $request->pass==null){
            $request['error']='¡Error en la contraseña(Campo Vacío)!';
            return $request;
        }
        
        $chofer = Chofer::where([
            'telefono' => $request->telefono
        ])->first();

        if($chofer){

            
            if($chofer->verificado==0){
                $request['error']='¡No ha verificado su numero de telefono!';
                return $request;
            }

            
            if($request->pass!=$chofer->pass){
                $request['error']='¡Error de contraseña!';
                return $request;
            }
                
            return $chofer;
        }else{
            $request['error']='Teléfono incorrecto!';
            return $request;
        }
    }

    function Confirmacion($id){
        $chofer=Chofer::find($id);
        if(!$chofer){
            return redirect('home')->with('error','Error de url.');
        }
        $chofer->verificado=1;
        if($chofer->save()){
            return view('mails.telefonoconfirmado');
        }else{
            return redirect('home')->with('error','Error al confirmar.');
        }
    }

}
