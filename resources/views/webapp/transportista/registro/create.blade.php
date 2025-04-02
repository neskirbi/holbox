<!DOCTYPE html>
<html lang="es">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Vehículos</title>
  <style>
    .form-section {
      margin-bottom: 2rem;
      padding: 1rem;
      border-radius: 5px;
      background-color: #f8f9fa;
    }
    .form-section-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: 1rem;
      color: #3c8dbc;
      border-bottom: 2px solid #3c8dbc;
      padding-bottom: 0.5rem;
    }
    .required-field::after {
      content: " *";
      color: #dc3545;
    }
    .password-strength {
      height: 5px;
      margin-top: 5px;
      background-color: #e9ecef;
      border-radius: 3px;
      overflow: hidden;
    }
    .password-strength-bar {
      height: 100%;
      width: 0%;
      transition: width 0.3s ease;
    }
    .file-input-preview {
      max-width: 200px;
      max-height: 150px;
      margin-top: 10px;
      display: none;
    }
    .form-group label {
      font-weight: 500;
    }
    .btn-validate {
      min-width: 100px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')  
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-truck mr-2"></i>Registro de Transportista</h3>
          </div>
          <form action="{{url('registrot')}}" method="POST"  enctype="multipart/form-data" >
            @csrf 
            <div class="card-body">
              
              <!-- Sección 1: Datos de la Empresa -->
              <div class="form-section">
                <div class="form-section-title">
                  <i class="fas fa-building mr-2"></i>Datos de la Empresa
                </div>
                
                <div class="form-group">
                  <label for="razonsocial" class="required-field">Razón social</label>
                  <input type="text" name="razonsocial" class="form-control" id="razonsocial" 
                         placeholder="Ingrese la razón social" maxlength="250" required>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ramir" class="required-field">RAMIR</label>
                      <input type="text" name="ramir" class="form-control" id="ramir" 
                             placeholder="Ingrese el RAMIR" maxlength="100" required>
                    </div>                      
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="giro" class="required-field">Giro</label>
                      <input type="text" name="giro" class="form-control" id="giro" 
                             placeholder="Ingrese el giro" maxlength="250" required>
                    </div>
                  </div>
                
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="regsct" class="required-field">Registro SCT</label>
                      <input type="text" name="regsct" class="form-control" id="regsct" 
                             placeholder="Ingrese registro SCT" maxlength="100" required>
                    </div>
                  </div>
                </div>  
              </div>
              
              <!-- Sección 2: Dirección -->
              <div class="form-section">
                <div class="form-section-title">
                  <i class="fas fa-map-marker-alt mr-2"></i>Dirección
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="calle" class="required-field">Calle</label>
                      <input type="text" name="calle" class="form-control" id="calle" 
                             placeholder="Ingrese la calle" maxlength="500" required>
                    </div>
                  </div>
                
                  <div class="col-md-3">                                    
                    <div class="form-group">
                      <label for="numeroext" class="required-field">Número exterior</label>
                      <input type="text" name="numeroext" class="form-control" id="numeroext" 
                             placeholder="Núm. ext." maxlength="20" required>
                    </div>
                  </div>
                      
                  <div class="col-md-3"> 
                    <div class="form-group">
                      <label for="numeroint">Número interior</label>
                      <input type="text" name="numeroint" class="form-control" id="numeroint" 
                             placeholder="Núm. int." maxlength="20">
                    </div>
                  </div>
                </div>                        
                
                <div class="form-group">
                  <label for="colonia" class="required-field">Colonia</label>
                  <input type="text" name="colonia" class="form-control" id="colonia" 
                         placeholder="Ingrese la colonia" maxlength="50" required>
                </div>

                <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="entidad"><i class="fas fa-flag"></i> Entidad Federativa</label>
                        <select name="entidad" class="form-control" id="entidad" onchange="MunicipiosApi(this,2);" required>
                          <option value="">--Entidad Federativa--</option>
                          @foreach($entidades as $entidad)
                            <option value="{{$entidad->id}}">{{$entidad->entidad}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="municipio"><i class="fas fa-city"></i> Alcaldía/Municipio</label>
                        <select  name="municipio" class="form-control" id="municipio" aria-invalid="false" data-mun="municipio" >
                        </select>
                      </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="cp" class="required-field">Código Postal</label>
                      <input type="text" name="cp" class="form-control" id="cp" 
                             placeholder="C.P." maxlength="5" pattern="[0-9]{5}" required>
                      <small class="form-text text-muted">5 dígitos</small>
                    </div>
                  </div>
                  
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="telefono" class="required-field">Teléfono</label>
                      <input type="tel" name="telefono_empresa" class="form-control" id="telefono_empresa" 
                             placeholder="Teléfono de la empresa" maxlength="15" required>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mail" class="required-field">Correo electrónico</label>
                      <input type="email" name="mail" class="form-control" id="mail" 
                             placeholder="correo@empresa.com" maxlength="50" required>
                    </div>    
                  </div>
                </div>
              </div>
              
              <!-- Sección 3: Datos del Chofer -->
              <div class="form-section">
                <div class="form-section-title">
                  <i class="fas fa-user mr-2"></i>Datos del Chofer
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nombres" class="required-field">Nombre(s)</label>
                      <input type="text" name="nombres" class="form-control" id="nombres" 
                             placeholder="Nombre(s) del chofer" maxlength="150" required>
                    </div>                     
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="apellidos" class="required-field">Apellidos</label>
                      <input type="text" name="apellidos" class="form-control" id="apellidos" 
                             placeholder="Apellidos del chofer" maxlength="150" required>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="licencia" class="required-field">Tipo de licencia</label>
                      <select class="form-control" id="licencia" name="licencia" required>
                        <option value="">-- Seleccione tipo de licencia --</option>
                        <option value="A">A - Motocicletas</option>
                        <option value="B">B - Automóviles</option>
                        <option value="C">C - Camiones ligeros</option>
                        <option value="D">D - Camiones pesados</option>
                        <option value="E">E - Remolques</option>
                        <option value="F">F - Transporte de pasajeros</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <!-- Documentos -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inefrente" class="required-field">INE (Frente)</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inefrente" name="inefrente" accept="image/*,.pdf" required>
                        <label class="custom-file-label" for="inefrente">Seleccionar archivo</label>
                      </div>
                      <small class="form-text text-muted">Formatos aceptados: JPG, PNG, PDF</small>
                      <img id="inefrente-preview" class="file-input-preview" src="#" alt="Vista previa INE frente">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inereverso" class="required-field">INE (Reverso)</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inereverso" name="inereverso" accept="image/*,.pdf" required>
                        <label class="custom-file-label" for="inereverso">Seleccionar archivo</label>
                      </div>
                      <small class="form-text text-muted">Formatos aceptados: JPG, PNG, PDF</small>
                      <img id="inereverso-preview" class="file-input-preview" src="#" alt="Vista previa INE reverso">
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Sección 4: Verificación y Seguridad -->
              <div class="form-section">
                <div class="form-section-title">
                  <i class="fas fa-shield-alt mr-2"></i>Verificación y Seguridad
                </div>
                
                <div class="form-group">
                  <label for="telefono_chofer" class="required-field">Teléfono del chofer (Se enviará un código de verificación)</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+52</span>
                    </div>
                    <input type="tel" name="telefono" class="form-control" id="telefono" 
                           placeholder="Ingrese teléfono móvil" maxlength="10" pattern="[0-9]{10}" required>
                    <div class="input-group-append">
                      
                    </div>
                  </div>
                  <small class="form-text text-muted">10 dígitos sin espacios ni guiones</small>
                </div>
                <div class="form-group">
                  
                <button type="button" class="btn btn-info btn-validate" onclick="EnviarCodigo(this);">
                        <i class="fas fa-paper-plane mr-1"></i> Enviar código
                      </button>
                </div>
                
                <div class="form-group">
                  <label for="codigo" class="required-field">Código de verificación</label>
                  <div class="input-group">
                    <input type="text" name="codigo" class="form-control" id="codigo" 
                           placeholder="Ingrese el código recibido" maxlength="10"  required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="fas fa-key"></i>
                      </span>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="pass" class="required-field">Contraseña</label>
                  <div class="input-group">
                    <input type="password" name="pass" class="form-control" id="pass" 
                           placeholder="Cree una contraseña segura" minlength="8" required>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="fas fa-eye"></i>
                      </button>
                    </div>
                  </div>
                  <div class="password-strength">
                    <div class="password-strength-bar" id="password-strength-bar"></div>
                  </div>
                  <small class="form-text text-muted">Mínimo 8 caracteres, incluyendo mayúsculas, minúsculas y números</small>
                </div>
                
                <div class="form-group">
                  <label for="pass2" class="required-field">Confirmar contraseña</label>
                  <input type="password" name="pass2" class="form-control" id="pass2" 
                         placeholder="Repita la contraseña" required>
                  <div id="password-match-feedback" class="invalid-feedback">
                    Las contraseñas no coinciden
                  </div>
                </div>
                
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="accept" name="accept" required>
                  <label class="form-check-label" for="accept">
                    Acepto los <a href="TCRecitrackTrasporte" target="_blank" class="text-primary">Términos y Condiciones</a>
                  </label>
                </div>
              </div>
            </div>
            
            <div class="card-footer text-right">
              <button type="reset" class="btn btn-secondary mr-2">
                <i class="fas fa-undo mr-1"></i> Limpiar
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Guardar Registro
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
  <script>
    $(document).ready(function() {
      // Inicializar el plugin para los inputs de archivo
      bsCustomFileInput.init();
      
      // Mostrar vista previa de imágenes seleccionadas
      function readURL(input, previewId) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $(previewId).attr('src', e.target.result).show();
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      $("#inefrente").change(function() {
        readURL(this, '#inefrente-preview');
      });
      
      $("#inereverso").change(function() {
        readURL(this, '#inereverso-preview');
      });
      
      // Toggle para mostrar/ocultar contraseña
      $(".toggle-password").click(function() {
        var input = $(this).closest('.input-group').find('input');
        var icon = $(this).find('i');
        
        if (input.attr("type") === "password") {
          input.attr("type", "text");
          icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
          input.attr("type", "password");
          icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
      });
      
      // Validación de fortaleza de contraseña
      $("#pass").on("input", function() {
        var password = $(this).val();
        var strength = 0;
        
        // Longitud mínima
        if (password.length >= 8) strength += 1;
        
        // Contiene mayúsculas
        if (password.match(/[A-Z]/)) strength += 1;
        
        // Contiene minúsculas
        if (password.match(/[a-z]/)) strength += 1;
        
        // Contiene números
        if (password.match(/[0-9]/)) strength += 1;
        
        // Contiene caracteres especiales
        if (password.match(/[^A-Za-z0-9]/)) strength += 1;
        
        // Actualizar barra de fortaleza
        var strengthPercent = (strength / 5) * 100;
        var bar = $("#password-strength-bar");
        
        bar.css("width", strengthPercent + "%");
        
        // Cambiar color según fortaleza
        if (strength <= 2) {
          bar.css("background-color", "#dc3545"); // Rojo
        } else if (strength <= 4) {
          bar.css("background-color", "#ffc107"); // Amarillo
        } else {
          bar.css("background-color", "#28a745"); // Verde
        }
      });
      
      // Validar coincidencia de contraseñas
      $("#pass2").on("input", function() {
        var pass1 = $("#pass").val();
        var pass2 = $(this).val();
        
        if (pass1 !== pass2 && pass2.length > 0) {
          $(this).addClass("is-invalid");
          $("#password-match-feedback").show();
        } else {
          $(this).removeClass("is-invalid");
          $("#password-match-feedback").hide();
        }
      });
      
      // Validar formulario antes de enviar
      $("#RegistroChofer").submit(function(e) {
        // Verificar coincidencia de contraseñas
        if ($("#pass").val() !== $("#pass2").val()) {
          e.preventDefault();
          $("#pass2").addClass("is-invalid");
          $("#password-match-feedback").show();
          $('html, body').animate({
            scrollTop: $("#pass2").offset().top - 100
          }, 500);
        }
        
        // Aquí puedes agregar más validaciones si es necesario
      });
    });
    
    var conteo = 0;
    var _this;
    var tiempo;
    
    function BloquearT(_este) {
      _this = _este;
      $(_this).prop("disabled", true);
      conteo = 0;
      tiempo = setInterval(Ti, 1000);
    }
    
    function Ti() {
      if (conteo < 61) {
        $(_this).html('<i class="fas fa-clock mr-1"></i> Esperar (' + (60 - conteo) + ')');
        conteo++;
      } else {
        $(_this).prop("disabled", false);
        $(_this).html('<i class="fas fa-paper-plane mr-1"></i> Enviar');
        clearInterval(tiempo);
      }
    }
    
    
  </script>
</body>
</html>