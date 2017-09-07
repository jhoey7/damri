<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

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
                $this->load->model('laporan_model');
                $this->load->model('MY_Model');
                
		$this->load->helper('language');

		$this->template_member = 'template/adminlte/template';
                $this->template_login = 'template/login/template';
                 $this->template_cetak = 'template/cetak/template';
		
		$this->output->set_header("HTTP/1.0 200 OK");
		$this->output->set_header("HTTP/1.1 200 OK");
		$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: ".gmdate('D, d M Y H:i:s')." GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache"); 
                   
        $this->data = array(
                     'user' => $this->session->userdata('userName'));
	}

	 //redirect if needed, otherwise display the user list
         
///////////// VIEW CONTROLLER -> FUNCTION VIEW DATA FROM TRANSACTIONS MENU //////////////////////////////////
        function lap1()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP1';

            $data['title'] = 'REKAP SETORAN DINAS COUNTER TERMINAL BANDARA';
	    $data['datas'] = array();
            $data['tr'] = $this->member_model->getMasterFilter('terminal',"deleted_by IS NULL",'nama_terminal','desc');
            $data['jur'] = $this->member_model->getMasterFilter('trayek',"deleted_by IS NULL",'nama_trayek','asc');
            
            show('laporan/LAP_1', $data ,$this->template_member);
        }

        function view_lap1()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $trayek = $this->uri->segment(5);
            $terminal = $this->uri->segment(6);
            
            $nm_trayek = $this->member_model->get_Master_By_Id("trayek","id_trayek = '{$trayek}'","nama_trayek");
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($trayek == "0") { $where = "deleted_at IS NULL"; $data['comt_t'] = "TRAYEK SEMUA"; } else { $where = "id_trayek='$trayek' AND deleted_at IS NULL"; $data['comt_t'] = "TRAYEK "." ".$nm_trayek;}
            if($terminal == "0") { $data['comt_ter'] = "TERMINAL SEMUA";} else { $data['comt_ter'] = "TRAYEK "." ".$nm_terminal;}
            
            $data['terminal']= $terminal;
            $data['trk'] = $trayek;
                    
            $data['trayek'] = $this->member_model->getMasterFilter('trayek',$where,'id_trayek','asc');
	    $data['list'] = $this->laporan_model->getdatelist($tgl_awal,$tgl_akhir);
            
            
            $this->load->view('laporan/lap_lap1',$data);
        }
        
        function cetak_lap1()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);

            $trayek = $this->uri->segment(5);
            $terminal = $this->uri->segment(6);
            
            $nm_trayek = $this->member_model->get_Master_By_Id("trayek","id_trayek = '{$trayek}'","nama_trayek");
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($trayek == "0") { $where = "deleted_at IS NULL"; $data['comt_t'] = "TRAYEK SEMUA"; } else { $where = "id_trayek='$trayek' AND deleted_at IS NULL"; $data['comt_t'] = "TRAYEK "." ".$nm_trayek;}
            if($terminal == "0") { $data['comt_ter'] = "TERMINAL SEMUA";} else { $data['comt_ter'] = "TRAYEK "." ".$nm_terminal;}
            
            $data['terminal']= $terminal;
            $data['trk'] = $trayek;
                    
            $data['trayek'] = $this->member_model->getMasterFilter('trayek',$where,'id_trayek','asc');
	    $data['list'] = $this->laporan_model->getdatelist($tgl_awal,$tgl_akhir);
            
            show('laporan/cetak_lap1', $data ,$this->template_cetak);
           
        }
        
        function lap2()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP2';

            $data['title'] = 'REKAP SETORAN DINAS COUNTER TERMINAL BANDARA';
	    $data['datas'] = array();
            $data['jur'] = $this->member_model->getMasterFilter('terminal',"deleted_by IS NULL",'nama_terminal','desc');
            $data['tr'] = $this->member_model->getMasterFilter('trayek',"deleted_by IS NULL",'nama_trayek','asc');
            
            show('laporan/LAP_2', $data ,$this->template_member);
        }
        
        function view_lap2()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $trayek = $this->uri->segment(5);
            $shift = $this->uri->segment(6);
            $terminal = $this->uri->segment(7);
            
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            
            $nm_trayek = $this->member_model->get_Master_By_Id("trayek","id_trayek = '{$trayek}'","nama_trayek");         
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($trayek == "0") { $where = "deleted_at IS NULL"; $data['comt_t'] = "SEMUA TRAYEK"; } else { $where = "id_trayek='$trayek' AND deleted_at IS NULL"; $data['comt_t'] = "TRAYEK "." ".$nm_trayek;}
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; }
            
            $data['trayek'] = $this->member_model->getMasterFilter('trayek',$where,'id_trayek','asc');
            $data['trk'] = $trayek;
            $data['list'] = $this->laporan_model->getdateelist_counter($tgl_awal,$tgl_akhir,$trayek, $terminal, $shift);
            $data['shifts'] = $shift;
            $data['trmnl'] = $terminal;
      
            if($shift == '0') {
            
            $this->load->view('laporan/lap_lap2',$data);
            }
            
            else if($shift != '0')
            {
                              
                $this->load->view('laporan/lap_lap2_shift',$data);
            }
        }
        
        function cetak_lap2()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $trayek = $this->uri->segment(5);
            $shift = $this->uri->segment(6);
            $terminal = $this->uri->segment(7);
            
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
                    
            $nm_trayek = $this->member_model->get_Master_By_Id("trayek","id_trayek = '{$trayek}'","nama_trayek");
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($trayek == "0") { $where = "deleted_at IS NULL"; $data['comt_t'] = "SEMUA TRAYEK"; } else { $where = "id_trayek='$trayek' AND deleted_at IS NULL"; $data['comt_t'] = "TRAYEK "." ".$nm_trayek;}
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; }
            
            $data['trayek'] = $this->member_model->getMasterFilter('trayek',$where,'id_trayek','asc');
            $data['trk'] = $trayek;
            $data['list'] = $this->laporan_model->getdateelist_counter($tgl_awal,$tgl_akhir,$trayek, $terminal, $shift);
            $data['shifts'] = $shift;
            $data['trmnl'] = $terminal;

            if($shift == '0') {
            
                show('laporan/cetak_lap2', $data ,$this->template_cetak);
            }
            
            else if($shift != '0')
            {
                              
                show('laporan/cetak_lap2_shift', $data ,$this->template_cetak);
            }
                      
        }
        
        function lap3()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP3';

            $data['title'] = 'REKAP SETORAN DINAS COUNTER TERMINAL BANDARA';
	    $data['datas'] = array();
            $data['pool'] = $this->member_model->getMasterFilter('pool',"deleted_by IS NULL",'nama_pool','desc');

            
            show('laporan/LAP_3', $data ,$this->template_member);
        }
        
        function view_lap3()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['tgl_awal'] = $this->uri->segment(3);
            $data['tgl_akhir'] = $this->uri->segment(4);
            $data['pool'] = $this->member_model->getMasterFilter('pool',"deleted_by IS NULL",'nama_pool','desc');
            
            $this->load->view('laporan/lap_lap3',$data);
        }
        
        function cetak_lap3()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['tgl_awal'] = $this->uri->segment(3);
            $data['tgl_akhir'] = $this->uri->segment(4);

            $data['pool'] = $this->member_model->getMasterFilter('pool',"deleted_by IS NULL",'nama_pool','desc');
            
            show('laporan/cetak_lap3', $data ,$this->template_cetak);
           
        }

        function lap4()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP4';

            $data['title'] = 'LAPORAN RUPIAH PENJUALAN COUNTER di BANDARA Dan TERMINAL LUAR';
	    $data['datas'] = array();
            $data['pool'] = $this->member_model->getMasterFilter('pool',"deleted_by IS NULL",'nama_pool','desc');

            
            show('laporan/LAP_4', $data ,$this->template_member);
        }
        
        function view_lap4()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['tgl_awal'] = $this->uri->segment(3);
            $data['tgl_akhir'] = $this->uri->segment(4);
            $data['pool'] = $this->member_model->getMasterFilter('pool',"deleted_by IS NULL",'nama_pool','desc');
            
            $this->load->view('laporan/lap_lap4',$data);
        }
        
        function cetak_lap4()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['tgl_awal'] = $this->uri->segment(3);
            $data['tgl_akhir'] = $this->uri->segment(4);

            $data['pool'] = $this->member_model->getMasterFilter('pool',"deleted_by IS NULL",'nama_pool','desc');
            
            show('laporan/cetak_lap4', $data ,$this->template_cetak);
           
        }
        
        function lap5()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP5';

            $data['title'] = 'REKAP SETORAN DINAS COUNTER TERMINAL BANDARA';
	    $data['datas'] = array();
            $data['dk'] = $this->member_model->getMasterFilter('pool_grup',"deleted_by IS NULL",'id_grup','ASC');
            $data['jur'] = $this->member_model->getMasterFilter('terminal',"deleted_by IS NULL",'nama_terminal','desc');
            $data['tr'] = $this->member_model->getMasterFilter('trayek',"deleted_by IS NULL",'nama_trayek','asc');
                        
            show('laporan/LAP_5', $data ,$this->template_member);
        }
        
        function view_lap5()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['tgl_awal'] = $this->uri->segment(3);
            $data['tgl_akhir'] = $this->uri->segment(4);
            $group = $this->uri->segment(5);
            $shift = $this->uri->segment(6);
            $terminal = $this->uri->segment(7);
            
            $tgl_awal = $data['tgl_awal'];
            $tgl_akhir = $data['tgl_akhir'];
            
            $nm_grup = $this->member_model->get_Master_By_Id("pool_grup","id_grup = '{$group}'","nama_grup");         
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($group == "0") { $where = "deleted_at IS NULL"; $data['comt_t'] = "SEMUA POOL GROUP"; } else { $where = "id_grup='$group' AND deleted_at IS NULL"; $data['comt_t'] = "POOL GROUP "." ".$nm_grup;}
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; }
            
            $data['gr'] = $this->member_model->getMasterFilter('pool_grup',$where,'id_grup','asc');
            $data['grup'] = $group;
            $data['list'] = $this->laporan_model->getdateelist_dk($tgl_awal,$tgl_akhir,$group, $terminal, $shift);
            $data['shifts'] = $shift;
            $data['trmnl'] = $terminal;

            if($shift == '0') {
            
                $this->load->view('laporan/lap_lap5',$data);
            }
            
            else if($shift != '0')
            {
                              
                $this->load->view('laporan/lap_lap5_shift',$data);
            }

        }
        
        function cetak_lap5()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['tgl_awal'] = $this->uri->segment(3);
            $data['tgl_akhir'] = $this->uri->segment(4);
            $group = $this->uri->segment(5);
            $shift = $this->uri->segment(6);
            $terminal = $this->uri->segment(7);
            
            $tgl_awal = $data['tgl_awal'];
            $tgl_akhir = $data['tgl_akhir'];
            
            $nm_grup = $this->member_model->get_Master_By_Id("pool_grup","id_grup = '{$group}'","nama_grup");         
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($group == "0") { $where = "deleted_at IS NULL"; $data['comt_t'] = "SEMUA POOL GROUP"; } else { $where = "id_grup='$group' AND deleted_at IS NULL"; $data['comt_t'] = "POOL GROUP "." ".$nm_grup;}
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; }
            
            $data['gr'] = $this->member_model->getMasterFilter('pool_grup',$where,'id_grup','asc');
            $data['grup'] = $group;
            $data['list'] = $this->laporan_model->getdateelist_dk($tgl_awal,$tgl_akhir,$group, $terminal, $shift);
            $data['shifts'] = $shift;
            $data['trmnl'] = $terminal;

            if($shift == '0') {
            
                show('laporan/cetak_lap5', $data ,$this->template_cetak);
            }
            
            else if($shift != '0')
            {
                              
                show('laporan/cetak_lap5_shift', $data ,$this->template_cetak);
            }
        }
        
        function lap6()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP6';

            $data['title'] = 'PENJUALAN DETAIL';
	    $data['datas'] = array();
            $data['dk'] = $this->member_model->getMasterFilter('pool_grup',"deleted_by IS NULL",'nama_grup','desc');
            $data['terminal'] = $this->member_model->getMasterFilter('terminal',"deleted_by IS NULL",'nama_terminal','asc');
            
            show('laporan/LAP_6', $data ,$this->template_member);
        }
        
        function view_lap6()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $shift = $this->uri->segment(5);
            $terminal = $this->uri->segment(6);
            
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            
            if($shift=='0' AND $terminal=='0')
            {
                $data['where'] = "";
            }
            else if($shift!='0' AND $terminal=='0')
            {
                $data['where'] = "AND a.shift='$shift'";
            }
            else if($shift =='0' AND $terminal!='0')
            {
                $data['where'] = "AND a.id_terminal='$terminal'";
            }
            else if($shift!='0' AND $terminal!='0')
            {
                $data['where'] = "AND a.shift='$shift' AND a.id_terminal='$terminal'";
            }
            
            $data['dk'] = $this->laporan_model->get_dk($tgl_awal,$tgl_akhir);
           
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; }
            $data['subtotal']=0;
            $this->load->view('laporan/lap_lap6',$data);
        }
        
        function cetak_lap6()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $data['tgl_awal'] = $this->uri->segment(3);
            $data['tgl_akhir'] = $this->uri->segment(4);

	    $data['counter_1'] = $this->laporan_model->get_counter("1");
            $data['counter_2'] = $this->laporan_model->get_counter("2");
            
            show('laporan/cetak_lap6', $data ,$this->template_cetak);
           
        }
        
        function lap7()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP7';

            $data['title'] = 'PENJUALAN REKAP';
	    $data['datas'] = array();
            $data['dk'] = $this->member_model->getMasterFilter('pool_grup',"deleted_by IS NULL",'nama_grup','desc');
            $data['terminal'] = $this->member_model->getMasterFilter('terminal',"deleted_by IS NULL",'nama_terminal','asc');
            
            show('laporan/LAP_7', $data ,$this->template_member);
        }
        
        function view_lap7()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $shift = $this->uri->segment(5);
            $terminal = $this->uri->segment(6);
            
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            
            if($shift=='0' AND $terminal=='0')
            {
                $data['where'] = "";
            }
            else if($shift!='0' AND $terminal=='0')
            {
                $data['where'] = "AND a.shift='$shift'";
            }
            else if($shift =='0' AND $terminal!='0')
            {
                $data['where'] = "AND a.id_terminal='$terminal'";
            }
            else if($shift!='0' AND $terminal!='0')
            {
                $data['where'] = "AND a.shift='$shift' AND a.id_terminal='$terminal'";
            }
            
            $data['dk'] = $this->laporan_model->get_dk($tgl_awal,$tgl_akhir);
           
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; }
            $data['subtotal']=0;
            $this->load->view('laporan/lap_lap7',$data);
        }
        
        function cetak_lap7()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $shift = $this->uri->segment(5);
            $terminal = $this->uri->segment(6);
            
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            
            if($shift=='0' AND $terminal=='0')
            {
                $data['where'] = "";
            }
            else if($shift!='0' AND $terminal=='0')
            {
                $data['where'] = "AND a.shift='$shift'";
            }
            else if($shift =='0' AND $terminal!='0')
            {
                $data['where'] = "AND a.id_terminal='$terminal'";
            }
            else if($shift!='0' AND $terminal!='0')
            {
                $data['where'] = "AND a.shift='$shift' AND a.id_terminal='$terminal'";
            }
            
            $data['dk'] = $this->laporan_model->get_dk($tgl_awal,$tgl_akhir);
           
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; }
            $data['subtotal']=0;
            show('laporan/cetak_lap7', $data ,$this->template_cetak);
           
        }
        
        function lap8()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
           
            $data = $this->data;
            $data['active_bar']  = 'Laporan';
            $data['active_menu'] = 'LAP8';

            $data['title'] = 'REKAP SETORAN DINAS COUNTER TERMINAL BANDARA';
	    $data['datas'] = array();
            $data['jur'] = $this->member_model->getMasterFilter('terminal',"deleted_by IS NULL",'nama_terminal','desc');
            //$data['tr'] = $this->member_model->getMasterFilter('trayek',"deleted_by IS NULL",'nama_trayek','asc');
            
            show('laporan/LAP_8', $data ,$this->template_member);
        }
        
        function view_lap8()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $shift = $this->uri->segment(5);
            $terminal = $this->uri->segment(6);
            
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            
                    
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; $where = "deleted_at IS NULL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; $where = "id_terminal='$terminal' AND deleted_at IS NULL";}
            
            $data['trm'] = $this->member_model->getMasterFilter('terminal',$where,'id_terminal','asc');
           
            $data['list'] = $this->laporan_model->getdateelist_terminal($tgl_awal,$tgl_akhir,$terminal, $shift);
            $data['shifts'] = $shift;
            $data['trmnl'] = $terminal;
      
            if($shift == '0') {
            
            $this->load->view('laporan/lap_lap8',$data);
            }
            
            else if($shift != '0')
            {
                              
                $this->load->view('laporan/lap_lap8_shift',$data);
            }
        }
        
        function cetak_lap8()
        {
            $user= $this->session->userdata('identity'); 
            $id = $this->session->userdata('user_id');
            $data = $this->data;
            
            $tgl_awal = $this->uri->segment(3);
            $tgl_akhir = $this->uri->segment(4);
            $shift = $this->uri->segment(5);
            $terminal = $this->uri->segment(6);
            
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            
                    
            $nm_terminal = $this->member_model->get_Master_By_Id("terminal","id_terminal = '{$terminal}'","nama_terminal");
            
            if($shift=="1") {$data['shift'] = "PAGI/SHIFT I"; } else if($shift=='2') { $data['shift']="SIANG/SHIFT II"; } else {$data['shift']="SEMUA SHIFT";}
            if($terminal=="0") {$data['comt_ter'] = "SEMUA TERMINAL"; $where = "deleted_at IS NULL"; } else { $data['comt_ter']="TERMINAL ".$nm_terminal; $where = "id_terminal='$terminal' AND deleted_at IS NULL";}
            
            $data['trm'] = $this->member_model->getMasterFilter('terminal',$where,'id_terminal','asc');
           
            $data['list'] = $this->laporan_model->getdateelist_terminal($tgl_awal,$tgl_akhir,$terminal, $shift);
            $data['shifts'] = $shift;
            $data['trmnl'] = $terminal;

            if($shift == '0') {
            
                show('laporan/cetak_lap8', $data ,$this->template_cetak);
            }
            
            else if($shift != '0')
            {
                              
                show('laporan/cetak_lap8_shift', $data ,$this->template_cetak);
            }
                      
        }
        
        
///////////// VIEW CONTROLLER END //////////////////////////////////

///////////// PDF VIEW FUNCTION //////////////////////////////////
 
        function pdflap1()
	{

		$t_awal=$this->uri->segment(3);
		//echo "</br>";
		$t_akhir=$this->uri->segment(4);
		//echo "</br>";

		$verik = "";
                $jumlah_upp="";
               
		$temp_rec = $this->laporan_model->getdatelist($t_awal,$t_akhir);
		//$temp_rec2 = $this->app_model->gettotal_master($bln,$thn,$cab);
		$num_rows = $temp_rec->num_rows();

		if($num_rows > 0) // jika data ada di database
		{
		   $this->load->helper('print_rekap_helper');
		  // memanggil (instantiasi) class reportProduct di file print_rekap_helper.php
		  $a=new reportProduct();
		  // anda dapat membuat report lainnya dalam satu file print_rekap_helper.php
		  // dengan cukup mengubah setKriteria dan membuat kondisi (elseif) di file print_rekap_helper.php
		  $a->setKriteria("transaksi");
		  // judul report
		  //$a->setNama("DATA TRANSAKSI UNTUK BARANG ".$kodebarang);
		  // buat halaman
		  $a->AliasNbPages();
		  // Potrait ukuran A4
		  //$a->SetAutoPageBreak(0 , 30);
		  $a->AddPage("L","A4");

		  // ambil data dari database
		  $data=$temp_rec->row();
		  //$total=$temp_rec2->row();

		  //$a->Ln(2); // spasi enter
		  $a->SetFont('Arial','B',14); // set font,size,dan properti (B=Bold)
		  //$a->Cell(50,4,"PT Berdikari (Persero)",0,1,'C');
		 // $a->Cell(50,4,'CABANG '.$data->nama_cabang,0,1,'C');
		  $a->Ln(3);
		  
		  $a->Ln(2); // spasi enter
		  $a->SetFont('times','B',12); // set font,size,dan properti (B=Bold)
		  //$a->Cell(200,5,"LAPORAN REKAPITULASI TUNJANGAN TRANSPORTASI BULAN ". $bulan." ",$thn,1,1,'L');
		  $a->Cell(0,6,"REKAP SETORAN DINAS COUNTER TERMINAL BANDARA ",0,1,'C');
		  $a->Cell(0,6,"PERIODE  ". $t_awal ." s/d ".$t_akhir,0,1,'C');
		  $a->Ln(7);

		  $a->SetFont('times','',9);
		  // set lebar tiap kolom tabel transaksi
		  $a->SetWidths(array(7,15,130,15,10,10));
		  // set align tiap kolom tabel transaksi
		  $a->SetAligns(array("C","L","L","C","C","C"));
		  $a->SetFont('times','B',9);

		  // set nama header tabel transaksi
			$a->Cell(20,5,"tanggal",1,0,'C');
                        foreach($this->member_model->getMasterFilter('trayek','deleted_at IS NULL','id_trayek','asc')->result_array() as $r) {
			$a->Cell(25,5,$r['nama_trayek'],1,0,'C');
                        }
			$a->Ln(5);
		  $a->SetFont('times','',8);
		
		  $rec = $temp_rec->result();
		  $n=1;
                  
                   foreach($rec as $row)
                    {
                                             
                        $a->Cell(10,5,$n,'LB',0,'C');
			$a->Cell(10,5,"test",'LB',0,'C');                
                        $a->Ln(5);
                        $n++;

                    }
		    $a->Output();
		}
		else // jika data kosong
		{
		  redirect('report');
		}
		
	
		exit(); 
	}
        
        function pdfspsab()
	{

		$t_awal=$this->uri->segment(3);
		//echo "</br>";
		$t_akhir=$this->uri->segment(4);
		//echo "</br>";

		$verik = "";
                $jumlah_upp="";
		$temp_rec = $this->laporan_model->spsab($t_awal,$t_akhir);
		//$temp_rec2 = $this->app_model->gettotal_master($bln,$thn,$cab);
		$num_rows = $temp_rec->num_rows();

		if($num_rows > 0) // jika data ada di database
		{
		   $this->load->helper('print_rekap_helper');
		  // memanggil (instantiasi) class reportProduct di file print_rekap_helper.php
		  $a=new reportProduct();
		  // anda dapat membuat report lainnya dalam satu file print_rekap_helper.php
		  // dengan cukup mengubah setKriteria dan membuat kondisi (elseif) di file print_rekap_helper.php
		  $a->setKriteria("transaksi");
		  // judul report
		  //$a->setNama("DATA TRANSAKSI UNTUK BARANG ".$kodebarang);
		  // buat halaman
		  $a->AliasNbPages();
		  // Potrait ukuran A4
		  //$a->SetAutoPageBreak(0 , 30);
		  $a->AddPage("L","A4");

		  // ambil data dari database
		  $data=$temp_rec->row();
		  //$total=$temp_rec2->row();

		  //$a->Ln(2); // spasi enter
		  $a->SetFont('Arial','B',14); // set font,size,dan properti (B=Bold)
		  //$a->Cell(50,4,"PT Berdikari (Persero)",0,1,'C');
		 // $a->Cell(50,4,'CABANG '.$data->nama_cabang,0,1,'C');
		  $a->Ln(3);
		  
		  $a->Ln(2); // spasi enter
		  $a->SetFont('times','B',13); // set font,size,dan properti (B=Bold)
		  //$a->Cell(200,5,"LAPORAN REKAPITULASI TUNJANGAN TRANSPORTASI BULAN ". $bulan." ",$thn,1,1,'L');
		  $a->Cell(0,6,"LAPORAN SPSAB ",0,1,'C');
		  $a->Cell(0,6,"PERIODE  ". $t_awal ." s/d ".$t_akhir,0,1,'C');
		  $a->Ln(7);

		  $a->SetFont('times','',11);
		  // set lebar tiap kolom tabel transaksi
		  $a->SetWidths(array(7,15,130,15,10,10));
		  // set align tiap kolom tabel transaksi
		  $a->SetAligns(array("C","L","L","C","C","C"));
		  $a->SetFont('times','B',10);

		  // set nama header tabel transaksi
			$a->Cell(10,5,"NO",1,0,'C');
                        $a->Cell(40,5,"No SPSAB",1,0,'C');
			$a->Cell(25,5,"Nama Penyewa",1,0,'C');
			$a->Cell(25,5,"Tanggal Sewa",1,0,'C');
			$a->Cell(25,5,"Lama Sewa",1,0,'C');
                        $a->Cell(25,5,"Kode Bus",1,0,'C');
                        $a->Cell(25,5,"Jenis Bus",1,0,'C');
                        $a->Cell(30,5,"Jml kendaraan",1,0,'C');
                        $a->Cell(30,5,"Jml Penumpang",1,0,'C');
                        $a->Cell(30,5,"Jml UPP",1,0,'C');
			$a->Ln(5);
		  $a->SetFont('times','',8);
		
		  $rec = $temp_rec->result();
		  $n=1;
                  
                   foreach($rec as $row)
                    {
                       $jumlah_upp+=$row->tarif_h;
                       
                        $a->Cell(10,5,$n,'LB',0,'C');
			$a->Cell(40,5,$row->no_spsab,'LB',0,'C');
			$a->Cell(25,5,$row->name_sewa,'LB',0,'C');
			$a->Cell(25,5,$row->tgl_sewa,'LB',0,'C');
                        $a->Cell(25,5,$row->lama_sewa. "Hari",1,0,'C');
                        $a->Cell(25,5,$row->kode_bus,1,0,'C');
                        $a->Cell(25,5,$row->jenis_bus,1,0,'C');
                        $a->Cell(30,5,number_format($row->jml_kendaraan),1,0,'R');
                        $a->Cell(30,5,number_format($row->jml_pnp),1,0,'R');
                        $a->Cell(30,5,number_format($row->tarif_h),1,0,'R');

                       
                        $a->Ln(5);
                        $n++;
                        
                        
                    }
                    
                    $a->SetFont('times','B',8);
                    $a->Cell(235,5,"TOTAL UPP",1,0,'C');
                    $a->Cell(30,5,number_format($jumlah_upp),'LBR',0,'R');
                    $a->Ln(5);
                    

		    $a->Output();
		}
		else // jika data kosong
		{
		  redirect('report');
		}
		
	
		exit(); 
	}
//////////// END PDF ////////////////////        

}