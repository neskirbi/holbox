<?php

namespace App\Http\Controllers\WebApp\Transportista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistroTController extends Controller
{
    function index(){
        return view('webapp.transportista.registro.index');
    }
}
