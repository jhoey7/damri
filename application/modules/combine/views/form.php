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
<div class="col-md-12">
  <div class="panel panel-default">
    <?php if($msg['msg']) { ?>
            <div class="<?php echo "callout callout-".$msg['status'];?>"><p><?php echo $msg['msg'];?></p></div>
          <?php } ?>
    <form id="form_combine" name="form_combine" autocomplete="off" method="post" action="<?php echo site_url('Combine/combine_data'); ?>" onsubmit="javascript:return combine('form_combine');">
      <div class="panel-body">

        
      </div><!-- panel-body -->
      <div class="panel-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> COMBINE </button>
      </div>
    </form>
  </div>
</div>
        </div>
    </section>
    <!-- /.content -->
</div>

