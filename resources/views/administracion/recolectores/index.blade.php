<!DOCTYPE html>
<html lang="en">
<head>
    @include('administracion.header')
    <title>CSMX | Recolectores</title>
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
            <div class="content-header"></div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <a href="{{url('recolectoresadm/create')}}" class="btn btn-info mb-3">
                        <i class="fas fa-plus-circle me-2"></i> Agregar Recolector
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa fa-briefcase" aria-hidden="true"></i> Recolectores </h3>
                                    <div class="card-tools ">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-theme-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end p-3" style="width:300px;">
                                            <form class="px-4 py-3" action="{{url('recolectores')}}" method="GET">
                                                <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="recolector" id="recolector" placeholder="Recolector" @if(isset($filtros->recolector)) value="{{$filtros->recolector}}" @endif>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{url('recolectoresadm')}}" class="btn btn-theme-outline-gray ">Limpiar</a>
                                                <button type="submit" class="btn btn-outline-theme-primary  float-end">Aplicar</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>  
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($recolectores as $recolector)
                                        <div class="col-md-2 mb-3">
                                            <div class="card text-center shadow-sm h-100">
                                                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                                    <i class="fa fa-user card-icon mb-2 " style="font-size: 3rem;"></i>
                                                    
                                                    <!-- Contenedor con alto fijo y texto recortado -->
                                                    <div class="fw-bold text-truncate text-center" 
                                                        style="font-size: 15px; max-width: 100%; height: 2.5em; overflow: hidden;"
                                                        title="{{$recolector->nombres}} {{$recolector->apellidos}}">
                                                        {{$recolector->nombres}} {{$recolector->apellidos}}
                                                        
                                                    </div>

                                                    <div class="mt-2 w-100 d-flex justify-content-end">
                                                        <a href="{{ url('recolectoresadm') }}/{{$recolector->id }}" 
                                                        class="btn btn-sm btn-outline-info btn-block">
                                                        Ver
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="d-flex justify-content-center mt-4">
                                        {{ $recolectores->appends($_GET)->links('pagination::bootstrap-4') }}
                                        </div>

                            
                                    </div>
                                </div>         
                                
                            </div>
                        </div>
                    </div>    
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
    <script>
        function Cambio(_this){
            _this=$(_this);
            if(_this.val()==_this.data('mail')){
                _this.removeAttr('name');
            }else{            
                _this.attr('name','mail');
            }
        }
    </script>
    @include('footer')
</body>
</html>