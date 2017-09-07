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
        <div class="box box-primary" id="detail">
           <button class="btn btn-warning" style="margin: 10px 10px 10px 10px" onclick="add_master('formAddSupir','modal_form_supir','Tambah Data Terminal','index.php/master/save_terminal/insert')"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data Terminal</button>
          <?php if($this->session->flashdata('message') != "") { ?>
            <div class="callout callout-success"><p><?php echo $this->session->flashdata('message');?></p></div>
          <?php } ?>

                      <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped">
                         <thead style="font-size: 9pt; background-color: #333333; color: #ffffff; border: 0px solid transparent">
                          <tr>
                            <th>No.</th>
                            <th>Nama Terminal</th>
                            <th>Nama General Manager</th>
                            <th>NIK General Manager</th>
                            <th>Nama Staff</th>
                            <th>NIK Staff</th>
                            <th></th>
                           <!-- <th>Action</th> -->
                          </tr>
                          </thead>
                          <tbody  style="font-size: 9pt;">
                            <?php
                          
                            $no = 1;
                                foreach($query->result_array() as $dp)
                                {
                            ?>
                            <tr>
                                <td width="50"><center><?php echo $no; ?></center></td>
                                <td><center><?php echo $dp['nama_terminal']; ?></center></td>
                                <td><center><?php echo $dp['gm']; ?></center></td>
                                <td><center><?php echo $dp['gm_nik']; ?></center></td>
                                <td><center><?php echo $dp['staf']; ?></center></td>
                                <td><center><?php echo $dp['staf_nik']; ?></center></td>
                                <td width="100">
                                       <div class="btn-group">
                                         <a onclick="edit_terminal(<?php echo "'".$dp['id_terminal']."'"; ?>)" class="btn btn-warning" style="font-size: 8pt">Edit</a>
                                        <button style="font-size: 8pt" class="btn btn-danger"  type="button" name="button" onclick="delete_terminal(<?php echo "'".$dp['id_terminal']."'"; ?>)" value="Delete">Delete</button>
                                       </div><!-- /btn-group -->
                                </td>
                           </tr>
                            <?php $no++; } ?>
                          </tbody>

                        </table>

                      </div>
                  </div>
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal_form_supir" role="dialog">
    <div class="modal-dialog" style="width: 80%"> 
  <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title"</h3>
      </div>

      <div class="modal-body form" style="font-size: 9.2pt;">
           <form id="formAddSupir" class="form-horizontal" method="post">
            <input type="hidden"  name="kode_supir" id="kode_supir"/> 

            
              <div class="form-body" style="font-size: 9.2pt;">
               
                 <div class="form-group">
                  <label class="control-label col-md-3">Nama Terminal</label>
                  <div class="col-md-9">
                    <input name="nama_terminal" placeholder="Nama Terminal" class="form-control" type="text" style="font-size: 9.2pt;" >
                  </div>
                </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Perusahaan</label>
                      <div class="col-md-9">
                          <select class="form-control" name="comp" id="comp">
                              <option value="">[Pilih]</option>
                              <?php foreach($comp->result_array() as $r) { ?>
                              <option value="<?php echo $r['id_comp'];?>"><?php echo $r['nama_comp']." - ".$r['address1'];?></option>
                              <?php } ?>
                          </select>
                      </div>
                    </div>
                  <div class="form-group">
                  <label class="control-label col-md-3">General Manager</label>
                  <div class="col-md-9">
                    <input name="gm" placeholder="Nama General Manager" class="form-control" type="text" style="font-size: 9.2pt;" >
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-md-3">NIK General Manager</label>
                  <div class="col-md-9">
                    <input name="nik_gm" placeholder="NIK General Manager" class="form-control" type="text" style="font-size: 9.2pt;" >
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-md-3">Staf</label>
                  <div class="col-md-9">
                    <input name="staf" placeholder="Nama Staf" class="form-control" type="text" style="font-size: 9.2pt;" >
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-md-3">NIK Staf</label>
                  <div class="col-md-9">
                    <input name="nik_staf" placeholder="NIK Staf" class="form-control" type="text" style="font-size: 9.2pt;" >
                  </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-5 col-md-offset-3">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> POST </button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                    </div>
                </div> 

              </div>

          </form> 
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

