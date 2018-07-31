<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>SMS:: School Management System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../webicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../webicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<link href='css/opa-icons.css' rel='stylesheet' />

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

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
<table id="main" cellpadding="0" cellspacing="0">
  <tr>
    <td id="sidepan" valign="top">
	<div class='subMenuHeader'>Finance</div>
	<a class='subMenuItem' href="finance_main.php" target="content"><i class="icon icon-green icon-home"></i>&nbsp;Finance Dashboard</a>
	<a class='subMenuItem' href="finance_students.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Search Students</a>
	<div class='subMenuHeader'>Settings</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li><a class='subMenuItem' href="finance_fiscalyear.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Main Setting</a></li>
        <li><a class='subMenuItem' href="finance_voteheads.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Cash Book Setting</a></li>
	<li><a class='subMenuItem' href="finance_setfees.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Fee Setting</a></li>
	<li><a class='subMenuItem' href="finance_additional_Fees.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Add Additional Fees</a></li>
	<!--<li><a class='subMenuItem' href="finance_setfees.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;GL Acounts</a></li>-->
	<li><a class='subMenuItem' href="system_back_up.php" target="content"><i class="icon icon-blue icon-archive"></i>&nbsp;Database Backup</a></li>
	</ul>
	<div class='subMenuHeader'>Transactions</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li><a class='subMenuItem' href="finance_recordbal.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Record Fees Balances</a></li>
	<li><a class='subMenuItem' href="finance_collect_fees.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Collect Fees/Income</a></li>
	
	<li><a class='subMenuItem' href="finance_payables.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Expenses</a></li>
	
	<li><a class='subMenuItem' href="finance_paybills.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Pay Bills/Suppliers</a></li>
	
	
	<li><a class='subMenuItem' href="finance_PO.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Receive Invoices</a></li>
	
	<li><a class='subMenuItem' href="finance_pocketmoney.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Pocket Money</a></li>
	
	<!--<li><a class='subMenuItem' href="finance_setfees.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;A/C Receivables</a></li>
	
	<li><a class='subMenuItem' href="finance_inventory.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Inventory</a></li>-->
	
	
	
	<!--<li><a class='subMenuItem' href="finance_setfees.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Banking</a></li>-->
	</ul>
	
	
	<div class='subMenuHeader'>Reports</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li><a class='subMenuItem' href="finance_report_statements.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Fees Ledger</a></li>
	
	<li><a class='subMenuItem' href="finance_report_analysis.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;General Ledger</a></li>
	
	</ul>
	  <br />
    </td>
    <td valign="top"><a name="top"></a>
	

     <div id="loader"><i class="icon icon-green icon-user"></i>&nbsp;<strong><?php echo $_SESSION['SESS_NAME_']?></strong></div>
      
		
		<iframe name="content" src="finance_main.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
     
	  
	  </td>
  </tr>
</table>

</body>
</html>