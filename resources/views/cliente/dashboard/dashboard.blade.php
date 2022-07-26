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
                        <a class="nav-link" id="reciclajetab" data-toggle="pill" href="#reciclaje" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Reciclaje</a>
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
                          <div class= "col-md-10">
                            <div id="accordion">
                              <div class="card card-info">
                                <div class="card-header">
                                  <h4 class="card-title">
                                    <a class="d-block  collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                      Haz clic aquí para ayuda en " Transferencia " 
                                    </a>
                                  </h4>
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                                  <div class="card-body">
                                  <style>
                                    li{
                                      color:black;
                                      
                                    }
                                  </style>  
                                  
                                  <b>
                                    <ol>
                                      <li>Haz clic en el botón transferencia.</li>
                                        <hr>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/1.jpg')}}"height="200px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>
                                      <li>Captura el monto.</li>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/2.jpg')}}"height="400px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>
                                      <li>Selecciona el "Generador" y la "Planta" correspodiente.</li>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/3.jpg')}}"height="400px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>
                                      <li>Llena los campos solicitados.</li>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/4.png')}}"height="400px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>
                                      <li>Haz clic en Generar.</li>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/5.png')}}"height="400px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>
                                      <li>Aparecerá una leyenda en la parte superior derecha en color verde de confirmación. </li>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/6.png')}}"height="50px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>
                                      <li>Podrás verlo en la lista para poder descargar el formato de pago</li>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/7.jpg')}}"height="100px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>
                                      <li>Ahora puedes imprimir el formato de pago para realizarlo en la institución bancaria correspondiente. </li>
                                        <br>
                                          <img src="{{url('images/ayuda/transferencia/8.png')}}"height="150px" style="margin-left:50px;">
                                        <br>
                                        <br>
                                        <hr>    
                                    </ol>
                                  </b>  
                                  </div>
                                </div>
                              </div>
                            </div>  
                          </div>                          
                          <div class="col-md-1"></div>
                        </div>
                        <br>
                        <div class="row">
                          <div class= "col-md-12">
                            <a data-toggle="modal" data-target="#modalpago">
                              <div  class="boxtransfer">
                                <font size="6px"><i class="fa fa-university" aria-hidden="true"></i></font>
                                <br>Tranferencia
                              </div>                      
                            </a>
                          
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

                      <div class="tab-pane fade" id="reciclaje" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab" style=" max-height: 420px; overflow-y:scroll;">
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
                          @foreach($reciclajes as $reciclaje)
                            <tr>
                              <td>{{$reciclaje->tipo}}</td>
                              <td>{{mb_substr($reciclaje->material,0,50,"UTF-8")}}</td>
                              <td>{{number_format($reciclaje->cantidad,2)}} m<sup>3</sup></td>
                              <td>$ {{number_format($reciclaje->precio)}}</td>
                              <td>$ {{number_format($reciclaje->precio*$reciclaje->cantidad,2)}}</td>
                              <td>% {{number_format($reciclaje->iva,2)}}</td>
                              <td>$ {{number_format(($reciclaje->precio*$reciclaje->cantidad)+(($reciclaje->precio*$reciclaje->cantidad)*$reciclaje->iva/100),2)}}</td>
                              <td>
                              {{FechaFormateada($reciclaje->fechacita)}}
                              </td>                            
                            </tr>
                          @endforeach                                  
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
        <div class="row">
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Obras</h3>
              </div>
              <div class="card-body">
                <div style="height:350px; overflow-y:scroll;" >
                  @foreach($obras as $obra)
                    <div class="col-12" style="cursor:pointer;" data-id="{{$obra->id}}" onclick="AvanceEntregas('{{$obra->id}}');">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-building"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-number">{{$obra->obra}}</span>
                          <span>{{$obra->superficie}} m<sup>3</sup></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      
                      <!-- /.info-box -->
                    </div>
                    
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Avance General Reciclaje</h3>
                
              </div>
              <div class="card-body">
                <div class="avancematerial" style="height:350px;">
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Avance Reciclaje</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="avance">
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle Reciclaje</h3>
                  <div class="card-tools" id="detalle">
                 
                  </div>
              </div>
              <div class="card-body" id="detalleentregas" style="overflow:scroll;">
                <div class="avance">
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

@include('cliente.dashboard.modals.modalpago')
@if(Session::has('transferencia'))
<script>
  window.open('transferencia/{{Session::get('transferencia')}}', '_blank').focus();
</script>
@endif
</body>
</html>
