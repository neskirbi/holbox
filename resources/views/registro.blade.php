<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>AMRCD | Registro</title>
</head>
<style>
    body {
    background-image: url("{{asset('images/portada.jfif')}}");
    background-size: cover;
    background-repeat: no-repeat;
    margin:0px;
    padding:0px;        
    background-attachment: fixed;
    background-position: center;
    }
    .item-color{
        color:#fff;
    }

    @media only screen and (max-width: 948px ) {
        .separadores{
            display:inline-block; 
            width:95%;
            margin:5px 5px 5px 5px;
            border:0px solid #ff0000;
        }
        .card-login{
            width:100%;
        }
    }

    @media only screen and (min-width: 949px ) {
        .separadores{
            display:inline-block; 
            width:23%;
            margin:5px 5px 5px 5px;
            border:0px solid #ff0000;
        }

        .card-login{ 
            width:300px;
        }
    }
    
</style>
<body>
    @include('toast.toasts')
    <div>
        <a href="{{url('home')}}"><img src="{{asset('images/logologin.jpeg')}}" alt="" style="border-radius:5px;"></a>
        
    </div>
    <div>
        <div class="separadores"></div>
        <div class="separadores"></div>
        <div class="separadores"></div>
        <div class="separadores">
            <div class="card card-default card-login">
                <div class="card-header">
                    <h3 class="card-title">Registro</h3>
                </div>
                <form method="post" action="{{url('Registro')}}">
                @csrf
                <div class="card-body">
                    

                                    
                <div class="form-group">
                    <select required name="usuario" class="form-control" id="usuario" aria-invalid="false">
                        <option value="">Seleccionar</option>
                        <optgroup>
                        <option value="1">Generador</option>
                        <option value="2">Transportista</option>
                        </optgroup>
                        
                    </select>
                </div>
           
                <div class="form-group">
                    <label for="name">Nombre(s)</label>
                    <input required type="text" class="form-control" id="nombres" name="nombres" minlength="1" maxlength="150" placeholder="Nombre(s)">
                </div>

                <div class="form-group">
                    <label for="name">Apellidos</label>
                    <input required type="text" class="form-control" id="apellidos" name="apellidos" minlength="1" maxlength="150" placeholder="Apellidos">
                </div>

                <div class="form-group">
                    <label for="mail">Correo</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>                        
                        <input required  autocomplete="false" type="email" class="form-control" id="mail" name="mail" minlength="1" maxlength="150" placeholder="Correo" value="">
                        
                    </div>
                </div>

                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input required autocomplete="false" onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass" minlength="4" maxlength="10" name="pass" placeholder="Contraseña" value="">
                </div>

                <div class="form-group">
                    <label for="passconfirm">Confirmar Contraseña</label>
                    <input required autocomplete="false" onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass2" minlength="4" maxlength="10" name="pass2" placeholder="Confirmar Contraseña" value="">
                </div>

                
                <div class="form-group">
                    <label for="passconfirm">¿Acepta Términos y Condiciones?</label>
                    <a href="terminosycondiciones" target="_blank">Términos y Condiciones</a>
                    <input required autocomplete="false" type="checkbox" class="form-control" style="width:20px;" id="accept" name="accept">
                </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    
</body>
        
    


    @include('footer')

</html>