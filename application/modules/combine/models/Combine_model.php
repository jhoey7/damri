<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Combine_model extends CI_Model
{
	
	function combine_data() {
                foreach (glob("D:\BackupCounter/*.data") as $filename) {
            mysql_connect('localhost', 'root', 'b4s03tad4mr!');
            mysql_select_db('counter');
            $templine = '';
            $lines = file($filename);
            foreach ($lines as $line) {
               $templine .= $line;
               if (substr(trim($line), -1, 1) == ';') {
                   $no_trans    = substr(trim($templine), -32, 14);
                   $query = $this->db->query("SELECT no_trans FROM trans WHERE no_trans = '".$no_trans."'");
                   if ($query->num_rows() < 1) {
                       mysql_query($templine);
                   }
                   $templine = '';
               }
           }
            $exec = true;
            unlink($filename);
        }
        if($exec) {
            return array('msg'=>'&nbsp;Data Berhasil di Transfer.','status'=>'success');
        }else {
            return array('msg'=>'&nbsp;Data Gagal di Transfer.','status'=>'danger');
        }
    }
}
?>