<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $input_data;
	protected $temporary_data;
	protected $data;
	protected $controller_name;
	protected $module_name;
	protected $function_name;

	public function __construct(){
		
		parent::__construct();

		if($_POST){
			$this->input_data = $this->input->post();
		}	
		else if($_GET){
			$this->input_data = $this->input->get();
		}

		
	}


	public function do_upload($path){
            
                $this->load->library('upload');
                $this->load->library('image_lib');

                $upload_conf = array(
                    //'upload_path'   => realpath('C:/xampp/htdocs/payment/assets/upload'),
                    'upload_path'   => realpath($path),
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'max_size'      => '30000',
                    );

                $this->upload->initialize( $upload_conf );

		if ( ! $this->upload->do_upload()){
			 return $error = array('error' => $this->upload->display_errors());
                        // $this->load->view('transactions/upload_form', $error);

		}
		else{
			return $data = array('upload_data' => $this->upload->data());
                        //$this->load->view('transactions/upload_form', $data);
		}
	}
        
    public function do_upload_resize($path)
    {
        $this->load->library('upload');
        $this->load->library('image_lib');
        
        $upload_conf = array(
            //'upload_path'   => realpath('C:/xampp/htdocs/payment/assets/upload'),
            'upload_path'   => realpath($path),
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size'      => '30000',
            );
    
        $this->upload->initialize( $upload_conf );
    

            if ( ! $this->upload->do_upload())
            {
                // if upload fail, grab error 
                $error['upload'] = $this->upload->display_errors();
            }
            else
            {
                // otherwise, put the upload datas here.
                // if you want to use database, put insert query in this loop
                $upload_data = $this->upload->data();
                
                // set the resize config
                $resize_conf = array(
                    // it's something like "/full/path/to/the/image.jpg" maybe
                    'source_image'  => $upload_data['full_path'], 
                    // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                    // or you can use 'create_thumbs' => true option instead
                    //'new_image'     => $upload_data['file_path'].'thumb_'.$upload_data['file_name'],
                    'width'         => 300,
                    'height'        => 200
                    );

                // initializing
                $this->image_lib->initialize($resize_conf);

                // do it!
                if ( ! $this->image_lib->resize())
                {
                    // if got fail.
                    $error['resize']= $this->image_lib->display_errors();
                }
                else
                {
                    // otherwise, put each upload data to an array.
                    return $upload_data;
                }

                }

    }
        
        public function sendMail($email,$subject,$message)
        {
            $this->load->library('email');


            $result = $this->email

            ->from('do-not-reply@megakamera.com', 'Payment Gateway')

            ->to($email)

            ->subject($subject)

            ->message($message);

            return $this->email->send();
        }

        
        public function generateRandomString($length = 6) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
        public function generateUniqueCode($length = 3) {
            $number =  implode(range(100, 999));
            $characters = $number;
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public function get_client_ip() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
	
        public function get_no_urut($field, $table, $length, $fk, $start)
        {
           if($start == NULL) { $start='1'; } else { $start=$start; }
           $strsql = "SELECT $field FROM $table
                       ORDER BY $field DESC LIMIT 1";
            $query = $this->db->query($strsql);
            $r = $query->row();

            $idMax = $r->$field;
          
           // $sLastKode = intval(substr($idMax, $length, $length)); // ambil 3 digit terakhir
            $noUrut = (int) substr($idMax, $start, $length);
 
            $sLastKode = intval($noUrut) + 1; // konversi ke integer, lalu tambahkan satu
            if($fk)
            {
                $sNextKode = $fk . sprintf('%0'.$length.'s', $sLastKode); // format hasilnya dan tambahkan prefix
            }
            else
            {
               $sNextKode = sprintf('%0'.$length.'s', $sLastKode); // format hasilnya dan tambahkan prefix
            }            
            
             return $sNextKode;
        }


        
        public function get_no_dok($field, $table, $length, $start)
        {
           if($start == NULL) { $start='1'; } else { $start=$start; }
            
           $strsql = "SELECT $field FROM $table
                       ORDER BY $field DESC LIMIT 1";
            $query = $this->db->query($strsql);
            $r = $query->row();

            $idMax = $r->$field;
          
           // $sLastKode = intval(substr($idMax, $length, $length)); // ambil 3 digit terakhir
            $noUrut = (int) substr($idMax, $start, $length);
 
            $sLastKode = intval($noUrut) + 1; // konversi ke integer, lalu tambahkan satu

               $sNextKode = sprintf('%0'.$length.'s', $sLastKode); // format hasilnya dan tambahkan prefix            
            
             return $sNextKode;
        }
        
                
         function get_data()
        {
              $table = $this->uri->segment(3);
              $id = $this->uri->segment(4);
              $field = $this->uri->segment(5);
              $data = $this->member_model->get_table($table,$field,$id);

             echo json_encode($data);
        }
        
       function delete_data()
       {
          $table = $this->uri->segment(3);
          $id = $this->uri->segment(5);
          $field = $this->uri->segment(4);
          
           $this->MY_Model->DeleteRow($table,$id,$field,$log = 0);
           
           echo json_encode(TRUE);
       }
}


        
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
