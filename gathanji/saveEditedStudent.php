<?php
require_once('auth.php');
$adms = $_POST['adm']; 
$fname = $_POST['fname']; 
$mname = $_POST['mname']; 
$lname = $_POST['lname']; 
$gender = $_POST['pick']; 
$dob = $_POST['dob']; 
$age = $_POST['age']; 
$relig = $_POST['reli']; 
$yearadm = $_POST['yearad']; 
$pres = $_POST['pschool']; 
$marks = $_POST['kmarks']; 
$grades = $_POST['kgrade']; 
$forms = $_POST['form']; 
$stream = $_POST['stream']; 
$category = $_POST['cate']; 
$house = $_POST['house']; 

$pfname = $_POST['prfname']; 
$pmname = $_POST['pmname']; 
$plname = $_POST['plname']; 
$idp = $_POST['idpass'];
$address = $_POST['address'];  
$telep = $_POST['telephone']; 

$fname=str_replace('\'','&',$fname);
$mname=str_replace('\'','&',$mname);
$lname=str_replace('\'','&',$lname);

$pfname=str_replace('\'','&',$pfname);
$pmname=str_replace('\'','&',$pmname);
$plname=str_replace('\'','&',$plname);

$address=str_replace('\'','&',$address);
$pres=str_replace('\'','&',$pres);
$house=str_replace('\'','&',$house);

include('includes/dbconnector.php');

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Edited ".$adms." Details";
$func->addAuditTrail($activity,$username);
  
	
	$query="update studentdetails set fname='$fname',lname='$lname',sname='$mname',gender='$gender',dob='$dob',age='$age',					religion='$relig',previouschool='$pres',marks='$marks',picture='-',yrofadmn='$yearadm',form='$forms',category='$category',house='$house',grade='$grades',class='$stream' where admno='$adms'";
	
	 $result = mysql_query($query);
	if (!$result) {
        die('Invalid query: ' . mysql_error());
   		 }else{
		 //save parent details
		 $query2="update parentdetails set fname='$pfname',lname='$plname',sname='$pmname',idpass='$idp',address='$address',telephone='$telep' where admno='$adms'";
		$commad=mysql_query($query2);
		if (!$commad) {
        die('Invalid commad: ' . mysql_error());
   		 }	else{		
		echo "<script language=javascript>alert('Student Details have been Updated'); </script>";
		echo "<script language=javascript>window.location='student_list_view.php'; </script>";
		 }
		 }
	
	
 
?>