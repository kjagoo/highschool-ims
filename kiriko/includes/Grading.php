<?php
include('dbconnector.php');
class Grading{

function Grading() {
}
   

 function getSubjectGrade($subject,$Value,$form){
 $details=array('grade' => '','point' => '','remark' => '');
 $resultg = mysql_query("SELECT * FROM tblgrades where subject='$subject' and form='$form'");
	while ($rowg= mysql_fetch_array($resultg)) {
		$mine = $rowg['minv'];
		$maxe = $rowg['maxv'];
		$grade = $rowg['grade'];
		$remarks= $rowg['remarks'];
		$points= $rowg['points'];
		if ($Value >= $mine && $Value <=$maxe) {
			$grade = $grade;
			$point=$points;
			$remarks=$remarks;
			
			$details['grade']  = $grade;
			$details['point']  = $point;
			$details['remark']  = $remarks;
			
			
		}
	}
	return   $details;
 }
 
 function getSciencesGrade($subject,$Value,$form){
 $details=array('grade' => '','point' => '','remark' => '');
 $resultg = mysql_query("SELECT * FROM tblgrades where subject='$subject' and form='$form'");
	while ($rowg= mysql_fetch_array($resultg)) {
		$mine = $rowg['minv'];
		$maxe = $rowg['maxv'];
		$grade = $rowg['grade'];
		$remarks= $rowg['remarks'];
		$points= $rowg['points'];
		if ($Value >= $mine && $Value <=$maxe) {
			$grade = $grade;
			$point=$points;
			$remarks=$remarks;
			
			$details['grade']  = $grade;
			$details['point']  = $point;
			$details['remark']  = $remarks;
		}
	}
	return   $details;
 }
 

 
 
 
 
 
 function getVAP($form,$term,$admno){
 	$vap="-";
	$getvap=mysql_query("Select vap from totalperformanceindex where form='$form' and term='$term' and adm='$admno'");
	if(mysql_num_rows($getvap)){
	while ($rowvap = mysql_fetch_array($getvap)) {// get admno
	$vap=$rowvap['vap'];
	}
	}else{
	$vap="-";
	}
 
 return $vap;
 }
 
 /**
 * Function that computes subject positions for students
 *
 */
 function getSubjectPosition($subject,$form,$term,$year){
 
  /********************************************************************/
	$pos=0;
	$position=mysql_query("SELECT adm,classin,$subject FROM totalygradedmarks where form='$form' and term='$term' and year='$year' order by $subject desc");
	while ($rowe = mysql_fetch_array($position)) {
	$adms=$rowe['adm'];
	$strm=$rowe['classin'];
	$pos++;
		
	if($subject=="businesStudies"){
	$subject="bstudies";
	}
	if($subject=="mathematics"){
	$subject="math";
	}
		
	$inserte="insert into positions(admno,$subject,form,stream,term,year)
		values('$adms','$pos','$form','$strm','$term','$year') on duplicate key update $subject='$pos'";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	//mysql_query("update positions set $subject='$pos' where admno='$adms' and form='$form' and stream='$strm' and term='$term' and year='$year' ");
		echo"Error!". mysql_error();
		}
	}
	

/********************************************************************/
 
 }
 
 //end of class Grading
}
?>
