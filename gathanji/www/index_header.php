<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  Store Inventory System                                                     #
##  Developed by:  Chrimoska Systems                                           # 
##  Licensed to :  Don Bosco Training Center Makuyu                            #
##  Site:          http://www.chrimoska.co.ke                                  #
##  Copyright:     2014. All rights reserved.                                  #
##                                                                             #
##                                                                             #
################################################################################

    require_once("includes/dbconnector.php");  
	require_once("includes/Theme.php"); 
$theme = new Theme();

	$schoolname="-";
	$address=" -";
	//$plac="-";
	$tele="-";
	$email="-";
    $result = mysql_query("SELECT * FROM schoolname");

    while ($row = mysql_fetch_array($result)) {
	$schoolname=$row['schname'];
	$address=$row['box']."&nbsp;".$row['place'];
	//$plac=$de['place'];
	$tele=$row['telphone'];
	//$email=$row['email'];
	
    }
?><head>
    <title><?php echo $schoolname?></title>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <link href="css/<?php echo $theme->getActiveTheme();?>.css" type="text/css" rel="stylesheet">
	<link href="images/log.png" rel="shortcut icon" type="image/x-icon" />
	<style>
	header#header{
	background-color: #266a9b;
	}
	
	</style>
</head>

<!-- HEADER -->
    <header id="header">
  <table width="98%">
	  <tr>
	  <td width="20%"> <div style="float:left;">  </div>
	  </td>
	  <td width="60%" valign="top">
	  <table width="100%" >
	  <tr>
          <td class="heading_text">
           <?php echo strtoupper($schoolname)?>
          </td>
        </tr>
        <tr>
          <td align="center"  class="head_text">
            P. O Box <?php echo $address?>
          </td>
        </tr>
        <tr>
          <td align="center"  class="head_text">
            Tel: 0<?php echo $tele?>
          </td>
        </tr>
	  </table>
	   </td>
	 <td width="19%" valign="bottom" align="right"  class="head_text">
	 </td>
	  </tr>
      </table>
<div style="clear: both;"></div> 
</header>
<!-- END OF HEADER -->
