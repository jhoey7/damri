  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="font-size: 9.1pt">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="themes/adminlte/dist/img/avatar7.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('identity'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li  <?=$active_menu=='dashboard'?'class="active"':''?>>
          <a href="<?=base_url('dashboard')?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
 
        <li class="treeview <?=$active_bar=='Members'?'active':''?>">
          <a href="#">
            <i class="fa fa-users"></i> <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu " >
            <li <?=$active_menu=='Combine'?'class="active"':''?>><a href="<?=base_url('combine/index')?>" ><i class="fa fa-circle-o"></i>Combine</a></li>
            <li <?=$active_menu=='Setting'?'class="active"':''?>><a href="<?=base_url('member/setting')?>" ><i class="fa fa-circle-o"></i>Setting Perangkat</a></li>
            <li <?=$active_menu=='Tambah User'?'class="active"':''?>><a href="<?=base_url('member/AddUser')?>"><i class="fa fa-circle-o"></i>Tambah User</a></li> 
           
          </ul>
        </li>

         <li class="treeview <?=$active_bar=='Master'?'active':''?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Master</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu ">
            <li <?=$active_menu=='Trayek'?'class="active"':''?>><a href="<?=base_url('master/trayek')?>" ><i class="fa fa-circle-o"></i>Trayek</a></li>
            <li <?=$active_menu=='Terminal'?'class="active"':''?>><a href="<?=base_url('master/terminal')?>"><i class="fa fa-circle-o"></i>Terminal</a></li>
           
          </ul>
        </li>

        <li class="treeview <?=$active_bar=='Laporan'?'active':''?>">
          <a href="#">
            <i class="fa fa-area-chart"></i> <span>Laporan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu ">
         
            <li <?=$active_menu=='LAP1'?'class="active"':''?>><a href="<?=base_url('laporan/lap1')?>" ><i class="fa fa-circle-o"></i>Rekap Tanggal </a></li>
            <li <?=$active_menu=='LAP2'?'class="active"':''?>><a href="<?=base_url('laporan/lap2')?>"><i class="fa fa-circle-o"></i>Rekap Operator</a></li>
            <li <?=$active_menu=='LAP8'?'class="active"':''?>><a href="<?=base_url('laporan/lap8')?>"><i class="fa fa-circle-o"></i>Rekap Terminal</a></li>
            <li <?=$active_menu=='LAP5'?'class="active"':''?>><a href="<?=base_url('laporan/lap5')?>"><i class="fa fa-circle-o"></i>Rekap Dalam Kota</a></li>
            <li <?=$active_menu=='LAP3'?'class="active"':''?>><a href="<?=base_url('laporan/lap3')?>"><i class="fa fa-circle-o"></i>Rekap POOL 1</a></li>
            <li <?=$active_menu=='LAP4'?'class="active"':''?>><a href="<?=base_url('laporan/lap4')?>"><i class="fa fa-circle-o" ></i>Rekap POOL 2</a></li>
            
            <li <?=$active_menu=='LAP6'?'class="active"':''?>><a href="<?=base_url('laporan/lap6')?>"><i class="fa fa-circle-o"></i>Cetak Detail</a></li>
            <li <?=$active_menu=='LAP7'?'class="active"':''?>><a href="<?=base_url('laporan/lap7')?>"><i class="fa fa-circle-o"></i>Cetak Rekap</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
