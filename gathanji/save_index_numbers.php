<?php
$secret = $_POST['subs'];//admission numbers
$marks = $_POST['ads'];//marks

$year=$_POST['yr'];

include('includes/dbconnector.php');

$ar=explode(',',$secret);
$mks=explode(',',$marks);



for ($i=0;$i<count($ar);$i++){
$score=$mks[$i];

/**************** CHECK IF THERE EXISTS MARKS FOR THIS TERM SUBJECT ***********************************************/
	

$act="insert into kcseanalysis 
	(admno,index_numbers,year_finished) 	
	values('$ar[$i]','$score','$year') ";
 	$resultin=mysql_query($act); 
	
	if(!$resultin){
	echo"failed". mysql_error();
	 echo "<script language=javascript> alert('Index Numbers Have Already been Added');</script>";
  echo "<script language=javascript> window.location='KCSE.php';</script>";
	}else{
	echo "<script language=javascript> alert('Index Numbers Have  Been Added');</script>";
  echo "<script language=javascript> window.location='KCSE.php';</script>";
	}
	
	
	
  }
?>