<?php

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
if($_GET['id'])
{
$id=$_GET['id'];

 $sql = "delete from tblaudittrail where id='$id'";
 mysql_query( $sql);


}

?>