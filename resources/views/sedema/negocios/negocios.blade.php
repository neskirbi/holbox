<!DOCTYPE html>
<html lang="en">
<head>
  @include('sedema.header')
  <title>{{GetSiglas(2)}} | Negocios</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('sedema.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('sedema.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Negocios</h3>

                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="sedeman">
                        
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="generador" id="generador" placeholder="Generador" @if(isset($filtros->generador)) value="{{$filtros->generador}}" @endif >
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="negocio" id="negocio" placeholder="negocio" @if(isset($filtros->negocio)) value="{{$filtros->negocio}}" @endif >
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-recycle"></i></span>
                          </div>
                          <input type="text" class="form-control" name="planta" id="planta" placeholder="Planta" @if(isset($filtros->planta)) value="{{$filtros->planta}}" @endif >
                        </div>


                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="exelente" id="exelente" @if(isset($filtros->exelente)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#28A745;">Exelente</span>                                                      
                        </div>
                        
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="correcto" id="correcto" @if(isset($filtros->correcto)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#7FFF00;">Correcto</span>                                                      
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="patrasado" id="patrasado" @if(isset($filtros->patrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FFF200;">Poco Atrasado</span>                                                      
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="atrasado" id="atrasado" @if(isset($filtros->atrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FF7F00;">Atrasado</span>                                                      
                        </div>

                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="matrasado" id="matrasado" @if(isset($filtros->matrasado)) checked @endif>
                          <span class=" badge" style="color:#fff; background-color:#FD003A;">Muy Atrasado</span>                                                      
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="publica" id="publica" @if(isset($filtros->publica)) checked @endif>
                            <span class=" badge" style="color:#000; ">Publica</span>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="privada" id="privada" @if(isset($filtros->privada)) checked @endif>
                            <span class=" badge" style="color:#000; ">Privada</span> 
                            </div>
                          </div>
                        </div>

                        
                                                                                
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terminada" id="terminada" @if(isset($filtros->terminada)) checked @endif>
                            <span class=" badge" style="color:#000; ">Terminada</span>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="curso" id="curso" @if(isset($filtros->curso)) checked @endif>
                            <span class=" badge" style="color:#000; ">En curso</span> 
                            </div>
                          </div>
                        </div>

                        
                      
                        <div class="dropdown-divider"></div>
                        <a href="sedeman" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>
                
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <br>
                <div calss="row">
                    <div class="col-md-12">
                        <div id="map" style=" height: 350px; width:100%;"></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12" style="overflow-x:scroll;">
                    @if(count($negocios))
                    <table class="table table-hover text-nowrap" id="negocios">
                      <thead>
                        <tr>
                        <th>Generador</th>
                        <th>Negocio</th>           
                        <th>Planta</th>         
                        <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                        @foreach($negocios as $negocio)
                        <tr>
                          <td title="{{$negocio->razonsocial}}">{{strlen($negocio->razonsocial)>40 ? mb_substr($negocio->razonsocial,0,40,"UTF-8").'...' : $negocio->razonsocial}}</td>
                          <td title="{{$negocio->negocio}}">{{strlen($negocio->negocio)>40 ? mb_substr($negocio->negocio,0,40,"UTF-8").'...' : $negocio->negocio}}</td>
                          <td title="{{$negocio->planta}}">{{strlen($negocio->planta)>40 ? mb_substr($negocio->planta,0,40,"UTF-8").'...' : $negocio->planta}}</td>  
                          
                        
                          <td>
                            @if(GetId()=='ff0fbae0093d4928a8dac955dde189ea')
                            <a href="sedeman/{{$negocio->id}}" class="btn btn-info btn-sm d-inline p-2" ><i class="fa fa-eye" aria-hidden="true"></i> Revisar</a>
                            @endif
                          </td>
                          
                        
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    
                    @endif
                  </div>
                </div>
                
                
              </div>
              <div class="card card-footer">
                {{ $negocios->appends($_GET)->links('pagination::bootstrap-4') }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
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

<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script>
    var markers = HtmltoJson('{{$marcadores}}');
    function initMap() {
      //console.log(markers);
      
      var myLatlng = { lat:  parseFloat(markers[0].latitud), lng: parseFloat(markers[0].longitud) };
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 6,
        center: myLatlng,
      });
      console.log(markers.length);
      for(var i=0;i< markers.length ; i++){
        const  id=markers[i].id,con=markers[i].con;
        
        var  myLatlng = { lat:  parseFloat(markers[i].latitud*1), lng: parseFloat(markers[i].longitud*1) };
        var image = {
          url: '{{asset("images/iconos")}}/'+markers[i].pointer,
          // Este marcador tiene 20 pixeless de ancho por 32 pixeles de alto.
          scaledSize: new google.maps.Size(29, 32),
          // El origen para esta imagen es (0, 0).
          origin: new google.maps.Point(0, 0),
          // El ancla para esa imagen es la base del asta bandera en (0, 32).
          anchor: new google.maps.Point(0, 32)
        };
        var marker = new google.maps.Marker({
            position: myLatlng,
            title: markers[i].negocio,
            icon: image
        });

         // Create the initial InfoWindow.
        /*let infoWindow = new google.maps.InfoWindow({
          content:markers[i].negocio,
          position: myLatlng,
        });
        
        infoWindow.open(map,marker);*/

        // To add the marker to the map, call setMap();

        marker.addListener("click", () => {
          window.location.href = "sedeman/"+id;
        });
        marker.setMap(map);
      }
      
    }
      
    </script>
    
@include('MapsApi')

</body>
</html>
