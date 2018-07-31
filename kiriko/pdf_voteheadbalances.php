<?php

require('fpdf.php');
include('includes/dbconnector.php');

class PeoplePDF extends FPDF {

//Page header
function Header(){
		$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
		$schoolname=$de['schname'];
		$address=$de['box']." , ".$de['place'];
		//$logref=$de['logref'];
		$tele=$de['telphone'];
		$email=$de['email'];
		$web=$de['website'];
	}
	
	//if(!file_exists("images/".$logref)){
 		 $logo="images/logo.JPG";
  		//}else{
 			//$logo = "images/".$logref;
 	// }
	 
	$year=$_GET['year'];
		$form=$_GET['form'];
		
		
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
		//$hcode=$_GET['hbar'];
 		 $barcode="images/barcode.PNG";
		 
	$this->SetFont('arial', '', 10);
	$this->Image($logo,20,10,20,20);
	$this->Image($barcode,160,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(161, 25, $hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(60, 17, $schoolname);
	$this->Text(60, 22,'P.o.Box  '.$address);
	$this->Text(65, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	$this->Text(60, 35, 'Votehead Balances Report:- Year '.$year ."   ".$form);
  	
    $this->Ln(20);
}
//Page footer
	function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
	
}


function getArrearsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(fb.balance),0) as arrears from finance_balances as fb 
inner join studentdetails sd on fb.admno=sd.admno and fb.updated='$yr' and sd.form='$form' and fb.balance>0");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['arrears'];
 	}

return $arrears;
}

function getPaidArrearsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(ff.votehead_amt),0) as arrears from finance_feestructures as ff 
inner join studentdetails sd on ff.admno=sd.admno and ff.year='$yr' and sd.form='$form' and votehead='Arrears'");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['arrears'];
 	}

return $arrears;
}	


function getOverpaymentsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(fb.balance),0) as overs from finance_balances as fb 
inner join studentdetails sd on fb.admno=sd.admno and fb.updated='$yr' and sd.form='$form' and fb.balance<0");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['overs'];
 	}

return $arrears;
}
function getPaidOverpaymentsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(ff.votehead_amt),0) as overs from finance_feestructures as ff 
inner join studentdetails sd on ff.admno=sd.admno and ff.year='$yr' and sd.form='$form' and votehead='Overpayments'");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['overs'];
 	}

return $arrears;
}	

include 'includes/Finance.php';
	$finacial= new Financials();

$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 

//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(30, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(50, 7, "Votehead", 1, 0, "C", 1);
$pdf->Cell(35, 7, "Expected", 1, 0, "C", 1);
$pdf->Cell(35, 7, "Paid", 1, 0, "C", 1);
$pdf->Cell(35, 7, "Balance", 1, 0, "C", 1);

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 30;
$pdf->setXY($x, $y);
 
	$year=$_GET['year'];
	$form=$_GET['form'];
	
	$sql="select DISTINCT(fv.votehead) from finance_voteheads as fv
inner join finance_fees ff on fv.fiscal_year=ff.fiscal_yr and
fv.fiscal_year='$year' and ff.form='$form' order by fv.votehead asc";
	
	
	
$result = mysql_query($sql);
$num=0;
$totalpayable=0;
$totalpaid=0;
$totalbal=0;
$fill=0;
while($row = mysql_fetch_array($result)){
$num++;
 $debit=$finacial->getPaidFeeByVotehead($year,$row['votehead'],$form);
 $vote=$row['votehead'];
		  $val=0;
		   $resulta = mysql_query("select sum(amount) as amount from finance_fees where votehead='$vote' and form='$form' and fiscal_yr='$year'");
		    while($rowa = mysql_fetch_array($resulta)){ 
			$val=$rowa['amount'];
			}
			
 	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, $num,  1, 0, "L", $fill);
	$pdf->Cell(50, 7, str_replace("&","/",str_replace("_"," ",$row['votehead'])),   1, 0, "L", $fill);
	$pdf->Cell(35, 7, number_format(($finacial->getEstimateProjection($row['votehead'],$year,$form,$val)),2), 1, 0, "R", $fill);
	$pdf->Cell(35, 7, number_format($debit,2), 1, 0, "R", $fill);
	$pdf->Cell(35, 7, number_format((($finacial->getEstimateProjection($row['votehead'],$year,$form,$val))-$debit),2), 1, 0, "R", $fill);
	
	$totalpayable+=($finacial->getEstimateProjection($row['votehead'],$year,$form,$val));
	$totalpaid+=$debit;
	$totalbal+=(($finacial->getEstimateProjection($row['votehead'],$year,$form,$val))-$debit);
	$y += 7;
	$fill=!$fill;
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(30, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(50, 7, "Votehead", 1, 0, "C", 1);
		$pdf->Cell(35, 7, "Expected", 1, 0, "C", 1);
		$pdf->Cell(35, 7, "Paid", 1, 0, "C", 1);
		$pdf->Cell(35, 7, "Balance", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}
$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, ($num+1),  1, 0, "L", $fill);
	$pdf->Cell(50, 7, "Arrears",   1, 0, "L", $fill);
	$pdf->Cell(35, 7, number_format(getArrearsPerForm(($year-1),$form),2), 1, 0, "R", $fill);
	$pdf->Cell(35, 7, number_format(getPaidArrearsPerForm($year,$form),2), 1, 0, "R", $fill);
	$pdf->Cell(35, 7, number_format((getArrearsPerForm(($year-1),$form)-getPaidArrearsPerForm($year,$form)),2), 1, 0, "R", $fill);
	$pdf->Ln();
	$y = $y+7;
	$pdf->setXY($x, $y);
	
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, ($num+1),  1, 0, "L", $fill);
	$pdf->Cell(50, 7, "Overpayments From Last Year",   1, 0, "L", $fill);
	$pdf->Cell(35, 7, "", 1, 0, "R", $fill);
	$pdf->Cell(35, 7, number_format(getPaidOverpaymentsPerForm($year,$form),2), 1, 0, "R", $fill);
	$pdf->Cell(35, 7, "", 1, 0, "R", $fill);
	$pdf->Ln();
	$y = $y+7;
	$pdf->setXY($x, $y);
	
 $pdf->Cell(60, 7, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(35, 7, number_format($totalpayable+getArrearsPerForm(($year-1),$form),2), 1, 0, "R", 0);
  $pdf->Cell(35, 7, number_format(($totalpaid+getPaidArrearsPerForm($year,$form))+getPaidOverpaymentsPerForm($year,$form),2), 1, 0, "R", 0);
 $pdf->Cell(35, 7, number_format(($totalbal+(getArrearsPerForm(($year-1),$form)-getPaidArrearsPerForm($year,$form)))-getPaidOverpaymentsPerForm($year,$form),2), 1, 0, "R", 0);
$pdf->Output();

?>