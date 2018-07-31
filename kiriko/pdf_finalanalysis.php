<?php

require('fpdf.php');
include('includes/dbconnector.php');
include 'includes/DAO.php';

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
	$form=$_GET['form'];
	$strm=$_GET['class'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	
	
 		 $logo="images/logo.JPG";
	 
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
	$this->Image($barcode,200,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(201, 25, $hcode);
	$this->SetFont('times', '', 12);
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address);
	$this->Text(70, 27,'Telephone:  '.$tele);
	$this->Text(75, 35, 'Final Exams Analysis Form '.$form.' '.$strm.' Term '.$term.' Year '.$year);
  
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
function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}


$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
$pdf->open();
$pdf->addPage('L');
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 
 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
//table header
$pdf->SetFillColor(204,255,204); //gray
$pdf->setFont("times","","9");
$pdf->setXY(15, 40);
$pdf->Cell(10, 5, "ADM#", 1, 0, "L", 1);
		$pdf->Cell(55, 5, "Student Full Name", 1, 0, "C", 1);
		$pdf->Cell(7, 5, "Stm", 1, 0, "L", 1);
		$pdf->Cell(10, 5, "Eng", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Kisw", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Maths", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Bio", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Phy", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Chem", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "His", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Geo", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Cre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Agr", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "B/st", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Fre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Comp", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "H/Sci", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "Mks", 1, 0, "C", 1);
		$pdf->Cell(7, 5, "Pts", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Mss", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "GD", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "VAP", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "PI", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "Pos", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 15;
$pdf->setXY($x, $y);

$form=$_GET['form'];
	$strm=$_GET['class'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	
	$positionby=$_GET['by'];
	$mode=$_GET['mode'];

include 'includes/PerformanceIndicator.php';
	$pin = new PI();
	$pin->getPI($form,$term,$strm,$year,"Exam");
	
if($positionby=="marks"){
		$positionby="wat1totals";
		$alternatepositionby="averagepoints";
	}
	if($positionby=="points"){
		$positionby="averagepoints";
		$alternatepositionby="wat1totals";
	}
	
	if($strm=="Entire"){
//$sql="select * from totalygradedmidterm where form='$form' and term='$term' and year='$year' order by $positionby desc, $alternatepositionby desc";
//$sql="select * from totalygradedmidterm where form='$form' and term='$term' and year='$year' order by $positionby desc, $alternatepositionby desc";
$sql="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedexamanalysis` t1, (SELECT @rownum:=0) r where t1.form = '$form' and t1.term='$term' and t1.year='$year'  ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedexamanalysis` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and t2.term='$term' and t2.year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc;";
}else{
//$sql="select * from totalygradedmidterm where form='$form' and stream='$strm' and term='$term' and year='$year' order by $positionby desc, $alternatepositionby desc";
$sql="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedexamanalysis` t1, (SELECT @rownum:=0) r where t1.form = '$form' and t1.term='$term' and t1.year='$year' and t1.stream='$strm' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedexamanalysis` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and t2.term='$term' and t2.year='$year' and t2.stream='$strm'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc;";
}

$result = mysql_query($sql);
$num=0;
$fill=0;
while($row = mysql_fetch_array($result)){
$num++;

$pi=0;
$vap=0;
	$resultf = mysql_query("select * from totalperformanceindex where adm='".$row['adm']."' and  year='$year' and form='$form' and term='$term' and exam='Exam'");
	while ($rowf = mysql_fetch_array($resultf)){
	$pi=$rowf['pindex'];
	$vap=$rowf['vap'];
	}
	
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $row['adm'], 1, 0, "L", $fill);
    $pdf->Cell(55, 5, str_replace("&","'",$row['names']),  1, 0, "L", $fill);
	$pdf->Cell(7, 5, $row['stream'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['eng1']." ".$row['eng1grade'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['kis1']." ".$row['kis1grade'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['math1']." ".$row['math1grade'],1, 0, "L", $fill);
	
	if($row['bio1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['bio1']." ".$row['bio1grade'],  1, 0, "L", $fill);
	}
	if($row['phy1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['phy1']." ".$row['phy1grade'],  1, 0, "L", $fill);
	}
	if($row['chem1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['chem1']." ".$row['chem1grade'],  1, 0, "L", $fill);
	}
	if($row['his1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['his1']." ".$row['his1grade'],  1, 0, "L", $fill);
	}
	if($row['geo1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['geo1']." ".$row['geo1grade'],  1, 0, "L", $fill);
	}
	if($row['cre1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['cre1']." ".$row['cre1grade'],  1, 0, "L", $fill);
	}
	if($row['agr1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['agr1']." ".$row['agr1grade'],  1, 0, "L", $fill);
	}
	if($row['bst1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['bst1']." ".$row['bst1grade'],  1, 0, "L", $fill);
	}
	if($row['fre1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['fre1']." ".$row['fre1grade'],  1, 0, "L", $fill);
	}
	if($row['comp1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['comp1']." ".$row['comp1grade'],  1, 0, "L", $fill);
	}
	if($row['home1']==0){
	$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	}
	else{
	$pdf->Cell(10, 5, $row['home1']." ".$row['home1grade'],  1, 0, "L", $fill);
	}

	$pdf->Cell(8, 5, $row['wat1totals'],  1, 0, "L", $fill);
	$pdf->Cell(7, 5, $row['totalpoints1'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['averagepoints'],  1, 0, "L", $fill);
	$pdf->Cell(8, 5, $row['fgrade'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $vap,  1, 0, "R", $fill);
	$pdf->Cell(10, 5, $pi,  1, 0, "R", $fill);	
	$pdf->Cell(8, 5,  $row['ROWNUM'],  1, 0, "R", $fill);
	
	$y += 5;
	$fill=!$fill;
	if ($y > 180){
		$pdf->AddPage('L');
		$pdf->SetFillColor(204,255,204); //gray
		$pdf->setFont("times","","9");
		$pdf->setXY(15, 40);
		$pdf->Cell(10, 5, "ADM#", 1, 0, "L", 1);
		$pdf->Cell(55, 5, "Student Full Name", 1, 0, "C", 1);
		$pdf->Cell(7, 5, "Stm", 1, 0, "L", 1);
		$pdf->Cell(10, 5, "Eng", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Kisw", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Maths", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Bio", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Phy", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Chem", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "His", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Geo", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Cre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Agr", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "B/st", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Fre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Comp", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "H/Sci", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "Mks", 1, 0, "C", 1);
		$pdf->Cell(7, 5, "Pts", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Mss", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "GD", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "VAP", 1, 0, "R", 1);
		$pdf->Cell(10, 5, "PI", 1, 0, "R", 1);
		$pdf->Cell(8, 5, "Pos", 1, 0, "R", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}//end of while
$pdf->setFont("arial","B","10");
	$pdf->Cell(270, 5, "Class Mean Score Summary", 1, 0, "L", 1);
	$pdf->Ln(5);
		
		$overall=0;
		$fms=0;
		$overmean=0.00;
		$qsmean=0.00;
		$q="select distinct stream, (sum(averagepoints)/ count(adm)) as mean,  count(adm) as stds from totalygradedexamanalysis where fgrade!='F' and form='$form' and term='$term' and year='$year' group by stream desc";
	$mes=mysql_query($q);
	$pdf->SetFillColor(204,255,204); //gray
	while ($qs = mysql_fetch_array($mes)) { 
	$fms++;
	$qsmean=$qs['mean'];
		$pdf->setX(15);
		$pdf->Cell(50, 5, "Form ".$form." ".$qs['stream'], 1, 0, "L", 1);
		$pdf->Cell(50, 5, round_up ($qs['mean'],3), 1, 0, "L", 1);
		$pdf->Ln();
		$y += 5;
	if ($y > 190){
	$pdf->AddPage('L');
	$pdf->setX(15);
	$pdf->Ln();
		$y = 47;
	}
	$overall+=round_up ($qsmean,3);
	}//end of while
	
	if($overall==0){
	$overmean=0.00;
	}else{
	$overmean=round_up (($overall/$fms),3);
	}
	
	
	$pdf->setX(15);
	$pdf->Cell(50, 5, "Overall Score Form ".$form, 1, 0, "L", 1);
	$pdf->Cell(50, 5, $overmean, 1, 0, "L", 1);
 
$pdf->Output();

?>