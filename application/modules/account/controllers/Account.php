<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    var $data;
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper(array('url','form'));
                $this->load->library('recaptcha');
                $this->load->helper('captcha');

		$this->config->item('use_mongodb', 'ion_auth') ?
		$this->load->library('mongo_db') :
		$this->load->database();
                $this->load->model('member/member_model');
                $this->load->model('account_model');
                $this->load->model('auth/ion_auth_model');
		$this->load->helper('language');
                $this->template_login = 'template/login/template';
               
		$this->template_member = 'template/adminlte/template';

		
		$this->output->set_header("HTTP/1.0 200 OK");
		$this->output->set_header("HTTP/1.1 200 OK");
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: ".gmdate('D, d M Y H:i:s')." GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache"); 
                   
      /*  $this->data = array(
                     'saldo' => $this->member_model->getSaldoById($this->session->userdata('user_id')), 
                     'user' => $this->session->userdata('userName'),
                     'notif_q' => $this->member_model->get_notif($this->session->userdata('user_id')),
                     'notif' => $this->member_model->get_notif_count($this->session->userdata('user_id')));*/
	}

		public function Login()
		{
            $this->data['active_menu'] = 'login';
		   	$data = $this -> data; 
           	if($this->session->userdata('user_id')=="") { show('account/login_admin', $data ,$this->template_login); }
           	else { redirect('dashboard'); }
                   
		}
               
                
		function Register()
		{
                        $this->data['first_name'] = "";
                        $this->data['last_name'] = "";
                        $this->data['identity'] = "";
                        $this->data['email'] = "";
                        $this->data['birthday'] = "";
                        $this->data['phone'] = "";
                        $this->data['address'] = "";
                        $this->data['password'] = "";
                        $this->data['confirmPassword'] = "";
                        $this->data['active_menu'] = 'registrasi';
                        
				$this->data['prov'] = $this->member_model->getMaster('master_provinsi','name','asc');
				$this->data['kota'] = $this->member_model->getMasterFilter('master_kokab',array('provinsi_id' => '12'),'name','asc');
				$this->data['message']="";
                                //header('Content-Type: application/x-json; charset=utf-8');
				//echo(json_encode($this->city_model->get_cities($country)));
                                $data = $this->data;
                                
				if($this->session->userdata('user_id')=="") { show('account/register', $data ,$this->template_login); }
                                else { redirect('dashboard'); }
				
		}
	
		public function pilih_city()
		{
					//$data['segmen'] =$this->uri->segment(4);
			$data['city']=$this->member_model->getMasterCity($this->uri->segment(3));
			$this->load->view('ajax/v_drop_down_city',$data);
		}

        function change_password()
        {
            $data = $this->data;
            $data['active_bar']  = 'Members';
            $data['active_menu'] = 'Profile';
            $data['active_submenu'] = 'Change Password';
            $data['title'] = 'Change Your Password';
            $data['datas'] = array();
            //$data['saldo']=$this->member_model->getSaldoById('marita');
            //$data['query'] = $this->member_model->getMember();
            
             show('account/change_password', $data ,$this->template_member);
        }
       
        function forgot_password()
        {
              $this->data['message']='';
	      $data = $this -> data; 	
              show('account/forgot_password', $data ,$this->template_login);
	}
        
        function reset_password()
        {
              $this->data['message']='';
	      $data = $this -> data; 	
              show('account/reset_password', $data ,$this->template_login);
	}
// Check Email, Username, Password that EXIST
        
        function checkEmail()
        {
			$email = $_POST['email'];

			// Check its existence (for example, execute a query from the database) ...
			$email_cek = $this->account_model->Check_TblUsers('email',$email);
			
			if($email_cek == 0)
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
		
        function checkUsername()
        {
			$username = $_POST['identity'];

			// Check its existence (for example, execute a query from the database) ...
			$email_cek = $this->account_model->Check_TblUsers('username',$username);
			
			if($email_cek == 0)
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
        
        function checkExistUsername()
        {
            		$username = $_POST['identity'];

			// Check its existence (for example, execute a query from the database) ...
			$user_cek = $this->account_model->Check_TblUsers('username',$username);
			
			if($user_cek == 0)
			{
				$isAvailable = FALSE;
			}else{
				$isAvailable = TRUE;
			}  

			// Finally, return a JSON
			echo json_encode(array(
				'valid' => $isAvailable,
			));
        }
        
        function checkPassword()
        {
			$id = $this->session->userdata('user_id');

                        $old_password = $this->input->post('old');

                        $password_matches = $this->ion_auth_model->hash_password_db($id , $old_password);
			
                        // Check its existence (for example, execute a query from the database) ...

			// Finally, return a JSON
			echo json_encode(array(
				'valid' => $password_matches,
			));
        }
       
        
         function FindUsername()
        {
			$username = $_POST['identity'];

			// Check its existence (for example, execute a query from the database) ...
			$email_cek = $this->account_model->Check_TblUsers('username',$username);
			
			if($email_cek == 0)
			{
				$isAvailable = FALSE;
			}else{
				$isAvailable = TRUE;
			}  

			// Finally, return a JSON
			echo json_encode(array(
				'valid' => $isAvailable,
			));
        }
        
        public function captcha()
        {
            $this->load->library('captcha');

		if (!$captcha_config = $this->session->userdata('captcha_config'))
			return;
		
		$captcha_config = unserialize($captcha_config);
		$this->session->unset_userdata('captcha_config');
		
		// Use milliseconds instead of seconds
		srand(microtime() * 100);
		
		// Pick random background, get info, and start captcha
		$background = $captcha_config['png_backgrounds'][rand(0, count($captcha_config['png_backgrounds']) -1)];
		list($bg_width, $bg_height, $bg_type, $bg_attr) = getimagesize($background);
		
		// Create captcha object
		$captcha = imagecreatefrompng($background);
                imagealphablending($captcha, true);
                imagesavealpha($captcha , true);
		
		$color = $this->captcha->hex2rgb($captcha_config['color']);
		$color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);
	        
		// Determine text angle
		$angle = rand( $captcha_config['angle_min'], $captcha_config['angle_max'] ) * (rand(0, 1) == 1 ? -1 : 1);
		
		// Select font randomly
		$font = $captcha_config['fonts'][rand(0, count($captcha_config['fonts']) - 1)];
		
		// Verify font file exists
		if( !file_exists($font) ) throw new Exception('Font file not found: ' . $font);
		
		//Set the font size.
		$font_size = rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);
		$text_box_size = imagettfbbox($font_size, $angle, $font, $captcha_config['code']);
		
		// Determine text position
		$box_width = abs($text_box_size[6] - $text_box_size[2]);
		$box_height = abs($text_box_size[5] - $text_box_size[1]);
		$text_pos_x_min = 0;
		$text_pos_x_max = ($bg_width) - ($box_width);
		$text_pos_x = rand($text_pos_x_min, $text_pos_x_max);			
		$text_pos_y_min = $box_height;
		$text_pos_y_max = ($bg_height) - ($box_height / 2);
		$text_pos_y = rand($text_pos_y_min, $text_pos_y_max);
		
		// Draw shadow
		if( $captcha_config['shadow'] ){
			$shadow_color = $this->captcha->hex2rgb($captcha_config['shadow_color']);
		 	$shadow_color = imagecolorallocate($captcha, $shadow_color['r'], $shadow_color['g'], $shadow_color['b']);
			imagettftext($captcha, $font_size, $angle, $text_pos_x + $captcha_config['shadow_offset_x'], $text_pos_y + $captcha_config['shadow_offset_y'], $shadow_color, $font, $captcha_config['code']);	
		}
		
		// Draw text
		imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_config['code']);	
		
		// Output image
		header("Content-type: image/png");
		imagepng($captcha);
        }
        
        function checkBirthDate()
        {
            $date = $this->input->post('bday');

            $today = date('Y-m-d');
            
             if (strtotime($date) < strtotime($today)) {
                $isAvailable = TRUE;
             }
             else if(strtotime($date) >= strtotime($today))
             {
                 $isAvailable = false;
             }


            echo json_encode(array(
		'valid' => $isAvailable,
		));
        }
    
}
