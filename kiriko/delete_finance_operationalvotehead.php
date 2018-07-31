<?php

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
include 'includes/functions.php';
require_once('auth.php');

if($_GET['id'])
{
$id=$_GET['id'];

/* id=2015,Name,2 */

$details = array();
$details = explode(',',$id);
$year = $details[0];
$vote = $details[1];
$term = $details[2];


 $update="delete from finance_operationalvoteheads where fiscal_year='$year ' AND term='$term' AND votehead='$vote'";
 mysql_query($update);
 ?>
<script language=javascript>alert('VOTE HEAD DELETED');</script>

<?php
$func = new Functions();
	$activity = "Deleted  Vote head";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

}

?>