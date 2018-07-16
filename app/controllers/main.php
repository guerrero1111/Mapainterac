<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){ 
		parent::__construct();

	}

	public function dashboard_principal(){

		$data['aa']='ad';
		$this->load->view( 'dashboard_principal', $data );
		
		
	}


}

/* End of file main.php */
/* Location: ./app/controllers/main.php */