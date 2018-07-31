<?php
//define('FPDF_FONTPATH','font/');
require('fpdf.php');
include('includes/dbconnector.php');
include 'includes/functions.php';
include 'includes/fees.php';
 
if (isset($_GET['form'])) {
$form=$_GET['form'];
$year=$_GET['year'];
}
class PDF extends FPDF
{


//Page header
/*function Header(){
	$details = mysql_query("select * from schoolname");
	mysql_query($details);
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	}
	$date=date("j, F, Y");
	$term='1';
	$year='2013';
	$form='2';
    //Logo
   // $this->Image('logo.jpg',10,2,0,0);
    //Arial bold 15
   // $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
   // $this->Cell(30,10,'Title',1,0,'C');
	$this->SetFont('arial', '', 12);
	$this->Text(75, 10, $schoolname);
	$this->Text(75, 15,'P.o.Box  '.$po.',  '.$plac);
	$this->Text(75, 20,'Telephone:  '.$tele);
	$this->Text(75, 30,'Date:  '.$date);
	$this->Text(75, 38, 'Report Form: Term'.$term.'  Year   '.$year);

	 //image
   // $this->Image('logo.jpg',170,2,0,0);
    //Line break
   // $this->Ln(20);
}*/

//Page footer
/*function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Email:myschoolmyschool.com, Website:myschool.com ',0,0,'C');
}*/
function SetDash($black=false, $white=false)
    {
        if($black and $white)
            $s=sprintf('[%.3f %.3f] 0 d', $black*$this->k, $white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }
}
function getPreviousYrBal($admno,$year){
	
	$bal=0;
 $sql="SELECT  distinct(receipt_no), f.dateofpay, f.modeofpay,f.total_amount  from finance_feestructures f where f.admno='$admno' AND  f.year='$year'  and f.statusis='OK' ORDER BY f.dateofpay asc";
   $result = mysql_query($sql);
   $rowscounts=mysql_num_rows($result);
   $totalb=0;
   $AMT=0;
 if($rowscounts==1 ||$rowscounts>1){
  			while($row = mysql_fetch_array($result)){
			$totalb+=$row['total_amount'];
			
			$bal=($bal-$row['total_amount']);
			
			$AMT=$row['total_amount'];
			
  			}
	}else{
			 
		$bal=($bal-$AMT);
	} 	
				
return $bal;
}
function getPreviousYRPayable($year,$admno){
	$total_payable=0;
	
	//acount from 2015 since the system was installed
	$bal2015=0;
	$yr2015=($year-1);
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  updated='2015'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal2015=$rowpai['amount'];
 	}

	$getPayable="SELECT SUM(f.amount) AS payable FROM finance_fees AS f inner join students_log sl on f.form=sl.form and f.fiscal_yr=sl.year inner JOIN studentdetails s ON sl.admno=s.admno and sl.admno='$admno' AND  f.fiscal_yr='$year'  GROUP BY sl.admno";
$results = mysql_query($getPayable);
$roe= mysql_fetch_array($results);
    $payable=$roe['payable'];
	

$added=0;
	$addedq = "SELECT COALESCE(sum(fa.amount),0) AS added FROM finance_added_fees AS fa 
inner join students_log sl on fa.fiscal_year=sl.year and sl.admno=fa.admno
inner JOIN studentdetails s ON sl.admno=s.admno
and sl.admno='$admno' AND  fa.fiscal_year='$year' GROUP BY sl.form";//cat 1 query
	$resultq = mysql_query($addedq);
	while ($rowq = mysql_fetch_array($resultq)) {// get cat1 marks
	$added=$rowq['added'];
	
	}

	$total_payable=$payable+$added+$bal2015;
	
	
	return $total_payable;
}




$func = new Functions();
$fee = new fees();

$pdf=new PDF();
$pdf->AliasNbPages();


$form=$_GET['form'];
$year=$_GET['year'];

 $lyear=($year-1);
	
	
	$myqueryis="select * from studentdetails where form='$form' order by admno desc";
	$toexecute=mysql_query($myqueryis);
	while ($rowr = mysql_fetch_array($toexecute)) {
	$admno=$rowr['admno'];
	
	//Instanciation of inherited class

	$pdf->AddPage();

	$house="___";
	$kcpe="_";
	$grade="-";
	
	$getnames = "SELECT fname,sname,lname,house,marks,grade,class from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$house=$row2['house'];
	$kcpe=$row2['marks'];
	$grade=$row2['grade'];
	$class=$row2['class'];
	$strm=$class;
	
	/*********************************************************************************/
	


if($fee->getBF($year,$admno,'TERM 1')<0){
   $tle="OVERPAYMENT ";
  }else{
   $tle="ARREARS ";
  }
  
  $bf=getPreviousYRPayable(($year-1),$admno)+getPreviousYrBal($admno,($year-1))+$fee->getBF($year,$admno,'TERM 1');;

  $added=$fee->getAddedAmt($year,$admno,'TERM 1')+$fee->getAddedAmt($year,$admno,'TERM 2')+$fee->getAddedAmt($year,$admno,'TERM 3');
		//$payable=getPayable($admno, $year);
   $payable=$fee->getInvoiceAmt(($year),'TERM 1',$admno)+$fee->getInvoiceAmt(($year),'TERM 2',$admno)+$fee->getInvoiceAmt(($year),'TERM 3',$admno)+$added+$bf;
	
	

$sql="SELECT  distinct(receipt_no), dateofpay, modeofpay,total_amount  from finance_feestructures f where f.admno='$admno' AND  f.year='$year' and f.statusis='OK' ORDER BY f.dateofpay asc";
$resultrece = mysql_query($sql);

$bal=$payable;


$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	$email=$de['email'];
	$web=$de['website'];
	}
	$date=date("j, F, Y");
	//$term='1';
	//$year='2013';
	//$form='2';
	
//$form='1';
//$kcpepos='';
$logo = "images/logo.jpg";
$pdf->Image($logo,18,5,32,30);
$pdf->SetFont('times', '', 10);
$pdf->Text(70, 10, $schoolname);
$pdf->Text(75, 15,'P.o.Box  '.$po.',  '.$plac);
$pdf->Text(75, 20,'Telephone:  '.$tele);
$pdf->Text(75, 25,'Date:  '.$date);
$pdf->Text(70, 30, 'FEES STATEMENT: 		 Year:  '.$year);


$pdf->SetFont('times', '', 9);
$pdf->Text(45, 35, 'Name: '.$fname.'   '.$mname.'    '.$lasname.'   Adm No:   '.$admno.' '.$form.' '.$strm.'  House:'.$house);
$pdf->Line(45, 36, 170, 36);//underline the student names 

$pdf->setXY(20, 45);

 $pdf->Cell(30,5, "Term 1 Fees: ",  1, 0, "L", 0);
 $pdf->Cell(40, 5, number_format($fee->getInvoiceAmt(($year),'TERM 1',$admno)+$fee->getAddedAmt($year,$admno,'TERM 1'),2), 1, 0, "R", 0);
 $pdf->Ln();
 $pdf->setX(20);
 $pdf->Cell(30,5, "Term 2 Fees: ",  1, 0, "L", 0);
 $pdf->Cell(40, 5, number_format($fee->getInvoiceAmt(($year),'TERM 2',$admno)+$fee->getAddedAmt($year,$admno,'TERM 2'),2), 1, 0, "R", 0);
 $pdf->Ln();
 $pdf->setX(20);
 $pdf->Cell(30,5, "Term 3 Fees: ",  1, 0, "L", 0);
 $pdf->Cell(40, 5, number_format($fee->getInvoiceAmt(($year),'TERM 3',$admno)+$fee->getAddedAmt($year,$admno,'TERM 3'),2), 1, 0, "R", 0);
 $pdf->Ln();
 $pdf->setX(20);
 $pdf->Cell(30,5, "Total Fees: ",  1, 0, "R", 0);
 $pdf->Cell(40, 5, number_format($payable,2), 1, 0, "R", 0);
 
 
//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","10");
$pdf->setXY(20, 65);
$pdf->Cell(40, 5, "Receipt #", 1, 0, "C", 1);
$pdf->Cell(30, 5, "Date of Pay", 1, 0, "C", 1);
$pdf->Cell(30, 5, "Mode of Pay", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Payable", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Paid", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Balance", 1, 0, "C", 1);
$pdf->Ln();
$pdf->setX(20);


$pdf->Cell(40,5, $tle.$lyear,  1);
$pdf->Cell(30,5, "-", 1);
$pdf->Cell(30,5, "-", 1);
$pdf->Cell(25,5, number_format($fee->getBF($year,$admno,'TERM 1'),2), 1, 0, "R", 0);
$pdf->Cell(25,5, "0.00", 1, 0, "R", 0);
$pdf->Cell(25,5, "0.00", 1, 0, "R", 0);
$pdf->Ln();
$pdf->setX(20);
$pdf->Cell(40,5, "B/BF",  1);
$pdf->Cell(30,5, "-", 1);
$pdf->Cell(30,5, "-", 1);
$pdf->Cell(25,5, number_format($payable,2), 1, 0, "R", 0);
$pdf->Cell(25,5, "0.00", 1, 0, "R", 0);
$pdf->Cell(25,5, number_format($payable,2), 1, 0, "R", 0);
$pdf->Ln();	

$pdf->setX(20);
$x = 20;
$y = $pdf->GetY();
$pdf->setXY($x, $y);
$num=1;
$fill=0;
 $bal=$payable;
 $totals=0;
while($rowrece = mysql_fetch_array($resultrece)){
$num++;

$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","10");
   $pdf->Cell(40,5, $rowrece['receipt_no'],  1, 0, "L", $fill);
	$pdf->Cell(30,5, $rowrece['dateofpay'], 1, 0, "L", $fill);
	$pdf->Cell(30,5, $rowrece['modeofpay'], 1, 0, "L", $fill);
	$pdf->Cell(25,5, number_format($bal,2), 1, 0, "R", $fill);
	$pdf->Cell(25,5, number_format($rowrece['total_amount'],2), 1, 0, "R", $fill);
	$pdf->Cell(25,5, number_format(($bal-$rowrece['total_amount']),2), 1, 0, "R",$fill);
	
	$y +=5;
	$fill=!$fill;
	$bal=($bal-$rowrece['total_amount']);
	//$payable=$added+$payable-$row['total_amount'];
	$totals+=$rowrece['total_amount'];
	if ($y > 180)
	{
		$pdf->AddPage('L');
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","10");
		$pdf->setXY(20, 40);
		$pdf->Cell(40,5, "Receipt #", 1, 0, "C", 1);
		$pdf->Cell(30,5, "Date of Pay", 1, 0, "C", 1);
		$pdf->Cell(30,5, "Mode of Pay", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Payable", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Paid", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Balance", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
  $pdf->Cell(100,5, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(25,5, number_format($bal,2), 1, 0, "R", 0);
   $pdf->Cell(25,5, number_format($totals,2), 1, 0, "R", 0);
    $pdf->Cell(25,5, number_format($bal,2), 1, 0, "R", 0);


$pdf->SetFont('times', '', 6);
$pdf->Text(130,290,'Generated using Chrimoska LTD School Management System on '. $date,0,0,'R');
$pdf->SetFont('times', '', 7);
$pdf->Text(50,285,'Email:'.$email.', Website:'.$web.'',0,0,'C');


}

}
$pdf->Output();	

?>
