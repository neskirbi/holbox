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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Recolectores </h3>
                                    <div class="card-tools position-absolute end-0 top-0 mt-1 me-2" style="z-index: 2000;">
                                        
                                    </div>
                                    
                                </div>  
                                <div class="card-body">

                                    <form action="{{ url('recolectoresadm' ) }}" method="POST">
                                        @csrf

                                    

                                       <div class="card-body">
                                        <div class="row">
                                          <div class="col-md-12">                                        
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label for="nombres">Nombre(s)</label>
                                                      <input required type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false"maxlength="150" value="{{ old('nombres') }}" >
                                                  </div>                     
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label for="ramir">Apellidos</label>
                                                      <input required type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" maxlength="150" >
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              
                                              <div class="row">

                                                  <div class="col-md-12">
                                                      <div class="form-group">
                                                          <label for="licencia">Licencia</label>
                                                          
                                                          <select required class="form-control" id="licencia" name="licencia" aria-invalid="false" maxlength="100">
                                                              <option value="">--Licencia--</option>
                                                              <option value="A">A</option>
                                                              <option value="B">B</option>
                                                              <option value="C">C</option>
                                                              <option value="D">D</option>
                                                              <option value="E">E</option>
                                                              <option value="F">F</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                              
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label for="telefono">Teléfono</label>
                                                    <div class="input-group mb-3">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text">+52</span>
                                                      </div>
                                                      <input required type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" >
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              <div class="row">                          
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label for="pass">Contraseña</label>
                                                      <input required type="password" onkeyup="ValidarPass();" name="pass" class="form-control" id="pass" placeholder="Contraseña" aria-invalid="false" maxlength="255" >
                                                  </div>
                                                </div>
                                              </div>
                                              
                                             
                                              
                                            </div>
                                          </div>
                                        </div>
                                        <div class="card-footer">
                                          <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>

                                    
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