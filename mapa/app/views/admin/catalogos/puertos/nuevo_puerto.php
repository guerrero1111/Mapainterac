<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'admin/header' ); ?>
<?php $this->load->view( 'admin/navbar' ); ?>
<?php 
	if (!isset($retorno)) {
      	$retorno ="puertos";
    }
  $hidden = array('id_p'=>2222);
  $attr = array('class' => 'form-horizontal', 'id'=>'form_catalogos','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
  echo form_open('validar_nuevo_puerto', $attr,$hidden);
?>



<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-8"><h4>Edición de puerto</h4></div>
	</div>
	<br>
	<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Datos del puerto</div>
			
			<div class="panel-body">
				
				<div class="col-sm-6 col-md-6">

					<div class="form-group">
						<label for="puerto" class="col-sm-3 col-md-2 control-label">Puerto</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->puerto)) 
								 {	$nomb_nom = $catalogo->puerto;}
								
							?>
							<input value="<?php echo  set_value('puerto',$nomb_nom); ?>"  class="form-control" name="puerto" placeholder="puerto">
						</div>
					</div>
					
					<div class="form-group">
						<label for="city" class="col-sm-3 col-md-2 control-label">Ciudad</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->city)) 
								 {	$nomb_nom = $catalogo->city;}
								
							?>
							<input value="<?php echo  set_value('city',$nomb_nom); ?>"  class="form-control" name="city" placeholder="city">
						</div>
					</div>

					<div class="form-group">
						<label for="country" class="col-sm-3 col-md-2 control-label">País</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->country)) 
								 {	$nomb_nom = $catalogo->country;}
								
							?>
							<input value="<?php echo  set_value('country',$nomb_nom); ?>"  class="form-control" name="country" placeholder="country">
						</div>
					</div>					
					
				

					
					


					


						
				</div>


				<div class="col-sm-6 col-md-6">
					
						<div class="form-group">
						<label for="lat" class="col-sm-3 col-md-2 control-label">Latitud</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->lat)) 
								 {	$nomb_nom = $catalogo->lat;}
								
							?>
							<input value="<?php echo  set_value('lat',$nomb_nom); ?>"  class="form-control" name="lat" placeholder="lat">
						</div>
					</div>
					

					<div class="form-group">
						<label for="lng" class="col-sm-3 col-md-2 control-label">Longitud</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->lng)) 
								 {	$nomb_nom = $catalogo->lng;}
								
							?>
							<input value="<?php echo  set_value('lng',$nomb_nom); ?>"  class="form-control" name="lng" placeholder="lng">
						</div>
					</div>

				</div>
			</div>
			

			
		</div>



		<br>

		<div class="row">
			<div class="col-sm-4 col-md-4"></div>
			<div class="col-sm-4 col-md-4">
				<a href="<?php echo base_url(); ?><?php echo $retorno; ?>" type="button" class="btn btn-danger btn-block">Cancelar</a>
			</div>
			<div class="col-sm-4 col-md-4">
				<input style="padding:8px;" type="submit" class="btn btn-success btn-block" value="Guardar"/>
			</div>
		</div>
		
	</div>
</div>
  <?php echo form_close(); ?>
<?php $this->load->view('admin/footer'); ?>