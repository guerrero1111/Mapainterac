<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view( 'admin/navbar' ); ?>

	<?php
	 	if (!isset($retorno)) {
	      	$retorno ="admin";
	    }
	?>    



	<div class="container">
		<!-- fin selector--> 
		<div class="row">


				<div class="col-md-12">
							 
							 	<div class="demo-control-title">Proyecciones</div>
						        

									<div class="col-md-3">			
										<label>Servicios</label>
										<select name="id_estatus" id="id_estatus"  class="form-control" dependencia="pais">				
												<option value="1" selected="selected">Importación</option>
												<option value="2">Exportación</option>
										</select>					                
									</div>	
									<div class="col-md-3">				
										<label>País de <span class="etiq1">Origen</span></label>
										<select name="pais" id="pais" class="form-control" dependencia="inicio">				
										    <option value="0" >Todos</option>
											<?php foreach ( (json_decode(json_encode($paises))) as $pais ){ ?>
											
														<option value="<?php echo $pais->id; ?>" ><?php echo $pais->nombre; ?></option>
											<?php } ?>									
										</select>
									</div>	
									<div class="col-md-3">				
										<label>Puerto de <span class="etiq1">Origen</span></label>
										<select name="inicio" id="inicio" class="form-control" dependencia="fin">		
										     <option value="0" >Todos</option>		
											<?php foreach ( (json_decode(json_encode($origen))) as $importa ){ ?>
											
														<option value="<?php echo $importa->id; ?>" ><?php echo $importa->nombre; ?></option>
											<?php } ?>									
										</select>
									</div>	
									<div class="col-md-3">				
										<label>Puerto de <span class="etiq2">Destino</span></label>
										<select name="fin" id="fin" class="form-control" dependencia="">		
											<option value="0" >Todos</option>		
											<?php foreach ( (json_decode(json_encode($destino))) as $importa ){ ?>
											
														<option value="<?php echo $importa->id; ?>" ><?php echo $importa->nombre; ?></option>
											<?php } ?>									
										</select>
									</div>
		</dir>
		<!-- fin selector--> 


		
		<div class="row">

			<br>
			<div class="col-xs-12 col-sm-12 col-md-12 marginbuttom">
				<div class="col-xs-12 col-sm-12 col-md-12"><h4>Catálogos</h4></div>
			</div>	
			<!--
			<div class="col-xs-12 col-sm-4 col-md-3 marginbuttom">
				<a href="<?php echo base_url(); ?>nuevo_catalogo" type="button" class="btn btn-success btn-block">Nuevo catálogo</a>
			</div>
			-->
			

		</div>
		<br>
		<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Listado de Catálogos</div>
			<div class="panel-body">
			<div class="col-md-12">
				
				<div class="table-responsive">

					<section>
						<table id="tabla_catalogos" class="display table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="text-center cursora" width="70%">Origen</th>
									<th class="text-center cursora" width="20%">Destino </th>
									<th class="text-center cursora" width="20%">Via </th>
									<th class="text-center cursora" width="20%">Precio </th>
									<th class="text-center " width="10%"><strong>Editar</strong></th>
									<th class="text-center " width="10%"><strong>Eliminar</strong></th>
								</tr>
							</thead>
						</table>
					</section>
				</div>
			</div>
		</div>
		</div>
		
		<div class="row">

			<div class="col-sm-8 col-md-9"></div>
			<div class="col-sm-4 col-md-3">
				<a href="<?php echo base_url(); ?><?php echo $retorno; ?>" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
			</div>

		</div>
		<br/>
	</div>




<?php $this->load->view('admin/footer'); ?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/sistema_catalogo.js"></script>

<div class="modal fade bs-example-modal-lg" id="modalMessage2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	
	

<div class="modal fade bs-example-modal-lg" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	