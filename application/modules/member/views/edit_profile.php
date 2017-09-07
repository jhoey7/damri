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
        <div class="box box-primary">
                    
                      <?php if($this->session->flashdata('message') != "") { ?>
                      <div class="callout callout-info"><p><?php echo $this->session->flashdata('message');?></p></div>
                      <?php } ?>
                 
                      <form id="EditForm" class="form-horizontal" method="post" action="index.php/auth/edit_user">
                      <div class="box-body"  style="font-size: 9pt;">
                            <div class="form-group">
                            <label class="col-md-3 control-label">Full name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>"  style="font-size: 9pt;"/>
                            </div>

                            <div class="col-md-4">
                                <input type="text" class="form-control" name="last_name"  value="<?php echo $last_name; ?>"  style="font-size: 9pt;"/>
                            </div>
                            </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                                <button type="button" onclick="location.href = '<?php echo base_url()."member/profile"; ?>';" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Cancel Changes</button>
                            </div>
                        </div>
                      </div>
                 
                      <?php //echo form_close();?>
                    </form>
                  </div>
    </section>
    <!-- /.content -->
</div>
