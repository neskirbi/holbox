<?php

namespace App\Http\Controllers\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Vehiculo;
use App\Models\Transportista;

class VehiculoController extends Controller
{
    function index(){ 



        $vehiculos=DB::table('transportistas')
        ->join('empresastransporte','empresastransporte.id_transportista','=','transportistas.id')
        ->join('vehiculos','vehiculos.id_empresatransporte','=','empresastransporte.id')
        ->where('transportistas.id','=',Auth::guard('transportistas')->user()->id)
        ->paginate(15);
        
        return view('transportistas.vehiculos.vehiculos',['vehiculos'=>$vehiculos]);
    }

    function create(){
        
        $empresastransporte = DB::table('empresastransporte')
        ->where('id_transportista',Auth::guard('transportistas')->user()->id)
        ->orderby('razonsocial')
        ->get(); 
        return view('transportistas.vehiculos.create',['empresastransporte'=>$empresastransporte]);
    }

    function store(Request $request){  
        $buscar=Vehiculo::where('matricula',$request->matricula)
        ->first();

        if($buscar){            
            Redirect::back()->with('error', 'Esta matricula ya fue dada de alta.');
        }
        

        $vehiculo=new Vehiculo();
        $vehiculo->id = GetUuid();
        $vehiculo->id_empresatransporte = $request->empresatransporte;
        $vehiculo->vehiculo = $request->vehiculo;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->matricula = $request->matricula;
        $vehiculo->combustible = $request->combustible;
        
    
        $vehiculo->detalle = $request->detalle;
        
      

        if($vehiculo->save()){
            return redirect('vehiculo')->with('success','Vehículo registrado correctamente.');
        }else{
            return redirect('vehiculo/create')->with('error','Error al guardar.');
        }
        
        
    }

    function show($id){
        $vehiculo=Vehiculo::find($id);
        return view('transportistas.vehiculos.editar',['vehiculo'=>$vehiculo]);
        

    }
    
    function update(Request $request,$id){
        $vehiculo= Vehiculo::find($id);
        
        
        $vehiculo->vehiculo=$request->vehiculo;
        $vehiculo->marca=$request->marca;
        $vehiculo->modelo=$request->modelo;
        $vehiculo->matricula=$request->matricula;
        $vehiculo->combustible=$request->combustible;
        
        $vehiculo->detalle=$request->detalle;        
       
       

        if($vehiculo->save()){
            return redirect('vehiculo/'.$id)->with('success','Registro de vehículo exitoso');
        }else{
            return redirect('vehiculo/'.$id)->with('error','Error al guardar la vehículo');
        }
    }
}
