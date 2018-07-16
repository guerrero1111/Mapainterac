<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		</div>
	
	</div>

	<script src="<?php echo base_url(); ?>js/bootstrap-3.3.1/dist/js/bootstrap.min.js"></script>

 		<!--dos maneras de usar mapas: puede cargar 
         * archivos SVG en tiempo de ejecución 
         * insertar mapas como archivos .js.
        -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/ammap/ammap.css" type="text/css">

        <script src="<?php echo base_url(); ?>js/ammap/ammap.js" type="text/javascript"></script>

        <!-- Tema -->
        <script src="<?php echo base_url(); ?>js/ammap/themes/light.js"  type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/ammap/themes/black.js" type="text/javascript"></script>
        
        <!-- 
                insertar el archivo de mapa como archivo .js,
                hay versiones de la mayoría de los mapas: 
                    *alto(high)
                    * bajo(low) 
        -->
		<script src="<?php echo base_url(); ?>js/ammap/maps/js/cubaLow.js" type="text/javascript"></script>

		<script src="<?php echo base_url(); ?>js/mapa1.js" type="text/javascript"></script>

		<link rel="stylesheet" href="<?php echo base_url(); ?>css/estilo_mapa.css" type="text/css">


</body>
</html>