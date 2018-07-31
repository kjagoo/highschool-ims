<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
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
<link href="css/style.css" rel="stylesheet" type="text/css" />

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
	
	
	
	
	
	<div class='subMenuHeader'><i class="icon icon-green icon-gear"></i>&nbsp;Dean Settings</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li> <a class='subMenuItem' href="dean_exam.php" target="content"><i class="icon icon-blue icon-gear"></i>&nbsp;Settings</a></li>
	<li> <a class='subMenuItem' href="dean_terms.php" target="content"><i class="icon icon-blue icon-gear"></i>&nbsp;Terms Settings</a></li>
	<li> <a class='subMenuItem' href="students_promote.php" target="content"><i class="icon icon-blue icon-shuffle"></i>&nbsp;Promote Students</a></li>
	</ul>
	<div class='subMenuHeader'>Marks Settings</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li> <a class='subMenuItem' href="dean_exam_status.php" target="content"><i class="icon icon-blue icon-edit"></i>&nbsp;Marks Recording Status</a></li>
	
	</ul>
   <br />
    </td>
    <td valign="top"><a name="top"></a>
	
	<div id="loader"><i class="icon icon-green icon-user"></i>&nbsp;<strong><?php echo $_SESSION['SESS_NAME_']?></strong></div>
	<iframe name="content" src="dean_exam.php" style="width:99.5%; min-height:500px;" frameborder="0"></iframe>
	
   </td>
  </tr>
</table>

</body>
</html>