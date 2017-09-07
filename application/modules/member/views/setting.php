<div class="content-wrapper">
<!-- Main content -->

    <section class="content-header">
      <h3 style="color: #454545; font-family:  text-transform: uppercase; font-weight: bold">
        <?php echo $title; ?>
      </h3>
      <ol class="breadcrumb">
        <li><a href="index.php/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="index.php/member/profile"><?php echo $active_bar;?></a></li>
        <li><a href="index.php/member/profile"><?php echo $active_menu;?></a></li>
        <li class="active"><?php echo $active_submenu;?></li>
      </ol>
    </section>

    <section class="content">          
     <div class="box box-primary">
                    
         <div class="box-body">
          <?php if($this->session->flashdata('message') != "") { ?>
            <div class="callout callout-success"><p><?php echo $this->session->flashdata('message');?></p></div>
          <?php } ?>
         <form id="userForm" name="userForm" class="form-horizontal" method="post" action="<?php echo base_url();?>member/setting_edit" style="float: left;  width: 50%;">
              <div class="form-group">                 
                <label class="col-md-4 control-label">Perusahaan</label>
                <div class="col-md-8">  
                <input type="text" class="form-control" value="<?php echo $comp; ?>" name="name_comp">
                <input type="hiiden" class="form-control" value="<?php echo $id_comp; ?>" name="id_comp">
                </div>
              </div>

              <div class="form-group">                 
                <label class="col-md-4 control-label">Alamat</label>
                <div class="col-md-8">  
                    <textarea name="address1" class="form-control"> <?php echo $addr;?> </textarea>
                </div>
              </div>  
              <div class="form-group">                 
                <label class="col-md-4 control-label">Telp</label>
                <div class="col-md-8">  
                <input type="text" class="form-control" value="<?php echo $tlp; ?>" name="telp">
                </div>
              </div> 
              <div class="form-group">                 
                <label class="col-md-4 control-label">Fax</label>
                <div class="col-md-8">  
                <input type="text" class="form-control" value="<?php echo $fax; ?>" name="fax">
                </div>
              </div> 
             <div class="form-group">                 
                <label class="col-md-4 control-label">Terminal</label>
                <div class="col-md-8">  
                  <select  class="form-control" name="terminal">
                    <option value="">[Pilih Terminal]</option>
                    <?php foreach($tr->result_array() as $r) { ?>
                    <option value="<?php echo $r['id_terminal'];?>" <?php if($r['id_terminal']==$trmn){ echo "selected='selected'"; }?>><?php echo $r['nama_terminal'];?></option>
                    <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">                 
                <label class="col-md-4 control-label">Counter</label>
                <div class="col-md-8">  
                  <select  class="form-control" name="counter">
                    <option value="">[PIlih Posisi]</option>
                    <option value="1" <?php if('1'==$counter){ echo "selected='selected'"; }?>>Counter 1</option>
                    <option value="2" <?php if('2'==$counter){ echo "selected='selected'"; }?>>Counter 2</option>
                </select>
                </div>
              </div>

             <br/><br/>

             <div class="row" style="margin-left: 10%;">
                <div class="col-md-5">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">UBAH SETTING</button>
                </div>
                                        <!-- /.col -->
                </div>                         
        </form>
        </div>
       </div>
    </section>
    <!-- /.content -->
    
      