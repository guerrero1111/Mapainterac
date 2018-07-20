<?php
/**
 * Footer
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

if ( visualcomposerstarter_is_the_footer_displayed() ) : ?>
	<?php visualcomposerstarter_hook_before_footer(); ?>
	<footer id="footer">	
		<div class="footer-bottom">
			<div class="container containerprincipal">
				<div class="col-md-3">
					<h1>Dirección</h1>
					<p>Eje 7 Sur 59, Oficina 301, </p>
					<p>Col. Insurgentes Mixcoac,</p>
					<p>Del. Benito Juárez,  C.P. 03920, </p>
					<p>CDMX</p>
				</div>
				<div class="col-md-3">
					<h1>Correo electrónico</h1>
					<p><a href="mailto:sales@overseasmexico.com.mx">sales@overseasmexico.com.mx</a></p>					
				</div>
				<div class="col-md-3">
					<h1>Teléfonos</h1>
					<p>(+52) 55 5203 9279,</p>
					<p>(+52) 55 5203 8955,</p>
					<p>(+52) 55 5203 9782,</p>
					<p>(+52) 55 525 04801,</p>
					<p>(+52) 55 5250 8039,</p>
					<p>(+52) 55 7826 0135.</p> 				
				</div>
				<div class="col-md-3">
					<h1>MAPA DE SITIO</h1>
					<p><a target="_blank" href="<?php echo get_site_url(); ?>">Home</a></p>
					<p><a target="_blank" href="<?php echo get_site_url(); ?>/quienes-somos">Quiénes somos</a></p>
					<p><a target="_blank" href="<?php echo get_site_url(); ?>/itinerarios">Itinerario</a></p>
					<p><a target="_blank" href="<?php echo get_site_url(); ?>/contacto">Contacto</a></p>
					<p><a target="_blank" href="<?php echo get_site_url(); ?>/formatos">Formatos</a></p>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class="subfooter row">				
				<div class="text-center">					
						<span>2018  Overseas México, Todos los derechos reservados | <a href="<?php echo get_site_url(); ?>/aviso-de-privacidad">Aviso de privacidad</a></span>
				</div>
			</div>
		</div>
	</footer>
	<script src="<?php echo get_template_directory_uri(); ?>/js/otros/classie.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/otros/main.js"></script>

	<?php visualcomposerstarter_hook_after_footer(); ?>
<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>




