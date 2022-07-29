<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Hoplbox | RSU</title>
</head>
<style>
    .portada {
        position: fixed;
        width: 100%;
        margin: 0;
        z-index: -100;
    }
    .item-color{
        color:#fff;
    }
</style>
<body>
    <img class="portada" src="{{asset('images/portada.jfif')}}" alt="">

    @include('navbar')
    @include('toast.toasts')
    
    <br>
    <br>
    <center>
        <div style="width:80%;">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="https://www.cali.gov.co/bienesyservicios/info/principal/media/pubInt/thumbs/thpub_700x400_166390.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://www.cali.gov.co/bienesyservicios/info/principal/media/pubInt/thumbs/thpub_700x400_166390.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://www.cali.gov.co/bienesyservicios/info/principal/media/pubInt/thumbs/thpub_700x400_166390.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </center>
    <br>
    <br><br><br><br><br>

    <img src="{{asset('images/footer.jpg')}}" alt="" width="100%" >

    

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