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
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#nuevoResiduoModal">
          <i class="fas fa-plus-circle mr-2"></i> Agregar Nuevo Residuo
        </button>


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header position-relative">
                <h3 class="card-title"><i class="fa fa-briefcase title-icon" aria-hidden="true"></i> Residuos </h3>

                


                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                
                <div class="row">
                  <div class="col-md-12" >
                    @if(count($residuos))
                    
                    
                        @php
                          $agrupados = $residuos->groupBy('categoria');
                        @endphp

                        @foreach($agrupados as $categoria => $items)
                          <div class="mb-4">
                            <!-- Encabezado de categoría -->
                            <h5 class="text-primary border-bottom pb-1 mb-3">
                              <i class="fa fa-tag me-2"></i>{{ $categoria }}
                            </h5>

                            <ul class="list-group">
                              @foreach($items as $residuo)
                              <li class="list-group-item border-primary mb-2">
                                <form method="POST" action="{{ route('residuos.update', $residuo->id) }}" class="residuo-form">
                                  @csrf
                                  @method('PUT')

                                  <div class="row">
                                    <!-- Categoría (renglón completo) -->
                                    <div class="col-md-12 mb-2">
                                      <label class="form-label small text-muted">Categoría</label>
                                      <input type="text" name="categoria" value="{{ $residuo->categoria }}" class="form-control form-control-sm" required>
                                    </div>

                                    <!-- Residuo (renglón completo) -->
                                    <div class="col-md-12 mb-2">
                                      <label class="form-label small text-muted">Nombre del residuo</label>
                                      <input type="text" name="residuo" value="{{ $residuo->residuo }}" class="form-control form-control-sm" required>
                                    </div>

                                    <!-- Precio -->
                                    <div class="col-md-4 mb-2">
                                      <label class="form-label small text-muted">Precio</label>
                                      <input type="number" step="0.01" name="precio" value="{{ $residuo->precio }}" class="form-control form-control-sm" required>
                                    </div>

                                    <!-- Unidades -->
                                    <div class="col-md-4 mb-2">
                                      <label class="form-label small text-muted">Unidades</label>
                                      <input type="text" name="unidades" value="{{ $residuo->unidades }}" class="form-control form-control-sm" required>
                                    </div>

                                    <!-- Botones -->
                                    <div class="col-md-4 d-flex align-items-end gap-2">
                                      <button type="submit" class="btn btn-sm btn-primary flex-grow-1">
                                        <i class="fa fa-save"></i> Guardar
                                      </button>
                                      
                                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminacion('{{ $residuo->id }}')">
                                        <i class="fa fa-trash"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>

                                <!-- Formulario oculto para eliminar -->
                                <form id="delete-form-{{ $residuo->id }}" action="{{ route('residuos.destroy', $residuo->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                                </form>
                              </li>
                              @endforeach
                            </ul>
                          </div>
                        @endforeach


                   
                    @endif
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

<script>
function confirmarEliminacion(id) {
  if (confirm('¿Estás seguro que deseas eliminar este residuo?\nEsta acción no se puede deshacer.')) {
    document.getElementById('delete-form-' + id).submit();
  }
}
</script>



<!-- Modal para agregar nuevo residuo (Bootstrap 4) -->
<div class="modal fade" id="nuevoResiduoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoResiduoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="nuevoResiduoModalLabel">Registrar Nuevo Residuo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('residuos.store') }}" id="formNuevoResiduo">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
          </div>
          <div class="form-group">
            <label for="residuo" class="form-label">Nombre del Residuo</label>
            <input type="text" class="form-control" id="residuo" name="residuo" required>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="precio" class="form-label">Precio</label>
              <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="col-md-6 form-group">
              <label for="unidades" class="form-label">Unidades</label>
              <input type="text" class="form-control" id="unidades" name="unidades" value="Kg" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>Guardar Residuo
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
