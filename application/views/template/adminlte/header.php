<?php
if($this->session->userdata('user_id')=="")
{
	redirect('account/Login');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADMIN COUNTER</title>
  <base href="<?php echo base_url(); ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="themes/adminlte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="themes/adminlte/dist/css/ionicons.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="themes/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="themes/adminlte/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="themes/adminlte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="themes/adminlte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="themes/adminlte/ratings/rating.css">
  <!-- <link rel="stylesheet" href="themes/adminlte/dist/css/form.css">-->
  <!-- Bootstrap Validator -->
  <link rel="stylesheet" href="themes/adminlte/dist/css/bootstrapValidator.css"/>
  <link href="themes/adminlte/datepicker/css/datepicker.css" rel="stylesheet" type="text/css">
  <link href="themes/adminlte/datepicker/less/datepicker.less" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('themes/adminlte/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('themes/adminlte/datatables/css/responsive.dataTables.min.css')?>" rel="stylesheet">  
  <link href="<?php echo base_url('themes/adminlte/select2/select2.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('themes/adminlte/select2/select2-bootstrap.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('themes/adminlte/dist/css/autocomplete.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('themes/adminlte/dist/css/paging.css')?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url();?>themes/adminlte/rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>themes/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link href='themes/adminlte/dist/css/jquery.treegrid.css' rel="stylesheet">
  <style>
  #load { height: 100%; width: 100%; }
  #load {
    position    : fixed;
    z-index     : 99999; /* or higher if necessary */
    top         : 0;
    left        : 0;
    overflow    : hidden;
    text-indent : 100%;
    font-size   : 0;
    opacity     : 0.6;
    background  : #E0E0E0  url(<?php echo base_url('assets/images/loaders/loader3.gif');?>) center no-repeat;
  }
td.details-control {
    background: url('themes/adminlte/datatables/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('themes/adminlte/datatables/images/details_close.png') no-repeat center center;
}
 </style>

</head>
<body class="hold-transition skin-black-light sidebar-mini">
    <div id="load"></div> 
<div class="wrapper">



