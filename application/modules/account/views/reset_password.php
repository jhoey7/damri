
    <section class="content">
        <div class="login-box" style="margin-top: -1%;">
            
              <div class="login-logo">
                <a href="../../index2.html"><b>Payment </b>Gateway</a>
              </div>

		<div class="login-box-body" style="width: 500px;">
			
                 <p class="login-box-msg">Reset Password Form</p>
                    <?php if($this->session->flashdata('message') != "") { ?>                
                      <div class="callout callout-danger" style="height: 20px;">
                        <p style="margin-top: -7%;"><?php echo $this->session->flashdata('message');?></p>
                      </div>
                    <?php } ?>
                 
                    <?php if($message != "") { ?>                
                      <div class="callout callout-danger" style="height: 20px;">
                        <p style="margin-top: -7%;"><?php echo $message;?></p>
                      </div>
                    <?php } ?>

                 <form id="resetForm" class="form-horizontal" method="post" action="<?php echo 'index.php/auth/reset_password/'.$code; ?>">
                            
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">New Password</label>
                                    <div class="col-lg-7">
                                        <input type="password" class="form-control" name="new"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">New Password Confirm</label>
                                    <div class="col-lg-7">
                                        <input type="password" class="form-control" name="new_confirm" />
                                    </div>
                                </div>

                              <div class="form-group">
                                <div class="col-xs-9 col-xs-offset-3">
                                  <button type="submit" class="btn btn-primary">Submit</button>        
                                </div>
                              </div>    
                       </form>

                  </div>
		</div>
	</div>
    </section>

    
