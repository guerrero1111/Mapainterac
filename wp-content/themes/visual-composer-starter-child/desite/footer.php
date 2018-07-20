<footer class="container-fluid">
	
	<div class="info row">

		<div class="container">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<p>Cañada 2, Lomas de Tarango, Álvaro Obregón, CDMX, México.</p>
				<p><a href="tel://+525550129637" class="telefono">+52 (55) 5012 9637</a></p>
				<p><a href="mailto:contacto@estrategasdigitales.com">contacto@estrategasdigitales.com</a></p>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 redes text-right">
				<a href="https://www.facebook.com/EstrategasDig" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="https://twitter.com/estrategasdig" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</div>

		</div>

	</div>

	<div class="copy row">
		<div class="container">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<span>
				<?php
				if (isset($_GET["lang"]) & $_GET["lang"] == "en") {
					echo '© All rights reserved Estrategas Digitales 2018';
				}else{
					echo '© Derechos reservados Estrategas Digitales 2018';
				}
				?>
				</span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
				<span>
					<?php
					if (isset($_GET["lang"]) & $_GET["lang"] == "en") {
						echo '<a href="'.get_site_url().'/notice-of-privacy/?lang=en">Notice of privacy</a>';
					}else{
						echo '<a href="'.get_site_url().'/aviso-de-privacidad">Aviso de privacidad</a>';
					}
					?>
					
				</span>
			</div>
		</div>
	</div>

</footer>

<script src="<?php echo get_template_directory_uri(); ?>/js/classie.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

<script type="text/javascript">
    $(document).on('ready', function() {
      $(".serv").slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false,
      });
    });
  </script>
<?php wp_footer(); ?>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'YzWgHZhS0r';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>

</html>