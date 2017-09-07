

    function delete_user(id)
    {
       $('#modal_confirm_delete').modal('show'); // show bootstrap modal
       $('.modal-title').text('Confirmation Box'); // Set Title to Bootstrap modal title 
       
               $("#yes").click(function(e) {
                 $(".btn").attr("disabled", true);
                //$('#formCategory')[0].reset(); // reset form on modals
                $.ajax({
                url : 'index.php/member/delete_user/'+id,
                type: "GET",
                success: function(data)
                {
                   //if success close modal and reload ajax table
                   
                   document.location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown);
                }
            });
        });  
    }


   function add_message()
    {
      save_method = 'add';
      $('#formAddMessage')[0].reset(); // reset form on modals
      $('#modal_form_message').modal('show'); // show bootstrap modal
      $('.modal-title').text('Compose New Message'); // Set Title to Bootstrap modal title
    }
    
    $(document).ready(function(){

    $("#load").hide();

     $(document).on("click",".detail-message",function() {
      
      $( "#load" ).show();
      
      
      
       var dataString = { 
              id : $(this).attr('id')
            };
        
        var id = $("#id").val();
        $.ajax({
            type: "POST",
            url: "index.php/member/detail_message/"+id,
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){

              $( "#load" ).hide();

              if(data.success == true){

                $("#show_from").html(data.user_from);
                $("#show_to").html(data.user_to);
                $("#show_subject").html(data.subject);
                $("#show_message").html(data.message);
                $("#show_date").html(data.created_at);

                var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                
                socket.emit('update_count_message', { 
                  update_count_message: data.update_count_message
                });

              } 
          
            } ,error: function(xhr, status, error) {
              alert(error);
            },

        });

    });

  });



