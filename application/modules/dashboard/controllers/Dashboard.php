<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 var $data;
	function __construct()
	{
			parent::__construct();
	$this->load->library('form_validation');
        $this->load->library('Ajax_pagination');
	$this->load->helper(array('url','form'));


	$this->config->item('use_mongodb', 'ion_auth') ?
	$this->load->library('mongo_db') :
	$this->load->database();
        $this->load->model('member/member_model');
        $this->load->model('master/master_model');

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
              
        }

	 //redirect if needed, otherwise display the user list
	function index()
	{

	    $user= $this->session->userdata('identity');
            $id=$this->session->userdata('user_id');
            $data = $this->data;
            $data['active_bar']  = 'dashboard';
            $data['active_menu'] = 'dashboard';
            /*$data['count_spsab'] = $this->transactions_model->count_spsab();
            $data['count_ap1'] = $this->transactions_model->count_ap1();
            $data['ct_valid_ap2'] = $this->transactions_model->ct_valid_ap2();
            $data['count_ap2'] = $this->transactions_model->count_ap2();*/
           

            show('dashboard/index', $data ,$this->template_member);
	}


}
