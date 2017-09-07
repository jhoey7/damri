    function add_master(form,modal,title,url)
    {
      save_method = 'add';
      $('#'+form)[0].reset(); // reset form on modals
      $('#'+modal).modal('show'); // show bootstrap modal
      $('.modal-title').text(title); // Set Title to Bootstrap modal title
      $('#'+form).attr('action',url);
      
    }
 
////////////////////////////////////// TRAYEK //////////////////////////////////////////    
     function edit_trayek(id)
    {
          $.ajax({
            url : "index.php/master/get_data/trayek/"+id+"/id_trayek",
 
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
           
                //$('[name="id_trayek"]').attr('readonly', 'readonly');
                $('[name="nama_trayek"]').val(data.nama_trayek);
                $('[name="tarif"]').val(data.tarif);
                
                $('#pool').find("option[value='"+data.id_pool+"']").attr("selected", true);
                $('#group').find("option[value='"+data.id_group+"']").attr("selected", true);
               // $('#tahun_perolehan').find("option[value='"+data.tahun_perolehan+"']").attr("selected", true);
                
                $("#formAddMaster").attr('action','index.php/master/save_trayek/edit/'+data.id_trayek);
                
                $('#modal_form_master').modal('show'); // show bootstrap modal
                $('.modal-title').text('Edit Master Data'); // Set Title to Bootstrap modal title
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert(errorThrown);
              }
          });
    }
        function delete_trayek(id)
        {
            $('#modal_confirm_delete').modal('show'); // show bootstrap modal
            $('.modal-title').text('Confirmation Box'); // Set Title to Bootstrap modal title 

            $("#yes").click(function(e) {
                    $(".btn").attr("disabled", true);

                    $.ajax({
                    url : 'index.php/Master/delete_data/trayek/id_trayek/'+id,
                    dataType: "json",
                    success: function(data)
                    {
                       document.location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert(errorThrown);
                    }
                });
            });
       
      }
////////////////////////////////////// TRAYEK //////////////////////////////////////////  

////////////////////////////////////// TERMINAL //////////////////////////////////////////    
     function edit_terminal(id)
    {
          $.ajax({
            url : "index.php/master/get_data/terminal/"+id+"/id_terminal",
 
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="nama_terminal"]').val(data.nama_terminal);
                $('[name="gm"]').val(data.gm);
                $('[name="nik_gm"]').val(data.gm_nik);
                $('[name="staf"]').val(data.staf);
                $('[name="nik_staf"]').val(data.staf_nik);
                $('#comp').find("option[value='"+data.id_comp+"']").attr("selected", true);
                
                $("#formAddSupir").attr('action','index.php/master/save_terminal/edit/'+id);
                
                $('#modal_form_supir').modal('show'); // show bootstrap modal
                $('.modal-title').text('Edit Master Data'); // Set Title to Bootstrap modal title
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert(errorThrown);
              }
          });
    }
        function delete_terminal(id)
        {
            $('#modal_confirm_delete').modal('show'); // show bootstrap modal
            $('.modal-title').text('Confirmation Box'); // Set Title to Bootstrap modal title 

            $("#yes").click(function(e) {
                    $(".btn").attr("disabled", true);

                    $.ajax({
                    url : 'index.php/Master/delete_data/terminal/id_terminal/'+id,
                    dataType: "json",
                    success: function(data)
                    {
                       document.location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert(errorThrown);
                    }
                });
            });
       
      }
////////////////////////////////////// TREMINAL ////////////////////////////////////////// 


    function view_master(id)
    {
      window.location.href="index.php/master/detail/"+id; 
      //alert(id);
    }
    
     function reply_save(id)
    {
        var value = CKEDITOR.instances['editor2'].getData();
        var value2 = decodeURI(value);

        var data = document.getElementById('reply').value = value;
        
        
            $.ajax({
                 cache: true,
                 url : "index.php/master/save_reply/"+id,
                 type: "POST",
                 data: $('#form_reply').serialize(),

                 success: function(result)
                 {
                    $("#list_reply").html(result);
                 },
                 error: function (jqXHR, textStatus, errorThrown)
                 {
                     alert(errorThrown);
                 }
             });
    }  

 /*function reply_save(id)
 {
    var value = CKEDITOR.instances['editor1'].getData();
    alert (value);

 } */ 
    
    function close_master(id, req_type)
    {
                
                 $.ajax({
                  url : "index.php/master/add_master_close/"+id+"/"+req_type,

                  type: "GET",

                  success: function(result)
                  {
                     $("#master_detail").html(result);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert(textStatus);
                  }
                });
    }
    

  function alertFilename()
            {
                var thefile = document.getElementById('attachment');
                var namefile = (thefile.value);
                        $.ajax({
                        url: "index.php/master/attach/"+namefile, 
                        type: "GET",
                        success: function(result){
                        $("#attach").html(result);
                        }});
            }