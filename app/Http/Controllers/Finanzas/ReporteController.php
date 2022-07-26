<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReporteCitasAdministracion;
use App\Exports\ReporteCitasAdministracionFotos;
use App\Exports\ReportePagosAdministracion;
use App\Exports\Finanzas\ReporteObra;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Obra;

class ReporteController extends Controller
{

    function index(){
        $obras=Obra::where('id_planta',Auth::guard('finanzas')->user()->id_planta)->orderby('obra','asc')->get();
        return view('finanzas.reportes.reportes',['obras'=>$obras]);
    }



    function Geppettos(){
        return Excel::download(new ReporteObra(), 'ReportesObras'.'.xlsx');
    }
}
