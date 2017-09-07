<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Account_model extends CI_Model
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
     
        public function Check_TblUsers($field,$id)
        {
               $this->db->select($field);
               $this->db->from('users');
               $this->db->where($field,$id);
               $query=$this->db->get();
               
	         return $query -> num_rows(); 
		}
        
        public function Check_Password($pass)
        {
               $this->db->select('password');
               $this->db->from('users');
               $this->db->where('password',$pass);
               $query=$this->db->get();
               
	       return $query -> num_rows(); 
	}      
}
