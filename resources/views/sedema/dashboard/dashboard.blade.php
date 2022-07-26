<!DOCTYPE html>
<html lang="en">
<head>
  @include('sedema.header')
  <title>CSMX | Dashboard</title>

  
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
          <div class="col-md-12">
            <div class="callout callout-info">
              <h5>{{$planta->planta}}</h5>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Pagos</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <!-- small box -->
                    
                    <div class="small-box bg-info">
                    
                      <div class="inner">
                        <h3>$ {{number_format($pago,2)}}</h3>
                        <p>Pagos</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-money"></i>
                      </div>
                      <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</a>
                    </div>
                  </div>
                  
                  <!-- ./col -->
                  <div class="col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3>$ {{number_format($consumo,2)}}</h3>
                        <p>Consumo</p>
                      </div>
                      <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</a>
                    </div>
                  </div>
                </div>
                <!-- /.row grafica pagos-->  
                <div class="row">
                  <div class="col-md-12">
                    <iframe src="{{url('PagosSedemaPlanta')}}?id_planta={{$planta->id}}&year={{date('Y')}}" frameborder="0" width="100%" height="450px"></iframe>                 
                  </div>
                </div>   
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Citas</h5>
              </div>
              <div class="card-body">
                <!--citas-->
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Citas</span>
                        <span class="info-box-number">{{$citas}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Pendientes</span>
                        <span class="info-box-number">{{$pendientes}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->

                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>

                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Asistencia</span>
                        <span class="info-box-number">{{$confirmadas}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-calendar-times-o" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Falta</span>
                        <span class="info-box-number">{{$faltas}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <iframe src="{{url('CitasSedemaPlanta')}}?id_planta={{$planta->id}}&year={{date('Y')}}" frameborder="0" width="100%" height="450px"></iframe>                 
                  </div>
                </div> 


                
              </div>
            </div>
          </div>
        </div>
        

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Contratos</h5>
                <div class="card-tools">
                </div>
              </div>
              <div clas="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contratos">
                      <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
          

      </div>
      <!-- /.container-fluid -->
      
      <!-- /.row grafica citas-->  
      
      
       
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
  
  GraficaContratosDirector('{{$firmados}}','{{$sinfirmar}}');
</script>
</body>
</html>
