<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//helper
//created by : Julius Michael Rinaldo


    function generateSearchString($search,$sort_by = "",$order = "",$page = 1,$limit = ""){
        $str = "";
        $page--;
        $start = $page * $limit;
        $str .= " AND ( ";
        
        foreach($search as $key=>$val){

            if($key != 0){
                $str .= " OR ";
            }
            
            $str .= " ".$val[1]." ".$val[2]." '".$val[0]."'";
            
        }
        $str .= " ) ";
        if($sort_by != ""){
            $str .= " ORDER BY $sort_by $order";
        }
        if($limit != ""){
            $str .= " limit $start,$limit";
        }
    
        return $str;
    }
    function search_access_array($id, $array) {
        if(count($array)>0){
            foreach ($array as $key => $val) {
                if ($val['id'] === $id) {
                   return $val;
                }
            }
        }
       return null;
    }
    function generateBootstrapPagination($base_url,$total,$limit){
        //BEGIN PAGINATION
            $ci =& get_instance(); 
            $ci->load->library("pagination");
            $config['base_url'] = $base_url;
            $config['total_rows'] = $total;
            $config['per_page'] = $limit;
            $config['query_string_segment'] = "page";
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] ="</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $ci->pagination->initialize($config);
            return $ci->pagination->create_links();
        //END PAGINATION
    }
    function ismobile()
        {
            $mobile_browser = '0';

            if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
                    $mobile_browser++;
            }

            if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
                    $mobile_browser++;
            }

            $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
            $mobile_agents = array(
                            'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
                            'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
                            'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
                            'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
                            'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
                            'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
                            'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
                            'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
                            'wapr','webc','winw','winw','xda ','xda-');

            if (in_array($mobile_ua,$mobile_agents)) {
                    $mobile_browser++;
            }

            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
                    $mobile_browser = 0;
            }

            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'mac') > 0) {
                    $mobile_browser = 0;
            }

            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'ios') > 0) {
                    $mobile_browser = 1;
            }
            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'android') > 0) {
                    $mobile_browser = 1;
            }
            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows phone') > 0) {
                    $mobile_browser = 1;
            }	
            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iphone os') > 0) {
                    $mobile_browser = 1;
            }
            return $mobile_browser;
    }
	function getPrefixNo($id)
	{
		
        $ci =& get_instance(); 
        $ci->load->model("prefix_model");
		$ci->load->database();
		$structure = $ci->db->query("SELECT * FROM prefix WHERE id = '$id' ORDER BY running_number DESC LIMIT 1")->row_array();
		
		$intial = $structure['prefix'];
		$length = $structure['length'];

		if ($structure['running_number'] >= 1)
		{
			$number = intval($structure['running_number']);
		}else{
			$number = 0;
		}
		$number++;
		$tmp= "";
		for ($i=0; $i < ($length-strlen($number)) ; $i++)
		{
			$tmp = $tmp."0";
		}
		$ci->prefix_model->update($id,array('running_number'=>$number));
		//return generate ID
		return strval($intial.$tmp.$number);
	}
	
    function upload_handler($file_name,$new_name,$new_path, $required = true,$old_file_path = ""){
        $ci =& get_instance();
        $returnData = array();
        $config['upload_path'] = $new_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '1024';
        $config['max_width']  = '1024';
        $config['max_height']  = '1024';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $new_name;
        $ci->load->library('upload', $config);
        if(isset($_FILES[$file_name]))
        {
            if (!$ci->upload->do_upload($file_name))
            {
                
                $returnData['error'] =  $ci->upload->display_errors();
                $returnData['status'] = 0;
            }
            else
            {
             
                $upload_data = $ci->upload->data();
                $returnData['file_path'] = $new_path.$upload_data['raw_name'].$upload_data['file_ext'];
           
                $parts = explode(".",$upload_data['full_path']);
                $ci->load->library('image_lib');
                    /* read the source image */
                    if($upload_data['file_type'] == "image/jpeg" || $upload_data['file_type'] == "image/jpg"){
                         $source_image = imagecreatefromjpeg($upload_data['full_path']);
                    }
                    else if($upload_data['file_type'] == "image/png"){
                        $source_image = imagecreatefrompng($upload_data['full_path']);
                    }
                    else if($upload_data['file_type'] == "image/gif"){
                        $source_image = imagecreatefromgif($upload_data['full_path']);
                    }

                    $width = imagesx($source_image);
                    $height = imagesy($source_image);
                    /* create a new, "virtual" image */
                  
                    
                    // first resize the image 
                    $thumbnail_size = 200;
                    if ($width < $height){
                        $desired_width = $thumbnail_size;
                        $desired_height = floor($height * ($desired_width / $width));
                        $w_start = 0;
                        $h_start = $desired_height / 2 - ($thumbnail_size/2);
                    }else{
                         $desired_height = $thumbnail_size;
                        $desired_width = floor($width * ($desired_height / $height));
                        $w_start = $desired_width / 2 - ($thumbnail_size/2);
                        $h_start = 0;
                    }

                    /* copy source image at a resized size based on the shortest length */
                    $virtual_image = imagecreatetruecolor(200, 200);
                    imagecopyresampled($virtual_image, $source_image, -$w_start, -$h_start, 0, 0, $desired_width, $desired_height, $width, $height);
                
                    /* create the physical thumbnail image to its destination */
                    $thumbnail_path = $upload_data['file_path']."/".$upload_data['raw_name']."_thumb".$upload_data['file_ext'];
                    $returnData['thumbnail_path'] = $new_path."/".$upload_data['raw_name']."_thumb".$upload_data['file_ext'];
                    if($upload_data['file_type'] == "image/jpeg" || $upload_data['file_type'] == "image/jpg"){
                         imagejpeg($virtual_image, $thumbnail_path);
                    }
                    else if($upload_data['file_type'] == "image/png"){
                         imagepng($virtual_image, $thumbnail_path);
                    }
                    else if($upload_data['file_type'] == "image/gif"){
                         imagegif($virtual_image, $thumbnail_path);
                    }
                  $returnData['status'] = 1;
                //END CREATING THUMBNAILS
                //BEGIN DELETE OLD FILE
                    if($old_file_path != ""){
                        if(file_exists($old_file_path)){
                            unlink($old_file_path);
                        }
                        $parts = explode(".",$old_file_path);
                        $old_thumb_path = $parts[0]."_thumb.".$parts[1];
                        if(file_exists($old_thumb_path)){
                            unlink($old_thumb_path);
                        }
                    }
                //END DELETE OLD FILE
            }
        }
        else{
            if($required){
                $returnData['status'] = 1;
            }
            else{
                $returnData['status'] = 0;
            }
        }
   
        return $returnData;
    }
	function labelStatus($status){
		$label 	= '';
		if($status == "PENDING"){
			$label .= '<span class="label label-info">';
		}else if($status == "PROCESSED"){
			$label .= '<span class="label label-primary">';
		}else if($status == "OPEN"){
			$label .= '<span class="label label-success">';
		}else if($status == "PAID"){
			$label .= '<span class="label label-success">';
		}else if($status == "CLOSE"){
			$label .= '<span class="label label-default">';
		}else if($status == "CLOSED"){
			$label .= '<span class="label label-default">';
		}else if($status == "UNPAID"){
			$label .= '<span class="label label-warning">';
		}else if($status == "FINISHING"){
			$label .= '<span class="label label-info">';
			$class = 'Info';
		}else if($status == "FINISHED"){
			$label .= '<span class="label label-default">';
		}else if($status == "PARTITIAL PAID"){
            $label .= '<span class="label label-warning">';
        }
		$label .= $status."</span>";
		return $label;
	}

    function generate_table_header(){

    }
	


