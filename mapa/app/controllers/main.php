<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){ 
		parent::__construct();
		$this->load->model('modelo', 'modelo'); 

	}

	public function dashboard_principal(){
		
		$data['id_estatus']=1; //la primera vez son importaciones
		$data['paises']  = $this->modelo->pais(  $data );
		$data['id_pais']=$data['paises'][0]->id; //la primera vez es el primer pais
		//print_r( $data['paises'][0]->id ); die;
		$data['origen'] = $this->modelo->origen($data);
		//print_r( $data['origen'][0]->id ); die;
		$data['inicio']=$data['origen'][0]->id; 

		$data['destino'] = $this->modelo->destino($data);

		$this->load->view( 'dashboard_principal', $data );
	}


	public function recopilar_datos(){
		   $data['id_estatus']= (int)$this->input->post('id_estatus');
			 $data['id_pais'] =  (int) $this->input->post('id_pais');
			  $data['inicio'] =  (int) $this->input->post('inicio');
			     $data['fin'] =  (int) $this->input->post('fin');

		$data['origen'] = $this->modelo->origen_pto($data);
		$data['destino'] = $this->modelo->destino_pto($data);
		
		$arreglo=array();
		if ($data['id_estatus']==1) {  //cambiar el orden
			$arreglo[] = $data['origen'][0];
			$arreglo[] = $data['destino'][0];
		} else {
			$arreglo[] = $data['destino'][0];
			$arreglo[] = $data['origen'][0];
		}
		echo   json_encode($arreglo);		
		
	}




	function cargar_dependencia(){
    
	    $data['campo']        = $this->input->post('campo');
	    $data['dependencia']        = $this->input->post('dependencia');

	    $data['id_estatus']        = $this->input->post('val_estatus');
	    $data['id_pais']        	= $this->input->post('val_pais');
	    $data['inicio']         = $this->input->post('val_inicio');
	    $data['fin']        	= $this->input->post('val_fin');
	    


	    switch ($data['dependencia']) {
	        case "id_estatus": //nunca será una dependencia
	            $elementos  = json_decode('[{"id":"1","nombre":"Importación"}, {"id":"2","nombre":"Exportación"}]'); 
	            break;
	        case "pais":
	            $elementos  = $this->modelo->pais(  $data );
	            break;

	        case "inicio":
	            $elementos  = $this->modelo->origen(  $data );
	            break;
	        case "fin":
	            $elementos  = $this->modelo->destino(  $data );
	            break;
	        default:
	    }


	    $variables = array();
	    if ($elementos != false)  {     
	         foreach( (json_decode(json_encode($elementos))) as $clave =>$valor ) {
	            
	              array_push($variables,array('identificador' => $valor->id, 'nombre' => $valor->nombre ));  
	            
	         }
	    }  
		
     	echo json_encode($variables);


	   

  }




}

/* End of file main.php */
/* Location: ./app/controllers/main.php */