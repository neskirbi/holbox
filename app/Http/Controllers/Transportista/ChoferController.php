<?php

namespace App\Http\Controllers\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Chofer;
use App\Models\Transportista;
use App\Models\EmpresaTransporte;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $choferes=DB::table('transportistas')
        ->join('empresastransporte','empresastransporte.id_transportista','=','transportistas.id')
        ->join('choferes','choferes.id_empresatransporte','=','empresastransporte.id')
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->paginate(15);
        
        return view('transportistas.choferes.choferes',['choferes'=>$choferes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresastransporte = DB::table('empresastransporte')
        ->where('id_transportista',Auth::guard('transportistas')->user()->id)
        ->orderby('razonsocial')
        ->get(); 
        return view('transportistas.choferes.create',['empresastransporte'=>$empresastransporte]);
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
            return Redirect::back()->with('error','Las contrasañas no coinciden.');
        }
        
        $chofer=new Chofer();
        $chofer->id=GetUuid();
        $chofer->id_empresatransporte=$request->empresatransporte;
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->telefono=$request->telefono;
        $chofer->licencia=$request->licencia;
        $chofer->telefono=$request->telefono;
        $chofer->pass=$request->pass;
        
        if($chofer->telefono!=null){
            $response=EnviarMensaje("+52".$chofer->telefono,'Su numero se ha registrado en reci-track.mx, para confirmar el registro de su número vaya al siguiente link reci-track.mx/ConfirmacionChofer/'.$chofer->id.' .');
            if(intval($response)>=400){
                return Redirect::back()->with('error','Error, el numero es invalido.');
            }
        }

        if($chofer->save()){
             return redirect('chofer')->with('success','Registro correcto.');
        }else{
             return redirect('chofer')->with('error','Error, de registro.');
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
        $chofer=Chofer::find($id);
        $empresa=EmpresaTransporte::find($chofer->id_empresatransporte);
        $empresastransporte = DB::table('empresastransporte')
        ->where('id_transportista',Auth::guard('transportistas')->user()->id)
        ->orderby('razonsocial')
        ->get(); 
        return view('transportistas.choferes.editar',['empresastransporte'=>$empresastransporte,'chofer'=>$chofer,'empresa'=>$empresa]);
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

        if($request->pass!=$request->pass2){
            return Redirect::back()->with('error','Las contrasañas no coinciden.');
        }


        $chofer=Chofer::find($id);
        
        $chofer->id_empresatransporte=$request->empresatransporte;
        $chofer->nombres=$request->nombres;        
        $chofer->apellidos=$request->apellidos;
        $chofer->licencia=$request->licencia;
        if($chofer->telefono!=$request->telefono){
            return$response=EnviarMensaje("+52".$chofer->telefono,'Su numero se ha registrado en reci-track.mx, para confirmar el registro de su número vaya al siguiente link reci-track.mx/ConfirmacionChofer/'.$chofer->id.' .');
            if(intval($response)>=400){
                return Redirect::back()->with('error','Error, el numero es invalido.');
            }
        }
        $chofer->telefono=$request->telefono;
        if($request->pass!=null){
            $chofer->pass=$request->pass;
        }

        if($chofer->save()){
            return redirect('chofer/'.$id)->with('success','Registro correcto.');
       }else{
            return redirect('chofer/'.$id)->with('error','Error, de registro.');
       }
     
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
