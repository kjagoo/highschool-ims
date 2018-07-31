<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SMS |</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>
<!-- Initiate tablesorter script -->
<script type="text/javascript">

	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}
</script>
	<script language="javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<SCRIPT type="text/javascript">

pic1 = new Image(16, 16); 
pic1.src = "images/loader.gif";

$(document).ready(function(){

$("#admno").change(function() { 

var usr = $("#admno").val();


$("#status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "check_admno.php",  
    data: "admno="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#admno").removeClass('object_error'); // if necessary
		$("#admno").addClass("object_ok");
		$(this).html('');
		//$(this).html('&nbsp;<img src="images/tick.gif" align="absmiddle">');
	}  
	else  
	{  
		$("#admno").removeClass('object_ok'); // if necessary
		$("#admno").addClass("object_error");
		$(this).html(msg);
		$("#admno").focus();
	}  
   
   });

 } 
   
  }); 



});

});

</SCRIPT>
</head>
<body>

<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a  class="active"  href="finance_report_statements.php">Fees Statements</a></li>
	 <li><a  href="finance_report_fees.php">Fees Balances</a></li>
	 <li><a  href="finance_report_voteheadbalances.php">Votehead Balances</a></li>
	  <li><a  href="finance_report_feeregister.php">Fees Register</a></li>
	 <li><a  href="finance_report_cashbookregister.php">Cash Book Register</a></li>
	 <li><a  href="finance_report_receipts.php">Receipts</a></li>
	 <li><a  href="finance_report_cancelledreceipts.php">Cancelled Receipts</a></li>
	  <li><a  href="finance_report_bursaries.php">Bursaries</a></li>
  </ul>
</div>
<div class="clear"></div>
  <div id="page_tabs_content">
  <div id="display_Area">
  <fieldset style="margin-bottom: 3px;">
  <table width='100%'>
  <tr>
  <td>
  <form method="get" action="finance_report_view_statement_all.php" target="reportView">
    <table>
        <tr>
		<td>FORM:</td>
		<td>
		<select name="form" class="select" required>
		  <option value="">-- Select Form--</option>
		 <option value="FORM 1">FORM 1</option>
		 <option value="FORM 2">FORM 2</option>
		 <option value="FORM 3">FORM 3</option>
		 <option value="FORM 4">FORM 4</option>
		  </select>
		</td>
          <td>
		  <select name="year" class="select" required>
		  <option value="">-- Select Year--</option>
		 <?php for($i = date('Y'); $i >= 2010; --$i) 
             		 printf('<option value="%d">%d</option>', $i, $i);
   					 ?>
		  </select>
		  </td>
		  <td><input type="submit" name="submit" value="Get All Statements" class="btn btn-primary"/></td>
        </tr>
		
      </table>
	  </form>
  </td><td><img src='images/bar_fill.png' style='margin-left:10px; margin-right:10px;' /></td>
  <td>
  <form method="get" action="finance_report_view_statement.php" target="reportView">
    <table>
        <tr>
		<td>Student Admno:</td>
		<td><input type="text" name="admno" id="admno" class="inputFields"/> <div style="float:right;" id="status"></div></td>
          <td>
		  <select name="year" class="select" required>
		  <option value="">-- Select Year--</option>
		 <?php for($i = date('Y'); $i >= 2010; --$i) 
             		 printf('<option value="%d">%d</option>', $i, $i);
   					 ?>
		  </select>
		  </td>
		  <td><input type="submit" name="submit" value="Get Statement" class="btn btn-primary"/></td>
        </tr>
		
      </table>
	  </form>
	 </td>
	 </tr>
	 </table>
   </fieldset>
  <iframe name="reportView" src="finance_report_view_statement.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
  
  
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
