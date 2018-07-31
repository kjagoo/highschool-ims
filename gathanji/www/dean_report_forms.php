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
    <li><a  href="dean_position_by.php">Positioning</a></li>
    <li><a  href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a class="active" href="dean_report_forms.php">Report Form Lock</a></li>
	
  </ul> 

</div> 
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <?php
  $query="SELECT * FROM d_locks";
  $result = mysql_query($query);
  while($row = mysql_fetch_array($result)){
  $status=$row['d_lock'];
  }
  
  if($status=="open"){
  $status='Open';
  $image='lock_open.png';
  $b_value='Lock';
  $change='locked';
  }
if($status=="locked"){
   $status='Locked';
   $image='lock_closed.png';
   $b_value='UnLock';
    $change='open';
  }
  
  ?>
 
  

    <fieldset>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="lock" method="post"> 
	<table width="80%">
	 <tr>
  	<td><img src="images/<?php echo $image?>" align="absmiddle" /></td>
	<td>Report Forms Generation is currently &nbsp;<strong><?php echo  $status?></strong></td>
  	<td align="left"><input type="hidden" id="d_status" name="d_status" value="<?php echo $change?>" />            
       <input class="btn btn-primary" type="submit" name="d_locks" value="<?php echo $b_value?> Report Forms"/>
	 </td>
	 </tr>
	 </table>
    </form>
    </fieldset>
	
	<?php
	if(isset($_POST['d_status'])){
	include('includes/dbconnector.php');
	$chg=$_POST['d_status'];
	$qury="update d_locks set d_lock='$chg'";
	$resultq = mysql_query($qury);

		if (!$resultq) {
        die('Invalid query: ' . mysql_error());
   		 }else{
		 
		 include 'includes/functions.php';
$func = new Functions();
$activity = $chg." Report forms";
$func->addAuditTrail($activity,$username);

		 ?>
		 
		<script language=javascript>alert('Report Form Generation is now <?php echo $chg?>');</script>
		<script language=javascript>window.location='dean_report_forms.php';</script>
	<?php
		 }
	}
	?>

  </div>
</div>
 
<!--end of display area. 
This area changes when a user searches for an item-->

</body>
</html>
