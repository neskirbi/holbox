<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Plantas</title>

  
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
        <section class="col-lg-12 connectedSortable ui-sortable">
            
            @foreach($sedemas as $sedema)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Usuarios SEDEMA</h3>
                            <div class="card-tools">
                                <div class="btn-group dropleft">
                                    <button class="btn btn-default " type="button" id="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="menu">
                                        <a class="dropdown-item borrar" href="{{url('quitarsedema').'/'.$sedema->id}}" data-texto="¿Deseas quitar a {{$sedema->nombre}} de los usuarios de SEDEMA?"><i class="fa fa-trash" aria-hidden="true"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <form action="{{url('sedemas').'/'.$sedema->id}}" id="{{$sedema->id}}" method="post">
                        @csrf
                        <input required="" id="_method" name="_method" type="hidden" value="PUT">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class='form-group'>
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$sedema->nombre}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="cargo">Cargo</label>
                                        <input type="text" class="form-control" id="cargo" name="cargo" value="{{$sedema->cargo}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="mail">Correo</label>
                                        <input type="text" class="form-control" id="mail" name="mail" value="{{$sedema->mail}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="pass">Contraseña</label>
                                        <input type="text" class="form-control" id="pass" name="pass" value="{{$sedema->pass}}">
                                    </div>
                                </div>
                              
                            </div>
                        </div>                        
                        </form>
                        <div class="card-footer">
                            <button type="submit" class='btn btn-info float-right'  onclick="Submite('{{$sedema->id}}',this);" data-texto="¿Actualizar información para {{$sedema->nombre}}?">Guardar</button>
                        </div>       
                    </div>
                    
                </div>
            </div>
            @endforeach
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Usuario de SEDEMA</h3>
                            
                        </div>                        
                        <form action="{{url('sedemas')}}" id="usedema" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class='form-group'>
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-sm-4">
                                    <div class='form-group'>
                                        <label for="cargo">Cargo</label>
                                        <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="mail">Correo</label>
                                        <input type="text" class="form-control" id="mail" name="mail" placeholder="Correo">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class='form-group'>
                                        <label for="pass">Contraseña</label>
                                        <input type="text" class="form-control" id="pass" name="pass" placeholder="Contrase&ntilde;a">
                                    </div>
                                </div>
                              
                            </div>
                        </div>                        
                        </form>
                        <div class="card-footer">
                            <button type="submit" class='btn btn-info float-right'  onclick="Submite('usedema',this);" data-texto="¿Todos los datos son correctos?">Guardar</button>
                        </div>        
                    </div>
                    
                </div>
            </div>
        </section>       
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
@include('footer')
</body>
</html>
