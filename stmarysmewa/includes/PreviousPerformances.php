<?php
include('dbconnector.php');
class PreviousPerformances{

function PreviousPerformances() {
}
   

function getGraphMeans($admno,$form,$term){
 	$mean=0.0;
	$form1mean=mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'and form='$form' and term='$term'");
	while ($rowf1m = mysql_fetch_array($form1mean)) {// get admno
	$mean=$rowf1m['averagepoints'];
	}
 return $mean;
} 


function getPositioning($form,$term,$admno){

	$position="-";
	$f1t1pos=mysql_query("Select position from positions where  form='$form' and term='$term' and admno='$admno'");
	while ($rowf1t1p = mysql_fetch_array($f1t1pos)) {// get admno
	$position=$rowf1t1p['position'];
	}
	
	return $position;
}


function getPositionOutOf($form,$term,$year){
	$outof="-";
	$f1t1=mysql_query("Select count(admno) as admn  from positions where  form='$form' and term='$term' and year='$year'");
	while ($rowf1t1 = mysql_fetch_array($f1t1)) {// get admno
	$outof=$rowf1t1['admn'];
	
		if($outof==0){
			$outof="-";
		}
	}
	
	return $outof;
}





 
 //end of class Grading
}
?>
