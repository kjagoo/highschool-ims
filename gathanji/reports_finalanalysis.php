<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  
 
 
 include 'includes/Grading.php';
 $grading = new Grading();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
</style>
<link href='css/opa-icons.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );
function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}
function download(){
	window.location='licenses.xls';
}

var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function commonFunction(id){
loadXMLDoc(id,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("new_Area").innerHTML=xmlhttp.responseText;
    }
  });
}
	
	printDivCSS = new String ('<link rel="stylesheet" href="media/css/jquery.dataTables.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	window.frames["print_frame"].document.getElementById('example').border="1px #FF0000 solid";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}
	</script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script>
</head>
<body>
<div id="blocker">
  <div><img src="images/loading.gif" />Loading...</div>
</div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="reports_finalanalysis.php">Final Exam Analysis</a></li>
  </ul>
</div>

<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
    <form name="pays" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <table width="100%">
        <tr>
          <td><select name="form" class="select" required>
		   <option value="" >-Form-</option>
              <option value="1" >FORM 1 </option>
              <option value="2" >FORM 2 </option>
              <option value="3" >FORM 3 </option>
              <option value="4" >FORM 4 </option>
            </select>
			<select name="stream" id="select" class="select" >
			<option value="" >-Stream-</option>
			<option value="Entire" >Entire</option>
              <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
            </select>
			</td>
          <td><select name="term" class="select" required>
		  <option value="" >-Term-</option>
              <option value="1" >TERM 1 </option>
              <option value="2" >TERM 2 </option>
              <option value="3" >TERM 3 </option>
            </select>
          </td>
          <td><select name="year" class="select" required>
		  <option value="" >-Year-</option>
              <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select></td>
          
		  <td><select name="gradeby" class="select" required>
		  <option value="" >-Grade Using-</option>
              <option value="marks">Total Marks</option>
              <option value="points">Total Points</option>
            </select>
          </td>
		  <td><select name="mode" class="select" required>
		  <option value="" >-Analysis Mode-</option>
              <option value="normal">Normal</option>
              <option value="knec">Cluster</option>
            </select>
          </td>
          <td align="center"><input type="submit" name="Record" value="View Report" class="btn btn-primary"/></td>
        </tr>
      </table>
    </form>
    </fieldset>
    <?php
if (isset ($_POST['form']) && isset ($_POST['term']) && isset ($_POST['year'])){
$form = $_POST['form'];
$strm=$_POST['stream'];
$year=$_POST['year'];
$term=$_POST['term'];
$positionby=$_POST['gradeby'];
$mode=$_POST['mode'];
//$adm=$_REQUEST['adm'];

//$form=2;
//$term=2;
//$year=2013;
function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}

//$myformis=$form;

//include('dbConnector.php');

if($form==1){
$myform='Form 1';
}
if($form==2){
$myform='Form 2';
}
if($form==3){
$myform='Form 3';
}
if($form==4){
$myform='Form 4';
}
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Generated ".$myform." Yr ".$year."  Trm ".$term." Midterm Reports";
$func->addAuditTrail($activity,$username);

$date=date("j, F, Y");

$getExamstandard = mysql_query("select * from standards where year='$year' and term='$term' and form='$form'");
while ($rows = mysql_fetch_array($getExamstandard)) {
$examstandard=$rows['exam'];
}

	


	$num=0;
	$cat1 = "SELECT admno FROM tbleperformancetrack where form='$form' and year='$year' and term='$term'";
	$result = mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get admno
	$num++;
	$admno=$row['admno'];
	
	
	$getnames = "SELECT fname,sname,lname,class from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$stream=$row2['class'];
	
	//}
	$eng=0;
	$kis=0;
	$math=0;
	$bio=0;
	$chem=0;
	$phy=0;
	$his=0;
	$geo=0;
	$cre=0;
	$agr=0;
	$bst=0;
	$fre=0;
	$comp=0;
	$home=0;
	
	

	$catis = "SELECT * FROM marksemams where form='$form' and term='$term' and year='$year'  and admno='$admno'";
	
	$result0 = mysql_query($catis);
	while ($row0=mysql_fetch_array($result0)) {// get cat1
	
	$eng=($row0['english']/$examstandard)*100;
	$kis=($row0['kiswahili']/$examstandard)*100;
	$math=($row0['math']/$examstandard)*100;
	$bio=($row0['biology']/$examstandard)*100;
	$chem=($row0['chemistry']/$examstandard)*100;
	$phy=($row0['physics']/$examstandard)*100;
	$his=($row0['history']/$examstandard)*100;
	$geo=($row0['geography']/$examstandard)*100;
	$cre=($row0['cre']/$examstandard)*100;
	$agr=($row0['agriculture']/$examstandard)*100;
	$bst=($row0['bstudies']/$examstandard)*100;
	$fre=($row0['french']/$examstandard)*100;
	$comp=($row0['computer']/$examstandard)*100;
	$home=($row0['home']/$examstandard)*100;
	}
	
	
	if($form==1 || $form==2){
	$myf="1-2";
	}else{
	$myf="3-4";
	}
	$engdetails=$grading->getSubjectGrade('ENGLISH',(($eng)),$myf);
	if($eng==0){
	$enggrade="F";
	$epoint=0;
	}else{
	$enggrade=$engdetails['grade'];
	$epoint=$engdetails['point'];
	}

	$kisdetails=$grading->getSubjectGrade('KISWAHILI',(($kis)),$myf);
	if($kis==0){
	$kisgrade="F";
	$kipoint=0;
	}else{
	$kisgrade=$kisdetails['grade'];
	$kipoint=$kisdetails['point'];
	}
	
	$mathdetails=$grading->getSciencesGrade('MATHS',(($math)),$myf);
	if($math==0){
	$mathgrade="F";
	$mathpoint=0;
	}else{
	$mathgrade=$mathdetails['grade'];
	$mathpoint=$mathdetails['point'];
	}
	
	$biodetails=$grading->getSciencesGrade('BIOLOGY',(($bio)),$myf);
	if($bio==0){
	$biograde="-";
	$biopoint=0;
	}else{
	$biograde=$biodetails['grade'];
	$biopoint=$biodetails['point'];
	}
	
	$phydetails=$grading->getSciencesGrade('PHYSICS',(($phy)),$myf);
	if($phy==0){
	$phygrade="-";
	$phypoint=0;
	}else{
	$phygrade=$phydetails['grade'];
	$phypoint=$phydetails['point'];
	}
	
	$chemdetails=$grading->getSciencesGrade('CHEMISTRY',(($chem)),$myf);
	if($chem==0){
	$chemgrade="-";
	$chempoint=0;
	}else{
	$chemgrade=$chemdetails['grade'];
	$chempoint=$chemdetails['point'];
	}
	
	$hisdetails=$grading->getSubjectGrade('HISTORY',(($his)),$myf);
	if($his==0){
	$hisgrade="-";
	$hispoint=0;
	}else{
	$hisgrade=$hisdetails['grade'];
	$hispoint=$hisdetails['point'];
	}
	
	$geodetails=$grading->getSubjectGrade('GEOGRAPHY',(($geo)),$myf);
	if($geo==0){
	$geograde="-";
	$geopoint=0;
	}else{
	$geograde=$geodetails['grade'];
	$geopoint=$geodetails['point'];
	}
	
	$credetails=$grading->getSubjectGrade('CRE',(($cre)),$myf);
	if($cre==0){
	$cregrade="-";
	$crepoint=0;
	}else{
	$cregrade=$credetails['grade'];
	$crepoint=$credetails['point'];
	}
	
	$agrdetails=$grading->getSubjectGrade('AGRICULTURE',(($agr)),$myf);
	if($agr==0){
	$agrgrade="-";
	$agrpoint=0;
	}else{
	$agrgrade=$agrdetails['grade'];
	$agrpoint=$agrdetails['point'];
	}
	
	$bstdetails=$grading->getSubjectGrade('B/STUDIES',(($bst)),$myf);
	if($bst==0){
	$bstgrade="-";
	$bstpoint=0;
	}else{
	$bstgrade=$bstdetails['grade'];
	$bstpoint=$bstdetails['point'];
	}
	
	$fredetails=$grading->getSubjectGrade('FRENCH',(($fre)),$myf);
	if($fre==0){
	$fregrade="-";
	$frepoint=0;
	}else{
	$fregrade=$fredetails['grade'];
	$frepoint=$fredetails['point'];
	}
	
	$compdetails=$grading->getSubjectGrade('COMPUTER',(($comp)),$myf);
	if($comp==0){
	$compgrade="-";
	$comppoint=0;
	}else{
	$compgrade=$compdetails['grade'];
	$comppoint=$compdetails['point'];
	}
	
	$homedetails=$grading->getSubjectGrade('HOME',(($home)),$myf);
	if($home==0){
	$homegrade="-";
	$homepoint=0;
	}else{
	$homegrade=$homedetails['grade'];
	$homepoint=$homedetails['point'];
	}
	
	if($form==1){
	$subjectsDone=11;
	}
	if($form==2){
	$subjectsDone=11;
	}
	if($form==3){
	$subjectsDone=7;
	}
	if($form==4){
	$subjectsDone=7;
	}

	$getsubsdone = "SELECT * from subjectsforstudent where admno='$admno' and year='$year' and term='$term'";// get names
	$Subjectsresult = mysql_query($getsubsdone);
	while ($rowsub = mysql_fetch_array($Subjectsresult)) {// get names
	$subjectsDone=$rowsub['subjects'];	
	}

	if($mode=='normal'){
	$totalpoints1=$epoint+$kipoint+$mathpoint+$biopoint+$chempoint+$phypoint+$hispoint+$geopoint+$crepoint+$agrpoint+$bstpoint+$frepoint+$comppoint+$homepoint;
	$wat1totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst+$fre+$comp+$home;
	$averagepoints=round_up ($totalpoints1/$subjectsDone,3);
	$averagemarks=round_up ( $wat1totals/$subjectsDone, 3 ); // 
	}else{
	
	$numbers1=array($bio,$chem,$phy); //get two sciences
	rsort($numbers1);
	
	$numbers2=array($his,$geo,$cre);//get one humanity
	rsort($numbers2);
	
	$numbers3=array($agr,$bst,$home,$comp,$fre,$numbers1[2],$numbers2[1],$numbers2[2]);//get one from either
	rsort($numbers3);
	
	$points1=array($biopoint,$chempoint,$phypoint);
		rsort($points1);
	$points2=array($hispoint,$geopoint,$crepoint);
		rsort($points2);
	$points3=array($agrpoint,$bstpoint,$homepoint,$comppoint,$frepoint,$points1[2],$points2[1],$points2[2]);
		rsort($points3);
		
	$totalpoints1=$epoint+$kipoint+$mathpoint+$points1[0]+$points1[1]+$points2[0]+$points3[0];
	
	$wat1totals=$eng+$kis+$math+$numbers1[0]+$numbers1[1]+$numbers2[0]+$numbers3[0];
	
	$averagepoints=round_up ( $totalpoints1/7, 3 ); // 	
	$averagemarks=round_up ( $wat1totals/7, 3 ); // 	
	}






if ($averagepoints > 0.00 && $averagepoints <= 1.499) {
			$tfgrade = "E";
			$htremarks="Work harder";
		} else if ($averagepoints >= 1.50 && $averagepoints <= 2.499) {
			$tfgrade = "D-";
			$htremarks="Improve";
		} else if ($averagepoints >= 2.50 && $averagepoints <= 3.499) {
			$tfgrade = "D";
			$htremarks="Improve";
		} else if ($averagepoints >= 3.50 && $averagepoints <= 4.499) {
			$tfgrade = "D+";
			$htremarks="Can do better";
		} else if ($averagepoints >= 4.50 && $averagepoints <= 5.499) {
			$tfgrade = "C-";
			$htremarks="Fair";
		} else if ($averagepoints >= 5.50 && $averagepoints <= 6.499) {
			$tfgrade = "C";
			$htremarks="Fair";
		} else if ($averagepoints >= 6.50 && $averagepoints <= 7.499) {
			$tfgrade = "C+";
			$htremarks="Fair";
		} else if ($averagepoints >= 7.50 && $averagepoints <= 8.499) {
			$tfgrade = "B-";
			$htremarks="Good";
		} else if ($averagepoints >= 8.50 && $averagepoints <= 9.499) {
			$tfgrade = "B";
			$htremarks="Good";
		} else if ($averagepoints >= 9.50 && $averagepoints <= 10.499) {
			$tfgrade = "B+";
			$htremarks="Good";
		} else if ($averagepoints >= 10.50 && $averagepoints <= 11.499) {
			$tfgrade = "A-";
			$htremarks="V. Good";
		} else if ($averagepoints >= 11.50 && $averagepoints <= 12.00) {
			$tfgrade = "A";
			$htremarks="Excellent";
		}else if ($averagepoints == 0.00) {
			$tfgrade = "F";
			
		}

$insert="insert into totalygradedexamanalysis (adm,names
	,eng1,eng1grade,kis1,kis1grade,math1,math1grade,bio1,bio1grade,chem1,chem1grade,phy1,phy1grade,his1,his1grade,geo1,geo1grade,cre1,cre1grade,agr1,agr1grade,bst1,bst1grade,fre1,fre1grade,comp1,comp1grade,home1,home1grade,wat1totals,totalmarks,totalpoints1,averagepoints,average,fgrade,term,year,form,stream)
	values('$admno','$fname $mname $lasname'
	,'$eng','$enggrade','$kis','$kisgrade','$math','$mathgrade','$bio','$biograde','$chem','$chemgrade',
	'$phy','$phygrade','$his','$hisgrade','$geo','$geograde','$cre','$cregrade','$agr','$agrgrade','$bst','$bstgrade','$fre','$fregrade','$comp','$compgrade','$home','$homegrade','$wat1totals','$wat1totals','$totalpoints1','$averagepoints','$averagemarks','$tfgrade','$term','$year','$form','$stream')

on duplicate key update  eng1='$eng', eng1grade='$enggrade', kis1='$kis',kis1grade='$kisgrade',math1='$math',math1grade='$mathgrade', bio1='$bio',bio1grade='$biograde',chem1='$chem',chem1grade='$chemgrade', phy1='$phy',phy1grade='$phygrade',  his1='$his',his1grade='$hisgrade',geo1='$geo',geo1grade='$geograde',cre1='$cre',cre1grade='$cregrade',agr1='$agr',agr1grade='$agrgrade', bst1='$bst',bst1grade='$bstgrade',fre1='$fre',fre1grade='$fregrade',comp1='$comp',comp1grade='$compgrade',home1='$home',home1grade='$homegrade',totalmarks='$wat1totals',wat1totals='$wat1totals',totalpoints1='$totalpoints1',averagepoints='$averagepoints',average='$averagemarks',fgrade='$tfgrade',stream='$stream'";
		
		$querynow=mysql_query($insert);
	if(!$querynow){
	echo"failed". mysql_error();
	}
   }
 }
 
 $numb=0;
 


?>
<div class="clear"></div>
<form  method='get' name='pdiv'>
		 <div id="div_print" style="width:100%">
  <table class="borders" cellpadding="5" cellspacing="0" width="100%">
      <tr style="height:30px;">
        <td class="dataListHeader">Exams Analysis: <?php echo $myform." ".$strm." Term: ".$term." Position By: ".$positionby?>
		<div style=" width:350px; float:right; margin-right:10px;">
		<table width="100%">
		<tr>
		<td align="left"><a href=javascript:printDiv('div_print') title="Print Report"><i class="icon icon-green icon-print"></i>&nbsp;Print Analysis</a></td>
		<td align="right"><a href="pdf_finalanalysis.php?form=<?php echo $form?>&class=<?php echo $strm?>&term=<?php echo $term?>&year=<?php echo $year?>&by=<?php echo $positionby?>&mode=<?php echo $mode?>" title="Print in PDF" target="_blank"><i class="icon icon-green icon-pdf"></i>&nbsp;Print PDF</a></td>
		<td align="right"><a href="send_sms_finalexams.php?form=<?php echo $form?>&class=<?php echo $strm?>&term=<?php echo $term?>&year=<?php echo $year?>&by=<?php echo $positionby?>&mode=<?php echo $mode?>" title="Send Reports as SMS" target="_blank"><i class="icon icon-green icon-envelope-closed"></i>&nbsp;SEND AS SMS</a></td>
		</tr>
		</table>
		</div>
		 </td>
      </tr>
      <tr>
        <td>
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Admno</th>
                <th>Student Full Name</th>
				<th align="left">Cls</th>
                <th align="center" colspan="2">Eng</th>
                <th align="center" colspan="2">Kisw</th>
                <th align="center" colspan="2">Maths</th>
                <th align="center" colspan="2">Bio</th>
                <th align="center" colspan="2">Phy</th>
                <th align="center" colspan="2">Chem</th>
                <th align="center" colspan="2">His</th>
                <th align="center" colspan="2">Geo</th>
                <th align="center" colspan="2">Cre</th>
                <th align="center" colspan="2">Agr</th>
                <th align="center" colspan="2">B/st</th>
				<th align="center" colspan="2">Fre</th>
				<th align="center" colspan="2">Comp</th>
				<th align="center" colspan="2">H/Sci</th>
                <th align="center">Mks</th>
				<th align="center">Pts</th>
				<th align="center">Mss</th>
				<th align="center">GD</th>
				<th align="center">VAP</th>
				<th align="center">P.I</th>
                <th align="right">Pos</th>
				
              </tr>
            </thead>
            <tbody>
              <?php
include 'includes/PerformanceIndicator.php';
	$pin = new PI();
	$pin->getPI($form,$term,$strm,$year,"Exam");

	if($positionby=="marks"){
		$positionby="wat1totals";
		$alternatepositionby="averagepoints";
	}
	if($positionby=='points'){
		$positionby="averagepoints";
		$alternatepositionby="wat1totals";
	}
	
if($strm=="Entire"){
$myquerydis="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum1 FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedexamanalysis` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedexamanalysis` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc";


//$myquerydis="select * from totalygradedmidterm where form='$form' and term='$term' and year='$year' order by $positionby desc,$alternatepositionby desc";
}else{
$myquerydis="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum1 FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedexamanalysis` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' and t1.stream='$strm' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedexamanalysis` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and t2.term='$term' and t2.year='$year' and t2.stream='$strm'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc;";
//$myquerydis="select * from totalygradedmidterm where form='$form' and stream='$strm' and term='$term' and year='$year' order by $positionby desc,$alternatepositionby desc";

}
	$toexecutedis=mysql_query($myquerydis);
	while ($rowdis = mysql_fetch_array($toexecutedis)) {
	$numb++;

$admno=$rowdis['adm'];
$namesare=str_replace("&","'",$rowdis['names']);
$eng=$rowdis['eng1'];
$enggrade=$rowdis['eng1grade'];
$kis=$rowdis['kis1'];
$kisgrade=$rowdis['kis1grade'];
$math=$rowdis['math1'];
$mathgrade=$rowdis['math1grade'];
$bio=$rowdis['bio1'];
$biograde=$rowdis['bio1grade'];
$phy=$rowdis['phy1'];
$phygrade=$rowdis['phy1grade'];
$chem=$rowdis['chem1'];
$chemgrade=$rowdis['chem1grade'];
$his=$rowdis['his1'];
$hisgrade=$rowdis['his1grade'];
$geo=$rowdis['geo1'];
$geograde=$rowdis['geo1grade'];
$cre=$rowdis['cre1'];
$cregrade=$rowdis['cre1grade'];
$agr=$rowdis['agr1'];
$agrgrade=$rowdis['agr1grade'];
$bst=$rowdis['bst1'];
$bstgrade=$rowdis['bst1grade'];
$fre=$rowdis['fre1'];
$fregrade=$rowdis['fre1grade'];
$comp=$rowdis['comp1'];
$compgrade=$rowdis['comp1grade'];
$home=$rowdis['home1'];
$homegrade=$rowdis['home1grade'];
$totals=$rowdis['wat1totals'];
$totalpoints=$rowdis['totalpoints1'];
$mean=$rowdis['averagepoints'];
$grade=$rowdis['fgrade'];
$classin=$rowdis['stream'];


$pi=0;
$vap=0;
	$resultf = mysql_query("select * from totalperformanceindex where adm='$admno' and  year='$year' and form='$form' and term='$term' and exam='Exam'");
	while ($rowf = mysql_fetch_array($resultf)){
	$pi=$rowf['pindex'];
	$vap=$rowf['vap'];
	}

if($bio==0){
	$bio="-";
		}else{
	  $bio=$bio;
	 }
	 if($chem==0){
	$chem="-";
		}else{
	  $chem=$chem;
	 }
	 if($phy==0){
	$phy="-";
		}else{
	  $phy=$phy;
	 }
	 if($his==0){
	$his="-";
		}else{
	  $his=$his;
	 }
	if($geo==0){
	$geo="-";
		}else{
	  $geo=$geo;
	 }
	 if($cre==0){
	$cre="-";
		}else{
	  $cre=$cre;
	 } 
	 if($home==0){
	$home="-";
		}else{
	  $home=$home;
	 }
	  if($agr==0){
	$agr="-";
		}else{
	  $agr=$agr;
	 }
	 if($comp==0){
	$comp="-";
		}else{
	  $comp=$comp;
	 }
	  if($fre==0){
	$fre="-";
		}else{
	  $fre=$fre;
	 }
	  if($bst==0){
	$bst="-";
		}else{
	  $bst=$bst;
	 }
?>
<tr>
	
		<td><?php echo $admno?></td> 
		<td><?php echo $namesare?></td>
		<td align='left'><span id=freetext ><?php echo $classin?></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $eng?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $enggrade?></strong></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $kis?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $kisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $math?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $mathgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $bio?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $biograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $phy?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $phygrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $chem?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $chemgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $his?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $hisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $geo?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $geograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $cre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $cregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $agr?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $agrgrade?></strong></td>
	  	<td align='right'  bgcolor='#E1FFFF'><?php echo $bst?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $bstgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $fre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $fregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $comp?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $compgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $home?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $homegrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totals?></font></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totalpoints?></font></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $mean?></font></td>
		<td align='left'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $grade?></font></td>
		<td align='right'><?php echo $vap?></td>
		<td align='right'><?php echo $pi?></td>
		<td align='right'><?php echo $rowdis['ROWNUM'];  ?></td>
		
</tr>
<?php
	  	 // }// end of exam
	     //}//end of getting cat2 marks
	   //}//end of getting cat1 marks
	  //}// end of geting  names
	 }// end of geting admno



?>
            </tbody>
			<tfoot>
			<tr>
			<th colspan="36">Class Mean Scores Summary</th>
			</tr>
			<tr>
			<th colspan="10" align="right">Class</th>
			<th colspan="6" align="center"># Students</th>
			<th colspan="20" align="left">Mean</th>
			</tr>
		<?php
		$overall=0;
		$fms=0;
		$studs=0;
		$overmean=0.00;
		$qsmean=0.00;
		$q="select distinct stream, (sum(averagepoints)/ count(adm)) as mean,  count(adm) as stds from totalygradedexamanalysis where fgrade!='F' and form='$form' and term='$term' and year='$year' group by stream desc";

		//$q="select distinct stream, (sum(averagepoints)/ count(adm)) as mean from totalygradedmidterm where form='$form' and term='$term' and year='$year' group by stream desc";
		
	$mes=mysql_query($q);
	while ($qs = mysql_fetch_array($mes)) { 
	$fms++;
	$qsmean=$qs['mean'];
	?>
	
		<tr>
		<th colspan="10" align="right">Form <?php echo $form." ".$qs['stream']?></th>
		<th colspan="6" align="center"><?php echo $qs['stds']?></th>
		<th colspan="20" align="left"><?php echo round_up ($qs['mean'],3)?></th>
		</tr>
	
	<?php
	$studs+=$qs['stds'];
	$overall+=round_up ($qsmean,3);
	}
	if($overall==0){
	$overmean=0.00;
	}else{
	$overmean=round_up (($overall/$fms),3);
	}
?>
			<tr>
		<th colspan="10" align="right">Overall Form <?php echo $form?> </th>
		<th colspan="6" align="center"><?php echo $studs?></th>
		<th colspan="20" align="left"><?php echo $overmean?></th>
		</tr>
			</tfoot>
<?php

}
?>
          </table>
		  
		  </td>
      </tr>
    </table>
	</div>
		  </form>
		  <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
