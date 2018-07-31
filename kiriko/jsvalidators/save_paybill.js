$(document).on('submit', '#registration-form', function(){
  var data = $(this).serialize();
  
    $('#spinner').show();
	
  $.ajax({
  
  type : 'POST',
  url  : 'save_paybill.php',
  data : data,
  success :  function(data){
     
       
      alert(data);
	  
      $( '#registration-form' ).each(function(){
    	this.reset();
		$('#spinner').hide();
		var url = "finance_bills_view.php";    
		$(location).attr('href',url);
		
	  });
     // 
      
       }
  });
  return false;
 });
  
  
