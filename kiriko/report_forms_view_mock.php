<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/Grading.php';
	
// require_once("inc/db_Connector.php");  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
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

 function searchFunction(str)
    {
    if (str=="")
    {
    document.getElementById("display_Area").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display_Area").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","getLicenseDetailsSearch.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
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
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <div class="clear"></div>
    <!--*********************************************************************************-->
    <?php
$mode=$_GET['amode'];
$form=$_GET['form'];
$term=$_GET['term'];
$year=$_GET['year'];
$strm=$_GET['stream'];

$myformis=$form;
include('includes/dbconnector.php');
if($form==1){
$myform='Form 1';
$subjectsDone=11;
}
if($form==2){
$myform='Form 2';
$subjectsDone=11;
}
if($form==3){
$myform='Form 3';
$subjectsDone=8;
}
if($form==4){
$myform='Form 4';
$subjectsDone=8;
}

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Generated Mock Report Forms ".$myform." ".$year." ".$term;
$func->addAuditTrail($activity,$username);

  function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}

// run the query and store the results in the $result variable.
$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
}
$date=date("j, F, Y");

$positionby="averagepoints";
$alternatepositionby="average";

$amode=$_GET['gradeby'];
	
	if($_GET['gradeby']=="marks"){
		$positionby="average";
		$alternatepositionby="averagepoints";
	}
	if($_GET['gradeby']=="points"){
		$positionby="averagepoints";
		$alternatepositionby="average";
	}

	$posby="select * from positionby ";
	$resultposby = @mysql_query($posby);
	while ($rowby = mysql_fetch_array($resultposby)) {// get admno
	$bymarks=$rowby['marks'];
	$bypoints=$rowby['point'];
	}
	
	if($bymarks==1){
		$positionby="average";
		$alternatepositionby="averagepoints";
	}
	if($bypoints==1){
		$positionby="averagepoints";
		$alternatepositionby="average";
	}
//if ($result) {
  // create a new form and then put the results
  // in to a table.
   ?>
    <div class="clear"></div>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Cluster Report Forms Generation:- Form <?php echo $form." ". $strm?> - Term <?php echo $term?> - Year <?php echo $year?>
          <div style="float:right; margin-right:20px;"><?php echo '<a href="multiple_mock.php?id='.$form.'&term='.$term.'&yr='.$year.'&classin='.$strm.'&amode='.$amode.'"><i class="icon icon-green icon-print"></i>Print All</a>'?></div>
          <div style="float:right; margin-right:20px;"><?php echo '<a href="send_sms_Reports.php?id='.$form.'&term='.$term.'&yr='.$year.'&classin='.$strm.'&amode='.$amode.'"><i class="icon icon-green icon-mail-closed"></i>SMS All</a>'?></div></td>
      </tr>
      <tr>
        <td>
		<form action="removeselected_fromreport.php" method="post">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
			  <th></th>
			   <th>Admno</th>
                <th>Student Name</th>
                <th align='center'>Eng</th>
                <th align='center'>Kisw</th>
                <th align='center'>Maths</th>
                <th align='center'>Bio</th>
                <th align='center'>Phy</th>
                <th align='center'>Chem</th>
                <th align='center'>His</th>
                <th align='center'>Geo</th>
                <th align='center'>Cre</th>
                <th align='center'>Agr</th>
                <th align='center'>B/st</th>
				<th align="center">Fre</th>
				<th align="center">Comp</th>
				<th align="center">H/Sci</th>
                <th align='center'>Ttl</th>
              </tr>
            </thead>
            <tbody>
              <?php 
			  
			  
   $getstandard = mysql_query("select * from standards where year='$year' and term='$term' and form='$form'");
	while ($rowsrd = mysql_fetch_array($getstandard)) {
	$examstandard=$rowsrd['exam'];
	$cat1standard=$rowsrd['cat1'];
	$cat2standard=$rowsrd['cat2'];
	//$cat1per=$rowsrd['cat1percent'];
	//$cat2per=$rowsrd['cat2percent'];
	//$examper=$rowsrd['exampercent'];
	}
	
	$num=0;
	$cat1 = "SELECT distinct(admno) FROM tbleperformancetrackmock where form='$form' and year='$year' and term='$term' and s_status='0'";//admno query
	$result = @mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get admno
	$num++;
	$admno=$row['admno'];
	
	
	$getnames = "SELECT * from studentdetails where admno='$admno'";// get names
	$result3 = @mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$strmis=$row2['class'];
	$kcpema=$row2['marks'];
	$kcpegrad=$row2['grade'];
	
	}

	$getsubsdone = "SELECT * from subjectsforstudent where admno='$admno'";// get names
	$Subjectsresult = @mysql_query($getsubsdone);
	while ($rowsub = mysql_fetch_array($Subjectsresult)) {// get names
	$subjectsDone=$rowsub['subjects'];	
	}
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
	
	$enge=0;
	$kise=0;
	$mathe=0;
	$bioe=0;
	$cheme=0;
	$phye=0;
	$hise=0;
	$geoe=0;
	$cree=0;
	$agre=0;
	$bste=0;
	
	$free=0;
	$compe=0;
	$homee=0;
	
	$kis2=0;
	$eng2=0;
	$math2=0;
	$bio2=0;
	$chem2=0;
	$phy2=0;
	$his2=0;
	$geo2=0;
	$cre2=0;
	$agr2=0;
	$bst2=0;
	$fre2=0;
	$comp2=0;
	$home2=0;
	
	$exam = "SELECT * FROM mockexams where form='$form' and term='$term' and year='$year' and admno='$admno'";// exam query
	
	$result4 = @mysql_query($exam);
	while ($row4 = mysql_fetch_array($result4)) {// get exam marks
	//$exams=$row4[$subje];
	$eng=$row4['english1'];
	$eng2=$row4['english2'];
	$enge=$row4['english3'];
	
	$kis=$row4['kiswahili1'];
	$kis2=$row4['kiswahili2'];
	$kise=$row4['kiswahili3'];
	
	$math=$row4['math1'];
	$math2=$row4['math2'];
	$mathe=$row4['math3'];
	
	$bio=$row4['biology1'];
	$bio2=$row4['biology2'];
	$bioe=$row4['biology3'];
	
	$chem=$row4['chemistry1'];
	$chem2=$row4['chemistry2'];
	$cheme=$row4['chemistry3'];
	
	$phy=$row4['physics1'];
	$phy2=$row4['physics2'];
	$phye=$row4['physics3'];
	
	$his=$row4['history1'];
	$his2=$row4['history2'];
	$hise=$row4['history3'];
	
	$geo=$row4['geography1'];
	$geo2=$row4['geography2'];
	$geoe=$row4['geography3'];
	
	$cre=$row4['cre1'];
	$cre2=$row4['cre2'];
	$cree=$row4['cre3'];
	
	$agr=$row4['agriculture1'];
	$agr2=$row4['agriculture2'];
	$agre=$row4['agriculture3'];
	
	$bst=$row4['bstudies1'];
	$bst2=$row4['bstudies2'];
	$bste=$row4['bstudies3'];
	
	$fre=$row4['french1'];
	$free=$row4['french2'];
	$fre2=$row4['french3'];
	
	$comp=$row4['computer1'];
	$compe=$row4['computer2'];
	$comp2=$row4['computer3'];
	
	$home=$row4['home1'];
	$homee=$row4['home2'];
	$home2=$row4['home3'];
	}
	//$standard=150;
	$estandard=100;
	$kstandard=100;
	$mstandard=100;
	$bstandard=100;
	$cstandard=100;
	$pstandard=100;
	$hstandard=100;
	$gstandard=100;
	$restandard=100;
	$agstandard=100;
	$bsstandard=100;
	$frstandard=100;
	$compstandard=100;
	$homestandard=100;
	
	$getfrench = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='french'");
	while ($rowsrd = mysql_fetch_array($getfrench)) {
	$frstandard=$rowsrd['total'];
	}
	
	$getcomputer = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='computer'");
	while ($rowsrd = mysql_fetch_array($getcomputer)) {
	$compstandard=$rowsrd['total'];
	}
	
	$gethome = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='home'");
	while ($rowsrd = mysql_fetch_array($gethome)) {
	$homestandard=$rowsrd['total'];
	}
	
	
	
	
	$getestandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='English'");
	while ($rowsrd = mysql_fetch_array($getestandard)) {
	$estandard=$rowsrd['total'];
	}
	$getkstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='kiswahili'");
	while ($rowsrd = mysql_fetch_array($getkstandard)) {
	$kstandard=$rowsrd['total'];
	}
	$getmstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='math'");
	while ($rowsrd = mysql_fetch_array($getmstandard)) {
	$mstandard=$rowsrd['total'];
	}
	$getbstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='biology'");
	while ($rowsrd = mysql_fetch_array($getbstandard)) {
	$bstandard=$rowsrd['total'];
	}
	$getcstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='chemistry'");
	while ($rowsrd = mysql_fetch_array($getcstandard)) {
	$cstandard=$rowsrd['total'];
	}
	$getpstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='physics'");
	while ($rowsrd = mysql_fetch_array($getpstandard)) {
	$pstandard=$rowsrd['total'];
	}
	$gethstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='history'");
	while ($rowsrd = mysql_fetch_array($gethstandard)) {
	$hstandard=$rowsrd['total'];
	}
	$getgstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='geography'");
	while ($rowsrd = mysql_fetch_array($getgstandard)) {
	$gstandard=$rowsrd['total'];
	}
	$getrestandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='cre'");
	while ($rowsrd = mysql_fetch_array($getrestandard)) {
	$restandard=$rowsrd['total'];
	}
	$getagstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='agriculture'");
	while ($rowsrd = mysql_fetch_array($getagstandard)) {
	$agstandard=$rowsrd['total'];
	}
	$getbsstandard = @mysql_query("select total from mocks where form='$form' and term='$term' and year='$year' and subject='bstudies'");
	while ($rowsrd = mysql_fetch_array($getbsstandard)) {
	$bsstandard=$rowsrd['total'];
	}

	$eng=round((($eng+$eng2+$enge)/$estandard)*100);

	$kis=round((($kis+$kis2+$kise)/$kstandard)*100);
	$math=round((($math+$math2+$mathe)/$mstandard)*100);
	
	//if($form==1 || $form==2){
	$bio=round((($bio+$bio2+$bioe)/$bstandard)*100);
	$chem=round((($chem+$chem2+$cheme)/$cstandard)*100);
	$phy=round((($phy+$phy2+$phye)/$pstandard)*100);
	//}
	/*else{
	$bio=round((($bio+$bio2)/160)*60)+$bioe;
	$chem=round((($chem+$chem2)/160)*60)+$cheme;
	$phy=round((($phy+$phy2)/160)*60)+$phye;
	}*/
	//$bio=round((($bio+$bio2)/160)*60)+$bioe;
	//$chem=round((($chem+$chem2)/160)*60)+$cheme;
	//$phy=round((($phy+$phy2)/160)*60)+$phye;

	$his=round((($his+$his2+$hise)/$hstandard)*100);
	$geo=round((($geo+$geo2+$geoe)/$gstandard)*100);
	$cre=round((($cre+$cre2+$cree)/$restandard)*100);
	$agr=round((($agr+$agr2+$agre)/$agstandard)*100);
	$bst=round((($bst+$bst2+$bste)/$bsstandard)*100);
	
	$fre=round((($fre+$fre2+$free)/$frstandard)*100);
	$comp=round((($comp+$comp2+$compe)/$compstandard)*100);
	$home=round((($home+$home2+$homee)/$homestandard)*100);
	
	$grading = new Grading();
	
	if($form==1 || $form==2){
	$myf="1-2";
	}else{
	$myf="3-4";
	}
	
	$engdetails=$grading->getSubjectGrade('ENGLISH',$eng,$myf);
	$enggrade=$engdetails['grade'];
	$epoint=$engdetails['point'];
	$engremarks=$engdetails['remark'];
	
	$kisdetails=$grading->getSubjectGrade('KISWAHILI',$kis,$myf);
	$kiswahiligrade=$kisdetails['grade'];
	$kipoint=$kisdetails['point'];
	$kisremarks=$kisdetails['remark'];
	
	$mathdetails=$grading->getSciencesGrade('MATHS',$math,$myf);
	$mathgrade=$mathdetails['grade'];
	$mathpoint=$mathdetails['point'];
	$mathremarks=$mathdetails['remark'];
	
	$biodetails=$grading->getSciencesGrade('BIOLOGY',$bio,$myf);
	if($bio==0){
	$biograde="-";
	$biopoint=0;
	$bioremarks="-";
	}else{
	$biograde=$biodetails['grade'];
	$biopoint=$biodetails['point'];
	$bioremarks=$biodetails['remark'];
	}
	
	$chemdetails=$grading->getSciencesGrade('CHEMISTRY',$chem,$myf);
	if($chem==0){
	$chemgrade="-";
	$chempoint=0;
	$chemremarks="-";
	}else{
	$chemgrade=$chemdetails['grade'];
	$chempoint=$chemdetails['point'];
	$chemremarks=$chemdetails['remark'];
	}
	
	$phydetails=$grading->getSciencesGrade('PHYSICS',$phy,$myf);
	if($phy==0){
	$phygrade="-";
	$phypoint=0;
	$phyremarks="-";
	}else{
	$phygrade=$phydetails['grade'];
	$phypoint=$phydetails['point'];
	$phyremarks=$phydetails['remark'];
	}
	
	$hisdetails=$grading->getSubjectGrade('HISTORY',$his,$myf);
	if($his==0){
	$hisgrade="-";
	$hispoint=0;
	$hisremarks="-";
	}else{
	$hisgrade=$hisdetails['grade'];
	$hispoint=$hisdetails['point'];
	$hisremarks=$hisdetails['remark'];
	}
	
	$geodetails=$grading->getSubjectGrade('GEOGRAPHY',$geo,$myf);
	if($geo==0){
	$geograde="-";
	$geopoint=0;
	$georemarks="-";
	}else{
	$geograde=$geodetails['grade'];
	$geopoint=$geodetails['point'];
	$georemarks=$geodetails['remark'];
	}
	
	$credetails=$grading->getSubjectGrade('CRE',$cre,$myf);
	if($cre==0){
	$cregrade="-";
	$crepoint=0;
	$creremarks="-";
	}else{
	$cregrade=$credetails['grade'];
	$crepoint=$credetails['point'];
	$creremarks=$credetails['remark'];
	}
	$agrdetails=$grading->getSubjectGrade('AGRICULTURE',$agr,$myf);
	
	if($agr==0){
	$agrgrade="-";
	$agrpoint=0;
	$agrremarks="-";
	}else{
	$agrgrade=$agrdetails['grade'];
	$agrpoint=$agrdetails['point'];
	$agrremarks=$agrdetails['remark'];
	}
	
	$bstdetails=$grading->getSubjectGrade('B/STUDIES',$bst,$myf);
	
	if($bst==0){
	$bstgrade="-";
	$bstpoint=0;
	$bstremarks="-";
	}else{
	$bstgrade=$bstdetails['grade'];
	$bstpoint=$bstdetails['point'];
	$bstremarks=$bstdetails['remark'];
	}
	
    $fredetails=$grading->getSubjectGrade('FRENCH',(($fre)),$myf);
	if($fre==0){
	$fregrade="-";
	$frepoint=0;
	$freremarks="-";
	}else{
	$fregrade=$fredetails['grade'];
	$frepoint=$fredetails['point'];
	$freremarks=$fredetails['remark'];
	}
	
	$compdetails=$grading->getSubjectGrade('COMPUTER',(($comp)),$myf);
	if($comp==0){
	$compgrade="-";
	$comppoint=0;
	$compremarks="-";
	}else{
	$compgrade=$compdetails['grade'];
	$comppoint=$compdetails['point'];
	$compremarks=$compdetails['remark'];
	}
	
	$homedetails=$grading->getSubjectGrade('HOME',(($home)),$myf);
	if($home==0){
	$homegrade="-";
	$homepoint=0;
	$homeremarks="-";
	}else{
	$homegrade=$homedetails['grade'];
	$homepoint=$homedetails['point'];
	$homeremarks=$homedetails['remark'];
	}
	
	if($mode=='custom'){
	
	$totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst + $fre + $comp+$home;
	$average=round_up ( $totals/$subjectsDone, 4 ); // float(499.945) 
	}else{
	
	
	$numbers1=array($bio,$chem,$phy);
	rsort($numbers1);
	
	//$numbers2=array($his,$geo,$cre);//get one humanity
	//rsort($numbers2);
	
	$numbers3=array($agr,$bst,$home,$comp,$fre,$numbers1[2],$his,$geo,$cre);//get one from either
	rsort($numbers3);
	
	$totals=$eng+$kis+$math+$numbers1[0]+$numbers1[1]+$numbers3[0]+$numbers3[1];
	
	//echo $admno." Total=".$totals."["."-".$eng."-".$kis."-".$math."-".$numbers1[0]."-".$numbers1[1]."-".$numbers2[0]."-".$numbers3[0]."-"."]<br/>";
	$average=round_up ( $totals/7, 3 ); // float(499.945) 	
	}
	
		
		if($mode=='custom'){
	
		$totalpoints=$epoint+$kipoint+$mathpoint+$biopoint+$chempoint+$phypoint+$hispoint+$geopoint+$crepoint+$agrpoint+$bstpoint;		
		$averagepoints=round_up ( $totalpoints/$subjectsDone, 3 );  
	}else{
		$points1=array($biopoint,$chempoint,$phypoint);
		rsort($points1);
	
		
	//$points2=array($hispoint,$geopoint,$crepoint);
		//rsort($points2);
		
	$points3=array($agrpoint,$bstpoint,$homepoint,$comppoint,$frepoint,$points1[2],$hispoint,$geopoint,$crepoint);
		rsort($points3);
		
	$totalpoints=$epoint+$kipoint+$mathpoint+$points1[0]+$points1[1]+$points3[0]+$points3[1];
	$averagepoints=round_up ( $totalpoints/7, 3 ); // float(499.945) 	
	}
		
		
		
		//echo $averagepoints.'<br/>';
		//$tfgrade = "-";
		
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
			$tfgrade = "E";
			
		}
		/*if ($averagepoints > 0.00 && $averagepoints <= 1.499) {
			$tfgrade = "E";
			// remarks="Work harder";
		} else if ($averagepoints >= 1.50 && $averagepoints <= 2.499) {
			$tfgrade = "D-";
			// remarks="Improve";
		} else if ($averagepoints >= 2.50 && $averagepoints <= 3.499) {
			$tfgrade = "D";
			// remarks="Improve";
		} else if ($averagepoints >= 3.50 && $averagepoints <= 4.499) {
			$tfgrade = "D+";
			// remarks="Can do better";
		} else if ($averagepoints >= 4.50 && $averagepoints <= 5.499) {
			$tfgrade = "C-";
			// remarks="Fair";
		} else if ($averagepoints >= 5.50 && $averagepoints <= 6.499) {
			$tfgrade = "C";
			// remarks="Fair";
		} else if ($averagepoints >= 6.50 && $averagepoints <= 7.499) {
			$tfgrade = "C+";
			// remarks="Fair";
		} else if ($averagepoints >= 7.50 && $averagepoints <= 8.499) {
			$tfgrade = "B-";
			// remarks="Good";
		} else if ($averagepoints >= 8.50 && $averagepoints <= 9.499) {
			$tfgrade = "B";
			// remarks="Good";
		} else if ($averagepoints >= 9.50 && $averagepoints <= 10.499) {
			$tfgrade = "B+";
			// remarks="Good";
		} else if ($averagepoints >= 10.50 && $averagepoints <= 11.499) {
			$tfgrade = "A-";
			// remarks="V. Good";
		} else if ($averagepoints >= 11.50 && $averagepoints <= 12.00) {
			$tfgrade = "A";
			// remarks="Excellent";
		}else if ($averagepoints == 0.00) {
			$tfgrade = "E";
			
		}*/
	
	
		
	$insert="insert into totalygradedmockmarks (marks,grade,adm,names
	,english,englishgrade,engremarks,kiswahili,kiswahiligrade
	,kisremarks,mathematics,mathimaticsgrade,mathremarks
	,biology,biologygrade,bioremarks,chemistry,chemistrygrade,chemremarks
	,physics,physicsgrade,phyremarks,history,historygrade,hisremarks
	,geography,geographygrade,georemarks,cre,cregrade,creremarks,agriculture,agriculturegrade,agrremarks
	,businesStudies,businesStudiesgrade,bstremarks,french,
             frenchgrade,
             frenchremarks,
             computer,
             computergrade,
             computerremarks,
             home,
             homegrade,
             homeremarks
	,points,tgrade,totalmarks,average,averagepoints
	,term,year,form,classin,htremarks)
	
		values('$kcpema','$kcpegrad','$admno','$fname $mname $lasname'
	,'$eng','$enggrade','$engremarks','$kis','$kiswahiligrade'
	,'$kisremarks','$math','$mathgrade','$mathremarks'
	,'$bio','$biograde','$bioremarks','$chem','$chemgrade','$chemremarks',
	'$phy','$phygrade','$phyremarks','$his','$hisgrade','$hisremarks'
	,'$geo','$geograde','$georemarks','$cre','$cregrade','$creremarks','$agr','$agrgrade','$agrremarks','$bst','$bstgrade','$bstremarks','$fre','$fregrade','$freremarks','$comp','$compgrade','$compremarks','$home','$homegrade','$homeremarks','$totalpoints','$tfgrade','$totals','$average','$averagepoints','$term','$year','$form','$strmis','$htremarks')
			
		on duplicate key update marks='$kcpema', english='$eng', englishgrade='$enggrade', kiswahili='$kis', kiswahiligrade='$kiswahiligrade', kisremarks='$kisremarks', mathematics='$math', mathimaticsgrade='$mathgrade', mathremarks='$mathremarks', biology='$bio', biologygrade='$biograde', bioremarks='$bioremarks', chemistry='$chem', chemistrygrade='$chemgrade',chemremarks='$chemremarks', physics='$phy', physicsgrade='$phygrade',phyremarks='$phyremarks', history='$his', historygrade='$hisgrade',hisremarks='$hisremarks', geography='$geo', geographygrade='$geograde',georemarks='$georemarks', cre='$cre', cregrade='$cregrade',creremarks='$creremarks',agriculture='$agr', agriculturegrade='$agrgrade',agrremarks='$agrremarks', businesStudies='$bst', businesStudiesgrade='$bstgrade',bstremarks='$bstremarks',french ='$fre',frenchgrade ='$fregrade', frenchremarks='$freremarks',computer='$comp',computergrade='$compgrade',computerremarks='$compremarks',home='$home',homegrade='$homegrade',homeremarks='$homeremarks',
points='$totalpoints',tgrade='$tfgrade',totalmarks='$totals', average='$average',averagepoints='$averagepoints', htremarks='$htremarks'";
		
	$querynow=mysql_query($insert);
	if(!$querynow){
	echo"failed". mysql_error();
	}

}
	/*********************************************************************/ 
	$posq="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmockmarks` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmockmarks` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc";
	$details=mysql_query($posq);	
	$num=0;
	
	
	while ($row = mysql_fetch_array($details)) {
	$adm=$row['adm'];
	$classin=$row['classin'];
	$num=$row['ROWNUM'];

		$insert="insert into mockpositions(admno,position,form,stream,term,year)
		values('$adm','$num','$form','$classin','$term','$year')
		 on duplicate key update position='$num'";
		$querynow=mysql_query($insert);
		if(!$querynow){
		echo"failed". mysql_error();
		}
}
$posq2="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmockmarks` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' and t1.classin='$strm' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmockmarks` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year' and t2.classin='$strm' 
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc";
	$details2=mysql_query($posq2);	
	$num2=0;
	
	
	while ($row2 = mysql_fetch_array($details2)) {
	$adm2=$row2['adm'];
	$classin=$row['classin'];
	$num2=$row2['ROWNUM'];

		$insert2="insert into mockpositions(admno,positionclass,form,stream,term,year)
		values('$adm2','$num2','$form','$classin','$term','$year')
		 on duplicate key update positionclass='$num2'";
		$querynow2=mysql_query($insert2);
		if(!$querynow2){
		echo"failed". mysql_error();
		}
}

/********************************************************************/
	$engpo=0;
	$engpos=@mysql_query("SELECT adm,english FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by english desc");
	while ($rowe = mysql_fetch_array($engpos)) {
	$adms=$rowe['adm'];
	$engpo++;
		
	$inserte="insert into mockpositions(admno,english,form,term,year)
		values('$adms','$engpo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set english='$engpo' where admno='$adms' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	

/********************************************************************/
	$kispo=0;
	$kispos=@mysql_query("SELECT adm,kiswahili FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by kiswahili desc");
	while ($rowk = mysql_fetch_array($kispos)) {
	$admk=$rowk['adm'];
	$kispo++;
		
	$inserte="insert into mockpositions(admno,kiswahili,form,term,year)
		values('$admk','$kispo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set kiswahili='$kispo' where admno='$admk' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

	$mathpo=0;
	$mathpos=@mysql_query("SELECT adm,mathematics FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by mathematics desc");
	while ($rowm = mysql_fetch_array($mathpos)) {
	$admm=$rowm['adm'];
	$mathpo++;
		
	$inserte="insert into mockpositions(admno,math,form,term,year)
		values('$admm','$mathpo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set math='$mathpo' where admno='$admm' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/


$biopo=0;
	$biopos=@mysql_query("SELECT adm,biology FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by biology desc");
	while ($rowb = mysql_fetch_array($biopos)) {
	$admb=$rowb['adm'];
	$biopo++;
		
	$inserte="insert into mockpositions(admno,biology,form,term,year)
		values('$admb','$biopo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set biology='$biopo' where admno='$admb' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/


$chempo=0;
	$chempos=@mysql_query("SELECT adm,chemistry FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by chemistry desc");
	while ($rowc = mysql_fetch_array($chempos)) {
	$admc=$rowc['adm'];
	$chempo++;
		
	$inserte="insert into mockpositions(admno,chemistry,form,term,year)
		values('$admc','$chempo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set chemistry='$chempo' where admno='$admc' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

$phypo=0;
	$phypos=@mysql_query("SELECT adm,physics FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by physics desc");
	while ($rowp = mysql_fetch_array($phypos)) {
	$admp=$rowp['adm'];
	$phypo++;
		
	$inserte="insert into mockpositions(admno,physics,form,term,year)
		values('$admp','$phypo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set physics='$phypo' where admno='$admp' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

$hispo=0;
	$hispos=@mysql_query("SELECT adm,history FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by history desc");
	while ($rowh = mysql_fetch_array($hispos)) {
	$admh=$rowh['adm'];
	$hispo++;
		
	$inserte="insert into mockpositions(admno,history,form,term,year)
		values('$admh','$hispo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set history='$hispo' where admno='$admh' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/
$geopo=0;
	$geopos=@mysql_query("SELECT adm,geography FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by geography desc");
	while ($rowg = mysql_fetch_array($geopos)) {
	$admg=$rowg['adm'];
	$geopo++;
		
	$inserte="insert into mockpositions(admno,geography,form,term,year)
		values('$admg','$geopo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set geography='$geopo' where admno='$admg' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

$crepo=0;
	$crepos=@mysql_query("SELECT adm,cre FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by cre desc");
	while ($rowcr = mysql_fetch_array($crepos)) {
	$admcr=$rowcr['adm'];
	$crepo++;
		
	$inserte="insert into mockpositions(admno,cre,form,term,year)
		values('$admcr','$crepo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set cre='$crepo' where admno='$admcr' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

$agrpo=0;
	$agrpos=@mysql_query("SELECT adm,agriculture FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by agriculture desc");
	while ($rowag = mysql_fetch_array($agrpos)) {
	$admag=$rowag['adm'];
	$agrpo++;
		
	$inserte="insert into mockpositions(admno,agriculture,form,term,year)
		values('$admag','$agrpo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set agriculture='$agrpo' where admno='$admag' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

$bstpo=0;
	$bstpos=@mysql_query("SELECT adm,businesStudies FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by businesStudies desc");
	while ($rowbs = mysql_fetch_array($bstpos)) {
	$admbs=$rowbs['adm'];
	$bstpo++;
		
	$inserte="insert into mockpositions(admno,bstudies,form,term,year)
		values('$admbs','$bstpo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set bstudies='$bstpo' where admno='$admbs' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/


/*******************************************************************/

$frenchpo=0;
	$frenchpos=@mysql_query("SELECT adm,french FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by french desc");
	while ($rowbs = mysql_fetch_array($frenchpos)) {
	$admbs=$rowbs['adm'];
	$frenchpo++;
		
	$inserte="insert into mockpositions(admno,french,form,term,year)
		values('$admbs','$frenchpo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set french='$frenchpo' where admno='$admbs' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/


/*******************************************************************/

$homepo=0;
	$homepos=@mysql_query("SELECT adm,home FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by home desc");
	while ($rowbs = mysql_fetch_array($homepos)) {
	$admbs=$rowbs['adm'];
	$homepo++;
		
	$inserte="insert into mockpositions(admno,home,form,term,year)
		values('$admbs','$homepo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set home='$homepo' where admno='$admbs' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

/*******************************************************************/

$computerpo=0;
	$computerpos=@mysql_query("SELECT adm,computer FROM totalygradedmockmarks where form='$form' and term='$term' and year='$year' order by computer desc");
	while ($rowbs = mysql_fetch_array($computerpos)) {
	$admbs=$rowbs['adm'];
	$homepo++;
		
	$inserte="insert into mockpositions(admno,computer,form,term,year)
		values('$admbs','$computerpo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set computer='$computerpo' where admno='$admbs' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

	
/*******************************************************************/

$kcpepo=0;
	$kcpepos=@mysql_query("SELECT admno,marks FROM studentdetails where form='$myform' order by marks desc");
	while ($rowbs = mysql_fetch_array($kcpepos)) {
	$admkcpe=$rowbs['admno'];
	$kcpepo++;
		
	$inserte="insert into mockpositions(admno,kcpe,form,term,year)
		values('$admkcpe','$kcpepo','$form','$term','$year')";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	mysql_query("update mockpositions set kcpe='$kcpepo' where admno='$admkcpe' and form='$form' and term='$term' and year='$year' ");
		//echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

$num=0;
	
	$myqueryis="select * from totalygradedmockmarks where  term='$term' and year='$year' and classin='$strm' and form='$form' 
	 order by $positionby desc, $alternatepositionby desc";
	$toexecute=@mysql_query($myqueryis);
	while ($rowr = mysql_fetch_array($toexecute)) {
	$num++;
	$ads=$rowr['adm'];
	$nameis=$rowr['names'];
	$engfi=$rowr['english'];
	$kisfi=$rowr['kiswahili'];
	$mathfi=$rowr['mathematics'];
	$biofi=$rowr['biology'];
	$chemfi=$rowr['chemistry'];
	$phyfi=$rowr['physics'];
	$hisfi=$rowr['history'];
	$geofi=$rowr['geography'];
	$crefi=$rowr['cre'];
	$agrfi=$rowr['agriculture'];
	$bstfi=$rowr['businesStudies'];
	
	$frefi=$rowr['french'];
	$compfi=$rowr['computer'];
	$homefi=$rowr['home'];
	
	
	$totalmarks=$rowr['totalmarks'];
	
?>

	  <tr>
	  <td><input type="checkbox"  name="checkbox[]" value="<?php echo $ads?>"></td>
	  <td><span id=reportText><?php echo  $ads?></span></td>
		<td><span id=reportText><?php echo str_replace("&","'",$nameis)?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $engfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $kisfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $mathfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $biofi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $phyfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $chemfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $hisfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $geofi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $crefi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $agrfi?></span></td>
	  	<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $bstfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $frefi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $compfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $homefi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><font color="#FF0000"><?php echo $totalmarks?></font></span></td>
	  
		<td align="center">
				<a href="reportsmocks.php?id=<?php echo $ads?>&forms=<?php echo $form?>&term=<?php echo $term?>&yr=<?php echo $year?>&classin=<?php echo $strm?>">
				<i class="icon icon-green icon-print"></i></a></td>
		<td align="right"><a href="send_sms_single_MockReports.php?id=<?php echo $form?>&term=<?php echo $term?>&yr=<?php echo $year?>&adm=<?php echo $ads?>&strm=<?php echo $strm?>&mode=<?php echo $mode?>&gradeby=<?php echo $amode?>"
		<i class="icon icon-green icon-envelope-closed"></i> </a></td>
 		</tr>
		
	<?php  	 
	}// end of loop for report forms
	
?>
<tr>
<td colspan="5"><input type="submit" name="delete" value="Exclude Selected Students" class="btn" onclick="return confirmdelete();" /></td>
</tr>


            </tbody>
          </table>
		  <input type="hidden" name="yrtodelete" value="<?php echo $year?>" />
		   <input type="hidden" name="termtodelete" value="<?php echo $term?>" />
		    <input type="hidden" name="modetodelete" value="<?php echo $mode?>" />
			 <input type="hidden" name="formtodelete" value="<?php echo $form?>" />
			  <input type="hidden" name="streamtodelete" value="<?php echo $strm?>" />
			   <input type="hidden" name="gradebytodelete" value="<?php echo $amode?>" />
		 </form>
		  </td>
      </tr>
    </table>
	
	
	
  </div>
</div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
<script>

function confirmdelete(){

doIt=confirm('This Student will be Excluded From the Reportforms\n\nDo you wish to Continue?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}

</script>

</body>
</html>
