<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
$func = new Functions();

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
if($_GET['id'])
{
$id=$_GET['id'];

 $sql = "delete from books_invemtory where bookid='$id'";
 mysql_query( $sql);
 $activity = "Deleted book s/n ".$id;
$func->addAuditTrail($activity,$username);

}

?>