<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<style>
.col-md-12{
	padding-left: 0px !important;
	padding-right: 0px !important;
}
.Elemento{
	    background-color: #71b943b8;
    padding: 15px;
    color: #ffffff;
    font-size: 18px;

}
.Elemento p{
	margin-bottom: 0px;
}
.servicios label{
	font-size: 18px;

}
.servicios select{
	    margin-bottom: 26px !important;
	display: inline-block;
}
.servicios{
	margin-top: 100px;
    margin-bottom: 100px;
}
.estesi{
	background: url(img/lPlmARAw.jpeg);
    background-attachment: fixed;
    background-position: bottom;
    background-size: cover;
}


</style>
		<div>

					<div class="row estesi">								
				

						<div class="container ">
						
						 
						 	<!-- <div class="demo-control-title">Proyecciones</div> -->
					        <div class="select">
					               <!--
					                <select id="proyecciones">
					                    <option value="winkel3" selected="selected">winkel3</option>
					                    <option value="eckert3">eckert3</option>
					                    <option value="eckert5">eckert5</option>
					                    <option value="eckert6">eckert6</option>
					                    <option value="miller">miller</option>
					                    <option value="equirectangular">equirectangular</option>
					                    <option value="mercator">mercator</option>
					                </select>

								<select id="idioma">
										<option value="en">English (default)</option>
										<option value="de" selected="selected">German</option>
										<option value="fr">French</option>
										<option value="es">Spanish</option>
								</select>					                
								-->

								<div class="col-md-3 servicios">	
								</div>
								<div class="col-md-6 servicios">			
									<label>Services</label>
									<select name="id_estatus" id="id_estatus"  class="form-control" dependencia="pais">				
											<option value="1" selected="selected">Import</option>
											<option value="2">Export</option>
									</select>					                

									
									<label>Country of <span class="etiq1">Origin</span></label>
									<select name="pais" id="pais" class="form-control" dependencia="inicio">				
										<?php foreach ( (json_decode(json_encode($paises))) as $pais ){ ?>
										
													<option value="<?php echo $pais->id; ?>" ><?php echo $pais->nombre; ?></option>
										<?php } ?>									
									</select>

									
									<label>Port of <span class="etiq1">Origin</span></label>
									<select name="inicio" id="inicio" class="form-control" dependencia="fin">				
										<?php foreach ( (json_decode(json_encode($origen))) as $importa ){ ?>
										
													<option value="<?php echo $importa->id; ?>" ><?php echo $importa->nombre; ?></option>
										<?php } ?>									
									</select>

									
									<label>Port of <span class="etiq2">Destination</span></label>
									<select name="fin" id="fin" class="form-control" dependencia="">				
										<?php foreach ( (json_decode(json_encode($destino))) as $importa ){ ?>
										
													<option value="<?php echo $importa->id; ?>" ><?php echo $importa->nombre; ?></option>
										<?php } ?>									
									</select>
								</div>

					        </div>
							 </div>
							<div class="col-md-12" >
									<!-- d5eff7    222222--> 
									 <div id="mapdiv" style="width: 100%; background-color:#d5eff7; height: 500px;"></div>

									 <div class="Elemento" style="overflow: hidden; position: absolute; text-align: left; left: 50px;top: 15px;">
									 		 <p>Country: <span class="etiq_pais"> <?php echo $paises[0]->nombre; ?></span></p>
									 		 <p>Port: <span class="etiq_puerto"> <?php echo $origen[0]->nombre; ?></span></p>
									 		 <p>Destination: <span class="etiq_destino"> <?php echo $destino[0]->nombre.' , México'; ?></span></p>
									 		 <p>Via: <span class="etiq_via"> <?php echo $destino[0]->via; ?></span></p>
									 		 <p>TT: <span class="etiq_tt"> <?php echo $origen[0]->tt; ?></span>, México </p>
									 		<p style="font-size:10px">No incluye tiempos de transbordo</p>
									</div>

							</div>
						</div>
						</div>

		</div>				  

</div>


<?php $this->load->view( 'footer' ); ?>


	
