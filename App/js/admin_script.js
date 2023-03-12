

$(document).ready(function(){
    $('#insert_form').on("submit", function(event){  
     event.preventDefault();  
     if($('#name').val() == "")  
     {  
      alert("Adja meg a nevét!");  
     }  
     else if($('#description').val() == '')  
     {  
      alert("Adja meg a leírását!");  
     }  
     else if($('#price').val() == '')
     {  
      alert("Ajda meg az árát!");  
     }
      
     else  
     {  
      $.ajax({  
       url:"/",  
       method:"POST",  
       data:$('#insert_form').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Inserting");  
       },  
       success:function(data){  
        $('#insert_form')[0].reset();  
        $('#add_data_Modal').modal('hide');  
        $('#employee_table').html(data);  
       }  
      });  
    }  
});
   
   
   
   
$(document).on('click', '.view_data', function(){
     //$('#dataModal').modal();
     var product_id = $(this).attr("id");
     $.ajax({
      url:"BufeDao.php",
      method:"POST",
      data:{product_id:product_id},
      success:function(data){
       $('#product_detail').html(data);
       $('#dataModal').modal('show');
      }
     });
    });
}); 