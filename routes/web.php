<?php
use App\Http\Controllers\FormatosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionMail;
use App\Models\Token;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * Redirecciona del home al panel si es que ya esta logueado
 */
Route::get('/', function () {
    return redirect('home');
})->name('home');


/**
 * Redirecciona del home al panel si es que ya esta logueado
 */
Route::get('home', function () {
    if(Auth::guard('directores')->check()){
        return redirect('graficas');
    }   

    if(Auth::guard('administradores')->check()){
        return redirect('generador');
    }  

    if(Auth::guard('vendedores')->check()){
        return redirect('ventas');
    } 

    if(Auth::guard('recepciones')->check()){
        return redirect('cita');
    } 

    if(Auth::guard('finanzas')->check()){
        return redirect('pagosfi');
    } 

    

    

    if(Auth::guard('clientes')->check()){
        return redirect('dashboard');
    }  

    if(Auth::guard('residentes')->check()){
        return redirect('citas');
    }  
    
    if(Auth::guard('transportistas')->check()){
        return redirect('empresas');
    }  

    if(Auth::guard('sedemas')->check()){
        return redirect('sedemao');
    }  
    
    return view('home');
});



/**
 * registro de clientes
 */
Route::resource('clientes', 'App\Http\Controllers\ClienteController');

/**
 * Logins
 */


Route::get('acceso',function(){
    return view('asociados.login.login');
});


Route::get('PassReset',function(){
    return view('cliente.extras.passreset');
});

Route::post('Recuperar','App\Http\Controllers\LoginController@Recuperar');
Route::get('Recuperar/{id}',function($id){
    $token=Token::find($id);
    if($token){
        return view('cliente.extras.pass',['id'=>$id]);
    }else{
        return redirect('home')->with('error','No se encontró la petición o ya se ultilizó el link anteriormente.');
    }
});
Route::post('GuardarPass/{id}','App\Http\Controllers\LoginController@GuardarPass');

Route::post('loginasociado', 'App\Http\Controllers\LoginController@authenticateasociado');
Route::post('loginadmin', 'App\Http\Controllers\LoginController@authenticateadmin');

Route::post('loginsedema', 'App\Http\Controllers\LoginController@AuthenticateSedema');

Route::get('loginpage',function(){
    return view('loginpage');
});

Route::get('registropage', function () {
    return view('registro');
});


Route::post('Registro', 'App\Http\Controllers\RegistroController@Registro');

Route::post('Login', 'App\Http\Controllers\LoginController@Login');
Route::post('login2', 'App\Http\Controllers\LoginController@authenticate');

Route::post('loginresidentes', 'App\Http\Controllers\LoginController@authenticateresidentes');

Route::post('logintransport', 'App\Http\Controllers\LoginController@authenticatetransportista');

Route::get('logout', 'App\Http\Controllers\LoginController@logout');




//Ruta centros de acopio

Route::resource('campamentos', 'App\Http\Controllers\CampamentoController');



/**
 * Rutas para clientes
 */


Route::resource('dashboard', 'App\Http\Controllers\Cliente\DashboardController');

Route::get('GraficasPagosCliente','App\Http\Controllers\Cliente\DashboardController@GraficasPagosCliente');

Route::resource('generadores', 'App\Http\Controllers\Cliente\GeneradoresController');

Route::get('registrogenerador','App\Http\Controllers\RegistroGeneradoresController@index');

Route::resource('vehiculos', 'App\Http\Controllers\VehiculosController');


Route::get('terminos/{direccion}/{fechaini}/{fechafin}/{generador}/{total}', 'App\Http\Controllers\TerminosyCondicionesController@terminosycondiciones');

Route::get('terminosycondiciones',function(){
    return view('formatos.terminosycondiciones');
});

Route::get('/prueba', function () {
    return 'Administradores:'.Auth::guard('administradores')->check().'<br>Clientes: '. Auth::guard('clientes')->check();;
});


Route::resource('negocios','App\Http\Controllers\Cliente\NegocioController');

/***Ruta Manifiesto alcaldia */
Route::get('manifiestoalcaldia/{id}',[FormatosController::class,'manifiestoalcaldia']);


/**
 * Rutas Asociacion
 */
Route::resource('generadorasoc', 'App\Http\Controllers\Asociacion\GeneradorController');
Route::resource('catalogosasoc', 'App\Http\Controllers\Asociacion\CatalogosController');





Route::resource('plantasasoc','App\Http\Controllers\Asociacion\PlantaController');



Route::post('plantareg','App\Http\Controllers\Asociacion\PlantaController@PlantaReg');


Route::resource('sedemas', 'App\Http\Controllers\Asociacion\SedemaController');
Route::get('quitarsedema/{id}','App\Http\Controllers\Asociacion\SedemaController@QuitarSedema');






/**
 * Rutas para administradores
 */
Route::resource('planta','App\Http\Controllers\Administracion\PlantaController');
Route::post('AltaAdmin','App\Http\Controllers\Administracion\PlantaController@AltaAdmin');
Route::post('EditarAdmin/{id}','App\Http\Controllers\Administracion\PlantaController@EditarAdmin');
Route::get('BorrarAdmin/{id}','App\Http\Controllers\Administracion\PlantaController@BorrarAdmin');


Route::resource('pagos', 'App\Http\Controllers\Administracion\PagoController');
Route::post('CancelarPago/{id}', 'App\Http\Controllers\Administracion\PagoController@CancelarPago');
Route::post('VerificarPago/{id}', 'App\Http\Controllers\Administracion\PagoController@VerificarPago');
Route::post('CargarPagos', 'App\Http\Controllers\Administracion\PagoController@CargarPagos');


Route::resource('catalogos', 'App\Http\Controllers\Administracion\CatalogoController');



Route::resource('generador', 'App\Http\Controllers\Administracion\GeneradorController');





Route::resource('citasfecha', 'App\Http\Controllers\Administracion\CitasFechaController');

Route::resource('configuracion', 'App\Http\Controllers\Administracion\ConfiguracionController');

Route::post('configuracioncuenta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionCuenta');
Route::post('configuracionbanco', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBanco');
Route::post('configuracionboleta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBoleta');
Route::post('CambioPass/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@CambioPass');
Route::post('Horarios/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@Horarios');

Route::post('Residuo', 'App\Http\Controllers\Administracion\ConfiguracionController@Residuo');

Route::resource('administradores', 'App\Http\Controllers\Administracion\AdministradorController');
Route::resource('establecimientos', 'App\Http\Controllers\Administracion\NegocioController');

Route::get('cedula/{id}','App\Http\Controllers\Administracion\NegocioController@Cedula');

Route::get('imagenes',function(){
    return view('administracion.citas.imagenes');
});



Route::resource('friday','App\Http\Controllers\Administracion\FridayController');


Route::resource('reportes', 'App\Http\Controllers\Administracion\ReporteController');
Route::get('ReportePagosAdministracion/{id_planta}/{mes}/{anio}', 'App\Http\Controllers\Administracion\ReporteController@ReportePagosAdministracion');
Route::get('ReporteCitasAdministracion/{id_obra}/{ini}/{fin}/{id_planta}/{fotos}', 'App\Http\Controllers\Administracion\ReporteController@ReporteCitasAdministracion');
Route::get('ReporteTransporte/{id_obra}/{ini}/{fin}/{id_planta}', 'App\Http\Controllers\Administracion\ReporteController@ReporteTransporte');
Route::get('ReporteStatusObraAdministracion/{id_planta}', 'App\Http\Controllers\Administracion\ReporteController@ReporteStatusObraAdministracion');

Route::resource('crm','App\Http\Controllers\Administracion\CrmController');

Route::resource('entregas','App\Http\Controllers\Administracion\EntregaController');




Route::resource('plantars','App\Http\Controllers\Administracion\PlantaReciduosController');

Route::resource('recolectores','App\Http\Controllers\Administracion\RecolectorController');
Route::get('BorrarRecolector/{id}','App\Http\Controllers\Administracion\RecolectorController@BorrarRecolector');








/**
 * Recuperacion de contraseñas 
 */
Route::post('RecuperarAdmin','App\Http\Controllers\LoginController@RecuperarAdmin');

Route::get('AdminPass/{id}',function($id){
    $token=Token::find($id);
    if($token){
        return view('administracion.extras.pass',['id'=>$id]);
    }else{
        return redirect('home')->with('error','No se encontró la petición o ya se ultilizó el link anteriormente.');
    }
});


Route::post('GuardarPassAdmin/{id}','App\Http\Controllers\LoginController@GuardarPassAdmin');




/**
 * Rutas para guardar catalogo que todas apuntan al controlador Asociacion\CatalogosController.
 */






Route::post('guardarcategoriamaterial', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCategoriaMaterial');
Route::get('borrarcategoriamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCategoriaMaterial');

Route::post('guardarmaterial', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarMaterial');
Route::put('actualizamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@ActualizaMaterial');
Route::get('borrarmaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarMaterial');

Route::post('guardarcondicion', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCondicion');
Route::get('borrarcondicion/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCondicion');



/**
 * Confirmaciones de generadores, obras y no se que mas vaya a haber
 */

Route::get('confirmargenerador/{id}', 'App\Http\Controllers\Asociacion\GeneradorController@ConfirmarGenerador');





/**
 * Sacar formatos por id
 */
Route::get('contrato/{id}', 'App\Http\Controllers\FormatosController@Contrato');
Route::get('transferencia/{id}', 'App\Http\Controllers\FormatosController@Transferencia');





/**
 * Correos
 */


Route::get('confirmacion/{id}','App\Http\Controllers\LoginController@Confirmacion');


Route::get('confirmaciont/{id}','App\Http\Controllers\LoginController@Confirmaciont');




/**
 * Rutas android
 */
Route::get('TCRecitrackTrasporte',function(){
    return view('formatos.TCRecitrackTrasporte');
});





  /**
   * 
   * Rutas encuestas
   */

   Route::get('encuestas',function(){
       return redirect('hoteles');
   });

   Route::resource('hoteles','App\Http\Controllers\Encuestas\HotelController');

   Route::resource('restaurantes','App\Http\Controllers\Encuestas\RestauranteController');
   Route::get('reportehoteles','App\Http\Controllers\Encuestas\HotelController@reportehoteles');
   Route::get('reporterestaurantes','App\Http\Controllers\Encuestas\RestauranteController@reporterestaurantes');

  

    /**
     * Ruta Recolectores
     */

     
    Route::get('ConfirmacionRecolector/{id}','App\Http\Controllers\Android\Recolector\LoginController@ConfirmacionRecolector');

    
    Route::resource('RegistroChofer','App\Http\Controllers\Android\RecitrackTransporte\Choferes\ChoferController');




/**
 * Rutas desarrollo para tareas
 */

 Route::get('Fotos','App\Http\Controllers\Desarrollo\TareasController@Fotos');
 Route::get('Pass123','App\Http\Controllers\Desarrollo\TareasController@Pass123');
 
 Route::get('Contratos','App\Http\Controllers\Desarrollo\TareasController@Contratos');

 Route::get('Limite/{id}','App\Http\Controllers\Desarrollo\TareasController@Limite');
 

