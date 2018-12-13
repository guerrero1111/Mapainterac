<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'admin/header' ); ?>
<?php $this->load->view( 'admin/navbar' ); ?>
<?php 
	if (!isset($retorno)) {
      	$retorno ="catalogos";
    }
  $hidden = array('id_p'=>2222);
  $attr = array('class' => 'form-horizontal', 'id'=>'form_catalogos','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
  echo form_open('validar_nuevo_catalogo', $attr,$hidden);
?>

<!--
 <input value="<?php echo  $id; ?>"   name="id" type="hidden">

-->
<input value="<?php echo  $id_estatus; ?>"  name="id_estatus" type="hidden">

<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-8"><h4>Edición de catalogo</h4></div>
	</div>
	<br>
	<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Datos del catalogo</div>
			<div class="panel-body">
				

				<div class="col-sm-6 col-md-6">

					<!--<div class="form-group">

					<label for="id_estatus" class="col-sm-3 col-md-2 control-label">Tipo</label>
						<div class="col-sm-9 col-md-10">
							<select name="id_estatus" id="id_estatus" class="form-control" dependencia="id_estatus">	
								<option value="1" selected="selected">Importación</option>
								<option value="2">Exportación</option>
							</select>
						</div>	
					</div> -->
					

					<div class="form-group">
						<label for="id_perfil" class="col-sm-3 col-md-2 control-label">Puerto <?php echo ($id_estatus==1) ? 'origen' : 'destino'; ?></label>
						<div class="col-sm-9 col-md-10">

								<select name="id_puerto" id="id_puerto" class="form-control">
										<?php foreach ( $paises as $pais ){ ?>
												<?php 
												   if  ($pais->id==$catalogo->id_puerto)
													 {$seleccionado='selected';} else {$seleccionado='';}
												?>
												<option value="<?php echo $pais->id; ?>"  <?php echo $seleccionado; ?>><?php echo $pais->nombre.' ('. $pais->country.')'; ?></option>
										<?php } ?>
								</select>
														    
						</div>
					</div>


					<div class="form-group">
						<label for="id_perfil" class="col-sm-3 col-md-2 control-label">Puerto Escala</label>
						<div class="col-sm-9 col-md-10">

								<select name="id_puertoescala" id="id_puertoescala" class="form-control">
								<option value="0"  >Directo</option>
										<?php foreach ( $paises as $pais ){ ?>
												<?php 
												   if  ($pais->id==$catalogo->id_puertoescala)
													 {$seleccionado='selected';} else {$seleccionado='';}
												?>
												<option value="<?php echo $pais->id; ?>"  <?php echo $seleccionado; ?>><?php echo $pais->nombre; ?></option>
										<?php } ?>
								</select>
														    
						</div>
					</div>



					<div class="form-group">
						<label for="id_perfil" class="col-sm-3 col-md-2 control-label">Puerto Escala2</label>
						<div class="col-sm-9 col-md-10">

								<select name="id_puertoescala2" id="id_puertoescala2" class="form-control">
										<option value="0"  >Directo</option>
										<?php foreach ( $paises as $pais ){ ?>
												<?php 
												   if  ($pais->id==$catalogo->id_puertoescala2)
													 {$seleccionado='selected';} else {$seleccionado='';}
												?>
												<option value="<?php echo $pais->id; ?>"  <?php echo $seleccionado; ?>><?php echo $pais->nombre; ?></option>
										<?php } ?>
								</select>
														    
						</div>
					</div>





					<div class="form-group">
						<label for="id_perfil" class="col-sm-3 col-md-2 control-label"><?php echo ($id_estatus==1) ? 'Destino' : 'Origen'; ?></label>
						<div class="col-sm-9 col-md-10">

								<select name="id_destino" id="id_destino" class="form-control">
										<?php foreach ( $paises as $pais ){ ?>
												<?php 
												   if  ($pais->id==$catalogo->id_destino)
													 {$seleccionado='selected';} else {$seleccionado='';}
												?>
											<option value="<?php echo $pais->id; ?>"  <?php echo $seleccionado; ?>><?php echo $pais->nombre.' ('.$pais->country.')'; ?></option>
										<?php } ?>
								</select>
														    
						</div>
					</div>





						
				</div>


				<div class="col-sm-6 col-md-6">
					
					<div class="form-group">
						<label for="tarifa" class="col-sm-3 col-md-2 control-label">Tarifa</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->tarifa)) 
								 {	$nomb_nom = $catalogo->tarifa;}
								//print_r($catalogo->tarifa); die;
							?>
							<input value="<?php echo  set_value('tarifa',$nomb_nom); ?>"  class="form-control" name="tarifa" placeholder="tarifa">
						</div>
					</div>

					<div class="form-group">
						<label for="salidas" class="col-sm-3 col-md-2 control-label">Salidas</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->salidas)) 
								 {	$nomb_nom = $catalogo->salidas;}
							?>
							<input value="<?php echo  set_value('salidas',$nomb_nom); ?>"  class="form-control" name="salidas" placeholder="salidas">
						</div>
					</div>
						

					<div class="form-group">
						<label for="minimo" class="col-sm-3 col-md-2 control-label">Minimo</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->minimo)) 
								 {	$nomb_nom = $catalogo->minimo;}
							?>
							<input value="<?php echo  set_value('minimo',$nomb_nom); ?>"  class="form-control" name="minimo" placeholder="minimo">
						</div>
					</div>
						
					<div class="form-group">
						<label for="tt" class="col-sm-3 col-md-2 control-label">TT</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->tt)) 
								 {	$nomb_nom = $catalogo->tt;}
							?>
							<input value="<?php echo  set_value('tt',$nomb_nom); ?>"  class="form-control" name="tt" placeholder="tt">
						</div>
					</div>
											

					<div class="form-group">
						<label for="precio" class="col-sm-3 col-md-2 control-label">Precio</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($catalogo->precio)) 
								 {	$nomb_nom = $catalogo->precio;}
							?>
							<input value="<?php echo  set_value('precio',$nomb_nom); ?>"  class="form-control" name="precio" placeholder="0.00">
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