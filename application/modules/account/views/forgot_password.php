
    <section class="content">
        <div class="login-box" style="margin-top: -1%;">
            
              <div class="login-logo">
                <a href="../../index2.html"><b>Payment </b>Gateway</a>
              </div>

		<div class="login-box-body">
			
                 <p class="login-box-msg">Forgot Password Form</p>
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

                      <form id="forgotForm" class="form-horizontal" method="post" action="index.php/auth/forgot_password">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Username</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="identity"/>
                                    </div>
                                </div>

                              <div class="form-group">
                                <div class="col-xs-9 col-xs-offset-3">
                                  <button type="submit" class="btn btn-primary">submit</button>                    
                                </div>
                              </div>                         

                       </form>

                  </div>
		</div>
	</div>
    </section>

    
