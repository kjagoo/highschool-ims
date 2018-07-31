<?php

//require('fpdf.php');
include('includes/dbconnector.php');
include 'includes/DAO.php';
include 'includes/SubjectTally.php';
require('rotation.php');

class PDF extends PDF_Rotate{

function RotatedText($xx, $yy, $txt, $angle){
		//Text rotated around its origin
		$this->Rotate($angle,$xx,$yy);
		$this->Text($xx,$yy,$txt);
		$this->Rotate(0);
	}
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
	$this->Image($logo,20,10,30,28);
	$this->Image($barcode,200,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(201, 25, $hcode);
	$this->SetFont('times', '', 12);
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address);
	$this->Text(70, 27,'Telephone:  '.$tele);
	$this->Text(75, 35, 'General Exams Comparative Subjects Analysis Form '.$form.' Term '.$term.' Year '.$year);
  
    $this->Ln(20);
}
//Page footer
	function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
}
	
}
function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}


$pdf = new PDF();
//$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
$pdf->open();


$form=$_GET['form'];
	$strm=$_GET['class'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	$positionby=$_GET['amode'];
	//$mode=$_GET['mode'];


if($positionby=="marks"){
		$positionby="average";
		$alternatepositionby="averagepoints";
	}
	if($positionby=="points"){
		$positionby="averagepoints";
		$alternatepositionby="average";
	}
	
	

	$ototalEnglishPoints=0;
	$ototalKiswahiliPoints=0;
	$ototalMathPoints=0;
	$ototalBioPoints=0;
	$ototalChemPoints=0;
	$ototalPhysPoints=0;
	$ototalHisPoints=0;
	$ototalGeoPoints=0;
	$ototalCrePoints=0;
	$ototalAgrPoints=0;
	$ototalBstPoints=0;
	$ototalfrenchPoints=0;
	$ototalhomePoints=0;
	$ototalcomputerPoints=0;
	
	
	$ostudentsare=0;
	$obiologyStudents=0;
	$ochemistryStudents=0;
	$ophysicsStudents=0;
	$ohistoryStudents=0;
	$ogeographyStudents=0;
	$ocreStudents=0;
	$oagrStudents=0;
	$obstStudents=0;
	$ofrenchStudents=0;
	$ohomeStudents=0;
	$ocomputerStudents=0;
	
	$oengmean=0;
	$okismean=0;
	$omathmean=0;
	$obiomean=0;
	$ochemmean=0;
	$ophymean=0;
	$ohismean=0;
	$ogeomean=0;
	$ocremean=0;
	$oagrmean=0;
	$obstmean=0;
	$ofrenchmean=0;
	$ohomemean=0;
	$ocomputermean=0;
	
	
	$oefinalgrade=0;
	$okfinalgrade=0;
	$omfinalgrade=0;
	$obfinalgrade=0;
	$ochemfinalgrade=0;
	$ophyfinalgrade=0;
	$ohisfinalgrade=0;
	$ogeofinalgrade=0;
	$ocrefinalgrade=0;
	$oagrfinalgrade=0;
	$obstfinalgrade=0;
	$ofrenchfinalgrade=0;
	$ohomefinalgrade=0;
	$ocomputerfinalgrade=0;
			
	$classmeanscore=0;
	$classmeanscoreAll=0;
	$overall=0;
	$fms=0;
		
	$q="select distinct classin, (sum(averagepoints)/ count(adm)) as mean,  count(adm) as stds from totalygradedmarks where tgrade!='F' and form='$form' and term='$term' and year='$year' group by classin asc";	
	$mes=mysql_query($q);
	while ($qs = mysql_fetch_array($mes)) { 
	$fms++;
	$stream=$qs['classin'];	
	
	$classmeanscore=round_up($qs['mean'],3);
	$overall+=round_up ($qs['mean'],3);
	
	
	$studentsare=0;
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream'");
	while ($rowstud = mysql_fetch_array($getstudents)) {// get admno
	$studentsare=$rowstud['adms'];
	}
	
	
	
	
		
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
	
	
	$englishtallys = $stally -> getGradesPerSubject("english","englishgrade", $term,$year,$form,$stream); 
	
	
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
	
	$frenchtallys = $stally -> getGradesPerSubject("french","frenchgrade", $term,$year,$form,$stream); 
	
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
	
	$hometallys = $stally -> getGradesPerSubject("home","homegrade", $term,$year,$form,$stream); 
	
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
	
	$computertallys = $stally -> getGradesPerSubject("computer","computergrade", $term,$year,$form,$stream); 
	
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



	
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','A',$term,$year,$form," and classin='$stream'");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','A-',$term,$year,$form," and classin='$stream'");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	

		$kistally=$stally->getSubjectTally('kiswahiligrade','B+',$term,$year,$form," and classin='$stream'");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','B',$term,$year,$form," and classin='$stream'");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','B-',$term,$year,$form," and classin='$stream'");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','C+',$term,$year,$form," and classin='$stream'");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','C',$term,$year,$form," and classin='$stream'");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','C-',$term,$year,$form," and classin='$stream'");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','D+',$term,$year,$form," and classin='$stream'");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','D',$term,$year,$form," and classin='$stream'");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','D-',$term,$year,$form," and classin='$stream'");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	
		$kistally=$stally->getSubjectTally('kiswahiligrade','E',$term,$year,$form," and classin='$stream'");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','A',$term,$year,$form," and classin='$stream'");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','A-',$term,$year,$form," and classin='$stream'");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B+',$term,$year,$form," and classin='$stream'");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B',$term,$year,$form," and classin='$stream'");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B-',$term,$year,$form," and classin='$stream'");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C+',$term,$year,$form," and classin='$stream'");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C',$term,$year,$form," and classin='$stream'");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C-',$term,$year,$form," and classin='$stream'");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D+',$term,$year,$form," and classin='$stream'");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D',$term,$year,$form," and classin='$stream'");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D-',$term,$year,$form," and classin='$stream'");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','E',$term,$year,$form," and classin='$stream'");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	
		$biotally=$stally->getSubjectTally('biologygrade','A',$term,$year,$form," and classin='$stream'");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	
		$biotally=$stally->getSubjectTally('biologygrade','A-',$term,$year,$form," and classin='$stream'");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	
		$biotally=$stally->getSubjectTally('biologygrade','B+',$term,$year,$form," and classin='$stream'");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	
		$biotally=$stally->getSubjectTally('biologygrade','B',$term,$year,$form," and classin='$stream'");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	
		$biotally=$stally->getSubjectTally('biologygrade','B-',$term,$year,$form," and classin='$stream'");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	
		$biotally=$stally->getSubjectTally('biologygrade','C+',$term,$year,$form," and classin='$stream'");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	
		$biotally=$stally->getSubjectTally('biologygrade','C',$term,$year,$form," and classin='$stream'");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	
		$biotally=$stally->getSubjectTally('biologygrade','C-',$term,$year,$form," and classin='$stream'");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	
		$biotally=$stally->getSubjectTally('biologygrade','D+',$term,$year,$form," and classin='$stream'");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	
		$biotally=$stally->getSubjectTally('biologygrade','D',$term,$year,$form," and classin='$stream'");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	
		$biotally=$stally->getSubjectTally('biologygrade','D-',$term,$year,$form," and classin='$stream'");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	
		$biotally=$stally->getSubjectTally('biologygrade','E',$term,$year,$form," and classin='$stream'");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	
	
	$biologyStudents=0;
	
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and biology>0");
	
	while ($rowbiostud = mysql_fetch_array($getbiostudents)) {// get admno
	$biologyStudents=$rowbiostud['adms'];
	}
	
	/***************** GET CHEMISTRY GRADES *******************/
	
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','A',$term,$year,$form," and classin='$stream'");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','A-',$term,$year,$form," and classin='$stream'");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','B+',$term,$year,$form," and classin='$stream'");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','B',$term,$year,$form," and classin='$stream'");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','B-',$term,$year,$form," and classin='$stream'");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','C+',$term,$year,$form," and classin='$stream'");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','C',$term,$year,$form," and classin='$stream'");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','C-',$term,$year,$form," and classin='$stream'");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','D+',$term,$year,$form," and classin='$stream'");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','D',$term,$year,$form," and classin='$stream'");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','D-',$term,$year,$form," and classin='$stream'");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	
		$chemtally=$stally->getSubjectTally('chemistrygrade','E',$term,$year,$form," and classin='$stream'");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	
	$chemistryStudents=0;
	
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and chemistry>0");
	
	while ($rowchemstud = mysql_fetch_array($getchemstudents)) {// get admno
	$chemistryStudents=$rowchemstud['adms'];
	}

	/************************ GET PHYSICS GRADES *************************************/
	
		$phytally=$stally->getSubjectTally('physicsgrade','A',$term,$year,$form," and classin='$stream'");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	
		$phytally=$stally->getSubjectTally('physicsgrade','A-',$term,$year,$form," and classin='$stream'");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	
		$phytally=$stally->getSubjectTally('physicsgrade','B+',$term,$year,$form," and classin='$stream'");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	
		$phytally=$stally->getSubjectTally('physicsgrade','B',$term,$year,$form," and classin='$stream'");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	
		$phytally=$stally->getSubjectTally('physicsgrade','B-',$term,$year,$form," and classin='$stream'");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	
		$phytally=$stally->getSubjectTally('physicsgrade','C+',$term,$year,$form," and classin='$stream'");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	
		$phytally=$stally->getSubjectTally('physicsgrade','C',$term,$year,$form," and classin='$stream'");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	
		$phytally=$stally->getSubjectTally('physicsgrade','C-',$term,$year,$form," and classin='$stream'");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	
		$phytally=$stally->getSubjectTally('physicsgrade','D+',$term,$year,$form," and classin='$stream'");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	
		$phytally=$stally->getSubjectTally('physicsgrade','D',$term,$year,$form," and classin='$stream'");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	
		$phytally=$stally->getSubjectTally('physicsgrade','D-',$term,$year,$form," and classin='$stream'");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	
		$phytally=$stally->getSubjectTally('physicsgrade','E',$term,$year,$form," and classin='$stream'");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	
	$physicsStudents=0;
	
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and physics>0");
	
	while ($rowphystud = mysql_fetch_array($getphystudents)) {// get admno
	$physicsStudents=$rowphystud['adms'];
	}
	
	/************************* GET HISTORY GRADES ***************************************/
	
		$histally=$stally->getSubjectTally('historygrade','A',$term,$year,$form," and classin='$stream'");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	
		$histally=$stally->getSubjectTally('historygrade','A-',$term,$year,$form," and classin='$stream'");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	
		$histally=$stally->getSubjectTally('historygrade','B+',$term,$year,$form," and classin='$stream'");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	
		$histally=$stally->getSubjectTally('historygrade','B',$term,$year,$form," and classin='$stream'");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	
		$histally=$stally->getSubjectTally('historygrade','B-',$term,$year,$form," and classin='$stream'");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	
		$histally=$stally->getSubjectTally('historygrade','C+',$term,$year,$form," and classin='$stream'");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	
		$histally=$stally->getSubjectTally('historygrade','C',$term,$year,$form," and classin='$stream'");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	
		$histally=$stally->getSubjectTally('historygrade','C-',$term,$year,$form," and classin='$stream'");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	
		$histally=$stally->getSubjectTally('historygrade','D+',$term,$year,$form," and classin='$stream'");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	
		$histally=$stally->getSubjectTally('historygrade','D',$term,$year,$form," and classin='$stream'");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	
		$histally=$stally->getSubjectTally('historygrade','D-',$term,$year,$form," and classin='$stream'");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	
		$histally=$stally->getSubjectTally('historygrade','E',$term,$year,$form," and classin='$stream'");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	
	$historyStudents=0;
	
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and history>0");
	
	while ($rowhisstud = mysql_fetch_array($gethisstudents)) {// get admno
	$historyStudents=$rowhisstud['adms'];
	}
	/*************************** GET GEOGRAPHY GRADES *****************************/
	
		$geotally=$stally->getSubjectTally('geographygrade','A',$term,$year,$form," and classin='$stream'");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	
		$geotally=$stally->getSubjectTally('geographygrade','A-',$term,$year,$form," and classin='$stream'");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	
		$geotally=$stally->getSubjectTally('geographygrade','B+',$term,$year,$form," and classin='$stream'");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	
		$geotally=$stally->getSubjectTally('geographygrade','B',$term,$year,$form," and classin='$stream'");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	
		$geotally=$stally->getSubjectTally('geographygrade','B-',$term,$year,$form," and classin='$stream'");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	
		$geotally=$stally->getSubjectTally('geographygrade','C+',$term,$year,$form," and classin='$stream'");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	
		$geotally=$stally->getSubjectTally('geographygrade','C',$term,$year,$form," and classin='$stream'");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	
		$geotally=$stally->getSubjectTally('geographygrade','C-',$term,$year,$form," and classin='$stream'");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	
		$geotally=$stally->getSubjectTally('geographygrade','D+',$term,$year,$form," and classin='$stream'");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	
		$geotally=$stally->getSubjectTally('geographygrade','D',$term,$year,$form," and classin='$stream'");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	
		$geotally=$stally->getSubjectTally('geographygrade','D-',$term,$year,$form," and classin='$stream'");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	
		$geotally=$stally->getSubjectTally('geographygrade','E',$term,$year,$form," and classin='$stream'");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	
	$geographyStudents=0;
	
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and geography>0");
	
	while ($rowgeostud = mysql_fetch_array($getgeostudents)) {// get admno
	$geographyStudents=$rowgeostud['adms'];
	}
	
	/************************* GET CRE GRADES  *****************************/
	
		$cretally=$stally->getSubjectTally('cregrade','A',$term,$year,$form," and classin='$stream'");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	
		$cretally=$stally->getSubjectTally('cregrade','A-',$term,$year,$form," and classin='$stream'");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	
		$cretally=$stally->getSubjectTally('cregrade','B+',$term,$year,$form," and classin='$stream'");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	
		$cretally=$stally->getSubjectTally('cregrade','B',$term,$year,$form," and classin='$stream'");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	
		$cretally=$stally->getSubjectTally('cregrade','B-',$term,$year,$form," and classin='$stream'");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	
		$cretally=$stally->getSubjectTally('cregrade','C+',$term,$year,$form," and classin='$stream'");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	
		$cretally=$stally->getSubjectTally('cregrade','C',$term,$year,$form," and classin='$stream'");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	
		$cretally=$stally->getSubjectTally('cregrade','C-',$term,$year,$form," and classin='$stream'");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	
		$cretally=$stally->getSubjectTally('cregrade','D+',$term,$year,$form," and classin='$stream'");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	
		$cretally=$stally->getSubjectTally('cregrade','D',$term,$year,$form," and classin='$stream'");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	
		$cretally=$stally->getSubjectTally('cregrade','D-',$term,$year,$form," and classin='$stream'");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	
		$cretally=$stally->getSubjectTally('cregrade','E',$term,$year,$form," and classin='$stream'");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	
	
	$creStudents=0;
	
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and cre>0");
	
	while ($rowcrestud = mysql_fetch_array($getcrestudents)) {// get admno
	$creStudents=$rowcrestud['adms'];
	}
	/*********************** GET AGRICULTURE GRADES *******************************/
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','A',$term,$year,$form," and classin='$stream'");
		$agras=$agrtally['tally'];
		$agrA=$agras*12;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','A-',$term,$year,$form," and classin='$stream'");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','B+',$term,$year,$form," and classin='$stream'");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','B',$term,$year,$form," and classin='$stream'");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','B-',$term,$year,$form," and classin='$stream'");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','C+',$term,$year,$form," and classin='$stream'");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','C',$term,$year,$form," and classin='$stream'");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','C-',$term,$year,$form," and classin='$stream'");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','D+',$term,$year,$form," and classin='$stream'");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','D',$term,$year,$form," and classin='$stream'");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','D-',$term,$year,$form," and classin='$stream'");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	
		$agrtally=$stally->getSubjectTally('agriculturegrade','E',$term,$year,$form," and classin='$stream'");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	
	
	$agrStudents=0;
	
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and agriculture>0");
	
	while ($rowagrstud = mysql_fetch_array($getagrstudents)) {// get admno
	$agrStudents=$rowagrstud['adms'];
	}
	
	/*********************** GET BUSINESS GRADES****************************/
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','A',$term,$year,$form," and classin='$stream'");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','A-',$term,$year,$form," and classin='$stream'");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B+',$term,$year,$form," and classin='$stream'");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B',$term,$year,$form," and classin='$stream'");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B-',$term,$year,$form," and classin='$stream'");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C+',$term,$year,$form," and classin='$stream'");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C',$term,$year,$form," and classin='$stream'");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C-',$term,$year,$form," and classin='$stream'");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D+',$term,$year,$form," and classin='$stream'");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D',$term,$year,$form," and classin='$stream'");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D-',$term,$year,$form," and classin='$stream'");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','E',$term,$year,$form," and classin='$stream'");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	
	
	
	$bstStudents=0;
	
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and businesStudies>0");
	
	while ($rowbststud = mysql_fetch_array($getbststudents)) {// get admno
	$bstStudents=$rowbststud['adms'];
	}
	
	
	$frenchStudents=0;
	
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and french > 0");
	
	while ($rowbststud = mysql_fetch_array($getfrenchStudents)) {// get admno
	$frenchStudents=$rowbststud['adms'];
	}
	
	
	$homeStudents=0;
	
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and home>0");
	
	while ($rowbststud = mysql_fetch_array($gethomeStudents)) {// get admno
	$homeStudents=$rowbststud['adms'];
	}
	
	
	$computerStudents=0;
	
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and computer>0");
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
		
		    
		/***********************************************************************************/
		
		
		/***********************************************************************************/
		if($form==1){
$myform='FORM 1';
}
if($form==2){
$myform='FORM 2';
}
if($form==3){
$myform='FORM 3';
}
if($form==4){
$myform='FORM 4';
}
	$enginitials="-";
	$engint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='English'");
	while ($roweng = mysql_fetch_array($engint)) {// get admno
	$enginitials=$roweng['initials'];
	}
	$kisinitials="-";
	$kisint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='kiswahili'");
	while ($rowkis = mysql_fetch_array($kisint)) {// get admno
	$kisinitials=$rowkis['initials'];
	}
	$mathinitials="-";
	$mathint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='math'");
	while ($rowmath = mysql_fetch_array($mathint)) {// get admno
	$mathinitials=$rowmath['initials'];
	}
	$bioinitials="-";
	$bioint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='biology'");
	while ($rowbio = mysql_fetch_array($bioint)) {// get admno
	$bioinitials=$rowbio['initials'];
	}
	$cheminitials="-";
	$chemint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='chemistry'");
	while ($rowchem = mysql_fetch_array($chemint)) {// get admno
	$cheminitials=$rowchem['initials'];
	}
	$phyinitials="-";
	$phyint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='physics'");
	while ($rowphy = mysql_fetch_array($phyint)) {// get admno
	$phyinitials=$rowphy['initials'];
	}
	$hisinitials="-";
	$hisint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='History'");
	while ($rowhis = mysql_fetch_array($hisint)) {// get admno
	$hisinitials=$rowhis['initials'];
	}
	
	$geoinitials="-";
	$geoint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='geography'");
	while ($rowgeo = mysql_fetch_array($geoint)) {// get admno
	$geoinitials=$rowgeo['initials'];
	}
	$creinitials="-";
	$creint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='cre'");
	while ($rowcre = mysql_fetch_array($creint)) {// get admno
	$creinitials=$rowcre['initials'];
	}
	$agrinitials="-";
	$agrint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='agriculture'");
	while ($rowagr = mysql_fetch_array($agrint)) {// get admno
	$agrinitials=$rowagr['initials'];
	}
	$bstinitials="-";
	$bstint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='bstudies'");
	while ($rowbst = mysql_fetch_array($bstint)) {// get admno
	$bstinitials=$rowbst['initials'];
	}
	$homeinitials="-";
	$homeint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='Homescience'");
	while ($rowhome = mysql_fetch_array($homeint)) {// get admno
	$homeinitials=$rowhome['initials'];
	}
	
	$compinitials="-";
	$compint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='Computer'");
	while ($rowcomp = mysql_fetch_array($compint)) {// get admno
	$compinitials=$rowcomp['initials'];
	}
	$freinitials="-";
	$freint=mysql_query("select initials from initials where  form='$myform' and stream='$stream' and subject='French'");
	while ($rowfre = mysql_fetch_array($freint)) {// get admno
	$freinitials=$rowfre['initials'];
	}
		
		/************************************************************************************/
		$pdf->addPage('L');
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 $y = $pdf->GetY();
$x = 15;
$pdf->setXY($x, $y);
$fill=0;
 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	 	
//table header
$pdf->SetFillColor(204,255,204); //gray
$pdf->setFont("times","","10");
$pdf->setXY(15, 40);

	$pdf->setFont("times","","9");
	$pdf->Cell(260, 10, "Comparative Subject Analysis Form $form $stream   :    Class Mean Score:        $classmeanscore", 1, 0, "L", 1);
	$pdf->Ln(10);
	$pdf->setX(15);
	$pdf->Cell(20, 6, " ", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "ENG", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "KIS", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "MATH", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "BIO", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "PHY", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "CHEM", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "HIS", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "GEO", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "CRE", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "AGR", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "BST", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "H/SCI", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "COMP", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "FRE", 1, 0, "L", 1);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Total Pts", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalEnglishPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalKiswahiliPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalMathPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalBioPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalPhysPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalChemPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalHisPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalGeoPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalCrePoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalAgrPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalBstPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalhomePoints, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $totalcomputerPoints, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $totalfrenchPoints, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Students", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $studentsare, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $studentsare, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $studentsare, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biologyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $physicsStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemistryStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $historyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geographyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $creStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homeStudents, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerStudents, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frenchStudents, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Mean", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $engmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kismean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biomean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phymean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hismean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geomean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $cremean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homemean, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computermean, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frenchmean, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Grade", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $efinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geofinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crefinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homefinalgrade, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frenchfinalgrade, 1, 0, "L", 0);
	
	
	$pdf->Ln(10);
	$pdf->SetFont('arial','',12);
	$pdf->SetTextColor(0,0,0,0);
	$pdf->RotatedText(40,82,$enginitials,280);
	$pdf->RotatedText(60,82,$kisinitials,280);
	$pdf->RotatedText(75,82,$mathinitials,280);
	$pdf->RotatedText(95,82,$bioinitials,280);	
	$pdf->RotatedText(110,82,$phyinitials,280);	
	$pdf->RotatedText(125,82,$cheminitials,280);
	$pdf->RotatedText(145,82,$hisinitials,280);
	$pdf->RotatedText(160,82,$geoinitials,280);
	$pdf->RotatedText(177,82,$creinitials,280);
	$pdf->RotatedText(195,82,$agrinitials,280);
	$pdf->RotatedText(210,82,$bstinitials,280);
	$pdf->RotatedText(230,82,$homeinitials,280);	
	$pdf->RotatedText(245,82,$compinitials,280);
	$pdf->RotatedText(265,82,$freinitials,280);

	$y +=10;
	$fill=!$fill;

	$pdf->setX(15);



	$ototalEnglishPoints+=$totalEnglishPoints;
	$ototalKiswahiliPoints+=$totalKiswahiliPoints;
	$ototalMathPoints+=$totalMathPoints;
	$ototalBioPoints+=$totalBioPoints;
	$ototalChemPoints+=$totalChemPoints;
	$ototalPhysPoints+=$totalPhysPoints;
	$ototalHisPoints+=$totalHisPoints;
	$ototalGeoPoints+=$totalGeoPoints;
	$ototalCrePoints+=$totalCrePoints;
	$ototalAgrPoints+=$totalAgrPoints;
	$ototalBstPoints+=$totalBstPoints;
	$ototalfrenchPoints+=$totalfrenchPoints;
	$ototalhomePoints+=$totalhomePoints;
	$ototalcomputerPoints+=$totalcomputerPoints;
	
	
	$ostudentsare+=$studentsare;
	$obiologyStudents+=$biologyStudents;
	$ochemistryStudents+=$chemistryStudents;
	$ophysicsStudents+=$physicsStudents;
	$ohistoryStudents+=$historyStudents;
	$ogeographyStudents+=$geographyStudents;
	$ocreStudents+=$creStudents;
	$oagrStudents+=$agrStudents;
	$obstStudents+=$bstStudents;
	$ofrenchStudents+=$frenchStudents;
	$ohomeStudents+=$homeStudents;
	$ocomputerStudents+=$computerStudents;
	
	
	$oengmean=round_up($ototalEnglishPoints/$ostudentsare,3);
	$okismean=round_up($ototalKiswahiliPoints/$ostudentsare,3);
	$omathmean=round_up($ototalMathPoints/$ostudentsare,3);
	
	if($obiologyStudents==0){
	$obiomean=0;
	}else{
	$obiomean=round_up($ototalBioPoints/$obiologyStudents,3);
	}
	if($ochemistryStudents==0){
	$ochemmean=0;
	}else{
	$ochemmean=round_up($ototalChemPoints/$ochemistryStudents,3);
	}
	if($ophysicsStudents==0){
	$ophymean=0;
	}else{
	$ophymean=round_up($ototalPhysPoints/$ophysicsStudents,3);
	}
	if($ohistoryStudents==0){
	$ohismean=0;
	}else{
	$ohismean=round_up($ototalHisPoints/$ohistoryStudents,3);
	}
	if($ogeographyStudents==0){
	$ogeomean=0;
	}else{
	$ogeomean=round_up($ototalGeoPoints/$ogeographyStudents,3);
	}
	if($ocreStudents==0){
	$ocremean=0;
	}else{
	$ocremean=round_up($ototalCrePoints/$ocreStudents,3);
	}
	if($oagrStudents==0){
	$oagrmean=0;
	}else{
	$oagrmean=round_up($ototalAgrPoints/$oagrStudents,3);
	}
	if($obstStudents==0){
	$obstmean=0;
	}else{
	$obstmean=round_up($ototalBstPoints/$obstStudents,3);
	}
	if ($ofrenchStudents == 0){
	     $ofrenchmean = "-";
	}else{
	     $ofrenchmean=round_up($ototalfrenchPoints/$ofrenchStudents,3);
	}
	if($ohomeStudents == 0 ){
	$ohomemean = "-";
	}else {
	$ohomemean=round_up($ototalhomePoints/$ohomeStudents,3);
	}
	
	if($ocomputerStudents == 0) {
	$ocomputermean = "-";
	
	}else{
	$ocomputermean=round_up($ototalcomputerPoints/$ocomputerStudents,3);
	}
	
	
	
	
		$oefinalgrade = $stally -> getFinalGrate($oengmean);
		$okfinalgrade = $stally -> getFinalGrate($okismean);
		$omfinalgrade = $stally -> getFinalGrate($omathmean);
		$obfinalgrade = $stally -> getFinalGrate($obiomean); 
		$ochemfinalgrade = $stally -> getFinalGrate($ochemmean);
		$ophyfinalgrade = $stally -> getFinalGrate($ophymean);
	    $ohisfinalgrade = $stally -> getFinalGrate($ohismean);
	    $ogeofinalgrade  = $stally -> getFinalGrate($ogeomean);
	    $ocrefinalgrade = $stally -> getFinalGrate($ocremean);
		$oagrfinalgrade = $stally -> getFinalGrate($oagrmean);
		$obstfinalgrade = $stally -> getFinalGrate($obstmean);
		$ofrenchfinalgrade = $stally -> getFinalGrate($ofrenchmean);
		$ohomefinalgrade = $stally -> getFinalGrate($ohomemean);
		$ocomputerfinalgrade = $stally -> getFinalGrate($ocomputermean);
	
	
}//end of while getting each stream
$classmeanscoreAll=round_up (($overall/$fms),3);


		$pdf->AddPage('L');
		$pdf->SetFillColor(204,255,204); //gray
		$pdf->setFont("times","","9");
		$pdf->setXY(15, 40);

$pdf->setFont("times","","9");
	$pdf->Cell(260, 10, "Overall Class Comparative Subject Analysis Form $form", 1, 0, "L", 1);
	$pdf->Ln(10);
	$pdf->setX(15);
	$pdf->Cell(20, 6, " ", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "ENG", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "KIS", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "MATH", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "BIO", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "PHY", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "CHEM", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "HIS", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "GEO", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "CRE", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "AGR", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "BST", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "H/SCI", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "COMP", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "FRE", 1, 0, "L", 1);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Total Pts", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalEnglishPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalKiswahiliPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalMathPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalBioPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalPhysPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalChemPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalHisPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalGeoPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalCrePoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalAgrPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalBstPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ototalhomePoints, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ototalcomputerPoints, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ototalfrenchPoints, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Students", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ostudentsare, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ostudentsare, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ostudentsare, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $obiologyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ophysicsStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ochemistryStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ohistoryStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ogeographyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ocreStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $oagrStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $obstStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ohomeStudents, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ocomputerStudents, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ofrenchStudents, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Mean", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $oengmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $okismean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $omathmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $obiomean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ophymean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ochemmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ohismean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ogeomean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ocremean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $oagrmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $obstmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ohomemean, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ocomputermean, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ofrenchmean, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Grade", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $oefinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $okfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $omfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $obfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ophyfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ochemfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ohisfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ogeofinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ocrefinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $oagrfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $obstfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $ohomefinalgrade, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ocomputerfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $ofrenchfinalgrade, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(71, 6, "Class Mean Score:        $classmeanscoreAll", 1, 0, "L", 0);
	$pdf->Ln(10);
	

	
$pdf->Output();

?>