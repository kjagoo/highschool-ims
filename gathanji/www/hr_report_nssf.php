<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Customer Bills report page";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>

<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script language="javascript" src="scripts/calendar.js"></script>
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
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
	</script>
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
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script></head>
<body>
<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>

<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="hr_report_nssf.php">NSSF Reports</a></li>
  </ul>
</div>
<div id="display_Area">
<div id="page_tabs_content">
  <fieldset style="margin-bottom: 3px;">
  <form method="get" action="hr_view_report_nssf.php" target="reportView">
    <fieldset>
    <legend>Filter</legend>
    <table width="90%">
      <tr>
        <td><table width="100%">
            <tr>
              <td>Select Date From</td>
              <td><?php
						require_once('classes/tc_calendar.php');
					  $myCalendar = new tc_calendar("date4", true, false);
					  $myCalendar->setIcon("images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setYearInterval(2050, 2010);
					//  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
					  $myCalendar->setDateFormat('j F Y');
					  $myCalendar->setAlignment('right', 'bottom');
					  $myCalendar->getDate();
					  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
					  //$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
					  //$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
					  $myCalendar->writeScript();
					?></td>
            
              <td>Select Date To</td>
              <td><?php
					require_once('classes/tc_calendar.php');
				  $myCalendar = new tc_calendar("date5", true, false);
				  $myCalendar->setIcon("images/iconCalendar.gif");
				  $myCalendar->setDate(date('d'), date('m'), date('Y'));
				  $myCalendar->setPath("calendar/");
				  $myCalendar->setYearInterval(2050, 2010);
				//  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
				  $myCalendar->setDateFormat('j F Y');
				  $myCalendar->setAlignment('right', 'bottom');
				  $myCalendar->getDate();
				  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
				  //$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
				  //$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
				  $myCalendar->writeScript();
					?></td>
            </tr>
          </table></td>
        
        <td valign="middle" rowspan="3"><input type="submit" name="submit" class="btn btn-success"  value="Apply Filter" /></td>
      </tr>
    </table>
    </fieldset>
  </form>
  
 
  </fieldset>
  <iframe name="reportView" src="hr_view_report_nssf.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
</div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
