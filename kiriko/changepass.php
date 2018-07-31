<?php
require_once('auth.php');
$uname = $_POST['usname'];  // Retrieve POST data
$old = $_POST['oldpass'];
$new = $_POST['newpass'];
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
$func = new Functions();
$activity = "Changed Password";
$func->addAuditTrail($activity,$username);

include('includes/dbconnector.php');

if($uname=="" || $old=="" || $new==""){  // Check if selections were made
	echo "<script language=javascript>alert('Please Provide all the Required Details'); </script>";
		 echo "<script language=javascript>window.location='my_profile.php'; </script>";
}else{ // Check if selections were made

	$query="update staff set passwrd='$new' where idpass='$uname'";
	 $result = mysql_query($query);

		if (!$result) {
        die('Invalid query: ' . mysql_error());
   		 }else{
		 echo "<script language=javascript>alert('Password Have Been Updated'); </script>";
		 echo "<script language=javascript>window.location='my_profile.php'; </script>";
		
		
		 }
}
?>