<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Hoplbox | RSU</title>
</head>
<style>
    body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background:#78AF6C;
    }
    .full-width-container {
        margin-top:50px;
        width: 100%;
        padding: 0px; /* Padding de 20px */
        box-sizing: border-box; /* Incluye el padding en el ancho total */
        background-color: #ECEADB; /* Color de fondo opcional */
        text-align: center; /* Centra la imagen horizontalmente */
        border-radius:30px 30px 0px 0px;
    }
    .full-width-container img {
        width: 100%; /* La imagen no excede el ancho del contenedor */
        height: auto; /* Mantiene la proporción de la imagen */
        display: inline-block; /* Permite centrar la imagen con text-align */
    }
</style>
<body>
    

   
    @include('toast.toasts')

     <!-- Div que abarca el 100% del ancho -->
     <div class="full-width-container">
        

        <div class="bg-light" style=" height:60px; margin-right:10px; margin-left:10px; ">
            
            <a class="navbar-brand float-left" href="#" >
                <img src="{{asset('images/logoreci.png')}}" class="d-inline-block float-left" alt="">
            </a>
            <div class=" float-right">
                <nav class="navbar navbar-expand-md navbar-light navbar-loght">
                    <!--<a class="navbar-brand" href="home">Concretos</a>-->
                

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto extra-nav">

                    
                        
                        
                            <!--<li class="nav-item">
                                <a class="nav-link"  data-toggle="modal" data-target="#modalsedemalogin" href="#">Autoridad </a>
                            </li>


                            <li class="nav-item ">
                                <a class="nav-link"  data-toggle="modal" data-target="#loginadmin" href="#">Administrador </a>
                            </li>

                            <li class="nav-item dropdown" style="">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="position:absolute;">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#login" href="#">Acceso</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#registro" href="#">Registrar</a>
                                    
                                </div>
                            
                            </li>


                            <li class="nav-item dropdown" style="">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transportistas</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="position:absolute;">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#logintransport" href="#">Acceso</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#registrotransportistas" href="#">Registro</a>

                                </div>

                            </li>-->

                    
                            <li class="nav-item">
                                <a class="nav-link"  href="{{url('registropage')}}">Registrarse </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"  href="{{url('loginpage')}}"> <i class="fa fa-user-o" aria-hidden="true"></i> Ingresar </a>
                            </li>


                        </ul>
                        
                    </div>
                </nav>
            </div>
        </div>


        <!-- Imagen centrada -->
        <img src="{{asset('images/wallreci.png')}}" alt="">
    </div>

     
</body>
        
  
    


    @include('footer')

</html>