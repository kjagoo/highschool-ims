<?php

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
 include 'includes/functions.php';
  require_once('auth.php');
if($_GET['id'])
{
$id=$_GET['id'];


 
 $deletedon=date("Y-m-d");
 $year=date('Y');
 
 
 $resultget = mysql_query("SELECT * FROM studentdetails where admno='$id'");
 while($row = mysql_fetch_array($resultget)){
 $fname= $row['fname'];
 $sname= $row['sname'];
 $lname= $row['lname'];
 $gender= $row['gender'];
 $form= $row['form'];
 }

  $update="update studentdetails set form='TRAN' where admno='$id'";
 mysql_query($update);
 
 $updatept="update tbleperformancetrack set s_status='1' where admno='$id'";
 mysql_query($updatept);
 
  $query="insert into transfers (admno,name,gender,form,deleted,yr) values
 	('$id','$fname $sname $lname','$gender','$form','$deletedon','$year')";
	mysql_query($query);

 ?>
<script language=javascript>alert('Student has been Moved to Transferred List');</script>


<?php
$func = new Functions();
	$activity = "Moved ".$id ."to Stranferred";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

}

?>