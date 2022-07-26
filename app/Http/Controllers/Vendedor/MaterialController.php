<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\Obra;
use App\Models\MaterialObra;
use App\Models\Planta;
use App\Models\TipoObra;
use App\Models\SubtipoObra;
use App\Models\CategoriaMaterial;
use App\Models\Material;
use App\Models\CondicionMaterial;

class MaterialController extends Controller
{
    
    

    public function index()
    {
        $categoriasmateriales=DB::table('categoriasmaterial')   
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)     
        ->orderBy('categoriamaterial','asc')
        ->get();
        $materiales=DB::table('materiales')
        ->join('categoriasmaterial','categoriasmaterial.id','=','materiales.id_categoriamaterial')
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta) 
        ->orderBy('categoriasmaterial.categoriamaterial','asc')
        ->select('categoriasmaterial.categoriamaterial','materiales.id','materiales.id_categoriamaterial','materiales.material','materiales.precio')
        ->get();
        
        return view('ventas.catalogos.catalogos',['materiales'=>$materiales
        ,'categoriasmateriales'=>$categoriasmateriales]);
    }


    /**Guardan los catalogos desde la interface de administrador */


    
    function GuardarCategoriaMaterial(Request $request){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }
        $categoriamaterial=new CategoriaMaterial();
        $categoriamaterial->id=GetUuid();
        $categoriamaterial->id_planta=Auth::guard('vendedores')->user()->id_planta;
        $categoriamaterial->categoriamaterial=$request->categoriamaterial;
        if($categoriamaterial->save()){
            return Redirect::back()->with('success', 'Catalogo Actualizado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function BorrarCategoriaMaterial($id){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }

        $materiales=Material::where('id_categoriamaterial','=',$id)->get();
        foreach($materiales as $material){
            $material=Material::find($material->id);
            $material->delete(); 
        }

        $categoriamaterial=CategoriaMaterial::find($id); 

        if($categoriamaterial->delete()){
            return Redirect::back()->with('success', 'Categoria Material borrado.');
        }else{
            return Redirect::back()->with('error', 'Error al borrar.');
        }

    }

    
    function GuardarMaterial(Request $request){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }
        $categoriamaterial=CategoriaMaterial::find($request->categoriamaterial);
        if(!$categoriamaterial){
            return Redirect::back()->with('error', 'La opción (Categoría Material) no se encuentra en los catalogos.');
        }

        $material=new Material();
        $material->id=GetUuid();
        $material->id_categoriamaterial=$categoriamaterial->id;
        $material->material=$request->material;
        
        $material->precio=$request->precio;

        if($material->save()){
            return Redirect::back()->with('success', 'Material guardado.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function ActualizaMaterial(Request $request,$id){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }
        $categoriamaterial=CategoriaMaterial::find($request->categoriamaterial);
        if(!$categoriamaterial){
            return Redirect::back()->with('error', 'La opción (Categoría Material) no se encuentra en los catalogos.');
        }

        $material= Material::find($id);
        $material->id_categoriamaterial=$categoriamaterial->id;
        $material->material=$request->material;
        
        $material->precio=$request->precio;

        if($material->save()){
            return Redirect::back()->with('success', 'Material Actualizado.')->with('warning', 'Los cambios solo se reflejan en nuevos registros.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function ActualizaCategoriaMaterial(Request $request,$id){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }
        $categoriamaterial=CategoriaMaterial::find($id);
        

        $categoriamaterial->categoriamaterial=$request->categoriamaterial;

        if($categoriamaterial->save()){
            return Redirect::back()->with('success', 'Categoria Actualizado.')->with('warning', 'Los cambios solo se reflejan en nuevos registros.');
        }else{
            return Redirect::back()->with('error', 'Error al guardar.');
        }

    }

    function BorrarMaterial($id){
        if(!Auth::guard('vendedores')->check()){
            return Redirect::back()->with('error', 'No eres admin.');
        }

        $material=Material::find($id);        
        if($material->delete()){
            return Redirect::back()->with('success', 'Material borrada.');
        }else{
            return Redirect::back()->with('error', 'Error al borrar.');
        }

    }

    
}
