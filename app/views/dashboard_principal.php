<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>

		<div class="container intro" >

					<div class="row">								
				


						<div class="col-md-12">
						 
						 	<div class="demo-control-title">Proyecciones</div>
					        <div class="select">
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

								<div class="col-md-5">			

									<select name="id_estatus" id="id_estatus"  class="form-control" dependencia="pais">				
											<option value="1" selected="selected">Importación</option>
											<option value="2">Exportación</option>
									</select>					                


									<select name="pais" id="pais" class="form-control" dependencia="inicio">				
										<?php foreach ( (json_decode(json_encode($paises))) as $pais ){ ?>
										
													<option value="<?php echo $pais->id; ?>" ><?php echo $pais->nombre; ?></option>
										<?php } ?>									
									</select>


									<select name="inicio" id="inicio" class="form-control" dependencia="fin">				
										<?php foreach ( (json_decode(json_encode($origen))) as $importa ){ ?>
										
													<option value="<?php echo $importa->id; ?>" ><?php echo $importa->nombre; ?></option>
										<?php } ?>									
									</select>

									<select name="fin" id="fin" class="form-control" dependencia="">				
										<?php foreach ( (json_decode(json_encode($destino))) as $importa ){ ?>
										
													<option value="<?php echo $importa->id; ?>" ><?php echo $importa->nombre; ?></option>
										<?php } ?>									
									</select>
								</div>






					        </div>
							
							<div class="col-md-12" >
									<!-- d5eff7    222222--> 
									 <div id="mapdiv" style="width: 100%; background-color:#d5eff7; height: 500px;"></div>
							</div>
						</div>
						</div>

		</div>				  

</div>


<?php $this->load->view( 'footer' ); ?>


	
