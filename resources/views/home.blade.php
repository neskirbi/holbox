<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>AMRCD | Citas y Folios</title>
</head>
<style>
    body {
    background-image: url("{{asset('images/portada.jfif')}}");
    background-size: cover;
    background-repeat: no-repeat;
    margin: 0;
    }
    .item-color{
        color:#fff;
    }
</style>
<body>
    
    

    @include('navbar')
    @include('toast.toasts')

<!--<div style="height:100px; background-color:#1E1E1E; position:absolute; width:100%; bottom:0px;">
    <p><font color="#fff">Contacto</font></p>
</div>-->
</body>
        
    @include('modals.modalregistro')
    @include('modals.modalloginresidentes')
    @include('modals.modallogin')
    @include('modals.modalloginadmin')    
    @include('modals.modalsedemalogin')
    @include('modals.modallogintransportistas')
    @include('modals.modalregistrotransportistas')
    


    @include('footer')

</html>