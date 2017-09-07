<div class="content-wrapper">
<!-- Main content -->

    <section class="content-header">
      <h3 style="color: #454545;  text-transform: uppercase; font-weight: bold">
        <?php echo $title; ?>
      </h3>
      <ol class="breadcrumb">
        <li><a href="index.php/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="index.php/member/profile"><?php echo $active_bar;?></a></li>
        <li class="active"><?php echo $active_menu;?></li>
      </ol>
    </section>

    <section class="content" id="content"> 

<div class="box box-danger">
        <form id="laporan_ak13" name="laporan_ak13" class="form-horizontal" method="post" action="index.php/laporan/save_ap1" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="box-body">
              <div class="row">
                
                <div class="col-xs-3">
                    <label class="label-form">Tanggal Awal</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="transaction_date_1" name="transaction_date_1">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div>
                  
                  <div class="col-xs-3">
                    <label class="label-form">Tanggal Akhir</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="transaction_date" name="transaction_date">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                </div>
                  
                 <div class="col-xs-2">
                    <label class="label-form">Terminal</label>
                    <div class="input-group">
                    <select  class="form-control" name="terminal" id="terminal">
                      <option value="0">SEMUA</option>
                      <?php foreach($terminal->result_array() as $r) { ?>
                      <option value="<?php echo $r['id_terminal'];?>"><?php echo $r['nama_terminal'];?></option>
                      <?php } ?>
                  </select>
                    </div>
                </div>
                  
                  <div class="col-xs-2">
                    <label class="label-form">Shift</label>
                    <div class="input-group">
                        <select  class="form-control" name="counter" id="counter">
                            <option value="0">SEMUA</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>                                
              </div>
                <div class="row">
                <div class="col-xs-10">
                    <br/>
                        <button type="button" class="btn btn-primary" onclick="tampilkan_lp7()"><i class="fa fa-send"></i> Tampilkan </button>
                </div>
                </div>
            </div>
        </form>
            <!-- /.box-body -->
          </div>
        
      <div class="row" id="listed">
          
      </div>
          
    </section>
    <!-- /.content -->
</div>

