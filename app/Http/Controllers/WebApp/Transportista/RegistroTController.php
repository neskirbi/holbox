<?php

namespace App\Http\Controllers\WebApp\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chofer;

class RegistroTController extends Controller
{
    function index(){
        return view('webapp.transportista.registro.create');
    }


    public function store(Request $request)
    {
        
        
        if($request->pass!=$request->pass2){
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error las contraseñas no coinciden.']);
        }

        $chofer=Chofer::where('telefono',$request->telefono)->first();
        if($chofer){
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error, El teléfono ya fue registrado anteriormente.']);
        }
        
        
        $chofer=new Chofer();
        $chofer->id=GetUuid();

        $chofer->razonsocial=$request->razonsocial;
        $chofer->regsct=$request->regsct;
        $chofer->giro=$request->giro;
        $chofer->ramir=$request->ramir;
        $chofer->domicilio=$request->calle.', '.$request->numeroint.', '.$request->numeroext.', Colonia '.$request->colonia.', '.$request->municipio.', Ciudad '.$request->entidad.', C.P.'.$request->cp;

        
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->telefono=$request->telefono;
        $chofer->licencia=$request->licencia;
        $chofer->telefono=$request->telefono;
        $chofer->pass=$request->pass;

        if(!GuardarArchivos($request->inefrente,'/documentos/transportistas/choferes/inefrente',$chofer->id.'.'. $request->inefrente->getClientOriginalExtension())){
            return Redirect::back()->with('error', 'Error al guardar INE del generador.');
        }

        if(!GuardarArchivos($request->inereverso,'/documentos/transportistas/choferes/inereverso',$chofer->id.'.'. $request->inereverso->getClientOriginalExtension())){
            return Redirect::back()->with('error', 'Error al guardar INE del generador.');
        }
        
        if($chofer->telefono!=null){
            /*
            $response=EnviarMensaje("+52".$chofer->telefono,'Su numero se ha registrado en reci-trash.mx, para confirmar el registro de su número vaya al siguiente link reci-trash.mx/ConfirmacionChofer/'.$chofer->id.' .');
            if(intval($response)>=400){
                return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error, el numero telefónico no es correcto.']);
            }
                */
        }
       
        if($chofer->save()){
            return view('avisos.aviso',['titulo'=>'Registro correcto.','mensaje'=>'En breve recibirá un mensaje de texto para confirmar su teléfono.']);
        }else{
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Intentelo mas tarde.']);
        }
    }
}
