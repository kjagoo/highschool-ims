<?php
include('dbconnector.php');
class Fees{

function Fees() {
}
function pocketMoneyBal($admno){
	$bal=0;
 $sql="SELECT bal from pocket_money where admno='$admno'";
   $result = mysql_query($sql);
   
  	while($row = mysql_fetch_array($result)){
			$bal=$row['bal'];
	} 
	
				
return ($bal);
}
function getStudentDetail($ref,$admno){
	$detail="";
	
	$sql="SELECT $ref as detail  from studentdetails where admno='$admno'";
   $result = mysql_query($sql);
   if (!$result) {
		echo 'Invalid query: ' . mysql_error();
   		 }else{
  	while($row = mysql_fetch_array($result)){
			$detail=$row['detail'];
	} 
		 }
	
	return $detail;
}
function getInvoiceAmt($year,$term,$admno){
	
	$bal=0;
 $sql="SELECT COALESCE(sum(amount),0) as total from finance_student_invoices where admno='$admno'  and year='$year' and term='$term'";
   $result = mysql_query($sql);
   if(!$result){
	 return mysql_error();  
   }
  	while($row = mysql_fetch_array($result)){
			$bal=$row['total'];
	} 
	
				
return $bal;
}
function getPaidAmt($year,$admno,$term){
	
	$paid=0;
	$total_amount=0;
	
	$sqlr="SELECT distinct(receipt_no) from finance_feestructures where admno='$admno' and year='$year' and term='$term' and statusis='OK'";
	$resultr = mysql_query($sqlr);
		while($rowr = mysql_fetch_array($resultr)){
			$rece=$rowr['receipt_no'];
	
		$sql="SELECT sum(votehead_amt) as total_amount  from finance_feestructures where receipt_no='$rece' and admno='$admno' and year='$year' and term='$term' and statusis='OK'";
		   $result = mysql_query($sql);
			while($row = mysql_fetch_array($result)){
					$total_amount=$row['total_amount'];
			} 
			$paid+=$total_amount;
		}			
return $paid;
}

function getAddedAmt($year,$admno,$term){
	
	$paid=0;
 $sql="SELECT COALESCE(sum(amount),0) as total from finance_added_fees where admno='$admno' and fiscal_year='$year' and term='$term' and votehead not like'%BF%'";
   $result = mysql_query($sql);
   if(!$result){
	 return mysql_error();  
   }
  	while($row = mysql_fetch_array($result)){
			$paid=$row['total'];
	} 	
				
return $paid;
}

 function getBF($year,$admno,$term){
	
	$paid=0;
 $sql="SELECT COALESCE(sum(amount),0) as total from finance_added_fees where admno='$admno' and fiscal_year='$year' and term='$term' and votehead ='BF 2017'";
   $result = mysql_query($sql);
  	while($row = mysql_fetch_array($result)){
			$paid=$row['total'];
	} 	
				
return $paid;
} 
function getVoteheadSum($year,$term,$form){
	
	$paid=0;
 $sql="SELECT COALESCE(sum(amount),0) as total from finance_fees where fiscal_yr='$year' and term='$term' and form ='$form'";
   $result = mysql_query($sql);
  	while($row = mysql_fetch_array($result)){
			$paid=$row['total'];
	} 	
				
return $paid;
} 
   
}// end of class Accounting

?>
