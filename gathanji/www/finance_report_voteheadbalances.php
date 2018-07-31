 <?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials();
$year=$finance->getFiscalYear();
 

$func = new Functions();
$activity = "Viewed Finance Printed Estimates Setting page";
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
<script type="text/javascript" src="js/jquery.min_vtab.js"></script>
<script type="text/javascript" src="js/script_vtab.js"></script>
<link rel="stylesheet" href="css/styles_vtab.css" />
</head>
<body>
<div id="page_tabs">
  <ul>
   <li><a href="finance_report_statements.php">Fees Statements</a></li>
    <li><a href="finance_report_fees.php">Fees Balances</a></li>
	 <li><a  class="active" href="finance_report_voteheadbalances.php">Votehead Balances</a></li>
	 <li><a  href="finance_report_feeregister.php">Fee Register</a></li>
	 <li><a  href="finance_report_receipts.php">Receipts</a></li>
	  <li><a  href="finance_report_bursaries.php">Bursaries</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
 <fieldset> 
	<form method="GET" action="finance_report_view_voteheadbalances.php" target="reportView">
     <table width="70%">
        <tr>
		<td>Select Year</td>
          <td>
		  <select name="year" class="select" required>
		  <option value="">-- Year--</option>
		  <?php
		  $query=("select distinct(fiscal_yr) from finance_fees ");
			$result=mysql_query($query) ;
				while($row=mysql_fetch_array($result)){
				echo "<OPTION VALUE=".$row['fiscal_yr'].">".$row['fiscal_yr']."</OPTION>"; }
			?>
		  </select>
		  </td>
		  <td>Select Form</td>
          <td>
		  <select name="form" class="select" required>
		  <option value="">-- Form--</option>
		  <option value="FORM 1">FORM 1</option>
		  <option value="FORM 2">FORM 2</option>
		  <option value="FORM 3">FORM 3</option>
		  <option value="FORM 4">FORM 4</option>
		  </select>
		  </td>
		 <!--  <td>Select Votehead</td>
		 <td>
		 <select name="votehead" class="select" required>
		  <option value="" selected="selected">-- Votehead--</option>
		 <?php
		  /*$query=("select distinct(votehead) from finance_voteheads where fiscal_year='$year'");
			$result=mysql_query($query) ;
				while($row=mysql_fetch_array($result)){
				echo "<OPTION VALUE=".$row['votehead'].">".$row['votehead']."</OPTION>"; }
				*/
			?>
		 </select>
		  </td>-->
		 
		  <td><input type="submit" name="submit" value="View Report" class="btn btn-primary"/></td>
        </tr>
      </table>
	  </form>
   </fieldset>
		
		<iframe name="reportView" src="finance_report_view_voteheadbalances.php" style="width: 100%; height: 450px;" frameborder="0"></iframe>
 </div>
</div>

<!--end of display area. This area changes when a user searches for an item-->
</body>
</html>
