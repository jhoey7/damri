<div class="content-wrapper">
<!-- Main content -->

   <section class="content-header">
      <h3 style="color: #454545; font-family: goudy old style; text-transform: uppercase; font-weight: bold">
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
        
        <div class="box box-primary" style="width: 100%;">
            <div class="box-header with-border"></div>
                    
                     <?php if($this->session->flashdata('message') != "") { ?>                
                      <div class="callout callout-danger" style="height: 20px;">
                        <p style="margin-top: -7%;"><?php echo $this->session->flashdata('message');?></p>
                      </div>
                    <?php } ?>
                                     
                      <?php //echo form_open('/Auth/register',array('class'=>'form-horizontal'));?>
                      <form id="ChangePasswordForm" class="form-horizontal" method="post" action="auth/change_password">
                      <div class="box-body">
                         <div class="form-group">
                            <label class="col-lg-3 control-label" style="font-size: 9.2pt">Old Password</label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" name="old" style="font-size: 9.2pt"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" style="font-size: 9.2pt">New Password</label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" name="new" style="font-size: 9.2pt"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" style="font-size: 9.2pt">Confirm New Password</label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" name="new_confirm" style="font-size: 9.2pt"/>
                               </div>
                        </div>

                        <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('identity'); ?>" name="user_id" />
                           
                                                
                          <div class="form-group">
                            <div class="col-xs-9 col-xs-offset-3 btn-change">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            <button type="button" onclick="location.href = '<?php echo base_url()."member/profile"; ?>';" class="btn btn-danger"><i class="fa fa-arrow-circle-left "></i> Cancel</button>
                            </div>
                         </div>
                        
                       </div>
                      </form>
            </div>
    </section>
    <!-- /.content -->
</div>
    
