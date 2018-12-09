


<?php 
	$elementos = get_field('origen_destino', '210');
	
	$pais = array();
	$destino = array();
	$i=0;
	foreach ($elementos as $key => $value) {
		$pais[] = $elementos[$i]['pais'];
		$destino[] = $elementos[$i]['tipo_de_solucion'];
		$marcador[] = array($elementos[$i]['pais'], $elementos[$i]['tipo_de_solucion']);
		
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


<div class="container">
	<div class="row">
		
	

		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<h4>Localizador de distribuidores</h4>
			<form id="paises-map" >
				 <select name="pais" class="form-control"> -->
					<option>País</option>
					<?php
					$a=0;
					foreach ($pais as $key => $value) {
						 echo '<option value="'.$pais[$a].'" >'.$pais[$a].'</option>';
						
						$a++;
					}
					?>
<br><br>
					<?php
					$b=0;
					foreach ($destino as $key => $value) {
						// echo '<option value="'.$pais[$a].'" >'.$pais[$a].'</option>';
						echo '<span>'.$destino[$b].'</span><br>';
						$b++;
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
	        	//alert("SI");
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
		//alert(pais);
		rowSolucion.length=0;
		marcadorSolucion.length=0;

		console.log(marcadorTodos);

		for (var i = marcadorTodos.length - 1; i >= 0; i--) {			

        	if (marcadorTodos[i][0] == pais) {
        		//alert(marcadorTodos[i][0]);
        		marcadorSolucion.push([marcadorTodos[i][0],marcadorTodos[i][1]]);
        		//alert(marcadorSolucion);
        		$.each(marcadorTodos[i][1], function (pos, valor) {
					 
					rowSolucion.push(valor.label);
					
				});
        		
        	};
        	console.log(rowSolucion);
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


</script>

<style type="text/css">
	@media screen and (max-width: 360px) {
		#mapa {
			max-height: 300px;
		}
	}
	
</style>