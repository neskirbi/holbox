<?php

namespace App\Http\Controllers\Android\RecitrackTransporte\Choferes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chofer;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('android.choferes.create');
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
        
        
        if($request->pass!=$request->pass2){
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error las contraseñas no coinciden.']);
        }

        $chofer=Chofer::where('telefono',$request->telefono)->first();
        if($chofer){
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error, El teléfono ya fue registrado anteriormente.']);
        }
        
        
        $chofer=new Chofer();
        $chofer->id=GetUuid();
        $chofer->id_empresatransporte='';
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->telefono=$request->telefono;
        $chofer->licencia=$request->licencia;
        $chofer->telefono=$request->telefono;
        $chofer->pass=$request->pass;

        if(!GuardarArchivos($request->ine,'/documentos/transportistas/choferes/ine',$chofer->id.'.'. $request->ine->getClientOriginalExtension())){
            return Redirect::back()->with('error', 'Error al guardar INE del generador.');
        }
        
        if($chofer->telefono!=null){
            $response=EnviarMensaje("+52".$chofer->telefono,'Su numero se ha registrado en reci-track.mx, para confirmar el registro de su número vaya al siguiente link reci-track.mx/ConfirmacionChofer/'.$chofer->id.' .');
            if(intval($response)>=400){
                return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Error, el numero telefónico no es correcto.']);
            }
        }

        if($chofer->save()){
            return view('avisos.aviso',['titulo'=>'Registro correcto.','mensaje'=>'En breve recibirá un mensaje de texto para confirmar su teléfono.']);
        }else{
            return view('avisos.aviso',['titulo'=>'Error','mensaje'=>'Intentelo mas tarde.']);
        }
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
