<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/SubjectTally.php';
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
    <!--*********************************************************************************-->
    <?php
include('includes/dbconnector.php');
$form=$_GET['form'];
$stream=$_GET['stream'];
$term=$_GET['term'];
$year=$_GET['year'];
$amode=$_GET['gradeby'];

$myformis=$form;


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

include 'includes/functions.php';
$func = new Functions();
$activity = "Generated General Spread sheet".$myform." ".$year." ".$term;
$func->addAuditTrail($activity,$username);

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


	
	if($amode=="marks"){
		$positionby="average";
		$alternatepositionby="averagepoints";
	}
	if($amode=="points"){
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
        <td class="dataListHeader"> Cluster Subjects Analysis:- Form <?php echo $form." ". $stream?> - Term <?php echo $term?> - Year <?php echo $year?>
          <div style="float:right; margin-right:5px;">
            <table width="100%">
              <tr>
                <td align="left"><a href=javascript:printDiv('div_print_analysis') title="Print Report"><i class="icon icon-green icon-print"></i>Print Subjects Analysis</a> </td>
				 <td align="left"><a href="pdf_cluster_subject_analysis.php?form=<?php echo $form?>&class=<?php echo $stream?>&term=<?php echo $term?>&year=<?php echo $year?>&amode=<?php echo $amode?>" title="Print PDF Report"><i class="icon icon-red icon-pdf"></i>Export PDF</a> </td>
              </tr>
            </table>
          </div></td>
      </tr>
     <tr>
	<td>
            <?php
	include 'includes/PerformanceIndicator.php';
	$pin = new PI();
	$pin->getPICluster($form,$term,$stream,$year);
	
	
	
	$studentsare=0;
	if($stream=='Entire'){
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form'");
	}else{
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowstud = mysql_fetch_array($getstudents)) {// get admno
	$studentsare=$rowstud['adms'];
	}
	
	
	function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}
	
		
	$stally = new SubjectTally();
	
	if($stream=='Entire'){
	$getenglish = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='A' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglish = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='A' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($roweng = mysql_fetch_array($getenglish)) {// get admno
	$englishas=$roweng['engas'];
	$engpoA=$englishas*12;
	}
	if($stream=='Entire'){
	$getenglishm = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='A-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishm = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='A-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengm = mysql_fetch_array($getenglishm)) {// get admno
	$englisham=$rowengm['engas'];
	$engpoAm=$englisham*11;
	}
	
	if($stream=='Entire'){
	$getenglishBP = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='B+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishBP = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='B+' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengbp = mysql_fetch_array($getenglishBP)) {// get admno
	$englishabp=$rowengbp['engas'];
	$engpoBP=$englishabp*10;
	}
	
	if($stream=='Entire'){
	$getenglishB = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='B' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishB = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='B' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengb = mysql_fetch_array($getenglishB)) {// get admno
	$englishab=$rowengb['engas'];
	$engpoB=$englishab*9;
	}
	
	if($stream=='Entire'){
	$getenglishBM = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='B-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishBM = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='B-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengbm = mysql_fetch_array($getenglishBM)) {// get admno
	$englishabm=$rowengbm['engas'];
	$engpoBm=$englishabm*8;
	}
	
	if($stream=='Entire'){
	$getenglishCP = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='C+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishCP = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='C+' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengcp = mysql_fetch_array($getenglishCP)) {// get admno
	$englishacp=$rowengcp['engas'];
	$engpoCp=$englishacp*7;
	}
	
	if($stream=='Entire'){
	$getenglishC = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='C' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishC = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='C' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengc = mysql_fetch_array($getenglishC)) {// get admno
	$englishac=$rowengc['engas'];
	$engpoC=$englishac*6;
	}
	
	if($stream=='Entire'){
	$getenglishCM = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='C-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishCM = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='C-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengcm = mysql_fetch_array($getenglishCM)) {// get admno
	$englishacm=$rowengcm['engas'];
	$engpoCm=$englishacm*5;
	}
	
	if($stream=='Entire'){
	$getenglishDP = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='D+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishDP = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='D+' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengdp = mysql_fetch_array($getenglishDP)) {// get admno
	$englishadp=$rowengdp['engas'];
	$engpoDp=$englishadp*4;
	}
	
	if($stream=='Entire'){
	$getenglishD = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='D' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishD = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='D' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengd = mysql_fetch_array($getenglishD)) {// get admno
	$englishad=$rowengd['engas'];
	$engpoD=$englishad*3;
	}
	
	if($stream=='Entire'){
	$getenglishDM = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='D-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishDM = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='D-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengdm = mysql_fetch_array($getenglishDM)) {// get admno
	$englishadm=$rowengdm['engas'];
	$engpoDm=$englishadm*2;
	}
	
	if($stream=='Entire'){
	$getenglishE = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='E' and term='$term' and year='$year' and form='$form'");
	}else{
	$getenglishE = mysql_query("select count(englishgrade) as engas from totalygradedmockmarks where englishgrade='E' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowengde = mysql_fetch_array($getenglishE)) {// get admno
	$englishade=$rowengde['engas'];
	$engpoE=$englishade*1;
	}
	
	
	//************************************************** french **************************************************************************
	
 if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','A',$term,$year,$form,"");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','A',$term,$year,$form," and classin='$stream'");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','A-',$term,$year,$form,"");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','A-',$term,$year,$form," and classin='$stream'");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','B+',$term,$year,$form,"");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','B+',$term,$year,$form," and classin='$stream'");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','B',$term,$year,$form,"");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','B',$term,$year,$form," and classin='$stream'");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','B-',$term,$year,$form,"");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','B-',$term,$year,$form," and classin='$stream'");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','C+',$term,$year,$form,"");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','C+',$term,$year,$form," and classin='$stream'");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','C',$term,$year,$form,"");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','C',$term,$year,$form," and classin='$stream'");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','C-',$term,$year,$form,"");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','C-',$term,$year,$form," and classin='$stream'");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','D+',$term,$year,$form,"");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','D+',$term,$year,$form," and classin='$stream'");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','D',$term,$year,$form,"");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','D',$term,$year,$form," and classin='$stream'");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','D-',$term,$year,$form,"");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','D-',$term,$year,$form," and classin='$stream'");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','E',$term,$year,$form,"");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}else{
		$kistally=$stally->getSubjectTallyMock('kiswahiligrade','E',$term,$year,$form," and classin='$stream'");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}
	
	
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','A',$term,$year,$form,"");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','A',$term,$year,$form," and classin='$stream'");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}
	
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','A-',$term,$year,$form,"");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','A-',$term,$year,$form," and classin='$stream'");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','B+',$term,$year,$form,"");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','B+',$term,$year,$form," and classin='$stream'");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','B',$term,$year,$form,"");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','B',$term,$year,$form," and classin='$stream'");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','B-',$term,$year,$form,"");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','B-',$term,$year,$form," and classin='$stream'");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','C+',$term,$year,$form,"");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','C+',$term,$year,$form," and classin='$stream'");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','C',$term,$year,$form,"");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','C',$term,$year,$form," and classin='$stream'");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','C-',$term,$year,$form,"");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','C-',$term,$year,$form," and classin='$stream'");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','D+',$term,$year,$form,"");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','D+',$term,$year,$form," and classin='$stream'");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','D',$term,$year,$form,"");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','D',$term,$year,$form," and classin='$stream'");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','D-',$term,$year,$form,"");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','D-',$term,$year,$form," and classin='$stream'");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','E',$term,$year,$form,"");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}else{
		$mathtally=$stally->getSubjectTallyMock('mathimaticsgrade','E',$term,$year,$form," and classin='$stream'");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}
	
	/*** GET BIOLOGY GRADES AND POINTS **/
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','A',$term,$year,$form,"");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','A',$term,$year,$form," and classin='$stream'");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','A-',$term,$year,$form,"");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','A-',$term,$year,$form," and classin='$stream'");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','B+',$term,$year,$form,"");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','B+',$term,$year,$form," and classin='$stream'");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','B',$term,$year,$form,"");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','B',$term,$year,$form," and classin='$stream'");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','B-',$term,$year,$form,"");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','B-',$term,$year,$form," and classin='$stream'");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','C+',$term,$year,$form,"");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','C+',$term,$year,$form," and classin='$stream'");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','C',$term,$year,$form,"");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','C',$term,$year,$form," and classin='$stream'");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','C-',$term,$year,$form,"");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','C-',$term,$year,$form," and classin='$stream'");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','D+',$term,$year,$form,"");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','D+',$term,$year,$form," and classin='$stream'");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','D',$term,$year,$form,"");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','D',$term,$year,$form," and classin='$stream'");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','D-',$term,$year,$form,"");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','D-',$term,$year,$form," and classin='$stream'");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTallyMock('biologygrade','E',$term,$year,$form,"");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}else{
		$biotally=$stally->getSubjectTallyMock('biologygrade','E',$term,$year,$form," and classin='$stream'");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}
	
	$biologyStudents=0;
	if($stream=='Entire'){
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and biology>0");
	}else{
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and biology>0");
	}
	while ($rowbiostud = mysql_fetch_array($getbiostudents)) {// get admno
	$biologyStudents=$rowbiostud['adms'];
	}
	
	/***************** GET CHEMISTRY GRADES *******************/
	
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','A',$term,$year,$form,"");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','A',$term,$year,$form," and classin='$stream'");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','A-',$term,$year,$form,"");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','A-',$term,$year,$form," and classin='$stream'");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','B+',$term,$year,$form,"");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','B+',$term,$year,$form," and classin='$stream'");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','B',$term,$year,$form,"");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','B',$term,$year,$form," and classin='$stream'");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','B-',$term,$year,$form,"");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','B-',$term,$year,$form," and classin='$stream'");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','C+',$term,$year,$form,"");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','C+',$term,$year,$form," and classin='$stream'");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','C',$term,$year,$form,"");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','C',$term,$year,$form," and classin='$stream'");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','C-',$term,$year,$form,"");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','C-',$term,$year,$form," and classin='$stream'");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','D+',$term,$year,$form,"");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','D+',$term,$year,$form," and classin='$stream'");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','D',$term,$year,$form,"");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','D',$term,$year,$form," and classin='$stream'");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','D-',$term,$year,$form,"");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','D-',$term,$year,$form," and classin='$stream'");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','E',$term,$year,$form,"");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}else{
		$chemtally=$stally->getSubjectTallyMock('chemistrygrade','E',$term,$year,$form," and classin='$stream'");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}
	
	
	$chemistryStudents=0;
	if($stream=='Entire'){
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and chemistry>0");
	}else{
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and chemistry>0");
	}
	while ($rowchemstud = mysql_fetch_array($getchemstudents)) {// get admno
	$chemistryStudents=$rowchemstud['adms'];
	}

	/************************ GET PHYSICS GRADES *************************************/
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','A',$term,$year,$form,"");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','A',$term,$year,$form," and classin='$stream'");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','A-',$term,$year,$form,"");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','A-',$term,$year,$form," and classin='$stream'");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','B+',$term,$year,$form,"");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','B+',$term,$year,$form," and classin='$stream'");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','B',$term,$year,$form,"");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','B',$term,$year,$form," and classin='$stream'");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','B-',$term,$year,$form,"");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','B-',$term,$year,$form," and classin='$stream'");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','C+',$term,$year,$form,"");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','C+',$term,$year,$form," and classin='$stream'");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','C',$term,$year,$form,"");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','C',$term,$year,$form," and classin='$stream'");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','C-',$term,$year,$form,"");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','C-',$term,$year,$form," and classin='$stream'");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','D+',$term,$year,$form,"");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','D+',$term,$year,$form," and classin='$stream'");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','D',$term,$year,$form,"");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','D',$term,$year,$form," and classin='$stream'");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','D-',$term,$year,$form,"");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','D-',$term,$year,$form," and classin='$stream'");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTallyMock('physicsgrade','E',$term,$year,$form,"");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}else{
		$phytally=$stally->getSubjectTallyMock('physicsgrade','E',$term,$year,$form," and classin='$stream'");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}
	
	$physicsStudents=0;
	if($stream=='Entire'){
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and physics>0");
	}else{
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and physics>0");
	}
	while ($rowphystud = mysql_fetch_array($getphystudents)) {// get admno
	$physicsStudents=$rowphystud['adms'];
	}
	
	/************************* GET HISTORY GRADES ***************************************/
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','A',$term,$year,$form,"");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','A',$term,$year,$form," and classin='$stream'");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','A-',$term,$year,$form,"");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','A-',$term,$year,$form," and classin='$stream'");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','B+',$term,$year,$form,"");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','B+',$term,$year,$form," and classin='$stream'");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','B',$term,$year,$form,"");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','B',$term,$year,$form," and classin='$stream'");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','B-',$term,$year,$form,"");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','B-',$term,$year,$form," and classin='$stream'");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','C+',$term,$year,$form,"");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','C+',$term,$year,$form," and classin='$stream'");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','C',$term,$year,$form,"");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','C',$term,$year,$form," and classin='$stream'");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','C-',$term,$year,$form,"");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','C-',$term,$year,$form," and classin='$stream'");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','D+',$term,$year,$form,"");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','D+',$term,$year,$form," and classin='$stream'");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','D',$term,$year,$form,"");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','D',$term,$year,$form," and classin='$stream'");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','D-',$term,$year,$form,"");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','D-',$term,$year,$form," and classin='$stream'");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTallyMock('historygrade','E',$term,$year,$form,"");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}else{
		$histally=$stally->getSubjectTallyMock('historygrade','E',$term,$year,$form," and classin='$stream'");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}
	
	
	$historyStudents=0;
	if($stream=='Entire'){
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and history>0");
	}else{
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and history>0");
	}
	while ($rowhisstud = mysql_fetch_array($gethisstudents)) {// get admno
	$historyStudents=$rowhisstud['adms'];
	}
	/*************************** GET GEOGRAPHY GRADES *****************************/
	
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','A',$term,$year,$form,"");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','A',$term,$year,$form," and classin='$stream'");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','A-',$term,$year,$form,"");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','A-',$term,$year,$form," and classin='$stream'");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','B+',$term,$year,$form,"");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','B+',$term,$year,$form," and classin='$stream'");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','B',$term,$year,$form,"");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','B',$term,$year,$form," and classin='$stream'");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','B-',$term,$year,$form,"");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','B-',$term,$year,$form," and classin='$stream'");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','C+',$term,$year,$form,"");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','C+',$term,$year,$form," and classin='$stream'");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','C',$term,$year,$form,"");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','C',$term,$year,$form," and classin='$stream'");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','C-',$term,$year,$form,"");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','C-',$term,$year,$form," and classin='$stream'");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','D+',$term,$year,$form,"");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','D+',$term,$year,$form," and classin='$stream'");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','D',$term,$year,$form,"");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','D',$term,$year,$form," and classin='$stream'");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','D-',$term,$year,$form,"");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','D-',$term,$year,$form," and classin='$stream'");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTallyMock('geographygrade','E',$term,$year,$form,"");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}else{
		$geotally=$stally->getSubjectTallyMock('geographygrade','E',$term,$year,$form," and classin='$stream'");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}
	
	$geographyStudents=0;
	if($stream=='Entire'){
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and geography>0");
	}else{
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and geography>0");
	}
	while ($rowgeostud = mysql_fetch_array($getgeostudents)) {// get admno
	$geographyStudents=$rowgeostud['adms'];
	}
	
	/************************* GET CRE GRADES  *****************************/
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','A',$term,$year,$form,"");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','A',$term,$year,$form," and classin='$stream'");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','A-',$term,$year,$form,"");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','A-',$term,$year,$form," and classin='$stream'");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','B+',$term,$year,$form,"");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','B+',$term,$year,$form," and classin='$stream'");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','B',$term,$year,$form,"");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','B',$term,$year,$form," and classin='$stream'");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','B-',$term,$year,$form,"");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','B-',$term,$year,$form," and classin='$stream'");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','C+',$term,$year,$form,"");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','C+',$term,$year,$form," and classin='$stream'");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','C',$term,$year,$form,"");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','C',$term,$year,$form," and classin='$stream'");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','C-',$term,$year,$form,"");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','C-',$term,$year,$form," and classin='$stream'");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','D+',$term,$year,$form,"");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','D+',$term,$year,$form," and classin='$stream'");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','D',$term,$year,$form,"");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','D',$term,$year,$form," and classin='$stream'");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','D-',$term,$year,$form,"");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','D-',$term,$year,$form," and classin='$stream'");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTallyMock('cregrade','E',$term,$year,$form,"");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}else{
		$cretally=$stally->getSubjectTallyMock('cregrade','E',$term,$year,$form," and classin='$stream'");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}
	
	$creStudents=0;
	if($stream=='Entire'){
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and cre>0");
	}else{
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and cre>0");
	}
	while ($rowcrestud = mysql_fetch_array($getcrestudents)) {// get admno
	$creStudents=$rowcrestud['adms'];
	}
	/*********************** GET AGRICULTURE GRADES *******************************/
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','A',$term,$year,$form,"");
		$agras=$agrtally['tally'];
		$agrA=$crede*12;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','A',$term,$year,$form," and classin='$stream'");
		$agras=$agrtally['tally'];
		$agrA=$agras*12;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','A-',$term,$year,$form,"");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','A-',$term,$year,$form," and classin='$stream'");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','B+',$term,$year,$form,"");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','B+',$term,$year,$form," and classin='$stream'");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','B',$term,$year,$form,"");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','B',$term,$year,$form," and classin='$stream'");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','B-',$term,$year,$form,"");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','B-',$term,$year,$form," and classin='$stream'");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','C+',$term,$year,$form,"");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','C+',$term,$year,$form," and classin='$stream'");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','C',$term,$year,$form,"");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','C',$term,$year,$form," and classin='$stream'");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','C-',$term,$year,$form,"");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','C-',$term,$year,$form," and classin='$stream'");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','D+',$term,$year,$form,"");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','D+',$term,$year,$form," and classin='$stream'");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','D',$term,$year,$form,"");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','D',$term,$year,$form," and classin='$stream'");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','D-',$term,$year,$form,"");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','D-',$term,$year,$form," and classin='$stream'");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','E',$term,$year,$form,"");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}else{
		$agrtally=$stally->getSubjectTallyMock('agriculturegrade','E',$term,$year,$form," and classin='$stream'");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}
	
	$agrStudents=0;
	if($stream=='Entire'){
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and agriculture>0");
	}else{
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and agriculture>0");
	}
	while ($rowagrstud = mysql_fetch_array($getagrstudents)) {// get admno
	$agrStudents=$rowagrstud['adms'];
	}
	
	/*********************** GET BUSINESS GRADES****************************/
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','A',$term,$year,$form,"");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','A',$term,$year,$form," and classin='$stream'");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','A-',$term,$year,$form,"");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','A-',$term,$year,$form," and classin='$stream'");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','B+',$term,$year,$form,"");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','B+',$term,$year,$form," and classin='$stream'");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','B',$term,$year,$form,"");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','B',$term,$year,$form," and classin='$stream'");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','B-',$term,$year,$form,"");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','B-',$term,$year,$form," and classin='$stream'");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','C+',$term,$year,$form,"");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','C+',$term,$year,$form," and classin='$stream'");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','C',$term,$year,$form,"");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','C',$term,$year,$form," and classin='$stream'");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','C-',$term,$year,$form,"");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','C-',$term,$year,$form," and classin='$stream'");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','D+',$term,$year,$form,"");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','D+',$term,$year,$form," and classin='$stream'");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','D',$term,$year,$form,"");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','D',$term,$year,$form," and classin='$stream'");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','D-',$term,$year,$form,"");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','D-',$term,$year,$form," and classin='$stream'");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','E',$term,$year,$form,"");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}else{
		$bsttally=$stally->getSubjectTallyMock('businesStudiesgrade','E',$term,$year,$form," and classin='$stream'");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}
	
	
	
	$bstStudents=0;
	if($stream=='Entire'){
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and businesStudies>0");
	}else{
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and businesStudies>0");
	}
	while ($rowbststud = mysql_fetch_array($getbststudents)) {// get admno
	$bstStudents=$rowbststud['adms'];
	}
	$frenchStudents=0;
	if($stream=='Entire'){
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and french > 0");
	}else{
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and french > 0");
	}
	while ($rowbststud = mysql_fetch_array($getfrenchStudents)) {// get admno
	$frenchStudents=$rowbststud['adms'];
	}
	
	
	$homeStudents=0;
	if($stream=='Entire'){
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and home>0");
	}else{
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and home>0");
	}
	while ($rowbststud = mysql_fetch_array($gethomeStudents)) {// get admno
	$homeStudents=$rowbststud['adms'];
	}
	
	
	$computerStudents=0;
	if($stream=='Entire'){
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and computer>0");
	}else{
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and computer>0");
	}
	while ($rowbststud = mysql_fetch_array($getcomputerStudents)) {// get admno
	$computerStudents=$rowbststud['adms'];
	}
	
	
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
	if($stream=='Entire'){
	
	$frenchtallys = $stally -> getGradesPerSubjectEntireMock("french","frenchgrade", $term,$year,$form); 
	}else{
	$frenchtallys = $stally -> getGradesPerSubjectMock("french","frenchgrade", $term,$year,$form,$stream); 
	                           //getGradesPerSubject("frenchgrade", $term,$year,$form,$stream);
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
	if($stream=='Entire'){
	
	$hometallys = $stally -> getGradesPerSubjectEntireMock("home","homegrade", $term,$year,$form); 
	}else{
	$hometallys = $stally -> getGradesPerSubjectMock("home","homegrade", $term,$year,$form,$stream); 
	
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
	if($stream=='Entire'){
	
	$computertallys = $stally -> getGradesPerSubjectEntireMock("computer","computergrade", $term,$year,$form); 
	}else{
	$computertallys = $stally -> getGradesPerSubjectMock("computer","computergrade", $term,$year,$form,$stream); 
	
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
	
	
	
		$frenchfinalgrade = $stally -> getFinalGrate($frenchmean);
		$homefinalgrade = $stally -> getFinalGrate($homemean);
		$computerfinalgrade = $stally -> getFinalGrate($computermean);
		
		    
	/*$engmean=round_up ( $totalEnglishPoints/$studentsare, 3 );
	$kismean=round_up ( $totalKiswahiliPoints/$studentsare, 3 );
	$mathmean=round_up ( $totalMathPoints/$studentsare, 3 );
	$biomean=round_up ( $totalBioPoints/$biologyStudents, 3 );
	$chemmean=round_up ( $totalChemPoints/$chemistryStudents, 3 );
	$phymean=round_up ( $totalPhysPoints/$physicsStudents, 3 );
	$hismean=round_up ( $totalHisPoints/$historyStudents, 3 );
	$geomean=round_up ( $totalGeoPoints/$geographyStudents, 3 );
	$cremean=round_up ( $totalCrePoints/$creStudents, 3 );
	$agrmean=round_up ( $totalAgrPoints/$agrStudents, 3 );
	$bstmean=round_up ( $totalBstPoints/$bstStudents, 3 );*/
	
	/*****************************************************************************************/
	if ($engmean > 0 && $engmean <= 1.499) {
			$efinalgrade = "E";
			
			// remarks="Work harder";
		} else if ($engmean >= 1.5 && $engmean <= 2.499) {
			$efinalgrade = "D-";
			// remarks="Improve";
		} else if ($engmean >= 2.5 && $engmean <= 3.499) {
			$efinalgrade = "D";
			// remarks="Improve";
		} else if ($engmean >= 3.5 && $engmean <= 4.499) {
			$efinalgrade = "D+";
			// remarks="Can do better";
		} else if ($engmean >= 4.5 && $engmean <= 5.499) {
			$efinalgrade = "C-";
			// remarks="Fair";
		} else if ($engmean >= 5.5 && $engmean <= 6.499) {
			$efinalgrade = "C";
			// remarks="Fair";
		} else if ($engmean >= 6.5 && $engmean <= 7.499) {
			$efinalgrade = "C+";
			// remarks="Fair";
		} else if ($engmean >= 7.5 && $engmean <= 8.499) {
			$efinalgrade = "B-";
			// remarks="Good";
		} else if ($engmean >= 8.5 && $engmean <= 9.499) {
			$efinalgrade = "B";
			// remarks="Good";
		} else if ($engmean >= 9.5 && $engmean <= 10.499) {
			$efinalgrade = "B+";
			// remarks="Good";
		} else if ($engmean >= 10.5 && $engmean <= 11.499) {
			$efinalgrade = "A-";
			// remarks="V. Good";
		} else if ($engmean >= 11.5 && $engmean <= 12.0) {
			$efinalgrade = "A";
			// remarks="Excellent";
		}else if ($engmean == 0) {
			$efinalgrade = "-";
			
		} 
		
		/***************************************************************************/
		
		if ($kismean > 0 && $kismean <= 1.499) {
			$kfinalgrade = "E";
			
			// remarks="Work harder";
		} else if ($kismean >= 1.5 && $kismean <= 2.499) {
			$kfinalgrade = "D-";
			// remarks="Improve";
		} else if ($kismean >= 2.5 && $kismean <= 3.499) {
			$kfinalgrade = "D";
			// remarks="Improve";
		} else if ($kismean >= 3.5 && $kismean <= 4.499) {
			$kfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($kismean >= 4.5 && $kismean <= 5.499) {
			$kfinalgrade = "C-";
			// remarks="Fair";
		} else if ($kismean >= 5.5 && $kismean <= 6.499) {
			$kfinalgrade = "C";
			// remarks="Fair";
		} else if ($kismean >= 6.5 && $kismean <= 7.499) {
			$kfinalgrade = "C+";
			// remarks="Fair";
		} else if ($kismean >= 7.5 && $kismean <= 8.499) {
			$kfinalgrade = "B-";
			// remarks="Good";
		} else if ($kismean >= 8.5 && $kismean <= 9.499) {
			$kfinalgrade = "B";
			// remarks="Good";
		} else if ($kismean >= 9.5 && $kismean <= 10.499) {
			$kfinalgrade = "B+";
			// remarks="Good";
		} else if ($kismean >= 10.5 && $kismean <= 11.499) {
			$kfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($kismean >= 11.5 && $kismean <= 12.0) {
			$kfinalgrade = "A";
			// remarks="Excellent";
		}else if ($kismean == 0) {
			$kfinalgrade = "-";
			
		} 
		
		/*************************************************************************/
		if ($mathmean > 0 && $mathmean <= 1.499) {
			$mfinalgrade = "E";
			
			// remarks="Work harder";
		} else if ($mathmean >= 1.5 && $mathmean <= 2.499) {
			$mfinalgrade = "D-";
			// remarks="Improve";
		} else if ($mathmean >= 2.5 && $mathmean <= 3.499) {
			$mfinalgrade = "D";
			// remarks="Improve";
		} else if ($mathmean >= 3.5 && $mathmean <= 4.499) {
			$mfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($mathmean >= 4.5 && $mathmean <= 5.499) {
			$mfinalgrade = "C-";
			// remarks="Fair";
		} else if ($mathmean >= 5.5 && $mathmean <= 6.499) {
			$mfinalgrade = "C";
			// remarks="Fair";
		} else if ($mathmean >= 6.5 && $mathmean <= 7.499) {
			$mfinalgrade = "C+";
			// remarks="Fair";
		} else if ($mathmean >= 7.5 && $mathmean <= 8.499) {
			$mfinalgrade = "B-";
			// remarks="Good";
		} else if ($mathmean >= 8.5 && $mathmean <= 9.499) {
			$mfinalgrade = "B";
			// remarks="Good";
		} else if ($mathmean >= 9.5 && $mathmean <= 10.499) {
			$mfinalgrade = "B+";
			// remarks="Good";
		} else if ($mathmean >= 10.5 && $mathmean <= 11.499) {
			$mfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($mathmean >= 11.5 && $mathmean <= 12.0) {
			$mfinalgrade = "A";
			// remarks="Excellent";
		}else if ($mathmean == 0) {
			$mfinalgrade = "-";
			
		} 
		/*********************************************************************************/
		if ($biomean > 0 && $biomean <= 1.499) {
			$bfinalgrade = "E";
			// remarks="Work harder";
		} else if ($biomean >= 1.5 && $biomean <= 2.499) {
			$bfinalgrade = "D-";
			// remarks="Improve";
		} else if ($biomean >= 2.5 && $biomean <= 3.499) {
			$bfinalgrade = "D";
			// remarks="Improve";
		} else if ($biomean >= 3.5 && $biomean <= 4.499) {
			$bfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($biomean >= 4.5 && $biomean <= 5.499) {
			$bfinalgrade = "C-";
			// remarks="Fair";
		} else if ($biomean >= 5.5 && $biomean <= 6.499) {
			$bfinalgrade = "C";
			// remarks="Fair";
		} else if ($biomean >= 6.5 && $biomean <= 7.499) {
			$bfinalgrade = "C+";
			// remarks="Fair";
		} else if ($biomean >= 7.5 && $biomean <= 8.499) {
			$bfinalgrade = "B-";
			// remarks="Good";
		} else if ($biomean >= 8.5 && $biomean <= 9.499) {
			$bfinalgrade = "B";
			// remarks="Good";
		} else if ($biomean >= 9.5 && $biomean <= 10.499) {
			$bfinalgrade = "B+";
			// remarks="Good";
		} else if ($biomean >= 10.5 && $biomean <= 11.499) {
			$bfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($biomean >= 11.5 && $biomean <= 12.0) {
			$bfinalgrade = "A";
			// remarks="Excellent";
		}else if ($biomean == 0) {
			$bfinalgrade = "-";
			
		} 
		/**************************************************************************************/
		if ($chemmean > 0 && $chemmean <= 1.499) {
			$chemfinalgrade = "E";
			// remarks="Work harder";
		} else if ($chemmean >= 1.5 && $chemmean <= 2.499) {
			$chemfinalgrade = "D-";
			// remarks="Improve";
		} else if ($chemmean >= 2.5 && $chemmean <= 3.499) {
			$chemfinalgrade = "D";
			// remarks="Improve";
		} else if ($chemmean >= 3.5 && $chemmean <= 4.499) {
			$chemfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($chemmean >= 4.5 && $chemmean <= 5.499) {
			$chemfinalgrade = "C-";
			// remarks="Fair";
		} else if ($chemmean >= 5.5 && $chemmean <= 6.499) {
			$chemfinalgrade = "C";
			// remarks="Fair";
		} else if ($chemmean >= 6.5 && $chemmean <= 7.499) {
			$chemfinalgrade = "C+";
			// remarks="Fair";
		} else if ($chemmean >= 7.5 && $chemmean <= 8.499) {
			$chemfinalgrade = "B-";
			// remarks="Good";
		} else if ($chemmean >= 8.5 && $chemmean <= 9.499) {
			$chemfinalgrade = "B";
			// remarks="Good";
		} else if ($chemmean >= 9.5 && $chemmean <= 10.499) {
			$chemfinalgrade = "B+";
			// remarks="Good";
		} else if ($chemmean >= 10.5 && $chemmean <= 11.499) {
			$chemfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($chemmean >= 11.5 && $chemmean <= 12.0) {
			$chemfinalgrade = "A";
			// remarks="Excellent";
		}else if ($chemmean == 0) {
			$chemfinalgrade = "-";
			
		} 
	/*****************************************************************************************/
	if ($phymean > 0 && $phymean <= 1.499) {
			$phyfinalgrade = "E";
			// remarks="Work harder";
		} else if ($phymean >= 1.5 && $phymean <= 2.499) {
			$phyfinalgrade = "D-";
			// remarks="Improve";
		} else if ($phymean >= 2.5 && $phymean <= 3.499) {
			$phyfinalgrade = "D";
			// remarks="Improve";
		} else if ($phymean >= 3.5 && $phymean <= 4.499) {
			$phyfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($phymean >= 4.5 && $phymean <= 5.499) {
			$phyfinalgrade = "C-";
			// remarks="Fair";
		} else if ($phymean >= 5.5 && $phymean <= 6.499) {
			$phyfinalgrade = "C";
			// remarks="Fair";
		} else if ($phymean >= 6.5 && $phymean <= 7.499) {
			$phyfinalgrade = "C+";
			// remarks="Fair";
		} else if ($phymean >= 7.5 && $phymean <= 8.499) {
			$phyfinalgrade = "B-";
			// remarks="Good";
		} else if ($phymean >= 8.5 && $phymean <= 9.499) {
			$phyfinalgrade = "B";
			// remarks="Good";
		} else if ($phymean >= 9.5 && $phymean <= 10.499) {
			$phyfinalgrade = "B+";
			// remarks="Good";
		} else if ($phymean >= 10.5 && $phymean <= 11.499) {
			$phyfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($phymean >= 11.5 && $phymean <= 12.0) {
			$phyfinalgrade = "A";
			// remarks="Excellent";
		}else if ($phymean == 0) {
			$phyfinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($hismean > 0 && $hismean <= 1.499) {
			$hisfinalgrade = "E";
			// remarks="Work harder";
		} else if ($hismean >= 1.5 && $hismean <= 2.499) {
			$hisfinalgrade = "D-";
			// remarks="Improve";
		} else if ($hismean >= 2.5 && $hismean <= 3.499) {
			$hisfinalgrade = "D";
			// remarks="Improve";
		} else if ($hismean >= 3.5 && $hismean <= 4.499) {
			$hisfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($hismean >= 4.5 && $hismean <= 5.499) {
			$hisfinalgrade = "C-";
			// remarks="Fair";
		} else if ($hismean >= 5.5 && $hismean <= 6.499) {
			$hisfinalgrade = "C";
			// remarks="Fair";
		} else if ($hismean >= 6.5 && $hismean <= 7.499) {
			$hisfinalgrade = "C+";
			// remarks="Fair";
		} else if ($hismean >= 7.5 && $hismean <= 8.499) {
			$hisfinalgrade = "B-";
			// remarks="Good";
		} else if ($hismean >= 8.5 && $hismean <= 9.499) {
			$hisfinalgrade = "B";
			// remarks="Good";
		} else if ($hismean >= 9.5 && $hismean <= 10.499) {
			$hisfinalgrade = "B+";
			// remarks="Good";
		} else if ($hismean >= 10.5 && $hismean <= 11.499) {
			$hisfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($hismean >= 11.5 && $hismean <= 12.0) {
			$hisfinalgrade = "A";
			// remarks="Excellent";
		}else if ($hismean == 0) {
			$hisfinalgrade = "-";
			
		} 
		/****************************************************************************************/
		if ($geomean > 0 && $geomean <= 1.499) {
			$geofinalgrade = "E";
			// remarks="Work harder";
		} else if ($geomean >= 1.5 && $geomean <= 2.499) {
			$geofinalgrade = "D-";
			// remarks="Improve";
		} else if ($geomean >= 2.5 && $geomean <= 3.499) {
			$geofinalgrade = "D";
			// remarks="Improve";
		} else if ($geomean >= 3.5 && $geomean <= 4.499) {
			$geofinalgrade = "D+";
			// remarks="Can do better";
		} else if ($geomean >= 4.5 && $geomean <= 5.499) {
			$geofinalgrade = "C-";
			// remarks="Fair";
		} else if ($geomean >= 5.5 && $geomean <= 6.499) {
			$geofinalgrade = "C";
			// remarks="Fair";
		} else if ($geomean >= 6.5 && $geomean <= 7.499) {
			$geofinalgrade = "C+";
			// remarks="Fair";
		} else if ($geomean >= 7.5 && $geomean <= 8.499) {
			$geofinalgrade = "B-";
			// remarks="Good";
		} else if ($geomean >= 8.5 && $geomean <= 9.499) {
			$geofinalgrade = "B";
			// remarks="Good";
		} else if ($geomean >= 9.5 && $geomean <= 10.499) {
			$geofinalgrade = "B+";
			// remarks="Good";
		} else if ($geomean >= 10.5 && $geomean <= 11.499) {
			$geofinalgrade = "A-";
			// remarks="V. Good";
		} else if ($geomean >= 11.5 && $geomean <= 12.0) {
			$geofinalgrade = "A";
			// remarks="Excellent";
		}else if ($geomean == 0) {
			$geofinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($cremean > 0 && $cremean <= 1.499) {
			$crefinalgrade = "E";
			// remarks="Work harder";
		} else if ($cremean >= 1.5 && $cremean <= 2.499) {
			$crefinalgrade = "D-";
			// remarks="Improve";
		} else if ($cremean >= 2.5 && $cremean <= 3.499) {
			$crefinalgrade = "D";
			// remarks="Improve";
		} else if ($cremean >= 3.5 && $cremean <= 4.499) {
			$crefinalgrade = "D+";
			// remarks="Can do better";
		} else if ($cremean >= 4.5 && $cremean <= 5.499) {
			$crefinalgrade = "C-";
			// remarks="Fair";
		} else if ($cremean >= 5.5 && $cremean <= 6.499) {
			$crefinalgrade = "C";
			// remarks="Fair";
		} else if ($cremean >= 6.5 && $cremean <= 7.499) {
			$crefinalgrade = "C+";
			// remarks="Fair";
		} else if ($cremean >= 7.5 && $cremean <= 8.499) {
			$crefinalgrade = "B-";
			// remarks="Good";
		} else if ($cremean >= 8.5 && $cremean <= 9.499) {
			$crefinalgrade = "B";
			// remarks="Good";
		} else if ($cremean >= 9.5 && $cremean <= 10.499) {
			$crefinalgrade = "B+";
			// remarks="Good";
		} else if ($cremean >= 10.5 && $cremean <= 11.499) {
			$crefinalgrade = "A-";
			// remarks="V. Good";
		} else if ($cremean >= 11.5 && $cremean <= 12.0) {
			$crefinalgrade = "A";
			// remarks="Excellent";
		}else if ($cremean == 0) {
			$crefinalgrade = "-";
			
		} 
		/****************************************************************************************/
		if ($agrmean > 0 && $agrmean <= 1.499) {
			$agrfinalgrade = "E";
			// remarks="Work harder";
		} else if ($agrmean >= 1.5 && $agrmean <= 2.499) {
			$agrfinalgrade = "D-";
			// remarks="Improve";
		} else if ($agrmean >= 2.5 && $agrmean <= 3.499) {
			$agrfinalgrade = "D";
			// remarks="Improve";
		} else if ($agrmean >= 3.5 && $agrmean <= 4.499) {
			$agrfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($agrmean >= 4.5 && $agrmean <= 5.499) {
			$agrfinalgrade = "C-";
			// remarks="Fair";
		} else if ($agrmean >= 5.5 && $agrmean <= 6.499) {
			$agrfinalgrade = "C";
			// remarks="Fair";
		} else if ($agrmean >= 6.5 && $agrmean <= 7.499) {
			$agrfinalgrade = "C+";
			// remarks="Fair";
		} else if ($agrmean >= 7.5 && $agrmean <= 8.499) {
			$agrfinalgrade = "B-";
			// remarks="Good";
		} else if ($agrmean >= 8.5 && $agrmean <= 9.499) {
			$agrfinalgrade = "B";
			// remarks="Good";
		} else if ($agrmean >= 9.5 && $agrmean <= 10.499) {
			$agrfinalgrade = "B+";
			// remarks="Good";
		} else if ($agrmean >= 10.5 && $agrmean <= 11.499) {
			$agrfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($agrmean >= 11.5 && $agrmean <= 12.0) {
			$agrfinalgrade = "A";
			// remarks="Excellent";
		}else if ($agrmean == 0) {
			$agrfinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($bstmean > 0 && $bstmean <= 1.499) {
			$bstfinalgrade = "E";
			// remarks="Work harder";
		} else if ($bstmean >= 1.5 && $bstmean <= 2.499) {
			$bstfinalgrade = "D-";
			// remarks="Improve";
		} else if ($bstmean >= 2.5 && $bstmean <= 3.499) {
			$bstfinalgrade = "D";
			// remarks="Improve";
		} else if ($bstmean >= 3.5 && $bstmean <= 4.499) {
			$bstfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($bstmean >= 4.5 && $bstmean <= 5.499) {
			$bstfinalgrade = "C-";
			// remarks="Fair";
		} else if ($bstmean >= 5.5 && $bstmean <= 6.499) {
			$bstfinalgrade = "C";
			// remarks="Fair";
		} else if ($bstmean >= 6.5 && $bstmean <= 7.499) {
			$bstfinalgrade = "C+";
			// remarks="Fair";
		} else if ($bstmean >= 7.5 && $bstmean <= 8.499) {
			$bstfinalgrade = "B-";
			// remarks="Good";
		} else if ($bstmean >= 8.5 && $bstmean <= 9.499) {
			$bstfinalgrade = "B";
			// remarks="Good";
		} else if ($bstmean >= 9.5 && $bstmean <= 10.499) {
			$bstfinalgrade = "B+";
			// remarks="Good";
		} else if ($bstmean >= 10.5 && $bstmean <= 11.499) {
			$bstfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($bstmean >= 11.5 && $bstmean <= 12.0) {
			$bstfinalgrade = "A";
			// remarks="Excellent";
		}else if ($bstmean == 0) {
			$bstfinalgrade = "-";
			
		} 
		    
		/***********************************************************************************/
?>
          <form  method='get' name='pdiv'>
            <div id="div_print_analysis"> <?php echo "
	
     <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
 		
		<tr>
		   <td>&nbsp;&nbsp;&nbsp;</td>
		   <td align=center colspan=2>English</td>
		    <td align=center colspan=2>Kiswahili</td>
			<td align=center colspan=2>Maths</td>
			<td align=center colspan=2>Biology</td>
			<td align=center colspan=2>Chemistry</td>
			<td align=center colspan=2>Physics</td>
			<td align=center colspan=2>History</td>
			<td align=center colspan=2>Geography</td>
			<td align=center colspan=2>C.R.E</td>
			<td align=center colspan=2>Agriculture</td>
			<td align=center colspan=2>B/studies</td>
			<td align=center colspan=2>French</td>
			<td align=center colspan=2>H/Science</td>
			<td align=center colspan=2>Computer</td>
			</tr>
		   <tr>
		   <td><strong>A</strong></td>
		   <td align=center colspan=2>$englishas</td>
		    <td align=center colspan=2>$kisas</td>
			<td align=center colspan=2>$mathas</td>
			<td align=center colspan=2>$bioas</td>
			<td align=center colspan=2>$chemas</td>
			<td align=center colspan=2>$phyas</td>
			<td align=center colspan=2>$hisas</td>
			<td align=center colspan=2>$geoas</td>
			<td align=center colspan=2>$creas</td>
			<td align=center colspan=2>$agras</td>
			<td align=center colspan=2>$bstas</td>
			
			<td align=center colspan=2>$frenchas</td>
			<td align=center colspan=2>$homeas</td>
			<td align=center colspan=2>$computeras</td>
			</tr>
			<tr>
		   <td><strong>A-</strong></td>
		   <td align=center colspan=2>$englisham</td>
		    <td align=center colspan=2>$kisam</td>
			<td align=center colspan=2>$matham</td>
			<td align=center colspan=2>$bioam</td>
			<td align=center colspan=2>$chemam</td>
			<td align=center colspan=2>$phyam</td>
			<td align=center colspan=2>$hisam</td>
			<td align=center colspan=2>$geoam</td>
			<td align=center colspan=2>$cream</td>
			<td align=center colspan=2>$agram</td>
			<td align=center colspan=2>$bstam</td>
			
			<td align=center colspan=2>$frencham</td>
			<td align=center colspan=2>$homeam</td>
			<td align=center colspan=2>$computeram</td>
			</tr>
			<tr>
		   <td><strong>B+</strong></td>
		   <td align=center colspan=2>$englishabp</td>
		    <td align=center colspan=2>$kisbp</td>
			<td align=center colspan=2>$mathbp</td>
			<td align=center colspan=2>$biobp</td>
			<td align=center colspan=2>$chembp</td>
			<td align=center colspan=2>$phybp</td>
			<td align=center colspan=2>$hisbp</td>
			<td align=center colspan=2>$geobp</td>
			<td align=center colspan=2>$crebp</td>
			<td align=center colspan=2>$agrbp</td>
			<td align=center colspan=2>$bstbp</td>
			
			<td align=center colspan=2>$frenchbp</td>
			<td align=center colspan=2>$homebp</td>
			<td align=center colspan=2>$computerbp</td>
			</tr>
			<tr>
		   <td><strong>B</strong></td>
		   <td align=center colspan=2>$englishab</td>
		    <td align=center colspan=2>$kisb</td>
			<td align=center colspan=2>$mathb</td>
			<td align=center colspan=2>$biob</td>
			<td align=center colspan=2>$chemb</td>
			<td align=center colspan=2>$phyb</td>
			<td align=center colspan=2>$hisb</td>
			<td align=center colspan=2>$geob</td>
			<td align=center colspan=2>$creb</td>
			<td align=center colspan=2>$agrb</td>
			<td align=center colspan=2>$bstb</td>
			
			<td align=center colspan=2>$frenchb</td>
			<td align=center colspan=2>$homeb</td>
			<td align=center colspan=2>$computerb</td>
			
		
			</tr>
			<tr>
		   <td><strong>B-</strong></td>
		   <td align=center colspan=2>$englishabm</td>
		    <td align=center colspan=2>$kisbm</td>
			<td align=center colspan=2>$mathbm</td>
			<td align=center colspan=2>$biobm</td>
			<td align=center colspan=2>$chembm</td>
			<td align=center colspan=2>$phybm</td>
			<td align=center colspan=2>$hisbm</td>
			<td align=center colspan=2>$geobm</td>
			<td align=center colspan=2>$crebm</td>
			<td align=center colspan=2>$agrbm</td>
			<td align=center colspan=2>$bstbm</td>
			
			<td align=center colspan=2>$frenchbm</td>
			<td align=center colspan=2>$homebm</td>
			<td align=center colspan=2>$computerbm</td>
			
			</tr>
			<tr>
		   <td><strong>C+</strong></td>
		   <td align=center colspan=2>$englishacp</td>
		    <td align=center colspan=2>$kiscp</td>
			<td align=center colspan=2>$mathcp</td>
			<td align=center colspan=2>$biocp</td>
			<td align=center colspan=2>$chemcp</td>
			<td align=center colspan=2>$phycp</td>
			<td align=center colspan=2>$hiscp</td>
			<td align=center colspan=2>$geocp</td>
			<td align=center colspan=2>$crecp</td>
			<td align=center colspan=2>$agrcp</td>
			<td align=center colspan=2>$bstcp</td>
			
			<td align=center colspan=2>$frenchcp</td>
			<td align=center colspan=2>$homecp</td>
			<td align=center colspan=2>$computercp</td>
			
			</tr>
			<tr>
		   <td><strong>C</strong></td>
		   <td align=center colspan=2>$englishac</td>
		    <td align=center colspan=2>$kisc</td>
			<td align=center colspan=2>$mathc</td>
			<td align=center colspan=2>$bioc</td>
			<td align=center colspan=2>$chemc</td>
			<td align=center colspan=2>$phyc</td>
			<td align=center colspan=2>$hisc</td>
			<td align=center colspan=2>$geoc</td>
			<td align=center colspan=2>$crec</td>
			<td align=center colspan=2>$agrc</td>
			<td align=center colspan=2>$bstc</td>
			
			<td align=center colspan=2>$frenchc</td>
			<td align=center colspan=2>$homec</td>
			<td align=center colspan=2>$computerc</td>
			</tr>
			<tr>
		   <td><strong>C-</strong></td>
		   <td align=center colspan=2>$englishacm</td>
		    <td align=center colspan=2>$kiscm</td>
			<td align=center colspan=2>$mathcm</td>
			<td align=center colspan=2>$biocm</td>
			<td align=center colspan=2>$chemcm</td>
			<td align=center colspan=2>$phycm</td>
			<td align=center colspan=2>$hiscm</td>
			<td align=center colspan=2>$geocm</td>
			<td align=center colspan=2>$crecm</td>
			<td align=center colspan=2>$agrcm</td>
			<td align=center colspan=2>$bstcm</td>
			
			<td align=center colspan=2>$frenchcm</td>
			<td align=center colspan=2>$homecm</td>
			<td align=center colspan=2>$computercm</td>
			</tr>
			<tr>
		   <td><strong>D+</strong></td>
		   <td align=center colspan=2>$englishadp</td>
		    <td align=center colspan=2>$kisdp</td>
			<td align=center colspan=2>$mathdp</td>
			<td align=center colspan=2>$biodp</td>
			<td align=center colspan=2>$chemdp</td>
			<td align=center colspan=2>$phydp</td>
			<td align=center colspan=2>$hisdp</td>
			<td align=center colspan=2>$geodp</td>
			<td align=center colspan=2>$credp</td>
			<td align=center colspan=2>$agrdp</td>
			<td align=center colspan=2>$bstdp</td>
			
			<td align=center colspan=2>$frenchdp</td>
			<td align=center colspan=2>$homedp</td>
			<td align=center colspan=2>$computerdp</td>
			</tr>
			<tr bgcolor=WHITE>
		   <td><strong>D</strong></td>
		   <td align=center colspan=2>$englishad</td>
		    <td align=center colspan=2>$kisd</td>
			<td align=center colspan=2>$mathd</td>
			<td align=center colspan=2>$biod</td>
			<td align=center colspan=2>$chemd</td>
			<td align=center colspan=2>$phyd</td>
			<td align=center colspan=2>$hisd</td>
			<td align=center colspan=2>$geod</td>
			<td align=center colspan=2>$cred</td>
			<td align=center colspan=2>$agrd</td>
			<td align=center colspan=2>$bstd</td>
			
			<td align=center colspan=2>$frenchd</td>
			<td align=center colspan=2>$homed</td>
			<td align=center colspan=2>$computerd</td>
			</tr>
			<tr>
		   <td><strong>D-</strong></td>
		   <td align=center colspan=2>$englishadm</td>
		    <td align=center colspan=2>$kisdm</td>
			<td align=center colspan=2>$mathdm</td>
			<td align=center colspan=2>$biodm</td>
			<td align=center colspan=2>$chemdm</td>
			<td align=center colspan=2>$phydm</td>
			<td align=center colspan=2>$hisdm</td>
			<td align=center colspan=2>$geodm</td>
			<td align=center colspan=2>$credm</td>
			<td align=center colspan=2>$agrdm</td>
			<td align=center colspan=2>$bstdm</td>
			
			<td align=center colspan=2>$frenchdm</td>
			<td align=center colspan=2>$homedm</td>
			<td align=center colspan=2>$computerdm</td>
			</tr>
			<tr bgcolor=WHITE>
		   <td>E</td>
		   <td align=center colspan=2>$englishade</td>
		    <td align=center colspan=2>$kisde</td>
			<td align=center colspan=2>$mathde</td>
			<td align=center colspan=2>$biode</td>
			<td align=center colspan=2>$chemde</td>
			<td align=center colspan=2>$phyde</td>
			<td align=center colspan=2>$hisde</td>
			<td align=center colspan=2>$geode</td>
			<td align=center colspan=2>$crede</td>
			<td align=center colspan=2>$agrde</td>
			<td align=center colspan=2>$bstde</td>
			
			<td align=center colspan=2>$frenchde</td>
			<td align=center colspan=2>$homede</td>
			<td align=center colspan=2>$computerde</td>
			</tr>
			
			<tr>
		   <td>Total Pts</td>
		   <td align=center colspan=2>$totalEnglishPoints</td>
		    <td align=center colspan=2>$totalKiswahiliPoints</td>
			<td align=center colspan=2>$totalMathPoints</td>
			<td align=center colspan=2>$totalBioPoints</td>
			<td align=center colspan=2>$totalChemPoints</td>
			<td align=center colspan=2>$totalPhysPoints</td>
			<td align=center colspan=2>$totalHisPoints</td>
			<td align=center colspan=2>$totalGeoPoints</td>
			<td align=center colspan=2>$totalCrePoints</td>
			<td align=center colspan=2>$totalAgrPoints</td>
			<td align=center colspan=2>$totalBstPoints</td>
			
			<td align=center colspan=2>$totalfrenchPoints</td>
			<td align=center colspan=2>$totalhomePoints</td>
			<td align=center colspan=2>$totalcomputerPoints</td>
			</tr>
			<tr>
		   <td>Students</td>
		   <td align=center colspan=2>$studentsare</td>
		    <td align=center colspan=2>$studentsare</td>
			<td align=center colspan=2>$studentsare</td>
			<td align=center colspan=2>$biologyStudents</td>
			<td align=center colspan=2>$chemistryStudents</td>
			<td align=center colspan=2>$physicsStudents</td>
			<td align=center colspan=2>$historyStudents</td>
			<td align=center colspan=2>$geographyStudents</td>
			<td align=center colspan=2>$creStudents</td>
			<td align=center colspan=2>$agrStudents</td>
			<td align=center colspan=2>$bstStudents</td>
			
			<td align=center colspan=2>$frenchStudents</td>
			<td align=center colspan=2>$homeStudents</td>
			<td align=center colspan=2>$computerStudents</td>
			
			</tr>
			<tr>
		   <td>MEAN</td>
		   <td align=center colspan=2>$engmean</td>
		    <td align=center colspan=2>$kismean</td>
			<td align=center colspan=2>$mathmean</td>
			<td align=center colspan=2>$biomean</td>
			<td align=center colspan=2>$chemmean</td>
			<td align=center colspan=2>$phymean</td>
			<td align=center colspan=2>$hismean</td>
			<td align=center colspan=2>$geomean</td>
			<td align=center colspan=2>$cremean</td>
			<td align=center colspan=2>$agrmean</td>
			<td align=center colspan=2>$bstmean</td>
			
			<td align=center colspan=2>$frenchmean</td>
			<td align=center colspan=2>$homemean</td>
			<td align=center colspan=2>$computermean</td>
			</tr>
			<tr>
		   <td>GRADE</td>
		   <td align=center colspan=2>$efinalgrade</td>
		    <td align=center colspan=2>$kfinalgrade</td>
			<td align=center colspan=2>$mfinalgrade</td>
			<td align=center colspan=2>$bfinalgrade</td>
			<td align=center colspan=2>$chemfinalgrade</td>
			<td align=center colspan=2>$phyfinalgrade</td>
			<td align=center colspan=2>$hisfinalgrade</td>
			<td align=center colspan=2>$geofinalgrade</td>
			<td align=center colspan=2>$crefinalgrade</td>
			<td align=center colspan=2>$agrfinalgrade</td>
			<td align=center colspan=2>$bstfinalgrade</td>
			
			<td align=center colspan=2>$frenchfinalgrade</td>
			<td align=center colspan=2>$homefinalgrade</td>
			<td align=center colspan=2>$computerfinalgrade</td>
			</tr>
	</table>
  </td>
 </tr>";
 ?> </div>
            <!-- end of analysis div-->
          </form>
          <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe></td>
      </tr>
     
      </tbody>
      
    </table>
  </div>
  <!-- end of whole prints div-->
  </form>
  <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
  </td>
  </tr>
  </table>
  <!-----************************************************************************************-->
</div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
