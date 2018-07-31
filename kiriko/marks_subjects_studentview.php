<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/Grading.php';
include('includes/dbconnector.php');	
// require_once("inc/db_Connector.php");  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  


function selectAll(source) {
		checkboxes = document.getElementsByName('checkbox[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
}

</script>

</head>
<body>
<div id="blocker">
  <div><img src="images/loading.gif" />Loading...</div>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <div class="clear"></div>
    <!--*********************************************************************************-->
    <?php

	if(isset($_GET['subs']) && isset($_GET['form']) && isset($_GET['stream']) && isset($_GET['term']) && isset($_GET['year'])){
$subject=$_GET['subs'];
$form=$_GET['form'];
$stream=$_GET['stream'];
$term=$_GET['term'];
$year=$_GET['year'];

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Set Subjects Allocation for  $subject $form $stream  $year $term ";
$func->addAuditTrail($activity,$username);

 
   ?>
    <div class="clear"></div>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Subject Allocation: <?php echo $subject."  ".$form." ". $stream?> - Term <?php echo $term?> - Year <?php echo $year?>
          </td>
		  <td class="dataListHeader" width='250' align='left'> 
		 <input type="checkbox" id="selectall" onClick="selectAll(this)" />Select All
		  </td>
      </tr>
      <tr>
        <td colspan='2'>
		<form action="allocate_selected_students.php" method="post">
		<table id="example3" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
			  <th>#</th>
			  <th>Check</th>
			   <th>Admno</th>
                <th>Student Name</th>
              </tr>
            </thead>
            <tbody>
              <?php 
		$num=0;	  
	$myqueryis="select * from studentdetails where form='$form' and class='$stream' order by admno desc";
	$toexecute=mysql_query($myqueryis);
	while ($rowr = mysql_fetch_array($toexecute)) {
	$num++;
	$ads=$rowr['admno'];
	
	$query2 = "SELECT * FROM tbl_studentsubjects where admno='$ads' and form='$form' and term='$term' and stream='$stream' and year='$year' and subject='$subject'";
				$result2 =mysql_query($query2);
				$num_rows = mysql_num_rows($result2);
				if($num_rows>=1){
				$studentpresent='checked=""';
				}else{
					$studentpresent='';
				}
?>

	  <tr>
	  <td><span id=reportText><?php echo  $num?></span></td>
	  <td width='5%'><input type="checkbox"  name="checkbox[]" value="<?php echo $ads?>" <?php echo $studentpresent?>></td>
	  <td><span id=reportText><?php echo  $ads?></span></td>
		<td><span id=reportText><?php echo str_replace("&","'",$rowr['fname'])?></span></td></font></span></td>
	  
		
 		</tr>
		
	<?php  	 
	}// end of loop for report forms
	
?>
<tr>
<td colspan="3"><input type="submit" name="delete" value="Allocate Selected" class="btn large btn-primary" /></td>
</tr>
            </tbody>
          </table>
		  <input type="hidden" name="yr" value="<?php echo $year?>" />
		   <input type="hidden" name="term" value="<?php echo $term?>" />
			 <input type="hidden" name="form" value="<?php echo $form?>" />
			  <input type="hidden" name="stream" value="<?php echo $stream?>" />
			   <input type="hidden" name="subject" value="<?php echo $subject?>" />
		 </form>
		  </td>
      </tr>
    </table>
<?php
	}else{
		?>
	<table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Students Subject Allocation</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Admno</th>
                <th align='center'>Student Name</th>
              </tr>
            </thead>
            <tbody>
			
            </tbody>
          </table></td>
      </tr>
    </table>
<?php
	}
?>	
	
	
  </div>
</div>
</div>

</body>
</html>
