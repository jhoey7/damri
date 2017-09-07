
function tampilbank(id)
 {
	 //var kdprop = document.getElementById("prov_id").value;

            var x;
            if(window.XMLHttpRequest)
            {
                    x= new XMLHttpRequest();
            }
            else
            {
                    x=new ActiveXObject("Microsoft.XMLHTTP");
            }
                    x.open("GET","index.php/member/memberAccount/"+id,true);
                    

            x.onreadystatechange=function()
            {
                    document.getElementById("memberBank").innerHTML=x.responseText;
            }
            x.send();
         //alert(kdprop);
 }

function getAccount(bank_id)
 {
	 var member_id = document.getElementById("transferMember").value;

            var x;
            if(window.XMLHttpRequest)
            {
                    x= new XMLHttpRequest();
            }
            else
            {
                    x=new ActiveXObject("Microsoft.XMLHTTP");
            }
                    x.open("GET","index.php/transactions/get_account/"+bank_id+"/"+member_id,true);
                    

            x.onreadystatechange=function()
            {
                    document.getElementById("account2").innerHTML=x.responseText;
            }
            x.send();
         //alert(kdprop);
 }
 
 function detail_member(id)
 {
	 //var kdprop = document.getElementById("prov_id").value;

            var x;
            if(window.XMLHttpRequest)
            {
                    x= new XMLHttpRequest();
            }
            else
            {
                    x=new ActiveXObject("Microsoft.XMLHTTP");
            }
                    x.open("GET","index.php/member/detail/"+id,true);
                    

            x.onreadystatechange=function()
            {
                    document.getElementById("suggestion").innerHTML=x.responseText;
            }
            x.send();
         //alert(kdprop);
 }
 
 
// Ajax City
$( "#customer" ).change(function() {
    alert('hai');
});

/*
$( "#bank" ).change(function() {
    bank_id = document.getElementById("bank").value;
    user_id = document.getElementById("user_id").value;
    $.ajax({url: "index.php/transactions/get_account/"+bank_id+"/"+user_id, success: function(result){
            $("#account").html(result);
        }});
});*/

// Datepicker

  $(function() {
    $( "#birthday2" ).datepicker({
        viewMode: 'years',
        format: 'yyyy-mm-dd'
    });
	
    
     $('#idTourDateDetails').datepicker({
     format: 'yyyy-mm-dd',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altField: "#idTourDateDetailsHidden",
     altFormat: "yyyy-mm-dd"
 });
 
  });
  

 
 // Ajax Chaange Password
$(document).ready(function()
{
		
    $('#change_pass').click(function()	
    {
        $.ajax({url: "index.php/account/change_password", success: function(result){
        $("#box").html(result);
            }});
		
    });
		
});

// ajax currency 
function AddCommas(a){numArr=(new String(a)).split("").reverse();for(i=3;i<numArr.length;i+=3){numArr[i]+="."}return numArr.reverse().join("")}function MoneyToNumber(a){return a.replace(/\./g,"")}
function FormatCurrency(a){var b=a.value;var c,d;if(b!=""&&b!=a.oldvalue){b=MoneyToNumber(b);if(isNaN(b)){a.value=a.oldvalue?a.oldvalue:""}else{var e=navigator.appName.indexOf("Netscape")!=-1?Event:event;if(e.keyCode==188||!isNaN(b.split(",")[1])){alert(b.split(",")[1]);a.value=AddCommas(b.split(",")[0])+","+b.split(",")[1]}else{a.value=AddCommas(b.split(",")[0])}a.oldvalue=a.value}}}

$(document).ready(function()
{
		
    $('#edit_profil').click(function()	
    {
        $.ajax({url: "index.php/member/edit", success: function(result){
        $("#box").html(result);
            }});
		
    });
    
		
});


$("#testimoni_button").click(function() {
   alert("hai");
});

$(document).ready(function () {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
    //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#PT").change(function () {
        toggleFields();
    });

});

function toggleFields() {
    if ($("#PT").val() == '2')
    {
        $("#transfer").show();
        $("#account").show();
        $("#memberBank").show();
        $("#file").show();
 	/*$("#amount_transfer2").show();
	$("#amount_saldo").hide();*/
        
        $("#amount").val("");
        $("#amount_transfer").val("");
        $("#member_id").val("");
        $("#member").val("");
        $("#desc_saldo").val("");
        $("#transfer").val("");
        $("#account").val("");
        $("#memberBank").val("");
        $("#file").val("");
	
        $('.form-group').removeClass('has-error has-feedback');
        $('.form-group').find('small.help-block').hide();
        $('.form-group').find('i.form-control-feedback').hide();
        $('input[type=submit]').removeClass('disabled');
    }
    else
    {
        $("#transfer").hide();
        $("#account").hide();
        $("#memberBank").hide();
        $("#file").hide();
	/*$("#amount_transfer2").hide();
        $("#amount_saldo").show();*/
        
        $("#amount").val("");
        $("#amount_transfer").val("");
        $("#member_id").val("");
        $("#member").val("");
        $("#desc_saldo").val("");
        $("#transfer").val("");
        $("#account").val("");
        $("#memberBank").val("");
        $("#file").val("");
        
        $('.form-group').removeClass('has-error has-feedback');
        $('.form-group').find('small.help-block').hide();
        $('.form-group').find('i.form-control-feedback').hide();
        $('input[type=submit]').removeClass('disabled');
        //$("#transfer").hide();
       // $("#transfer").load(location.href + " #transfer");
    }
}
 /////////////////////////////////////////////////////////// VALIDASI FORM //////////////////////////////////////////////////////////////
