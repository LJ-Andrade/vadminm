@extends('web.layouts.mainlight')
@section('title', 'StudioVimana | Inicio')

@section('styles')
<style>


    @media (min-width: 765px) {
        .home-intro {
            background-color: #3d4450;
            background-image: url("../public/webimages/home/back1.jpg");
            background-attachment: fixed;
            background-size: cover;
            background-position: 50% 100%;
            overflow: hidden;
            padding-top: 80px;
            position: relative;
            }

    
        .home-intro .main-logo {
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -ms-grid-row-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            margin-bottom: 100px;
            z-index: 5;
            margin-top: 60px;
        }
        .home-intro .main-logo h2 {
            display: none;
        }
    }

   /* Mobile Home */
    @media (max-width: 765px) {
        .home-intro {
            text-align: center;
            background: url('../public/webimages/home/back-mobile.jpg') no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 120px 0 90px;
            margin: 0 auto;
            margin-bottom: 50px;
        }
        .home-intro img {
                max-width: 100%;
                margin-bottom: 50px;
            }
        .home-intro h1 {
                color: #fff;
                font-size: 1.5rem;
                font-family: 'Roboto', sans-serif
            }
        .home-intro .simple-slider {
                display: none;
            }
            
        .home-intro .main-logo h2 {
                font-family: 'Roboto', sans-serif;
                font-weight: 300;
                display: block;
            }

    }
    @media (max-width: 300px) {
        .home-intro {
            padding-top: 100px;
        }
    }

    .home-section-2 {
	padding: 60px 5px 20px;
	text-align: center;
	color: #505050;
	}
	.home-section-2 span.text-logo-small {
		font-size: 2rem;
		font-weight: 300;
		padding-bottom: 15px;
	}
	.home-section-2 span.text-logo-bold {
		font-size: 3rem;
		font-weight: 700;
	}
	.home-section-2 h3 {
		color: #a7b3dd
	}
	.home-section-2 p {
		font-size: 1.2rem;
		color: #595959;
		font-weight: 300;
	}
	.home-section-2 .icons {
		margin-top: 30px
	}

    @media (max-width: 765px) {
        .home-section-2 .power-icons img {
            width: 75px
        }
    }

    @media (max-width: 405px) {
        .home-section-2 .power-icons img {
            width: 45px 
        }
    }


</style>
@endsection

@section('content')
    {{-- Facebook Plugin --}}
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8&appId=240698342801213";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script> 
    {{-- /Facebook Plugin --}}

    <div id="actual_section" data-section="home"></div>
    {{-- Home Section Desktop --}}
    <div class="home-intro">      
        <div class="main-logo wow animated zoomIn" data-wow-delay="0s" data-wow-duration="3s">
            <img src="{{ asset('webimages/logos/main-logo.png') }}">
            <h2>Soluciones Visuales e Interactivas</h2>
        </div>
        <div id="Simple-Slider" class="simple-slider">
            <ul>
                <li>
                    <span class="icon"><i class="ion-coffee"></i></span>
                    <span class="text">Estás buscando <b>especialístas en Diseño?</b></span>
                    <a href="{{ url("/#contact") }}" class="btn btnHollow">Contactanos !</a>
                </li>
                <li>
                    <span class="icon"><i class="ion-ios-briefcase-outline"></i></span>
                    <span class="text">Querés ver como <b>trabajamos?</b></span>
                    <a href="{{ route("web.portfolio") }}" class="btn btnRed">Mirá nuestro Portfolio !</a>
                </li>
                <li>
                    <span class="icon"><i class="ion-ios-flask-outline"></i></span> 
                    <span class="text">Desarrollamos <b>sistemas a medida</b></span> 
                    <a href="{{ url("/#contact") }}" class="btn btnHollow">Presentanos tu proyecto !</a>
                </li>
            </ul>  
        </div>
    </div>
    {{-- First Info --}}
    <div class="container-fluid section-container home-section-2">
        <div class="container">
            <article class="row">
                <span class="text-logo-small" data-wow-duration="1s" data-wow-delay="0.2s">Studio</span>
                <span class="text-logo-bold" data-wow-duration="1s" data-wow-delay="0.2s">Vimana</span>
                <h3>Somos un equipo de trabajo dedicado a crear soluciones visuales.</h3>
                <p class="" data-wow-duration="1s" data-wow-delay="0.2s">
                    Nos especializamos en el área del diseño web, la programación,
                    el diseño gráfico y la ilustración. <br>
                    Generamos contenido propio y personalizado para que cada
                    cliente obtenga un producto único y original. <br>
                </p>
                   <p><b>Atendemos Empresas, Pymes, Proyectos y Particulares.</b></p> 
                <div class="icons horizontal-list power-icons">
                    <ul>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                        <img src=" {{asset('webimages/gral/home/icons/icon1.png')}} "></li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                        <img src=" {{asset('webimages/gral/home/icons/icon2.png')}} "></li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                        <img src=" {{asset('webimages/gral/home/icons/icon3.png')}} "></li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
                        <img src=" {{asset('webimages/gral/home/icons/icon4.png')}} "></li>
                        <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <img src=" {{asset('webimages/gral/home/icons/icon5.png')}} "></li>
                    </ul>
                </div><br><br>
       {{--         <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                    <img src="{{ asset('webimages/gral/loaders/loader.svg') }} ">
                </div><br>--}}
            </article>
        <hr class="grey-hr">
        </div>
    </div>
    {{-- Our Services --}}
    <div id="services" class="container-fluid section-container our-services">
        <div class="container">
            <h1 class="wow animated fadeInUp">Nuestros Servicios</h1>
            <div class="row row-flex row-flex-wrap service-item">
                <div class="col-md-6 col-sm-12 col-xs-12 inner wow animated fadeIn" data-wow-delay="0.3s">
                    <img src="{{ asset('webimages/gral/home/img2.png') }}">
                </div>
                <article class="col-md-6 col-sm-12 col-xs-12 inner wow animated fadeInRight">
                    <div class="text-big">
                        <h1>Desarrollo Web</h1> 
                    </div>
                    <span class="title"><i class="ion-ios-flask"></i> SOLUCIONES INTERACTIVAS </span>
                    <p>
                        Desarrollamos sitios personalizados. Creados desde cero y con las últimas tecnologías web.
                        Entregamos un código limpio y optimizado para luego incluírlo en buscadores cumpliendo con sus exigencias. <br><br>
                        
                        - <b>Adaptables</b> | Celulares | Tablets | Notebooks | Pc <br>
                        - <b>Sitios Institucionales</b> | Económicos | Rápido Desarrollo <br>
                        - <b>Diseño gráfico</b> | Creamos las piezas necesarias para el sitio<br>
                        - <b>Relacionado con Redes Sociales</b> | Aumenta el posicionamiento<br>
                        - <b>Exposición</b> | GoogleAdwords | Facebook | Buscadores | *Opcional<br>
                    </p>
                    <div class="action">
                        <a href="{{ route('web.portfolio') }}">
                            <span class="btnBig btnHollowPortfolio">Ver portfolio <i class="ion-android-arrow-dropright"></i> </span> 
                        </a>
                    </div>
                </article>
            </div>
        </div>
        <div class="container-fluid center-item">
            <div class="container wow animated fadeIn">
                <div class="row row-flex row-flex-wrap service-item">
                    <article class="col-md-6 inner white-back wow animated fadeInLeft">
                        <div class="text-big">
                            <h1 class="right">Diseño Gráfico</h1> 
                        </div>
                        <span class="title">SOLUCIONES VISUALES CREATIVAS <i class="ion-ios-rose-outline"></i></span>
                        <p>
                            Desarrollamos piezas personalizadas.  <br>
                            Estudiamos el perfil de cliente para  <br>
                            entregar un producto acorde a la imágen buscada <br><br>

                            - <b>Identidad Corporativa</b> | Marca | Logos <br>
                            - <b>Papelería industrial</b> | Tarjetas | Flyiers <br>
                            - <b>Publicidad</b> | Redes sociales | Plantillas | Posts <br>
                            - <b>Editorial</b> | Libros | Catálogos | Manuales | Folletos <br>
                            - <b>Packagin</b> | Etiquetas | Bolsas | Cajas <br>
                        </p>
                        <div class="action wow animated fadeIn" data-wow-delay="0.3s">
							<a href="{{ route('web.portfolio') }}">
								<span class="btnBig btnHollowPortfolio">Ver portfolio <i class="ion-android-arrow-dropright"></i> </span> 
							</a>
						</div>
                    </article>
                    <div class="col-md-6 inner">
                        <img src="{{ asset('webimages/gral/home/img1.png') }}">        
                        {{-- <object class="animated wow" type="image/svg+xml" data="{{ asset('webimages/gral/home/art.svg') }}"></object> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container wow animated fadeIn">
            <div class="row row-flex row-flex-wrap service-item">
                <div class="col-md-4 col-sm-12 col-xs-12 inner wow animated fadeIn" data-wow-delay="0.3s">
                    <img src="{{ asset('webimages/gral/home/img3.png') }}">
                </div>
                <article class="col-md-8 col-sm-12 col-xs-12 inner wow animated fadeInRight">
                    <div class="left-divider-small"></div>
                      <div class="text-big">
                        <h1>Progamación y Desarrollo de Apps</h1> 
                    </div>
                    <span class="title">SISTEMAS A MEDIDA</span>
                    <p>
                        Creamos sistemas hechos a medida según las necesidades presentadas.<br>
                        Desarrollamos sistemas de gesión interna, gestores de contenido, blogs, etc.<br><br>
                        
                        - <b>Gestores de Contenido</b> | Generá el contenido de tu web vos mismo<br>
                        - <b>Sitios de Gestión empresarial</b> | Organizá tu empresa desde cualquier lugar<br>
                        
                        Características: <br>
                        - <b>Siempre Online</b> | Alojados en la web pueden ser accesibles desde cualquier lugar o dispositivo <br>
                        - <b>Modulares y escalables</b> | Luego de desarrollados se pueden agregar secciones o funcionalidades extra<br>
                    </p>
                     <div class="action">
						<a href="{{ route('web.portfolio') }}">
							<span class="btnBig btnHollowPortfolio">Ver portfolio <i class="ion-android-arrow-dropright"></i> </span> 
						</a>
					</div>
                </article>
            </div>
        </div>
    </div>
    {{-- Our Works | Portfolio --}}
    <div class="container-fluid our-works">
        <div class="container wow animated zoomIn">
            <div class="row">
                <div class="row row-flex row-flex-wrap">              
                    <div class="col-md-6 inner">
                        <span><i class="ion-ios-briefcase-outline"></i></span>
                        <h1>NUESTRO PORTFOLIO</h1>
                        <p>
                            Una imágen vale más que un slogan. <br>
                            Visitá nuestro portfolio y mirá como trabajamos.
                        </p>
                         <a href="{{ route('web.portfolio') }}" class="btn btnHollow">Llevame !</a>
                    </div>
                    <div class="col-md-6 inner">
                        <div id="services_img_3">
                            <img src="{{ asset('webimages/gral/home/img4.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('web.layouts.partials.contact')
    @include('web.layouts.partials.foot')


@endsection

@section('scripts')


@endsection

@section('custom_js')
<script>    

    // SIMPLE SLIDER
    $(document).ready(function ($) {

        setInterval(function () {
            moveRight();
        }, 5000);

        var slideCount = $('#Simple-Slider ul li').length;
        var slideWidth = $('#Simple-Slider ul li').width();
        var slideHeight = $('#Simple-Slider ul li').height();
        var sliderUlWidth = slideCount * slideWidth;
        
        $('#Simple-Slider').css({ width: slideWidth, height: slideHeight });
        $('#Simple-Slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
        $('#Simple-Slider ul li:last-child').prependTo('#Simple-Slider ul');

        function moveLeft() {
            $('#Simple-Slider ul').animate({
                left: + slideWidth
            }, 200, function () {
                $('#Simple-Slider ul li:last-child').prependTo('#Simple-Slider ul');
                $('#Simple-Slider ul').css('left', '');
            });
        };

        function moveRight() {
            $('#Simple-Slider ul').animate({
                left: - slideWidth
            }, 200, function () {
                $('#Simple-Slider ul li:first-child').appendTo('#Simple-Slider ul');
                $('#Simple-Slider ul').css('left', '');
            });
        };
    });    


</script>
@endsection