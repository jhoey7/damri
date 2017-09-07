<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AR_Controller extends CI_Controller {
	protected $input_data;
	protected $temporary_data;
	protected $data;
	protected $controller_name;
	protected $module_name;
	protected $function_name;

	public function __construct(){
		
		parent::__construct();

		if($_POST){
			$this->input_data = $this->input->post();
		}	
		else if($_GET){
			$this->input_data = $this->input->get();
		}

		
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */