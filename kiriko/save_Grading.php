

<?php
 
	require_once('auth.php');

$subject=$_POST['subs'];
$form=$_POST['form'];
$grade=$_POST['grades'];


$min = $_POST['min'];  // Retrieve POST data
$max = $_POST['max'];
$point = $_POST['points'];
$remark = $_POST['remarks'];

include('includes/dbconnector.php');

if(isset($subject)){  // Check if selections were made


	$query="insert into tblgrades (subject,minv,maxv,grade,remarks,points,form) 
	values('$subject','$min','$max','$grade','$remark','$point','$form') 
	on duplicate key update subject='$subject'";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Grading Has Been Set');</script>";
		echo "<script language=javascript>window.location='dean_grading.php';</script>";
		 }
}else{
echo "Form Error";
 header("Location:dean_grading.php");
}
?>