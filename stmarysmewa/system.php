<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  
	
	$schoolname="-";
	$address=" -";
	//$plac="-";
	$tele="-";
	$email="-";
    $result = mysql_query("SELECT * FROM schoolname");
	$sys_count=mysql_num_rows($result);
    while ($row = mysql_fetch_array($result)) {
	$schoolname=$row['schname'];
	$address=$row['box']."&nbsp;".$row['place'];
	//$plac=$de['place'];
	$tele=$row['telphone'];
	$email=$row['email'];
	$web=$row['website'];
	
    }
  include 'includes/functions.php';
$func = new Functions();
$activity = "View School Setting Page";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>School Portal</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet' />


<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
</style>
<script type="text/javascript">

function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}

var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function commonFunction(id){
loadXMLDoc(id,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("new_Area").innerHTML=xmlhttp.responseText;
    }
  });
}
printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}

	</script>
<script language="javascript" src="scripts/calendar.js"></script>
</head>
<body>

<div id="new_Area">

<div id="page_tabs"> 
  <ul> 
    <li><a class="active" href="system.php">School Details</a></li>
	<li><a href="system_theme.php">Change Theme</a></li>
  </ul> 

</div> 
<div class="clear"></div>
<!--***********************************************
	<article class="module width_half">-->


	 <?php
	 if($sys_count<1){
	 }else{
	 ?>
 <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>SYSTEM INFO
		  <div style="float:right; margin-right:10px;">
	<a href=javascript:printDiv('print_div') title="Print" class="noline"><i class="icon icon-green icon-print"></i>&nbsp;Print</a>
	</div>
		  </td>
		  </tr>
		  <tr>
          <td>

 <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="msgsets" method="post">
	<table class='border' width="100%">
	<tr><td class="alterCell" width="20%">School Name:</td><td><h3><?php echo strtoupper($schoolname)?></h3></td></tr>
	<tr><td class="alterCell" width="20%">Address:</td><td><input type="text" name="address" class="inputFields" value="<?php echo $address?>"  /></td></tr>
	<tr><td class="alterCell" width="20%">Telephone:</td><td><input type="text" name="tel" class="inputFields" value="<?php echo $tele?>" /></td></tr>
	<tr><td class="alterCell" width="20%">Email:</td><td><input type="text" name="email" class="inputFields" value="<?php echo $email?>" /></td></tr>
	<tr><td class="alterCell" width="20%">Website:</td><td class="alterCell2"><input type="text" name="web" class="inputFields" value="<?php echo $web?>" /><input class="btn btn-success" type="submit" value="Update Details"/></td></tr>
	</table>
	 </form>
	 <?php
if(isset($_POST['address']) && isset($_POST['tel'])&& isset($_POST['email']) && isset($_POST['web']) ){ 
$address = $_POST['address'];  // Retrieve POST data
$tel = $_POST['tel'];
$email = $_POST['email'];
$web= $_POST['web'];

include('includes/dbconnector.php');
// Check if selections were made

	$query=" update schoolname set box='$address', telphone='$tel', email='$email',website='$web'";
	
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('School Details Updated Successfuly');</script>";
		echo "<script language=javascript>window.location='system.php';</script>";
	 }
}
?>
</td>
</tr>
</table>
	<?php
	}
	?>

		<!--</article> end of messages article -->
		
		
		
		
<!--***********************************************-->
<?php
	if($sys_count<1){
 ?>
<table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>SYSTEM INFO
		  <div style="float:right; margin-right:10px;">
	<a href=javascript:printDiv('print_div') title="Print" class="noline"><i class="icon icon-green icon-print"></i>&nbsp;Print</a>
	</div>
		  </td>
		  </tr>
		  <tr>
          <td>
 
  <form name="feedback_form" action="saveSystemDetails.php" method="post" enctype="multipart/form-data">
  
   <table width="90%">
 
  <tr>
	<td class="alterCell" width="20%">Portal Name*</td>
	<td><input type="text" name="consti"  id="consti" class="inputFields" /></td>
  </tr>
  <tr>
	<td class="alterCell" width="20%">P. o. Box</td>
	<td><input type="text" name="box" id="box" class="inputFields"  />
	</td>
  </tr>
  <tr>
	<td class="alterCell" width="20%">Telephone*</td>
	<td><input type="text" name="telephone"  id="telephone" class="inputFields"  />
	</td>
  </tr>
   <tr>
	<td class="alterCell" width="20%">Email Address</td>
	<td><input type="email" name="email" id="email" class="inputFields"  />
	</td>
  </tr>
  <tr>
	<td class="alterCell" width="20%">Web Address</td>
	<td><input type="text" name="web" id="web" class="inputFields"  />
	</td>
  </tr>
  <tr>
  <td class="alterCell" width="20%">School Logo</td>
  <td><input type="file" name="userfile" id="file" size="10"></td>
  </tr>
  <tr>
  <td class="alterCell" width="20%"></td>
	<td > <input type="submit"  name="submit" value="Save Settings" class="btn btn-success"></td>
</tr>
	</table>
 </form>
</td>
</tr>
</table>
<?php
	}
?>	
<!--***********************************************-->	
</div> 
<!--end of display area. 
This area changes when a user searches for an item-->

</body>
</html>
