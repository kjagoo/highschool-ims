<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];

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
    <td  id="sidepan" valign="top">
	<div style="overflow:auto; height:550px;">
	<div class='subMenuHeader'>Students</div>
	 <ul style="list-style:none; margin:0 0 0 10px; padding:0;">
<?php
if($usercat=='Administrator' || $usercat=='Secretary' || $usercat=='Accountant'){ ?>

	<li><a class='subMenuItem' href="student_list.php" target="content"><i class="icon icon-blue icon-users"></i>&nbsp;Students List</a></li>
	<li><a class='subMenuItem' href="student_addnew.php" target="content"><i class="icon icon-blue icon-plus"></i>&nbsp;Add New Student</a></li>
	<li><a class='subMenuItem' href="student_transfers.php" target="content"><i class="icon icon-blue icon-transfer-ew"></i>&nbsp;Transferred Student</a></li>
	<?php
	}
if($usercat=='Administrator' || $usercat=='Government Teacher' || $usercat=='Board Teacher' || $usercat=='Dean'|| $usercat=='Secretary'){ ?>
<li><a class='subMenuItem' href="classlist.php" target="content"><i class="icon icon-blue icon-document"></i>&nbsp;Class List</a></li>
	<li><a class='subMenuItem' href="displine.php" target="content"><i class="icon icon-blue icon-pin"></i>&nbsp;Discipline</a></li> 	</ul>
	<div class='subMenuHeader'>Marks</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	   <li> <a class='subMenuItem' href="marks_set.php" target="content"><i class="icon icon-blue icon-check"></i>&nbsp;Set Marks</a> </li>
	   <li> <a class='subMenuItem' href="marks_record.php" target="content"><i class="icon icon-blue icon-compose"></i>&nbsp;Record Marks</a> </li>
	   <li> <a class='subMenuItem' href="marks_manage.php" target="content"><i class="icon icon-blue icon-edit"></i>&nbsp;Edit Marks</a> </li>
	</ul>
	<?php
}
if($usercat=='Administrator'  || $usercat=='Dean'){ ?>
	<div class='subMenuHeader'>Reports</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">	
	<li> <a class='subMenuItem' href="reports_halfterm.php" target="content"><i class="icon icon-blue icon-doc"></i>&nbsp;Half-Term Analysis</a></li>
	<li> <a class='subMenuItem' href="reports_finalanalysis.php" target="content"><i class="icon icon-blue icon-doc"></i>&nbsp;End Term Analysis</a></li>
	
	<li> <a class='subMenuItem' href="report_forms.php" target="content"><i class="icon icon-blue icon-doc"></i>&nbsp;Report Forms</a></li>
	<li> <a class='subMenuItem' href="report_spreadsheet.php" target="content"><i class="icon icon-blue icon-doc"></i>&nbsp;SpreedSheets</a></li>
	<li> <a class='subMenuItem' href="report_subjects_analysis.php" target="content"><i class="icon icon-blue icon-doc"></i>&nbsp;Subjects Analysis</a></li>
	<li> <a class='subMenuItem' href="report_indicators.php" target="content"><i class="icon icon-blue icon-arrow-n-s"></i>&nbsp;Performance Check</a></li>
<li><a class='subMenuItem' href="KCSE.php" target="content"><i class="icon icon-blue icon-script"></i>&nbsp;KCSE Analysis</a></li> 
	</ul>


	 </ul>
<?php
}
?>
	 <br/>
	</div>
    </td>
    <td valign="top"><a name="top"></a>
	

     <div id="loader"><i class="icon icon-blue icon-user"></i>&nbsp;<strong><?php echo $_SESSION['SESS_NAME_']?></strong></div>
      
		<?php 
		if($usercat=='Administrator' || $usercat=='Secretary' || $usercat=='Accountant'){ ?>
		<iframe name="content" src="student_list.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
     <?php
	 }
	if($usercat=='Government Teacher' || $usercat=='Board Teacher' || $usercat=='Dean'){ ?>
	<iframe name="content" src="marks_set.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
	<?php
	}?>
	 
	  </td>
  </tr>
</table>
<!--<script type="text/javascript">
    window.onload = SetAction();
    function SetAction() {
    var allLinks = document.getElementsByTagName("A");
    for (var i=0;i<allLinks.length;i++){
    if (allLinks[i].parentNode.nodeName == "LI") {
    allLinks[i].onclick = function (){
    for (var j=0;j<allLinks.length;j++) {
    if (allLinks[j].className != "") {
    allLinks[j].className ="";
    }
    this.className = "clicked";}
    }
    }
    }
    }
    </script>
--></body>
</html>