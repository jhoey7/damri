
    
    $('#transaction_date').datepicker({format: 'yyyy-mm-dd'}).on('changeDate', function(ev)
{                 
     $('.datepicker').hide();
     //$('#contactForm').bootstrapValidator('revalidateField', 'bday');
});

    $('#transaction_date_1').datepicker({format: 'yyyy-mm-dd'}).on('changeDate', function(ev)
{                 
     $('.datepicker').hide();
     //$('#contactForm').bootstrapValidator('revalidateField', 'bday');
});

function combine()
{
    $.ajax({
              url: "Combine/combine_data", 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
}

function combine() {
    $.ajax({
      type: 'POST',
      url: "Combine/combine_data",
      data: $("#form_combine").serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('._msg').html("<img src='"+base_url+"images/loaders/loader1.gif' />");
      },
      success: function(data) {
        if(data.status == "success") {
          $("._msg").css({"color": "green"});
        } else {
          $("._msg").css({"color": "red"});
        }
        $("._msg").html(data.msg);
      }
    });
  }

function tampilkan_lp1()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
        var trmnl=document.getElementById('terminal').value;
        var tr=document.getElementById('trayek').value;
	
        $.ajax({
              url: "index.php/laporan/view_lap1/"+t_awal+"/"+t_akhir+"/"+tr+"/"+trmnl, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}

function tampilkan_lp2()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
        var tr=document.getElementById('trayek').value;
        var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;
	
        $.ajax({
              url: "index.php/laporan/view_lap2/"+t_awal+"/"+t_akhir+"/"+tr+"/"+counter+"/"+terminal, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}

function tampilkan_lp3()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
	
        $.ajax({
              url: "index.php/laporan/view_lap3/"+t_awal+"/"+t_akhir, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}

function tampilkan_lp4()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
	
        $.ajax({
              url: "index.php/laporan/view_lap4/"+t_awal+"/"+t_akhir, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}

function tampilkan_lp5()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
	var grp=document.getElementById('group').value;
        var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;
        
        $.ajax({
              url: "index.php/laporan/view_lap5/"+t_awal+"/"+t_akhir+"/"+grp+"/"+counter+"/"+terminal, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}

function tampilkan_lp6()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
	var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;
        $.ajax({
              url: "index.php/laporan/view_lap6/"+t_awal+"/"+t_akhir+"/"+counter+"/"+terminal, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}
function tampilkan_lp7()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
	var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;
        $.ajax({
              url: "index.php/laporan/view_lap7/"+t_awal+"/"+t_akhir+"/"+counter+"/"+terminal, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}

function tampilkan_lp8()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
        //var tr=document.getElementById('trayek').value;
        var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;
	
        $.ajax({
              url: "index.php/laporan/view_lap8/"+t_awal+"/"+t_akhir+"/"+counter+"/"+terminal, 
              beforeSend: function(){
                       $("#loading").show();
                   },
              success: function(result){
            $("#listed").html(result);
                }});
		
}

function cetak_lap1()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
        var trmnl=document.getElementById('terminal').value;
        var tr=document.getElementById('trayek').value;
	
		window.open("index.php/laporan/cetak_lap1/"+t_awal+"/"+t_akhir+"/"+tr+"/"+trmnl);
}

function cetak_lap2()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
        var tr=document.getElementById('trayek').value;
        var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;

	
		window.open("index.php/laporan/cetak_lap2/"+t_awal+"/"+t_akhir+"/"+tr+"/"+counter+"/"+terminal);
}

function cetak_lap2_shift()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
        var tr=document.getElementById('trayek').value;
        var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;

	
		window.open("index.php/laporan/cetak_lap2/"+t_awal+"/"+t_akhir+"/"+tr+"/"+counter+"/"+terminal);
}

function cetak_lap3()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;

	
		window.open("index.php/laporan/cetak_lap3/"+t_awal+"/"+t_akhir);
}

function cetak_lap4()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;

	
		window.open("index.php/laporan/cetak_lap4/"+t_awal+"/"+t_akhir);
}

function cetak_lap5()
{
	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
	var grp=document.getElementById('group').value;
        var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;
        
	window.open("index.php/laporan/cetak_lap5/"+t_awal+"/"+t_akhir+"/"+grp+"/"+counter+"/"+terminal);
}

function cetak_lap8()
{
        var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
        //var tr=document.getElementById('trayek').value;
        var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;
        
	window.open("index.php/laporan/cetak_lap8/"+t_awal+"/"+t_akhir+"/"+counter+"/"+terminal);
}

function cetak_lap7()
{
    	var t_awal=document.getElementById('transaction_date_1').value;
	var t_akhir=document.getElementById('transaction_date').value;
	var counter=document.getElementById('counter').value;
        var terminal=document.getElementById('terminal').value;

        window.open("index.php/laporan/cetak_lap7/"+t_awal+"/"+t_akhir+"/"+counter+"/"+terminal);
}

	