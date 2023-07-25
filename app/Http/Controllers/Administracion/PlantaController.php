<?php


namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Planta;
use App\Models\Administrador;
use App\Models\Recolector;
use App\Models\Configuracion;

use Redirect;

class PlantaController extends Controller
{
    function index(){
        $planta = DB::table('plantas')
        ->where('id',GetIdPlanta())
        ->first();

        $configuracion = DB::table('configuraciones')
        ->where('id_planta',GetIdPlanta())
        ->first();


        $administradores=DB::table('administradores')
        ->where('id_planta',$planta->id)
        ->orderby('created_at','asc')
        ->get();

     
        return view('administracion.plantas.planta',['planta'=>$planta,'administradores'=>$administradores,'configuracion'=>$configuracion]);
        
    }

    function show($id){
        $planta = DB::table('plantas')
        ->select('id','planta','direccion','plantaauto')
        ->where('id',$id)
        ->first();

        $recolectores=DB::table('recolectores')
        ->where('id_planta',$planta->id)
        ->orderby('administrador','asc')
        ->get();

        return view('administracion.plantas.planta',['planta'=>$planta,'recolectores'=>$recolectores]);
    }

    function update(Request $request,$id){
        $planta=Planta::find($id);
        $planta->planta=$request->planta;
        $planta->direccion=$request->direccion;
        $planta->telefono=$request->telefono;
        $planta->codigo=$request->codigo;
        $planta->plantaauto=$request->plantaauto;
        $planta->save();

        $configuracion = DB::table('configuraciones')
        ->where('id_planta',$id)
        ->first();

        $configuracion=Configuracion::find($configuracion->id);
        $configuracion->razonsocial=$request->razonsocial;

        $configuracion->save();


        return redirect('planta')->with('success', 'Se actializ&oacute; la informaci&oacute;n.');
    }


   
}
