$(document).ready(function(){  
  $("#pc_name").change(function(){  
var id=$(this).val();
      /*dropdown post  */
     $.ajax({  
          url:"sc/"+id,  
          data: {id:$(this).val()},  
          type: "POST",  
          success:function(response){  
          $("#psc_name").html(response);  

       },
       error:function(response)
       {
                  $("#psc_name").html(response);  

       }  

    });  
  });  
});   