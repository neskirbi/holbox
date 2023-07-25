<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Negocios</title>

  
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-file-text" aria-hidden="true"></i> Recolección </h3>

               
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
              
                <div class="row">
                  <div class="col-md-12">
                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tienda">Nombre de la Tienda</label>
                                <input required type="text" class="form-control" id="tienda" name="tienda" placeholder="Tienda"  maxlength="150">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto">Contacto</label>
                                <input required type="text" class="form-control" id="contacto" name="contacto" placeholder="Contacto"  maxlength="150">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Teléfono (WhatsApp)</label>
                                <input required type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input required type="mail" class="form-control" id="correo" name="correo" placeholder="Correo"  maxlength="150">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="calle">Calle</label>
                                <input required type="text" class="form-control" id="calle" name="calle" placeholder="Calle"  maxlenght="150">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="next"># Exterior</label>
                                <input required type="text" class="form-control" id="next" name="next" placeholder="# Exterior" maxlenght="15">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nint"># Interior</label>
                                <input required type="text" class="form-control" id="nint" name="nint" placeholder="# Interior"  maxlenght="15">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="calle">Colonia</label>
                                <input required type="text" class="form-control" id="colonia" name="colonia" placeholder="Colonia" maxlenght="150">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="next">CP</label>
                                <input required type="text" class="form-control" id="cp" name="cp" placeholder="CP" maxlenght="15">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="entidad">Entidad federativa</label>
                                <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                <select required  name="entidad" class="form-control" id="entidad" aria-invalid="false" onchange="MunicipiosApi(this,1);">
                                    <option value="">---Entidad---</option>
                                  
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipio">Alcaldía/Municipio</label>
                                <select required name="municipio" class="form-control" id="municipio" aria-invalid="false" data-mun="municipio" >
                                                                                  
                                </select>
                            </div>
                        </div>                                   
                    </div>
                    
                  
                  </div>
                </div>
                
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
</body>
</html>
