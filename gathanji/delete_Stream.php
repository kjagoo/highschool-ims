<?php

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
 include 'includes/functions.php';
  require_once('auth.php');
if($_GET['id'])
{
$id=$_GET['id'];
$str=$_GET['stream'];

 $sql = "delete from streams where form='$id' and stream='$str'";
 mysql_query( $sql);

$func = new Functions();
	$activity = "Deleted Stream ".$id;
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

}

?>