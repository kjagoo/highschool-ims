

<?php

	require_once('auth.php');

$outof = $_POST['outof'];  // Retrieve POST data
$form = $_POST['forms'];
$year = $_POST['years'];
$term = $_POST['term'];
$cats = $_POST['cats'];
$subje = $_POST['subs'];

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Saved ".$cats." ".$form." ".$year." ".$term." ".$subje." out of";
$func->addAuditTrail($activity,$username);

include('includes/dbconnector.php');

if(isset($outof)){  // Check if selections were made

	$query="insert into catoutof (subject,cat,form,year,term,outof,states) 
	values('$subje','$cats','$form','$year','$term','$outof','set') 
	on duplicate key update outof='$outof', states='set'";
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