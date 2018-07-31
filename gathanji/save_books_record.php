<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
$func = new Functions();

$title=$_POST['title'];
$author=$_POST['author'];
$publisher=$_POST['publisher'];
$btype=$_POST['btype'];
$cat=$_POST['category'];
$frm=$_POST['frm'];
$yr=$_POST['yr'];
$pcs=$_POST['pcs'];
$status=$_POST['status'];
$comment=$_POST['comment'];

  require_once("includes/dbconnector.php"); 

$act="insert into books_invemtory 
	(title,author,publisher,sn,category,form,yrofedition,noofpcs,btype,bookstatus,comments) 	
	values('$title','$author','$publisher','-','$cat','$frm','$yr','$pcs','$btype','$status','$comment')";
 	$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}
 $activity = "Added book: ".$title;
$func->addAuditTrail($activity,$username);

  echo "<script language=javascript> alert('Record Successful');</script>";
  echo "<script language=javascript> window.location='library_addbook.php';</script>";
  

?>