<div class="content-wrapper">

    <section class="content-header">
      <h3 style="color: #454545; font-family: goudy old style; text-transform: uppercase; font-weight: bold">
        <?php echo $title; ?>
      </h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $active_bar;?></a></li>
        <li class="active"><?php echo $active_menu;?></li>
      </ol>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="box box-primary">
                 
                      <div class="box-body"  style="font-size: 9.5pt;">
                        <?php if($this->session->flashdata('message') != "") { ?>
                            <div class="callout callout-success"><p><?php echo $this->session->flashdata('message');?></p></div>
                        <?php } ?> 
                      
                          <div class="form-group " style="padding: 5px 5px 5px 5px; width: 80%;">
                            <label style="float: right" class="control-label"><a href="member/edit"><span class="glyphicon glyphicon-edit" title="Edit Profile"></span></a></label>
                          </div>
                          
                          <div class="col-md-9 form-group  well well-sm no-shadow" style="padding: 5px 5px 5px 5px ">
                            <label class="col-md-2 control-label">Full name</label>
                            <label class="col-md-1 control-label"> : </label>
                            <div><?php echo $first_name." ".$last_name; ?></div>
                          </div>
                            
                          <div class="col-md-12 form-group" style="padding: 5px 5px 5px 5px; background-color: white;  ">
                            <label class="col-md-2 control-label"><a href="account/change_password" class="text-center" style="font-size: 10pt; color: royalblue;">Change Password</a></label>
                          </div> 

                     </div>           
        </div>
    </section>
    <!-- /.content -->
</div>
