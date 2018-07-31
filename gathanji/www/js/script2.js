/*
 cc:scriptime.blogspot.in
 edited by :midhun.pottmmal
*/
$(document).ready(function(){
	$(document).click(function(){
		$("#ajax_response2").fadeOut('slow');
	});
	$("#keyword2").focus();
	var offset = $("#keyword2").offset();
	var width = $("#keyword2").width()-2;
	$("#ajax_response2").css("left",offset.left); 
	$("#ajax_response2").css("width",width);
	$("#keyword2").keyup(function(event){
		 //alert(event.keyCode);
		 var keyword = $("#keyword2").val();
		 if(keyword.length)
		 {
			 if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
			 {
				 $("#loading2").css("visibility","visible");
				 $.ajax({
				   type: "POST",
				   url: "library_fetchbook.php",
				   data: "data="+keyword,
				   success: function(msg){	
					if(msg != 0)
					  $("#ajax_response2").fadeIn("slow").html(msg);
					else
					{
					  $("#ajax_response2").fadeIn("slow");	
					  $("#ajax_response2").html('<div style="text-align:left;">No Matches Found</div>');
					}
					$("#loading2").css("visibility","hidden");
				   }
				 });
			 }
			 else
			 {
				switch (event.keyCode)
				{
				 case 40:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:first").addClass("selected");
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
				 }
				 break;
				 case 13:
					$("#ajax_response2").fadeOut("slow");
					$("#keyword2").val($("li[class='selected'] a").text());
					
				 break;
				}
			 }
		 }
		 else
			$("#ajax_response2").fadeOut("slow");
	});
	$("#ajax_response2").mouseover(function(){
		$(this).find("li a:first-child").mouseover(function () {
			  $(this).addClass("selected");
		});
		$(this).find("li a:first-child").mouseout(function () {
			  $(this).removeClass("selected");
		});
		$(this).find("li a:first-child").click(function () {
			  $("#keyword2").val($(this).text());
			  $("#ajax_response2").fadeOut("slow");
		});
	});
});