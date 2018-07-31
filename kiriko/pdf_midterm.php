<?php

require('fpdf.php');
include('includes/dbconnector.php');
include 'includes/DAO.php';
include 'includes/SubjectTally.php';
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
	$wat=$_GET['wat'];
	$strmpassed=$strm;
	if($wat=='12'){
	$mywat='1 & 2';
	}else{
	$mywat=$wat;
	}
	$exm = 'Tune-Up';
	if($wat == 1){
	$exm = 'Tune-Up';
	}
	if($wat == 2){
	 $exm = 'Mid-Term';
	}
	if($wat == 12){
	 $exm = 'Tune-Up and Mid-Term';
	}
	
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
	$this->Text(75, 35, $exm.' Analysis Form '.$form.' '.$strm.' Term '.$term.' Year '.$year);
  
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
		$pdf->Cell(50, 5, "Student Full Name", 1, 0, "C", 1);
		$pdf->Cell(12, 5, "Stm", 1, 0, "L", 1);
		$pdf->Cell(10, 5, "Kcpe", 1, 0, "C", 1);
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
		//$pdf->Cell(10, 5, "Fre", 1, 0, "C", 1);
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
	$wat=$_GET['wat'];
	$positionby=$_GET['by'];
	$mode=$_GET['mode'];

        $strmpassed=$strm;
include 'includes/PerformanceIndicator.php';
	$pin = new PI();
	$pin->getPI($form,$term,$strm,$year,$wat);
	
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
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r where t1.form = '$form' and t1.term='$term' and t1.year='$year'  ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and t2.term='$term' and t2.year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc;";
}else{
//$sql="select * from totalygradedmidterm where form='$form' and stream='$strm' and term='$term' and year='$year' order by $positionby desc, $alternatepositionby desc";
$sql="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r where t1.form = '$form' and t1.term='$term' and t1.year='$year' and t1.stream='$strm' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
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
	$resultf = mysql_query("select * from totalperformanceindex where adm='".$row['adm']."' and  year='$year' and form='$form' and term='$term' and exam='$wat'");
	while ($rowf = mysql_fetch_array($resultf)){
	$pi=$rowf['pindex'];
	$vap=$rowf['vap'];
	}
	
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $row['adm'], 1, 0, "L", $fill);
    $pdf->Cell(50, 5, str_replace("&","'",$row['names']),  1, 0, "L", $fill);
	$pdf->Cell(12, 5, $row['stream'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['kcpe'], 1, 0, "L", $fill);
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
	//if($row['fre1']==0){
	//$pdf->Cell(10, 5,"-"." "."-",  1, 0, "L", $fill);
	//}
	//else{
	//$pdf->Cell(10, 5, $row['fre1']." ".$row['fre1grade'],  1, 0, "L", $fill);
	//}
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

	$pdf->Cell(10, 5, number_format(($vap-$row['averagepoints']),2),  1, 0, "R", $fill);
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
		$pdf->Cell(50, 5, "Student Full Name", 1, 0, "C", 1);
		$pdf->Cell(12, 5, "Stm", 1, 0, "L", 1);
		$pdf->Cell(10, 5, "Kcpe", 1, 0, "C", 1);
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
		//$pdf->Cell(10, 5, "Fre", 1, 0, "C", 1);
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

$pdf->AddPage('L');
	$pdf->setXY(25, 40);
	$pdf->setFont("times","B","12");
	$pdf->Cell(150, 7, "Class Mean Score Summary", 1, 0, "L", 1);
	$pdf->Ln(7);
	$pdf->setX(25);
	$pdf->setFont("arial","B","10");
	$pdf->Cell(50, 5, "Class", 1, 0, "C", 1);
	$pdf->Cell(50, 5, "# Students", 1, 0, "C", 1);
	$pdf->Cell(50, 5, "Mean", 1, 0, "C", 1);
	$pdf->Ln();
		
		$overall=0;
		$fms=0;
		$overmean=0.00;
		$stdtotal=0;
		$q="select distinct classin, (sum(averagepoints)/ count(adm)) as mean,  count(adm) as stds from totalygradedmarks where tgrade!='F' and form='$form' and term='$term' and year='$year' group by classin desc";
	$mes=mysql_query($q);
	$pdf->SetFillColor(204,255,204); //gray
	while ($qs = mysql_fetch_array($mes)) { 
	$fms++;
		$pdf->setX(25);
		$pdf->Cell(50, 7, "Form ".$form." ".$qs['classin'], 1, 0, "L", 1);
		$pdf->Cell(50, 7, round_up ($qs['stds'],3), 1, 0, "L", 1);
		$pdf->Cell(50, 7, round_up ($qs['mean'],3), 1, 0, "L", 1);
		
		$stdtotal+=$qs['stds'];
		$pdf->Ln();
		$y += 5;
	
	$overall+=round_up ($qs['mean'],3);
	}//end of while



  if($strm=='Entire'){
		$geta = mysql_query("select count(fgrade) as a from totalygradedmidterm where fgrade='A' and term='$term' and year='$year' and form='$form'");
	}else{
		$geta = mysql_query("select count(fgrade) as a from totalygradedmidterm where fgrade='A' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($geta)) {// get admno
	$as=$rowAS['a'];
	
	}
	
	 if($strm=='Entire'){
	$getam = mysql_query("select count(fgrade) as am from totalygradedmidterm where fgrade='A-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getam = mysql_query("select count(fgrade) as am from totalygradedmidterm where fgrade='A-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getam)) {// get admno
	$am=$rowAS['am'];

	}
	if($strm=='Entire'){
	$getbp = mysql_query("select count(fgrade) as bp from totalygradedmidterm where fgrade='B+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbp = mysql_query("select count(fgrade) as bp from totalygradedmidterm where fgrade='B+' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getbp)) {// get admno
	$bp=$rowAS['bp'];
	}
	
	if($strm=='Entire'){
	$getbs = mysql_query("select count(fgrade) as bs from totalygradedmidterm where fgrade='B' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbs = mysql_query("select count(fgrade) as bs from totalygradedmidterm where fgrade='B' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getbs)) {// get admno
	$bs=$rowAS['bs'];
	}
	
	if($strm=='Entire'){
	$getbm = mysql_query("select count(fgrade) as bm from totalygradedmidterm where fgrade='B-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbm = mysql_query("select count(fgrade) as bm from totalygradedmidterm where fgrade='B-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getbm)) {// get admno
	$bm=$rowAS['bm'];
	}
	
	
	if($strm=='Entire'){
	$getcp = mysql_query("select count(fgrade) as cp from totalygradedmidterm where fgrade='C+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcp = mysql_query("select count(fgrade) as cp from totalygradedmidterm where fgrade='C+' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getcp)) {// get admno
	$cp=$rowAS['cp'];
	}
	
	if($strm=='Entire'){
	$getcs = mysql_query("select count(fgrade) as cs from totalygradedmidterm where fgrade='C' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcs = mysql_query("select count(fgrade) as cs from totalygradedmidterm where fgrade='C' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getcs)) {// get admno
	$cs=$rowAS['cs'];
	}
	
	if($strm=='Entire'){
	$getcm = mysql_query("select count(fgrade) as cm from totalygradedmidterm where fgrade='C-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcm = mysql_query("select count(fgrade) as cm from totalygradedmidterm where fgrade='C-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getcm)) {// get admno
	$cm=$rowAS['cm'];
	}
	
	if($strm=='Entire'){
	$getdp = mysql_query("select count(fgrade) as dp from totalygradedmidterm where fgrade='D+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getdp = mysql_query("select count(fgrade) as dp from totalygradedmidterm where fgrade='D+' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getdp)) {// get admno
	$dp=$rowAS['dp'];
	}
	
	if($strm=='Entire'){
	$getds = mysql_query("select count(fgrade) as ds from totalygradedmidterm where fgrade='D' and term='$term' and year='$year' and form='$form'");
	}else{
	$getds = mysql_query("select count(fgrade) as ds from totalygradedmidterm where fgrade='D' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getds)) {// get admno
	$ds=$rowAS['ds'];
	}
	
	
	if($strm=='Entire'){
	$getdm = mysql_query("select count(fgrade) as dm from totalygradedmidterm where fgrade='D-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getdm = mysql_query("select count(fgrade) as dm from totalygradedmidterm where fgrade='D-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getdm)) {// get admno
	$dm=$rowAS['dm'];
	}
	
	
	if($strm=='Entire'){
	$getes = mysql_query("select count(fgrade) as esd from totalygradedmidterm where fgrade='E' and term='$term' and year='$year' and form='$form'");
	}else{
	$getes = mysql_query("select count(fgrade) as esd from totalygradedmidterm where fgrade='E' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getes)) {// get admno
	$es=$rowAS['esd'];
	
	}
	
	$studentsare=0;
	if($strm=='Entire'){
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form'");
	}else{
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowstud = mysql_fetch_array($getstudents)) {// get admno
	$studentsare=$rowstud['adms'];
	}
	
	
	
	
	$ap=$as*12;
	$amp=$am*11;
	$bpp=$bp*10;
	$bsp=$bs*9;
	$bmp=$bm*8;
	$cpp=$cp*7;
	$csp=$cs*6;
	$cmp=$cm*5;
	$dpp=$dp*4;
	$dsp=$ds*3;
	$dmp=$dm*2;
	$esp=$es*1;
	
	$classtotalp=$ap+$amp+$bpp+$bsp+$bmp+$cpp+$csp+$cmp+$dpp+$dsp+$dmp+$esp;
	
	$cms=round_up ( $classtotalp/$studentsare, 3 ); 
	
	if ($cms > 0 && $cms <= 1.499) {
			$finalgrade = "E";
			
			// remarks="Work harder";
		} else if ($cms >= 1.5 && $cms <= 2.499) {
			$finalgrade = "D-";
			// remarks="Improve";
		} else if ($cms >= 2.5 && $cms <= 3.499) {
			$finalgrade = "D";
			// remarks="Improve";
		} else if ($cms >= 3.5 && $cms <= 4.499) {
			$finalgrade = "D+";
			// remarks="Can do better";
		} else if ($cms >= 4.5 && $cms <= 5.499) {
			$finalgrade = "C-";
			// remarks="Fair";
		} else if ($cms >= 5.5 && $cms <= 6.499) {
			$finalgrade = "C";
			// remarks="Fair";
		} else if ($cms >= 6.5 && $cms <= 7.499) {
			$finalgrade = "C+";
			// remarks="Fair";
		} else if ($cms >= 7.5 && $cms <= 8.499) {
			$finalgrade = "B-";
			// remarks="Good";
		} else if ($cms >= 8.5 && $cms <= 9.499) {
			$finalgrade = "B";
			// remarks="Good";
		} else if ($cms >= 9.5 && $cms <= 10.499) {
			$finalgrade = "B+";
			// remarks="Good";
		} else if ($cms >= 10.5 && $cms <= 11.499) {
			$finalgrade = "A-";
			// remarks="V. Good";
		} else if ($cms >= 11.5 && $cms <= 12.0) {
			$finalgrade = "A";
			// remarks="Excellent";
		}else if ($cms == 0) {
			$finalgrade = "-";
			
		}
	

                	$overall=0;
		$fms=0;
		$overmean=0.00;
		$qsmean=0.00;
		$q="select distinct stream, (sum(averagepoints)/ count(adm)) as mean,  count(adm) as stds from totalygradedmidterm where fgrade!='F' and form='$form' and term='$term' and year='$year' group by stream desc";
	$mes=mysql_query($q);
	$pdf->SetFillColor(204,255,204); //gray
	while ($qs = mysql_fetch_array($mes)) { 
	$fms++;
	$qsmean=$qs['mean'];
		$pdf->setX(25);
		$pdf->Cell(50, 5, "Form ".$form." ".$qs['stream'], 1, 0, "L", 1);
                $pdf->Cell(50, 7, round_up ($qs['stds'],3), 1, 0, "L", 1);
		$pdf->Cell(50, 5, round_up ($qs['mean'],3), 1, 0, "L", 1);
		$pdf->Ln();
		$y += 5;
                $stdtotal+=$qs['stds'];
	if ($y > 190){
	$pdf->AddPage('L');
	$pdf->setX(25);
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
        
	$pdf->setX(25);
	$pdf->Cell(50, 7, "Overall Score Form ".$form, 1, 0, "L", 1);
	$pdf->Cell(50, 7, $stdtotal, 1, 0, "L", 1);
	$pdf->Cell(50, 7, $overmean, 1, 0, "L", 1);
	$pdf->Ln(20);
	
	$pdf->setX(25);
	$pdf->setFont("times","B","12");
	$pdf->Cell(218, 7, "Students Mean  Summary", 1, 0, "L", 1);
	$pdf->Ln(7);
	$pdf->setX(25);
	$pdf->setFont("arial","B","10");
	$pdf->Cell(20, 6, "A", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "A-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "B+", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "B", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "B-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "C+", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "C", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "C-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "D+", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "D", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "D-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "E", 1, 0, "L", 1);
	 
	$pdf->Ln();
	$pdf->setX(25);
	$pdf->Cell(20, 6, $as, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $am, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $bp, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $bs, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $bm, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $cp, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $cs, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $cm, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $dp, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $ds, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $dm, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $es, 1, 0, "L", 1);
	
	

        
                
	$stally = new SubjectTally();
	
	 $englishas = 0; 
	 $englishabp = 0; 
	 $englisham = 0;                            
	 $englishab = 0;                           
	 $englishabm = 0;                             
	 $englishacp = 0;                             
	 $englishac  = 0;                           
	 $englishacm = 0;                          
	 $englishadp = 0;                             
	 $englishad  = 0;                            
	 $englishadm = 0;                           
	 $englishade = 0;  
 
    $engpoas = 0; 
	$engpoam = 0;
	$engpobp = 0;
	$engpob =   0;
	$engpobm = 0;
	$engpocp = 0;
	$engpoc = 0;
	$engpocm = 0;
	$engpodp = 0;
	$engpod = 0;
	$engpodm = 0;
	$engpoe = 0;
    $engpoa =0;
	
	//*****************************************************************************************************************************
	$englishtallys=0;
	
	if($strm=='Entire'){
	
	$englishtallys = $stally -> getGradesPerSubjectEntireMID("eng1","eng1grade", $term,$year,$form); 
	
	}
	else{
	
	$englishtallys = $stally -> getGradesPerSubjectMID("eng1","eng1grade", $term,$year,$form,$strm); 
	
	}
	
	
	
	
	
	
	
	
	//echo " *****************************************".$englishtallys[0][0]."           ".$englishtallys[0][1];
	
	foreach($englishtallys as $key=>$values){
	//echo " ****".$englishtallys[$key][0]."   **  ".$englishtallys[$key][1] ."</br>";
	
	if($englishtallys[$key][0]=='A')  { $englishas = $englishtallys[$key][1]; }
	if($englishtallys[$key][0]=='A-') { $englisham = $englishtallys[$key][1]; }
	if($englishtallys[$key][0]=='B+') { $englishabp = $englishtallys[$key][1];}
	if($englishtallys[$key][0]=='B')  { $englishab = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='B-') { $englishabm = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='C+') { $englishacp = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='C')  { $englishac = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='C-') { $englishacm = $englishtallys[$key][1]; }
	if($englishtallys[$key][0]=='D+') { $englishadp = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='D')  { $englishad = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='D-') { $englishadm = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='E')  { $englishade = $englishtallys[$key][1] ;}
	}
                           

	$engpoA = $englishas * 12; 
	$engpoAm = $englisham * 11;
	$engpoBP = $englishabp * 10;
	$engpoB =   $englishab * 9;
	$engpoBm = $englishabm * 8;
	$engpoCp = $englishacp * 7;
	$engpoC = $englishac * 6;
	$engpoCm = $englishacm * 5;
	$engpoDp = $englishadp *4;
	$engpoD = $englishad * 3;
	$engpoDm = $englishadm * 2;
	$engpoE = $englishade * 1;
	
	
	
	
	//************************************************** french **************************************************************************
	
 $frenchas = 0; 
 $frencham = 0;
 $frenchbp = 0;                     
 $frenchb = 0;                           
 $frenchbm = 0;                             
 $frenchcp = 0;                             
 $frenchc  = 0;                           
 $frenchcm = 0;                          
 $frenchdp = 0;                             
 $frenchd  = 0;                            
 $frenchdm = 0;                           
 $frenchde = 0;  
 
    
	
	//*****************************************************************************************************************************
	$frenchtallys = 0;
	if($strm=='Entire'){
	
	$frenchtallys = $stally -> getGradesPerSubjectEntireMID("fre1","fre1grade", $term,$year,$form); 
	}else{
	$frenchtallys = $stally -> getGradesPerSubjectMID("fre1","fre1grade", $term,$year,$form,$strm); 
	                           //getGradesPerSubjectMID("frenchgrade", $term,$year,$form,$stream);
	}
	//echo " *****************************************".$frenchtallys[0][0]."           ".$frenchtallys[0][1];
	
	foreach($frenchtallys as $key=>$values){
	//echo " ****".$frenchtallys[$key][0]."   **  ".$frenchtallys[$key][1] ."</br>";
	
	if($frenchtallys[$key][0]=='A')  { $frenchas = $frenchtallys[$key][1]; }
	if($frenchtallys[$key][0]=='A-') { $frencham = $frenchtallys[$key][1]; }
	if($frenchtallys[$key][0]=='B+') { $frenchbp = $frenchtallys[$key][1];}
	if($frenchtallys[$key][0]=='B')  { $frenchb = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='B-') { $frenchbm = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='C+') { $frenchcp = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='C')  { $frenchc = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='C-') { $frenchcm = $frenchtallys[$key][1]; }
	if($frenchtallys[$key][0]=='D+') { $frenchdp = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='D')  { $frenchd = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='D-') { $frenchdm = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='E')  { $frenchde = $frenchtallys[$key][1] ;}
	}
                           

	$frenchpoA = $frenchas * 12; 
	$frenchpoAm = $frencham * 11;
	$frenchpoBP = $frenchbp * 10;
	$frenchpoB =   $frenchb * 9;
	$frenchpoBm = $frenchbm * 8;
	$frenchpoCp = $frenchcp * 7;
	$frenchpoC = $frenchc * 6;
	$frenchpoCm = $frenchcm * 5;
	$frenchpoDp = $frenchdp *4;
	$frenchpoD = $frenchd * 3;
	$frenchpoDm = $frenchdm * 2;
	$frenchpoE = $frenchde * 1;

	
	
	
	//************************************************** french **************************************************************************
	
	//******************************************************HOME SCIENCE******************************************************************
 $homeas = 0; 
 $homebp = 0; 
 $homeam = 0;                            
 $homeb = 0;                           
 $homebm = 0;                             
 $homecp = 0;                             
 $homec  = 0;                           
 $homecm = 0;                          
 $homedp = 0;                             
 $homed  = 0;                            
 $homedm = 0;                           
 $homede = 0;  

    
	
	//*****************************************************************************************************************************
	$hometallys = 0;
	if($strm=='Entire'){
	
	$hometallys = $stally -> getGradesPerSubjectEntireMID("home1","home1grade", $term,$year,$form); 
	}else{
	$hometallys = $stally -> getGradesPerSubjectMID("home1","home1grade", $term,$year,$form,$strm); 
	
	}
	//echo " *****************************************".$hometallys[0][0]."           ".$hometallys[0][1];
	
	foreach($hometallys as $key=>$values){
	//echo " ****".$hometallys[$key][0]."   **  ".$hometallys[$key][1] ."</br>";
	
	if($hometallys[$key][0]=='A')  { $homeas = $hometallys[$key][1]; }
	if($hometallys[$key][0]=='A-') { $homeam = $hometallys[$key][1]; }
	if($hometallys[$key][0]=='B+') { $homebp = $hometallys[$key][1];}
	if($hometallys[$key][0]=='B')  { $homeb = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='B-') { $homebm = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='C+') { $homecp = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='C')  { $homec = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='C-') { $homecm = $hometallys[$key][1]; }
	if($hometallys[$key][0]=='D+') { $homedp = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='D')  { $homed = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='D-') { $homedm = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='E')  { $homede = $hometallys[$key][1] ;}
	}
                           

	$homepoA = $homeas * 12; 
	$homepoAm = $homeam * 11;
	$homepoBP = $homebp * 10;
	$homepoB =   $homeb * 9;
	$homepoBm = $homebm * 8;
	$homepoCp = $homecp * 7;
	$homepoC = $homec * 6;
	$homepoCm = $homecm * 5;
	$homepoDp = $homedp *4;
	$homepoD = $homed * 3;
	$homepoDm = $homedm * 2;
	$homepoE = $homede * 1;
	
//***************************************************************************************************

 $computeras = 0; 
 $computerbp = 0; 
 $computeram = 0;                            
 $computerb = 0;                           
 $computerbm = 0;                             
 $computercp = 0;                             
 $computerc  = 0;                           
 $computercm = 0;                          
 $computerdp = 0;                             
 $computerd  = 0;                            
 $computerdm = 0;                           
 $computerde = 0;  
 
    
	
	//*****************************************************************************************************************************
	
	$computertallys = 0;
	if($strm=='Entire'){
	
	$computertallys = $stally -> getGradesPerSubjectEntireMID("comp1","comp1grade", $term,$year,$form); 
	}else{
	$computertallys = $stally -> getGradesPerSubjectMID("comp1","comp1grade", $term,$year,$form,$strm); 
	
	}
	//echo " *****************************************".$computertallys[0][0]."           ".$computertallys[0][1];
	
	foreach($computertallys as $key=>$values){
	//echo " ****".$computertallys[$key][0]."   **  ".$computertallys[$key][1] ."</br>";
	
	if($computertallys[$key][0]=='A')  { $computeras = $computertallys[$key][1]; }
	if($computertallys[$key][0]=='A-') { $computeram = $computertallys[$key][1]; }
	if($computertallys[$key][0]=='B+') { $computerbp = $computertallys[$key][1];}
	if($computertallys[$key][0]=='B')  { $computerb = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='B-') { $computerbm = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='C+') { $computercp = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='C')  { $computerc = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='C-') { $computercm = $computertallys[$key][1]; }
	if($computertallys[$key][0]=='D+') { $computerdp = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='D')  { $computerd = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='D-') { $computerdm = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='E')  { $computerde = $computertallys[$key][1] ;}
	}
                       
			

	$computerpoA = $computeras * 12; 
	$computerpoAm = $computeram * 11;
	$computerpoBP = $computerbp * 10;
	$computerpoB =   $computerb * 9;
	$computerpoBm = $computerbm * 8;
	$computerpoCp = $computercp * 7;
	$computerpoC = $computerc * 6;
	$computerpoCm = $computercm * 5;
	$computerpoDp = $computerdp *4;
	$computerpoD = $computerd * 3;
	$computerpoDm = $computerdm * 2;
	$computerpoE = $computerde * 1;
	

//***********************************************************************************************************8



	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','A',$term,$year,$form,"");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','A',$term,$year,$form," and stream='$strm'");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','A-',$term,$year,$form,"");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','A-',$term,$year,$form," and stream='$strm'");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','B+',$term,$year,$form,"");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','B+',$term,$year,$form," and stream='$strm'");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','B',$term,$year,$form,"");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','B',$term,$year,$form," and stream='$strm'");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','B-',$term,$year,$form,"");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','B-',$term,$year,$form," and stream='$strm'");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','C+',$term,$year,$form,"");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','C+',$term,$year,$form," and stream='$strm'");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','C',$term,$year,$form,"");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','C',$term,$year,$form," and stream='$strm'");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','C-',$term,$year,$form,"");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','C-',$term,$year,$form," and stream='$strm'");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','D+',$term,$year,$form,"");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','D+',$term,$year,$form," and stream='$strm'");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','D',$term,$year,$form,"");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','D',$term,$year,$form," and stream='$strm'");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','D-',$term,$year,$form,"");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','D-',$term,$year,$form," and stream='$strm'");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','E',$term,$year,$form,"");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','E',$term,$year,$form," and stream='$strm'");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}
	
	
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','A',$term,$year,$form,"");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','A',$term,$year,$form," and stream='$strm'");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}
	
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','A-',$term,$year,$form,"");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','A-',$term,$year,$form," and stream='$strm'");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','B+',$term,$year,$form,"");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','B+',$term,$year,$form," and stream='$strm'");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','B',$term,$year,$form,"");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','B',$term,$year,$form," and stream='$strm'");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','B-',$term,$year,$form,"");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','B-',$term,$year,$form," and stream='$strm'");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','C+',$term,$year,$form,"");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','C+',$term,$year,$form," and stream='$strm'");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','C',$term,$year,$form,"");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','C',$term,$year,$form," and stream='$strm'");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','C-',$term,$year,$form,"");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','C-',$term,$year,$form," and stream='$strm'");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','D+',$term,$year,$form,"");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','D+',$term,$year,$form," and stream='$strm'");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','D',$term,$year,$form,"");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','D',$term,$year,$form," and stream='$strm'");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','D-',$term,$year,$form,"");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','D-',$term,$year,$form," and stream='$strm'");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','E',$term,$year,$form,"");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','E',$term,$year,$form," and stream='$strm'");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}
	
	/*** GET BIOLOGY GRADES AND POINTS **/
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','A',$term,$year,$form,"");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','A',$term,$year,$form," and stream='$strm'");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','A-',$term,$year,$form,"");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','A-',$term,$year,$form," and stream='$strm'");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','B+',$term,$year,$form,"");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','B+',$term,$year,$form," and stream='$strm'");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','B',$term,$year,$form,"");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','B',$term,$year,$form," and stream='$strm'");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','B-',$term,$year,$form,"");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','B-',$term,$year,$form," and stream='$strm'");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','C+',$term,$year,$form,"");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','C+',$term,$year,$form," and stream='$strm'");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','C',$term,$year,$form,"");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','C',$term,$year,$form," and stream='$strm'");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','C-',$term,$year,$form,"");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','C-',$term,$year,$form," and stream='$strm'");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','D+',$term,$year,$form,"");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','D+',$term,$year,$form," and stream='$strm'");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','D',$term,$year,$form,"");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','D',$term,$year,$form," and stream='$strm'");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','D-',$term,$year,$form,"");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','D-',$term,$year,$form," and stream='$strm'");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','E',$term,$year,$form,"");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','E',$term,$year,$form," and stream='$strm'");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}
	
	$biologyStudents=0;
	if($strm=='Entire'){
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and bio1>0");
	}else{
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and bio1>0");
	}
	while ($rowbiostud = mysql_fetch_array($getbiostudents)) {// get admno
	$biologyStudents=$rowbiostud['adms'];
	}
	
	/***************** GET CHEMISTRY GRADES *******************/
	
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A',$term,$year,$form,"");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A',$term,$year,$form," and stream='$strm'");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A-',$term,$year,$form,"");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A-',$term,$year,$form," and stream='$strm'");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B+',$term,$year,$form,"");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B+',$term,$year,$form," and stream='$strm'");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B',$term,$year,$form,"");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B',$term,$year,$form," and stream='$strm'");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B-',$term,$year,$form,"");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B-',$term,$year,$form," and stream='$strm'");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C+',$term,$year,$form,"");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C+',$term,$year,$form," and stream='$strm'");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C',$term,$year,$form,"");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C',$term,$year,$form," and stream='$strm'");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C-',$term,$year,$form,"");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C-',$term,$year,$form," and stream='$strm'");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D+',$term,$year,$form,"");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D+',$term,$year,$form," and stream='$strm'");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D',$term,$year,$form,"");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D',$term,$year,$form," and stream='$strm'");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D-',$term,$year,$form,"");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D-',$term,$year,$form," and stream='$strm'");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','E',$term,$year,$form,"");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','E',$term,$year,$form," and stream='$strm'");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}
	
	
	$chemistryStudents=0;
	if($strm=='Entire'){
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and chem1>0");
	}else{
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and chem1>0");
	}
	while ($rowchemstud = mysql_fetch_array($getchemstudents)) {// get admno
	$chemistryStudents=$rowchemstud['adms'];
	}

	/************************ GET PHYSICS GRADES *************************************/
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','A',$term,$year,$form,"");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','A',$term,$year,$form," and stream='$strm'");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','A-',$term,$year,$form,"");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','A-',$term,$year,$form," and stream='$strm'");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','B+',$term,$year,$form,"");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','B+',$term,$year,$form," and stream='$strm'");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','B',$term,$year,$form,"");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','B',$term,$year,$form," and stream='$strm'");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','B-',$term,$year,$form,"");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','B-',$term,$year,$form," and stream='$strm'");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','C+',$term,$year,$form,"");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','C+',$term,$year,$form," and stream='$strm'");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','C',$term,$year,$form,"");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','C',$term,$year,$form," and stream='$strm'");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','C-',$term,$year,$form,"");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','C-',$term,$year,$form," and stream='$strm'");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','D+',$term,$year,$form,"");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','D+',$term,$year,$form," and stream='$strm'");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','D',$term,$year,$form,"");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','D',$term,$year,$form," and stream='$strm'");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','D-',$term,$year,$form,"");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','D-',$term,$year,$form," and stream='$strm'");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','E',$term,$year,$form,"");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','E',$term,$year,$form," and stream='$strm'");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}
	
	$physicsStudents=0;
	if($strm=='Entire'){
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and phy1>0");
	}else{
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and phy1>0");
	}
	while ($rowphystud = mysql_fetch_array($getphystudents)) {// get admno
	$physicsStudents=$rowphystud['adms'];
	}
	
	/************************* GET HISTORY GRADES ***************************************/
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','A',$term,$year,$form,"");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','A',$term,$year,$form," and stream='$strm'");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','A-',$term,$year,$form,"");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','A-',$term,$year,$form," and stream='$strm'");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','B+',$term,$year,$form,"");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','B+',$term,$year,$form," and stream='$strm'");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','B',$term,$year,$form,"");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','B',$term,$year,$form," and stream='$strm'");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','B-',$term,$year,$form,"");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','B-',$term,$year,$form," and stream='$strm'");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','C+',$term,$year,$form,"");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','C+',$term,$year,$form," and stream='$strm'");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','C',$term,$year,$form,"");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','C',$term,$year,$form," and stream='$strm'");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','C-',$term,$year,$form,"");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','C-',$term,$year,$form," and stream='$strm'");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','D+',$term,$year,$form,"");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','D+',$term,$year,$form," and stream='$strm'");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','D',$term,$year,$form,"");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','D',$term,$year,$form," and stream='$strm'");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','D-',$term,$year,$form,"");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','D-',$term,$year,$form," and stream='$strm'");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','E',$term,$year,$form,"");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','E',$term,$year,$form," and stream='$strm'");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}
	
	
	$historyStudents=0;
	if($strm=='Entire'){
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and his1>0");
	}else{
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and his1>0");
	}
	while ($rowhisstud = mysql_fetch_array($gethisstudents)) {// get admno
	$historyStudents=$rowhisstud['adms'];
	}
	/*************************** GET GEOGRAPHY GRADES *****************************/
	
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','A',$term,$year,$form,"");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','A',$term,$year,$form," and stream='$strm'");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','A-',$term,$year,$form,"");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','A-',$term,$year,$form," and stream='$strm'");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','B+',$term,$year,$form,"");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','B+',$term,$year,$form," and stream='$strm'");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','B',$term,$year,$form,"");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','B',$term,$year,$form," and stream='$strm'");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','B-',$term,$year,$form,"");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','B-',$term,$year,$form," and stream='$strm'");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','C+',$term,$year,$form,"");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','C+',$term,$year,$form," and stream='$strm'");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','C',$term,$year,$form,"");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','C',$term,$year,$form," and stream='$strm'");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','C-',$term,$year,$form,"");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','C-',$term,$year,$form," and stream='$strm'");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','D+',$term,$year,$form,"");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','D+',$term,$year,$form," and stream='$strm'");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','D',$term,$year,$form,"");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','D',$term,$year,$form," and stream='$strm'");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','D-',$term,$year,$form,"");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','D-',$term,$year,$form," and stream='$strm'");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','E',$term,$year,$form,"");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','E',$term,$year,$form," and stream='$strm'");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}
	
	$geographyStudents=0;
	if($strm=='Entire'){
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and geo1>0");
	}else{
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and geo1>0");
	}
	while ($rowgeostud = mysql_fetch_array($getgeostudents)) {// get admno
	$geographyStudents=$rowgeostud['adms'];
	}
	
	/************************* GET CRE GRADES  *****************************/
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','A',$term,$year,$form,"");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','A',$term,$year,$form," and stream='$strm'");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','A-',$term,$year,$form,"");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','A-',$term,$year,$form," and stream='$strm'");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','B+',$term,$year,$form,"");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','B+',$term,$year,$form," and stream='$strm'");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','B',$term,$year,$form,"");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','B',$term,$year,$form," and stream='$strm'");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','B-',$term,$year,$form,"");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','B-',$term,$year,$form," and stream='$strm'");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','C+',$term,$year,$form,"");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','C+',$term,$year,$form," and stream='$strm'");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','C',$term,$year,$form,"");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','C',$term,$year,$form," and stream='$strm'");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','C-',$term,$year,$form,"");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','C-',$term,$year,$form," and stream='$strm'");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','D+',$term,$year,$form,"");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','D+',$term,$year,$form," and stream='$strm'");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','D',$term,$year,$form,"");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','D',$term,$year,$form," and stream='$strm'");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','D-',$term,$year,$form,"");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','D-',$term,$year,$form," and stream='$strm'");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','E',$term,$year,$form,"");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','E',$term,$year,$form," and stream='$strm'");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}
	
	$creStudents=0;
	if($strm=='Entire'){
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and cre1>0");
	}else{
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and cre1>0");
	}
	while ($rowcrestud = mysql_fetch_array($getcrestudents)) {// get admno
	$creStudents=$rowcrestud['adms'];
	}
	/*********************** GET AGRICULTURE GRADES *******************************/
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A',$term,$year,$form,"");
		$agras=$agrtally['tally'];
		$agrA=$crede*12;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A',$term,$year,$form," and stream='$strm'");
		$agras=$agrtally['tally'];
		$agrA=$agras*12;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A-',$term,$year,$form,"");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A-',$term,$year,$form," and stream='$strm'");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B+',$term,$year,$form,"");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B+',$term,$year,$form," and stream='$strm'");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B',$term,$year,$form,"");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B',$term,$year,$form," and stream='$strm'");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B-',$term,$year,$form,"");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B-',$term,$year,$form," and stream='$strm'");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C+',$term,$year,$form,"");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C+',$term,$year,$form," and stream='$strm'");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C',$term,$year,$form,"");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C',$term,$year,$form," and stream='$strm'");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C-',$term,$year,$form,"");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C-',$term,$year,$form," and stream='$strm'");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D+',$term,$year,$form,"");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D+',$term,$year,$form," and stream='$strm'");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D',$term,$year,$form,"");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D',$term,$year,$form," and stream='$strm'");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D-',$term,$year,$form,"");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D-',$term,$year,$form," and stream='$strm'");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','E',$term,$year,$form,"");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','E',$term,$year,$form," and stream='$strm'");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}
	
	$agrStudents=0;
	if($strm=='Entire'){
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and agr1>0");
	}else{
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and agr1>0");
	}
	while ($rowagrstud = mysql_fetch_array($getagrstudents)) {// get admno
	$agrStudents=$rowagrstud['adms'];
	}
	
	/*********************** GET BUSINESS GRADES****************************/
	
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A',$term,$year,$form,"");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A',$term,$year,$form," and stream='$strm'");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A-',$term,$year,$form,"");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A-',$term,$year,$form," and stream='$strm'");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B+',$term,$year,$form,"");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B+',$term,$year,$form," and stream='$strm'");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B',$term,$year,$form,"");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B',$term,$year,$form," and stream='$strm'");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B-',$term,$year,$form,"");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B-',$term,$year,$form," and stream='$strm'");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C+',$term,$year,$form,"");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C+',$term,$year,$form," and stream='$strm'");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C',$term,$year,$form,"");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C',$term,$year,$form," and stream='$strm'");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C-',$term,$year,$form,"");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C-',$term,$year,$form," and stream='$strm'");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D+',$term,$year,$form,"");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D+',$term,$year,$form," and stream='$strm'");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D',$term,$year,$form,"");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D',$term,$year,$form," and stream='$strm'");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D-',$term,$year,$form,"");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D-',$term,$year,$form," and stream='$strm'");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','E',$term,$year,$form,"");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','E',$term,$year,$form," and stream='$strm'");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}
	
	
	
	$bstStudents=0;
	if($strm=='Entire'){
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and bst1>0");
	}else{
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and bst1>0");
	}
	while ($rowbststud = mysql_fetch_array($getbststudents)) {// get admno
	$bstStudents=$rowbststud['adms'];
	}
	
	
	$frenchStudents=0;
	if($strm=='Entire'){
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and fre1 > 0");
	}else{
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and fre1 > 0");
	}
	while ($rowbststud = mysql_fetch_array($getfrenchStudents)) {// get admno
	$frenchStudents=$rowbststud['adms'];
	}
	
	
	$homeStudents=0;
	if($strm=='Entire'){
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and home1>0");
	}else{
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and home1>0");
	}
	while ($rowbststud = mysql_fetch_array($gethomeStudents)) {// get admno
	$homeStudents=$rowbststud['adms'];
	}
	
	
	$computerStudents=0;
	if($strm=='Entire'){
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and comp1>0");
	}else{
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and comp1>0");
	}
	while ($rowbststud = mysql_fetch_array($getcomputerStudents)) {// get admno
	$computerStudents=$rowbststud['adms'];
	}
	
	
	/*************************************************************************************************/
	
	$totalEnglishPoints=$engpoA+$engpoAm+$engpoBP+$engpoB+$engpoBm+$engpoCp+$engpoC+$engpoCm+$engpoDp+$engpoD+$engpoDm+$engpoE;
	$totalKiswahiliPoints=$kisA+$kisAm+$kisBP+$kisB+$kisBm+$kisCp+$kisC+$kisCm+$kisDp+$kisD+$kisDm+$kisE;
	$totalMathPoints=$mathA+$mathAm+$mathBP+$mathB+$mathBm+$mathCp+$mathC+$mathCm+$mathDp+$mathD+$mathDm+$mathE;
	$totalBioPoints=$bioA+$bioAm+$bioBP+$bioB+$bioBm+$bioCp+$bioC+$bioCm+$bioDp+$bioD+$bioDm+$bioE;
	$totalChemPoints=$chemA+$chemAm+$chemBP+$chemB+$chemBm+$chemCp+$chemC+$chemCm+$chemDp+$chemD+$chemDm+$chemE;
	$totalPhysPoints=$phyA+$phyAm+$phyBP+$phyB+$phyBm+$phyCp+$phyC+$phyCm+$phyDp+$phyD+$phyDm+$phyE;
	$totalHisPoints=$hisA+$hisAm+$hisBP+$hisB+$hisBm+$hisCp+$hisC+$hisCm+$hisDp+$hisD+$hisDm+$hisE;
	$totalGeoPoints=$geoA+$geoAm+$geoBP+$geoB+$geoBm+$geoCp+$geoC+$geoCm+$geoDp+$geoD+$geoDm+$geoE;
	$totalCrePoints=$creA+$creAm+$creBP+$creB+$creBm+$creCp+$creC+$creCm+$creDp+$creD+$creDm+$creE;
	$totalAgrPoints=$agrA+$agrAm+$agrBP+$agrB+$agrBm+$agrCp+$agrC+$agrCm+$agrDp+$agrD+$agrDm+$agrE;
	$totalBstPoints=$bstA+$bstAm+$bstBP+$bstB+$bstBm+$bstCp+$bstC+$bstCm+$bstDp+$bstD+$bstDm+$bstE;
	
	$totalfrenchPoints=$frenchpoA+$frenchpoAm+$frenchpoBP+$frenchpoB+$frenchpoBm+$frenchpoCp+$frenchpoC+$frenchpoCm+$frenchpoDp+$frenchpoD+$frenchpoDm+$frenchpoE;
	
	$totalhomePoints=$homepoA+$homepoAm+$homepoBP+$homepoB+$homepoBm+$homepoCp+$homepoC+$homepoCm+$homepoDp+$homepoD+$homepoDm+$homepoE;
	
	$totalcomputerPoints=$computerpoA+$computerpoAm+$computerpoBP+$computerpoB+$computerpoBm+$computerpoCp+$computerpoC+$computerpoCm+$computerpoDp+$computerpoD+$computerpoDm+$computerpoE;
	
	
	
	if ($frenchStudents == 0){
	     $frenchmean = "-";
	}else{
	      $frenchmean = round_up ( $totalfrenchPoints/$frenchStudents, 3 );
	}
	
	if($homeStudents == 0 ){
	$homemean = "-";
	
	}else {
	
	$homemean = round_up ( $totalhomePoints/$homeStudents, 3 );
	}
	
	if($computerStudents == 0) {
	$computermean = "-";
	
	}else{
	$computermean = round_up ( $totalcomputerPoints/$computerStudents, 3 );
	
	
	}
	
	
	
	$engmean=round_up ( $totalEnglishPoints/$studentsare, 3 );
	$kismean=round_up ( $totalKiswahiliPoints/$studentsare, 3 );
	$mathmean=round_up ( $totalMathPoints/$studentsare, 3 );
	
	
	
	
	if($biologyStudents==0){
	$biomean=0;
	}else{
	$biomean=round_up ( $totalBioPoints/$biologyStudents, 3 );
	}
	if($chemistryStudents==0){
	$chemmean=0;
	}else{
	$chemmean=round_up ( $totalChemPoints/$chemistryStudents, 3 );
	}
	if($physicsStudents==0){
	$phymean=0;
	}else{
	$phymean=round_up ( $totalPhysPoints/$physicsStudents, 3 );
	}
	if($historyStudents==0){
	$hismean=0;
	}else{
	$hismean=round_up ( $totalHisPoints/$historyStudents, 3 );
	}
	if($geographyStudents==0){
	$geomean=0;
	}else{
	$geomean=round_up ( $totalGeoPoints/$geographyStudents, 3 );
	}
	if($creStudents==0){
	$cremean=0;
	}else{
	$cremean=round_up ( $totalCrePoints/$creStudents, 3 );
	}
	if($agrStudents==0){
	$agrmean=0;
	}else{
	$agrmean=round_up ( $totalAgrPoints/$agrStudents, 3 );
	}
	if($bstStudents==0){
	$bstmean=0;
	}else{
	$bstmean=round_up ( $totalBstPoints/$bstStudents, 3 );
	}
	 
	    $efinalgrade = $stally -> getFinalGrate($engmean);
		$kfinalgrade = $stally -> getFinalGrate($kismean);
		$mfinalgrade = $stally -> getFinalGrate($mathmean);
		$bfinalgrade = $stally -> getFinalGrate($biomean); 
		$chemfinalgrade = $stally -> getFinalGrate($chemmean);
		$phyfinalgrade = $stally -> getFinalGrate($phymean);
	    $hisfinalgrade = $stally -> getFinalGrate($hismean);
	    $geofinalgrade  = $stally -> getFinalGrate($geomean);
	    $crefinalgrade = $stally -> getFinalGrate($cremean);
		$agrfinalgrade = $stally -> getFinalGrate($agrmean);
		$bstfinalgrade = $stally -> getFinalGrate($bstmean);
		
		$frenchfinalgrade = $stally -> getFinalGrate($frenchmean);
		$homefinalgrade = $stally -> getFinalGrate($homemean);
		$computerfinalgrade = $stally -> getFinalGrate($computermean);
	
  $pdf->AddPage('L');
$pdf->setXY(20, 40);
$pdf->setFont("times","","11");
	$pdf->Cell(232, 10, "SUBJECTS MEAN PERFORMANCE SUMMARY", 1, 0, "L", 1);
	$pdf->Ln(10);
	$pdf->setX(20);
	$pdf->Cell(40, 7, "Subject", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "A", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "A-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "B+", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "B", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "B-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "C+", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "C", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "C-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "D+", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "D", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "D-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "E", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Points", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Students", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Mean", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Grade", 1, 0, "L", 1);
	$pdf->Ln();
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
	
	
	
	$analysis="select * from  totalygradedcatsubjectsanalysis where form='$form' and stream='$strmpassed' and term='$term' and year='$year' order by meanscore desc";
	$resultanalysis = mysql_query($analysis);
	while ($rowan = mysql_fetch_array($resultanalysis)) {
	
	$pdf->Cell(40, 7, $rowan['subject'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['A'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['A_m'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['B_p'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['B'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['B_m'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['C_p'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['C'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['C_m'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['D_p'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['D'],  1, 0, "L", $fill);	
	$pdf->Cell(10, 7, $rowan['D_m'],  1, 0, "L", $fill);
	$pdf->Cell(10, 7, $rowan['E'],  1, 0, "L", $fill);
	$pdf->Cell(18, 7, $rowan['points'],  1, 0, "R", $fill);
	$pdf->Cell(18, 7, $rowan['students'],  1, 0, "C", $fill);
	$pdf->Cell(18, 7, $rowan['meanscore'],  1, 0, "R", $fill);
	$pdf->Cell(18, 7, $rowan['grade'],  1, 0, "C", $fill);
	
	$y += 7;
	$fill=!$fill;
	if ($y > 180){
		$pdf->AddPage('L');
		$pdf->SetFillColor(204,255,204); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(20, 40);
	$pdf->Cell(40, 7, "Subject", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "A", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "A-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "B", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "B+", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "B-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "C+", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "C", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "C-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "D", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "D+", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "D-", 1, 0, "L", 1);
	$pdf->Cell(10, 7, "E", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Points", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Students", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Mean", 1, 0, "L", 1);
	$pdf->Cell(18, 7, "Grade", 1, 0, "L", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
	
	}              

 
$pdf->Output();

?>