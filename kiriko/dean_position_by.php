<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
a{cursor:pointer;
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
function download(){
	window.location='files.xls';
}

 function searchFunction(str)
    {
    if (str=="")
    {
    document.getElementById("display_Area").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display_Area").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","getFileDetailsSearch.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}


function changeDisplay(){
if(document.getElementById('available').style.display = "block"){
document.getElementById('new_entry').style.display = "none"
}
if(document.getElementById('new_entry').style.display = "block"){
document.getElementById('available').style.display = "none"
}
}
	</script>
</head>
<body>

<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a href="dean_exam.php">Standard Marks</a></li>
    <li><a href="dean_grading.php">Grade Settings</a></li>
    <li><a href="dean_subjects_done.php">Subjects Done</a></li>
    <li><a class="active" href="dean_position_by.php">Positioning</a></li>
    <li><a href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a href="dean_report_forms.php">Report Form Lock</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <?php
  $query="SELECT * FROM positionby";
  $result = mysql_query($query);
  while($row = mysql_fetch_array($result)){
  $marks=$row['marks'];
  $point=$row['point'];
  }
  
  if($marks==1){
  $positionby='Average Marks';
  }
  if($point==1){
  $positionby='Average Points';
  }
  
  ?>
  <div id="available" style="display:block; width:80%">
  <fieldset>
  <table width="100%">
  <tr>
  <td>Current Positioning has been set to:</td>
  <td><h3><?php echo  $positionby?></h3></td>
  <td align="left"><a onClick="changeDisplay();" class="btn btn-primary">Change this settings</a></td>
  </tr>
  </table>
 </fieldset>
  </div>
  
  <div id="new_entry" style="display:none;">
    <fieldset>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="position" method="post">
      <table width="70%">
              <tr>
                <td>Position By:</td>
                <td><select name="cate" class="select" >
                    <option value="Marks">Total Marks </option>
                    <option value="Points">Total Points</option>
                  </select>
                </td>
             
          <td><input class="btn btn-success" type="submit" value="Set Positioning Mode"/></td>
        </tr>
      </table>
    </form>
    </fieldset>
	
	<?php
if(isset($_POST['cate'])){
	$username=$_SESSION['SESS_MEMBER_ID_'];
	 include 'includes/functions.php';
	$func = new Functions();
	$activity = "Changed Positioning By";
	$func->addAuditTrail($activity,$username);
	
	$category=$_POST['cate'];
	
	include('dbConnector.php');
	
	if($category=="Marks"){
	$marks=1;
	$points=0;
	}else{
	$marks=0;
	$points=1;
	}
	//echo 'Marks='. $marks. '<br/>Points='.$points;
	$query="update positionby set marks= $marks, point=$points";
	
	 $result = mysql_query($query);

		if (!$result) {
        die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Positioning Has Been Set');</script>";
		echo "<script language=javascript>window.location='dean_position_by.php';</script>";
		 }

}
?>
</div>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
