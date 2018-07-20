<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php wp_title( '|', true, 'right' ); ?>Estrategas Digitales</title>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.12.3.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.drawsvg.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/typed.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.hoverdir.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.97074.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-smoove/0.2.6/jquery.smoove.min.js"></script>
<!--<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ScrollMagic.js"></script>-->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.visible.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/menu_topexpand.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/estilos.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/tabs.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/tabstyles.css">

<meta property="og:url"           content="<?php the_permalink(); ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php the_title(); ?> " />
<meta property="og:image"         content="<?php the_post_thumbnail_url('size-home'); ?>" />
<meta property="fb:pages" content="58771207130" />
<?php

if (is_page('servicios') || is_page('services') || is_page('pymes')) {
	echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/css/slick.css">';
	echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/css/slick-theme.css">';
	echo '<script src="'.get_template_directory_uri().'/js/slick.js" type="text/javascript" charset="utf-8"></script>';
}

?>

<?php wp_head(); ?>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '1890593427863037');
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1"
src="https://www.facebook.com/tr?id=1890593427863037&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

</head>

<body>

<div class="bloque_menu fijo">

	<a href="<?php
				if (isset($_GET["lang"]) & $_GET["lang"] == "en") {
					echo get_site_url().'/?lang=en';
					}else{
					echo get_site_url();
					}

			 ?>">
		<img src="<?php echo get_template_directory_uri(); ?>/images/logo_pleca.png" class="logo">
	</a>

	<div class="menu-wrap">
		<nav class="menu">
			<?php
		        wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'items_wrap' => '<ul class="icon-list">%3$s</ul>' ) );
	        ?>
		</nav>
	</div>




	<button class="menu-button" id="open-button">
		<div class="linea uno"></div>
		<div class="linea dos"></div>
		<div class="linea tres"></div>
	</button>

</div><!-- /bloque_menu -->
