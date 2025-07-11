<!DOCTYPE html>
<html lang="es"> <!-- Cambiado a "es" para español -->
<head>
    @include('recolectores.header')
    <title>Recitrash | Home</title>
    
</head>
<body>
    @include('toast.toasts')
    @include('recolectores.navbars.navbar')

    <div class="container"> <!-- Mejor usar container de Bootstrap -->
      <br>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-trash-alt title-icon" aria-hidden="true"></i> Recolecciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    @if(count($recolecciones))
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead class="thead-light">
                          <tr>
                            <th>Día</th>
                            <th>Recolecciones</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($recolecciones as $recoleccion)
                          <tr>
                            <td>{{FechaFormateada($recoleccion->fecha)}}</td>
                            <td>{{$recoleccion->recolecciones}} Recolecciones</td>
                            <td>
                              <a href="manifiestorecoleccion/{{$recoleccion->fecha}}" target="_blank" class="btn btn-info">
                                <i class="fa fa-download"></i> Manifiesto
                              </a>
                            </td>                           
                          </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center mt-4">
                      {{ $recolecciones->appends($_GET)->links('pagination::bootstrap-4') }}
                    </div>
                    </div>
                    
                    @else
                    <div class="alert alert-info" role="alert">
                      <i class="fa fa-info-circle mr-2"></i>No hay recolecciones para mostrar.
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>

    @include('recolectores.footer')
</body>
</html>