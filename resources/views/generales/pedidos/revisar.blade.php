<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Pedidos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

!-- Navbar -->
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
            @if($pedido->confirmacion==0)
            <div class="card-danger">
            @endif

            @if($pedido->confirmacion==1)
            <div class="card-warning">
            @endif

            @if($pedido->confirmacion==2)
            <div class="card-success">
            @endif

              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-tags"></i> Detalle</h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-bod">       
                  <?php $subtotal=0;?>
                  <?php $orden=0;?>
                  @foreach($productos as $producto)
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-3">
                                          <center><img src="{{$producto->portada=='' ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : $producto->portada}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                                      </div>
                                      <div class="col-md-9">
                                          <h5 class="card-title"><b>{{$producto->producto}}</b></h5>

                                          <p class="card-text">
                                          {{$producto->descripcion}}
                                          </p>
                                          <div class="row">
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="cantidad">Cantidad</label>
                                                <div class="input-group">
                                                  <input type="number" class="form-control" step="0.01" min="0" id="cantidad{{$orden}}" name="cantidad[]" value="{{$producto->cantidad}}" onkeyup="CalculaCosto({{$orden}})" onclick="CalculaCosto({{$orden}})">
                                                  <div class="input-group-append">
                                                      <span class="input-group-text">m<sup>3</sup></span>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">$</span>
                                                  </div>
                                                  <input disabled class="form-control" id="precio{{$orden}}" type="text" value="{{number_format($producto->precio,2)}}">
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                              <div class="form-group">
                                                <label for="costo">Costo</label>                                                
                                                <input type="text" name="id[]" value="{{$producto->id}}" style="display:none;">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input disabled class="form-control" id="costo{{$orden}}" name="costo" type="text" value="{{number_format($producto->precio*$producto->cantidad,2)}}">
                                                    <?php $subtotal+=$producto->precio*$producto->cantidad;?>
                                                </div>
                                              </div>                                            
                                            </div>
                                            </td>
                                          </div> 
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
                  <?php $orden++;?>
                  @endforeach
                  @foreach($transportes as $producto)
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card">                                                       
                              <div class="card-body">
                                @if($pedido->confirmacion==1)
                                  <a class="btn btn-tool float-right borrar" href="{{url('QuitardelCarrito').'/'.$producto->id}}" data-texto="¿Deseas quitar a {{$producto->producto}} del carrito?">                                
                                    <i class="fas fa-times"></i>
                                  </a>
                                @endif
                                <div class="row">
                                  <div class="col-md-3">
                                      <center><img src="{{$producto->portada=='' ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : $producto->portada}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                                  </div>
                                  <div class="col-md-9">
                                    <h5 class="card-title"><b>{{$producto->producto}}</b></h5>

                                    <p class="card-text">
                                    {{$producto->descripcion}}
                                    </p>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="cantidad">Cantidad</label>
                                          <div class="input-group">
                                            <input type="number" step="1" min="0" class="form-control" id="cantidad{{$orden}}" name="cantidad[]" value="{{number_format($producto->cantidad,2)}}"  onkeyup="CalculaCosto({{$orden}})" onclick="CalculaCosto({{$orden}})">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-truck" aria-hidden="true"></i></span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="precio">Precio</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input disabled class="form-control" id="precio{{$orden}}" type="text" value="{{number_format($producto->precio,2)}}">
                                            
                                            
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="costo">Costo</label>
                                            <input type="text" name="id[]" value="{{$producto->id}}" style="display:none;">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                  <span class="input-group-text">$</span>
                                              </div>
                                              <input disabled class="form-control" id="costo{{$orden}}" name="costo" type="text" value="{{number_format($producto->precio*$producto->cantidad,2)}}">
                                              <?php $subtotal+=$producto->precio*$producto->cantidad;?>
                                          </div>
                                        </div>                                            
                                      </div>
                                    </div> 
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <?php $orden++;?>                  
                  @endforeach
                
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h5 class="card-title">Cotización</h5>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="costo">Instrucciones</label>
                                    <textarea disabled class="form-control" rows="10" name="instrucciones" placeholder="Comentarios">{{$pedido->instrucciones}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="costo">Subtotal</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input disabled class="form-control" id="subtotal" type="text" value="{{number_format($subtotal,2)}}">
                                    </div>
                                  </div> 
                                </div>
                              </div>

                              <div class="row">                          
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="costo">IVA</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input disabled class="form-control" id="iva" type="text" value="{{number_format($pedido->iva,2)}}">
                                    </div>
                                  </div> 
                                </div>
                              </div>
                              <div class="row">                         
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="costo">Total</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input disabled class="form-control" id="total" type="text" value="{{number_format($pedido->total,2)}}">
                                    </div>
                                  </div> 
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <div class="card-footer"></div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                 
                  @if($pedido->confirmacion==2)
                  <div class="row">
                    <div class="col-md-16">
                        <div class="form-group">
                            <label for="costo">Fecha de entrega</label>
                            <input disabled class="form-control" type="datetime-local" name="fechaentrega" id="fechaentrega" value="{{$pedido->fechaentrega==$pedido->created_at ? '' :str_replace(' ','T',$pedido->fechaentrega)}}">
                        </div>
                    </div> 
                  </div> 
                  @endif  
                  
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="costo">Comentario</label>
                            <textarea disabled class="form-control" rows="10" name="comentario" placeholder="Comentario">{{$pedido->comentario}}</textarea>
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

</body>
</html>
