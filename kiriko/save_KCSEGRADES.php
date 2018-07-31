<?php
$secret = $_POST['subs'];//admission numbers
$marks = $_POST['ads'];//marks

$year=$_POST['yr'];

$subject=$_POST['subject'];



include('includes/dbconnector.php');

$ar=explode(',',$secret);
$mks=explode(',',$marks);


for ($i=0;$i<count($ar);$i++){
$score=$mks[$i];
$final=$score;
	
$act="insert into kcsemarks 
	(index_numbers,$subject,year_finished) 	
	values('$ar[$i]','$final','$year') on duplicate key update $subject='$final' ";
 	$resultin=mysql_query($act); 
	
	 
	
	if(!$resultin){
	echo"failed". mysql_error();
	}
	
	echo "<script language=javascript> alert('grades Have been Added');</script>";
  echo "<script language=javascript> window.location='KCSE_Records.php';</script>";
	}//end of else check

?>