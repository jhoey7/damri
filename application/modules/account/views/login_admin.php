

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> DAMRI <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Cabang Bandara Soekarno - Hatta</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Jl. Tipar No. 3 Cakung</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Jakarta Utara</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Easy Access</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                    </ul>
                    <div class="mb20"></div>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <form id="loginForm" class="form-horizontal" method="post" action="<?php echo base_url(); ?>auth/login">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                    <?php if($this->session->flashdata('message') != "") { ?>                
                    <div class="callout callout-danger" style="background-color: red; display:box; padding: 15px 15px 15px 15px; color: #ffffff">
                        <p style="margin-top: -7%;"><?php echo $this->session->flashdata('message');?></p>
                      </div>
                    <?php } ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Username</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="identity"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Password</label>
                                    <div class="col-lg-12">
                                        <input type="password" class="form-control" name="password" />
                                    </div>
                                </div>

                              <div class="form-group">
                                <div class="col-xs-12">
                                  <button type="submit" class="btn btn-success"><i class="fa fa-unlock"></i> Login</button>
                                 
                                </div>
                              </div>                         

                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; <?php echo date('Y'); ?>. Perum Damri. All Rights Reserved
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>