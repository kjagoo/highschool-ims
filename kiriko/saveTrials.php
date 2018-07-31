<?php
$secret = $_POST['subs'];//admission numbers
$marks = $_POST['ads'];//marks

$year=$_POST['yr'];
$term=$_POST['term'];
$form = $_POST['form'];
$cat=$_POST['cat'];
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

$catoneout=50;
$getCat1out = mysql_query("select outof from catoutof where subject='$subject' and cat=1 and term='$term' and year='$year' and form='$form'");
while ($rowc1 = mysql_fetch_array($getCat1out)) {
$catoneout=$rowc1['outof'];
}
$cattwoout=50;
$getCat2out = mysql_query("select outof from catoutof where subject='$subject' and cat=2 and term='$term' and year='$year' and form='$form'");
while ($rowc21 = mysql_fetch_array($getCat2out)) {
$cattwoout=$rowc21['outof'];
}
$examout=100;
$getExamout = mysql_query("select outof from examoutof where subject='$subject' and years='$year' and form='$form'");
if(!$getExamout){
	echo "Error ".mysql_errno();
}else{
while ($roweof = mysql_fetch_array($getExamout)) {
$examout=$roweof['outof'];
}
}

$getExamstandard = mysql_query("select * from standards where year='$year' and term='$term' and form='$form'");
while ($rows = mysql_fetch_array($getExamstandard)) {
$examstandard=$rows['exam'];
$cat1standard=$rows['cat1'];
$cat2standard=$rows['cat2'];
}

if($cat=='exams'){
for ($i=0;$i<count($ar);$i++){
$score=$mks[$i];
$final=($score/$examout)*$examstandard;

/**************** CHECK IF THERE EXISTS MARKS FOR THIS TERM SUBJECT ***********************************************/
	$examStatus=" ";
	$check=mysql_query("select * from examstatus where form='$form' and term='$term' and year='$year' and subject='$subject' and examtype='exams' and stream='$strm'");
	while ($rowst = mysql_fetch_array($check)) {
	$examStatus=$rowst['status'];
	}// end of while status
	//$rowcount=mysql_num_rows($check);
	if($examStatus=="Recorded"){
	echo "<script language=javascript> alert('These Marks have already been Added Please Go to Manage Marks to Edit');</script>";
  	echo "<script language=javascript> window.location='marks_record.php';</script>";
	}else{

$act="insert into marksemams 
	(admno,$subject,year,term,form) 	
	values('$ar[$i]','$final','$year','$term','$form') on duplicate key update $subject='$final' ";
 	$resultin=mysql_query($act); 
	
	 
	
	if(!$resultin){
	echo"failed". mysql_error();
	}else{
	$qw="insert into tbleperformancetrack (admno,year,term,form,stream) values('$ar[$i]','$year','$term','$form','$strm') on duplicate key update term='$term' ";
	
	mysql_query($qw);
	}
	
	
	}//end of else check
  }
  echo "<script language=javascript> alert('Marks Have been Added');</script>";
  echo "<script language=javascript> window.location='marks_record.php';</script>";

	$tostatus="insert into examstatus 
	(year,term,form,,stream,subject,examtype,status) 	
	values('$year','$term','$form','$strm','$subject','exams','Recorded') ";
	$tostatusRe=mysql_query($tostatus);
  
	if(!$tostatusRe){
	echo"failed". mysql_error();
	}
}else{
for ($i=0;$i<count($ar);$i++){
if($cat==1){
$score=$mks[$i];
$final=($score/$catoneout)*$cat1standard;
}
if($cat==2){
$score=$mks[$i];
$final=($score/$cattwoout)*$cat2standard;

}
	$examStatus=" ";
	$check=mysql_query("select * from examstatus where form='$form' and term='$term' and year='$year' and subject='$subject' and examtype='$cat' and stream='$strm'");
	while ($rowst = mysql_fetch_array($check)) {
	$examStatus=$rowst['s_status'];
	}// end of while status
	//$rowcount=mysql_num_rows($check);
	if($examStatus=="Recorded"){
	echo "<script language=javascript> alert('These Marks have already been Added Please Go to Manage Marks to Edit');</script>";
  	echo "<script language=javascript> window.location='marks_record.php';</script>";
	}else{

	$act="insert into markscats 
	(admno,$subject,year,term,form,cat) 	
	values('$ar[$i]','$final','$year','$term','$form','$cat') on duplicate key update $subject='$final' ";
	
	
 	$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}else{
	$qw="insert into tbleperformancetrack (admno,year,term,form,stream) values('$ar[$i]','$year','$term','$form','$strm') on duplicate key update term='$term' ";
	
	mysql_query($qw);
	}
	}//end of check
	
  }
  echo "<script language=javascript> alert('Cat Marks Have been Added');</script>";
  echo "<script language=javascript> window.location='marks_record.php';</script>";

	$tostatus="insert into examstatus 
	(year,term,form,stream,subject,examtype,s_status) 	
	values('$year','$term','$form','$strm','$subject','$cat','Recorded') ";
	$tostatusRe=mysql_query($tostatus); 
}
?>