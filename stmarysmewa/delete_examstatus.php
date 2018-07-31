<?php

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
 include 'includes/functions.php';
  require_once('auth.php');
if($_GET['id'])
{
$year=$_GET['id'];
 $term= $_GET['term'];
 $form= $_GET['form'];
 $stream= $_GET['stream'];
 $subject= $_GET['subject'];
 $etype= $_GET['etype'];

  $update="delete from examstatus where year='$year' and term='$term' and form='$form' and stream='$stream' and subject='$subject' and examtype='$etype'";
 mysql_query($update);
 
  
$func = new Functions();
	$activity = "Allowed Form ".$subject." ".$form ."Re-entry";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

}

?>