
  $(document).on('submit', '#registration-form', function(){
     
  var data = $(this).serialize();
  
    $('#spinner').show();
  
  $.ajax({
  
  type : 'POST',
  url  : 'finance_receive_invoice_save.php',
  data : data,
  success :  function(data){
     
       
      alert(data);
    
      $( '#registration-form' ).each(function(){
      this.reset();
    $('#spinner').hide();
    location.reload();
    
    });
     // 
      
       }
  });
  return false;
 });
  
  
