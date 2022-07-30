<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Dashboard</title>
  
</head>
<style>
  .boxpago{
    -webkit-box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    -moz-box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    box-shadow: 1px 2px 57px -15px rgba(0,0,0,0.75);
    border:1px #ccc solid; 
    border-radius:15px; 
    width:100%;
    padding:10px; 
    text-align:center;
  }

  .boxtransfer{
    border:1px #ccc solid; 
    border-radius:15px;
    padding:10px; 
    text-align:center;
    display:inline-block;
    cursor:pointer;

  }

</style>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts') 
<div class="wrapper">

  <!-- Preloader 
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Navbar -->
 
  @include('cliente.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente.sidebars.sidebar')

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
              

        </div>  
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>$ {{number_format($pago==null ? 0 : $pago ,2)}}</h3>

                <p>Pagos</p>
              </div>
              <div class="icon">
              <i class="fas fa-donate"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-md-4">
            <!-- small box -->
            @if(($pago-$gasto+$compenzado)<0)
            <div class="small-box bg-danger">
            @else
            <div class="small-box bg-info">
            @endif
            
              <div class="inner">
                <h3>$ {{number_format($pago-$gasto+$compenzado,2)}}</h3>

                <p>Saldo</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>$ {{ number_format($gasto,2)}}</h3>
                <p>Consumo</p>
              </div>
              <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</i></a>
            </div>
          </div>
          </div>
        <!-- /.row --> 
        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Depósito y Consumo</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body">
                <div class="card card-primary card-outline card-outline-tabs" style="height:550px;">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="graficatab" data-toggle="pill" href="#grafica" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Vista General</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pagostab" data-toggle="pill" href="#pagos" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pagos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="recolecciontab" data-toggle="pill" href="#recoleccion" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Recolección</a>
                      </li>
                      
                      
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade active show" id="grafica" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <iframe src="{{url('GraficasPagosCliente')}}" frameborder="0" width="100%" height="450px"></iframe>
                      </div>
                      
                  

                      <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
                        
                        <div class="row">
                          <div class= "col-md-12">
                            
                          
                            <br>
                            <br>
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th>Monto</th>
                                  <th>Referencia</th>
                                  <th>Descripción</th>
                                  <th>Fecha</th>
                                  <th colspan="2">Estatus</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($pagodetalles as $pagodetalle)
                                <tr>
                                  <td>$ {{number_format($pagodetalle->monto,2)}}</td>
                                  <td>{{$pagodetalle->referencia}}</td>
                                  <td>{{$pagodetalle->descripcion}}</td>
                                  <td>{{FechaFormateada($pagodetalle->created_at)}}</td>
                                  <td>
                                      @if($pagodetalle->status==0)
                                        <small style="cursor:pointer;" onclick="alert('Detalle: {{$pagodetalle->detalle}}');" title="{{$pagodetalle->detalle}}" class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelado</small>
                                      @elseif($pagodetalle->status==1)
                                        <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i> Pendiente</small>
                                      @elseif($pagodetalle->status==2)
                                        <small class="badge badge-info"><i class="fa fa-check" aria-hidden="true"></i> Correcto</small>
                                      @endif
                                  </td>
                                  <td>
                                  @if($pagodetalle->status==1)
                                    <a href="transferencia/{{$pagodetalle->id}}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Formato</a>
                                  @endif
                                  </td>
                                  
                                
                                </tr>
                              @endforeach                                  
                              </tbody>
                            </table>
                          </div>
                        </div>
                        
                        
                      </div>

                      <div class="tab-pane fade" id="recoleccion" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>Tipo</th>
                              <th>Material</th>
                              <th>Cantidad</th>
                              <th>Precio</th>
                              <th>Subtotal</th>
                              <th>IVA</th>
                              <th>Total</th>
                              <th>Fecha</th>
                            </tr>
                          </thead>
                          <tbody>
                                                          
                          </tbody>
                        </table>
                      </div>
                      <!--<div class="tab-pane fade" id="transferencia" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
                        
                      </div>-->
                      
                    </div>
                  </div>
                <!-- /.card -->
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

@if(Session::has('transferencia'))
<script>
  window.open('transferencia/{{Session::get('transferencia')}}', '_blank').focus();
</script>
@endif
</body>
</html>
