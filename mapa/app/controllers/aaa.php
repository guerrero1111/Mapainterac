<?
  
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

