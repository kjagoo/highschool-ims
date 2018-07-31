<?php
require_once('auth.php');
require_once("includes/Theme.php"); 

$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  

  include 'includes/functions.php';
$func = new Functions();
$activity = "View School Theme Page";
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
      <li><a href="system.php">School Details</a></li>
      <li><a class="active" href="system_theme.php">Change Theme</a></li>
    </ul>
  </div>
  <div class="clear"></div>
  <!--***********************************************
	<article class="module width_half">-->
  <table class='borders' cellpadding='5' cellspacing="0" width="100%">
    <tr style='height:30px;'>
      <td class='dataListHeader' colspan='4'>SYSTEM THEME </td>
    </tr>
    <tr>
      <td>
	   <div class="box-content">
	   <ul class="dashboard-list">
          <?php
			$querytheme = "select * from tbl_themes order by theme_name asc";
			$resulttheme=mysql_query($querytheme) ;
			while($rowth=mysql_fetch_array($resulttheme)){?>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="lock" method="post"> 
          <li><a href="#"><span class="label label-<?php echo $rowth['theme_name']?>"></span>  <?php echo $rowth['theme_name']?> </a>  
		  <span class="label"><?php if($rowth['theme_status']==1){ echo "Active";}else { echo "Inactive"; }?></span> 
		  
		   <input type="hidden" id="d_status" name="d_status" value="<?php echo $rowth['theme_status']?>" /> 
		   <input type="hidden" id="tname" name="tname" value="<?php echo $rowth['theme_name']?>" />
		    <input type="hidden" id="css" name="css" value="<?php echo $rowth['css_name']?>" />
		  <input type="submit" class="btn-mini" name="submit" value="Activate" />
		 
		  </li>
		   </form>
          <?php 
		}
		?>
        </ul>
	</div>

	</td>
    </tr>
  </table>
  <?php
	if(isset($_POST['submit'])){
	include('includes/dbconnector.php');
	$chg=$_POST['d_status'];
	$tname=$_POST['tname'];
	$css=$_POST['css'];
	mysql_query("update tbl_themes set theme_status='0'");
	$qury="update tbl_themes set theme_status='1' where theme_name='$tname'";
	$resultq = mysql_query($qury);

		if (!$resultq) {
        die('Invalid query: ' . mysql_error());
   		 }else{
		 
$activity =" Changed System Theme";
$func->addAuditTrail($activity,$username);

$_SESSION['THEME']=$css;


		 ?>
		 
		<script language=javascript>alert('Theme has been changed to <?php echo $tname?>\n\nRefresh to apply theme');</script>
		<script language=javascript>window.location='system_theme.php';</script>
	<?php
		 }
	}
	$theme = new Theme();
$_SESSION['THEMEs']=$theme->getActiveThemeSmall();
	?>
  <!--***********************************************-->
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
