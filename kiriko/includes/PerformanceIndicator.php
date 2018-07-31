<?php
include('dbconnector.php');
class PI{

function PI() {
}
   

function getKCPEMARKS($admno){
$kcpemarks=0;
$getkcpe="select marks from studentdetails where admno='$admno'";
			
			$resultkcpe= mysql_query($getkcpe);
			while ($rowk = mysql_fetch_array($resultkcpe)){
				$kcpemarks=$rowk['marks'];
			}

return $kcpemarks;
}

 function getPI($form,$term,$stream,$year,$exam){
if($form==1 && $term==1){
	$pfrm="1";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==1 && $term==2){
	$pfrm="1";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==1 && $term==3){
	$pfrm="1";
	$ptrm="2";
	$pyr=($year);
	}
	
	
	if($form==2 && $term==1){
	$pfrm="1";
	$ptrm="3";
	$pyr=$year-1;
	}
	if($form==2 && $term==2){
	$pfrm="2";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==2 && $term==3){
	$pfrm="2";
	$ptrm="2";
	$pyr=($year);
	}
	
	if($form==3 && $term==1){
	$pfrm="2";
	$ptrm="3";
	$pyr=$year-1;
	}
	if($form==3 && $term==2){
	$pfrm="3";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==3 && $term==3){
	$pfrm="3";
	$ptrm="2";
	$pyr=$year;
	}
	
	if($form==4 && $term==1){
	$pfrm="3";
	$ptrm="3";
	$pyr=$year-1;
	}
	if($form==4 && $term==2){
	$pfrm="4";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==4 && $term==3){
	$pfrm="4";
	$ptrm="2";
	$pyr=$year;
	}
	
	
	if($stream=="Entire"){
		$getadm="select * from tbleperformancetrack where term='$term' and year='$year' and form='$form'";
	}else{
		$getadm="select * from tbleperformancetrack where term='$term' and year='$year' and form='$form' and stream='$stream'";
	}	
	//mysql_query("delete from totalperformanceindex");
	$resultadm = mysql_query($getadm);
	while ($rowad = mysql_fetch_array($resultadm)){
		$admno=$rowad['admno'];
		//$names=$rowad['names'];
		
	if($exam==1 || $exam==2 || $exam==1-2){
	$getgrades="select * from totalygradedmidterm where term='$term' and year='$year' and form='$form' and adm='$admno'";
	
	$getpgrades="select * from totalygradedmidterm where term='$ptrm' and year='$pyr' and form='$pfrm' and adm='$admno'";
	}else{	
	$getgrades="select * from totalygradedmarks where term='$term' and year='$year' and form='$form' and adm='$admno'";
	$getpgrades="select * from totalygradedmarks where term='$ptrm' and year='$pyr' and form='$pfrm' and adm='$admno'";
		
	}		
			$resultgrades = mysql_query($getgrades);
			$currentmss=0.00;
			$currentavg=0.00;
			$names="";
			
			while ($rowg = mysql_fetch_array($resultgrades)){
				$currentmss=$rowg['averagepoints'];
				$currentavg=$rowg['average'];
				$names=$rowg['names'];
			}
			
			
			
			$resultpgrades = mysql_query($getpgrades);
			$sys_count=mysql_num_rows($resultpgrades);
			if($sys_count<1){
			$getpgrades="select * from totalygradedmockmarks where term='$ptrm' and year='$pyr' and form='$pfrm' and adm='$admno'";
			$resultpgrades = mysql_query($getpgrades);
			}else{
			$getpgrades="select * from totalygradedmarks where term='$ptrm' and year='$pyr' and form='$pfrm' and adm='$admno'";
			$resultpgrades = mysql_query($getpgrades);
			}
			
			
			$previousmss=0.00;
			$previousavg=0.00;
			while ($rowpg = mysql_fetch_array($resultpgrades)){
				$previousmss=$rowpg['averagepoints'];
				$previousavg=$rowpg['average'];
				$names=$rowpg['names'];
			}
			$kcpe=$this->getKCPEMARKS($admno);
			$kcpemean=($kcpe/5);
			
			//echo $currentmss." -".$previousmss."<br/>";
			$pi=($currentmss-$previousmss);
			$vap=($currentavg-$kcpemean);
		//insert to a table for better query
	
		$insert="insert into totalperformanceindex (adm,names,kcpemean,vap,previous,current,pindex,term,year,form,classin,exam) values ('$admno','$names','$kcpemean','$vap','$previousmss','$currentmss','$pi','$term','$year','$form','$stream','$exam') on duplicate key update previous='$previousmss', kcpemean='$kcpemean',vap='$vap', current='$currentmss', pindex='$pi'";
		$querynow=mysql_query($insert);
		if(!$querynow){
		echo"failed". mysql_error();
		}
	}

 }


 function getPICluster($form,$term,$stream,$year){
if($form==1 && $term==1){
	$pfrm="1";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==1 && $term==2){
	$pfrm="1";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==1 && $term==3){
	$pfrm="1";
	$ptrm="2";
	$pyr=($year);
	}
	
	
	if($form==2 && $term==1){
	$pfrm="1";
	$ptrm="3";
	$pyr=$year-1;
	}
	if($form==2 && $term==2){
	$pfrm="2";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==2 && $term==3){
	$pfrm="2";
	$ptrm="2";
	$pyr=($year);
	}
	
	if($form==3 && $term==1){
	$pfrm="2";
	$ptrm="3";
	$pyr=$year-1;
	}
	if($form==3 && $term==2){
	$pfrm="3";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==3 && $term==3){
	$pfrm="3";
	$ptrm="2";
	$pyr=$year;
	}
	
	if($form==4 && $term==1){
	$pfrm="3";
	$ptrm="3";
	$pyr=$year-1;
	}
	if($form==4 && $term==2){
	$pfrm="4";
	$ptrm="1";
	$pyr=$year;
	}
	if($form==4 && $term==3){
	$pfrm="4";
	$ptrm="2";
	$pyr=$year;
	}
	
	
	if($stream=="Entire"){
		$getadm="select * from tbleperformancetrackmock where term='$term' and year='$year' and form='$form'";
	}else{
		$getadm="select * from tbleperformancetrackmock where term='$term' and year='$year' and form='$form' and stream='$stream'";
	}	
	//mysql_query("delete from totalperformanceindex");
	$resultadm = mysql_query($getadm);
	while ($rowad = mysql_fetch_array($resultadm)){
		$admno=$rowad['admno'];
		//$names=$rowad['names'];
		
		
	$getgrades="select * from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and adm='$admno'";
	
	$getpgrades="select * from totalygradedmockmarks where term='$ptrm' and year='$pyr' and form='$pfrm' and adm='$admno'";
			
			$resultgrades = mysql_query($getgrades);
			$currentmss=0.00;
			while ($rowg = mysql_fetch_array($resultgrades)){
				$currentmss=$rowg['averagepoints'];
				$names=$rowg['names'];
			}
			
			$resultpgrades = mysql_query($getpgrades);
			$previousmss=0.00;
			while ($rowpg = mysql_fetch_array($resultpgrades)){
				$previousmss=$rowpg['averagepoints'];
				$names=$rowpg['names'];
			}
			
			$kcpe=$this->getKCPEMARKS($admno);
			$kcpemean=($kcpe/5);
			
			$pi=($currentmss-$previousmss);
			$vap=($currentmss-$kcpemean);
		//insert to a table for better query
	
		$insert="insert into totalmockperformanceindex (adm,names,kcpemean,vap,previous,current,pindex,term,year,form,classin) values ('$admno','$names','$kcpemean','$vap','$previousmss','$currentmss','$pi','$term','$year','$form','$stream') on duplicate key update previous='$previousmss', kcpemean='$kcpemean',vap='$vap', current='$currentmss', pindex='$pi'";
		$querynow=mysql_query($insert);
		if(!$querynow){
		echo"failed". mysql_error();
		}
	}

 }

 
 //end of class PI
}
?>
