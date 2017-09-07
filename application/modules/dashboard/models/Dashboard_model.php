<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard_model extends CI_Model
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
     
        public function getRecent()
        {
            $date = date('Y-M-D');
            
               $this->db->select('count(id) as CR');
               $this->db->from('payment_confirmation');
               $this->db->where('created_at',$date);
               $query=$this->db->get();
               
	         return $query;
	}
        
        public function getNewMember()
        {
            $date = date('Y-M-D');
            
               $this->db->select('COUNT(id) AS c_nm');
               $this->db->from('users');
               //this->db->where('created_at',$date);
               $query=$this->db->get();
               
	         return $query;
	}
        
    
}
