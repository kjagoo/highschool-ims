<?php
include('dbconnector.php');
class SubjectTally{

function SubjectTally() {
}
   

 function getSubjectTally($subjectgrade,$Value,$term,$year,$form,$classdef){
 $tally=array('tally' => '');
 $resultg = mysql_query("select count($subjectgrade) as engas from totalygradedmarks where $subjectgrade='$Value' and term='$term' and year='$year' and form='$form' $classdef");
	while ($rowg= mysql_fetch_array($resultg)) {
		$count = $rowg['engas'];
		$tally['tally']  = $count;
	}
	return   $tally;
 }

 function getSubjectTallyMock($subjectgrade,$Value,$term,$year,$form,$classdef){
 $tally=array('tally' => '');
 $resultg = mysql_query("select count($subjectgrade) as engas from totalygradedmockmarks where $subjectgrade='$Value' and term='$term' and year='$year' and form='$form' $classdef");
	while ($rowg= mysql_fetch_array($resultg)) {
		$count = $rowg['engas'];
		
		$tally['tally']  = $count;
	}
	return   $tally;
 }
 
 
 
 function getGradesPerSubjectEntire($subject,$subjectGrade, $term,$year,$form){
 
 $tally=array();
 $resultg = mysql_query("SELECT $subjectGrade AS grade,COUNT(`adm`)  AS total  FROM totalygradedmarks WHERE  term=$term AND YEAR=$year AND form=$form and $subject > 0 GROUP BY $subjectGrade");
 
  while ($rowg= mysql_fetch_array($resultg)) {
		$graded = $rowg['grade'];
		$counted =$rowg['total'];
		
		$arraytopush=array($graded,$counted);
		array_push ($tally,$arraytopush) ;
		
	}
	return   $tally;
}


function getGradesPerSubject($subject, $subjectGrade, $term,$year,$form,$stream){
 
 $tally=array();
 $resultg = mysql_query("SELECT $subjectGrade AS grade,COUNT(adm)  AS total  FROM totalygradedmarks WHERE  term='$term' AND year='$year' AND form='$form' AND classin = '$stream'  and $subject > 0  GROUP BY $subjectGrade");
 
  while ($rowg= mysql_fetch_array($resultg)) {
		$graded = $rowg['grade'];
		$counted =$rowg['total'];
		
		$arraytopush=array($graded,$counted);
		array_push ($tally,$arraytopush) ;
		
	}
	return   $tally;
}

function getGradesPerSubjectEntireMock($subject,$subjectGrade, $term,$year,$form){
 
 $tally=array();
 $resultg = mysql_query("SELECT $subjectGrade AS grade,COUNT(`adm`)  AS total  FROM totalygradedmockmarks WHERE  term=$term AND YEAR=$year AND form=$form and $subject > 0 GROUP BY $subjectGrade");
 
  while ($rowg= mysql_fetch_array($resultg)) {
		$graded = $rowg['grade'];
		$counted =$rowg['total'];
		
		$arraytopush=array($graded,$counted);
		array_push ($tally,$arraytopush) ;
		
	}
	return   $tally;
}


function getGradesPerSubjectMock($subject, $subjectGrade, $term,$year,$form,$stream){
 
 $tally=array();
 $resultg = mysql_query("SELECT $subjectGrade AS grade,COUNT(adm)  AS total  FROM totalygradedmockmarks WHERE  term='$term' AND year='$year' AND form='$form' AND classin = '$stream'  and $subject > 0  GROUP BY $subjectGrade");
 
  while ($rowg= mysql_fetch_array($resultg)) {
		$graded = $rowg['grade'];
		$counted =$rowg['total'];
		
		$arraytopush=array($graded,$counted);
		array_push ($tally,$arraytopush) ;
		
	}
	return   $tally;
}


function getFinalGrate($engmean){
$efinalgrade = "-";
 if ($engmean > 0 && $engmean <= 1.499) {
			$efinalgrade = "E";
			
			// remarks="Work harder";
		} else if ($engmean >= 1.5 && $engmean <= 2.499) {
			$efinalgrade = "D-";
			// remarks="Improve";
		} else if ($engmean >= 2.5 && $engmean <= 3.499) {
			$efinalgrade = "D";
			// remarks="Improve";
		} else if ($engmean >= 3.5 && $engmean <= 4.499) {
			$efinalgrade = "D+";
			// remarks="Can do better";
		} else if ($engmean >= 4.5 && $engmean <= 5.499) {
			$efinalgrade = "C-";
			// remarks="Fair";
		} else if ($engmean >= 5.5 && $engmean <= 6.499) {
			$efinalgrade = "C";
			// remarks="Fair";
		} else if ($engmean >= 6.5 && $engmean <= 7.499) {
			$efinalgrade = "C+";
			// remarks="Fair";
		} else if ($engmean >= 7.5 && $engmean <= 8.499) {
			$efinalgrade = "B-";
			// remarks="Good";
		} else if ($engmean >= 8.5 && $engmean <= 9.499) {
			$efinalgrade = "B";
			// remarks="Good";
		} else if ($engmean >= 9.5 && $engmean <= 10.499) {
			$efinalgrade = "B+";
			// remarks="Good";
		} else if ($engmean >= 10.5 && $engmean <= 11.499) {
			$efinalgrade = "A-";
			// remarks="V. Good";
		} else if ($engmean >= 11.5 && $engmean <= 12.0) {
			$efinalgrade = "A";
			// remarks="Excellent";
		}else if ($engmean == 0) {
			$efinalgrade = "-";
			
		} 
		
		
		return $efinalgrade;
}




 
 //end of class Grading
}
?>
