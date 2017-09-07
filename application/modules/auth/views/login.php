<h1> <?php //echo lang('login_heading');?></h1>
<p><?php //echo lang('login_subheading');?></p>

<div id="infoMessage"><?php //echo $message;?></div>

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Login Member</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Sign up</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-info pull-right">Sign in</button>
                <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
              </div>
              <!-- /.box-footer -->
            </form>

          </div>
          
