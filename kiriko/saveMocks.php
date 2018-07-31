<?php
require_once('auth.php');
$secret = $_POST['subs'];//admission numbers
$marks = $_POST['ads'];//marks

$year=$_POST['yr'];
$term=$_POST['term'];
$form = $_POST['form'];
$subject=$_POST['subject'];
$strm=$_POST['stream'];
$paper=$_POST['paper'];

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

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Recorded Mock Marks ".$myform." ".$year." ".$term." ".$subject;
$func->addAuditTrail($activity,$username);

include('includes/dbconnector.php');

$ar=explode(',',$secret);
$mks=explode(',',$marks);

//$catoneout=30;
$getout = @mysql_query("select * from mocks where subject='$subject'  and term='$term' and year='$year' and form='$form'");
while ($rowc1 = mysql_fetch_array($getout)) {
$paper1=$rowc1['p1'];
$paper2=$rowc1['p2'];
$paper3=$rowc1['p3'];

}




if($paper==1){
$sub=$subject.$paper;
for ($i=0;$i<count($ar);$i++){
$score=$mks[$i];



$act="insert into mockexams 
	(admno,$sub,year,term,form) 	
	values('$ar[$i]','$score','$year','$term','$form') 
	on duplicate key update $sub='$score'";
 	$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}else{
		$qw="insert into tbleperformancetrackmock (admno,year,term,form,stream) values('$ar[$i]','$year','$term','$form','$strm') on duplicate key update term='$term' ";
	
	mysql_query($qw);
	}
  }
   $tostatus="insert into examstatus (year,term,form,stream,subject,examtype,s_status) values('$year','$term','$form','$strm','$subject','Mock','Recorded')";
	$tostatusRe=mysql_query($tostatus);
  
	if(!$tostatusRe){
	echo"failed". mysql_error();
	}else{
	
  echo "<script language=javascript> alert('Marks Have been Added');</script>";
  echo "<script language=javascript> window.location='marks_record.php';</script>";
 }
} 
if($paper==2){
$sub=$subject.$paper;
for ($i=0;$i<count($ar);$i++){
$score=$mks[$i];


$act="insert into mockexams 
	(admno,$sub,year,term,form) 	
	values('$ar[$i]','$score','$year','$term','$form') 
	on duplicate key update $sub='$score'";
 	$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}else{
		$qw="insert into tbleperformancetrackmock (admno,year,term,form,stream) values('$ar[$i]','$year','$term','$form','$strm') on duplicate key update term='$term' ";
	
	mysql_query($qw);
	}
  }
  echo "<script language=javascript> alert('Marks Have been Added');</script>";
  echo "<script language=javascript> window.location='marks_record.php';</script>";
  $tostatus="insert into examstatus 
	(year,term,form,stream,subject,examtype,s_status) 	
	values('$year','$term','$form','$strm','$subject','Mock','Recorded') ";
	$tostatusRe=mysql_query($tostatus);
  
	if(!$tostatusRe){
	echo"failed". mysql_error();
	}
} 
if($paper==3){
$sub=$subject.$paper;
for ($i=0;$i<count($ar);$i++){
$score=$mks[$i];
//$final=($score/$paper3)*$examstandard;


$act="insert into mockexams 
	(admno,$sub,year,term,form) 	
	values('$ar[$i]','$score','$year','$term','$form') 
	on duplicate key update $sub='$score'";
 	$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}else{
		$qw="insert into tbleperformancetrackmock (admno,year,term,form,stream) values('$ar[$i]','$year','$term','$form','$strm') on duplicate key update term='$term' ";
	
	mysql_query($qw);
	}
  }
  echo "<script language=javascript> alert('Marks Have been Added');</script>";
  echo "<script language=javascript> window.location='marks_record.php';</script>";
  
  $tostatus="insert into examstatus 
	(year,term,form,stream,subject,examtype,s_status) 	
	values('$year','$term','$form','$strm','$subject','Mock','Recorded') ";
	$tostatusRe=mysql_query($tostatus);
  
	if(!$tostatusRe){
	echo"failed". mysql_error();
	}
} 


?>