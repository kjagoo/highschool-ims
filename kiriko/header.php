<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  Developed by:  Chrimoska Systems                                           #
##  Site:          http://www.chrimoska.co.ke                                  #
##  Copyright:     2014. All rights reserved.                                  #
##                                                                             #
##                                                                             #
################################################################################


require_once('auth.php');
$username=$_SESSION['SESS_NAME_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
  require_once("includes/dbconnector.php");  
	
	$schoolname="-";
	$address=" -";
	//$plac="-";
	$tele="-";
	$email="-";
	$web="-";
    $result = mysql_query("SELECT * FROM schoolname");

    while ($row = mysql_fetch_array($result)) {
	$schoolname=$row['schname'];
	$address=$row['box']." ". $row['place'];
	$tele=$row['telphone'];
	$email=$row['email'];
	$web=$row['website'];
	}
	
	$displayName = explode(' ',trim($username));
?><head>
<title><?php echo strtoupper($schoolname)?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="images/KIWASCO_logo.ico" rel="shortcut icon" type="image/x-icon" />
<link href="css/<?php echo $_SESSION['THEME'];?>.css" type="text/css" rel="stylesheet">
<link href="css/<?php echo $_SESSION['THEMEs']?>.css" rel="stylesheet" type="text/css" />
<link href='css/opa-icons.css' rel='stylesheet'>

<style>
	header#header{
	background-color: #266a9b;
	}
	body{
	background-color: #266a9b;
	}
	</style>
</head>
<!-- HEADER -->
<header id="header">
  <table width="98%">
    <tr>
      <td width="80%" valign="top">
	  	<table width="100%" >
          <tr>
            <td  class="heading_text"><?php echo strtoupper($schoolname)?> </td>
			</tr>
			<tr>
            <td align="center" class="head_text"> P. O Box <?php echo $address?> | Tel: <?php echo $tele?> | Email <a href="mailto:<?php echo $email?>"><?php echo $email?></a>  |  Website: <a href="http://<?php echo $web?>"><?php echo $web?></a></td>
          </tr>
		 
        </table>
	 </td>
    </tr>
  </table>
  <div style="clear:both; height:5px;"></div>
<div id="mainMenu" style="float:left;">
  <ul id="menuList">
    <li><a class="menu" href="main.php" target="main"><i class="icon icon-white icon-home"></i>&nbsp;Dashboard</a></li>

<?php
  if($usercat=='Administrator' || $usercat=='Deputy' || $usercat=='ICT' || $usercat=='Secretary'){ ?>
    <li><a class="menu" href="communication.php" target="main"><i class="icon icon-white icon-envelope-closed"></i>&nbsp;Communication</a></li>
	<?php }
	 if($usercat=='Administrator' || $usercat=='Deputy' || $usercat=='ICT'|| $usercat=='Secretary' || $usercat=='Government Teacher' || $usercat=='Board Teacher' || $usercat=='Dean'||$usercat=='Guidance'){ 
	
	?>
    <li><a class="menu" href="students.php" target="main"><i class="icon icon-white icon-user"></i>&nbsp;Students</a></li>
	
	
<?php } 
if($usercat=='Administrator' || $usercat=='Deputy' || $usercat=='ICT' || $usercat=='Dean'){ ?>
    <li><a class="menu" href="dean_main.php" target="main"><i class="icon icon-white icon-contacts"></i>&nbsp;Dean Settings</a></li>
    <?php
 }
if($usercat!='Accountant' ){
?>

    <li><a class="menu" href="library.php" target="main"><i class="icon icon-white icon-book"></i>&nbsp;Library</a></li>
<?php  } if($usercat=='Administrator' ||  $usercat=='Accountant' || $usercat=='Deputy' || $usercat=='ICT'){ ?>

    <li><a class="menu" href="humanresource.php" target="main"><i class="icon icon-white icon-users"></i>&nbsp;Human Resource</a></li>
	<?php } if($usercat=='Administrator' ||  $usercat=='Accountant'){ ?>
    <li><a class="menu" href="finance.php" target="main"><i class="icon icon-white icon-suitcase"></i>&nbsp;Finance</a></li>
	<?php } ?>
    <li style="float:right;"><a class="menu" href="logout.php"><i class="icon icon-white icon-unlocked"></i>&nbsp;LOGOUT</a></li>
  </ul>
</div>
  <div style="clear: both;"></div>
</header>
<!-- END OF HEADER -->
