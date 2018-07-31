<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>SMS :: Chrimoska School System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../webicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../webicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href='css/opa-icons.css' rel='stylesheet' />
<script type="text/javascript" src="../js/prototype.js"></script>
<script type="text/javascript" src="../js/updater.js"></script>
<script type="text/javascript" src="../js/gui.js"></script>
<script type="text/javascript" src="../js/form.js"></script>
</head>
<body>
<!-- opacity loader -->
<div id="colorLoader">&nbsp;</div>
<!-- opacity loader end -->
<!-- header-->
<!--<div id="header" colspan="2">
  <div id="headerImage">&nbsp;</div>
  <div id="libraryName">Senayan Library</div>
  <div id="imgHeaderRight">&nbsp;</div>
</div>-->
<!-- header end-->
<!-- main menu -->
<div id="mainMenu" colspan="2">
  <ul id="menuList">
    <li><a class="menu" href="main.php" target="main"><i class="icon icon-green icon-home"></i>&nbsp;Dashboard</a></li>
    <?php
  if($usercat=='Administrator' || $usercat=='Secretary'){ ?>
    <li><a class="menu" href="communication.php" target="main"><i class="icon icon-green icon-envelope-closed"></i>&nbsp;Communication</a></li>
    <li><a class="menu" href="students.php" target="main"><i class="icon icon-green icon-user"></i>&nbsp;Students</a></li>
    <?php 
} 
 if($usercat=='Government Teacher' || $usercat=='Board Teacher' || $usercat=='Dean' || $usercat=='Guidance'){ ?>
    <li><a class="menu" href="marks_set.php" target="main"><i class="icon icon-green icon-user"></i>&nbsp;Students</a></li>
    <?php
 }
  if($usercat=='Administrator' || $usercat=='Dean'){ ?>
    <li><a class="menu" href="dean_main.php" target="main"><i class="icon icon-green icon-user"></i>&nbsp;Dean Settings</a></li>
    <?php
 }
if($usercat!='Accountant' ){
?>
    <li><a class="menu" href="library.php" target="main"><i class="icon icon-green icon-book"></i>&nbsp;Library</a></li>
    <?php  } if($usercat=='Administrator' ||  $usercat=='Accountant'){ ?>
	 <li><a class="menu" href="students.php" target="main"><i class="icon icon-green icon-user"></i>&nbsp;Students</a></li>
    <li><a class="menu" href="humanresource.php" target="main"><i class="icon icon-green icon-users"></i>&nbsp;Human Resource</a></li>
    <li><a class="menu" href="finance.php" target="main"><i class="icon icon-green icon-suitcase"></i>&nbsp;Finance</a></li>
    <?php } ?>
    <li style="float:right;"><a class="menu" href="logout.php"><i class="icon icon-green icon-unlocked"></i>&nbsp;LOGOUT...</a></li>
  </ul>
</div>

<iframe name="main" src="main.php" style="width: 99.8%; height:100%; position:fixed; border:none;" frameborder="0"></iframe>
<!-- license info -->
<div id="footer">
  <div class="designer"> Designed and Developed By: <a  href="http://www.chrimoska.co.ke" target="main">Chrimoska Limited</a> P.O. Box 1990-00232 RUIRU. Email:&nbsp;&nbsp;<a href="mailto:info@crystaltech.co.ke">info@chrimoska.co.ke </a> </div>
  <div class="version">Version 4:02:2014</div>
</div>
<!-- license info end -->
</body>
</html>
