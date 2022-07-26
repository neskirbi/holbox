<?php

namespace App\Http\Controllers\Finanzas;

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
        
        $materiales=DB::table('materiales')
        ->join('categoriasmaterial','categoriasmaterial.id','=','materiales.id_categoriamaterial')
        ->where('id_planta','=',Auth::guard('finanzas')->user()->id_planta) 
        ->orderBy('categoriasmaterial.categoriamaterial','asc')
        ->select('categoriasmaterial.categoriamaterial','materiales.id','materiales.id_categoriamaterial','materiales.material','materiales.precio')
        ->get();
        
        return view('finanzas.catalogos.catalogos',['materiales'=>$materiales]);
    }


    /**Guardan los catalogos desde la interface de administrador */


    
    

    
}
