<?php
include('dbconnector.php');
class Financials{

function Financials() {
}


  function getOpenFiscalYear(){
  $rowscount=0;
  $result = mysql_query("select * from finance_fiscalyr where status='OPEN'") or die(mysql_error());
	$rowscount=mysql_num_rows($result);
 
    return ($rowscount);
   }
   
   function getFiscalYear(){
	 $result = mysql_query("SELECT fiscal_year FROM finance_fiscalyr where status='OPEN'");
	 $year="";
		 $row = mysql_fetch_array($result);
		 $year=$row['fiscal_year'];
		
	return $year;
   }
   
   function checkPrintedEstimates(){
  $rowscount=0;
  $result = mysql_query("select * from finance_estimates where fiscal_yr='".$this->getFiscalYear()."'") or die(mysql_error());
	$rowscount=mysql_num_rows($result);
 
    return ($rowscount);
   }
   
  function checkFees(){
  $rowscount=0;
  $result = mysql_query("select * from finance_fees where fiscal_yr='".$this->getFiscalYear()."'") or die(mysql_error());
	$rowscount=mysql_num_rows($result);
 
    return ($rowscount);
   }
   
 function getBudget($votehead,$year){
   $estimate=0;
   $result = mysql_query("SELECT amount FROM finance_estimates where votehead='$votehead' and fiscal_yr='$year'");
   while($row=mysql_fetch_array($result)){
    $estimate=$row['amount'];
   }
   return $estimate;
 }
  function getEstimateProjection($votehead,$year,$form,$payable){
   $projection=0;
   $students=0;
   $result = mysql_query("SELECT count(admno) as totalstudents FROM studentdetails where form='$form'");
   $row=mysql_fetch_array($result);
    $students=$row['totalstudents'];
	
	$projection=($students*$payable);
  
   return $projection;
  }
   
function getPayableFees($form,$term,$year){
$payable=0;
 $sql="select COALESCE(sum(amount),0) as total from finance_fees where fiscal_yr='$year' and term='$term' and form='$form'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $payable=$row['total'];

	return $payable;
}
function getPayableFeesPerform($form,$year){
$payable=0;
 $sql="select COALESCE(sum(amount),0) as total from finance_fees where fiscal_yr='$year'  and form='$form'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $payable=$row['total'];

	return $payable;
}


function getFeesPaidByForm($form,$year){
$paidfees=0;

 $sql="SELECT COALESCE(SUM(ff.total_amount),0) AS total FROM finance_feestructures AS ff JOIN studentdetails s ON ff.`admno` =s.`admno` AND ff.year='$year' and s.form='$form'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $paidfees=$row['total'];

return $paidfees;
}

function getFessBalancesperClass($form,$year){
$bal=0;

$bal=$this->getPayableFeesPerform($form,$year)-$this->getFeesPaidByForm($form,$year);

return $bal;
}

function getPaidFees($term,$year,$admno){
	$paid=0;
	
	$sql="select sum(votehead_amt) as total from finance_feestructures where year='$year' and term='$term' and admno='$admno'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $paid=$row['total'];

	return $paid;
}
 
 function getPaidFeeByVotehead($year,$votehead,$form){
 
 $paid=0;
	
	$sql="select COALESCE(sum(votehead_amt),0) as total from finance_feestructures as ff
inner join studentdetails sd on ff.admno=sd.admno and 
ff.year='$year' and ff.votehead='$votehead' and sd.form='$form'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $paid=$row['total'];

	return $paid;
	
 }  

function getVoteheadCodesCreateTable($term,$year){
	$result = mysql_query("select distinct(votehead) from finance_voteheads where fiscal_year='".$this->getFiscalYear()."' order by votehead asc");
	$rowscounts=mysql_num_rows($result);
	
	if($rowscounts==1 || $rowscounts>1){
	$sq1 ="CREATE TABLE IF NOT EXISTS feeregisterreport_".$year."_".str_replace(" ","_",$term)."(admno varchar(100) NOT NULL,receipt_no varchar(100) NOT NULL,";
	while($row = mysql_fetch_array($result)){
		$sq=$row['votehead']." decimal(18,2) not null,";
		
		$sq1=$sq1.$sq;
	}
	
 	$sl2= "term varchar(100) NOT NULL, year varchar(100) NOT NULL, PRIMARY KEY  (admno,receipt_no,term,year) )";
	
	$sql=$sq1.$sl2;
	 //mysql_query("drop table if exists feeregisterreport_".$year."_".str_replace(" ","_",$term));
	 mysql_query($sql)or die(mysql_error());
	}
	

}  

  
function getRegisterVotehead($year,$term,$votehead,$code){
	$sql="select * from finance_feestructures where votehead='$votehead' and year='$year' and term='$term' order by votehead asc";
	$result = mysql_query($sql);
	while ($row_curr = mysql_fetch_array($result)) {
		$admno=$row_curr['admno'];
		$amount=$row_curr['votehead_amt'];
		$receipt=$row_curr['receipt_no'];
	$act="insert into feeregisterreport_".$year."_".str_replace(" ","_",$term)." (admno,receipt_no,$votehead,year,term) values('$admno','$receipt','$amount','$year','$term') on duplicate key update $votehead='$amount'";
 		$resultin=mysql_query($act); 
		
		if(!$resultin){
			echo"failed". mysql_error()."<BR/>";
		}
	 }	
} 
   
   
   function getVoteheadTotals($year,$term,$votehead){
   $total=0;
   $sql="select sum(votehead_amt) as total from finance_feestructures where term='$term' and year='$year' and votehead='$votehead';";
	$result = mysql_query($sql);
	$row_curr = mysql_fetch_array($result);
	 $total=$row_curr['total'];
   
   return $total;
   }
  
   
 /*
  *Return All income collected this year and month
  */    
 function getDebit($year,$month) {
 $debit=0; 
 $sql="select CAST(sum(votehead_amt) as DECIMAL) as totals from finance_feestructures where year='$year' and MONTH(dateofpay)='$month'";
 $result = mysql_query($sql);
	while ($row_curr = mysql_fetch_array($result)) {
	 $debit=$row_curr['totals'];
	}
   
   return $debit;
 } 
   
  /*
  *Return All expenses inccured this year and month
  */ 
  function getCredit($year,$month) { 
   $credit=0; 
   
   
   
   
   return $credit;
  }
  /*
  *Return All unpaid debts this year and month
  */ 
  function getPayables($year,$month) { 
   $payable=0.00; 
   
    $sql="select CAST(sum(rii.price) as DECIMAL) as totals from received_invoice_items as rii inner join received_invoices ri on ri.invoice_ref=rii.invoice_ref and YEAR(ri.received_date)='$year' and MONTH(ri.received_date)='$month'";
 $result = mysql_query($sql);
	while ($row_curr = mysql_fetch_array($result)) {
	 $payable=$row_curr['totals'];
   
	}
   
   return $payable;
  }
 

  
  
   
}// end of class DAO

?>
