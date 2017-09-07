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
           <button class="btn btn-warning" style="margin: 10px 10px 10px 10px" onclick="add_master('formAddMaster','modal_form_master','Tambah Data Trayek','index.php/master/save_trayek/insert')"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data Trayek</button>
          <?php if($this->session->flashdata('message') != "") { ?>
            <div class="callout callout-success"><p><?php echo $this->session->flashdata('message');?></p></div>
          <?php } ?>

                      <div class="box-body table-responsive" >
                        <table id="example1" class="table table-bordered table-hover table-striped">
                         <thead style="font-size: 9pt; background-color: #333333; color: #ffffff; border: 0px solid transparent">
                          <tr>
                            <th>No.</th>
                            <th>Nama Trayek</th>
                            <th>Tarif</th>
                            <th>Pool</th>
                            <th>Group</th>
                           
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
                                <td><?php echo $no; ?></td>
                               <td><center><?php echo $dp['nama_trayek']; ?></center></td>
                               <td><center><?php echo $dp['tarif']; ?></center></td>
                               <td><center><?php echo $dp['nama_pool']; ?></center></td>
                               <td width="10%"><center><?php echo $dp['nama_grup']; ?></center></td>
                               
                               <td width="100">
                                       <div class="btn-group">
                                         <a onclick="edit_trayek('<?php echo $dp['id_trayek']; ?>')" class="btn btn-warning" style="font-size: 8pt">Edit</a>
                                        <button style="font-size: 8pt" class="btn btn-danger"  type="button" name="button" onclick="delete_trayek(<?php echo $dp['id_trayek']; ?>)" value="Delete">Delete</button>
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

<div class="modal fade" id="modal_form_master" role="dialog">
    <div class="modal-dialog" style="width: 60%"> 
  <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title"</h3>
      </div>

      <div class="modal-body form" style="font-size: 9.2pt;">
           <form id="formAddMaster" name="formAddMaster" class="form-horizontal" method="post">
            <input type="hidden"  name="id"/> 
           
            
              <div class="form-body" style="font-size: 9.2pt;">
               
                 <div class="form-group">
                  <label class="control-label col-md-3">Nama Trayek</label>
                  <div class="col-md-9">
                    <input name="nama_trayek" placeholder="Masukkan Nama Trayek" class="form-control" type="text" style="font-size: 9.2pt;" >
                  </div>
                </div>

                <div class="form-group">
                   <label class="control-label col-md-3">Tarif</label>
                   <div class="col-md-9">
                     <input name="tarif" placeholder="Masukkan Tarif" class="form-control" type="text" style="font-size: 9.2pt;" >
                    </div>
                </div>
                <div class="form-group">
                      <label class="col-md-3 control-label">Pool</label>
                      <div class="col-md-9">
                          <select class="form-control" name="pool" id="pool">
                              <option value="">[Pilih]</option>
                              <?php foreach($pool->result_array() as $r) { ?>
                              <option value="<?php echo $r['id_pool'];?>"><?php echo $r['nama_pool'];?></option>
                              <?php } ?>
                          </select>
                      </div>
                    </div>
               
                 <div class="form-group">
                      <label class="col-md-3 control-label">Group</label>
                      <div class="col-md-9">
                          <select class="form-control" name="group" id="group">
                              <option value="">[Pilih]</option>
                              <?php foreach($grp->result_array() as $r) { ?>
                              <option value="<?php echo $r['id_grup'];?>"><?php echo $r['nama_grup'];?></option>
                              <?php } ?>
                          </select>
                      </div>
                    </div>
             <div class="form-group">
                      <label class="col-md-3 control-label">Group Terminal</label>
                      <div class="col-md-9">
                          <select class="form-control" name="terminal" id="terminal">
                              <option value="">[Pilih]</option>
                              <?php foreach($trm->result_array() as $r) { ?>
                              <option value="<?php echo $r['id_tg'];?>"><?php echo $r['nama_tg'];?></option>
                              <?php } ?>
                          </select>
                      </div>
                    </div>
                <div class="form-group">
                    <div class="col-md-5 col-md-offset-3">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> SIMPAN </button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                    </div>
                </div> 

              </div>

          </form> 
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

