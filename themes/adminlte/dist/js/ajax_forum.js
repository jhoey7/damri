 function detail_forum(id)
 {
	 $.ajax({
              url : "index.php/forum/detail/"+id,

              success: function(result)
              {
                 $("#content").html(result);
              }
          });
 }  