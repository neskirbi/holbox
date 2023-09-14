<!DOCTYPE html>
<html lang="en">
<head>
  @include('asociados.header')
  <title>AMRCD | Plantas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
  
  @include('asociados.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('asociados.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
              <h3 class="card-title"> <i class="nav-icon fa fa-recycle" aria-hidden="true"></i> Plantas</h3>
                <div class="card-tools">
                  <div class="btn-group">
                    <button type="button" class="btn  btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('pagosv')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
                        </div>
                        

                        <div class="dropdown-divider"></div>
                        <a href="{{url('pagosv')}}" class="btn btn-block btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-block btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>              

                
              </div>
              <div class="card-body">
              @if(count($plantas))
                @foreach($plantas as $planta)

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <h5 class="card-title"><b>{{strlen($planta->planta)<81 ? $planta->planta : mb_substr($planta->planta,0,80,"UTF-8").'...'}}</b></h5>
                              @if($planta->activa==0)
                                <small class="badge badge-danger float-right"><i class="fa fa-times" aria-hidden="true"></i> Inactiva</small>
                              @elseif($planta->activa==1)
                                <small class="badge badge-success float-right"><i class="fa fa-check" aria-hidden="true"></i> Activa</small>
                              @endif
                             
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              Autorización: <b>{{$planta->plantaauto}}</b>
                            </div>
                          </div>
                          <br><br>
                          <div class="row">
                                                    
                            <div class="col-md-3" >
                              @if($planta->activa==0)
                                <form action="{{url('ActivarPlanta')}}/{{$planta->id}}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <button style="width:100%;" class="btn btn-block btn-success"><i class="fa fa-check" aria-hidden="true"></i> Activar</button>
                                </form>
                              @elseif($planta->activa==1)
                                <form action="{{url('InactivarPlanta')}}/{{$planta->id}}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <button style="width:100%;" class="btn btn-block btn-danger" ><i class="fa fa-times" aria-hidden="true"></i> Inactivar</button>   
                                </form>
                                
                              @endif
                              
                            </div>
                            <div class="col-md-3" > 
                              
                            </div> 
                            <div class="col-md-3" > 
                              <a href="{{url('administradoresasoc')}}/{{$planta->id}}" target="_blank" class="btn btn-block btn-info"><i class="fa fa-group" aria-hidden="true"></i> Administradores</a>
                            </div>   
                            <div class="col-md-3" >
                              <a href="{{url('configuracionasoc')}}/{{$planta->id}}" class="btn btn-block btn-info"><i class="fa fa-cogs" aria-hidden="true"></i> Configuración</a>
                            </div>   
                          </div>
                        </div>
                    </div>
                      
                  </div>
                </div>



                
                
                @endforeach
                @endif


                
              </div>

              <div class="card-footer">
              {{ $plantas->appends($_GET)->links('pagination::bootstrap-4') }}
              </div>
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
<script>
</script>

</body>
</html>
