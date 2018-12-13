

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBhshoCt2Gsxyyg3sFeLBFhlpsIA4Dm1AU&v=3&amp;sensor=false"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/markerwithlabel.js"></script>


<?php 
	$elementos = get_field('origen_destino', '210');
	
	$pais = array();

	$i=0;
	foreach ($elementos as $key => $value) {
		$pais[] = $elementos[$i]['pais'];
		
		$marcador[] = array($elementos[$i]['tipo_de_ubicacion'], $elementos[$i]['nombre'], $elementos[$i]['direccion'], $elementos[$i]['latitud'], $elementos[$i]['longitud'], $elementos[$i]['pais'], $elementos[$i]['producto'], $elementos[$i]['tipo_de_solucion'], $elementos[$i]['rotatorio'], $elementos[$i]['estacionario'], $elementos[$i]['fluido-potencia'], $elementos[$i]['lubricantes'], $elementos[$i]['revestimientos']);
		$i++;
	}
 
	 
	
	// elimina paises repetidos dentro del array y los ordena en orden alfabético
	$pais = array_unique($pais);
	$pais = array_values($pais);
	sort($pais);


	// echo '<pre>';
	// print_r($elementos);
	// echo '</pre>';
?> 

<script type="text/javascript">
 
$('body').attr('onload', 'initMap()');

// Estilos del mapa
var styleArray = [{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#FFAD00"},{"saturation":50.2},{"lightness":-34.8},{"gamma":1}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"color":"#cbb42e"},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#FFC300"},{"saturation":54.2},{"lightness":-14.4},{"gamma":1}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#FFAD00"},{"saturation":-19.8},{"lightness":-1.8},{"gamma":1}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"hue":"#FFAD00"},{"saturation":72.4},{"lightness":-32.6},{"gamma":1}]},{"featureType":"road.local","elementType":"all","stylers":[{"hue":"#FFAD00"},{"saturation":74.4},{"lightness":-18},{"gamma":1}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#00FFA6"},{"saturation":-63.2},{"lightness":38},{"gamma":1}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffe59c"}]}];

// Funcion que renderea el mapa
function initialize(marcador) {
  var marcador = marcador;
      
      var corporativo = '<?php echo get_template_directory_uri(); ?>/images/icono-maps-corporativo.png';
      var operacion = '<?php echo get_template_directory_uri(); ?>/images/icono-maps-operacion.png';
      var distribuidor = '<?php echo get_template_directory_uri(); ?>/images/icono-maps-distribuidor.png';
      var ventas = '<?php echo get_template_directory_uri(); ?>/images/icono-maps-ventas.png';

      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 3,
        center: new google.maps.LatLng(0.2179842, -74.808206,3),
        styles: styleArray,
        scrollwheel: false,
        // draggable: false,
        // raiseOnDrag: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcador.length; i++) {  
        // alert(marcador[i][3]);
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcador[i][3], marcador[i][4]),
          icon: eval(marcador[i][0]['value']),
          map: map
        });
      
     
      //marker.setIcon('<?php echo get_template_directory_uri(); ?>/images/icono-maps.png');

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent('<b>'+marcador[i][1]+'</b>'+'<br>'+marcador[i][2]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    

 </script>
<div class="container">
	<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="margin-bottom:20px;">  
		    <!-- <iframe style="width:100%; height:300px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.1358675895067!2d-99.21620198467046!3d19.36326878692377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d20040de85dbdf%3A0x3d3dbb4c63e048ae!2sEstrategas+Digitales!5e0!3m2!1ses-419!2smx!4v1468351319896" height="450" frameborder="0" style="border:0; color=red" allowfullscreen></iframe> -->
		    <div id="mapa" style="width:100%; height:750px"></div>
		    <div id="log"></div>  
		    <!-- <div><a class="btn btn-default ver-maps" style="position:absolute; top:10px; right: 8px; font-size: 11px; border-radius: 3px;"  href="https://www.google.com.mx/maps/place/Av.+Insurgentes+Sur+1673,+Guadalupe+Inn,+01020+Ciudad+de+M%C3%A9xico,+CDMX/@19.3615034,-99.1854732,17z/data=!3m1!4b1!4m5!3m4!1s0x85d1ff8cbe57946b:0x8502c65fe5b3bb23!8m2!3d19.3614984!4d-99.1832792?hl=es-419" target="_blank">Ver en Google Maps</a></div> -->

		    <div class="wpb_column vc_column_container vc_col-sm-12">		    	
	    		<div class="wpb_wrapper">
	    			<section class="vc_cta3-container">
						<div class="vc_general vc_cta3 contactanos vc_cta3-style-flat vc_cta3-shape-square vc_cta3-align-center vc_cta3-color-sky vc_cta3-icon-size-md vc_cta3-actions-left">
							<div class="vc_cta3_content-container">
								<div class="vc_cta3-actions">
									<div class="vc_btn3-container vc_btn3-center">
										<a class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-square vc_btn3-style-outline vc_btn3-block vc_btn3-icon-left vc_btn3-color-white" href="<?php echo get_site_url(); ?>/contactanos/" title=""><i class="vc_btn3-icon fa fa-phone"></i> CONTÁCTANOS</a>
									</div>
								</div>
								<div class="vc_cta3-content">
									<header class="vc_cta3-content-header">
									</header>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>

		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<h4>Localizador de distribuidores</h4>
			<form id="paises-map" >
				<select name="pais" class="form-control">
					<option>País</option>
					<?php
					$a=0;
					foreach ($pais as $key => $value) {
						echo '<option value="'.$pais[$a].'" >'.$pais[$a].'</option>';
						$a++;
					}
					?>
				</select>
				<br>
				<!-- <select name="ubicacion" class="form-control">
					<option>Tipo de Ubicación</option>
					<?php
					$a=0;
					foreach ($ubicacion as $key => $value) {
						echo '<option>'.$ubicacion[$a].'</option>';
						$a++;
					}
					?>
				</select>
				<hr> -->
				<select name="solucion" class="form-control" disabled>
					<option>Tipo de Solucion</option>
					
				</select>
				<br>

				<select name="producto" class="form-control" disabled>
					<option>Tipo de Producto</option>
					
				</select>
				<br>
				<input type="submit" value="BUSCAR" class="form-control" style="margin:5px 0; border-radius:0" disabled>
				
				<hr>
			</form>

			<div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-12 vc_col-md-12 vc_col-xs-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<h4 style="text-align: left" class="vc_custom_heading">Corporativo</h4>
							<div class="wpb_text_column wpb_content_element ">
								<div class="wpb_wrapper">
									<p><strong>A.W. Chesterton Company</strong></p>
									<p>860 Salem Street,<br>
										Groveland, MA 01834 USA.</p>

								</div>
							</div>
							<h4 style="text-align: left" class="vc_custom_heading">Operaciones Directas en Latinoamérica</h4>
							<div class="wpb_text_column wpb_content_element ">
								<div class="wpb_wrapper">
									<p><strong>Chesterton Mexicana</strong><br>
										Av. Olmecas No. 1<br>
										Col. Parque Industrial Naucalpan,<br>
										Naucalpan de Juárez,<br>
										Estado de México,<br>
										C.P. 53489.</p>

								</div>
							</div>

							<div class="wpb_text_column wpb_content_element ">
								<div class="wpb_wrapper">
									<p><strong>E mail</strong><br>
										<a href="mailto:informacion@chesterton.com">informacion@chesterton.com</a></p>
										<p><strong>Teléfono<br>
										</strong>D.F. y Área Metropolitana<br>
										<a href="tel:5550891364">(55) 5089-1364</a></p>
										<p>Int. Rep. <a href="tel:018001118080">01-800-111-80-80</a></p>
										<p>Pregúntale a un experto<br>
											Sales / Distributor Locator</p>

								</div>
							</div>

							<div class="wpb_text_column wpb_content_element  vc_custom_1492451808441">
								<div class="wpb_wrapper">
									<p><strong>Chesterton International – Chile Ltda.</strong><br>
												Camino a Coronel Km. 10 Nr. 5580,<br>
												Concepcion.</p>
								</div>
							</div>

							<div class="wpb_text_column wpb_content_element  vc_custom_1492451816590">
								<div class="wpb_wrapper">
									<p><strong>Chesco do Brasil Ltda.</strong><br>
										1235, Moinho Fabrini Avenue,<br>
										Sao Bernardo do Campo,<br>
										Sao Paulo 09862-000.</p>

								</div>
							</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {

		$('select[name="pais"]').change(function(){

	        if ($(this).find("option:selected").val() != 'País') {	        	

	        	if ($('select[name="solucion"]').attr('disabled')){
	        		$('select[name="solucion"]').removeAttr('disabled');
	        	};
	        	$('select[name="producto"] option').remove();
        		$('select[name="producto"]').append($('<option>', {text: 'Tipo de Producto'}));
	        	$('select[name="producto"]').attr('disabled','');
	        	$('input[type="submit"]').attr('disabled', '');
	        	llenaSol($(this).find("option:selected").val());
	        	
	        }else{
	        	$('select[name="solucion"] option').remove();
        		$('select[name="solucion"]').append($('<option>', {text: 'Tipo de Solución'}));

        		$('select[name="producto"] option').remove();
        		$('select[name="producto"]').append($('<option>', {text: 'Tipo de Producto'}));
	        	$('select[name="producto"]').attr('disabled','');
	        	$('input[type="submit"]').attr('disabled', '');

	        	$('select[name="solucion"]').attr('disabled','');
	        };

	    });

	    $('select[name="solucion"]').change(function() {

	    	if ($(this).find("option:selected").val() != 'Tipo de Solución') {	        	

	        	if ($('select[name="producto"]').attr('disabled')){
	        		$('select[name="producto"]').removeAttr('disabled');
	        	};
	        	$('input[type="submit"]').attr('disabled', '');
	        	llenaTipoProductos($(this).find("option:selected").val());
	        	
	        }else{
	        	$('select[name="producto"] option').remove();
        		$('select[name="producto"]').append($('<option>', {text: 'Tipo de Producto'}));
	        	$('select[name="producto"]').attr('disabled','');
	        	$('input[type="submit"]').attr('disabled', '');
	        };

	    });

	    $('select[name="producto"]').change(function() {

	    	if ($(this).find("option:selected").val() != 'Tipo de Producto') {

	        	if ($('input[type="submit"]').attr('disabled')){
	        		$('input[type="submit"]').removeAttr('disabled');
	        	};

	        	
	        	
	        }else{
	        	$('input[type="submit"]').attr('disabled','');
	        };

	    });

	    
		
		$('#paises-map').submit(function(e){
		    e.preventDefault();
		  
	        var fproducto = $(this).find('select[name="producto"]').val();

	        hacemapa(fproducto);

		});

	});
	

	var marcadorTodos = <?php echo json_encode($marcador) ?>;
	var rowSolucion = [];
	var marcadorSolucion = [];
	var rowProductos = [];
	var marcadorProductos = [];
	var marcadorCorp = [];

	function llenaSol(pais){
		
		var pais = pais;
		rowSolucion.length=0;
		marcadorSolucion.length=0;

		 console.log(marcadorTodos);

		for (var i = marcadorTodos.length - 1; i >= 0; i--) {			

        	if (marcadorTodos[i][5] == pais) {

        		marcadorSolucion.push([marcadorTodos[i][0],marcadorTodos[i][1],marcadorTodos[i][2],marcadorTodos[i][3],marcadorTodos[i][4],marcadorTodos[i][5],marcadorTodos[i][6],marcadorTodos[i][7],marcadorTodos[i][8],marcadorTodos[i][9],marcadorTodos[i][10],marcadorTodos[i][11],marcadorTodos[i][12]]);

        		$.each(marcadorTodos[i][7], function (pos, valor) {
					 
					rowSolucion.push(valor.label);
					
				});
        		
        	};
        	// llena corporativos
        	if (marcadorTodos[i][0]['value'] == 'corporativo') {

        		marcadorCorp.push([marcadorTodos[i][0],marcadorTodos[i][1],marcadorTodos[i][2],marcadorTodos[i][3],marcadorTodos[i][4],marcadorTodos[i][5],marcadorTodos[i][6],marcadorTodos[i][7]]);
        		
        	};
        };

        // console.log(marcadorCorp);

        // Aquí llena el Select de Tipo de Solución

        var rowSolucionSelect = $.unique(rowSolucion);

        $('select[name="solucion"] option').remove();
        $('select[name="solucion"]').append($('<option>', {text: 'Tipo de Solución'}));
        for (var i = rowSolucionSelect.length - 1; i >= 0; i--) {
        	$('select[name="solucion"]').append($('<option>', {text: rowSolucionSelect[i]}));
        };
        $('select[name="solucion"]').append($('<option>', {text: 'Todos'}));
	};

	function llenaTipoProductos(solucion){
		// console.log(solucion);
		// console.log(marcadorSolucion);

		rowProductos.length=0;
		marcadorProductos.length=0;

		if (solucion == 'Todos') {			
			
			for (var i = 0; i < marcadorSolucion.length; i++) {				
				
				marcadorProductos.push([marcadorSolucion[i][0],marcadorSolucion[i][1],marcadorSolucion[i][2],marcadorSolucion[i][3],marcadorSolucion[i][4],marcadorSolucion[i][5],marcadorSolucion[i][6],marcadorSolucion[i][7],marcadorSolucion[i][8],marcadorSolucion[i][9],marcadorSolucion[i][10],marcadorSolucion[i][11],marcadorSolucion[i][12]]);
				
				// Llena select de Tipo de Productos

				for (var a = 8; a < 13; a++) {
					$.each(marcadorSolucion[i][a], function (pos2, valor2) {
						// console.log(valor2);
						rowProductos.push(valor2);
							
				  	});
				};
		  		  		

			};



		}else{

			var posi = 8;

			for (var i = marcadorSolucion.length - 1; i >= 0; i--) { //recorre todo el array de misma solución

						switch (solucion) {
							case 'Soluciones de sellado para equipo rotatorio':
								posi = 8;
								marcadorProductos.push([marcadorSolucion[i][0],marcadorSolucion[i][1],marcadorSolucion[i][2],marcadorSolucion[i][3],marcadorSolucion[i][4],marcadorSolucion[i][5],marcadorSolucion[i][6],marcadorSolucion[i][7],marcadorSolucion[i][8]]);
							break;

							case 'Soluciones de sellado para equipo estacionario':
								posi = 9;
								marcadorProductos.push([marcadorSolucion[i][0],marcadorSolucion[i][1],marcadorSolucion[i][2],marcadorSolucion[i][3],marcadorSolucion[i][4],marcadorSolucion[i][5],marcadorSolucion[i][6],marcadorSolucion[i][7],marcadorSolucion[i][9]]);							
							break;

							case 'Soluciones de sellado para equipos de fluido de potencia':
								posi = 10;
								marcadorProductos.push([marcadorSolucion[i][0],marcadorSolucion[i][1],marcadorSolucion[i][2],marcadorSolucion[i][3],marcadorSolucion[i][4],marcadorSolucion[i][5],marcadorSolucion[i][6],marcadorSolucion[i][7],marcadorSolucion[i][10]]);
							break;

							case 'Lubricantes Industriales y Productos Químicos MRO':
								posi = 11;
								marcadorProductos.push([marcadorSolucion[i][0],marcadorSolucion[i][1],marcadorSolucion[i][2],marcadorSolucion[i][3],marcadorSolucion[i][4],marcadorSolucion[i][5],marcadorSolucion[i][6],marcadorSolucion[i][7],marcadorSolucion[i][11]]);
							break;

							case 'Revestimientos Industriales':
								posi = 12;
								marcadorProductos.push([marcadorSolucion[i][0],marcadorSolucion[i][1],marcadorSolucion[i][2],marcadorSolucion[i][3],marcadorSolucion[i][4],marcadorSolucion[i][5],marcadorSolucion[i][6],marcadorSolucion[i][7],marcadorSolucion[i][12]]);
							break;

						};

						// Llena select de Tipo de Productos

						$.each(marcadorSolucion[i][posi], function (pos1, valor1) {
							// console.log(valor1);
							rowProductos.push(valor1);
							
				  		});

	        };

		};

		
        // Aquí llena el Select de Productos
        var rowProductosSelect = $.unique(rowProductos);

        $('select[name="producto"] option').remove();
        $('select[name="producto"]').append($('<option>', {text: 'Tipo de Producto'}));
        for (var i = rowProductosSelect.length - 1; i >= 0; i--) {
        	$('select[name="producto"]').append($('<option>', {text: rowProductosSelect[i]}));
        };
        $('select[name="producto"]').append($('<option>', {text: 'Todos'}));

        // console.log(rowProductosSelect);
        // console.log(marcadorProductos);

	};

	function hacemapa(producto){

		var producto = producto;

		var marcador = [];

		//console.log(marcadorProductos);
		//console.log(rowProductos);

		if (producto == 'Todos') {
			    	//son los array
				 	 marcadorProductos.forEach(function(tipo_solucion) { //array 1..7
					    encontrado = 0;
					    for (var i = 8; i <= 12; i++) {
					    		rowProductos.forEach(function(tipo_prod) { // elemento de tipos de producto
					    			if (tipo_solucion[i]) {
						    			tipo_solucion[i].forEach(function(item) { 

								    		    if (tipo_prod == item) {
								    	 	 	     encontrado= encontrado+1;
								    	 	 		//break;
								    	  	 	}
								    	});  
								    }		 	
					    		});
					    };
							if (encontrado==rowProductos.length) 
								{
									console.log(encontrado+" "+ (rowProductos.length)); //Número de coinsidencias encontradas
									// console.log(tipo_solucion);
									marcador.push(tipo_solucion);

								}					    
					 });

				 	// 
			
				

			// for (var i = marcadorProductos.length - 1; i >= 0; i--) {

			// 	for (var a = 0; a < rowProductos.length; a++) {
			// 		if (marcadorProductos[i][8].includes( rowProductos[a] ) == true) {
			// 			console.log('si'+rowProductos[a]);
			// 		}else{
			// 			console.log('no'+rowProductos[a]);
			// 		};	
			// 	};

				
				
			// 	// console.info( marcadorProductos.includes( rowProductos[i] ) );
				
				
			// };
			

		}else{

			for (var i = marcadorProductos.length - 1; i >= 0; i--) {

				$.each(marcadorProductos[i][8], function (pos, valor) {
					
					if (valor == producto) {

						// console.log(valor.post_title);
						marcador.push([marcadorProductos[i][0],marcadorProductos[i][1],marcadorProductos[i][2],marcadorProductos[i][3],marcadorProductos[i][4],marcadorProductos[i][5],marcadorProductos[i][6],marcadorProductos[i][7]]);

					};
					
				});

	        };

		};		

        

        if ( marcador == null || marcador == '' ) {
        	alert('no existen resultados');
        	initialize(marcadorCorp);
        }else{
        	var marcador = marcador.concat(marcadorCorp);
        	initialize(marcador);	
        };

        
	}

	// var myArr = [ 'la', 'donna', 'e', 'mobile', 'cual', 'piuma', 'al', 'vento' ];
	 
	// console.info( myArr.includes( 'donna' ) ); // true
	// console.info( myArr.includes( 'pensiero' ) ); // false

</script>

<style type="text/css">
	@media screen and (max-width: 360px) {
		#mapa {
			max-height: 300px;
		}
	}
	
</style>