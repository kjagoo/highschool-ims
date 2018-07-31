<?php
include('dbconnector.php');
class BalanceSheet{

function BalanceSheet() {
}
   

function getCash($year){
 	$cash=0.0;
	
	
 return $cash;
} 


function getInventory($year){

	$inventory=0;
	
	
	return $inventory;
}


/*
*This includes bank deposits, fees payable via bank slips or cheques
*/
function getReceivables($year){
	$receivables=0;
	
	
	return $receivables;
}

function getTotalAssets($year){
	$total=0;
	
	$total+= $this->getReceivables($year)+$this->getInventory($year)+$this->getCash($year);
	
	return  number_format($total,2);
}

//********************* Liabilities *********************************/
/*
*This is the amount you owe to others, unpaid invoices, unpaid LPO
*/
function getAccountsPayables(){
	$acc_payables=0;
	$sql="SELECT SUM(amount_due) AS due FROM tbl_invoices where i_status='0'";

	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
	$acc_payables=$row['due'];
	}
	
	return $acc_payables;
}

function getSalariesPayables($year,$month){
	$sal_payables=0;
	$sql="SELECT SUM(netpay) AS net FROM tbl_hr_payslips 
WHERE  YEAR(CAST(date_ref AS DATE))=$year AND MONTH(date_ref )=$month";

	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
	$sal_payables=$row['net'];
	}
	
	return $sal_payables;
}

/*
*This includes NHIF, NSSF among others
*/
function getInterestsPayables($year,$month){
	$int_payables=0;
	$sql="SELECT SUM(nhif) AS nhif, SUM(nssf) as nssf  FROM tbl_hr_payslips 
WHERE  YEAR(CAST(date_ref AS DATE))=$year AND MONTH(date_ref )=$month";

	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
	$int_payables=$row['nhif']+$row['nssf'];
	}
	
	return $int_payables;
}
/*
*This includes PAYE among others
*/
function getTaxesPayables($year,$month){
	$taxes_payables=0;
	$sql="SELECT SUM(paye) AS paye FROM tbl_hr_payslips 
WHERE  YEAR(CAST(date_ref AS DATE))=$year AND MONTH(date_ref )=$month";

	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
	$taxes_payables=$row['paye'];
	}
	
	return $taxes_payables;
}

function getTotalLiabilities($year,$month){
	$total=0;
	
	$total+= $this->getTaxesPayables($year,$month)+$this->getInterestsPayables($year,$month)+$this->getSalariesPayables($year,$month)+$this->getAccountsPayables($year);
	
	return  number_format($total,2);
}




 
 //end of class Grading
}
?>
