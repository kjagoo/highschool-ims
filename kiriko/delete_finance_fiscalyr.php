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
$statues = $details[1];


 $update="delete from finance_fiscalyr where fiscal_year='$year ' AND STATUS='$statues'";
 mysql_query($update);
 ?>
<script language=javascript>alert('FINANCIAL YEAR DELETED');</script>

<?php
$func = new Functions();
	$activity = "Deleted  financial year";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

}

?>