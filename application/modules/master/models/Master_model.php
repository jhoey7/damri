<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Master_model extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');
	}
        
        public function getMaxId()
        {
            
        }
}
