<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>

<style type="text/css">
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>
<!-- Initiate tablesorter script -->

<script type="text/javascript">
String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};
	</script>
	
<script language="javascript" src="scripts/calendar.js"></script>
</head>
<body>


<div class="clear"></div>
<div id="page_tabs">
  <ul>
  <li><a href="finance_report_analysis.php">Trial Balance</a></li>
    <li><a class="active" href="finance_report_analysis.php">Balance Sheet</a></li>
	 <!--<li><a  href="">Profit & Loss</a></li>
	 <li><a  href="">Trial Balance</a></li>-->
  </ul>
</div>
<div id="display_Area">
<div id="page_tabs_content">
 
 <fieldset>
 <legend>Filter</legend>
 <form method="GET" action="finance_report_view_balancesheet.php" target="reportView">
 <table width="80%">
 <tr>
 <td>Balance Sheet As At:</td>
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
				 <td><input type="submit" name="submit" value="View Balance Sheet" class="btn btn-primary"/></td>
 </tr>
 </table>
 </form>
 </fieldset>
  <iframe name="reportView" src="finance_report_view_balancesheet.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
   
 
 
   
  
</div>
</div>
<!--end of display area This area changes when a user searches for an item-->
</body>
</html>
