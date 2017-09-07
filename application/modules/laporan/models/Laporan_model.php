<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Laporan_model extends MY_Model
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
 
  function lap1($trayek,$tgl, $terminal)
  {
      if($terminal=='0' AND $trayek=='0') {
          $strsql = "SELECT SUM(total) as total FROM trans 
                  WHERE id_trayek='$trayek' AND tgl_trans LIKE '%$tgl%'";
      }
      else if($terminal!='0' AND $trayek=='0')
      {
          $strsql = "SELECT SUM(total) as total FROM trans 
                  WHERE id_terminal='$terminal' AND tgl_trans LIKE '%$tgl%'";
      }
      else if($terminal=='0' AND $trayek!='0')
      {
          $strsql = "SELECT SUM(total) as total FROM trans 
                  WHERE id_trayek='$trayek' AND tgl_trans LIKE '%$tgl%'";
      }
      else if($terminal!='0' AND $trayek!='0')
      {
        $strsql = "SELECT SUM(total) as total FROM trans 
                  WHERE id_trayek='$trayek' AND tgl_trans LIKE '%$tgl%' AND id_terminal='$terminal'";
      }
     
     $query=$this->db->query($strsql);
     foreach($query->result_array() as $r)
     {
         return $r['total'];
     }
      
  }
  
  function sum_lap1($tgl_awal, $tgl_akhr, $tryk, $trmnl, $field)
  {
      if($trmnl=='0') 
      {
        $strsql = "SELECT SUM($field) as ttl FROM trans
                WHERE tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND id_trayek='$tryk'";
      }
      else if($trmnl!='0')
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans
                WHERE tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND id_trayek='$tryk' AND id_terminal='$trmnl'";
      }
      $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
  
  function sum_lap_samping($tgl, $tryk, $trmnl, $field)
  {
      if($tryk=='0' AND $trmnl=='0') 
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans WHERE tgl_trans LIKE '%$tgl%'"; 
      }
      else if($tryk=='0' AND $trmnl!='0') 
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans WHERE tgl_trans LIKE '%$tgl%' AND id_terminal='$trmnl'";
      }
      else if($tryk!='0' AND $trmnl=='0') 
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans WHERE tgl_trans LIKE '%$tgl%' AND id_trayek='$tryk'";
      }
      else 
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans WHERE tgl_trans LIKE '%$tgl%' AND id_trayek='$tryk' AND id_terminal='$trmnl'";
      }

     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
  
 function sum_lap2($tgl_awal, $tryk, $shift, $field, $counter, $terminal)
 {
         $strsql = "SELECT SUM(ssql.$field) AS ttl
                FROM 
                (
                SELECT  a.created_by,c.nama_terminal AS trmnl,a.shift, a.qty, a.total
                                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                                LEFT JOIN terminal c ON b.id_terminal=c.id_terminal
                                WHERE a.tgl_trans LIKE '%$tgl_awal%' AND a.deleted_at IS NULL AND a.shift='$shift' AND a.created_by IN (SELECT DISTINCT id FROM users WHERE deleted_at IS NULL) AND a.id_trayek='$tryk' AND a.created_by='$counter'
                                ORDER BY a.shift) AS ssql
                                LEFT JOIN users u ON ssql.created_by=u.id 
                                GROUP BY ssql.created_by";

     $query=$this->db->query($strsql);
     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
     
 }
 
   function sum_lap2_bawah($tgl_awal, $tgl_akhr, $tryk, $trmnl, $shift, $field)
  {
      if($trmnl=='0' AND $shift!="0") 
      {
        $strsql = "SELECT SUM($field) as ttl FROM trans
                WHERE tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND id_trayek='$tryk' AND shift='$shift'";
      }
      else if($trmnl!='0' AND $shift=="0")
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans
                WHERE tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND id_trayek='$tryk' AND id_terminal='$trmnl'";
      }
      else if($trmnl=='0' AND $shift=="0")
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans
                WHERE tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND id_trayek='$tryk'";
      }
      else if($trmnl!='0' AND $shift!="0")
      {
          $strsql = "SELECT SUM($field) as ttl FROM trans
                WHERE tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND id_trayek='$tryk' AND id_terminal='$trmnl' AND shift='$shift'";
      }
      $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
  
   function sum_lap2_samping($tgl, $trmnl, $counter, $shift,$field)
  {
     
     $strsql = "SELECT SUM($field) as ttl FROM trans WHERE tgl_trans LIKE '%$tgl%' AND created_by='$counter' AND shift='$shift'";

     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
 
  function sum_lap3($tgl_awal, $tgl_akhr, $trayek,$pool, $field)
 {
     $strsql = " 
                SELECT SUM(a.$field) AS ttl
                FROM trans a LEFT JOIN trayek b ON a.id_trayek=b.id_trayek
                LEFT JOIN pool c ON b.id_pool=c.id_pool
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND a.id_trayek='$trayek' AND c.id_pool='$pool'";
     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
     
 }
 
 function sum_lap4($tgl_awal, $tgl_akhr, $pool, $field)
 {
     $strsql = " 
                SELECT SUM(a.$field) AS ttl
                FROM trans a LEFT JOIN trayek b ON a.id_trayek=b.id_trayek
                LEFT JOIN pool c ON b.id_pool=c.id_pool
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND c.id_pool='$pool'";
     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
     
 }
 
    function sum_lap5($tgl_awal, $grup, $counter, $field, $shift, $terminal)
 {
     if($grup=='0')
     {
     $strsql = " 
                SELECT SUM(a.$field) AS ttl FROM trans a LEFT JOIN trayek b ON a.id_trayek=b.id_trayek
                LEFT JOIN pool_grup c ON b.id_group=c.id_grup
                WHERE a.tgl_trans LIKE '%$tgl_awal%' AND c.id_grup='$grup' AND a.shift='$shift' AND a.created_by='$counter' AND a.id_terminal='$terminal'
                GROUP BY c.id_grup ";
     }
     else if($grup!='0')
     {
         $strsql = " 
                SELECT SUM(a.$field) AS ttl FROM trans a LEFT JOIN trayek b ON a.id_trayek=b.id_trayek
                LEFT JOIN pool_grup c ON b.id_group=c.id_grup
                WHERE a.tgl_trans LIKE '%$tgl_awal%' AND c.id_grup='$grup' AND a.shift='$shift' AND a.created_by='$counter' AND a.id_terminal='$terminal'
                GROUP BY c.id_grup ";
     }
     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
     
 }
 
 function ttl_lap5($tgl_awal, $tgl_akhr, $grup,$field)
 {
     $strsql = " 
                    SELECT SUM(a.$field) AS ttl
                    FROM trans a LEFT JOIN trayek b ON a.id_trayek=b.id_trayek
                    LEFT JOIN pool_grup c ON b.id_group=c.id_grup
                    WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND c.id_grup='$grup'";
     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
    
 }
 
    function sum_lap5_bawah($tgl_awal, $tgl_akhr, $grup, $trmnl, $shift, $field)
  {
      if($trmnl=='0' AND $shift!="0") 
      {
        $strsql = "SELECT SUM($field) as ttl 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND d.id_grup='$grup' AND a.shift='$shift'";
      }
      else if($trmnl!='0' AND $shift=="0")
      {
          $strsql = "SELECT SUM($field) as ttl 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND d.id_grup='$grup' AND a.id_terminal='$trmnl'";
      }
      else if($trmnl=='0' AND $shift=="0")
      {
          $strsql = "SELECT SUM($field) as ttl 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND d.id_grup='$grup'";
      }
      else if($trmnl!='0' AND $shift!="0")
      {
          $strsql = "SELECT SUM($field) as ttl 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND d.id_grup='$grup' AND a.id_terminal='$trmnl' AND a.shift='$shift'";
      }
      $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
  
   function sum_lap5_samping($tgl, $trmnl, $counter, $shift,$field)
  {
     
     $strsql = "SELECT SUM($field) as ttl FROM trans WHERE tgl_trans LIKE '%$tgl%' AND created_by='$counter' AND shift='$shift' AND a.id_terminal='$trmnl'";

     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
  
 function lap6($tgl_awal, $tgl_akhir,$id_group,$where)
 {
          $strsql = 
                    "
                                SELECT a.id_trans,a.tgl_trans,a.id_trayek,a.qty, b.nama_trayek, b.tarif FROM trans a
                                 LEFT JOIN trayek b ON a.id_trayek=b.id_trayek 
                                LEFT JOIN pool_grup c ON b.id_group=c.id_grup
                                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhir','%Y-%m-%d') AND b.id_group='$id_group' $where";
     return $query=$this->db->query($strsql);

     
 }
 
 function lap7($tgl_awal, $tgl_akhir,$id_group,$where)
 {
          $strsql = 
                    "SELECT ssql.nama_trayek, SUM(ssql.qty) AS qty, ssql.tarif, ssql.id_trayek
                                FROM
                                (
                                SELECT a.id_trans,a.tgl_trans,a.id_trayek,a.qty, b.nama_trayek, b.tarif FROM trans a
                                 LEFT JOIN trayek b ON a.id_trayek=b.id_trayek 
                                LEFT JOIN pool_grup c ON b.id_group=c.id_grup
                                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhir','%Y-%m-%d') AND b.id_group='$id_group' $where) AS ssql
                                 GROUP BY ssql.id_trayek";
     return $query=$this->db->query($strsql);

     
 }
 
 function sum_lap8($tgl_awal,$counter, $field, $shift, $terminal)
 {

     $strsql = " 
                SELECT SUM(a.$field) AS ttl FROM trans a 
                WHERE a.tgl_trans LIKE '%$tgl_awal%' AND a.shift='$shift' AND a.created_by='$counter' AND a.id_terminal='$terminal' ";
    
     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
     
 }
 
 function sum_lap8_bawah($tgl_awal, $tgl_akhr, $trmnl, $shift, $field)
  {
      if($shift!="0") 
      {
        $strsql = "SELECT SUM($field) as ttl 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND a.id_terminal='$trmnl' AND a.shift='$shift'";
      }
      else if($shift=="0")
      {
          $strsql = "SELECT SUM($field) as ttl 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhr','%Y-%m-%d') AND a.id_terminal='$trmnl'";
      }
     
      $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
  
     function sum_lap8_samping($tgl,$counter, $shift,$field)
  {
     
     $strsql = "SELECT SUM($field) as ttl FROM trans WHERE tgl_trans LIKE '%$tgl%' AND created_by='$counter' AND shift='$shift' ";

     $query=$this->db->query($strsql);

     foreach($query->result_array() as $r)
     {
         return $r['ttl'];
     }
      
  }
  
  public function getdatelist($tgl_awal, $tgl_akhir)
  {
      $strsql = "SELECT ADDDATE('{$tgl_awal}', INTERVAL @i:=@i+1 DAY) AS DAY
                FROM (
                SELECT a.a
                FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                ) a
                JOIN (SELECT @i := -1) r1
                WHERE 
                @i < DATEDIFF('{$tgl_akhir}', '{$tgl_awal}')";
     $query=$this->db->query($strsql);

     return $query;
      
  }
  
  function getdateelist_counter($tgl_awal, $tgl_akhir, $trayek, $terminal, $shift)
  {
      if($trayek == '0' AND $terminal == '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL)AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($trayek != '0' AND $terminal == '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_trayek='$trayek')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($trayek == '0' AND $terminal != '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_terminal='$terminal')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($trayek == '0' AND $terminal == '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($trayek != '0' AND $terminal != '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_trayek='$trayek' AND a.id_terminal='$terminal')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($trayek != '0' AND $terminal == '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_trayek='$trayek' AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
            else if($trayek == '0' AND $terminal != '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_terminal='$terminal' AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else
      {
          $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_trayek='$trayek' AND a.id_terminal='$terminal' AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
     $query=$this->db->query($strsql);

     return $query;
  }
  
  function getdateelist_terminal($tgl_awal, $tgl_akhir, $terminal, $shift)
  {
      if($terminal == '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL)AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
     
      else if( $terminal != '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_terminal='$terminal')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($terminal == '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      
      else if($terminal != '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a WHERE a.deleted_at IS NULL AND a.id_terminal='$terminal' AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }

     $query=$this->db->query($strsql);

     return $query;
  }
  
  public function get_counter($shift,$tgl,$trayek,$terminal)
  {
      if($trayek!='0' AND $terminal!='0')
      {
        $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                WHERE a.tgl_trans like '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' AND a.id_trayek='$trayek' AND a.id_terminal='$terminal'
                ORDER BY a.shift";
      }
      else if($terminal=='0' AND $trayek!='0')
      {
          $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                WHERE a.tgl_trans like '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' AND a.id_trayek='$trayek'
                ORDER BY a.shift";
      }
      else if($terminal!='0' AND $trayek=='0')
      {
          $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                WHERE a.tgl_trans like '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' AND a.id_terminal='$terminal'
                ORDER BY a.shift";
      }
      else if($terminal=='0' AND $trayek=='0')
      {
          $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                WHERE a.tgl_trans like '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift'
                ORDER BY a.shift";
      }
      
     $query=$this->db->query($strsql);

     return $query;
  }
  
  
  function getdateelist_dk($tgl_awal, $tgl_akhir, $grup, $terminal, $shift)
  {
      if($grup == '0' AND $terminal == '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup WHERE a.deleted_at IS NULL)AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($grup != '0' AND $terminal == '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup WHERE a.deleted_at IS NULL AND d.id_grup='$grup')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($grup == '0' AND $terminal != '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                        WHERE a.deleted_at IS NULL AND a.id_terminal='$terminal')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($grup == '0' AND $terminal == '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup WHERE a.deleted_at IS NULL AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($grup != '0' AND $terminal != '0' AND $shift == '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup 
                        WHERE a.deleted_at IS NULL AND d.id_grup='$grup' AND a.id_terminal='$terminal')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else if($grup != '0' AND $terminal == '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup 
                        WHERE a.deleted_at IS NULL AND d.id_grup='$grup' AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
            else if($grup == '0' AND $terminal != '0' AND $shift != '0')
      {
            $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup 
                        WHERE a.deleted_at IS NULL AND a.id_terminal='$terminal' AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
      else
      {
          $strsql = "SELECT CASE WHEN t.tgl IS NOT NULL THEN t.tgl ELSE '' END AS DAY
                        FROM
                        (
                        SELECT  a.tgl_trans 
                        FROM trans a LEFT JOIN users b ON a.created_by=b.id 
			LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
			LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
			LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                        WHERE a.deleted_at IS NULL AND d.id_grup='$grup' AND a.id_terminal='$terminal' AND a.shift='$shift')AS ssql2
                        INNER JOIN 
                        (SELECT ADDDATE('$tgl_awal', INTERVAL @i:=@i+1 DAY) AS tgl
                                        FROM (
                                        SELECT a.a
                                        FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                                        ) a
                                        JOIN (SELECT @i := -1) r1
                                        WHERE 
                                        @i < DATEDIFF('$tgl_akhir', '$tgl_awal')) AS t ON ssql2.tgl_trans=t.tgl
                                        GROUP BY t.tgl";
      }
     $query=$this->db->query($strsql);

     return $query;
  }
  
  public function get_counter_lap5($shift,$tgl,$pool,$terminal)
  {
      if($pool!='0' AND $terminal!='0')
      {
        $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift, a.id_terminal 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans LIKE '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' AND d.id_grup='$pool' AND a.id_terminal='$terminal'
                ORDER BY a.shift";
      }
      else if($terminal=='0' AND $pool!='0')
      {
          $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift , a.id_terminal 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans LIKE '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' AND d.id_grup='$pool' 
                ORDER BY a.shift";
      }
      else if($terminal!='0' AND $pool=='0')
      {
          $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift , a.id_terminal 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans LIKE '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' AND  a.id_terminal='$terminal'
                ORDER BY a.shift";
      }
      else if($terminal=='0' AND $pool=='0')
      {
          $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift , a.id_terminal 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans LIKE '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' 
                ORDER BY a.shift";
      }
      
     $query=$this->db->query($strsql);

     return $query;
  }
  
  public function get_counter_lap8($shift,$tgl,$terminal)
  {
      if($terminal!='0')
      {
        $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift, a.id_terminal 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans LIKE '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' AND a.id_terminal='$terminal'
                ORDER BY a.shift";
      }
     
      else if($terminal=='0')
      {
          $strsql = "SELECT DISTINCT b.username AS counter,  a.created_by,c.nama_terminal AS trmnl,a.shift , a.id_terminal 
                FROM trans a LEFT JOIN users b ON a.created_by=b.id 
                LEFT JOIN terminal c ON a.id_terminal=c.id_terminal
                LEFT JOIN trayek e ON a.id_trayek=e.id_trayek
                LEFT JOIN pool_grup d ON e.id_group=d.id_grup
                WHERE a.tgl_trans LIKE '%$tgl%' AND a.deleted_at IS NULL AND a.shift='$shift' 
                ORDER BY a.shift";
      }
      
     $query=$this->db->query($strsql);

     return $query;
  }
  
  function get_dk($tgl_awal,$tgl_akhir)
  {
      $strsql = "SELECT DISTINCT c.id_grup, c.nama_grup FROM trans a 
		LEFT JOIN trayek b ON a.id_trayek=b.id_trayek
                LEFT JOIN pool_grup c ON b.id_group=c.id_grup
                WHERE a.tgl_trans BETWEEN STR_TO_DATE('$tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$tgl_akhir','%Y-%m-%d')";
      
     $query=$this->db->query($strsql);

     return $query;
      
  }
}