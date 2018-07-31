<?php
require_once('auth.php'); 
$username=$_SESSION['SESS_MEMBER_ID_'];
$secret = $_POST['subs'];//admission numbers
$marks = $_POST['ads'];//marks
$bkno = $_POST['bksno'];//marks
$duedate = $_POST['ddate'];//marks

$year=$_POST['yr'];
$term=$_POST['term'];
$form = $_POST['form'];
$subject=$_POST['subject'];
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
$bno=explode(',',$bkno);
$duedates=explode(',',$duedate);

$date=date("Y-m-d");
for ($i=0;$i<count($ar);$i++){
	$score=$mks[$i];
	$final=$score;
	$bnos=$bno[$i];
	$dueDate=$duedates[$i];

	if($bnos=="" && $dueDate==""){
	//do not insert record
	}else{
		$act="insert into issued_books (userid,bookid,bookno,dateissued,datedue,issuer) 	values('$ar[$i]','$final','$bnos','$date','$dueDate','$username') on duplicate key update bookno='$bnos' ";
		$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}
	}
 	
	
 }// end of for loop
  echo "<script language=javascript> alert('Record has been saved');</script>";
  echo "<script language=javascript> window.location='library_recordissued_book.php';</script>";

?>