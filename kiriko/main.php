<?php
  require_once("includes/dbconnector.php"); 
require_once('auth.php');


$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>CL :: School Management System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../webicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../webicon.ico" type="image/x-icon" />

<link href="css/<?php echo $_SESSION['THEMEs']?>.css" rel="stylesheet" type="text/css" /

<link href='css/opa-icons.css' rel='stylesheet' />

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script>

</head>
<body>
<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>

<table id="main" cellpadding="0" cellspacing="0">
  <tr>
    <td id="sidepan" valign="top">
	
	<div class='subMenuHeader'><i class="icon icon-green icon-gear"></i>&nbsp;System Settings</div>
	<a class='subMenuItem' href="content.php" target="content"><i class="icon icon-green icon-home"></i>&nbsp;Dashboard</a>
	<?php
	  if($usercat=='Administrator' || $usercat=='Deputy' || $usercat=='ICT'){ ?>
      <a class='subMenuItem' href="system.php" target="content"><i class="icon icon-green icon-wrench"></i>&nbsp;System Setup</a> 
	   <a class='subMenuItem' href="system_streams.php" target="content"><i class="icon icon-green icon-home"></i>&nbsp;Streams Setup</a> 
	   <a class='subMenuItem' href="system_enrollment.php" target="content"><i class="icon icon-green icon-document"></i>&nbsp;School Enrolment</a> 
	   <?php }
	     if($usercat=='Administrator' ||  $usercat=='Accountant' || $usercat=='Secretary' || $usercat=='Deputy' || $usercat=='ICT'){
	   ?>
	   
	   <a class='subMenuItem' href="system_back_up.php" target="content"><i class="icon icon-green icon-archive"></i>&nbsp;Database Backup</a> 
	   <?php } ?>
	   
		<a class='subMenuItem' href="my_profile.php" target="content"><i class="icon-user"></i>&nbsp;My Account</a>  
		<?php   if($usercat=='Administrator' || $usercat=='Deputy' || $usercat=='ICT'){ ?>
		<a class='subMenuItem' href="system_logfile.php" target="content"><i class="icon-signal"></i>&nbsp;System Audit</a> 
		<?php } ?>
	
   <br />
    </td>
    <td valign="top"><a name="top"></a>
	
	<div id="loader"><i class="icon icon-green icon-user"></i>&nbsp;<strong><?php echo $_SESSION['SESS_NAME_']?></strong></div>
	<iframe name="content" src="content.php" style="width:99.5%; min-height:500px;" frameborder="0"></iframe>
	
   </td>
  </tr>
</table>

</body>
</html>