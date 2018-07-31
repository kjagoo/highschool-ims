<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>SMS :: School Management System</title>
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
	<div class='subMenuHeader'>Human Resource</div>
	<a class='subMenuItem' href="hr_main.php" target="content"><i class="icon icon-blue icon-home"></i>&nbsp;HR Dashboard</a>
	
	<div class='subMenuHeader'><i class="icon icon-grey icon-users"></i>&nbsp;Staff</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	
	<li><a class='subMenuItem' href="hr_newstaff.php" target="content"><i class="icon icon-blue icon-plus"></i>&nbsp;New Staff</a></li>
	<li><a class='subMenuItem' href="hr_stafflist.php" target="content"><i class="icon icon-blue icon-document"></i>&nbsp;Staff List</a></li>
	<li><a class='subMenuItem' href="hr_createpayslips.php" target="content"><i class="icon icon-blue icon-document"></i>&nbsp;Create Payslips</a></li>
	</ul>
	<div class='subMenuHeader'><i class="icon icon-grey icon-gear"></i>&nbsp;Settings</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	
	<li><a class='subMenuItem' href="hr_deductions.php" target="content"><i class="icon icon-blue icon-arrowthick-w"></i>&nbsp;Employee Deductions</a></li>
	<li><a class='subMenuItem' href="hr_allowances.php" target="content"><i class="icon icon-blue icon-arrowthick-e"></i>&nbsp;Employee Benefits</a></li>
	
	
	</ul>
	<div class='subMenuHeader'><i class="icon-list"></i>&nbsp;Reports</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li><a class='subMenuItem' href="hr_report_masterpayslip.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Master Payslips</a></li>
	<li><a class='subMenuItem' href="hr_report_nhif.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;NHIF Reports</a></li>
	<li><a class='subMenuItem' href="hr_report_nssf.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;NSSF Reports</a></li>
	<!--<li><a class='subMenuItem' href="classlist.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;KRA Reports</a></li>
	<li><a class='subMenuItem' href="classlist.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Payment Advices</a></li>-->
	</ul>
	  <br />
    </td>
    <td valign="top"><a name="top"></a>
	

     <div id="loader"><i class="icon icon-blue icon-user"></i>&nbsp;<strong><?php echo $_SESSION['SESS_NAME_']?></strong></div>
      
		
		<iframe name="content" src="hr_main.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
     
	  
	  </td>
  </tr>
</table>

</body>
</html>