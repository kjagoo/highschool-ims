$(document).on('submit', '#registration-form', function(){
  var data = $(this).serialize();
  
    $('#spinner').show();
	
  $.ajax({
  
  type : 'POST',
  url  : 'save_guidance.php',
  data : data,
  success :  function(data){
     
       
      alert(data);
	  
      $( '#registration-form' ).each(function(){
    	this.reset();
		$('#spinner').hide();
		var url = "guidance_view.php";    
		$(location).attr('href',url);
		
	  });
     // 
      
       }
  });
  return false;
 });
  
  
