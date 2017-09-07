<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Combine extends MY_Controller {

    var $data;

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','recaptcha'));
		$this->load->helper(array('url','form'));

		$this->load->library('Upload');

		/*$this->config->item('use_mongodb', 'ion_auth') ?
		$this->load->library('mongo_db') :
		$this->load->database();*/
                
                $this->load->model('member/member_model','member_model');
                $this->load->model('combine_model');

                $this->load->model('MY_Model');
                
		$this->load->helper('language');

		$this->template_member = 'template/adminlte/template';
                $this->template_login = 'template/login/template';
		
		$this->output->set_header("HTTP/1.0 200 OK");
		$this->output->set_header("HTTP/1.1 200 OK");
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: ".gmdate('D, d M Y H:i:s')." GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache"); 
                   
                $this->data = array(
                             'user' => $this->session->userdata('userName'),
                            );
	}

	 /// view Form ///

        function index()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            
            $data['active_bar']  = 'Members';
            $data['active_menu'] = 'Combine';
            $data['title'] = 'Ambil Data Counter';

            show('combine/form', $data ,$this->template_member);
        }
        
          
        function combine_data() {
                //echo "<div id='load'></div>";
		if(strtolower($_SERVER["REQUEST_METHOD"])=="post"){
			$arrdata = $this->combine_model->combine_data();
			$data['msg'] = $arrdata;
                       // echo $msg->msg;
                        show('combine/form', $data ,$this->template_member);
		}
	}
        
}

	
