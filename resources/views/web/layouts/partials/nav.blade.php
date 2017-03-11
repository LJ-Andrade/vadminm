<div class="navbar navbar-default navbar-fixed-top text-center" role="navigation">        
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>  
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('webimages/logos/logo.png') }}"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/') }}"><i class="ion-ios-home-outline"></i> Inicio</a></li>
                <li><a href="{{ route('web.portfolio') }}"><i class="ion-ios-briefcase-outline"></i> Portfolio</a></li>
                <li><a href="{{ url('/#contact') }}"><i class="ion-ios-email-outline"></i> Contacto</a></li>   
            </ul>
        </div>
    </div>
</div>