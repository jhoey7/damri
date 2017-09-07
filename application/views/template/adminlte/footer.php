 <footer class="main-footer">
     <center>
   <div class="pull-right hidden-xs">
       <b>Operasional Harian Team </b>
    </div>
    <strong>Copyright &copy; 2016-2017 .</strong> All rights
    reserved.
     </center>
 </footer>
 </div>
 <!-- DELETE CONFIRMATION BOX FOR ALL -->
<div class="modal fade" id="modal_confirm_delete" role="dialog">
  <div class="modal-dialog"  style="width: 300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Confirmation Box</h3>
      </div>
      <div class="modal-body form">
        <form id="formAddCategory" class="form-horizontal" method="post">
          <input type="hidden" value="" name="id"/> 
          <div class="form-body" style="font-size: 9.2pt;">
   
                    <div class="form-group">
                        <center> <label class="col-xs-12">Are You Sure Want To Delete ?</label></center>
                      </div>

                        <div class="form-group">
                          <center>  <div class="col-xs-12">
                                  <button type="button" class="btn btn-primary" id="yes"><i class="fa fa-send"></i> Yes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-send"></i>No</button>
                            </div> </center>
                        </div> 
          </div>
        </form>
          </div>
          <!--<div class="modal-footer">
            <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
 </div>
<!-- END OF CONFIRMATION -->
<!-- ./wrapper -->
<!-- jQuery 2.2.0 -->
<script src="themes/adminlte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="themes/adminlte/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="themes/adminlte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="themes/adminlte/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="themes/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="themes/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="themes/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="themes/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="themes/adminlte/plugins/chartjs/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="themes/adminlte/dist/js/demo.js"></script>
<!-- DataTables -->
<!-- Bootstrap Validator -->
<script type="text/javascript" src="themes/adminlte/dist/js/bootstrapValidator.js"></script>

<link href="themes/adminlte/datepicker/jsDatePick_ltr.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="themes/adminlte/datepicker/jsDatePick.min.1.3.js"></script>
<script type="text/javascript" src="themes/adminlte/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('themes/adminlte/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('themes/adminlte/datatables/js/dataTables.bootstrap.js')?>"></script>
<!-- Validasi Ajax -->
<script src="themes/adminlte/dist/js/validasi/valid_edit_profile.js"></script>
<script src="themes/adminlte/dist/js/validasi/valid_change_pass.js"></script>
<script src="themes/adminlte/dist/js/validasi/valid_forget_pass.js"></script>
<script src="themes/adminlte/dist/js/validasi/valid_user.js"></script>
<script src="themes/adminlte/dist/js/validasi/valid_trayek.js"></script>
<script src="themes/adminlte/dist/js/validasi/valid_terminal.js"></script>
<!-- END Validasi Ajax -->

<!-- Javascript FORM -->

<script src="themes/adminlte/dist/js/js_form/ap2.js"></script>
<script src="themes/adminlte/dist/js/js_form/master.js"></script>
<script src="themes/adminlte/dist/js/js_form/member.js"></script>
<script src="themes/adminlte/dist/js/js_form/register.js"></script>

<!-- END JAVASCRIPT FORM  -->

<script type="text/javascript">
   
	$(window).load(function() {
		// Animate loader off screen
		$("#load").fadeOut("slow");
	});
 </script>
 <script>
// Show loading overlay when ajax request starts
$( document ).ajaxStart(function() {
    $("#load").fadeIn("slow");
});
// Hide loading overlay when ajax request completes
$( document ).ajaxStop(function() {
    $("#load").fadeOut("slow");
});
</script>

<script>
     var table;
    $(document).ready(function() {
      table = $('#table_').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url().'index.php/member/ajax_list'; ?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
          "defaultContent": "<button>View Rating!</button>"
        },
        { 
          "targets": [ -2 ], //last column
          "orderable": false, //set not orderable
          "defaultContent": "<button>View Rating!</button>"
        },
        ],
      });
    });
     
</script>
</body>
</html>
