<?php
use App\Http\Controllers\FormatosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionMail;
use App\Models\Token;
use App\Models\TipoObra;
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
        return redirect('pagos');
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


//Rutas transportistas


Route::resource('vehiculo', 'App\Http\Controllers\Transportista\VehiculoController');
Route::resource('chofer', 'App\Http\Controllers\Transportista\ChoferController');

Route::resource('empresas', 'App\Http\Controllers\Transportista\EmpresaController');

Route::resource('transportista','App\Http\Controllers\Transportista\TransportistaController');

Route::resource('ubicacion','App\Http\Controllers\Transportista\UbicacionController');
Route::resource('viajes','App\Http\Controllers\Transportista\ViajeController');



Route::get('mapa','App\Http\Controllers\Transportista\UbicacionController@Mapa');
Route::get('ruta','App\Http\Controllers\Transportista\UbicacionController@Ruta');


//Ruta centros de acopio

Route::resource('campamentos', 'App\Http\Controllers\CampamentoController');



/**
 * Rutas para clientes
 */


Route::resource('dashboard', 'App\Http\Controllers\Cliente\DashboardController');

Route::get('GraficasPagosCliente','App\Http\Controllers\Cliente\DashboardController@GraficasPagosCliente');

Route::resource('generadores', 'App\Http\Controllers\Cliente\GeneradoresController');

Route::get('registrogenerador','App\Http\Controllers\RegistroGeneradoresController@index');
Route::get('registroobra','App\Http\Controllers\ObraController@RegistroObra');


Route::resource('obras','App\Http\Controllers\ObraController');
Route::put('cargarplan/{id}', 'App\Http\Controllers\ObraController@CargarPlan');

Route::resource('vehiculos', 'App\Http\Controllers\VehiculosController');

Route::resource('citas', 'App\Http\Controllers\CitasController');


Route::get('reciclaje', 'App\Http\Controllers\CitasController@Reciclaje');
Route::post('citareciclaje', 'App\Http\Controllers\CitasController@CitaReciclaje');

Route::post('citarecoleccion', 'App\Http\Controllers\CitasController@CitaRecoleccion');
Route::get('recoleccion', 'App\Http\Controllers\CitasController@Recoleccion');


Route::get('terminos/{direccion}/{fechaini}/{fechafin}/{generador}/{total}', 'App\Http\Controllers\TerminosyCondicionesController@terminosycondiciones');

Route::get('terminosycondiciones',function(){
    return view('formatos.terminosycondiciones');
});

Route::get('/prueba', function () {
    return 'Administradores:'.Auth::guard('administradores')->check().'<br>Clientes: '. Auth::guard('clientes')->check();;
});


Route::resource('negocios','App\Http\Controllers\Cliente\NegocioController');
Route::get('negocio/cedula/{id}','App\Http\Controllers\Cliente\NegocioController@Cedula');

/***Ruta Manifiesto alcaldia */
Route::get('manifiestoalcaldia/{id}',[FormatosController::class,'manifiestoalcaldia']);


/**
 * Rutas Asociacion
 */
Route::resource('generadorasoc', 'App\Http\Controllers\Asociacion\GeneradorController');
Route::resource('catalogosasoc', 'App\Http\Controllers\Asociacion\CatalogosController');
Route::resource('obrasasoc', 'App\Http\Controllers\Asociacion\ObraController');
Route::resource('citasasoc', 'App\Http\Controllers\Asociacion\CitasController');

Route::resource('plantasasoc','App\Http\Controllers\Asociacion\PlantaController');



Route::post('plantareg','App\Http\Controllers\Asociacion\PlantaController@PlantaReg');


Route::resource('sedemas', 'App\Http\Controllers\Asociacion\SedemaController');
Route::get('quitarsedema/{id}','App\Http\Controllers\Asociacion\SedemaController@QuitarSedema');


/**Rutas para Directores */

Route::resource('graficas', 'App\Http\Controllers\Director\DashboardController');
Route::resource('contratosdetalle','App\Http\Controllers\Director\ObraController');
Route::get('pagosdirector','App\Http\Controllers\Director\DashboardController@Pagos');

Route::get('GraficaPagosDiretor','App\Http\Controllers\Director\DashboardController@GraficaPagosDiretor');
Route::get('GraficasCitasDirector','App\Http\Controllers\Director\DashboardController@GraficasCitasDirector');
Route::get('GraficasMaterialMesDirector','App\Http\Controllers\Director\DashboardController@GraficasMaterialMesDirector');

Route::get('citasdirector','App\Http\Controllers\Director\DashboardController@Citas');
Route::get('saldosdirector','App\Http\Controllers\Director\DashboardController@Saldos');




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

Route::resource('obra', 'App\Http\Controllers\Administracion\ObraController');
Route::post('CargarContrato/{id}', 'App\Http\Controllers\Administracion\ObraController@CargarContrato');
Route::get('ValidarObra/{id}', 'App\Http\Controllers\Administracion\ObraController@ValidarObra');

Route::resource('citasadmin', 'App\Http\Controllers\Administracion\CitasController');

Route::resource('citasfecha', 'App\Http\Controllers\Administracion\CitasFechaController');

Route::resource('configuracion', 'App\Http\Controllers\Administracion\ConfiguracionController');

Route::post('configuracioncuenta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionCuenta');
Route::post('configuracionbanco', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBanco');
Route::post('configuracionboleta', 'App\Http\Controllers\Administracion\ConfiguracionController@ConfiguracionBoleta');
Route::post('CambioPass/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@CambioPass');
Route::post('Horarios/{id}', 'App\Http\Controllers\Administracion\ConfiguracionController@Horarios');

Route::resource('administradores', 'App\Http\Controllers\Administracion\AdministradorController');
Route::resource('establecimientos', 'App\Http\Controllers\Administracion\NegocioController');

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

/**
 * Rutas para vendedores (Protocolo rueditas de bici)
 */

 
Route::resource('dashboardv','App\Http\Controllers\Vendedor\DashboardController');
Route::get('GraficasMaterialMesVendedor','App\Http\Controllers\Vendedor\DashboardController@GraficasMaterialMesVendedor');
Route::get('ReporteMensualvendedor/{month}/{year}','App\Http\Controllers\Vendedor\DashboardController@ReporteMensualvendedor');


Route::resource('obrav','App\Http\Controllers\Vendedor\ObraController');

Route::resource('pagosv', 'App\Http\Controllers\Vendedor\PagoController');

Route::resource('ventas','App\Http\Controllers\Vendedor\VentaController');

Route::post('CancelarPagov/{id}', 'App\Http\Controllers\Vendedor\PagoController@CancelarPago');
Route::post('VerificarPagov/{id}', 'App\Http\Controllers\Vendedor\PagoController@VerificarPago');


Route::resource('productos','App\Http\Controllers\Vendedor\ProductoController');
Route::get('agregar','App\Http\Controllers\Vendedor\ProductoController@Agregar');
Route::get('productofotos/{id}','App\Http\Controllers\Vendedor\ProductoController@FotosProductos');


Route::resource('transporte','App\Http\Controllers\Vendedor\TransporteController');
Route::get('cargar','App\Http\Controllers\Vendedor\TransporteController@Cargar');


Route::post('RechazarPedido/{id}','App\Http\Controllers\Vendedor\VentaController@RechazarPedido');

Route::post('AceptarPedido/{id}','App\Http\Controllers\Vendedor\VentaController@AceptarPedido');

Route::post('GuardarPedido/{id}','App\Http\Controllers\Vendedor\VentaController@GuardarPedido');


Route::resource('reporteven', 'App\Http\Controllers\Vendedor\ReporteController');



Route::resource('materiales', 'App\Http\Controllers\Vendedor\MaterialController');


Route::post('guardarcategoriamaterialadm', 'App\Http\Controllers\Vendedor\MaterialController@GuardarCategoriaMaterial');
Route::put('actualizacategoriamaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@ActualizaCategoriaMaterial');
Route::get('borrarcategoriamaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@BorrarCategoriaMaterial');

Route::post('guardarmaterialadm', 'App\Http\Controllers\Vendedor\MaterialController@GuardarMaterial');
Route::put('actualizamaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@ActualizaMaterial');
Route::get('borrarmaterialadm/{id}', 'App\Http\Controllers\Vendedor\MaterialController@BorrarMaterial');


Route::get('PassResetAdmin',function(){
    return view('administracion.extras.passreset');
});


/**
 * Rutas para recepcion
 */

 
Route::resource('cita', 'App\Http\Controllers\Recepcion\CitasController');
Route::resource('reportesre', 'App\Http\Controllers\Recepcion\ReporteController');
Route::resource('configuracionnes', 'App\Http\Controllers\Recepcion\ConfiguracionController');
Route::post('configuracioncuentanes', 'App\Http\Controllers\Recepcion\ConfiguracionController@ConfiguracionCuenta');
Route::post('CambioPassnes/{id}', 'App\Http\Controllers\Recepcion\ConfiguracionController@CambioPass');




Route::resource('microgeneradoresa','App\Http\Controllers\Recepcion\MgeneradoresController');
Route::get('ConfirmarMicro/{id}','App\Http\Controllers\Recepcion\MgeneradoresController@ConfirmarMicro');




/**
 * Rutas para finanzas (Geppetto)
 */

Route::resource('pagosfi', 'App\Http\Controllers\Finanzas\PagoController');
Route::resource('obrasfi', 'App\Http\Controllers\Finanzas\ObraController');
Route::resource('generadoresfi', 'App\Http\Controllers\Finanzas\GeneradorController');
Route::resource('kpifi', 'App\Http\Controllers\Finanzas\KpiController');
Route::resource('materialesfi', 'App\Http\Controllers\Finanzas\MaterialController');
Route::resource('reportesfi', 'App\Http\Controllers\Finanzas\ReporteController');


Route::get('ReporteObrasFinanzas','App\Http\Controllers\Finanzas\ReporteController@Geppettos');


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
Route::post('guardarplanta', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarPlanta');

Route::post('guardartipoobra', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarTipoobra');
Route::get('borrartipoobra/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarTipoobra');


Route::post('guardarcategoriamaterial', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCategoriaMaterial');
Route::get('borrarcategoriamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCategoriaMaterial');

Route::post('guardarmaterial', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarMaterial');
Route::put('actualizamaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@ActualizaMaterial');
Route::get('borrarmaterial/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarMaterial');

Route::post('guardarcondicion', 'App\Http\Controllers\Asociacion\CatalogosController@GuardarCondicion');
Route::get('borrarcondicion/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarCondicion');



//Route::get('borrarproducto/{id}', 'App\Http\Controllers\Asociacion\CatalogosController@BorrarProducto');

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
 * Rutas para residentes
 */

Route::resource('residentes', 'App\Http\Controllers\ResidenteController');
Route::get('registroresidente', 'App\Http\Controllers\ResidenteController@RegistroResidente');
Route::resource('pedidos', 'App\Http\Controllers\PedidoController');
Route::get('carrito', 'App\Http\Controllers\PedidoController@Carrito');
Route::get('QuitardelCarrito/{id}','App\Http\Controllers\PedidoController@QuitardelCarrito');

Route::get('catalogo', 'App\Http\Controllers\PedidoController@Catalogo');
/**
 * Rutas para informacion de SEDEMA
 */

 /*
Route::resource('plantas','App\Http\Controllers\Sedema\PlantaController');
Route::get('PagosSedemaPlanta','App\Http\Controllers\Sedema\PlantaController@PagosSedemaPlanta');
Route::get('CitasSedemaPlanta','App\Http\Controllers\Sedema\PlantaController@CitasSedemaPlanta');

Route::resource('sedemag', 'App\Http\Controllers\Sedema\GeneradorController');
Route::get('sedemag/{con}/{id}', 'App\Http\Controllers\Sedema\GeneradorController@show');
Route::get('sedemad/{con}/{id}', 'App\Http\Controllers\Sedema\GeneradorController@Dashboard');

Route::resource('sedemao', 'App\Http\Controllers\Sedema\ObraController');
Route::get('sedemao/{con}/{id}', 'App\Http\Controllers\Sedema\ObraController@show');

Route::get('reporte/{con}/{id}', 'App\Http\Controllers\Sedema\ObraController@Reporte');
Route::get('reporteobra/{id}', 'App\Http\Controllers\ObraController@ReporteObra');


Route::resource('configuraciones', 'App\Http\Controllers\Sedema\ConfiguracionController');
Route::post('DatosCuentaEdit', 'App\Http\Controllers\Sedema\ConfiguracionController@DatosCuentaEdit');


Route::resource('admsedema', 'App\Http\Controllers\Sedema\AdministradorController');
Route::get('quitaradminsedema/{id}', 'App\Http\Controllers\Sedema\AdministradorController@QuitarAdmin');


Route::get('GraficasPagosClienteSedema/{con}/{id}','App\Http\Controllers\Sedema\GeneradorController@GraficasPagosClienteSedema');
*/


/**
 * Correos
 */


Route::get('confirmacion/{id}','App\Http\Controllers\LoginController@Confirmacion');


Route::get('confirmaciont/{id}','App\Http\Controllers\LoginController@Confirmaciont');

/**
 * Pagos cliente
 */

//Route::post('PagoCliente', 'App\Http\Controllers\PagosController@PagoCliente');


//Route::get('ContratoRC/{id}', 'App\Http\Controllers\FormatosController@ContratoRC');
//Route::get('ContratoRCT/{id}', 'App\Http\Controllers\FormatosController@ContratoRCT');



/**
 * Rutas android
 */
Route::get('TCRecitrackTrasporte',function(){
    return view('formatos.TCRecitrackTrasporte');
});
/*
Route::get('citarev/{id}/{admin}','App\Http\Controllers\Android\CitaController@CitaRev');
Route::put('citaconfirmacion/{id}/{admin}','App\Http\Controllers\Android\CitaController@CitaConfirmacion');
Route::get('ConfirmacionChofer/{id}','App\Http\Controllers\Android\RecitrackTransporte\Choferes\LoginController@Confirmacion');
*/


 /**
  * Micreogeneradores
  */

  //Route::resource('microgeneradores','App\Http\Controllers\Mgeneradores\MgeneradoresController');
  

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
    * Rutas generales
    */

    /*
    Route::get('boleta/{id}', 'App\Http\Controllers\General\CitaController@boleta');
    Route::get('manifiesto/{id}', 'App\Http\Controllers\General\CitaController@manifiesto'); 
    Route::get('terminacion/{id}', 'App\Http\Controllers\General\ObraController@terminacion'); 
    
    Route::get('manifiestodescarga/{id}', 'App\Http\Controllers\General\CitaController@manifiestodescarga');   
    Route::get('manifiestos/{id}', 'App\Http\Controllers\General\CitaController@manifiestos');
    Route::get('EntregaQr/{id}', 'App\Http\Controllers\General\CitaController@EntregaQr');
    

    Route::get('firma/{id}', 'App\Http\Controllers\CitasController@FirmaTransporte');
    Route::post('firma/{id}', 'App\Http\Controllers\CitasController@Entregar');
*/


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
 
 Route::get('tipoobra',function(){
      return $tipoobra=TipoObra::select('tipoobra',DB::raw("group_concat(subtipoobra) as subtipoobra"))->groupby('tipoobra')->get();
      
 });