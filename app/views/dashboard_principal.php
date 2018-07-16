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

 									<select id="inicio">
					                    <option value="1" selected="selected">1</option>
					                    <option value="2">2</option>
					                    <option value="3">3</option>
					                    <option value="4">4</option>
					                </select>


 									<select id="fin">
					                    <option value="1">1</option>
					                    <option value="2" selected="selected">2</option>
					                    <option value="3">3</option>
					                    <option value="4">4</option>
					                </select>					                

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


	
