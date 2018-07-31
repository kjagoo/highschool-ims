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
        <td class="dataListHeader"> General Exams Spreadsheet Analysis:- Form <?php echo $form." ". $stream?> - Term <?php echo $term?> - Year <?php echo $year?>
          <div style="float:right; margin-right:5px;">
            <table width="100%">
              <tr>
                <td><a href=javascript:printDiv('div_print') title="Print Report"><i class="icon icon-green icon-print"></i>Print Analysis</a> </td>
                <td align="left"><a href=javascript:printDiv('div_print_analysis') title="Print Report"><i class="icon icon-green icon-print"></i>Print Subjects Analysis</a> </td>
				 <td align="left"><a href="pdf_generalanalysis.php?form=<?php echo $form?>&class=<?php echo $stream?>&term=<?php echo $term?>&year=<?php echo $year?>&amode=<?php echo $amode?>" title="Print PDF Report"><i class="icon icon-red icon-pdf"></i>Export PDF</a> </td>
              </tr>
            </table>
          </div></td>
      </tr>
      <tr>
        <td>
		<form  method='get' name='pdiv'>
          <div id="div_print" style="width:100%">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
			  <td align="left">Adm</td>
              <td align="center">Full Name</td>
			  <td align="left"></td>
			  <td>KCPE</td>
              <td align="center" colspan="2">Eng</td>
              <td align="center" colspan="2">Kis</td>
              <td align="center" colspan="2">Math</td>
              <td align="center" colspan="2">Bio</td>
              <td align="center" colspan="2">Phy</td>
              <td align="center" colspan="2">Chem</td>
              <td align="center" colspan="2">His</td>
              <td align="center" colspan="2">Geo</td>
              <td align="center" colspan="2">Cre</td>
              <td align="center" colspan="2">Agr</td>
              <td align="center" colspan="2">B/st</td>
			  <td align="center" colspan="2">Fre</td>
			  <td align="center" colspan="2">Comp</td>
			  <td align="center" colspan="2">H/Sci</td>
              <td align="center">Mks</td>
              <td align="center">Pts</td>
              <td align="center">MSS</td>
			   <td align="center">VAP</td>
			  <td align="center">PI</td>
              <td align="left">G</td>
              <td align="center"># C</td>
			  <td align="center"># Ovl</td>
            </tr>
          </thead>
          <tbody>
            <?php
	include 'includes/PerformanceIndicator.php';
	$pin = new PI();
	$pin->getPI($form,$term,$stream,$year,"Exam");
	
	
	$num=0;
	$totals=0;
	if($stream=='Entire'){
	$cat1="SELECT tg.*,p.position,p.positionclass FROM totalygradedmarks AS tg JOIN 
positions p ON tg.adm=p.admno  WHERE  tg.term='$term' and tg.year='$year' and tg.form='$form' AND  p.term='$term' and p.year='$year' and p.form='$form' ORDER BY tg.".$positionby." DESC, tg.".$alternatepositionby." DESC";
	}else{
	$cat1="SELECT tg.*,p.position,p.positionclass FROM totalygradedmarks AS tg JOIN 
positions p ON tg.adm=p.admno  WHERE  tg.term='$term' and tg.year='$year' and tg.form='$form' and tg.classin='$stream' AND  p.term='$term' and p.year='$year' and p.form='$form' ORDER BY tg.".$positionby." DESC, tg.".$alternatepositionby." DESC";
	
	//"select * from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' order by $positionby desc, $alternatepositionby desc";
	}
	
	
	$result = mysql_query($cat1);
	while ($rowr = mysql_fetch_array($result)) {// get admno
	$num++;
	$admno=$rowr['adm'];
	$kmrks=$rowr['marks'];
	$fname=$rowr['names'];
	$eng=$rowr['english'];
	$enggrade=$rowr['englishgrade'];
	$kis=$rowr['kiswahili'];
	$kisgrade=$rowr['kiswahiligrade'];
	$math=$rowr['mathematics'];
	$mathgrade=$rowr['mathimaticsgrade'];
	$bio=$rowr['biology'];
	$biograde=$rowr['biologygrade'];
	$chem=$rowr['chemistry'];
	$chemgrade=$rowr['chemistrygrade'];
	$phy=$rowr['physics'];
	$phygrade=$rowr['physicsgrade'];
	$his=$rowr['history'];
	$hisgrade=$rowr['historygrade'];
	$geo=$rowr['geography'];
	$geograde=$rowr['geographygrade'];
	$cre=$rowr['cre'];
	$cregrade=$rowr['cregrade'];
	$agr=$rowr['agriculture'];
	$agrgrade=$rowr['agriculturegrade'];
	$bst=$rowr['businesStudies'];
	$bstgrade=$rowr['businesStudiesgrade'];
	
	$french=$rowr['french'];
	$frenchgrade=$rowr['frenchgrade'];
	
	$comp=$rowr['computer'];
	$compgrade=$rowr['computergrade'];
	
	$home=$rowr['home'];
	$homegrade=$rowr['homegrade'];
	$positionis=$rowr['position'];
	$positionclass=$rowr['positionclass'];
	
	
	$totalpoints=$rowr['points'];
	$mss=$rowr['averagepoints'];
	$tgrade=$rowr['tgrade'];
	$grade="&nbsp;&nbsp;-";
	$totals=$rowr['totalmarks'];
	
	
	$pi=0;
	$resultf = mysql_query("select * from totalperformanceindex where adm='$admno' and  year='$year' and form='$form' and term='$term'");
	while ($rowf = mysql_fetch_array($resultf)){
	$pi=$rowf['pindex'];
	$vap=$rowf['vap'];
	}
	
	if($bio==0){
	$bio="-";
	$biograde="-";
		}else{
	  $bio=$bio;
	 }
	 if($chem==0){
	$chem="-";
	$chemgrade="-";
		}else{
	  $chem=$chem;
	 }
	 if($phy==0){
	$phy="-";
	$phygrade="-";
		}else{
	  $phy=$phy;
	 }
	 if($his==0){
	$his="-";
	$hisgrade="-";
		}else{
	  $his=$his;
	 }
	if($geo==0){
	$geo="-";
	$geograde="-";
		}else{
	  $geo=$geo;
	 }
	 if($cre==0){
	$cre="-";
	$cregrade="-";
		}else{
	  $cre=$cre;
	 } 
	 if($home==0){
	$home="-";
	$homegrade="-";
		}else{
	  $home=$home;
	 }
	  if($agr==0){
	$agr="-";
	$agrggrade="-";
		}else{
	  $agr=$agr;
	 }
	 if($comp==0){
	$comp="-";
	$compgrade="-";
		}else{
	  $comp=$comp;
	 }
	  if($french==0){
	$french="-";
	$frenchgrade="-";
		}else{
	  $french=$french;
	 }
	  if($bst==0){
	$bst="-";
	$bstgrade="-";
		}else{
	  $bst=$bst;
	 }
	
	
	
	//$totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst;
	?>
            <tr>
			<td><?php echo $admno?></td>
              <td><?php echo $fname?></td>
			  <td><?php echo $rowr['classin']?></td>
			  <td align=left><?php echo $kmrks?></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $eng?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $enggrade;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $kis?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $kisgrade;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $math?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $mathgrade; ?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $bio?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $biograde;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $phy?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $phygrade;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $chem?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $chemgrade;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $his?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $hisgrade;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $geo?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $geograde; ?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $cre?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $cregrade;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $agr?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $agrgrade;?></font></td>
              <td align="right" bgcolor="#E1FFFF"><?php echo $bst?></td>
              <td align="left"  bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $bstgrade; ?></font></td>
			  <td align="right" bgcolor="#E1FFFF"><?php echo $french;?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $frenchgrade?></font></td>
			  
			  <td align="right" bgcolor="#E1FFFF"><?php echo $comp;?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $compgrade?></font></td>
			  
			  <td align="right" bgcolor="#E1FFFF"><?php echo $home;?></td>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $homegrade?></font></td>
			  
              <td align="right" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $totals?></font></td>
              <td align="right" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $totalpoints?></font></td>
              <td align="right" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $mss?></font></td>
			  <?php 
			  if($vap<0 || $vap==0){?>
			   <td align="right" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $vap?></font></td>
			 <?php }else{
			  ?>
			  <td align="right" bgcolor="#E1FFFF"><font color="#000066"><?php echo $vap?></font></td>
			  <?php } ?>
			  <?php 
			  if($pi<0 || $pi==0){?>
			   <td align="right" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $pi?></font></td>
			 <?php }else{
			  ?>
			  <td align="right" bgcolor="#E1FFFF"><font color="#000066"><?php echo $pi?></font></td>
			  <?php } ?>
              <td align="left" bgcolor="#E1FFFF"><font color="#FF0000"><?php echo $tgrade?></font></td>
			  <td align="right" bgcolor="#E1FFFF"><font color="#FF00FF"><?php echo $positionclass?></font></td>
              <td align="right" bgcolor="#E1FFFF"><font color="#FF00FF"><?php echo $positionis?></font></td>
            </tr>
            <?php  
	 }// end of geting admno
	?> 
<tr>
   <td colspan="31" align='center'>
     <table class="borders" cellpadding="5" cellspacing="0">
      <tr>
   	 <td class="dataListHeader"><font color="#FFFFFF">Most Inproved Students</font></td>
 	 </tr>
	  <tr>
    <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th> No.</th>
            <th> Adm No</th>
            <th> Student Name </th>
			 <th> KCPE M.S.S</th>
            <th> Previous M.S.S</th>
            <th> Current M.S.S </th>
			<th> V.A.P </th>
            <th> P.I. </th>
          </tr>
        </thead>
        <tbody>
		<?php
		$resultf = mysql_query("select * from totalperformanceindex where year='$year' and form='$form' and term='$term' and classin='$stream' order by pindex desc limit 0,10");
		$num=0;
		$rowscount=mysql_num_rows($resultf);
   		if($rowscount==1 ||$rowscount>1){
		while ($rowf = mysql_fetch_array($resultf)){
			$num++;	
		?>
		<tr>
		<td><?php echo $num?> </td>
		<td><?php echo $rowf['adm']?> </td>
		<td><?php echo $rowf['names']?> </td>
		<td><?php echo $rowf['kcpemean']?> </td>
		<td><?php echo $rowf['previous']?> </td>
		<td><?php echo $rowf['current']?></td>
		<td><?php echo $rowf['vap']?> </td>
		<td><?php echo $rowf['pindex']?> </td>
		</tr>
		<?php
		}
		}else{}
		?>
        </tbody>
      </table></td>
  </tr>
	
	</table>
   </td>
 </tr>
	 
	 <?php
	 if($stream=='Entire'){
		$geta = mysql_query("select count(tgrade) as a from totalygradedmarks where tgrade='A' and term='$term' and year='$year' and form='$form'");
	}else{
		$geta = mysql_query("select count(tgrade) as a from totalygradedmarks where tgrade='A' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($geta)) {// get admno
	$as=$rowAS['a'];
	
	}
	
	 if($stream=='Entire'){
	$getam = mysql_query("select count(tgrade) as am from totalygradedmarks where tgrade='A-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getam = mysql_query("select count(tgrade) as am from totalygradedmarks where tgrade='A-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getam)) {// get admno
	$am=$rowAS['am'];

	}
	if($stream=='Entire'){
	$getbp = mysql_query("select count(tgrade) as bp from totalygradedmarks where tgrade='B+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbp = mysql_query("select count(tgrade) as bp from totalygradedmarks where tgrade='B+' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getbp)) {// get admno
	$bp=$rowAS['bp'];
	}
	
	if($stream=='Entire'){
	$getbs = mysql_query("select count(tgrade) as bs from totalygradedmarks where tgrade='B' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbs = mysql_query("select count(tgrade) as bs from totalygradedmarks where tgrade='B' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getbs)) {// get admno
	$bs=$rowAS['bs'];
	}
	
	if($stream=='Entire'){
	$getbm = mysql_query("select count(tgrade) as bm from totalygradedmarks where tgrade='B-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbm = mysql_query("select count(tgrade) as bm from totalygradedmarks where tgrade='B-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getbm)) {// get admno
	$bm=$rowAS['bm'];
	}
	
	
	if($stream=='Entire'){
	$getcp = mysql_query("select count(tgrade) as cp from totalygradedmarks where tgrade='C+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcp = mysql_query("select count(tgrade) as cp from totalygradedmarks where tgrade='C+' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getcp)) {// get admno
	$cp=$rowAS['cp'];
	}
	
	if($stream=='Entire'){
	$getcs = mysql_query("select count(tgrade) as cs from totalygradedmarks where tgrade='C' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcs = mysql_query("select count(tgrade) as cs from totalygradedmarks where tgrade='C' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getcs)) {// get admno
	$cs=$rowAS['cs'];
	}
	
	if($stream=='Entire'){
	$getcm = mysql_query("select count(tgrade) as cm from totalygradedmarks where tgrade='C-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcm = mysql_query("select count(tgrade) as cm from totalygradedmarks where tgrade='C-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getcm)) {// get admno
	$cm=$rowAS['cm'];
	}
	
	if($stream=='Entire'){
	$getdp = mysql_query("select count(tgrade) as dp from totalygradedmarks where tgrade='D+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getdp = mysql_query("select count(tgrade) as dp from totalygradedmarks where tgrade='D+' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getdp)) {// get admno
	$dp=$rowAS['dp'];
	}
	
	if($stream=='Entire'){
	$getds = mysql_query("select count(tgrade) as ds from totalygradedmarks where tgrade='D' and term='$term' and year='$year' and form='$form'");
	}else{
	$getds = mysql_query("select count(tgrade) as ds from totalygradedmarks where tgrade='D' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getds)) {// get admno
	$ds=$rowAS['ds'];
	}
	
	
	if($stream=='Entire'){
	$getdm = mysql_query("select count(tgrade) as dm from totalygradedmarks where tgrade='D-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getdm = mysql_query("select count(tgrade) as dm from totalygradedmarks where tgrade='D-' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getdm)) {// get admno
	$dm=$rowAS['dm'];
	}
	
	
	if($stream=='Entire'){
	$getes = mysql_query("select count(tgrade) as esd from totalygradedmarks where tgrade='E' and term='$term' and year='$year' and form='$form'");
	}else{
	$getes = mysql_query("select count(tgrade) as esd from totalygradedmarks where tgrade='E' and term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowAS = mysql_fetch_array($getes)) {// get admno
	$es=$rowAS['esd'];
	
	}
	
	$studentsare=0;
	if($stream=='Entire'){
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form'");
	}else{
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream'");
	}
	while ($rowstud = mysql_fetch_array($getstudents)) {// get admno
	$studentsare=$rowstud['adms'];
	}
	
	
	function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

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
	
	if($stream=='Entire'){
	
	$englishtallys = $stally -> getGradesPerSubjectEntire("english","englishgrade", $term,$year,$form); 
	
	}
	else{
	
	$englishtallys = $stally -> getGradesPerSubject("english","englishgrade", $term,$year,$form,$stream); 
	
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
	if($stream=='Entire'){
	
	$frenchtallys = $stally -> getGradesPerSubjectEntire("french","frenchgrade", $term,$year,$form); 
	}else{
	$frenchtallys = $stally -> getGradesPerSubject("french","frenchgrade", $term,$year,$form,$stream); 
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
	
	$hometallys = $stally -> getGradesPerSubjectEntire("home","homegrade", $term,$year,$form); 
	}else{
	$hometallys = $stally -> getGradesPerSubject("home","homegrade", $term,$year,$form,$stream); 
	
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
	
	$computertallys = $stally -> getGradesPerSubjectEntire("computer","computergrade", $term,$year,$form); 
	}else{
	$computertallys = $stally -> getGradesPerSubject("computer","computergrade", $term,$year,$form,$stream); 
	
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



	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','A',$term,$year,$form,"");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','A',$term,$year,$form," and classin='$stream'");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','A-',$term,$year,$form,"");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','A-',$term,$year,$form," and classin='$stream'");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','B+',$term,$year,$form,"");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','B+',$term,$year,$form," and classin='$stream'");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','B',$term,$year,$form,"");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','B',$term,$year,$form," and classin='$stream'");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','B-',$term,$year,$form,"");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','B-',$term,$year,$form," and classin='$stream'");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','C+',$term,$year,$form,"");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','C+',$term,$year,$form," and classin='$stream'");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','C',$term,$year,$form,"");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','C',$term,$year,$form," and classin='$stream'");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','C-',$term,$year,$form,"");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','C-',$term,$year,$form," and classin='$stream'");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','D+',$term,$year,$form,"");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','D+',$term,$year,$form," and classin='$stream'");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','D',$term,$year,$form,"");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','D',$term,$year,$form," and classin='$stream'");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','D-',$term,$year,$form,"");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','D-',$term,$year,$form," and classin='$stream'");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}
	
	if($stream=='Entire'){
		$kistally=$stally->getSubjectTally('kiswahiligrade','E',$term,$year,$form,"");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}else{
		$kistally=$stally->getSubjectTally('kiswahiligrade','E',$term,$year,$form," and classin='$stream'");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}
	
	
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','A',$term,$year,$form,"");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','A',$term,$year,$form," and classin='$stream'");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}
	
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','A-',$term,$year,$form,"");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','A-',$term,$year,$form," and classin='$stream'");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B+',$term,$year,$form,"");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B+',$term,$year,$form," and classin='$stream'");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B',$term,$year,$form,"");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B',$term,$year,$form," and classin='$stream'");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B-',$term,$year,$form,"");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','B-',$term,$year,$form," and classin='$stream'");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C+',$term,$year,$form,"");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C+',$term,$year,$form," and classin='$stream'");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C',$term,$year,$form,"");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C',$term,$year,$form," and classin='$stream'");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C-',$term,$year,$form,"");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','C-',$term,$year,$form," and classin='$stream'");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D+',$term,$year,$form,"");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D+',$term,$year,$form," and classin='$stream'");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D',$term,$year,$form,"");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D',$term,$year,$form," and classin='$stream'");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D-',$term,$year,$form,"");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','D-',$term,$year,$form," and classin='$stream'");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}
	if($stream=='Entire'){
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','E',$term,$year,$form,"");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}else{
		$mathtally=$stally->getSubjectTally('mathimaticsgrade','E',$term,$year,$form," and classin='$stream'");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}
	
	/*** GET BIOLOGY GRADES AND POINTS **/
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','A',$term,$year,$form,"");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','A',$term,$year,$form," and classin='$stream'");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','A-',$term,$year,$form,"");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','A-',$term,$year,$form," and classin='$stream'");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','B+',$term,$year,$form,"");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','B+',$term,$year,$form," and classin='$stream'");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','B',$term,$year,$form,"");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','B',$term,$year,$form," and classin='$stream'");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','B-',$term,$year,$form,"");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','B-',$term,$year,$form," and classin='$stream'");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','C+',$term,$year,$form,"");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','C+',$term,$year,$form," and classin='$stream'");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','C',$term,$year,$form,"");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','C',$term,$year,$form," and classin='$stream'");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','C-',$term,$year,$form,"");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','C-',$term,$year,$form," and classin='$stream'");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','D+',$term,$year,$form,"");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','D+',$term,$year,$form," and classin='$stream'");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','D',$term,$year,$form,"");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','D',$term,$year,$form," and classin='$stream'");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','D-',$term,$year,$form,"");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','D-',$term,$year,$form," and classin='$stream'");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}
	if($stream=='Entire'){
		$biotally=$stally->getSubjectTally('biologygrade','E',$term,$year,$form,"");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}else{
		$biotally=$stally->getSubjectTally('biologygrade','E',$term,$year,$form," and classin='$stream'");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}
	
	$biologyStudents=0;
	if($stream=='Entire'){
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and biology>0");
	}else{
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and biology>0");
	}
	while ($rowbiostud = mysql_fetch_array($getbiostudents)) {// get admno
	$biologyStudents=$rowbiostud['adms'];
	}
	
	/***************** GET CHEMISTRY GRADES *******************/
	
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','A',$term,$year,$form,"");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','A',$term,$year,$form," and classin='$stream'");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','A-',$term,$year,$form,"");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','A-',$term,$year,$form," and classin='$stream'");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','B+',$term,$year,$form,"");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','B+',$term,$year,$form," and classin='$stream'");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','B',$term,$year,$form,"");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','B',$term,$year,$form," and classin='$stream'");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','B-',$term,$year,$form,"");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','B-',$term,$year,$form," and classin='$stream'");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','C+',$term,$year,$form,"");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','C+',$term,$year,$form," and classin='$stream'");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','C',$term,$year,$form,"");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','C',$term,$year,$form," and classin='$stream'");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','C-',$term,$year,$form,"");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','C-',$term,$year,$form," and classin='$stream'");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','D+',$term,$year,$form,"");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','D+',$term,$year,$form," and classin='$stream'");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','D',$term,$year,$form,"");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','D',$term,$year,$form," and classin='$stream'");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','D-',$term,$year,$form,"");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','D-',$term,$year,$form," and classin='$stream'");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}
	if($stream=='Entire'){
		$chemtally=$stally->getSubjectTally('chemistrygrade','E',$term,$year,$form,"");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}else{
		$chemtally=$stally->getSubjectTally('chemistrygrade','E',$term,$year,$form," and classin='$stream'");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}
	
	
	$chemistryStudents=0;
	if($stream=='Entire'){
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and chemistry>0");
	}else{
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and chemistry>0");
	}
	while ($rowchemstud = mysql_fetch_array($getchemstudents)) {// get admno
	$chemistryStudents=$rowchemstud['adms'];
	}

	/************************ GET PHYSICS GRADES *************************************/
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','A',$term,$year,$form,"");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','A',$term,$year,$form," and classin='$stream'");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','A-',$term,$year,$form,"");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','A-',$term,$year,$form," and classin='$stream'");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','B+',$term,$year,$form,"");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','B+',$term,$year,$form," and classin='$stream'");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','B',$term,$year,$form,"");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','B',$term,$year,$form," and classin='$stream'");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','B-',$term,$year,$form,"");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','B-',$term,$year,$form," and classin='$stream'");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','C+',$term,$year,$form,"");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','C+',$term,$year,$form," and classin='$stream'");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','C',$term,$year,$form,"");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','C',$term,$year,$form," and classin='$stream'");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','C-',$term,$year,$form,"");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','C-',$term,$year,$form," and classin='$stream'");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','D+',$term,$year,$form,"");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','D+',$term,$year,$form," and classin='$stream'");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','D',$term,$year,$form,"");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','D',$term,$year,$form," and classin='$stream'");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','D-',$term,$year,$form,"");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','D-',$term,$year,$form," and classin='$stream'");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}
	if($stream=='Entire'){
		$phytally=$stally->getSubjectTally('physicsgrade','E',$term,$year,$form,"");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}else{
		$phytally=$stally->getSubjectTally('physicsgrade','E',$term,$year,$form," and classin='$stream'");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}
	
	$physicsStudents=0;
	if($stream=='Entire'){
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and physics>0");
	}else{
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and physics>0");
	}
	while ($rowphystud = mysql_fetch_array($getphystudents)) {// get admno
	$physicsStudents=$rowphystud['adms'];
	}
	
	/************************* GET HISTORY GRADES ***************************************/
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','A',$term,$year,$form,"");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}else{
		$histally=$stally->getSubjectTally('historygrade','A',$term,$year,$form," and classin='$stream'");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','A-',$term,$year,$form,"");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}else{
		$histally=$stally->getSubjectTally('historygrade','A-',$term,$year,$form," and classin='$stream'");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','B+',$term,$year,$form,"");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}else{
		$histally=$stally->getSubjectTally('historygrade','B+',$term,$year,$form," and classin='$stream'");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','B',$term,$year,$form,"");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}else{
		$histally=$stally->getSubjectTally('historygrade','B',$term,$year,$form," and classin='$stream'");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','B-',$term,$year,$form,"");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}else{
		$histally=$stally->getSubjectTally('historygrade','B-',$term,$year,$form," and classin='$stream'");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','C+',$term,$year,$form,"");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}else{
		$histally=$stally->getSubjectTally('historygrade','C+',$term,$year,$form," and classin='$stream'");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','C',$term,$year,$form,"");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}else{
		$histally=$stally->getSubjectTally('historygrade','C',$term,$year,$form," and classin='$stream'");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','C-',$term,$year,$form,"");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}else{
		$histally=$stally->getSubjectTally('historygrade','C-',$term,$year,$form," and classin='$stream'");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','D+',$term,$year,$form,"");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}else{
		$histally=$stally->getSubjectTally('historygrade','D+',$term,$year,$form," and classin='$stream'");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','D',$term,$year,$form,"");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}else{
		$histally=$stally->getSubjectTally('historygrade','D',$term,$year,$form," and classin='$stream'");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','D-',$term,$year,$form,"");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}else{
		$histally=$stally->getSubjectTally('historygrade','D-',$term,$year,$form," and classin='$stream'");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}
	if($stream=='Entire'){
		$histally=$stally->getSubjectTally('historygrade','E',$term,$year,$form,"");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}else{
		$histally=$stally->getSubjectTally('historygrade','E',$term,$year,$form," and classin='$stream'");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}
	
	
	$historyStudents=0;
	if($stream=='Entire'){
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and history>0");
	}else{
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and history>0");
	}
	while ($rowhisstud = mysql_fetch_array($gethisstudents)) {// get admno
	$historyStudents=$rowhisstud['adms'];
	}
	/*************************** GET GEOGRAPHY GRADES *****************************/
	
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','A',$term,$year,$form,"");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','A',$term,$year,$form," and classin='$stream'");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','A-',$term,$year,$form,"");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','A-',$term,$year,$form," and classin='$stream'");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','B+',$term,$year,$form,"");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','B+',$term,$year,$form," and classin='$stream'");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','B',$term,$year,$form,"");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','B',$term,$year,$form," and classin='$stream'");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','B-',$term,$year,$form,"");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','B-',$term,$year,$form," and classin='$stream'");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','C+',$term,$year,$form,"");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','C+',$term,$year,$form," and classin='$stream'");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','C',$term,$year,$form,"");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','C',$term,$year,$form," and classin='$stream'");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','C-',$term,$year,$form,"");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','C-',$term,$year,$form," and classin='$stream'");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','D+',$term,$year,$form,"");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','D+',$term,$year,$form," and classin='$stream'");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','D',$term,$year,$form,"");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','D',$term,$year,$form," and classin='$stream'");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','D-',$term,$year,$form,"");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','D-',$term,$year,$form," and classin='$stream'");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}
	if($stream=='Entire'){
		$geotally=$stally->getSubjectTally('geographygrade','E',$term,$year,$form,"");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}else{
		$geotally=$stally->getSubjectTally('geographygrade','E',$term,$year,$form," and classin='$stream'");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}
	
	$geographyStudents=0;
	if($stream=='Entire'){
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and geography>0");
	}else{
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and geography>0");
	}
	while ($rowgeostud = mysql_fetch_array($getgeostudents)) {// get admno
	$geographyStudents=$rowgeostud['adms'];
	}
	
	/************************* GET CRE GRADES  *****************************/
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','A',$term,$year,$form,"");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','A',$term,$year,$form," and classin='$stream'");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','A-',$term,$year,$form,"");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','A-',$term,$year,$form," and classin='$stream'");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','B+',$term,$year,$form,"");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','B+',$term,$year,$form," and classin='$stream'");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','B',$term,$year,$form,"");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','B',$term,$year,$form," and classin='$stream'");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','B-',$term,$year,$form,"");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','B-',$term,$year,$form," and classin='$stream'");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','C+',$term,$year,$form,"");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','C+',$term,$year,$form," and classin='$stream'");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','C',$term,$year,$form,"");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','C',$term,$year,$form," and classin='$stream'");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','C-',$term,$year,$form,"");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','C-',$term,$year,$form," and classin='$stream'");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','D+',$term,$year,$form,"");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','D+',$term,$year,$form," and classin='$stream'");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','D',$term,$year,$form,"");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','D',$term,$year,$form," and classin='$stream'");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','D-',$term,$year,$form,"");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','D-',$term,$year,$form," and classin='$stream'");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}
	if($stream=='Entire'){
		$cretally=$stally->getSubjectTally('cregrade','E',$term,$year,$form,"");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}else{
		$cretally=$stally->getSubjectTally('cregrade','E',$term,$year,$form," and classin='$stream'");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}
	
	$creStudents=0;
	if($stream=='Entire'){
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and cre>0");
	}else{
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and cre>0");
	}
	while ($rowcrestud = mysql_fetch_array($getcrestudents)) {// get admno
	$creStudents=$rowcrestud['adms'];
	}
	/*********************** GET AGRICULTURE GRADES *******************************/
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','A',$term,$year,$form,"");
		$agras=$agrtally['tally'];
		$agrA=$agras*12;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','A',$term,$year,$form," and classin='$stream'");
		$agras=$agrtally['tally'];
		$agrA=$agras*12;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','A-',$term,$year,$form,"");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','A-',$term,$year,$form," and classin='$stream'");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','B+',$term,$year,$form,"");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','B+',$term,$year,$form," and classin='$stream'");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','B',$term,$year,$form,"");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','B',$term,$year,$form," and classin='$stream'");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','B-',$term,$year,$form,"");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','B-',$term,$year,$form," and classin='$stream'");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','C+',$term,$year,$form,"");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','C+',$term,$year,$form," and classin='$stream'");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','C',$term,$year,$form,"");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','C',$term,$year,$form," and classin='$stream'");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','C-',$term,$year,$form,"");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','C-',$term,$year,$form," and classin='$stream'");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','D+',$term,$year,$form,"");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','D+',$term,$year,$form," and classin='$stream'");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','D',$term,$year,$form,"");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','D',$term,$year,$form," and classin='$stream'");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','D-',$term,$year,$form,"");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','D-',$term,$year,$form," and classin='$stream'");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}
	if($stream=='Entire'){
		$agrtally=$stally->getSubjectTally('agriculturegrade','E',$term,$year,$form,"");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}else{
		$agrtally=$stally->getSubjectTally('agriculturegrade','E',$term,$year,$form," and classin='$stream'");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}
	
	$agrStudents=0;
	if($stream=='Entire'){
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and agriculture>0");
	}else{
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and agriculture>0");
	}
	while ($rowagrstud = mysql_fetch_array($getagrstudents)) {// get admno
	$agrStudents=$rowagrstud['adms'];
	}
	
	/*********************** GET BUSINESS GRADES****************************/
	
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','A',$term,$year,$form,"");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','A',$term,$year,$form," and classin='$stream'");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','A-',$term,$year,$form,"");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','A-',$term,$year,$form," and classin='$stream'");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B+',$term,$year,$form,"");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B+',$term,$year,$form," and classin='$stream'");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B',$term,$year,$form,"");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B',$term,$year,$form," and classin='$stream'");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B-',$term,$year,$form,"");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','B-',$term,$year,$form," and classin='$stream'");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C+',$term,$year,$form,"");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C+',$term,$year,$form," and classin='$stream'");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C',$term,$year,$form,"");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C',$term,$year,$form," and classin='$stream'");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C-',$term,$year,$form,"");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','C-',$term,$year,$form," and classin='$stream'");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D+',$term,$year,$form,"");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D+',$term,$year,$form," and classin='$stream'");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D',$term,$year,$form,"");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D',$term,$year,$form," and classin='$stream'");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D-',$term,$year,$form,"");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','D-',$term,$year,$form," and classin='$stream'");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}
	if($stream=='Entire'){
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','E',$term,$year,$form,"");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}else{
		$bsttally=$stally->getSubjectTally('businesStudiesgrade','E',$term,$year,$form," and classin='$stream'");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}
	
	
	
	$bstStudents=0;
	if($stream=='Entire'){
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and businesStudies>0");
	}else{
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and businesStudies>0");
	}
	while ($rowbststud = mysql_fetch_array($getbststudents)) {// get admno
	$bstStudents=$rowbststud['adms'];
	}
	
	
	$frenchStudents=0;
	if($stream=='Entire'){
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and french > 0");
	}else{
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and french > 0");
	}
	while ($rowbststud = mysql_fetch_array($getfrenchStudents)) {// get admno
	$frenchStudents=$rowbststud['adms'];
	}
	
	
	$homeStudents=0;
	if($stream=='Entire'){
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and home>0");
	}else{
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and home>0");
	}
	while ($rowbststud = mysql_fetch_array($gethomeStudents)) {// get admno
	$homeStudents=$rowbststud['adms'];
	}
	
	
	$computerStudents=0;
	if($stream=='Entire'){
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and computer>0");
	}else{
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$stream' and computer>0");
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
	echo $agrA.",".$agrAm.",".$agrBP.",".$agrB.",".$agrBm.",".$agrCp.",".$agrC.",".$agrCm.",".$agrDp.",".$agrD.",".$agrDm.",".$agrE;
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
		
		    
		/***********************************************************************************/
?>
            <tr>
              <td colspan="31" align='center'><table width="400" border="1">
                  <tr>
                    <td class="dataListHeader" align="center" colspan="12"><font color="#FF00FF">Mean Grade Summary</font></td>
                  </tr>
                  <tr>
                    <td>A</td>
                    <td>A-</td>
                    <td>B+</td>
                    <td>B</td>
                    <td>B-</td>
                    <td>C+</td>
                    <td>C</td>
                    <td>C-</td>
                    <td>D+</td>
                    <td>D</td>
                    <td>D-</td>
                    <td>E</td>
                  </tr>
                  <tr>
                    <td><?php echo $as?></td>
                    <td><?php echo $am ?></td>
                    <td><?php echo $bp?></td>
                    <td><?php echo $bs?></td>
                    <td><?php echo $bm?></td>
                    <td><?php echo $cp?></td>
                    <td><?php echo $cs?></td>
                    <td><?php echo $cm?></td>
                    <td><?php echo $dp?></td>
                    <td><?php echo $ds?></td>
                    <td><?php echo $dm?></td>
                    <td><?php echo $es?></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td colspan=31 align=center>
          <form  method='get' name='pdiv'>
            <div id="div_print_analysis"> <?php echo "
     <table align=center width='80%' class='bordered_table'>
 		<tr>
		<td align=center colspan=31 class='dataListHeader' >
		<font color=#FF00FF>Subjects Mean Score Summary</font></td>
		</tr>
		
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
		   <td align=right colspan=2>$engmean</td>
		    <td align=right colspan=2>$kismean</td>
			<td align=right colspan=2>$mathmean</td>
			<td align=right colspan=2>$biomean</td>
			<td align=right colspan=2>$chemmean</td>
			<td align=right colspan=2>$phymean</td>
			<td align=right colspan=2>$hismean</td>
			<td align=right colspan=2>$geomean</td>
			<td align=right colspan=2>$cremean</td>
			<td align=right colspan=2>$agrmean</td>
			<td align=right colspan=2>$bstmean</td>
			
			<td align=right colspan=2>$frenchmean</td>
			<td align=right colspan=2>$homemean</td>
			<td align=right colspan=2>$computermean</td>
			</tr>
			<tr>
		   <td>GRADE</td>
		   <td align=right colspan=2>$efinalgrade</td>
		    <td align=right colspan=2>$kfinalgrade</td>
			<td align=right colspan=2>$mfinalgrade</td>
			<td align=right colspan=2>$bfinalgrade</td>
			<td align=right colspan=2>$chemfinalgrade</td>
			<td align=right colspan=2>$phyfinalgrade</td>
			<td align=right colspan=2>$hisfinalgrade</td>
			<td align=right colspan=2>$geofinalgrade</td>
			<td align=right colspan=2>$crefinalgrade</td>
			<td align=right colspan=2>$agrfinalgrade</td>
			<td align=right colspan=2>$bstfinalgrade</td>
			
			<td align=right colspan=2>$frenchfinalgrade</td>
			<td align=right colspan=2>$homefinalgrade</td>
			<td align=right colspan=2>$computerfinalgrade</td>
			</tr>
	</table>
  </td>
 </tr>
 
<tr>
   <td colspan=31 align=center>
     <table align=center width=400 border=1>
       <tr><td align=center><font color=#FF00FF>Class Mean Score</font></td></tr>
	   <tr><td align=center>No. of Students=$studentsare&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Points=$classtotalp</td></tr>
	  <tr><td align=center>Mean=$cms&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Grade=$finalgrade</td></tr>
	
	</table>
   </td>
 </tr>";
 ?> </div>
            <!-- end of analysis div-->
          </form>
          <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe></td>
      </tr>
      <tr>
        <td colspan="31" align="center">Positioning Have Been Done Using &nbsp;&nbsp;<font color="#FF0000"><u><?php echo $positionby?></u></font> </td>
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
