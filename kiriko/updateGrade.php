<?php
require_once('auth.php');
include('includes/dbconnector.php');

if (isset($_POST['oldsubject'])) {  // Check if selections were made

$oldsubject = $_POST['oldsubject'];  // Retrieve POST data
$oldminv = $_POST['oldminv']; 
$oldmaxv = $_POST['oldmaxv']; 
$oldgrade = $_POST['oldgrade']; 
$oldform = $_POST['oldform'];

$subject=$_POST['subs'];
$form=str_replace("_"," ",$_POST['form']);
$grade=$_POST['grades'];
$min = $_POST['min'];  // Retrieve POST data
$max = $_POST['max'];
$point = $_POST['points'];
$remark = $_POST['remarks'];

	$query="update tblgrades set subject='$subject',form='$form',minv='$min',maxv='$max',remarks='$remark',points='$point' where subject='$oldsubject' and  form='$oldform' and minv='$oldminv' and maxv='$oldmaxv' and grade='$oldgrade'";
	
	 $result = mysql_query($query);

		if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		echo "<script language=javascript>alert('Grade Have Been Updated');</script>";
		?>
		<script language=javascript>window.location='grades_view.php'</script>
		<?php
		}
		
}else{
echo "Form Error";
 //header("Location:setMarks.html");
 echo "<script language=javascript>window.location='transport_summary.php';</script>";
}
?>