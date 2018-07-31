<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();

include 'includes/Finance.php';
$finance = new Financials();

$year=$finance->getFiscalYear();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
	<script language="javascript" src="scripts/calendar.js"></script>
<style type="text/css">
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>


</head>
<body>


<div class="clear"></div>
<div id="page_tabs">
  <ul>
   <li><a href="finance_report_statements.php">Fees Statements</a></li>
    <li><a href="finance_report_fees.php">Fees Balances</a></li>
	 <li><a  href="finance_report_voteheadbalances.php">Votehead Balances</a></li>
	 <li><a   href="finance_report_feeregister.php">Fees Register</a></li>
	 <li><a  class="active" href="finance_report_cashbookregister.php">Cash Book Register</a></li>
	 <li><a  href="finance_report_receipts.php">Receipts</a></li>
	 <li><a  href="finance_report_bursaries.php">Bursaries</a></li>
  </ul>
</div>
<div id="display_Area">
<div id="page_tabs_content">
  <fieldset>
	
  <table width="90%">
      <tr>
        <td>
		<form method="GET" action="finance_report_view_cashbookregister.php" target="reportView">
		<table width="100%">
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
					 <td>Select Votehead</td>
		 <td>
		 <select name="votehead" class="select" required>
		  <option value="" selected="selected">-- Votehead--</option>
		  <option value="All">All Voteheads </option>
		 <?php
		  $query=("select distinct(votehead) from finance_feestructures");
			$result=mysql_query($query) ;
				while($row=mysql_fetch_array($result)){
				echo "<OPTION VALUE=".str_replace(" ","_",$row['votehead']).">".$row['votehead']."</OPTION>"; }
			?>
		 </select>
		  </td>
		   <td valign="middle"><input type="submit" name="submit" class="btn btn-primary"  value="Apply Filter" /></td>
            </tr>
          </table>
		   </form>
		  </td>
        
       
      </tr>
	   
	   <tr>
        <td>
		<form method="GET" action="finance_report_view_cashbookregister_bulk.php" target="reportView">
		<table width="100%">
            <tr>
              <td>Select Receipts From</td>
              <td><input type="number" name="val1" class="inputFields" id="val1" /></td>
            
              <td> To</td>
              <td><input type="number" name="val2" class="inputFields" id="val2" /></td>
		
		   <td valign="middle"><input type="submit" name="submit" class="btn btn-primary"  value="Apply Filter" /></td>
            </tr>
          </table>
		   </form>
		  </td>
        
       
      </tr>
	  
	  
	  
	  
    </table>
	
   </fieldset>
   <iframe name="reportView" src="finance_report_view_cashbookregister.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
   
  
</div>
</div>
<!--end of display area This area changes when a user searches for an item-->
</body>
</html>
