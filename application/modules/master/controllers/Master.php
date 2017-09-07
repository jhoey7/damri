<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends MY_Controller {

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
                $this->load->model('master_model');

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

        function trayek()
        {
            

            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['active_bar']  = 'Master';
            $data['active_menu'] = 'Trayek';
            $data['title'] = 'Trayek DAMRI BASOETTA';
            $arrcond = "deleted_at IS NULL";
            $data['query'] = $this->member_model->gettrayek();
            $data['pool'] = $this->member_model->getMasterFilter('pool',$arrcond,'nama_pool','asc');
            $data['trm'] = $this->member_model->getMasterFilter('terminal_grup',$arrcond,'nama_tg','asc');
             $data['grp'] = $this->member_model->getMasterFilter('pool_grup',$arrcond,'nama_grup','asc');

            $data['notif'] = '';

            show('master/trayek', $data ,$this->template_member);
        }
        
          
        function terminal()
        {
            

            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['active_bar']  = 'Master';
            $data['active_menu'] = 'Terminal';
            $data['title'] = 'Daftar Terminal';
            $arrcond = "deleted_at IS NULL";
            $data['query'] = $this->member_model->getMasterFilter('terminal',$arrcond,'created_at','desc');
            $data['comp'] = $this->member_model->getMasterFilter('company',$arrcond,'nama_comp','asc');
            $data['notif'] = '';

            show('master/terminal', $data ,$this->template_member);
        }
        
       
        /// End View Form ///
        
        
        //// SIMPAN DATA /////
        
        function save_trayek()
        {
            $act = $this->uri->segment(3);
            $kode = $this->uri->segment(4);
            $table= 'trayek';
            $id=$this->session->userdata('user_id');
            
                $data = array(
            		'nama_trayek' => $this->input->post('nama_trayek'),
			'tarif' => $this->input->post('tarif'),
			'id_pool' => $this->input->post('pool'),
			'id_group' => $this->input->post('group')
                         );
                                if($act=="insert")  {
                                                        $insert =$this->MY_Model->insert($table,$data,$log = 1); 
                                                        $this->session->set_flashdata('message', 'Simpan Data Success');
                                                    }
                                else 
                                                    {
                                                        $update = $this->MY_Model->updateRow($data,$table,$kode,"id_trayek",$log = 0);
                                                        $this->session->set_flashdata('message', 'Edit Data Success');
                                                    }
       
                                

				redirect('master/trayek');
        }
        
        function save_terminal()
        {
            
            $id=$this->session->userdata('user_id');
            $act = $this->uri->segment(3);
            $kode = $this->uri->segment(4);
                                
            $data = array(
                                                            'nama_terminal' => $this->input->post('nama_terminal'),
                                                            'id_comp' => $this->input->post('comp'),
                                                            'gm' => $this->input->post('gm'),
                                                            'gm_nik' => $this->input->post('nik_gm'),
                                                            'staf' => $this->input->post('staf'),
                                                            'staf_nik' => $this->input->post('nik_staf')
                                                             );
                                                        
            
                            if($act=="insert")  {
                                                    
                                                        $insert =$this->MY_Model->insert('terminal',$data,$log = 1);
                                                        $this->session->set_flashdata('message', 'Simpan Data Success');
                                                    }
                                else 
                                                    {
                                                   
                                                        $update = $this->MY_Model->updateRow($data,'terminal',$kode,"id_terminal",$log = 0);
                                                        $this->session->set_flashdata('message', 'Edit Data Success');
                                                    }                                

				redirect('master/terminal');
        }
        
        function save_jurusan()
        {
            $id=$this->session->userdata('user_id');
            $act = $this->uri->segment(3);
            $kode = $this->get_no_urut('kode_jurusan', 'tljurusan', '3', 'J');
                    
                                if($act=="insert")  {
                                                        $data = array(
                                                                    'kode_jurusan' => $kode,
                                                                    'nama_jurusan' => $this->input->post('jurusan'),
                                                                    'keterangan' => $this->input->post('keterangan'),
                                                                    'flag_del' => 'false',
                                                                    'km_tempuh' => $this->input->post('trayek'),
                                                                    'km_empty' => $this->input->post('empty'),
                                                                    'harga' => $this->input->post('harga')
                                                                );
                                                        
                                                        $insert =$this->MY_Model->insert('tljurusan',$data,$log = 1);      
                                                        $this->session->set_flashdata('message', 'Simpan Data Success');
                                                    }
                                else 
                                                    {
                                                    $kode_jurusan = $this->uri->segment(4);
                                                    $data = array(
                                                                   'nama_jurusan' => $this->input->post('jurusan'),
                                                                   'keterangan' => $this->input->post('keterangan'),
                                                                   'flag_del' => 'false',
                                                                   'km_tempuh' => $this->input->post('trayek'),
                                                                   'km_empty' => $this->input->post('empty'),
                                                                   'harga' => $this->input->post('harga')
                                                                  );
                                                        $update = $this->MY_Model->updateRow($data,'tljurusan',$kode_jurusan,"kode_jurusan",$log = 0);
                                                        $this->session->set_flashdata('message', 'Edit Data Success');
                                                    }
       
				redirect('master/jurusan');
        }
        
                
        function save_availBus()
        {
            $id=$this->session->userdata('user_id');
            $act = $this->uri->segment(3);
            $kode = $this->get_no_urut('kode_avail', 'availbus', '2', 'A');
                
            if($_FILES['userfile']['name']=="")
            {
                 $picture = $this->input->post('gambar_userfile_mirror');
            }
            else 
            {
                 $picture = $_FILES['userfile']['name'];
                
                $path = 'D:/xampp/htdocs/damri/assets/frontend/pages/img/sewa';
                $upload = $this->do_upload_resize($path);
            }
                                if($act=="insert")  {               
                                                        $data = array(
                                                                    'kode_avail' => $kode,
                                                                    'jenis_bus' =>  $this->input->post('jenis_bus'),
                                                                    'keterangan' => $this->input->post('keterangan'),
                                                                    'flag_del' => 'false',
                                                                    'harga_sewa' => $this->input->post('harga'),
                                                                    'img_url' => $picture
                                                                );

                                                        $insert =$this->MY_Model->insert('availbus',$data,$log = 1); 
                                                        $this->session->set_flashdata('message', 'Simpan Data Success');
                                                    }
                                else 
                                                    {
                                                    $kode_avail = $this->uri->segment(4);
                                                        $data = array(
                                                                    'jenis_bus' => $this->input->post('jenis_bus'),
                                                                    'keterangan' => $this->input->post('keterangan'),
                                                                    'flag_del' => 'false',
                                                                    'harga_sewa' => $this->input->post('harga'),
                                                                    'img_url' => $picture
                                                                );
                                                        $update = $this->MY_Model->updateRow($data,'availbus',$kode_avail,"kode_avail",$log = 0);
                                                        $this->session->set_flashdata('message', 'Edit Data Success');
                                                    }
				redirect('master/availBus');
        }
        /// END SIMPAN ////
       
        ///// PUBLIC FUNCTION //////////////////////////
        
       
       function attach()
            {
                $attach = $this->uri->segment(3);
                $data['attach'] = $attach; 
                
                $this->load->view('ajax/attach',$data);
            }
            
        function download()
        {
            $this->load->helper('download');
            $path = $this->uri->segment(3);
            $name = $this->uri->segment(4);
            $data = file_get_contents(base_url().'assets/upload/'.$path.'/'.$name); //assuming my file is on localhost
            $name = $name; 
            force_download($name,$data); 
        }
        
}