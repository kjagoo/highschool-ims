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
</head>
<body>

<div class="clear"></div>
<div id="page_tabs">
  <ul>
   <li><a href="finance_report_statements.php">Fees Statements</a></li>
    <li><a href="finance_report_fees.php">Fees Balances</a></li>
	 <li><a  href="finance_report_voteheadbalances.php">Votehead Balances</a></li>
	<li><a  href="finance_report_feeregister.php">Fees Register</a></li>
	 <li><a  href="finance_report_cashbookregister.php">Cash Book Register</a></li>
	 <li><a  href="finance_report_receipts.php">Receipts</a></li>
	 <li><a  class="active"  href="finance_report_cancelledreceipts.php">Cancelled Receipts</a></li>
	 <li><a  href="finance_report_bursaries.php">Bursaries</a></li>
  </ul>
</div>
<div class="clear"></div>
  <div id="page_tabs_content">
  <div id="display_Area">
  <fieldset style="margin-bottom: 3px;">
  <form method="get" action="finance_report_view_cancelledreceipts.php" target="reportView">
    <fieldset>
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
        
        <td valign="middle" rowspan="3"><input type="submit" name="submit" class="btn btn-primary"  value="Apply Filter" /></td>
      </tr>
    </table>
    </fieldset>
  </form>
  </fieldset>
  <iframe name="reportView" src="finance_report_view_cancelledreceipts.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
  
  
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
