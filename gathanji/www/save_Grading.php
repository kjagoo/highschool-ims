<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];

$subject=$_POST['subjects'];
$form=$_POST['form'];
$grade=$_POST['grades'];


$min = $_POST['min'];  // Retrieve POST data
$max = $_POST['max'];
$point = $_POST['points'];
$remark = $_POST['remarks'];
//$d = $_POST['d'];
include('includes/dbconnector.php');

  // Check if selections were made


	$query="update tblgrades set minv='$min',maxv='$max',remarks='$remark' where points='$point'  and form='$form' 
	and subject='$subject' and grade='$grade'";
	// echo $query;
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Grading Has Been Set');</script>";
		?><script language=javascript>window.location='dean_edit_grades.php?id=<?php echo $point;?>&form=<?php echo $form;?>&subject=<?php echo $subject;?>'</script>
		<?php 
		
		 }

?>