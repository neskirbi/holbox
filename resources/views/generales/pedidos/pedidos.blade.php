<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Pedidos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

 <!-- Navbar -->
 @if(Auth::guard('clientes')->check())
    @include('cliente.navigations.navigation')  
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.navigations.navigation')  
  @endif
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::guard('clientes')->check())
    @include('cliente.sidebars.sidebar') 
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.sidebars.sidebar') 
  @endif

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
                <h3 class="card-title"><i class="fa fa-tags"></i> Pedidos</h3>

                <div class="card-tools">
                  <a href="carrito" class="btn btn-default btn-sm float-right"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <font id="capacidad">{{$cart}}</font></a>
                  <!-- Default dropleft button -->                  
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="p-2">
                  <!--<button data-toggle="modal" data-target="#modalcita" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Registrar Cita</button>-->
                  <a href="catalogo" class="btn btn-primary"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Generar Pedido</a>
                </div>
                
                @if(count($productos))
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Obra</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Estatus</th>
                        <th>Entrega</th>  
                        <th>Opciones</th>        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($productos as $producto)
                      <tr>
                        <td>{{$producto->obra}}</td>
                        <td>$ {{number_format($producto->subtotal,2)}}</td>
                        <td>$ {{number_format($producto->total,2)}}</td>
                        <td>
                            @if($producto->confirmacion == 0)
                            <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Rechazado</small>
                            @endif

                            @if($producto->confirmacion == 1)
                            <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>  Pendiente</small>
                            @endif

                            @if($producto->confirmacion == 2)
                            <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Aceptado</small>
                            @endif
                        </td>
                        <td>
                          {{$producto->confirmacion != 2 ? 'Sin Asignar' : FechaFormateadaTiempo($producto->fechaentrega)}}
                        </td>
                        <td>
                            <a href="pedidos/{{$producto->id}}" class="btn btn-info">Revisar&nbsp;<i class="fa fa-eye"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    
                      
              
                    </tbody>
                  </table>
                  {{ $productos->links('pagination::bootstrap-4') }}
                  @endif
                </div>
                <div class="card-footer">
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
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>


</body>
</html>
