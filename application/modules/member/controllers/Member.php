<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

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
        $this->load->model('member_model');
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
                $this->data = array(
                     'user' => $this->session->userdata('userName')
                     //'notif_q' => $this->member_model->get_notif($this->session->userdata('user_id')),
                    // 'notif' => $this->member_model->get_notif_count($this->session->userdata('user_id')));
                        );
                             
	}

	 //redirect if needed, otherwise display the user list


	public function report()
	{
            $data = $this->data;
	    //$this->data['datas'] = array();
			
        show('member/report', $this->data ,$this->template_member);
	}
	
        function AddUser()
        {
            $data['active_bar']  = 'Members';
            $data['active_menu'] = 'Tambah User';
            $data['active_submenu'] = '';
            $data['title'] = 'Add User';
            $arrcond = "deleted_at IS NULL AND level IS NOT NULL";
            $data['query'] = $this->member_model->getMasterFilter('users',$arrcond,'id','desc');
            
            $data['tr'] = $this->member_model->getMasterFilter('terminal','deleted_at IS NULL','id_terminal','desc');
            show('member/add_user', $data ,$this->template_member);
        }
       
         function SaveUser()
        {
            $fn = $this->input->post('first_name'); 
            $ln = $this->input->post('last_name'); 
            $email = $this->input->post('email'); 
            $username = $this->input->post('identity'); 
            $pwd = $this->input->post('password'); 
            $confirm_pwd = $this->input->post('confirmPassword'); 
            $level = $this->input->post('level'); 
            $ip = $this->get_client_ip();
            $salt       =  FALSE;
            $password   = md5($pwd);

            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
            $this->form_validation->set_rules('identity', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]{0,}).{8,}$/]|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirmPassword]');
            $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required');
            $this->form_validation->set_rules('level', 'User Level', 'required');
            
            if ($this->form_validation->run() == true)
            {
                $data = array(
    					'ip_address' => $ip,
    					'username' => $username,
                                        'password' => $password,
                                        'salt' => $salt,
    					'email' => $email,				
    					'active' => '1',
    					'created_on' => date('Y-m-d'),
                                        'last_login' => date('Y-m-d'),
    					'first_name' => $fn,
                                        'last_name' => $ln,
                                        'status' => $level,
                                        'flag_del' => FALSE
    				);
    			
                 $insert = $this->MY_Model->insert('users',$data,$log = 1);
            }
            
                if ($insert)
                {
                    $this->session->set_flashdata('message', 'Register Success');
                }

                else 
                {
                    $this->session->set_flashdata('message', 'Register Failed');
                }
            
                redirect ('member/AddUser','refresh');
            
            
           /*  $email_member = $this->member_model->get_Master_By_Id("users","id=".$id,"email");
             $subject = "Payment Gateway - Top Up Request Confirm Code"; 
             $message = $this->load->view('email/top_up_code',$data,TRUE);

             $email = $this->sendMail($email_member,$subject,$message);*/
        }
        
        function delete_user()
        {
           $id=$this->uri->segment(3);
            
            $data_update = array(
                            	'active' => '0'
                                 );
            $update2 = $this->MY_Model->updateRow($data_update,'users',$id,"id",$log = 0);
            
           $this->MY_Model->DeleteRow("users",$id,"id",$log = 0);
           redirect('member/AddUser');
        }
        
        function profile()
        {
            $id= $this->session->userdata('identity'); 
            $data = $this->data;
            $data['active_bar']  = 'Members';
            $data['active_menu'] = 'Profile';
            $data['title'] = 'Account Information';
	    $data['datas'] = array();
            $query = $this->member_model->getMemberByUsername($id) ;
            foreach ($query->result_array() as $r) {
                $data['first_name']=$r['first_name'];
                $data['last_name']=$r['last_name'];
                $data['email']=$r['email'];
                $data['username']=$r['username'];
            }

            $data['id'] = $this->session->userdata('user_id');

            $data['notif'] = '';

            show('member/profile', $data ,$this->template_member);
        }
        
        function edit()
        {
            $id= $this->session->userdata('identity'); 
            $data = $this->data;
            $data['active_bar']  = 'Members';
            $data['active_menu'] = 'Profile';
            $data['active_submenu'] = 'Edit Profile';
            $data['title'] = 'Change Account Information';
	        $data['datas'] = array();
            $query = $this->member_model->getMemberByUsername($id) ;
            foreach ($query->result_array() as $r) {
                $data['first_name']=$r['first_name'];
                $data['last_name']=$r['last_name'];
                $data['email']=$r['email'];
                $data['username']=$r['username'];
            }
            $data['id'] = $this->session->userdata('user_id');
           
            $data['notif'] = '';

            show('member/edit_profile', $data ,$this->template_member);
        }

        function setting()
        {
            $data['active_bar']  = 'Members';
            $data['active_menu'] = 'Setting';
            $data['active_submenu'] = '';
            $data['title'] = 'SETTING PERANGKAT';
            $arrcond = "deleted_at IS NULL";
            $query = $this->member_model->getMasterFilter('company',$arrcond,'id_comp','desc');
            foreach($query->result_array() as $r)
            {
                $data['id_comp'] = $r['id_comp'];
                $data['comp'] = $r['nama_comp'];
                $data['addr'] = $r['address1'];
                $data['tlp'] = $r['telp'];
                $data['fax'] = $r['fax'];
                $data['trmn'] = $r['id_terminal'];
                $data['counter'] = $r['id_counter'];
            }
            
            $data['tr'] = $this->member_model->getMasterFilter('terminal','deleted_at IS NULL','id_terminal','desc');
            show('member/setting', $data ,$this->template_member);
        }
        
        function setting_edit()
        {
            $id = $this->input->post('id_comp');
            $name = $this->input->post('name_comp');
            $addr = $this->input->post('address1');
            $tlp = $this->input->post('telp');
            $fax = $this->input->post('fax');
            $terminal = $this->input->post('terminal');
            $counter = $this->input->post('counter');
            
            $data = array(
                                                            'nama_comp' => $name,
                                                            'address1' => $addr,
                                                            'tel' => $tlp,
                                                            'fax' => $fax,
                                                            'id_terminal' => $terminal,
                                                            'id_counter' => $counter,
                                                             );
            
            $update = $this->MY_Model->updateRow($data,'company',$id,"id_comp",$log = 0);
            $this->session->set_flashdata('message', 'Setting Berhasil Dirubah');
            redirect('member/setting');
        }
        
        
        function change_profile()
        {
            $table = 'users';
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');

            $code = $this->input->post('code');   

            $row = $this->transactions_model->getcode($code,$table);
            if($code)
            {
                if($row > 0)
                {
                    $where = "id='".$id."'"; 
                    $data = array(
                                        'code' => '0'
                                       );
                    $update = $this->member_model->update_data($table,$where,$data);

                    $tables = "notification";
            
                    $data = array(
                                        'notif_type' => 1,
                                        'notification' => 'You Changed your Profile',
                                        'status' => '0',
                                        'id_from' => $id,
                                        'id_to' => $id
                     );
                     $insert =$this->MY_Model->insert($table,$data,$log = 1);


                        $data = $this->data; 
                        $data['first_name'] = $this->input->post('first_name');
                        $data['last_name']  = $this->input->post('last_name');
                        $data['birthday']   = $this->input->post('bday');
                        $data['address']    = $this->input->post('address');
                        $data['provinsi']   = $this->input->post('province');
                        $data['kota']       = $this->input->post('city');
                        $data['phone']      = $this->input->post('phone');

                        $data['url'] = 'index.php/auth/edit_user';
                        $data = $this->data;

                        redirect('auth/edit_user',$data,TRUE);
                }
                else
                {
                    $data = $this->data; 
                    $data['first_name'] = $this->input->post('first_name');
                    $data['last_name']  = $this->input->post('last_name');
                    $data['birthday']   = $this->input->post('bday');
                    $data['address']    = $this->input->post('address');
                    $data['provinsi']   = $this->input->post('province');
                    $data['kota']       = $this->input->post('city');
                    $data['phone']      = $this->input->post('phone');

                    $data['notif'] = "Wrong code! Please enter the correct one";
                    $data['callout'] = "callout callout-danger";                                              
                    $data['active_bar']  = 'Members';
                    $data['active_menu'] = 'Profile';
                    $data['active_submenu'] = 'Edit Profile';
                    $data['title'] = 'Change Account Confirmation Code';
                    $data['url'] = 'index.php/member/change_profile';

                     
                    show('member/confirm_code', $data ,$this->template_member);

                }
            }
            else
            {
                    $data['user'] = $user;
                    $data['code'] = $this->generateRandomString();
                    $code = $data['code'];

                    $email_member = $this->member_model->get_Master_By_Id("users","id=".$id,"email");
                    $subject = "Payment Gateway - Change Profile Confirm Code"; 
                    $message = $this->load->view('email/edit_profile_code',$data,TRUE);

                    $where = "id='".$id."'"; 
                    $data = array(
                                        'code' => $code
                                       );
                    $update = $this->member_model->update_data($table,$where,$data);

                    $email = $this->sendMail($email_member,$subject,$message);

                    $data = $this->data; 
                    $data['first_name'] = $this->input->post('first_name');
                    $data['last_name']  = $this->input->post('last_name');
                    $data['birthday']   = $this->input->post('bday');
                    $data['address']    = $this->input->post('address');
                    $data['provinsi']   = $this->input->post('province');
                    $data['kota']       = $this->input->post('city');
                    $data['phone']      = $this->input->post('phone');
                                            
                    $data['active_bar']  = 'Members';
                    $data['active_menu'] = 'Profile';
                    $data['active_submenu'] = 'Edit Profile';
                    $data['title'] = 'Change Account Confirmation Code';
                    $data['notif'] = "Your Code Has Been Sucessfully Sent to Your Email"; 
                    $data['callout'] = "callout callout-success";  
                    $data['url'] = 'index.php/member/change_profile';
                     
                    show('member/confirm_code', $data ,$this->template_member);
            }
                
        }
        
        function edit_user()
        {
            

                $id = $this->session->userdata('user_id');
                
                /*$username='marita';
                $up['fullname']=$this->input->post('full_name');
                $up['address']=$this->input->post('address');
                $up['provinsi']=$this->input->post('provinsi');
                $up['kota']=$this->input->post('kota');
                $up['mobile']=$this->input->post('phone');*/

                $up['first_name'] = $this->input->post('first_name');
                $up['last_name']  = $this->input->post('last_name');
                $up['company']    = $this->input->post('company');
                $up['birthday']   = $this->input->post('bday');
                $up['address']    = $this->input->post('address');
                $up['provinsi']   = $this->input->post('province');
                $up['kota']       = $this->input->post('city');
                $up['phone']      = $this->input->post('phone');

                

                $this->db->where('id', $id);
                $this->db->update('users', $up);        

                redirect('member/profile',$data);
                   
        }
        
        
        function check_member()
        {
            $member = $this->input->post('member_id');

            // Check its existence (for example, execute a query from the database) ...
            $cek = $this->member_model->check_member($member);
            
            if($cek == 0)
            {
                $isAvailable = true;
            }else{
                $isAvailable = False;
            }  

            // Finally, return a JSON
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        
        }
        


        //////////////// ajax data tables ////////////////////////////
        
        public function ajax_list()
	   {
		$list = $this->member_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $member) {
			$no++;
			$row = array();
			$row[] = $member->first_name;
			$row[] = $member->last_name;
			$row[] = $member->address;
                        $row[] = $member->phone;
			$row[] = $member->birthday;
			$row[] = $member->seller_rating;
                        $row[] = $member->buyer_rating;

			//add html for action
			//$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			//	  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->member_model->count_all(),
						"recordsFiltered" => $this->member_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}
