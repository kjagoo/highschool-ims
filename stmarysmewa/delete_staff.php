<?php
/* 
 DELETE.PHP
*/
 // connect to the database
 require_once('auth.php');
include('includes/dbconnector.php');
 $date=date("Y-m-d");
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 $username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Deleted Staff ". $id;
$func->addAuditTrail($activity,$username);
 // delete the entry
 $result = mysql_query("update staff set category='TRAN', dateLeft='$date' WHERE idpass='$id'")
 or die(mysql_error()); 
 
 // redirect back to the view page
 echo "<script language=javascript>alert('Staff Have Been Deleted From The System') </script>";
 header("Location: hr_stafflist.php");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: hr_stafflist.php");
 }
 
 
?>