<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php visualcomposerstarter_hook_after_head(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,500,600,700,800" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-lxgRcdbXIZhWAJgoHigRpB_8Jezv0lg"></script>
<link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700" rel="stylesheet">

  <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script
  src="<?php echo get_site_url(); ?>/wp-content/themes/visual-composer-starter-child/js/scripts.js"></script>
  <!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4i92WzdZqXqDiFlVwWL6drc3gLzDdtPH";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->
  <?php wp_head() ?>
</head>
<body>

  
  <!-- <div id="btnchat">
    <img src="<?php echo get_site_url(); ?>/wp-content/themes/visual-composer-starter-child/img/btnchat.png">
  </div> -->
  <div id="btndivisas">
    <img src="<?php echo get_site_url(); ?>/wp-content/themes/visual-composer-starter-child/img/btndivisa.png">
  </div>
  <div id="divisas">
      
          <div class="cabecera text-center">
            <?php if(ICL_LANGUAGE_CODE=='en'){ ?>
<span>Exchange  rate</span>
<?php }else{ ?>
<span>Tipos de cambio</span>
<?php } ?>
            
          </div>

           
          <?php
          $repeatable_field_values = simple_fields_values("nd1,vd1,nd2,vd2",5656);
                foreach ($repeatable_field_values as $values) {
                  ?>
                  <div class="conte1 col-md-12 text-center">
                  <?php
                  echo "<div class='col-md-6 col-sm-6 col-xs-6 text-center borde'><p>".$values["vd1"]."</p><p class='pequen'>".$values["nd1"]."</p></div>";
                  echo "<div class='col-md-6 col-sm-6 col-xs-6 text-center borde'><p>".$values["vd2"]."</p><p class='pequen'>".$values["nd2"]."</p></div>";
                  ?>
                  </div>
                  <?php
                }

          ?>
         

  </div>
  <div class="sombra">
  </div>


