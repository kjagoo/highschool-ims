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


 mysql_query("delete from purchase_orders where po_number='$id'");
 mysql_query("delete from purchase_ordersitems where po_number='$id'");
 $activity = "Deleted LPO ".$id;
$func->addAuditTrail($activity,$username);

}

?>