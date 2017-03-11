<footer class="container-fluid">
	<div class="container footer">
	<h1 style="text-align: center; color: #fff">CONTACTANOS !</h1>
		<div class="col-md-4 contact-data fadeIn animated wow">
			<h2>Datos</h2><hr>
			<span class="icon"><i class="ion-ios-telephone-outline"></i></span><span> (011) 3529-4527 </span><br>
			<span class="icon"><i class="ion-iphone"></i></span><span> (011) 15-5160-1565</span> <br>
			<span class="icon"><i class="ion-ios-email-outline"></i></span><span> info@studiovimana.com.ar</span> <br>
			<span class="icon"><i class="ion-ios-location-outline"></i></span><span> Buenos Aires - Argentina <br>
			Atendemos a todo el país y al exterior</span>
		</div>
		<div class="col-md-4 tags">
			<h2>Portfolio</h2><hr>
			@foreach($categories as $category)
			<a href="{{ route('web.search.category', $category->name ) }}"><span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">{{ $category->name }}</span></a>
			@endforeach
			{{-- <span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">Diseño Web</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">Diseño Gráfico</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">Gestores de Contenido</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">Logos</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">Flyers</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">Plantillas</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">Posteos Facebook</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.9s">Catálogos</span>
			<span class="tag red-tag wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">Books</span> --}}
		</div>
		<div class="col-md-4 social">
			<h2>Seguinos</h2><hr>
			<div class="vertical-list">
			    <ul>
			    	{{-- <li>
			    		<span>Twitter</span>
			    	</li> --}}
					<li>
						<a href="https://twitter.com/StudioVimana" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @StudioVimana</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</li>
					{{-- <li>
			    		<span>Facebook</span>
			    	</li> --}}
					<li>
						<div class="fb-like" data-href="https://www.facebook.com/studiograficovimana" data-width="250px" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="copyright">
		Desarrollado por Studio Vimana - Todos los derechos reservados - 2017
	</div>
</footer>