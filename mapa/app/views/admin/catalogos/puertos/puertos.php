<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view( 'admin/navbar' ); ?>

	<?php
	 	if (!isset($retorno)) {
	      	$retorno ="admin";
	    }
	?>    



	<div class="container">
		


		
		<div class="row">

			<br>
			<div class="col-xs-12 col-sm-12 col-md-12 marginbuttom">
				<div class="col-xs-12 col-sm-12 col-md-12"><h4>Puertos</h4></div>
			</div>	
			
			<div class="col-xs-12 col-sm-4 col-md-3 marginbuttom">
				<a id="nuevo_puerto" href="<?php echo base_url(); ?>nuevo_puerto" type="button" class="btn btn-success btn-block">Nuevo puerto</a>
			</div>
			
			

		</div>
		<br>
		<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Listado de Puertos</div>
			<div class="panel-body">
			<div class="col-md-12">
				
				<div class="table-responsive">
				<!-- puerto, city, city_ascii, lat, lng, pop, country, iso2, iso3, province -->
					<section>
						<table id="tabla_puertos" class="display table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="text-center cursora" width="4%">id</th>
									<th class="text-center cursora" width="16%">Puerto</th>
									<th class="text-center cursora" width="16%">Ciudad</th>
									<th class="text-center cursora" width="16%">Latitud</th>
									<th class="text-center cursora" width="16%">Longitud</th>
									<th class="text-center cursora" width="16%">País</th>
									<th class="text-center " width="8%"><strong>Editar</strong></th>
									<th class="text-center " width="8%"><strong>Eliminar</strong></th>
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