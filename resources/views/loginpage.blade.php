<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>AMRCD | Login</title>
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
                    <h3 class="card-title">Ingresar</h3>
                </div>
                <form method="post" action="{{url('Login')}}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group">
                        <label for="mail">Correo</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            </div>                        
                            <input required type="email" class="form-control" id="mail" name="mail" placeholder="Correo">                     
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
                            </div>
                            <input required type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passconfirm">¿Olvidaste tu contraseña?</label>
                        <br>
                        <a class="btn btn-default btn-outline-secondary" href="PassReset">Recuperar</a>                    
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