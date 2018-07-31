<?php
$secret = $_POST['subs'];//admission numbers
$marks = $_POST['ads'];//marks

$year=$_POST['yr'];
$term=$_POST['term'];
$form = $_POST['form'];
$strm=$_POST['stream'];

if($form==1){
$myform="FORM 1";
}
if($form==2){
$myform="FORM 2";
}
if($form==3){
$myform='FORM 3';
}
if($form==4){
$myform='FORM 4';
}

include('includes/dbconnector.php');

$ar=explode(',',$secret);
$mks=explode(',',$marks);



for ($i=0;$i<count($ar);$i++){

$final=$mks[$i];

	

	$act="insert into finance_balances 
	(admno,form,term,year,balance) 	
	values('$ar[$i]','$form','$term','$year','$final') on duplicate key update balance='$final' ";
	
	
 	$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}
	
	
  }
  echo "<script language=javascript> alert('Balances Recorded Successfuly');</script>";
  echo "<script language=javascript> window.location='finance_recordbal.php';</script>";


?>