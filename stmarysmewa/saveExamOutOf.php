

<?php
 
	require_once('auth.php');

$outof = $_POST['outofe'];  // Retrieve POST data
$form = $_POST['formse'];
$subje = $_POST['subse'];
$years = $_POST['year2'];

include('includes/dbconnector.php');

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Saved Exam".$years." ".$form." ".$subje." out of";
$func->addAuditTrail($activity,$username);

if(isset($outof)){  // Check if selections were made

	$query="insert into examoutof (subject,form,outof,years,states) values('$subje','$form','$outof','$years','set') 
	on duplicate key update outof='$outof'";
	 $result = mysql_query($query);

		if (!$result) {
		 die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Marks Have Been Set');</script>";
		echo "<script language=javascript>window.location='marks_set.php';</script>";
		 }
}else{
echo "Form Error";
 header("Location:marks_set.php");
}
?>