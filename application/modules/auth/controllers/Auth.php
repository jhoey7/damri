<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation','recaptcha'));
		$this->load->helper(array('url','language','form'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('ion_auth','english');

		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ?
		$this->load->library('mongo_db') :
		$this->load->database();
		$this->load->model('member/member_model');

		$this->load->model('MY_Model');

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
      
	}

	// redirect if needed, otherwise display the user list
	function index()
	{

		/*if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->_render_page(base_url().'auth/index', $this->data);
		}*/
		$data['active_bar']  = 'members';
		$data['active_menu'] = 'login-member';
			
        show('auth/create_user', $data ,$this->template_member);
	}

	// log the user in
	function login()
	{
		$this->data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = "";
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
                            
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect(base_url()."dashboard");
                           
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('account/Login'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                             
                      }
		}

	}

	// log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
                
                if($this->uri->segment(3) == "") { redirect(base_url(), 'refresh'); }
                else {redirect(base_url().'index.php/dashboard'); }
		
	}

	// change password
function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			 $data = $this->data;
            $data['active_bar']  = 'account';
            $data['active_menu'] = 'change_password';
            $data['title'] = 'Change Your Password';
            $data['datas'] = array();
            //$data['saldo']=$this->member_model->getSaldoById('marita');
            //$data['query'] = $this->member_model->getMember();
            
           show('account/change_password', $data ,$this->template_member);

			// render
			//$this->_render_page('account/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$data['identity'] = $this->session->userdata('identity'); 
				
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('account/change_password', 'refresh'); 
			}
		}
	}
	// forgot password
	function forgot_password()
	{
		// setting validation rules by checking wheather identity is username or email

		  $this->form_validation->set_rules('identity', 'Identity', 'required');
		


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);


				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                        $data= $this->data;
			show('account/forgot_password', $data ,$this->template_login);
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {

		            	   $this->ion_auth->set_error('forgot_password_Identity_not_found');
	

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("account/forgot_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("account/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("account/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		 $user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form
   
                        
			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				//$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;
                                
                                $data = $this->data;
				// render
				show('account/reset_password', $data ,$this->template_login);
			}
			else
			{
				// do we have a valid request?
				/*if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{*/
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("account/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('account/reset_password/' . $code, 'refresh');
					}
				//}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("account/forgot_password", 'refresh');
		}
	}


	// activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
                        if($this->uri->segment(5)=="")
                        {
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("account/login", 'refresh');
                        }
                        else                       
                        {
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("account/login/member", 'refresh');
                        }
		}
		else
		{
                        if($this->uri->segment(5)=="")
                        {
			// redirect them to the forgot password page
                            $this->session->set_flashdata('message', $this->ion_auth->errors());
                            redirect("account/register", 'refresh');
                        }
                        else
                        {
                            $this->session->set_flashdata('message', $this->ion_auth->errors());
                            redirect("account/register/member", 'refresh');
                        }
		}
	}

	// deactivate the user
	function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	// create a new user
	function create_user()
        {
            echo $this->input->post('level');
 
        
    }

	// edit a user
function edit_user()
	{
	
            $this->data['title'] = "Edit User";
            $table = 'users';
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');

		
					$id=$this->ion_auth->user()->row()->id;
						
					$user = $this->ion_auth->user($id)->row();
					$groups=$this->ion_auth->groups()->result_array();
					$currentGroups = $this->ion_auth->get_users_groups($id)->result();


					// validate form input
					if (isset($_POST) && !empty($_POST))
					{
			                        $this->form_validation->set_rules('first_name', 'Last Name', 'required');
			                        $this->form_validation->set_rules('last_name', 'Last Name', 'required');        
			                        $this->form_validation->set_rules('phone', 'Phone', 'required');
			                        $this->form_validation->set_rules('address', 'Address', 'required');

						// do we have a valid request?
						/*if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
						{
							show_error($this->lang->line('error_csrf'));
						}*/
						
						if ($this->form_validation->run() === TRUE)
						{
							$data = array(
			                                'first_name' => $this->input->post('first_name'),
			                                'last_name'  => $this->input->post('last_name'),
			                                'address'    => $this->input->post('address'),
			                                'phone'      => $this->input->post('phone'),
							);

							$email = $this->input->post('email');
							

							// Only allow updating groups if user is admin
							if ($this->ion_auth->is_admin())
							{
								//Update the groups user belongs to
								$groupData = $this->input->post('groups');
								if (isset($groupData) && !empty($groupData)) {
									$this->ion_auth->remove_from_group('', $id);
									foreach ($groupData as $grp) {
										$this->ion_auth->add_to_group($grp, $id);
									}
								}
							}
						// check to see if we are updating the user
						   if($this->ion_auth->update($user->id, $data))
						    {
						    		$data['identity'] = $this->session->userdata('identity'); 
								  	$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('edit_profile', 'ion_auth'), $data, true);

									$this->email->clear();
									$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
									$this->email->to($email);
									$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . 'Change Profile Information');
									$this->email->message($message);

									$this->email->send();

						    	// redirect them back to the admin page if admin, or to the base url if non admin
							    $this->session->set_flashdata('message', $this->ion_auth->messages() );
							    if ($this->ion_auth->is_admin())
								{
									redirect('auth', 'refresh');
								}
								else
								{

									redirect('member/profile', 'refresh');
								}
						    }
						    else
						    {
						    	// redirect them back to the admin page if admin, or to the base url if non admin
							    $this->session->set_flashdata('message', $this->ion_auth->errors() );
							    if ($this->ion_auth->is_admin())
								{
									redirect('auth', 'refresh');
								}
								else
								{
									//echo "iini";
									redirect('member/profile', 'refresh');
								}
						    }
						}
					}
					// display the edit user form
					//$this->data['csrf'] = $this->_get_csrf_nonce();
					// set the flash data error message if there is one
					$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					// pass the user to the view
					$this->data['user'] = $user;
					$this->data['groups'] = $groups;
					$this->data['currentGroups'] = $currentGroups;
					$this->data['first_name'] = array(
						'name'  => 'first_name',
						'id'    => 'first_name',
						'type'  => 'text',
						'value' => $this->form_validation->set_value('first_name', $user->first_name),
					);
					$this->data['last_name'] = array(
						'name'  => 'last_name',
						'id'    => 'last_name',
						'type'  => 'text',
						'value' => $this->form_validation->set_value('last_name', $user->last_name),
					);
					$this->data['company'] = array(
						'name'  => 'company',
						'id'    => 'company',
						'type'  => 'text',
						'value' => $this->form_validation->set_value('company', $user->company),
					);
					$this->data['phone'] = array(
						'name'  => 'phone',
						'id'    => 'phone',
						'type'  => 'text',
						'value' => $this->form_validation->set_value('phone', $user->phone),
					);
					$this->data['password'] = array(
						'name' => 'password',
						'id'   => 'password',
						'type' => 'password'
					);
					$this->data['password_confirm'] = array(
						'name' => 'password_confirm',
						'id'   => 'password_confirm',
						'type' => 'password'
					);
					redirect('member/profile',  $this->data, 'refresh');
					
	}

	// create a new group
	function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data);
		}
	}

	// edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	function view_members() {
		  
		  $data['members']     = 'members';
		  $data['active_bar']  = 'members';
		  $data['active_menu'] = 'view-members';	
          show('auth/view_members', $data ,$this->template_member);
	}

}
