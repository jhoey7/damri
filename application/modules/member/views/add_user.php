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
         <form id="userForm" name="userForm" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/auth/create_user/admin" style="float: left;  width: 50%;">
              <div class="form-group">                 
                <label class="col-md-4 control-label">First Name</label>
                <div class="col-md-8">  
                <input type="text" class="form-control" placeholder="First Name" name="first_name">
                </div>
              </div>

              <div class="form-group">                 
                <label class="col-md-4 control-label">Last Name</label>
                <div class="col-md-8">  
                <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                </div>
              </div>
              <div class="form-group">                 
                <label class="col-md-4 control-label">Posisi</label>
                <div class="col-md-8">  
                  <select  class="form-control" name="level">
                    <option value="">[PIlih Posisi]</option>
                    <option value="0">Admin</option>
                    <option value="1">Counter</option>
                    <!--<option value="2">Order</option>
                    <option value="3">PPA</option>
                    <option value="4">Timer</option>
                    <option value="5">Setoran</option>
                    <option value="6">Pengemudi</option>-->
                </select>
                </div>
              </div>              
             <div class="form-group">                 
                <label class="col-md-4 control-label">Terminal</label>
                <div class="col-md-8">  
                  <select  class="form-control" name="terminal">
                    <option value="">[Pilih Terminal]</option>
                    <?php foreach($tr->result_array() as $r) { ?>
                    <option value="<?php echo $r['id_terminal'];?>"><?php echo $r['nama_terminal'];?></option>
                    <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">                 
                <label class="col-md-4 control-label">Counter</label>
                <div class="col-md-8">  
                  <select  class="form-control" name="counter">
                    <option value="">[PIlih Posisi]</option>
                    <option value="1">Counter 1</option>
                    <option value="2">Counter 2</option>
                    <!--<option value="2">Order</option>
                    <option value="3">PPA</option>
                    <option value="4">Timer</option>
                    <option value="5">Setoran</option>
                    <option value="6">Pengemudi</option>-->
                </select>
                </div>
              </div>
              <div class="form-group">                 
                <label class="col-md-4 control-label">Username</label>
                <div class="col-md-8">  
                <input type="text" class="form-control" placeholder="Username" name="identity">
                </div>
              </div>
              <div class="form-group">                 
                <label class="col-md-4 control-label">Default Password</label>
                <div class="col-md-8">  
                <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
              </div>
              <div class="form-group">                 
                <label class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-8">  
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword">
                </div>
              </div>

             <br/><br/>

             <div class="row" style="margin-left: 10%;">
                <div class="col-md-5">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Add</button>
                </div>
                                        <!-- /.col -->
                </div>                         
        </form>
        </div>
       </div>
    </section>
    <!-- /.content -->
    
         <div class="box-body">
         <?php if($this->session->flashdata('delete') != "") { ?>
            <div class="callout <?php echo $this->session->flashdata('callout_delete'); ?>"><p><?php echo $this->session->flashdata('delete');?></p></div>
          <?php } ?>
                        <table id="example1" class="table table-bordered table-hover table-striped">
                         <thead style="font-size: 9pt; background-color: #003366; color: white">
                          <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Action</th>
                                <!--<th>Transaction level</th>-->
                               <!-- <th>Action</th> -->
                              </tr>
                          </thead>
                          <tbody  style="font-size: 9pt;">
                          <?php 
                          $no = 1;
                            foreach($query->result_array() as $row)
                            {
                               if($row['level'] == '0') { $level ='Admin'; } else if($row['level'] == '1') { $level ='Counter'; } 
                               /*else if($row['level'] == '2') { $level ='Order'; } 
                               else if($row['level'] == '3') { $level ='PPA'; }
                               else if($row['level'] == '4') { $level ='TIMER'; }
                               else if($row['level'] == '5') { $level ='Setoran'; }
                               else if($row['level'] == '6') { $level ='Pengmeudi'; }*/
                               else { $level ='Public'; } 
                                
                          ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $level;?></td>
                                <td><button style="font-size: 8pt" class="btn btn-danger"  type="button" name="button" onclick="delete_user(<?php echo $row['id']; ?>)" value="Delete">Delete</button></td>
                            </tr> 
                            <?php  $no++; } ?>     
                          </tbody>

                        </table>

                      </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>