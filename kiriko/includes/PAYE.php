<?php
include('dbconnector.php');
class PAYECalculator{

function PAYECalculator() {
}

function getHCode(){
$date=date("Y-m-d H:i:s");
		 $y=date("Y");
		 $m=date("m");
		 $d=date("d");
		 $hr=date("H");
		 $min=date("i");
		$sec=date("s");
		$hcodes=$y.$m.$d.$hr;
			$mins=$min.$sec;
	
			$hcode=$hcodes.$mins;
			
			
			return $hcode;

}
  function getPAYE($payecode,$taxablepay){
  $paye=0;
  
  $paye1=0;
  $paye2=0;
  $paye3=0;
  $paye4=0;
  $paye5=0;
  if($taxablepay==0){
   $paye=0;
   }
   if($payecode=="Old"){
   if($taxablepay<10164){
		$paye1=($taxablepay*(10/100));
		  return $paye1;
	}
 	if($taxablepay>10164){
		$paye1=(10164*(10/100));
	}
	
	if($taxablepay-10164>0 && ($taxablepay-10164)>9576){
		$paye2=(9576*(15/100));
	}else{
		$paye2=($taxablepay-10164)*(15/100);
	}
	
	if(($taxablepay-10164-9576)>0 && ($taxablepay-10164-9576)>9576){
		$paye3=(9576*(20/100));
	}else{
		$paye3=($taxablepay-10164-9576)*(20/100);
	}
	
	if(($taxablepay-10164-9576-9576)>0 && ($taxablepay-10164-9576-9576)>9576){
		$paye4=(9576*(25/100));
	}else{
		$paye4=($taxablepay-10164-9576-9576)*(25/100);
	}
	
	if(($taxablepay-10164-9576-9576-9576)>0){
		$paye5=($taxablepay-10164-9576-9576-9576)*(30/100);
	}
	
	/*echo "paye1=".$paye1."<br/>";
	echo "paye2=".$paye2."<br/>";
	echo "paye3=".$paye3."<br/>";
	echo "paye4=".$paye4."<br/>";
	echo "paye5=".$paye5."<br/>---------------<br/>";*/
	if($paye1>0){
	$paye1=$paye1;
	}else{
	$paye1=0;
	}
	if($paye2>0){
	$paye2=$paye2;
	}else{
	$paye2=0;
	}
	if($paye3>0){
	$paye3=$paye3;
	}else{
	$paye3=0;
	}
	if($paye4>0){
	$paye4=$paye4;
	}else{
	$paye4=0;
	}
	if($paye5>0){
	$paye5=$paye5;
	}else{
	$paye5=0;
	}
	$paye=$paye1+$paye2+$paye3+$paye4+$paye5;

   }else{
	   /*=====================NEW PAYE RATES 2017=========================*/
	if($taxablepay<11180){
		$paye1=($taxablepay*(10/100));
		  return $paye1;
	}
 	if($taxablepay>11180){
		$paye1=(11180*(10/100));
	}
	
	if($taxablepay-11181>0 && ($taxablepay-11180)>10534){
		$paye2=(10534*(15/100));
	}else{
		$paye2=($taxablepay-11180)*(15/100);
	}
	
	if(($taxablepay-11180-10534)>0 && ($taxablepay-11180-10534)>10534){
		$paye3=(10534*(20/100));
	}else{
		$paye3=($taxablepay-11180-10534)*(20/100);
	}
	
	if(($taxablepay-11180-10534-10534)>0 && ($taxablepay-11180-10534-10534)>10534){
		$paye4=(10534*(25/100));
	}else{
		$paye4=($taxablepay-11180-10534-10534)*(25/100);
	}
	
	if(($taxablepay-11180-10534-10534-10534)>0){
		$paye5=($taxablepay-11180-10534-10534-10534)*(30/100);
	}

	/*echo "taxablepay=".$taxablepay."<br/>";
	echo "paye1=".$paye1."<br/>";
	echo "paye2=".$paye2."<br/>";
	echo "paye3=".$paye3."<br/>";
	echo "paye4=".$paye4."<br/>";
	echo "paye5=".$paye5."<br/>---------------<br/>";*/
	if($paye1>0){
	$paye1=$paye1;
	}else{
	$paye1=0;
	}
	if($paye2>0){
	$paye2=$paye2;
	}else{
	$paye2=0;
	}
	if($paye3>0){
	$paye3=$paye3;
	}else{
	$paye3=0;
	}
	if($paye4>0){
	$paye4=$paye4;
	}else{
	$paye4=0;
	}
	if($paye5>0){
	$paye5=$paye5;
	}else{
	$paye5=0;
	}
	$paye=$paye1+$paye2+$paye3+$paye4+$paye5;
	
	/*echo "total=".$paye;*/
   }
    return $paye;
   }
   
  function getNSSF($basic){
  $nssf=0;
 
  $resultg = mysql_query("select * from tbl_hr_nssf");
	while ($rowg= mysql_fetch_array($resultg)) {
		$mine = $rowg['minv'];
		$maxe = $rowg['maxv'];
		$amount = $rowg['amount'];
		$percent= $rowg['percent'];
		
		if ($basic >= $mine && $basic <=$maxe) {
		
			if($basic>$amount && $amount!=0){
			$basic=$amount;
			}
			
			$nssf=($percent/100)*$basic;
		}
		
	}

		return $nssf;
   
   }
   
   function getNSSFOld($basic){
  $nssf=0;
 
  $resultg = mysql_query("select * from tbl_hr_nssf_old");
	while ($rowg= mysql_fetch_array($resultg)) {
		$mine = $rowg['minv'];
		$maxe = $rowg['maxv'];
		$amount = $rowg['amount'];
		$percent= $rowg['percent'];
		
		if ($basic >= $mine && $basic <=$maxe) {
		
			if($basic>$amount && $amount!=0){
			$basic=$amount;
			}
			
			$nssf=$amount;
		}
		
	}

		return $nssf;
   
   }
   
   
   function getNHIF($basic){
   $nhif=0;
  
   $result = mysql_query("select * from tbl_hr_nhif");
  	while($row = mysql_fetch_array($result)){
  		$mine = $row['minv'];
		$maxe = $row['maxv'];
		$amount = $row['amount'];
		
		if ($basic >= $mine && $basic <=$maxe) {
		$nhif=$amount;
		}
 	 }
 
   return $nhif;
   }
    function getNHIFOld($basic){
   $nhif=0;
  
   $result = mysql_query("select * from tbl_hr_nhif_old");
  	while($row = mysql_fetch_array($result)){
  		$mine = $row['minv'];
		$maxe = $row['maxv'];
		$amount = $row['amount'];
		
		if ($basic >= $mine && $basic <=$maxe) {
		$nhif=$amount;
		}
 	 }
 
   return $nhif;
   }
   
 function getPTR(){
 $ptr=0;
 $result = mysql_query("select * from tbl_hr_reliefs where name='Income-Tax-Personal-Relief'");
  while($row = mysql_fetch_array($result)){
  	$ptr=$row['amount'];
  }
  
  return $ptr;
 
 }
 
 
 
 function saveSlipDetails($staff_ref,$basic,$nhif,$nssf,$paye,$netpay,$date_ref,$month_ref,$payrollref){
 
 $query="insert into tbl_hr_payslips (staff_ref,basic,nhif,nssf,paye,netpay,date_ref,month_ref,payrollref) 
	values('$staff_ref','$basic','$nhif','$nssf','$paye','$netpay','$date_ref','$month_ref','$payrollref') 
	on duplicate key update basic='$basic',nhif='$nhif',nssf='$nssf',paye='$paye',netpay='$netpay',date_ref='$date_ref',payrollref='$payrollref'";
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
 }
   
   function saveSlipAllowances($staff_ref,$allowref,$allow,$month_ref,$payrollref){
   
   $query="insert into tbl_hr_payslips_all (staff_ref,allowance_name,allowance,month_ref,payrollref) 
	values('$staff_ref','$allowref','$allow','$month_ref','$payrollref') 
	on duplicate key update allowance_name='$allowref', allowance='$allow',payrollref='$payrollref'";
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
	}
	
	function saveSlipDeductions($staff_ref,$dedref,$ded,$month_ref,$payrollref){
   
   $query="insert into tbl_hr_payslips_ded (staff_ref,deduction_name,deduction,month_ref,payrollref) 
	values('$staff_ref','$dedref','$ded','$month_ref','$payrollref') 
	on duplicate key update deduction_name='$dedref', deduction='$ded',payrollref='$payrollref'";
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
   }
 
function saveSlipReliefs($staff_ref,$allowref,$allow,$month_ref,$payrollref){
   
   $query="insert into tbl_hr_payslips_reliefs (staff_ref,relief_name,relief,month_ref,payrollref) 
	values('$staff_ref','$allowref','$allow','$month_ref','$payrollref') 
	on duplicate key update relief_name='$allowref', relief='$allow',payrollref='$payrollref'";
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
	} 
   
}// end of class DAO

?>
