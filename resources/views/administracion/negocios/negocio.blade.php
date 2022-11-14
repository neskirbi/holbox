<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Registro negocio</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('administracion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('administracion.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-industry" aria-hidden="true"></i> Registro de Establecimiento</h3>            
                </div>
                <!-- /.card-header -->
                    <form method="POST" action="{{url('establecimientos')}}/{{$negocio->id}}" id="formnegocio" enctype="multipart/form-data">
                    @csrf                    
                    <input required name="_method" type="hidden" value="PUT"> 
                    <div class="card-body">  

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Establecimiento</h3>
                            </div>
                            <div class="card-body">
                            <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="generador">Generador</label>
                                            <select class="form-control" name="generador" id="generador" aria-invalid="false" >
                                                <option value="{{isset($generador->id_generador) ? $generador->id_generador : ''}}">{{isset($generador->razonsocial) ? $generador->razonsocial : ''}}</option>
                                                <optgroup></optgroup>
                                                @foreach($generadores as $generador)
                                                <option value="{{$generador->id}}">{{$generador->razonsocial}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                  
                                    
                                </div>
                               

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="negocio">Nombre del Establecimiento</label>
                                            <input required type="text" name="negocio" class="form-control" id="negocio" value="{{$negocio->negocio}}" placeholder="Nombre del Establecimiento" minlength="1" maxlength="500" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="tiponegocio">Tipo de Establecimiento</label>
                                            <select class="form-control" name="tiponegocio" id="tiponegocio" aria-invalid="false">
                                                <option value="{{$negocio->tiponegocio}}">{{$negocio->tiponegocio}}</option>
                                                <optgroup></optgroup>
                                                @foreach($tiponegocios as $tiponegocio)
                                                <option value="{{$tiponegocio->id}}">{{$tiponegocio->tiponegocio}}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                    </div>
                                </div>

                               

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input required type="text" name="calle" class="form-control" id="calle" value="{{$negocio->calle}}" placeholder="Calle" minlength="4" maxlength="150" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroext">Número Ext.</label>
                                            <input required type="text" name="numeroext" class="form-control" id="numeroext" value="{{$negocio->numeroext}}" placeholder="Número Ext." minlength="1" maxlength="10" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroint">Número Int.</label>
                                            <input required type="text" name="numeroint" class="form-control" id="numeroint" value="{{$negocio->numeroint}}"  placeholder="Número Int." minlength="1" maxlength="10" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia</label>
                                            <input required type="text" name="colonia" class="form-control" id="colonia" value="{{$negocio->colonia}}" placeholder="Colonia"  minlength="1" maxlength="150" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <input required type="text" name="municipio" class="form-control" id="municipio" value="{{$negocio->municipio}}" placeholder="Alcaldía/Municipio"  minlength="1" maxlength="150" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" class="form-control" id="cp" value="{{$negocio->cp}}" placeholder="C.P."  minlength="1" maxlength="10" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class='row'>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad Federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidad" class="form-control" id="entidad" aria-invalid="false" >
                                                <option value="{{isset($negocio->entidad) ? $negocio->entidad : '' }}">{{isset($negocio->entidad) ? $negocio->entidad : ''}}</option>
                                                <optgroup></optgroup>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->id}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="planta">Prestador de Servicio</label>
                                            <select name="planta" id="planta" name="planta" class="form-control">
                                                <option value="{{$negocio->id_planta}}">{{$planta->planta}}</option>                                                
                                                <optgroup></optgroup>
                                                @foreach($plantas as $planta)
                                                <option value="{{$planta->id}}">{{$planta->planta}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div calss="row">
                                    <div class="col-md-8">
                                        <label for="map">Ubicación del Establecimiento</label>
                                        <div id="map" style=" height: 350px; width:100%;"></div>
                                    </div>
                                </div>

                                <div class="row">                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="latitud">Latitud</label>
                                            <input required type="text" name="latitud" class="form-control" id="latitud" value="{{$negocio->latitud}}" placeholder="Latitud" aria-invalid="false" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="longitud">Longitud</label>                                           
                                            <input required type="text" name="longitud" class="form-control" id="longitud" value="{{$negocio->longitud}}" placeholder="Longitud" aria-invalid="false" readonly>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                       

                       
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Documentación</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="plan">Plan de manejo(pdf)</label>                                            
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input type="file" class="custom-file-input" id="plan" value="{{$negocio->id}}.pdf" name="plan">
                                                    <label class="custom-file-label" for="plan">Plan de manejo(pdf)</label>                                    
                                                </div>
                                            </div>
                                            <font color="red">No cambia hasta guardar.</font>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/clientes/negocios/plan').'/'.$negocio->id.'.pdf'.'?ver='.rand(0,10000)}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/clientes/negocios/plan').'/'.$negocio->id.'.pdf'}}">Ver</a>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>                
                        


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del contacto</h3>
                            </div>
                            <div class="card-body">
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contacto">Contacto</label>
                                            <input required type="text" name="contacto" class="form-control" id="contacto" value="{{$negocio->contacto}}" placeholder="Contacto"  minlength="1" maxlength="100" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo Contacto</label>
                                            <input required type="text" name="correo" class="form-control" id="correo" value="{{$negocio->correo}}" placeholder="Correo"  minlength="1" maxlength="100" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input required type="text" name="telefono" class="form-control" id="telefono" value="{{$negocio->telefono}}" placeholder="Teléfono"  minlength="1" maxlength="50" aria-invalid="false" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input required type="text" name="celular" class="form-control" id="celular" value="{{$negocio->celular}}" placeholder="Celular"  minlength="1" maxlength="50" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                               
                               
                            </div>
                        </div>                
                        
                        
                        
                    </div><!--End body-->
                    
                    <div class="card-footer" >
                        <button required type="submit" id="guardar" class="btn  btn-info float-right">{{$negocio->verificado==1 ? 'Guardar' : 'Confirmar' }}</button>
                    </div>
                </form>
            </div>
            <br>          
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    var markers = [];
    function initMap() {
        const myLatlng = { lat:  $('#latitud').val()*1, lng: $('#longitud').val()*1 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 19,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title:$('#negocio').val()
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Seleccione ubicación",
          position: myLatlng,
        });
        infoWindow.open(map,marker);
        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers()
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coornegocio = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
            position: coornegocio,
            map,
            title:$('#negocio').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La negocio se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
    }
      
</script>

@include('MapsApi')


@include('footer')
</body>
</html>
