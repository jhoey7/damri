<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Member_model extends MY_Model
{

  //var $table = 'users';
	var $column = array('first_name','last_name','address','phone','birthday','seller_rating','buyer_rating');
	var $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');
	}
        
        public function getMaster($table,$value,$sort)
        {
               $this->db->select('*');
               $this->db->from($table);
               $this->db->where("deleted_at is null");
               $this->db->order_by($value,$sort);
               $query=$this->db->get();
               
               return $query;
        }
        
        public function getMasterFilter($table,$arrCond,$value,$sort)
        {
               $this->db->select('*');
               $this->db->from($table);
               $this->db->where($arrCond);
               $this->db->where("deleted_at is null");
               $this->db->order_by($value,$sort);
               $query=$this->db->get();
               
               return $query;
        }
        
        public function get_Master_By_Id($table,$arrCond,$value_return)
        {
               $this->db->select('*');
               $this->db->from($table);
               $this->db->where($arrCond);
               $query=$this->db->get();

               if($value_return != "")
               {
                   foreach($query->result_array() as $row)
                   {
                       return $row[$value_return];
                   }
               }
               else
               {
                return $query->row();
               }

        }
        
        public function getMasterCity($id)
        {
          $this->db->select('*');
          $this->db->from('master_kokab');
        	$this->db->where('provinsi_id',$id);
        	$this->db->order_by('name','asc');
        	$sql_city=$this->db->get();

          return $sql_city;
      	}
        
        public function getUserPass($id)
        {
               $this->db->select('password');
               $this->db->from('user');
               $this->db->where('username',$id);
               $query=$this->db->get();
               
               foreach($query->result_array() as $row)
               {
                   return $row['password'];
               }
        }
        
        public function getmemberById($id)
        {
	$strsql="   SELECT a.*, b.name AS kota, c.name AS prov 
                    FROM users a LEFT JOIN master_kokab b ON a.kota=b.id
                    LEFT JOIN master_provinsi c ON a.provinsi=c.id
                    WHERE a.id='$id' ";
	$query=$this->db->query($strsql);

        return $query;
      
        }
        
	  public function getmemberByUsername($id)
          {
              $query = $this->db->get_where('users', array('username' => $id));
              return $query;
          }
          
          public function getmemberByName($id)
          {
               $strsql="SELECT CONCAT(first_name,' ',last_name) AS nama 
                        FROM users 
                        WHERE id='$id'";
               $query=$this->db->query($strsql);
               foreach($query->result_array() as $row)
               {
                   return $row['nama'];
               }
          }
          
          public function getmember()
          {
              //$this->db->limit(9);
              $this->db->order_by("id", "desc");
              $query = $this->db->get_where('users', array('active' => '1', 'id !=' => $this->session->userdata('user_id')));
              return $query;
          }
          
          public function getmember_lookup($keyword)
          {
		$strsql="SELECT id, CONCAT_WS(' ', first_name, last_name)as name, address FROM users
                        WHERE  active='1' AND (CONCAT_WS(' ', first_name, last_name) LIKE '%$keyword%') AND id != {$this->session->userdata('user_id')}
                        ORDER BY first_name ASC";
                        
                
                /*$strsql= "SELECT id,CONCAT_WS(' ', first_name,last_name) AS whole_name FROM users
                         WHERE CONCAT_WS(' ', first_name, last_name) LIKE '%$keyword%' AND active='1'  AND id != {$this->session->userdata('user_id')}"
                        . "ORDER BY first_name ASC";*/
		$query=$this->db->query($strsql);
		return $query;	

          }
          

          function get_notif($id)
          {
            $strsql = " SELECT id, notification, url, created_at FROM notification WHERE id_to='$id' order by id desc limit 25 ";

             $query=$this->db->query($strsql);

             return $query;
          }

        function get_notif_count($id)
          {
            $strsql = "  SELECT count(id) as ttl FROM notification WHERE id_to='$id' AND status=0 GROUP BY id_to";

             $query=$this->db->query($strsql);

            foreach($query->result_array() as $r)
             {
              return $r['ttl'];
             }
          }
          
        function getRows($params = array())
            {
                $this->db->order_by('id','desc');

                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }

                $query=$this->db->get_where('users', array('active' => '1', 'id !=' => $this->session->userdata('user_id')));

                return ($query->num_rows() > 0)?$query->result_array():FALSE;
            }

          function get_notification($params = array())
          {
                $this->db->order_by('id','desc');

                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }

                $query=$this->db->get_where('notification', array('id_to =' => $this->session->userdata('user_id')));

                return ($query->num_rows() > 0)?$query->result_array():FALSE;
          }
    
          function get()
        	 {
          		$query = $this -> db -> query("select * from `users` where userActive = 1 ");
              
          		if ($query -> num_rows() > 0)
          		{
          			return $query -> result_array();
          		}
          		else
          		{
          			return 0;
          		}
        	}
        
              
      	function get_by_name($user_name)
      	{
                     $this->db->select('*');
                     $this->db->from('users');
                     $this->db->where('username',$user_name);
                     $query=$this->db->get();
                     
      		if ($query -> num_rows() > 0)
      		{
      			return $query -> row_array();
      		}
      		else
      		{
      			return 0;
      		}

      	}
        
          function get_table($table,$field,$id)
          {
            $strsql = "SELECT * FROM $table WHERE $field='$id' ";
            $query=$this->db->query($strsql);

            return $query->row();
          }
       
       function gettrayek()
       {
            $strsql="SELECT a.*, b.nama_pool, c.nama_grup
FROM trayek a LEFT JOIN pool b ON a.id_pool=b.id_pool
LEFT JOIN pool_grup c ON a.id_group=c.id_grup 
WHERE a.deleted_at IS NULL";
	       $query=$this->db->query($strsql);
             return $query;   
       }
       
       function get_detail_message($id)
       {
       $strsql = " SELECT a.id, a.id_user_from, CONCAT(b.first_name,' ',b.last_name) AS pengirim, CONCAT(c.first_name,' ',c.last_name) AS penerima, a.id_user_to, a.subject, a.message, a.read_status, a.created_at 
                    FROM message a LEFT JOIN users b ON a.id_user_from=b.id
                    LEFT JOIN users c ON a.id_user_to=c.id
                    WHERE a.id='$id'
                   ORDER BY a.id DESC";
      	$query=$this->db->query($strsql);

        return $query->row();
        }


        public function check_member($id)
        {
               $this->db->select('id');
               $this->db->from('users');
               $this->db->where('id',$id);
               $query=$this->db->get();
               
           return $query -> num_rows(); 
        }
        
        public function getcode($code,$table,$where_value)
        {
          $strsql = "SELECT code FROM $table
              WHERE $where_value='$code'";
          $query = $this->db->query($strsql);
          $row = $query->num_rows();

          return $row; 
        }
        //// Data Tables Model /////
        
        private function _get_datatables_query()
      	{
      		
      		$this->db->from($this->table);

      		$i = 0;
      	
      		foreach ($this->column as $item) 
      		{
      			if($_POST['search']['value'])
      				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
      			$column[$i] = $item;
      			$i++;
      		}
      		
      		if(isset($_POST['order']))
      		{
      			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      		} 
      		else if(isset($this->order))
      		{
      			$order = $this->order;
      			$this->db->order_by(key($order), $order[key($order)]);
      		}
      	}

      	function get_datatables()
      	{
      		$this->_get_datatables_query();
      		if($_POST['length'] != -1)
      		$this->db->limit($_POST['length'], $_POST['start']);
      		$query = $this->db->get();
      		return $query->result();
      	}

      	function count_filtered()
      	{
      		$this->_get_datatables_query();
      		$query = $this->db->get();
      		return $query->num_rows();
      	}

      	public function count_all()
      	{
      		$this->db->from($this->table);
      		return $this->db->count_all_results();
      	}

      	public function get_by_id($id)
      	{
      		$this->db->from($this->table);
      		$this->db->where('id',$id);
      		$query = $this->db->get();

      		return $query->row();
      	}
 

  public function update_data($table,$where, $data)
  {
          $this->db->update($table, $data, $where);
          return $this->db->affected_rows();
  }
        
  public function tgl_str($date)
	{
		$exp = explode('-',$date);
		if(count($exp) >= 3) {
		$thn = $exp[0];
		$bln = $exp[1];
		$tgl = $exp[2];
		$bulan = $this->getbln($bln);
		
		$date = $tgl.' '.$bulan.' '.$thn; 
		}
		return $date;
	}
        
         public function getdate($date)
	{
		$exp = explode('-',$date);
		if(count($exp) >= 3) {
		$thn = substr($exp[0], 2);
                
		$bln = $exp[1];
		$tgl = $exp[2];
		$date_string = $thn.$bln.$tgl;
		}
		return $date_string;
	}
        
  public function getbln($bulan)
	{
		//$bulan = substr($tgl,5,2);

		switch ($bulan)
		{
		case 1: return "Januari"; break;
		case 2: return "Februari"; break;
		case 3: return "Maret"; break;
		case 4: return "April"; break;
		case 5: return "Mei"; break;
		case 6: return "Juni"; break;
		case 7: return "Juli"; break;
		case 8: return "Agustus"; break;
		case 9: return "September";break;
		case 10: return "Oktober"; break;
		case 11: return "November"; break;
		case 12: return "Desember"; break;
		}
	}
        
          public function tgl_str_2($date)
	{
		$exp = explode('-',$date);
		if(count($exp) >= 3) {
		$thn = $exp[0];
		$bln = $exp[1];
		$tgl = $exp[2];
		//$bulan = $this->getbln($bln);
		
		$date = $thn.'-'.$bln.'-'.$tgl; 
		}
		return $date;
	}

        public function getblnrom($bulan)
	{
		//$bulan = substr($tgl,5,2);

		switch ($bulan)
		{
		case 1: return "I"; break;
		case 2: return "II"; break;
		case 3: return "III"; break;
		case 4: return "IV"; break;
		case 5: return "V"; break;
		case 6: return "VI"; break;
		case 7: return "VII"; break;
		case 8: return "VIII"; break;
		case 9: return "IX";break;
		case 10: return "X"; break;
		case 11: return "XI"; break;
		case 12: return "XII"; break;
		}
	}
        
}
