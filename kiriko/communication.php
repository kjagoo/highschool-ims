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
<!--<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>-->
<table id="main" cellpadding="0" cellspacing="0">
  <tr>
    <td id="sidepan" valign="top">
	<div class='subMenuHeader'><i class="icon icon-orange icon-mail-closed"></i>&nbsp;Communication</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li><a class='subMenuItem' href="communication_setting.php" target="content"><i class="icon icon-green icon-triangle-e"></i>&nbsp;Messages Settings</a></li>
	<li><a class='subMenuItem' href="communication_main.php" target="content"><i class="icon icon-green icon-triangle-e"></i>&nbsp;Messages Log</a></li>
	
	<li><a class='subMenuItem' href="sms_parents.php" target="content"><i class="icon icon-green icon-triangle-e"></i>&nbsp;SMS Parents</a></li>
	<li><a class='subMenuItem' href="sms_alumni.php" target="content"><i class="icon icon-green icon-triangle-e"></i>&nbsp;SMS Alumni</a> </li>
      <li><a class='subMenuItem' href="sms_teachers.php" target="content"><i class="icon icon-green icon-triangle-e"></i>&nbsp;SMS Teachers</a> </li>
	   <li><a class='subMenuItem' href="sms_custom.php" target="content"><i class="icon icon-green icon-triangle-e"></i>&nbsp;SMS Custom No</a></li> 
	   <li><a class='subMenuItem' href="sms_group.php" target="content"><i class="icon icon-green icon-triangle-e"></i>&nbsp;SMS Import Contacts</a> </li>
	   </ul>
	  <br />
	  
    </td>
    <td valign="top"><a name="top"></a>
	

     <div id="loader"><i class="icon icon-green icon-user"></i>&nbsp;<strong><?php echo $_SESSION['SESS_NAME_']?></strong></div>
      
		
		<iframe name="content" src="communication_main.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
     
	  
	  </td>
  </tr>
</table>

</body>
</html>