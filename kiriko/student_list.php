<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
   include 'includes/functions.php';
   include 'includes/DAO.php';
$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$dao = new DAO();
	$activity = "Viewed student list";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

 $statement = "studentdetails where form='FORM 1' Or form='FORM 2' or form='FORM 3' or form='FORM 4' order by admno asc";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
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
<link href='css/opa-icons.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="syntax/shCore.js"></script>
<script type="text/javascript" language="javascript" src="syntax/demo.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );

String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};

	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}
function Warning(){

	alert("WARNING !!\n\nThis student cannot be cleared\n\nCheck Lost Books\nUn-Returned Books\nUn-Cleared Fees");
	return false;
}


	</script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script>
</head>
<body>


<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="student_list.php">Students</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
    <form method="post" action="student_list_view.php" target="reportView">
      <table width="70%">
        <tr>
          <td valign="middle"><strong>Select Students:</strong></td>
          <td valign="middle"><select name="studend" class="select">
              <option value="available" selected="selected">Current Students</option>
              <option value="alumini" >Alumni Students</option>
            </select>
          </td>
          <td align="left"><input  type="submit" class="btn btn-primary" value="View List"/></td>
          
        </tr>
      </table>
    </form>
    </fieldset>
	
	
<iframe name="reportView" src="student_list_view.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>

	
   
  </div>
</div>
<!--end of display area.This area changes when a user searches for an item-->
</body>
</html>
