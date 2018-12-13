<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct(){ 
		parent::__construct();

		$this->load->model('admin/modelo_admin', 'modelo_admin'); 
		$this->load->model('modelo', 'modelo'); 
		$this->load->library(array('email')); 
	}


	public function index(){

		
		if ( $this->session->userdata( 'session' ) !== TRUE ){
			self::configuraciones();
			$this->login();
		} else {
			$this->dashboard_usuario();
		}
	}

	public function configuraciones(){
			    $configuraciones = $this->modelo_admin->listado_configuraciones();
				
				if ( $configuraciones != FALSE ){

					if (is_array($configuraciones))
						foreach ($configuraciones as $configuracion) {
							$this->session->set_userdata('c'.$configuracion->id, $configuracion->valor);
							$this->session->set_userdata('a'.$configuracion->id, $configuracion->activo);
						}
					
				} 

	}



	public function login(){
		$this->load->view( 'admin/login' );
	}


	function validar_login(){
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules( 'contrasena', 'Contraseña', 'required|trim|min_length[8]|xss_clean');


		if ( $this->form_validation->run() == FALSE ){
				echo validation_errors('<span class="error">','</span>');
			} else {
				$data['email']		=	$this->input->post('email');
				$data['contrasena']		=	$this->input->post('contrasena');
				$data 				= 	$this->security->xss_clean($data);  

				$login_check = $this->modelo_admin->check_login($data);
				
				if ( $login_check != FALSE ){

					$usuario_historico = $this->modelo_admin->anadir_historico_acceso($login_check[0]);

					$this->session->set_userdata('session', TRUE);
					$this->session->set_userdata('email', $data['email']);
					
					if (is_array($login_check))
						foreach ($login_check as $login_element) {
							$this->session->set_userdata('id', $login_element->id);
							$this->session->set_userdata('id_perfil', $login_element->id_perfil);
							$this->session->set_userdata('especial', $login_element->especial);
							$this->session->set_userdata('perfil', $login_element->perfil);
							$this->session->set_userdata('operacion', $login_element->operacion);
							
							
							$this->session->set_userdata('nombre_completo', $login_element->nombre.' '.$login_element->apellidos);
						}
					echo TRUE;
				} else {
					echo '<span class="error">Tus datos no son correctos, verificalos e intenta nuevamente por favor.</span>';
				}
			}
	}	



	

	//lista de todos los usuarios 

  
  public function listado_usuarios(){

  
   $id_session = $this->session->userdata('id');
   if ( $this->session->userdata('session') !== TRUE ) {

        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');



        $coleccion_id_operaciones= json_decode($this->session->userdata('coleccion_id_operaciones')); 
        if ( (count($coleccion_id_operaciones)==0) || (!($coleccion_id_operaciones)) ) {
              $coleccion_id_operaciones = array();
         }   
         //print_r($id_perfil); die;

      //$html = $this->load->view( 'catalogos/colores',$data ,true);   
      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'admin/usuarios');
          break;
        case 2:
        case 3:
        case 4:
             if  ( (in_array(8, $coleccion_id_operaciones))  || (in_array(13, $coleccion_id_operaciones))  )   { 
                $this->load->view( 'admin/usuarios');
              }  else  {
                redirect('');
              } 
          break;


        default:  
          redirect('');
          break;
      }

    }    
    
  }


  public function procesando_usuarios(){

    $data=$_POST;
    $busqueda = $this->modelo_admin->buscador_usuarios($data);
    echo $busqueda;
  } 


   // Creación de especialista o Administrador (Nuevo Colaborador)
	function nuevo_usuario(){
	if($this->session->userdata('session') === TRUE ){
		  $id_perfil=$this->session->userdata('id_perfil');
		  
		  $data['perfiles']   = $this->modelo_admin->coger_catalogo_perfiles();
		  

		  switch ($id_perfil) {    
			case 1:
				  $this->load->view( 'admin/usuarios/nuevo_usuario', $data );   
					
			  break;
			case 2:
			case 3:
					$this->load->view( 'admin/usuarios/nuevo_usuario', $data );   
			  break;


			default:  
			  redirect('');
			  break;
		  }
		}
		else{ 
		  redirect('index');
		}    

	}

	function validar_nuevo_usuario(){
		if ($this->session->userdata('session') !== TRUE) {
			redirect('');
		} else {

			

			$this->form_validation->set_rules( 'nombre', 'Nombre', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'apellidos', 'Apellido(s)', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules( 'telefono', 'Teléfono', 'trim|numeric|callback_valid_phone|xss_clean');
			$this->form_validation->set_rules('id_perfil', 'Rol de usuario', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules( 'pass_1', 'Contraseña', 'required|trim|min_length[8]|xss_clean');
			$this->form_validation->set_rules( 'pass_2', 'Confirmación de contraseña', 'required|trim|min_length[8]|xss_clean');

			

			if ($this->form_validation->run() === TRUE){
				if ($this->input->post( 'pass_1' ) === $this->input->post( 'pass_2' ) ){
					$data['email']		=	$this->input->post('email');
					$data['contrasena']		=	$this->input->post('pass_1');
					$data 				= 	$this->security->xss_clean($data);  
					$login_check = $this->modelo_admin->check_correo_existente($data);

					if ( $login_check != FALSE ){		
						$usuario['nombre']   			= $this->input->post( 'nombre' );
						$usuario['apellidos']   		= $this->input->post( 'apellidos' );
						$usuario['email']   			= $this->input->post( 'email' );
						$usuario['contrasena']				= $this->input->post( 'pass_1' );
						$usuario['telefono']   		= $this->input->post( 'telefono' );
						$usuario['id_perfil']   		= $this->input->post( 'id_perfil' );
						

						$usuario 						= $this->security->xss_clean( $usuario );
						$guardar 						= $this->modelo_admin->anadir_usuario( $usuario );

						
						if ( $guardar !== FALSE ){  

									
									$dato['email']   			    = $usuario['email'];   			
									$dato['contrasena']				= $usuario['contrasena'];				

									/* 
									//envio de correo para notificar alta en usuarios del sistema
									$desde = $this->session->userdata('c1');
									$esp_nuevo = $usuario['email'];
									$this->email->from($desde, $this->session->userdata('c2'));
									$this->email->to( $esp_nuevo );
									$this->email->subject('Has sido dado de alta en '.$this->session->userdata('c2'));
									$this->email->message( $this->load->view('admin/correos/alta_usuario', $dato, TRUE ) );

										 
									if ($this->email->send()) {	
										echo TRUE;
									} else {
										echo '<span class="error"><b>E01</b> - El nuevo usuario no pudo ser agregado</span>';
									}
									*/



									echo true;	

						} else {
							echo '<span class="error"><b>E01</b> - El nuevo usuario no pudo ser agregado</span>';
						}
					} else {
						echo '<span class="error">El <b>Correo electrónico</b> ya se encuentra asignado a una cuenta.</span>';
					}
				} else {
					echo '<span class="error">No coinciden la Contraseña </b> y su <b>Confirmación</b> </span>';
				}
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}



	//edicion del especialista o el perfil del especialista o administrador activo
	function actualizar_perfil( $uid = '' ){

	$id=$this->session->userdata('id');

		if ($uid=='') {
			$uid= $id;
			$data['retorno'] = 'admin';
		} else {
			$uid = base64_decode($uid);
		}
  


		$id_perfil=$this->session->userdata('id_perfil');
		
	//Administrador con permiso a todo ($id_perfil==1)
	//usuario solo viendo su PERFIL  OR (($id_perfil!=1) and ($id==$uid) )
		if	( ($id_perfil==1) OR (($id_perfil!=1) and ($id==$uid) ) ) {
			$data['perfiles']		= $this->modelo_admin->coger_catalogo_perfiles();
			$data['usuario'] = $this->modelo_admin->coger_catalogo_usuario( $uid );

			$data['id']  = $uid;
			if ( $data['usuario'] !== FALSE ){
					$this->load->view('admin/usuarios/editar_usuario',$data);
			} else {
						redirect('');
			}
		} else
		{
			 redirect('');
		}	
	}
	
	function validacion_edicion_usuario(){
		
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {
			
			$this->form_validation->set_rules( 'nombre', 'Nombre', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'apellidos', 'Apellido(s)', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules( 'telefono', 'Teléfono', 'trim|numeric|callback_valid_phone|xss_clean');
			$this->form_validation->set_rules('id_perfil', 'Rol de usuario', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules( 'pass_1', 'Contraseña', 'required|trim|min_length[8]|xss_clean');
			$this->form_validation->set_rules( 'pass_2', 'Confirmación de contraseña', 'required|trim|min_length[8]|xss_clean');

	  //si el usuario no es un administrador entonces q sea obligatorio asociarlo a operaciones 
	  //Esto YA NO HACE FALTA
	  if ($this->input->post('id_perfil')!=1) {
		
		
	  } 


			if ( $this->form_validation->run() === TRUE ){
				if ($this->input->post( 'pass_1' ) === $this->input->post( 'pass_2' ) ){
					$uid 				=   $this->input->post( 'id_p' ); 
					$data['id']							= $uid;
					$data['email']		=	$this->input->post('email');
					$data 				= 	$this->security->xss_clean($data);  
					$login_check = $this->modelo_admin->check_usuario_existente($data);
					if ( $login_check === TRUE ){
						$usuario['nombre']   					= $this->input->post( 'nombre' );
						$usuario['apellidos']   				= $this->input->post( 'apellidos' );
						$usuario['email']   					= $this->input->post( 'email' );
						$usuario['contrasena']						= $this->input->post( 'pass_1' );
						$usuario['telefono']   				= $this->input->post( 'telefono' );
						$usuario['id_perfil']   				= $this->input->post( 'id_perfil' );

						

						
						$usuario['id']							= $uid;
						$usuario 								= $this->security->xss_clean( $usuario );
						$guardar 									= $this->modelo_admin->edicion_usuario( $usuario );
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información del usuario no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">El <b>Correo electrónico</b> ya se encuentra asignado a una cuenta.</span>';
					}
				} else {
					echo '<span class="error">La <b>Contraseña</b> y la <b>Confirmación</b> no coinciden, verificalas.</span>';
				}
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}	
	

	function eliminar_usuario($uid = '', $nombrecompleto=''){

	if($this->session->userdata('session') === TRUE ){
		  $id_perfil=$this->session->userdata('id_perfil');

		  if ($uid=='') {
			  $uid= $this->session->userdata('id');
		  } else {
		  		$uid = base64_decode($uid);
		  }   
		  $data['nombrecompleto']   = base64_decode($nombrecompleto);
		  $data['uid']        = $uid;


		  switch ($id_perfil) {    
			case 1:
					  $this->load->view( 'admin/usuarios/eliminar_usuario', $data );                
			  break;
			case 2:
			case 3:					  
					  $this->load->view( 'admin/usuarios/eliminar_usuario', $data );

			  break;


			default:  
			  redirect('');
			  break;
		  }
		}
		else{ 
		  redirect('');
		}
		
	}


	function validar_eliminar_usuario(){
		
		$uid = $this->input->post( 'uid_retorno' ); 

		$eliminado = $this->modelo_admin->borrar_usuario(  $uid );
		if ( $eliminado !== FALSE ){
			echo TRUE;
		} else {
			echo '<span class="error">No se ha podido eliminar al usuario</span>';
		}
	}

	/////////////hasta aqui registro de usuario////////////	

	/////////////presentacion, filtro y paginador////////////	
	function dashboard_usuario(){ 
	if($this->session->userdata('session') === TRUE ){
		  $id_perfil=$this->session->userdata('id_perfil');

		  $data['nodefinido_todavia']        = '';
		  switch ($id_perfil) {    
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
				$this->load->view( 'admin/principal/dashboard_usuario',$data );
			  break;

			default:  
			  redirect('');
			  break;
		  }
		}
		else{ 
		  redirect('');
		}	

	}



	//recuperar constraseña
	function recuperar_contrasena(){
		$this->load->view('admin/recuperar_password');
	}
	
	
	function validar_recuperar_password(){
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');

		if ( $this->form_validation->run() == FALSE ){
			echo validation_errors('<span class="error">','</span>');
		} else {
				$data['email']		=	$this->input->post('email');
				$correo_enviar      =   $data['email'];
				$data 				= 	$this->security->xss_clean($data);  
				$usuario_check 		=   $this->modelo_admin->recuperar_contrasena($data);

				if ( $usuario_check != FALSE ){
						$data= $usuario_check[0]; 	
						$desde = $this->session->userdata('c1');
						$this->email->from($desde,$this->session->userdata('c2'));
						$this->email->to($correo_enviar);
						$this->email->subject('Recuperación de contraseña de '.$this->session->userdata('c2'));
						$this->email->message($this->load->view('admin/correos/envio_contrasena', $data, true));
						if ($this->email->send()) {
							echo TRUE;						
						} else 
							echo false;	
				} else {
					echo '<span class="error">Tus datos no son correctos, verificalos e intenta nuevamente por favor.</span>';
				}
		}
	}		




  public function historico_accesos(){

  
   $id_session = $this->session->userdata('id');
   //print_r($id_session);
   //die;

   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');


        $coleccion_id_operaciones= json_decode($this->session->userdata('coleccion_id_operaciones')); 
        if ( (count($coleccion_id_operaciones)==0) || (!($coleccion_id_operaciones)) ) {
              $coleccion_id_operaciones = array();
         }   

      //$html = $this->load->view( 'catalogos/colores',$data ,true);   
      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'admin/historico_accesos/historico_accesos');
          break;
        case 2:
        case 3:
        case 4:
             if  ( (in_array(8, $coleccion_id_operaciones))  || (in_array(13, $coleccion_id_operaciones))  )   { 
                $this->load->view( 'admin/historico_accesos/historico_accesos');
              }  else  {
                redirect('');
              } 
          break;


        default:  
          redirect('');
          break;
      }

    }    
    
  }


  public function procesando_historico_accesos(){

    $data=$_POST;
    $busqueda = $this->modelo_admin->historico_acceso($data);
    echo $busqueda;
  } 





////////////////////////////////////////////////////////////////
	//salida del sistema
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin');
	}	

/////////////////Buscador/////////////////////////////////////////	



public function listado_buscador(){

 

		$data['id_estatus']=1; //la primera vez son importaciones
		$data['paises']  = $this->modelo->pais(  $data );
		$data['id_pais']=$data['paises'][0]->id; //la primera vez es el primer pais
		//print_r( $data['paises'][0]->id ); die;
		$data['origen'] = $this->modelo->origen($data);
		//print_r( $data['origen'][0]->id ); die;
		$data['inicio']=$data['origen'][0]->id; 

		$data['destino'] = $this->modelo->destino($data);

		//$this->load->view( 'dashboard_principal', $data );

		$this->load->view( 'admin/catalogos/buscador');

        
    
  }


/////////////////Listado de catalogos/////////////////////////////////////////	


  
  public function listado_catalogos(){

  
   $id_session = $this->session->userdata('id');
   if ( $this->session->userdata('session') !== TRUE ) {

        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');


		$data['id_estatus']=1; //la primera vez son importaciones
		$data['paises']  = $this->modelo->pais(  $data );
		$data['id_pais']=$data['paises'][0]->id; //la primera vez es el primer pais
		//print_r( $data['paises'][0]->id ); die;
		$data['origen'] = $this->modelo->origen($data);
		//print_r( $data['origen'][0]->id ); die;
		$data['inicio']=$data['origen'][0]->id; 

		$data['destino'] = $this->modelo->destino($data);

		//$this->load->view( 'dashboard_principal', $data );



        $coleccion_id_operaciones= json_decode($this->session->userdata('coleccion_id_operaciones')); 
        if ( (count($coleccion_id_operaciones)==0) || (!($coleccion_id_operaciones)) ) {
              $coleccion_id_operaciones = array();
         }   
         //print_r($id_perfil); die;

      //$html = $this->load->view( 'catalogos/colores',$data ,true);   
      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'admin/catalogos/catalogos');
          break;
        case 2:
        case 3:
        case 4:
             if  ( (in_array(8, $coleccion_id_operaciones))  || (in_array(13, $coleccion_id_operaciones))  )   { 
                $this->load->view( 'admin/catalogos/catalogos');
              }  else  {
                redirect('');
              } 
          break;


        default:  
          redirect('');
          break;
      }

    }    
    
  }


  public function procesando_catalogos(){

    $data=$_POST;
    //$data['id_estatus'] = 1;
    $busqueda = $this->modelo_admin->buscador_catalogos($data);
    echo $busqueda;
  } 


function nuevo_catalogo($id_estatus){
	if($this->session->userdata('session') === TRUE ){

			$id_perfil=$this->session->userdata('id_perfil');
			$data['perfiles']   = $this->modelo_admin->coger_catalogo_perfiles();
			$data['id_estatus']= base64_decode($id_estatus); //la primera vez son importaciones
			$data['paises']  = $this->modelo_admin->paises(  $data );

		  switch ($id_perfil) {    
			case 1:
				  $this->load->view( 'admin/catalogos/nuevo_catalogo', $data );   
					
			  break;
			case 2:
			case 3:
					$this->load->view( 'admin/catalogos/nuevo_catalogo', $data );   
			  break;


			default:  
			  redirect('');
			  break;
		  }
		}
		else{ 
		  redirect('index');
		}    

	}

	function validar_nuevo_catalogo(){
		
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {
			
			$this->form_validation->set_rules( 'tarifa', 'tarifa', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'salidas', 'salidas', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'minimo', 'minimo', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'tt', 'tt', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'precio', 'precio', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 

	  //si el usuario no es un administrador entonces q sea obligatorio asociarlo a operaciones 
	  //Esto YA NO HACE FALTA


			if ( $this->form_validation->run() === TRUE ){
				
					$data['id']				=	$this->input->post('id');
					$data['id_estatus']				=	$this->input->post('id_estatus');
					$data['id_puerto']		=	$this->input->post('id_puerto');
					$data['id_puertoescala']		=	$this->input->post('id_puertoescala');
					$data['id_puertoescala2']		=	$this->input->post('id_puertoescala2');
					$data['id_destino']		=	$this->input->post('id_destino');

					$data['tarifa']		=	$this->input->post('tarifa');
					$data['salidas']		=	$this->input->post('salidas');
					$data['minimo']		=	$this->input->post('minimo');
					$data['tt']		=	$this->input->post('tt');
					$data['precio']		=	$this->input->post('precio');


					$data 				= 	$this->security->xss_clean($data);  
					
					$validar_catalogo = $this->modelo_admin->validar_catalogo($data);
					if ( $validar_catalogo){
						
						$data 										= $this->security->xss_clean( $data );
						$guardar 									= $this->modelo_admin->nuevo_catalogo( $data );
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información  no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">Ya a se encuentra asignado.</span>';
					}
				
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}		

//edicion del especialista o el perfil del especialista o administrador activo


	//edicion del especialista o el perfil del especialista o administrador activo
	function editar_catalogo( $uid ,$id_estatus ){

	    $id=$this->session->userdata('id');
  		$data['id'] = base64_decode($uid);
  			  $uid  = $data['id'];
		$id_perfil=$this->session->userdata('id_perfil');
		
		$data['id_estatus']= base64_decode($id_estatus); //la primera vez son importaciones
		$data['paises']  = $this->modelo_admin->paises(  $data );


		$data['catalogo'] = $this->modelo_admin->get_catalogo( $data );
		//print_r($data['catalogo']); die;

		 switch ($id_perfil) {    
			case 1:
				  $this->load->view('admin/catalogos/editar_catalogo',$data);  
					
			  break;
			case 2:
			case 3:
					$this->load->view('admin/catalogos/editar_catalogo',$data);  
			  break;


			default:  
			  redirect('');
			  break;
		  }


	}


	
	function validacion_edicion_catalogo(){
		
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {
			
			$this->form_validation->set_rules( 'tarifa', 'tarifa', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'salidas', 'salidas', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'minimo', 'minimo', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'tt', 'tt', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'precio', 'precio', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 

	  //si el usuario no es un administrador entonces q sea obligatorio asociarlo a operaciones 
	  //Esto YA NO HACE FALTA


			if ( $this->form_validation->run() === TRUE ){
				
					$data['id']				=	$this->input->post('id');
					$data['id_estatus']				=	$this->input->post('id_estatus');
					$data['id_puerto']		=	$this->input->post('id_puerto');
					$data['id_puertoescala']		=	$this->input->post('id_puertoescala');
					$data['id_puertoescala2']		=	$this->input->post('id_puertoescala2');
					$data['id_destino']		=	$this->input->post('id_destino');

					$data['tarifa']		=	$this->input->post('tarifa');
					$data['salidas']		=	$this->input->post('salidas');
					$data['minimo']		=	$this->input->post('minimo');
					$data['tt']		=	$this->input->post('tt');
					$data['precio']		=	$this->input->post('precio');


					$data 				= 	$this->security->xss_clean($data);  
					//$login_check = $this->modelo_admin->check_usuario_existente($data);
					//if ( $login_check === TRUE ){
					if ( TRUE ){

						
						$data 										= $this->security->xss_clean( $data );
						$guardar 									= $this->modelo_admin->edicion_catalogo( $data );
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información  no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">Ya a se encuentra asignado.</span>';
					}
				
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}	


/////////////////Puerto/////////////////////////////////////////	


  public function listado_puertos(){

  
   $id_session = $this->session->userdata('id');
   if ( $this->session->userdata('session') !== TRUE ) {

        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');


		$data['id_estatus']=1; //la primera vez son importaciones
		$data['paises']  = $this->modelo->pais(  $data );
		$data['id_pais']=$data['paises'][0]->id; //la primera vez es el primer pais
		//print_r( $data['paises'][0]->id ); die;
		$data['origen'] = $this->modelo->origen($data);
		//print_r( $data['origen'][0]->id ); die;
		$data['inicio']=$data['origen'][0]->id; 

		$data['destino'] = $this->modelo->destino($data);

		//$this->load->view( 'dashboard_principal', $data );



        $coleccion_id_operaciones= json_decode($this->session->userdata('coleccion_id_operaciones')); 
        if ( (count($coleccion_id_operaciones)==0) || (!($coleccion_id_operaciones)) ) {
              $coleccion_id_operaciones = array();
         }   
         //print_r($id_perfil); die;

      //$html = $this->load->view( 'puertos/colores',$data ,true);   
      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'admin/catalogos/puertos/puertos');
          break;
        case 2:
        case 3:
        case 4:
             if  ( (in_array(8, $coleccion_id_operaciones))  || (in_array(13, $coleccion_id_operaciones))  )   { 
                $this->load->view( 'admin/catalogos/puertos/puertos');
              }  else  {
                redirect('');
              } 
          break;


        default:  
          redirect('');
          break;
      }

    }    
    
  }


  public function procesando_puertos(){
    $data=$_POST;
    $busqueda = $this->modelo_admin->buscador_puertos($data);
    echo $busqueda;
  } 

	function nuevo_puerto(){
		if($this->session->userdata('session') === TRUE ){

				$id_perfil=$this->session->userdata('id_perfil');
				$data['aa']=2;
			  switch ($id_perfil) {    
				case 1:
					  $this->load->view( 'admin/catalogos/puertos/nuevo_puerto', $data );   
				  break;
				case 2:
				case 3:
						$this->load->view( 'admin/catalogos/puertos/nuevo_puerto', $data );   
				  break;
				default:  
				  redirect('');
				  break;
			  }
			}
			else{ 
			  redirect('index');
			}    

	}

			



			
					

					

	function validar_nuevo_puerto(){
		
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {
			
			$this->form_validation->set_rules( 'puerto', 'puerto', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'city', 'ciudad', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'lat', 'latitud', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'lng', 'longitud', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'country', 'país', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 


			if ( $this->form_validation->run() === TRUE ){
				
					$data['puerto']		=	$this->input->post('puerto');
					$data['city']		=	$this->input->post('city');
					$data['lat']		=	$this->input->post('lat');
					$data['lng']		=	$this->input->post('lng');
					$data['country']	=	$this->input->post('country');


					
					$data 				= 	$this->security->xss_clean($data);  
					
					//$validar_puerto = $this->modelo_admin->validar_puerto($data);
					if ( true){
						
						$data 										= $this->security->xss_clean( $data );
						$guardar 									= $this->modelo_admin->nuevo_puerto( $data );
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información  no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">Ya a se encuentra asignado.</span>';
					}
				
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}		



	//edicion del especialista o el perfil del especialista o administrador activo
	function editar_puerto( $uid  ){

	    $id=$this->session->userdata('id');
  		$data['id'] = base64_decode($uid);
  			  //$uid  = $data['id'];
		$id_perfil=$this->session->userdata('id_perfil');

		$data['catalogo'] = $this->modelo_admin->get_puerto( $data );
		//print_r($data['puerto']); die;

		 switch ($id_perfil) {    
			case 1:
				  $this->load->view('admin/catalogos/puertos/editar_puerto',$data);  
					
			  break;
			case 2:
			case 3:
					$this->load->view('admin/catalogos/puertos/editar_puerto',$data);  
			  break;


			default:  
			  redirect('');
			  break;
		  }


	}


	
	function validacion_edicion_puerto(){
		
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {
			
			$this->form_validation->set_rules( 'puerto', 'puerto', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'city', 'ciudad', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'lat', 'latitud', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'lng', 'longitud', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 
			$this->form_validation->set_rules( 'country', 'país', 'trim|required|min_length[3]|max_lenght[180]|xss_clean'); 

	  //si el usuario no es un administrador entonces q sea obligatorio asociarlo a operaciones 
	  //Esto YA NO HACE FALTA


			if ( $this->form_validation->run() === TRUE ){
				
					$data['id']			=	$this->input->post('id');
					
					$data['puerto']		=	$this->input->post('puerto');
					$data['city']		=	$this->input->post('city');
					$data['lat']		=	$this->input->post('lat');
					$data['lng']		=	$this->input->post('lng');
					$data['country']	=	$this->input->post('country');

					$data 				= 	$this->security->xss_clean($data);  
					//$login_check = $this->modelo_admin->check_usuario_existente($data);
					//if ( $login_check === TRUE ){
					if ( TRUE ){

						
						$data 										= $this->security->xss_clean( $data );
						$guardar 									= $this->modelo_admin->edicion_puerto( $data );
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información  no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">Ya a se encuentra asignado.</span>';
					}
				
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}		
	
/////////////////validaciones/////////////////////////////////////////	


	public function valid_cero($str)
	{
		return (  preg_match("/^(0)$/ix", $str)) ? FALSE : TRUE;
	}

	function nombre_valido( $str ){
		 $regex = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{2,60})$/i";
		//if ( ! preg_match( '/^[A-Za-zÁÉÍÓÚáéíóúÑñ \s]/', $str ) ){
		if ( ! preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'nombre_valido','<b class="requerido">*</b> La información introducida en <b>%s</b> no es válida.' );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_phone( $str ){
		if ( $str ) {
			if ( ! preg_match( '/\([0-9]\)| |[0-9]/', $str ) ){
				$this->form_validation->set_message( 'valid_phone', '<b class="requerido">*</b> El <b>%s</b> no tiene un formato válido.' );
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function valid_option( $str ){
		if ($str == 0) {
			$this->form_validation->set_message('valid_option', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_date( $str ){

		$arr = explode('-', $str);
		if ( count($arr) == 3 ){
			$d = $arr[0];
			$m = $arr[1];
			$y = $arr[2];
			if ( is_numeric( $m ) && is_numeric( $d ) && is_numeric( $y ) ){
				return checkdate($m, $d, $y);
			} else {
				$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.');
				return FALSE;
			}
		} else {
			$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD/MM/YYYY.');
			return FALSE;
		}
	}

	public function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	////Agregado por implementacion de registro insitu para evento/////
	public function opcion_valida( $str ){
		if ( $str == '0' ){
			$this->form_validation->set_message('opcion_valida',"<b class='requerido'>*</b>  Selección <b>%s</b>.");
			return FALSE;
		} else {
			return TRUE;
		}
	}


}

/* End of file main.php */
/* Location: ./app/controllers/main.php */