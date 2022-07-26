<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteMensualVendedor;
use Redirect;

class KpiController extends Controller
{
    function index(Request $request){
        /**
         * Datos para la grafica de citas
         */
        $year = isset($request->year) ? $request->year : date('Y');
        $month = isset($request->month) ? $request->month : date('m');

        $materiales = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',Auth::guard('finanzas')->user()->id_planta)
        ->where('citas.confirmacion',1)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')        
        ->whereraw('MONTH(citas.created_at) = \''.$month.'\'')
        ->select('citas.material',DB::raw("sum(citas.cantidad) as cantidad"),
        DB::raw("sum(citas.precio*citas.cantidad) as monto"))
        ->groupby('citas.material')
        ->get();

     
        
        
        return view('finanzas.kpis.kpis',['filtros'=>$request,'materiales'=>$materiales]);
    }
}
