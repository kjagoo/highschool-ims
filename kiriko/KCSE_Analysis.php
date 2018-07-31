<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  

 include 'includes/functions.php';
$func = new Functions();
$activity = "KCSE ANALYSIS";
$func->addAuditTrail($activity,$username);


	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
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
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
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

</script>
<script type="text/javascript">


printDivCSS = new String ('<link rel="stylesheet" href="style.css" type="text/css" media="print" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}

	</script>
</head>
<body>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a  href="KCSE.php">Manage Index No</a></li>
    <li><a href="KCSE_Records.php">Record Entries</a></li>
    <li><a  href="KCSE_Manage.php">Manage Entries</a></li>
    <li><a class="active"  href="KCSE_Analysis.php">Generate Analysis</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="page_tabs_content">
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="marksform" method="post">
    <table class="borders" width="100%">
      <tr>
        <td class="alterCell" width="20%">Select Year:</td>
        <td class="alterCell3" ><select name="year" class="select" tabindex="1" required>
            <option value="" >-- Select Year -- </option>
            <?php
				include('includes/dbconnector.php');
		 			  	$query=("select distinct (year_finished) from studentdetails where year_finished>0");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['year_finished'].">".$row['year_finished']."</OPTION>"; }
						?>
          </select>
		  
		  <select name="stream" class="select" tabindex="2" required>
            <option value="" >-- Select Class -- </option>
			  <option value="Entire" >Entire Form</option>
            <?php
				include('includes/dbconnector.php');
		 			  	$query=("select distinct (class) from studentdetails where year_finished>0");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['class'].">".$row['class']."</OPTION>"; }
						?>
          </select>
		  
		  </td>
        <td colspan="2" ><input class="btn btn-primary" type="submit" value="Generate Analysis"/></td>
      </tr>
    </table>
  </form>
  <div class="spacer"></div>
  <?php  
	  if(isset($_POST['year']) ){
	  
	  include('includes/dbconnector.php');
	  
	  
	  $year=$_POST['year'];
	  $stream=$_POST['stream'];
	  $date=date("j, F, Y");
	  $moreq="";

	if($stream=="Entire"){
	 $moreq="";
	}else{
	$moreq= "and sd.class='$stream'";
	
	}
		
	
	
	
	function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}
	
	//$check="select * from kcsemarks where year_finished='$year'";
	$check="select km.*,ka.admno, sd.class from kcsemarks as km inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno where km.year_finished='$year' $moreq";
	$resultc = mysql_query($check);
	$rowscount=mysql_num_rows($resultc);
	 if($rowscount==1 ||$rowscount>1){
	?>
	
  <div class="clear"></div>
  <form method='post' name='form1'>
    <div id="div_print" style="width:100%">
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">KCSE ANALYSIS:-  Year <?php echo $year." Class ".$stream?>
            <div style="float:right; margin-right:5px;">
              <table width="250px">
                <tr>
                  <td><a href=javascript:printDiv('div_print') class="noline" title="Print Report"><i class="icon icon-green icon-print"></i>Print Analysis</a> </td>
				   <td><a href="pdf_kcse_analysis.php?year=<?php echo $year?>&stream=<?php echo $stream?>" title="Print PDF Report" class="noline"><i class="icon icon-green icon-print"></i>Export PDF</a> </td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
          <td><table class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
				 <th align="left">Admno</th>
                  <th align="left">Index</th>
                  <th align="center">Full Name</th>
				  <th align="center">STRM</th>
                  <th align="center">Eng</th>
                  <th align="center">Kisw</th>
                  <th align="center">Maths</th>
                  <th align="center">Bio</th>
                  <th align="center">Phy</th>
                  <th align="center">Chem</th>
                  <th align="center">His</th>
                  <th align="center">Geo</th>
                  <th align="center">Cre</th>
                  <th align="center">Agr</th>
                  <th align="center">B/st</th>
				  <th align="center">Fre</th>
				  <th align="center">Home/S</th>
				  <th align="center">Comp</th>
                  <th align="center">T.pt</th>
                  <th align="center">MSS</th>
                  <th align="center">Grd</th>
				   <th align="center">VAP</th>
                  <th align="center">pos</th>
                </tr>
              </thead>
              <tbody>
                <?php		
			$num=0;
			
	//$ads = "SELECT * FROM kcseanalysis where  year_finished='$year' order by index_numbers";//admno query
	$ads="select km.*,ka.admno,ka.index_numbers, sd.class from kcsemarks as km inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno and km.year_finished='$year' $moreq";
	$resultad = mysql_query($ads);
	while ($rowad = mysql_fetch_array($resultad)) {// get admno
	$num++;
	$admno=$rowad['admno'];
	$indexes=$rowad['index_numbers'];
	
	
	$eng=0;
	$kis=0;
	$eng2=0;
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
	$home=0;
	$comp=0;
	
	$totals=0;
	$cat1="select * from kcsemarks where year_finished='$year' and index_numbers='$indexes'";
	$result = mysql_query($cat1);
	while ($rowr = mysql_fetch_array($result)) {// get admno
	$eng=$rowr['english'];
	$kis=$rowr['kiswahili'];
	$math=$rowr['math'];
	$bio=$rowr['biology'];
	$chem=$rowr['chemistry'];
	$phy=$rowr['physics'];
	$his=$rowr['history'];
	$geo=$rowr['geography'];
	$cre=$rowr['cre'];
	$agr=$rowr['agriculture'];
	$bst=$rowr['bstudies'];
	$fre=$rowr['french'];
	$home=$rowr['home'];
	$comp=$rowr['computer'];
	
	}
	$engpoints=0;
	if ($eng=="A") {
	$engpoints=12;
	}else if ($eng=="A-") {
	$engpoints=11;
	}else if ($eng=="B+") {
	$engpoints=10;
	}else if ($eng=="B") {
	$engpoints=9;
	}else if ($eng=="B-") {
	$engpoints=8;
	}else if ($eng=="C+") {
	$engpoints=7;
	}else if ($eng=="C") {
	$engpoints=6;
	}else if ($eng=="C-") {
	$engpoints=5;
	}else if ($eng=="D+") {
	$engpoints=4;
	}else if ($eng=="D") {
	$engpoints=3;
	}else if ($eng=="D-") {
	$engpoints=2;
	}else if ($eng=="E") {
	$engpoints=1;
	}
	
	$kispoints=0;
	
	if ($kis=="A") {
	$kispoints=12;
	}else if ($kis=="A-") {
	$kispoints=11;
	}else if ($kis=="B+") {
	$kispoints=10;
	}else if ($kis=="B") {
	$kispoints=9;
	}else if ($kis=="B-") {
	$kispoints=8;
	}else if ($kis=="C+") {
	$kispoints=7;
	}else if ($kis=="C") {
	$kispoints=6;
	}else if ($kis=="C-") {
	$kispoints=5;
	}else if ($kis=="D+") {
	$kispoints=4;
	}else if ($kis=="D") {
	$kispoints=3;
	}else if ($kis=="D-") {
	$kispoints=2;
	}else if ($kis=="E") {
	$kispoints=1;
	}
	
	$mathpoints=0;
	if ($math=="A") {
	$mathpoints=12;
	}else if ($math=="A-") {
	$mathpoints=11;
	}else if ($math=="B+") {
	$mathpoints=10;
	}else if ($math=="B") {
	$mathpoints=9;
	}else if ($math=="B-") {
	$mathpoints=8;
	}else if ($math=="C+") {
	$mathpoints=7;
	}else if ($math=="C") {
	$mathpoints=6;
	}else if ($math=="C-") {
	$mathpoints=5;
	}else if ($math=="D+") {
	$mathpoints=4;
	}else if ($math=="D") {
	$mathpoints=3;
	}else if ($math=="D-") {
	$mathpoints=2;
	}else if ($math=="E") {
	$mathpoints=1;
	}
	
	$biopoints=0;
	if ($bio=="A") {
	$biopoints=12;
	}else if ($bio=="A-") {
	$biopoints=11;
	}else if ($bio=="B+") {
	$biopoints=10;
	}else if ($bio=="B") {
	$biopoints=9;
	}else if ($bio=="B-") {
	$biopoints=8;
	}else if ($bio=="C+") {
	$biopoints=7;
	}else if ($bio=="C") {
	$biopoints=6;
	}else if ($bio=="C-") {
	$biopoints=5;
	}else if ($bio=="D+") {
	$biopoints=4;
	}else if ($bio=="D") {
	$biopoints=3;
	}else if ($bio=="D-") {
	$biopoints=2;
	}else if ($bio=="E") {
	$biopoints=1;
	}
	
	$chempoints=0;
	if ($chem=="A") {
	$chempoints=12;
	}else if ($chem=="A-") {
	$chempoints=11;
	}else if ($chem=="B+") {
	$chempoints=10;
	}else if ($chem=="B") {
	$chempoints=9;
	}else if ($chem=="B-") {
	$chempoints=8;
	}else if ($chem=="C+") {
	$chempoints=7;
	}else if ($chem=="C") {
	$chempoints=6;
	}else if ($chem=="C-") {
	$chempoints=5;
	}else if ($chem=="D+") {
	$chempoints=4;
	}else if ($chem=="D") {
	$chempoints=3;
	}else if ($chem=="D-") {
	$chempoints=2;
	}else if ($chem=="E") {
	$chempoints=1;
	}
	
	$phypoints=0;
	if ($phy=="A") {
	$phypoints=12;
	}else if ($phy=="A-") {
	$phypoints=11;
	}else if ($phy=="B+") {
	$phypoints=10;
	}else if ($phy=="B") {
	$phypoints=9;
	}else if ($phy=="B-") {
	$phypoints=8;
	}else if ($phy=="C+") {
	$phypoints=7;
	}else if ($phy=="C") {
	$phypoints=6;
	}else if ($phy=="C-") {
	$phypoints=5;
	}else if ($phy=="D+") {
	$phypoints=4;
	}else if ($phy=="D") {
	$phypoints=3;
	}else if ($phy=="D-") {
	$phypoints=2;
	}else if ($phy=="E") {
	$phypoints=1;
	}
	
	$hispoints=0;
	if ($his=="A") {
	$hispoints=12;
	}else if ($his=="A-") {
	$hispoints=11;
	}else if ($his=="B+") {
	$hispoints=10;
	}else if ($his=="B") {
	$hispoints=9;
	}else if ($his=="B-") {
	$hispoints=8;
	}else if ($his=="C+") {
	$hispoints=7;
	}else if ($his=="C") {
	$hispoints=6;
	}else if ($his=="C-") {
	$hispoints=5;
	}else if ($his=="D+") {
	$hispoints=4;
	}else if ($his=="D") {
	$hispoints=3;
	}else if ($his=="D-") {
	$hispoints=2;
	}else if ($his=="E") {
	$hispoints=1;
	}
	
	$geopoints=0;
	if ($geo=="A") {
	$geopoints=12;
	}else if ($geo=="A-") {
	$geopoints=11;
	}else if ($geo=="B+") {
	$geopoints=10;
	}else if ($geo=="B") {
	$geopoints=9;
	}else if ($geo=="B-") {
	$geopoints=8;
	}else if ($geo=="C+") {
	$geopoints=7;
	}else if ($geo=="C") {
	$geopoints=6;
	}else if ($geo=="C-") {
	$geopoints=5;
	}else if ($geo=="D+") {
	$geopoints=4;
	}else if ($geo=="D") {
	$geopoints=3;
	}else if ($geo=="D-") {
	$geopoints=2;
	}else if ($geo=="E") {
	$geopoints=1;
	}
	
	
	$crepoints=0;
	if ($cre=="A") {
	$crepoints=12;
	}else if ($cre=="A-") {
	$crepoints=11;
	}else if ($cre=="B+") {
	$crepoints=10;
	}else if ($cre=="B") {
	$crepoints=9;
	}else if ($cre=="B-") {
	$crepoints=8;
	}else if ($cre=="C+") {
	$crepoints=7;
	}else if ($cre=="C") {
	$crepoints=6;
	}else if ($cre=="C-") {
	$crepoints=5;
	}else if ($cre=="D+") {
	$crepoints=4;
	}else if ($cre=="D") {
	$crepoints=3;
	}else if ($cre=="D-") {
	$crepoints=2;
	}else if ($cre=="E") {
	$crepoints=1;
	}
	
	
	$agrpoints=0;
	if ($agr=="A") {
	$agrpoints=12;
	}else if ($agr=="A-") {
	$agrpoints=11;
	}else if ($agr=="B+") {
	$agrpoints=10;
	}else if ($agr=="B") {
	$agrpoints=9;
	}else if ($agr=="B-") {
	$agrpoints=8;
	}else if ($agr=="C+") {
	$agrpoints=7;
	}else if ($agr=="C") {
	$agrpoints=6;
	}else if ($agr=="C-") {
	$agrpoints=5;
	}else if ($agr=="D+") {
	$agrpoints=4;
	}else if ($agr=="D") {
	$agrpoints=3;
	}else if ($agr=="D-") {
	$agrpoints=2;
	}else if ($agr=="E") {
	$agrpoints=1;
	}
	
	
	$bstpoints=0;
	if ($bst=="A") {
	$bstpoints=12;
	}else if ($bst=="A-") {
	$bstpoints=11;
	}else if ($bst=="B+") {
	$bstpoints=10;
	}else if ($bst=="B") {
	$bstpoints=9;
	}else if ($bst=="B-") {
	$bstpoints=8;
	}else if ($bst=="C+") {
	$bstpoints=7;
	}else if ($bst=="C") {
	$bstpoints=6;
	}else if ($bst=="C-") {
	$bstpoints=5;
	}else if ($bst=="D+") {
	$bstpoints=4;
	}else if ($bst=="D") {
	$bstpoints=3;
	}else if ($bst=="D-") {
	$bstpoints=2;
	}else if ($bst=="E") {
	$bstpoints=1;
	}
	
	$frepoints=0;
	if ($fre=="A") {
	$frepoints=12;
	}else if ($fre=="A-") {
	$frepoints=11;
	}else if ($fre=="B+") {
	$frepoints=10;
	}else if ($fre=="B") {
	$frepoints=9;
	}else if ($fre=="B-") {
	$frepoints=8;
	}else if ($fre=="C+") {
	$frepoints=7;
	}else if ($fre=="C") {
	$frepoints=6;
	}else if ($fre=="C-") {
	$frepoints=5;
	}else if ($fre=="D+") {
	$frepoints=4;
	}else if ($fre=="D") {
	$frepoints=3;
	}else if ($fre=="D-") {
	$frepoints=2;
	}else if ($fre=="E") {
	$frepoints=1;
	}
	
	$comppoints=0;
	if ($comp=="A") {
	$comppoints=12;
	}else if ($comp=="A-") {
	$comppoints=11;
	}else if ($comp=="B+") {
	$comppoints=10;
	}else if ($comp=="B") {
	$comppoints=9;
	}else if ($comp=="B-") {
	$comppoints=8;
	}else if ($comp=="C+") {
	$comppoints=7;
	}else if ($comp=="C") {
	$comppoints=6;
	}else if ($comp=="C-") {
	$comppoints=5;
	}else if ($comp=="D+") {
	$comppoints=4;
	}else if ($comp=="D") {
	$comppoints=3;
	}else if ($comp=="D-") {
	$comppoints=2;
	}else if ($comp=="E") {
	$comppoints=1;
	}
	
	$homepoints=0;
	if ($home=="A") {
	$homepoints=12;
	}else if ($home=="A-") {
	$homepoints=11;
	}else if ($home=="B+") {
	$homepoints=10;
	}else if ($home=="B") {
	$homepoints=9;
	}else if ($home=="B-") {
	$homepoints=8;
	}else if ($home=="C+") {
	$homepoints=7;
	}else if ($home=="C") {
	$homepoints=6;
	}else if ($home=="C-") {
	$homepoints=5;
	}else if ($home=="D+") {
	$homepoints=4;
	}else if ($home=="D") {
	$homepoints=3;
	}else if ($home=="D-") {
	$homepoints=2;
	}else if ($home=="E") {
	$homepoints=1;
	}
	
	
	$points1=array($biopoints,$chempoints,$phypoints);//get two sciences
		rsort($points1);
	
		$points2=array($hispoints,$geopoints,$crepoints);//get one humanity
		rsort($points2);
		
		$points3=array($agrpoints,$bstpoints,$frepoints,$comppoints,$homepoints,$points1[2],$points2[1],$points2[2]);
		rsort($points3);
		
	$totalpoints=$engpoints+$kispoints+$mathpoints+$points1[0]+$points1[1]+$points2[0]+$points3[0];
	$meangrade=round_up ( $totalpoints/7, 3 ); // float(499.945) 
	
	
	//$totalpoints=$engpoints+$kispoints+$mathpoints+$biopoints+$chempoints+$phypoints+$hispoints+$geopoints+$crepoints+$agrpoints+$bstpoints;
	//$meangrade=round(($totalpoints/7), 3 );
	
	
	if ($meangrade > 0.00 && $meangrade <= 1.499) {
			$tfgrade = "E";
			$htremarks="Work harder";
		} else if ($meangrade >= 1.50 && $meangrade <= 2.499) {
			$tfgrade = "D-";
			$htremarks="Improve";
		} else if ($meangrade >= 2.50 && $meangrade <= 3.499) {
			$tfgrade = "D";
			$htremarks="Improve";
		} else if ($meangrade >= 3.50 && $meangrade <= 4.499) {
			$tfgrade = "D+";
			$htremarks="Can do better";
		} else if ($meangrade >= 4.50 && $meangrade <= 5.499) {
			$tfgrade = "C-";
			$htremarks="Fair";
		} else if ($meangrade >= 5.50 && $meangrade <= 6.499) {
			$tfgrade = "C";
			$htremarks="Fair";
		} else if ($meangrade >= 6.50 && $meangrade <= 7.499) {
			$tfgrade = "C+";
			$htremarks="Fair";
		} else if ($meangrade >= 7.50 && $meangrade <= 8.499) {
			$tfgrade = "B-";
			$htremarks="Good";
		} else if ($meangrade >= 8.50 && $meangrade <= 9.499) {
			$tfgrade = "B";
			$htremarks="Good";
		} else if ($meangrade >= 9.50 && $meangrade <= 10.499) {
			$tfgrade = "B+";
			$htremarks="Good";
		} else if ($meangrade >= 10.50 && $meangrade <= 11.499) {
			$tfgrade = "A-";
			$htremarks="V. Good";
		} else if ($meangrade >= 11.50 && $meangrade <= 12.00) {
			$tfgrade = "A";
			$htremarks="Excellent";
		}else if ($meangrade == 0.00) {
			$tfgrade = "E";
			
		}
		
		if($eng=="X" || $kis=="X" || $math=="X" || $bio=="X" || $chem=="X"){
		$tfgrade = "X";
		$meangrade=0;
		}
		if($eng=="Y" || $kis=="Y" || $math=="Y" || $bio=="Y" || $chem=="Y"){
		$tfgrade = "Y";
		$meangrade=0;
		}
		if($eng=="P" || $kis=="P" || $math=="P" || $bio=="P" || $chem=="P"){
		$tfgrade = "P";
		$meangrade=0;
		}
	
	
	$grade="&nbsp;&nbsp;-";
	
	$totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst+$fre+$home+$comp;
	
	
	
	
	$getnames = "SELECT fname,sname,lname,marks from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	
	
	}
	
	
	$insert=" insert into kcse_final_analysis (adm, indexnumber,names,english,kiswahili,mathematics,biology,chemistry,physics,history,geography, cre,agriculture, businesStudies,french,home,computer, points, tgrade,averagepoints, year_finished) values('$admno','$indexes','$fname $mname $lasname','$eng','$kis','$math','$bio','$chem','$phy','$his','$geo','$cre','$agr','$bst','$fre','$home','$comp','$totalpoints','$tfgrade','$meangrade','$year') on duplicate key update english='$eng', kiswahili='$kis', mathematics='$math', biology='$bio', chemistry='$chem', physics='$phy', history='$his', geography='$geo', cre='$cre', agriculture='$agr',businesStudies='$bst',french='$fre',home='$home',computer='$comp', points='$totalpoints', tgrade='$tfgrade', averagepoints='$meangrade'";
	
	$queryinsert=mysql_query($insert);
	if(!$queryinsert){
	echo"failed". mysql_error();
	}
	
	
	}// end of geting admno
	
	$getfinalanalaysis ="SELECT kf.* from kcse_final_analysis as kf inner join studentdetails sd on kf.adm=sd.admno $moreq
 and kf.year_finished='$year' order by kf.averagepoints desc"; //"SELECT * from kcse_final_analysis where year_finished='$year' order by averagepoints desc";// get names
	$resultfinalanalysis = mysql_query($getfinalanalaysis);
	$num2=0;
	while ($rwf = mysql_fetch_array($resultfinalanalysis)) {// get names
	$num2++;
	$adm=$rwf['adm'];
	$resultSTRM = mysql_query("select class,marks from studentdetails where admno='$adm'");
	while ($rowrstrm = mysql_fetch_array($resultSTRM)) {
	$strm=$rowrstrm['class'];
	$kmarks=$rowrstrm['marks'];
	}
	
	$kcpepoints=$kmarks/5;
	if ($kcpepoints >= 0 && $kcpepoints <= 29) {
			$kcpepointsgrade = "E";
			$kcpept=1;
			
		} else if ($kcpepoints >= 30 && $kcpepoints <= 34 ){
			$kcpepointsgrade = "D-";
			$kcpept=2;
			
		} else if ($kcpepoints >= 35 && $kcpepoints <= 39) {
			$kcpepointsgrade = "D";
			$kcpept=3;
			
		} else if ($kcpepoints >= 40 && $kcpepoints <= 44) {
			$kcpepointsgrade = "D+";
			$kcpept=4;
			
		} else if ($kcpepoints >= 45 && $kcpepoints <= 49) {
			$kcpepointsgrade = "C-";
			$kcpept=5;
		
		} else if ($kcpepoints >= 50 && $kcpepoints <= 54) {
			$kcpepointsgrade = "C";
			$kcpept=6;
			
		} else if ($kcpepoints >= 55 && $kcpepoints <= 59) {
			$kcpepointsgrade = "C+";
			$kcpept=7;
			
		} else if ($kcpepoints >= 60 && $kcpepoints <= 64) {
			$kcpepointsgrade = "B-";
			$kcpept=8;
			
		} else if ($kcpepoints >= 65 && $kcpepoints <= 69) {
			$kcpepointsgrade = "B";
			$epoint=9;
			
		} else if ($kcpepoints >= 70 && $kcpepoints <= 74) {
			$kcpepointsgrade = "B+";
			$kcpept=10;
			
		} else if ($kcpepoints >= 75 && $kcpepoints <= 79) {
			$kcpepointsgrade = "A-";
			$kcpept=11;
			
		} else if ($kcpepoints >= 80 && $kcpepoints <= 100) {
			$kcpepointsgrade = "A";
			$kcpept=12;
			
		}
		
	$vap=	$rwf['averagepoints']-$kcpept;
	?>
	<tr>
	<td><?php echo $adm?></td> 
		<td><?php echo $rwf['indexnumber']?></td> 
		<td><?php echo str_replace("&","'",$rwf['names'])?></td>
		<td><?php echo $strm ?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['english']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['kiswahili']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['mathematics']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['biology']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['physics']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['chemistry']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['history']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['geography']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['cre']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['agriculture']?></td>
	  	<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['businesStudies']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['french']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['home']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['computer']?></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $rwf['points']?></td>
		<td align='right' bgcolor='#E1FFFF'><font color='#FF0000'></font><?php echo $rwf['averagepoints']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $rwf['tgrade']?></td>
		<td align='center' bgcolor='#E1FFFF'><?php echo $vap?></td>
		<td align='right' bgcolor='#E1FFFF'><font color='#FF00FF'><?php echo $num2?></font></td>
		</tr>
	<?php  
	}
	
	
	
$geta = mysql_query("select count(kf.tgrade) as a from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='A' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($geta)) {// get admno
	$as=$rowAS['a'];
	
	}
	$getam = mysql_query("select count(kf.tgrade) as am from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='A-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getam)) {// get admno
	$am=$rowAS['am'];

	}
	$getbp = mysql_query("select count(kf.tgrade) as bp from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='B+' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getbp)) {// get admno
	$bp=$rowAS['bp'];
	}
	
	$getbs = mysql_query("select count(kf.tgrade) as bs from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='B' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getbs)) {// get admno
	$bs=$rowAS['bs'];
	}
	
	$getbm = mysql_query("select count(kf.tgrade) as bm from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='B-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getbm)) {// get admno
	$bm=$rowAS['bm'];
	}
	
	$getcp = mysql_query("select count(kf.tgrade) as cp from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='C+' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getcp)) {// get admno
	$cp=$rowAS['cp'];
	}
	
	$getcs = mysql_query("select count(kf.tgrade) as cs from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='C' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getcs)) {// get admno
	$cs=$rowAS['cs'];
	}
	
	$getcm = mysql_query("select count(kf.tgrade) as cm from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='C-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getcm)) {// get admno
	$cm=$rowAS['cm'];
	}
	
	$getdp = mysql_query("select count(kf.tgrade) as dp from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='D+' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getdp)) {// get admno
	$dp=$rowAS['dp'];
	}
	
	$getds = mysql_query("select count(kf.tgrade) as ds from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='D' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getds)) {// get admno
	$ds=$rowAS['ds'];
	}
	
	$getdm = mysql_query("select count(kf.tgrade) as dm from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='D-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getdm)) {// get admno
	$dm=$rowAS['dm'];
	}
	
	$getes = mysql_query("select count(kf.tgrade) as esd from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='E' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getes)) {// get admno
	$es=$rowAS['esd'];
	
	}
	
	$studentsare=0;
	$getstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.english!='X' and km.english !='Y' and km.english!='P' 
and km.biology!='P' and km.biology!='Y' and km.biology!='X' $moreq");
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
	$finalgrade = "-";
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
		
	$getenglish = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='A' and km.year_finished='$year'  $moreq");
	while ($roweng = mysql_fetch_array($getenglish)) {// get admno
	$englishas=$roweng['engas'];
	$engpoA=$englishas*12;
	}
	$getenglishm = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='A-' and km.year_finished='$year'  $moreq ");
	while ($rowengm = mysql_fetch_array($getenglishm)) {// get admno
	$englisham=$rowengm['engas'];
	$engpoAm=$englisham*11;
	}
	$getenglishBP = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='B+' and km.year_finished='$year'  $moreq");
	while ($rowengbp = mysql_fetch_array($getenglishBP)) {// get admno
	$englishabp=$rowengbp['engas'];
	$engpoBP=$englishabp*10;
	}
	$getenglishB = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='B' and km.year_finished='$year'  $moreq");
	while ($rowengb = mysql_fetch_array($getenglishB)) {// get admno
	$englishab=$rowengb['engas'];
	$engpoB=$englishab*9;
	}
	$getenglishBM = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='B-' and km.year_finished='$year'  $moreq ");
	while ($rowengbm = mysql_fetch_array($getenglishBM)) {// get admno
	$englishabm=$rowengbm['engas'];
	$engpoBm=$englishabm*8;
	}
	$getenglishCP = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='C+' and km.year_finished='$year'  $moreq ");
	while ($rowengcp = mysql_fetch_array($getenglishCP)) {// get admno
	$englishacp=$rowengcp['engas'];
	$engpoCp=$englishacp*7;
	}
	$getenglishC = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='C' and km.year_finished='$year'  $moreq ");
	while ($rowengc = mysql_fetch_array($getenglishC)) {// get admno
	$englishac=$rowengc['engas'];
	$engpoC=$englishac*6;
	}
	$getenglishCM = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='C-' and km.year_finished='$year'  $moreq ");
	while ($rowengcm = mysql_fetch_array($getenglishCM)) {// get admno
	$englishacm=$rowengcm['engas'];
	$engpoCm=$englishacm*5;
	}
	$getenglishDP = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='D+' and km.year_finished='$year'  $moreq ");
	while ($rowengdp = mysql_fetch_array($getenglishDP)) {// get admno
	$englishadp=$rowengdp['engas'];
	$engpoDp=$englishadp*4;
	}
	$getenglishD = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='D' and km.year_finished='$year'  $moreq ");
	while ($rowengd = mysql_fetch_array($getenglishD)) {// get admno
	$englishad=$rowengd['engas'];
	$engpoD=$englishad*3;
	}
	$getenglishDM = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='D-' and km.year_finished='$year'  $moreq ");
	while ($rowengdm = mysql_fetch_array($getenglishDM)) {// get admno
	$englishadm=$rowengdm['engas'];
	$engpoDm=$englishadm*2;
	}
	$getenglishE = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='E' and km.year_finished='$year'  $moreq ");
	while ($rowengde = mysql_fetch_array($getenglishE)) {// get admno
	$englishade=$rowengde['engas'];
	$engpoE=$englishade*1;
	}
	
	$englishStudents=0;
	$getengstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.english!='X' and km.english !='Y' and km.english!='P'  $moreq");
	while ($rowenglishstud = mysql_fetch_array($getengstudents)) {// get admno
	$englishStudents=$rowenglishstud['adms'];
	}
	
	$getkiswahili = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='A' and km.year_finished='$year'  $moreq");
	while ($rowkis = mysql_fetch_array($getkiswahili)) {// get admno
	$kisas=$rowkis['engas'];
	$kisA=$kisas*12;
	}
	$getkiswahilim = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='A-' and km.year_finished='$year'  $moreq ");
	while ($rowkism = mysql_fetch_array($getkiswahilim)) {// get admno
	$kisam=$rowkism['engas'];
	$kisAm=$kisam*11;
	}
	$getkiswahiliBP = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='B+' and km.year_finished='$year'  $moreq");
	while ($rowkisbp = mysql_fetch_array($getkiswahiliBP)) {// get admno
	$kisbp=$rowkisbp['engas'];
	$kisBP=$kisbp*10;
	}
	$getkiswahiliB = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='B' and km.year_finished='$year'  $moreq");
	while ($rowkisb = mysql_fetch_array($getkiswahiliB)) {// get admno
	$kisb=$rowkisb['engas'];
	$kisB=$kisb*9;
	}
	$getkiswahiliBM = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='B-' and km.year_finished='$year'  $moreq ");
	while ($rowkisbm = mysql_fetch_array($getkiswahiliBM)) {// get admno
	$kisbm=$rowkisbm['engas'];
	$kisBm=$kisbm*8;
	}
	$getkiswahiliCP = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowkiscp = mysql_fetch_array($getkiswahiliCP)) {// get admno
	$kiscp=$rowkiscp['engas'];
	$kisCp=$kiscp*7;
	}
	$getkiswahiliC = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='C' and km.year_finished='$year'  $moreq ");
	while ($rowkisc = mysql_fetch_array($getkiswahiliC)) {// get admno
	$kisc=$rowkisc['engas'];
	$kisC=$kisc*6;
	}
	$getkiswahiliCM = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='C-' and km.year_finished='$year'  $moreq ");
	while ($rowkiscm = mysql_fetch_array($getkiswahiliCM)) {// get admno
	$kiscm=$rowkiscm['engas'];
	$kisCm=$kiscm*5;
	}
	$getkiswahiliDP = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='D+' and km.year_finished='$year'  $moreq  ");
	while ($rowkisdp = mysql_fetch_array($getkiswahiliDP)) {// get admno
	$kisdp=$rowkisdp['engas'];
	$kisDp=$kisdp*4;
	}
	$getkiswahiliD = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='D' and km.year_finished='$year'  $moreq  ");
	while ($rowkisd = mysql_fetch_array($getkiswahiliD)) {// get admno
	$kisd=$rowkisd['engas'];
	$kisD=$kisd*3;
	}
	$getkiswahiliDM = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowkisdm = mysql_fetch_array($getkiswahiliDM)) {// get admno
	$kisdm=$rowkisdm['engas'];
	$kisDm=$kisdm*2;
	}
	$getkiswahiliE = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='E' and km.year_finished='$year'  $moreq  ");
	while ($rowkisde = mysql_fetch_array($getkiswahiliE)) {// get admno
	$kisde=$rowkisde['engas'];
	$kisE=$kisde*1;
	}
	
	$kiswahiliStudents=0;
	$getkiswahilistudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.kiswahili!='X' and km.kiswahili !='Y' and km.kiswahili!='P'  $moreq");
	while ($rowkiswahilistud = mysql_fetch_array($getkiswahilistudents)) {// get admno
	$kiswahiliStudents=$rowkiswahilistud['adms'];
	}
	
	$getmath = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='A' and km.year_finished='$year'  $moreq ");
	while ($rowmath = mysql_fetch_array($getmath)) {// get admno
	$mathas=$rowmath['engas'];
	$mathA=$mathas*12;
	}
	$getmathm = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='A-' and km.year_finished='$year'  $moreq ");
	while ($rowmathm = mysql_fetch_array($getmathm)) {// get admno
	$matham=$rowmathm['engas'];
	$mathAm=$matham*11;
	}
	$getmathBP = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='B+' and km.year_finished='$year'  $moreq ");
	while ($rowmathbp = mysql_fetch_array($getmathBP)) {// get admno
	$mathbp=$rowmathbp['engas'];
	$mathBP=$mathbp*10;
	}
	$getmathB = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='B' and km.year_finished='$year'  $moreq ");
	while ($rowmathb = mysql_fetch_array($getmathB)) {// get admno
	$mathb=$rowmathb['engas'];
	$mathB=$mathb*9;
	}
	$getmathBM = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='B-' and km.year_finished='$year' $moreq ");
	while ($rowmathbm = mysql_fetch_array($getmathBM)) {// get admno
	$mathbm=$rowmathbm['engas'];
	$mathBm=$mathbm*8;
	}
	$getmathCP = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowmathcp = mysql_fetch_array($getmathCP)) {// get admno
	$mathcp=$rowmathcp['engas'];
	$mathCp=$mathcp*7;
	}
	$getmathC = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='C' and km.year_finished='$year'  $moreq  ");
	while ($rowmathc = mysql_fetch_array($getmathC)) {// get admno
	$mathc=$rowmathc['engas'];
	$mathC=$mathc*6;
	}
	$getmathCM = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='C-' and km.year_finished='$year'  $moreq   ");
	while ($rowmathcm = mysql_fetch_array($getmathCM)) {// get admno
	$mathcm=$rowmathcm['engas'];
	$mathCm=$mathcm*5;
	}
	$getmathDP = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowmathdp = mysql_fetch_array($getmathDP)) {// get admno
	$mathdp=$rowmathdp['engas'];
	$mathDp=$mathdp*4;
	}
	$getmathD = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='D' and km.year_finished='$year'  $moreq  ");
	while ($rowmathd = mysql_fetch_array($getmathD)) {// get admno
	$mathd=$rowmathd['engas'];
	$mathD=$mathd*3;
	}
	$getmathDM = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='D-' and km.year_finished='$year'  $moreq   ");
	while ($rowmathdm = mysql_fetch_array($getmathDM)) {// get admno
	$mathdm=$rowmathdm['engas'];
	$mathDm=$mathdm*2;
	}
	$getmathE = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='E' and km.year_finished='$year'  $moreq   ");
	while ($rowmathde = mysql_fetch_array($getmathE)) {// get admno
	$mathde=$rowmathde['engas'];
	$mathE=$mathde*1;
	}
	$mathStudents=0;
	$getmathstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.math!='X' and km.math !='Y' and km.math!='P'  $moreq");
	while ($rowmathstud = mysql_fetch_array($getmathstudents)) {// get admno
	$mathStudents=$rowmathstud['adms'];
	}
	/*****/
	
	$getbio = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='A' and km.year_finished='$year'  $moreq   ");
	while ($rowbio = mysql_fetch_array($getbio)) {// get admno
	$bioas=$rowbio['engas'];
	$bioA=$bioas*12;
	}
	$getbiom = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='A-' and km.year_finished='$year'  $moreq   ");
	while ($rowbiom = mysql_fetch_array($getbiom)) {// get admno
	$bioam=$rowbiom['engas'];
	$bioAm=$bioam*11;
	}
	$getbioBP = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='B+' and km.year_finished='$year'  $moreq  ");
	while ($rowbiobp = mysql_fetch_array($getbioBP)) {// get admno
	$biobp=$rowbiobp['engas'];
	$bioBP=$biobp*10;
	}
	$getbioB = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='B' and km.year_finished='$year'  $moreq  ");
	while ($rowbiob = mysql_fetch_array($getbioB)) {// get admno
	$biob=$rowbiob['engas'];
	$bioB=$biob*9;
	}
	$getbioBM = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='B-' and km.year_finished='$year'  $moreq   ");
	while ($rowbiobm = mysql_fetch_array($getbioBM)) {// get admno
	$biobm=$rowbiobm['engas'];
	$bioBm=$biobm*8;
	}
	$getbioCP = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowbiocp = mysql_fetch_array($getbioCP)) {// get admno
	$biocp=$rowbiocp['engas'];
	$bioCp=$biocp*7;
	}
	$getbioC = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='C' and km.year_finished='$year'  $moreq  ");
	while ($rowbioc = mysql_fetch_array($getbioC)) {// get admno
	$bioc=$rowbioc['engas'];
	$bioC=$bioc*6;
	}
	$getbioCM = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='C-' and km.year_finished='$year'  $moreq   ");
	while ($rowbiocm = mysql_fetch_array($getbioCM)) {// get admno
	$biocm=$rowbiocm['engas'];
	$bioCm=$biocm*5;
	}
	$getbioDP = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowbiodp = mysql_fetch_array($getbioDP)) {// get admno
	$biodp=$rowbiodp['engas'];
	$bioDp=$biodp*4;
	}
	$getbioD = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='D' and km.year_finished='$year'  $moreq   ");
	while ($rowbiod = mysql_fetch_array($getbioD)) {// get admno
	$biod=$rowbiod['engas'];
	$bioD=$biod*3;
	}
	$getbioDM = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowbiodm = mysql_fetch_array($getbioDM)) {// get admno
	$biodm=$rowbiodm['engas'];
	$bioDm=$biodm*2;
	}
	$getbioE = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='E' and km.year_finished='$year'  $moreq   ");
	while ($rowbiode = mysql_fetch_array($getbioE)) {// get admno
	$biode=$rowbiode['engas'];
	$bioE=$biode*1;
	}
	
	$biologyStudents=0;
	$getbiostudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.biology!='0' and km.biology!='X' and km.biology !='Y' and km.biology!='P'  $moreq");
	while ($rowbiostud = mysql_fetch_array($getbiostudents)) {// get admo
	$biologyStudents=$rowbiostud['adms'];
	}
	
	/***************** chemistry *******************/
	$getchem = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='A' and km.year_finished='$year'  $moreq   ");
	while ($rowchem = mysql_fetch_array($getchem)) {// get admno
	$chemas=$rowchem['engas'];
	$chemA=$chemas*12;
	}
	$getchemm = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='A-' and km.year_finished='$year'  $moreq    ");
	while ($rowchemm = mysql_fetch_array($getchemm)) {// get admno
	$chemam=$rowchemm['engas'];
	$chemAm=$chemam*11;
	}
	$getchemBP = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='B+' and km.year_finished='$year'  $moreq   ");
	while ($rowchembp = mysql_fetch_array($getchemBP)) {// get admno
	$chembp=$rowchembp['engas'];
	$chemBP=$chembp*10;
	}
	$getchemB = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='B' and km.year_finished='$year'  $moreq    ");
	while ($rowchemb = mysql_fetch_array($getchemB)) {// get admno
	$chemb=$rowchemb['engas'];
	$chemB=$chemb*9;
	}
	$getchemBM = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowchembm = mysql_fetch_array($getchemBM)) {// get admno
	$chembm=$rowchembm['engas'];
	$chemBm=$chembm*8;
	}
	$getchemCP = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowchemcp = mysql_fetch_array($getchemCP)) {// get admno
	$chemcp=$rowchemcp['engas'];
	$chemCp=$chemcp*7;
	}
	$getchemC = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='C' and km.year_finished='$year'  $moreq   ");
	while ($rowchemc = mysql_fetch_array($getchemC)) {// get admno
	$chemc=$rowchemc['engas'];
	$chemC=$chemc*6;
	}
	$getchemCM = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowchemcm = mysql_fetch_array($getchemCM)) {// get admno
	$chemcm=$rowchemcm['engas'];
	$chemCm=$chemcm*5;
	}
	$getchemDP = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowchemdp = mysql_fetch_array($getchemDP)) {// get admno
	$chemdp=$rowchemdp['engas'];
	$chemDp=$chemdp*4;
	}
	$getchemD = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='D' and km.year_finished='$year'  $moreq   ");
	while ($rowchemd = mysql_fetch_array($getchemD)) {// get admno
	$chemd=$rowchemd['engas'];
	$chemD=$chemd*3;
	}
	$getchemDM = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowchemdm = mysql_fetch_array($getchemDM)) {// get admno
	$chemdm=$rowchemdm['engas'];
	$chemDm=$chemdm*2;
	}
	$getchemE = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='E' and km.year_finished='$year'  $moreq    ");
	while ($rowchemde = mysql_fetch_array($getchemE)) {// get admno
	$chemde=$rowchemde['engas'];
	$chemE=$chemde*1;
	}
	
	$chemistryStudents=0;
	$getchemstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.chemistry!='0' and km.chemistry!='X' and km.chemistry !='Y' and km.chemistry!='P'  $moreq");
	while ($rowchemstud = mysql_fetch_array($getchemstudents)) {// get admno
	$chemistryStudents=$rowchemstud['adms'];
	}
	/************************ physics *************************************/
	$getphy = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='A' and km.year_finished='$year'  $moreq    ");
	while ($rowphy = mysql_fetch_array($getphy)) {// get admno
	$phyas=$rowphy['engas'];
	$phyA=$phyas*12;
	}
	$getphym = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='A-' and km.year_finished='$year'  $moreq     ");
	while ($rowphym = mysql_fetch_array($getphym)) {// get admno
	$phyam=$rowphym['engas'];
	$phyAm=$phyam*11;
	}
	$getphyBP = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='B+' and km.year_finished='$year'  $moreq     ");
	while ($rowphybp = mysql_fetch_array($getphyBP)) {// get admno
	$phybp=$rowphybp['engas'];
	$phyBP=$phybp*10;
	}
	$getphyB = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='B' and km.year_finished='$year'  $moreq     ");
	while ($rowphyb = mysql_fetch_array($getphyB)) {// get admno
	$phyb=$rowphyb['engas'];
	$phyB=$phyb*9;
	}
	$getphyBM = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='B-' and km.year_finished='$year'  $moreq     ");
	while ($rowphybm = mysql_fetch_array($getphyBM)) {// get admno
	$phybm=$rowphybm['engas'];
	$phyBm=$phybm*8;
	}
	$getphyCP = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='C+' and km.year_finished='$year'  $moreq    ");
	while ($rowphycp = mysql_fetch_array($getphyCP)) {// get admno
	$phycp=$rowphycp['engas'];
	$phyCp=$phycp*7;
	}
	$getphyC = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='C' and km.year_finished='$year'  $moreq    ");
	while ($rowphyc = mysql_fetch_array($getphyC)) {// get admno
	$phyc=$rowphyc['engas'];
	$phyC=$phyc*6;
	}
	$getphyCM = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='C-' and km.year_finished='$year'  $moreq     ");
	while ($rowphycm = mysql_fetch_array($getphyCM)) {// get admno
	$phycm=$rowphycm['engas'];
	$phyCm=$phycm*5;
	}
	$getphyDP = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowphydp = mysql_fetch_array($getphyDP)) {// get admno
	$phydp=$rowphydp['engas'];
	$phyDp=$phydp*4;
	}
	$getphyD = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='D' and km.year_finished='$year'  $moreq    ");
	while ($rowphyd = mysql_fetch_array($getphyD)) {// get admno
	$phyd=$rowphyd['engas'];
	$phyD=$phyd*3;
	}
	$getphyDM = mysql_query("select count(physics) as engas from kcsemarks where physics='D-' and year_finished='$year' ");
	while ($rowphydm = mysql_fetch_array($getphyDM)) {// get admno
	$phydm=$rowphydm['engas'];
	$phyDm=$phydm*2;
	}
	$getphyE = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='E' and km.year_finished='$year'  $moreq    ");
	while ($rowphyde = mysql_fetch_array($getphyE)) {// get admno
	$phyde=$rowphyde['engas'];
	$phyE=$phyde*1;
	}
	
	$physicsStudents=0;
	$getphystudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.physics!='0' and km.physics!='X' and km.physics !='Y' and km.physics!='P'  $moreq");
	while ($rowphystud = mysql_fetch_array($getphystudents)) {// get admno
	$physicsStudents=$rowphystud['adms'];
	}
	/*****************************************************************************************************/
	$gethis = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='A' and km.year_finished='$year'  $moreq    ");
	while ($rowhis = mysql_fetch_array($gethis)) {// get admno
	$hisas=$rowhis['engas'];
	$hisA=$hisas*12;
	}
	$gethism = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='A-' and km.year_finished='$year'  $moreq    ");
	while ($rowhism = mysql_fetch_array($gethism)) {// get admno
	$hisam=$rowhism['engas'];
	$hisAm=$hisam*11;
	}
	$gethisBP = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='B+' and km.year_finished='$year'  $moreq    ");
	while ($rowhisbp = mysql_fetch_array($gethisBP)) {// get admno
	$hisbp=$rowhisbp['engas'];
	$hisBP=$hisbp*10;
	}
	$gethisB = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='B' and km.year_finished='$year'  $moreq   ");
	while ($rowhisb = mysql_fetch_array($gethisB)) {// get admno
	$hisb=$rowhisb['engas'];
	$hisB=$hisb*9;
	}
	$gethisBM = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='B-' and km.year_finished='$year'  $moreq   ");
	while ($rowhisbm = mysql_fetch_array($gethisBM)) {// get admno
	$hisbm=$rowhisbm['engas'];
	$hisBm=$hisbm*8;
	}
	$gethisCP = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowhiscp = mysql_fetch_array($gethisCP)) {// get admno
	$hiscp=$rowhiscp['engas'];
	$hisCp=$hiscp*7;
	}
	$gethisC = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='C' and km.year_finished='$year'  $moreq   ");
	while ($rowhisc = mysql_fetch_array($gethisC)) {// get admno
	$hisc=$rowhisc['engas'];
	$hisC=$hisc*6;
	}
	$gethisCM = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowhiscm = mysql_fetch_array($gethisCM)) {// get admno
	$hiscm=$rowhiscm['engas'];
	$hisCm=$hiscm*5;
	}
	$gethisDP = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowhisdp = mysql_fetch_array($gethisDP)) {// get admno
	$hisdp=$rowhisdp['engas'];
	$hisDp=$hisdp*4;
	}
	$gethisD = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='D' and km.year_finished='$year'  $moreq   ");
	while ($rowhisd = mysql_fetch_array($gethisD)) {// get admno
	$hisd=$rowhisd['engas'];
	$hisD=$hisd*3;
	}
	$gethisDM = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowhisdm = mysql_fetch_array($gethisDM)) {// get admno
	$hisdm=$rowhisdm['engas'];
	$hisDm=$hisdm*2;
	}
	$gethisE = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='E' and km.year_finished='$year'  $moreq   ");
	while ($rowhisde = mysql_fetch_array($gethisE)) {// get admno
	$hisde=$rowhisde['engas'];
	$hisE=$hisde*1;
	}
	
	$historyStudents=0;
	$gethisstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.history!='0' and km.history!='X' and km.history !='Y' and km.history!='P'  $moreq");
	while ($rowhisstud = mysql_fetch_array($gethisstudents)) {// get admno
	$historyStudents=$rowhisstud['adms'];
	}
	/**************************************************************************************************/
	$getgeo = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='A' and km.year_finished='$year'  $moreq   ");
	while ($rowgeo = mysql_fetch_array($getgeo)) {// get admno
	$geoas=$rowgeo['engas'];
	$geoA=$geoas*12;
	}
	$getgeom = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='A-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeom = mysql_fetch_array($getgeom)) {// get admno
	$geoam=$rowgeom['engas'];
	$geoAm=$geoam*11;
	}
	$getgeoBP = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='B+' and km.year_finished='$year'  $moreq    ");
	while ($rowgeobp = mysql_fetch_array($getgeoBP)) {// get admno
	$geobp=$rowgeobp['engas'];
	$geoBP=$geobp*10;
	}
	$getgeoB = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='B' and km.year_finished='$year'  $moreq    ");
	while ($rowgeob = mysql_fetch_array($getgeoB)) {// get admno
	$geob=$rowgeob['engas'];
	$geoB=$geob*9;
	}
	$getgeoBM = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeobm = mysql_fetch_array($getgeoBM)) {// get admno
	$geobm=$rowgeobm['engas'];
	$geoBm=$geobm*8;
	}
	$getgeoCP = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowgeocp = mysql_fetch_array($getgeoCP)) {// get admno
	$geocp=$rowgeocp['engas'];
	$geoCp=$geocp*7;
	}
	$getgeoC = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='C' and km.year_finished='$year'  $moreq    ");
	while ($rowgeoc = mysql_fetch_array($getgeoC)) {// get admno
	$geoc=$rowgeoc['engas'];
	$geoC=$geoc*6;
	}
	$getgeoCM = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeocm = mysql_fetch_array($getgeoCM)) {// get admno
	$geocm=$rowgeocm['engas'];
	$geoCm=$geocm*5;
	}
	$getgeoDP = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowgeodp = mysql_fetch_array($getgeoDP)) {// get admno
	$geodp=$rowgeodp['engas'];
	$geoDp=$geodp*4;
	}
	$getgeoD = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='D' and km.year_finished='$year'  $moreq    ");
	while ($rowgeod = mysql_fetch_array($getgeoD)) {// get admno
	$geod=$rowgeod['engas'];
	$geoD=$geod*3;
	}
	$getgeoDM = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeodm = mysql_fetch_array($getgeoDM)) {// get admno
	$geodm=$rowgeodm['engas'];
	$geoDm=$geodm*2;
	}
	$getgeoE = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='E' and km.year_finished='$year'  $moreq    ");
	while ($rowgeode = mysql_fetch_array($getgeoE)) {// get admno
	$geode=$rowgeode['engas'];
	$geoE=$geode*1;
	}
	
	$geographyStudents=0;
	$getgeostudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.geography!='0' and km.geography!='X' and km.geography !='Y' and km.geography!='P'  $moreq");
	while ($rowgeostud = mysql_fetch_array($getgeostudents)) {// get admno
	$geographyStudents=$rowgeostud['adms'];
	}
	/*************************************************************************************************/
	$getcre = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='A' and km.year_finished='$year'  $moreq    ");
	while ($rowcre = mysql_fetch_array($getcre)) {// get admno
	$creas=$rowcre['engas'];
	$creA=$creas*12;
	}
	$getcrem = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='A-' and km.year_finished='$year'  $moreq     ");
	while ($rowcrem = mysql_fetch_array($getcrem)) {// get admno
	$cream=$rowcrem['engas'];
	$creAm=$cream*11;
	}
	$getcreBP = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='B+' and km.year_finished='$year'  $moreq     ");
	while ($rowcrebp = mysql_fetch_array($getcreBP)) {// get admno
	$crebp=$rowcrebp['engas'];
	$creBP=$crebp*10;
	}
	$getcreB = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='B' and km.year_finished='$year'  $moreq    ");
	while ($rowcreb = mysql_fetch_array($getcreB)) {// get admno
	$creb=$rowcreb['engas'];
	$creB=$creb*9;
	}
	$getcreBM = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowcrebm = mysql_fetch_array($getcreBM)) {// get admno
	$crebm=$rowcrebm['engas'];
	$creBm=$crebm*8;
	}
	$getcreCP = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='C+' and km.year_finished='$year'  $moreq     ");
	while ($rowcrecp = mysql_fetch_array($getcreCP)) {// get admno
	$crecp=$rowcrecp['engas'];
	$creCp=$crecp*7;
	}
	$getcreC = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='C' and km.year_finished='$year'  $moreq     ");
	while ($rowcrec = mysql_fetch_array($getcreC)) {// get admno
	$crec=$rowcrec['engas'];
	$creC=$crec*6;
	}
	$getcreCM = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowcrecm = mysql_fetch_array($getcreCM)) {// get admno
	$crecm=$rowcrecm['engas'];
	$creCm=$crecm*5;
	}
	$getcreDP = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='D+' and km.year_finished='$year'  $moreq     ");
	while ($rowcredp = mysql_fetch_array($getcreDP)) {// get admno
	$credp=$rowcredp['engas'];
	$creDp=$credp*4;
	}
	$getcreD = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='D' and km.year_finished='$year'  $moreq     ");
	while ($rowcred = mysql_fetch_array($getcreD)) {// get admno
	$cred=$rowcred['engas'];
	$creD=$cred*3;
	}
	$getcreDM = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='D-' and km.year_finished='$year'  $moreq     ");
	while ($rowcredm = mysql_fetch_array($getcreDM)) {// get admno
	$credm=$rowcredm['engas'];
	$creDm=$credm*2;
	}
	$getcreE = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='E' and km.year_finished='$year'  $moreq    ");
	while ($rowcrede = mysql_fetch_array($getcreE)) {// get admno
	$crede=$rowcrede['engas'];
	$creE=$crede*1;
	}
	
	$creStudents=0;
	$getcrestudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.cre!='0' and km.cre!='X' and km.cre !='Y' and km.cre!='P'  $moreq");
	while ($rowcrestud = mysql_fetch_array($getcrestudents)) {// get admno
	$creStudents=$rowcrestud['adms'];
	}
	/****************************************************************************************************/
	$getagr = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='A' and km.year_finished='$year'  $moreq    ");
	while ($rowagr = mysql_fetch_array($getagr)) {// get admno
	$agras=$rowagr['engas'];
	$agrA=$agras*12;
	}
	$getagrm = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='A-' and km.year_finished='$year'  $moreq     ");
	while ($rowagrm = mysql_fetch_array($getagrm)) {// get admno
	$agram=$rowagrm['engas'];
	$agrAm=$agram*11;
	}
	$getagrBP = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='B+' and km.year_finished='$year'  $moreq     ");
	while ($rowagrbp = mysql_fetch_array($getagrBP)) {// get admno
	$agrbp=$rowagrbp['engas'];
	$agrBP=$agrbp*10;
	}
	$getagrB = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='B' and km.year_finished='$year'  $moreq    ");
	while ($rowagrb = mysql_fetch_array($getagrB)) {// get admno
	$agrb=$rowagrb['engas'];
	$agrB=$agrb*9;
	}
	$getagrBM = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowagrbm = mysql_fetch_array($getagrBM)) {// get admno
	$agrbm=$rowagrbm['engas'];
	$agrBm=$agrbm*8;
	}
	$getagrCP = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='C+' and km.year_finished='$year'  $moreq     ");
	while ($rowagrcp = mysql_fetch_array($getagrCP)) {// get admno
	$agrcp=$rowagrcp['engas'];
	$agrCp=$agrcp*7;
	}
	$getagrC = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='C' and km.year_finished='$year'  $moreq    ");
	while ($rowagrc = mysql_fetch_array($getagrC)) {// get admno
	$agrc=$rowagrc['engas'];
	$agrC=$agrc*6;
	}
	$getagrCM = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='C-' and km.year_finished='$year'  $moreq     ");
	while ($rowagrcm = mysql_fetch_array($getagrCM)) {// get admno
	$agrcm=$rowagrcm['engas'];
	$agrCm=$agrcm*5;
	}
	$getagrDP = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowagrdp = mysql_fetch_array($getagrDP)) {// get admno
	$agrdp=$rowagrdp['engas'];
	$agrDp=$agrdp*4;
	}
	$getagrD = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='D' and km.year_finished='$year'  $moreq    ");
	while ($rowagrd = mysql_fetch_array($getagrD)) {// get admno
	$agrd=$rowagrd['engas'];
	$agrD=$agrd*3;
	}
	$getagrDM = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='D-' and km.year_finished='$year'  $moreq     ");
	while ($rowagrdm = mysql_fetch_array($getagrDM)) {// get admno
	$agrdm=$rowagrdm['engas'];
	$agrDm=$agrdm*2;
	}
	$getagrE = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='E' and km.year_finished='$year'  $moreq     ");
	while ($rowagrde = mysql_fetch_array($getagrE)) {// get admno
	$agrde=$rowagrde['engas'];
	$agrE=$agrde*1;
	}
	
	$agrStudents=0;
	$getagrstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.agriculture!='0' and km.agriculture!='X' and km.agriculture !='Y' and km.agriculture!='P'  $moreq");
	while ($rowagrstud = mysql_fetch_array($getagrstudents)) {// get admno
	$agrStudents=$rowagrstud['adms'];
	}
	/**************************************************************************************************/
	$getbst = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='A' and km.year_finished='$year'  $moreq    ");
	while ($rowbst = mysql_fetch_array($getbst)) {// get admno
	$bstas=$rowbst['engas'];
	$bstA=$bstas*12;
	}
	$getbstm = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='A-' and km.year_finished='$year'  $moreq   ");
	while ($rowbstm = mysql_fetch_array($getbstm)) {// get admno
	$bstam=$rowbstm['engas'];
	$bstAm=$bstam*11;
	}
	$getbstBP = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='B+' and km.year_finished='$year'  $moreq    ");
	while ($rowbstbp = mysql_fetch_array($getbstBP)) {// get admno
	$bstbp=$rowbstbp['engas'];
	$bstBP=$bstbp*10;
	}
	$getbstB = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='B' and km.year_finished='$year'  $moreq    ");
	while ($rowbstb = mysql_fetch_array($getbstB)) {// get admno
	$bstb=$rowbstb['engas'];
	$bstB=$bstb*9;
	}
	$getbstBM = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='B-' and km.year_finished='$year'  $moreq   ");
	while ($rowbstbm = mysql_fetch_array($getbstBM)) {// get admno
	$bstbm=$rowbstbm['engas'];
	$bstBm=$bstbm*8;
	}
	$getbstCP = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowbstcp = mysql_fetch_array($getbstCP)) {// get admno
	$bstcp=$rowbstcp['engas'];
	$bstCp=$bstcp*7;
	}
	$getbstC = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='C' and km.year_finished='$year'  $moreq   ");
	while ($rowbstc = mysql_fetch_array($getbstC)) {// get admno
	$bstc=$rowbstc['engas'];
	$bstC=$bstc*6;
	}
	$getbstCM = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowbstcm = mysql_fetch_array($getbstCM)) {// get admno
	$bstcm=$rowbstcm['engas'];
	$bstCm=$bstcm*5;
	}
	$getbstDP = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowbstdp = mysql_fetch_array($getbstDP)) {// get admno
	$bstdp=$rowbstdp['engas'];
	$bstDp=$bstdp*4;
	}
	$getbstD = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='D' and km.year_finished='$year'  $moreq    ");
	while ($rowbstd = mysql_fetch_array($getbstD)) {// get admno
	$bstd=$rowbstd['engas'];
	$bstD=$bstd*3;
	}
	$getbstDM = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowbstdm = mysql_fetch_array($getbstDM)) {// get admno
	$bstdm=$rowbstdm['engas'];
	$bstDm=$bstdm*2;
	}
	$getbstE = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='E' and km.year_finished='$year'  $moreq    ");
	while ($rowbstde = mysql_fetch_array($getbstE)) {// get admno
	$bstde=$rowbstde['engas'];
	$bstE=$bstde*1;
	}
	
	$bstStudents=0;
	$getbststudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.bstudies!='0' and km.bstudies!='X' and km.bstudies !='Y' and km.bstudies!='P'  and km.bstudies!=' '   $moreq");
	while ($rowbststud = mysql_fetch_array($getbststudents)) {// get admno
	$bstStudents=$rowbststud['adms'];
	}
	/*************************************************************************************************/
	$getfre = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='A' and km.year_finished='$year'  $moreq   ");
	while ($rowfre = mysql_fetch_array($getfre)) {// get admno
	$freas=$rowfre['engas'];
	$freA=$freas*12;
	}
	$getfrem = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='A-' and km.year_finished='$year'  $moreq  ");
	while ($rowfrem = mysql_fetch_array($getfrem)) {// get admno
	$fream=$rowfrem['engas'];
	$freAm=$fream*11;
	}
	$getfreBP = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='B+' and km.year_finished='$year'  $moreq  ");
	while ($rowfrebp = mysql_fetch_array($getfreBP)) {// get admno
	$frebp=$rowfrebp['engas'];
	$freBP=$frebp*10;
	}
	$getfreB = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='B' and km.year_finished='$year'  $moreq  ");
	while ($rowfreb = mysql_fetch_array($getfreB)) {// get admno
	$freb=$rowfreb['engas'];
	$freB=$freb*9;
	}
	$getfreBM = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='B-' and km.year_finished='$year'  $moreq  ");
	while ($rowfrebm = mysql_fetch_array($getfreBM)) {// get admno
	$frebm=$rowfrebm['engas'];
	$freBm=$frebm*8;
	}
	$getfreCP = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowfrecp = mysql_fetch_array($getfreCP)) {// get admno
	$frecp=$rowfrecp['engas'];
	$freCp=$frecp*7;
	}
	$getfreC = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='C' and km.year_finished='$year'  $moreq  ");
	while ($rowfrec = mysql_fetch_array($getfreC)) {// get admno
	$frec=$rowfrec['engas'];
	$freC=$frec*6;
	}
	$getfreCM = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='C-' and km.year_finished='$year'  $moreq  ");
	while ($rowfrecm = mysql_fetch_array($getfreCM)) {// get admno
	$frecm=$rowfrecm['engas'];
	$freCm=$frecm*5;
	}
	$getfreDP = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='D+' and km.year_finished='$year'  $moreq  ");
	while ($rowfredp = mysql_fetch_array($getfreDP)) {// get admno
	$fredp=$rowfredp['engas'];
	$freDp=$fredp*4;
	}
	$getfreD = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='D' and km.year_finished='$year'  $moreq  ");
	while ($rowfred = mysql_fetch_array($getfreD)) {// get admno
	$fred=$rowfred['engas'];
	$freD=$fred*3;
	}
	$getfreDM = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowfredm = mysql_fetch_array($getfreDM)) {// get admno
	$fredm=$rowfredm['engas'];
	$freDm=$fredm*2;
	}
	$getfreE = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='E' and km.year_finished='$year'  $moreq  ");
	while ($rowfrede = mysql_fetch_array($getfreE)) {// get admno
	$frede=$rowfrede['engas'];
	$freE=$frede*1;
	}
	
	$freStudents=0;
	$getfrestudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.french!='0' and km.french!='X' and km.french !='Y' and km.french!='P'  and km.french!=' '   $moreq");
	while ($rowfrestud = mysql_fetch_array($getfrestudents)) {// get admno
	$freStudents=$rowfrestud['adms'];
	}
	
	/*************************************************************************************************/
	$gethome = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='A' and km.year_finished='$year'  $moreq ");
	while ($rowhome = mysql_fetch_array($gethome)) {// get admno
	$homeas=$rowhome['engas'];
	$homeA=$homeas*12;
	}
	$gethomem = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='A-' and km.year_finished='$year'  $moreq  ");
	while ($rowhomem = mysql_fetch_array($gethomem)) {// get admno
	$homeam=$rowhomem['engas'];
	$homeAm=$homeam*11;
	}
	$gethomeBP = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='B+' and km.year_finished='$year'  $moreq  ");
	while ($rowhomebp = mysql_fetch_array($gethomeBP)) {// get admno
	$homebp=$rowhomebp['engas'];
	$homeBP=$homebp*10;
	}
	$gethomeB = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='B' and km.year_finished='$year'  $moreq  ");
	while ($rowhomeb = mysql_fetch_array($gethomeB)) {// get admno
	$homeb=$rowhomeb['engas'];
	$homeB=$homeb*9;
	}
	$gethomeBM = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='B-' and km.year_finished='$year'  $moreq ");
	while ($rowhomebm = mysql_fetch_array($gethomeBM)) {// get admno
	$homebm=$rowhomebm['engas'];
	$homeBm=$homebm*8;
	}
	$gethomeCP = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowhomecp = mysql_fetch_array($gethomeCP)) {// get admno
	$homecp=$rowhomecp['engas'];
	$homeCp=$homecp*7;
	}
	$gethomeC = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='C' and km.year_finished='$year'  $moreq  ");
	while ($rowhomec = mysql_fetch_array($gethomeC)) {// get admno
	$homec=$rowhomec['engas'];
	$homeC=$homec*6;
	}
	$gethomeCM = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='C-' and km.year_finished='$year'  $moreq  ");
	while ($rowhomecm = mysql_fetch_array($gethomeCM)) {// get admno
	$homecm=$rowhomecm['engas'];
	$homeCm=$homecm*5;
	}
	$gethomeDP = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='D+' and km.year_finished='$year'  $moreq  ");
	while ($rowhomedp = mysql_fetch_array($gethomeDP)) {// get admno
	$homedp=$rowhomedp['engas'];
	$homeDp=$homedp*4;
	}
	$gethomeD = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='D' and km.year_finished='$year'  $moreq  ");
	while ($rowhomed = mysql_fetch_array($gethomeD)) {// get admno
	$homed=$rowhomed['engas'];
	$homeD=$homed*3;
	}
	$gethomeDM = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowhomedm = mysql_fetch_array($gethomeDM)) {// get admno
	$homedm=$rowhomedm['engas'];
	$homeDm=$homedm*2;
	}
	$gethomeE = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='E' and km.year_finished='$year'  $moreq ");
	while ($rowhomede = mysql_fetch_array($gethomeE)) {// get admno
	$homede=$rowhomede['engas'];
	$homeE=$homede*1;
	}
	
	$homeStudents=0;
	$gethomestudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.home!='0' and km.home!='X' and km.home !='Y' and km.home!='P' and km.home!=' '  $moreq");
	while ($rowhomestud = mysql_fetch_array($gethomestudents)) {// get admno
	$homeStudents=$rowhomestud['adms'];
	}
	
	
	$getcomputer = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='A' and km.year_finished='$year'  $moreq ");
	while ($rowcomputer = mysql_fetch_array($getcomputer)) {// get admno
	$computeras=$rowcomputer['engas'];
	$computerA=$computeras*12;
	}
	$getcomputerm = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='A-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerm = mysql_fetch_array($getcomputerm)) {// get admno
	$computeram=$rowcomputerm['engas'];
	$computerAm=$computeram*11;
	}
	$getcomputerBP = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='B+' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerbp = mysql_fetch_array($getcomputerBP)) {// get admno
	$computerbp=$rowcomputerbp['engas'];
	$computerBP=$computerbp*10;
	}
	$getcomputerB = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='B' and km.year_finished='$year'  $moreq");
	while ($rowcomputerb = mysql_fetch_array($getcomputerB)) {// get admno
	$computerb=$rowcomputerb['engas'];
	$computerB=$computerb*9;
	}
	$getcomputerBM = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='B-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerbm = mysql_fetch_array($getcomputerBM)) {// get admno
	$computerbm=$rowcomputerbm['engas'];
	$computerBm=$computerbm*8;
	}
	$getcomputerCP = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='C+' and km.year_finished='$year'  $moreq ");
	while ($rowcomputercp = mysql_fetch_array($getcomputerCP)) {// get admno
	$computercp=$rowcomputercp['engas'];
	$computerCp=$computercp*7;
	}
	$getcomputerC = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='C' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerc = mysql_fetch_array($getcomputerC)) {// get admno
	$computerc=$rowcomputerc['engas'];
	$computerC=$computerc*6;
	}
	$getcomputerCM = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='C-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputercm = mysql_fetch_array($getcomputerCM)) {// get admno
	$computercm=$rowcomputercm['engas'];
	$computerCm=$computercm*5;
	}
	$getcomputerDP = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='D+' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerdp = mysql_fetch_array($getcomputerDP)) {// get admno
	$computerdp=$rowcomputerdp['engas'];
	$computerDp=$computerdp*4;
	}
	$getcomputerD = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='D' and km.year_finished='$year'  $moreq");
	while ($rowcomputerd = mysql_fetch_array($getcomputerD)) {// get admno
	$computerd=$rowcomputerd['engas'];
	$computerD=$computerd*3;
	}
	$getcomputerDM = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='D-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerdm = mysql_fetch_array($getcomputerDM)) {// get admno
	$computerdm=$rowcomputerdm['engas'];
	$computerDm=$computerdm*2;
	}
	$getcomputerE = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='E' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerde = mysql_fetch_array($getcomputerE)) {// get admno
	$computerde=$rowcomputerde['engas'];
	$computerE=$computerde*1;
	}
	
	$computerStudents=0;
	$getcomputerstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.computer!='0' and km.computer!='X' and km.computer !='Y' and km.computer!='P' and km.computer!=' '  $moreq");
	while ($rowcomputerstud = mysql_fetch_array($getcomputerstudents)) {// get admno
	$computerStudents=$rowcomputerstud['adms'];
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
	$totalFrePoints=$freA+$freAm+$freBP+$freB+$freBm+$freCp+$freC+$freCm+$freDp+$freD+$freDm+$freE;
	$totalHomePoints=$homeA+$homeAm+$homeBP+$homeB+$homeBm+$homeCp+$homeC+$homeCm+$homeDp+$homeD+$homeDm+$homeE;
	$totalCompPoints=$computerA+$computerAm+$computerBP+$computerB+$computerBm+$computerCp+$computerC+$computerCm+$computerDp+$computerD+$computerDm+$computerE;
	
	$engmean=round_up ( $totalEnglishPoints/$englishStudents, 3 );
	$kismean=round_up ( $totalKiswahiliPoints/$kiswahiliStudents, 3 );
	$mathmean=round_up ( $totalMathPoints/$mathStudents, 3 );
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
	if($freStudents==0){
	$fremean=0;
	}else{
	$fremean=round_up ( $totalFrePoints/$freStudents, 3 );
	}
	if($homeStudents==0){
	$homemean=0;
	}else{
	$homemean=round_up ( $totalHomePoints/$homeStudents, 3 );
	}
	if($computerStudents==0){
	$compmean=0;
	}else{
	$compmean=round_up ( $totalCompPoints/$computerStudents, 3 );
	}
	
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
		if ($fremean > 0 && $fremean <= 1.499) {
			$frefinalgrade = "E";
			// remarks="Work harder";
		} else if ($fremean >= 1.5 && $fremean <= 2.499) {
			$frefinalgrade = "D-";
			// remarks="Improve";
		} else if ($fremean >= 2.5 && $fremean <= 3.499) {
			$frefinalgrade = "D";
			// remarks="Improve";
		} else if ($fremean >= 3.5 && $fremean <= 4.499) {
			$frefinalgrade = "D+";
			// remarks="Can do better";
		} else if ($fremean >= 4.5 && $fremean <= 5.499) {
			$frefinalgrade = "C-";
			// remarks="Fair";
		} else if ($fremean >= 5.5 && $fremean <= 6.499) {
			$frefinalgrade = "C";
			// remarks="Fair";
		} else if ($fremean >= 6.5 && $fremean <= 7.499) {
			$frefinalgrade = "C+";
			// remarks="Fair";
		} else if ($fremean >= 7.5 && $fremean <= 8.499) {
			$frefinalgrade = "B-";
			// remarks="Good";
		} else if ($fremean >= 8.5 && $fremean <= 9.499) {
			$frefinalgrade = "B";
			// remarks="Good";
		} else if ($fremean >= 9.5 && $fremean <= 10.499) {
			$frefinalgrade = "B+";
			// remarks="Good";
		} else if ($fremean >= 10.5 && $fremean <= 11.499) {
			$frefinalgrade = "A-";
			// remarks="V. Good";
		} else if ($fremean >= 11.5 && $fremean <= 12.0) {
			$frefinalgrade = "A";
			// remarks="Excellent";
		}else if ($fremean == 0) {
			$frefinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($homemean > 0 && $homemean <= 1.499) {
			$homefinalgrade = "E";
			// remarks="Work harder";
		} else if ($homemean >= 1.5 && $homemean <= 2.499) {
			$homefinalgrade = "D-";
			// remarks="Improve";
		} else if ($homemean >= 2.5 && $homemean <= 3.499) {
			$homefinalgrade = "D";
			// remarks="Improve";
		} else if ($homemean >= 3.5 && $homemean <= 4.499) {
			$homefinalgrade = "D+";
			// remarks="Can do better";
		} else if ($homemean >= 4.5 && $homemean <= 5.499) {
			$homefinalgrade = "C-";
			// remarks="Fair";
		} else if ($homemean >= 5.5 && $homemean <= 6.499) {
			$homefinalgrade = "C";
			// remarks="Fair";
		} else if ($homemean >= 6.5 && $homemean <= 7.499) {
			$homefinalgrade = "C+";
			// remarks="Fair";
		} else if ($homemean >= 7.5 && $homemean <= 8.499) {
			$homefinalgrade = "B-";
			// remarks="Good";
		} else if ($homemean >= 8.5 && $homemean <= 9.499) {
			$homefinalgrade = "B";
			// remarks="Good";
		} else if ($homemean >= 9.5 && $homemean <= 10.499) {
			$homefinalgrade = "B+";
			// remarks="Good";
		} else if ($homemean >= 10.5 && $homemean <= 11.499) {
			$homefinalgrade = "A-";
			// remarks="V. Good";
		} else if ($homemean >= 11.5 && $homemean <= 12.0) {
			$homefinalgrade = "A";
			// remarks="Excellent";
		}else if ($homemean == 0) {
			$homefinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($compmean > 0 && $compmean <= 1.499) {
			$compfinalgrade = "E";
			// remarks="Work harder";
		} else if ($compmean >= 1.5 && $compmean <= 2.499) {
			$compfinalgrade = "D-";
			// remarks="Improve";
		} else if ($compmean >= 2.5 && $compmean <= 3.499) {
			$compfinalgrade = "D";
			// remarks="Improve";
		} else if ($compmean >= 3.5 && $compmean <= 4.499) {
			$compfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($compmean >= 4.5 && $compmean <= 5.499) {
			$compfinalgrade = "C-";
			// remarks="Fair";
		} else if ($compmean >= 5.5 && $compmean <= 6.499) {
			$compfinalgrade = "C";
			// remarks="Fair";
		} else if ($compmean >= 6.5 && $compmean <= 7.499) {
			$compfinalgrade = "C+";
			// remarks="Fair";
		} else if ($compmean >= 7.5 && $compmean <= 8.499) {
			$compfinalgrade = "B-";
			// remarks="Good";
		} else if ($compmean >= 8.5 && $compmean <= 9.499) {
			$compfinalgrade = "B";
			// remarks="Good";
		} else if ($compmean >= 9.5 && $compmean <= 10.499) {
			$compfinalgrade = "B+";
			// remarks="Good";
		} else if ($compmean >= 10.5 && $compmean <= 11.499) {
			$compfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($compmean >= 11.5 && $compmean <= 12.0) {
			$compfinalgrade = "A";
			// remarks="Excellent";
		}else if ($compmean == 0) {
			$compfinalgrade = "-";
			
		} 
		/***********************************************************************************/
		
	
	  
echo"
<tr>
<td colspan=28 align=center>
<table align=center width=400 border=1>
 <tr><td align=center colspan=12><span id=reportText><font color=#FF00FF>Mean Grade Summary</font></span></td></tr>
	<tr><td><span id=reportText>A</span></td><td><span id=reportText>A-</span></td>
		<td><span id=reportText>B+</span></td><td><span id=reportText>B</span></td><td><span id=reportText>B-</span></td>
		<td><span id=reportText>C+</span></td><td><span id=reportText>C</span></td><td><span id=reportText>C-</span></td>
		<td><span id=reportText>D+</span></td><td><span id=reportText>D</span></td><td><span id=reportText>D-</span></td>
		<td><span id=reportText>E</span></td>
	</tr>
	<tr><td><span id=reportText>$as</span></td><td><span id=reportText>$am</span></td>
		<td><span id=reportText>$bp</span></td><td><span id=reportText>$bs</span></td><td><span id=reportText>$bm</span></td>
		<td><span id=reportText>$cp</span></td><td><span id=reportText>$cs</span></td><td><span id=reportText>$cm</span></td>
		<td><span id=reportText>$dp</span></td><td><span id=reportText>$ds</span></td><td><span id=reportText>$dm</span></td>
		<td><span id=reportText>$es</span></td>
	</tr>
	</table>
 </td>
</tr>
<tr><td>&nbsp;&nbsp;&nbsp;</td></tr>
<tr>
	<td colspan='18' align=center>
	  <table class=borders align=center>
	  <thead>
 		<tr>
		<th align=center colspan=28><span id=reportText>
		<font color=#FF00FF>Subjects Mean Score Summary</font></span></th>
		</tr>
		
		<tr bgcolor=white>
		   <th>&nbsp;&nbsp;&nbsp;</th>
		   <th align=center colspan=2><span id=reportText>English</span></th>
		    <th align=center colspan=2><span id=reportText>Kiswahili</span></th>
			<th align=center colspan=2><span id=reportText>Maths</span></th>
			<th align=center colspan=2><span id=reportText>Biology</span></th>
			<th align=center colspan=2><span id=reportText>Chemistry</span></th>
			<th align=center colspan=2><span id=reportText>Physics</span></th>
			<th align=center colspan=2><span id=reportText>History</span></th>
			<th align=center colspan=2><span id=reportText>Geography</span></th>
			<th align=center colspan=2><span id=reportText>C.R.E</span></th>
			<th align=center colspan=2><span id=reportText>Agriculture</span></th>
			<th align=center colspan=2><span id=freetext>B/studies</span></th>
			<th align=center colspan=2><span id=freetext>French</span></th>
			<th align=center colspan=2><span id=freetext>H/Science</span></th>
			<th align=center colspan=2><span id=freetext>Computer</span></th>
			</tr>
		</thead>   
		   <tr bgcolor=#E8FFFF>
		   <td><span id=reportText>A</span></td>
		   <td align=center colspan=2><span id=reportText>$englishas</span></td>
		    <td align=center colspan=2><span id=reportText>$kisas</span></td>
			<td align=center colspan=2><span id=reportText>$mathas</span></td>
			<td align=center colspan=2><span id=reportText>$bioas</span></td>
			<td align=center colspan=2><span id=reportText>$chemas</span></td>
			<td align=center colspan=2><span id=reportText>$phyas</span></td>
			<td align=center colspan=2><span id=reportText>$hisas</span></td>
			<td align=center colspan=2><span id=reportText>$geoas</span></td>
			<td align=center colspan=2><span id=reportText>$creas</span></td>
			<td align=center colspan=2><span id=reportText>$agras</span></td>
			<td align=center colspan=2><span id=reportText>$bstas</span></td>
			<td align=center colspan=2>$freas</td>
			<td align=center colspan=2>$homeas</td>
			<td align=center colspan=2>$computeras</td>
			</tr>
			<tr bgcolor=white>
		   <td><span id=reportText>A-</span></td>
		   <td align=center colspan=2><span id=reportText>$englisham</span></td>
		    <td align=center colspan=2><span id=reportText>$kisam</span></td>
			<td align=center colspan=2><span id=reportText>$matham</span></td>
			<td align=center colspan=2><span id=reportText>$bioam</span></td>
			<td align=center colspan=2><span id=reportText>$chemam</span></td>
			<td align=center colspan=2><span id=reportText>$phyam</span></td>
			<td align=center colspan=2><span id=reportText>$hisam</span></td>
			<td align=center colspan=2><span id=reportText>$geoam</span></td>
			<td align=center colspan=2><span id=reportText>$cream</span></td>
			<td align=center colspan=2><span id=reportText>$agram</span></td>
			<td align=center colspan=2><span id=reportText>$bstam</span></td>
			<td align=center colspan=2>$fream</td>
			<td align=center colspan=2>$homeam</td>
			<td align=center colspan=2>$computeram</td>
			
			</tr>
			<tr bgcolor=#E8FFFF>
		   <td><span id=reportText>B+</span></td>
		   <td align=center colspan=2><span id=reportText>$englishabp</span></td>
		    <td align=center colspan=2><span id=reportText>$kisbp</span></td>
			<td align=center colspan=2><span id=reportText>$mathbp</span></td>
			<td align=center colspan=2><span id=reportText>$biobp</span></td>
			<td align=center colspan=2><span id=reportText>$chembp</span></td>
			<td align=center colspan=2><span id=reportText>$phybp</span></td>
			<td align=center colspan=2><span id=reportText>$hisbp</span></td>
			<td align=center colspan=2><span id=reportText>$geobp</span></td>
			<td align=center colspan=2><span id=reportText>$crebp</span></td>
			<td align=center colspan=2><span id=reportText>$agrbp</span></td>
			<td align=center colspan=2><span id=reportText>$bstbp</span></td>
			<td align=center colspan=2>$frebp</td>
			<td align=center colspan=2>$homebp</td>
			<td align=center colspan=2>$computerbp</td>
			</tr>
			<tr bgcolor=white>
		   <td><span id=reportText>B</span></td>
		   <td align=center colspan=2><span id=reportText>$englishab</span></td>
		    <td align=center colspan=2><span id=reportText>$kisb</span></td>
			<td align=center colspan=2><span id=reportText>$mathb</span></td>
			<td align=center colspan=2><span id=reportText>$biob</span></td>
			<td align=center colspan=2><span id=reportText>$chemb</span></td>
			<td align=center colspan=2><span id=reportText>$phyb</span></td>
			<td align=center colspan=2><span id=reportText>$hisb</span></td>
			<td align=center colspan=2><span id=reportText>$geob</span></td>
			<td align=center colspan=2><span id=reportText>$creb</span></td>
			<td align=center colspan=2><span id=reportText>$agrb</span></td>
			<td align=center colspan=2><span id=reportText>$bstb</span></td>
			<td align=center colspan=2>$freb</td>
			<td align=center colspan=2>$homeb</td>
			<td align=center colspan=2>$computerb</td>
			
			</tr>
			<tr bgcolor=#E8FFFF>
		   <td><span id=reportText>B-</span></td>
		   <td align=center colspan=2><span id=reportText>$englishabm</span></td>
		    <td align=center colspan=2><span id=reportText>$kisbm</span></td>
			<td align=center colspan=2><span id=reportText>$mathbm</span></td>
			<td align=center colspan=2><span id=reportText>$biobm</span></td>
			<td align=center colspan=2><span id=reportText>$chembm</span></td>
			<td align=center colspan=2><span id=reportText>$phybm</span></td>
			<td align=center colspan=2><span id=reportText>$hisbm</span></td>
			<td align=center colspan=2><span id=reportText>$geobm</span></td>
			<td align=center colspan=2><span id=reportText>$crebm</span></td>
			<td align=center colspan=2><span id=reportText>$agrbm</span></td>
			<td align=center colspan=2><span id=reportText>$bstbm</span></td>
			<td align=center colspan=2>$frebm</td>
			<td align=center colspan=2>$homebm</td>
			<td align=center colspan=2>$computerbm</td>
			
			</tr>
			<tr bgcolor=white>
		   <td><span id=reportText>C+</span></td>
		   <td align=center colspan=2><span id=reportText>$englishacp</span></td>
		    <td align=center colspan=2><span id=reportText>$kiscp</span></td>
			<td align=center colspan=2><span id=reportText>$mathcp</span></td>
			<td align=center colspan=2><span id=reportText>$biocp</span></td>
			<td align=center colspan=2><span id=reportText>$chemcp</span></td>
			<td align=center colspan=2><span id=reportText>$phycp</span></td>
			<td align=center colspan=2><span id=reportText>$hiscp</span></td>
			<td align=center colspan=2><span id=reportText>$geocp</span></td>
			<td align=center colspan=2><span id=reportText>$crecp</span></td>
			<td align=center colspan=2><span id=reportText>$agrcp</span></td>
			<td align=center colspan=2><span id=reportText>$bstcp</span></td>
			<td align=center colspan=2>$frecp</td>
			<td align=center colspan=2>$homecp</td>
			<td align=center colspan=2>$computercp</td>
			
			</tr>
			<tr bgcolor=#E8FFFF>
		   <td><span id=reportText>C</span></td>
		   <td align=center colspan=2><span id=reportText>$englishac</span></td>
		    <td align=center colspan=2><span id=reportText>$kisc</span></td>
			<td align=center colspan=2><span id=reportText>$mathc</span></td>
			<td align=center colspan=2><span id=reportText>$bioc</span></td>
			<td align=center colspan=2><span id=reportText>$chemc</span></td>
			<td align=center colspan=2><span id=reportText>$phyc</span></td>
			<td align=center colspan=2><span id=reportText>$hisc</span></td>
			<td align=center colspan=2><span id=reportText>$geoc</span></td>
			<td align=center colspan=2><span id=reportText>$crec</span></td>
			<td align=center colspan=2><span id=reportText>$agrc</span></td>
			<td align=center colspan=2><span id=reportText>$bstc</span></td>
			<td align=center colspan=2>$frec</td>
			<td align=center colspan=2>$homec</td>
			<td align=center colspan=2>$computerc</td>
			
			</tr>
			<tr bgcolor=white>
		   <td><span id=reportText>C-</span></td>
		   <td align=center colspan=2><span id=reportText>$englishacm</span></td>
		    <td align=center colspan=2><span id=reportText>$kiscm</span></td>
			<td align=center colspan=2><span id=reportText>$mathcm</span></td>
			<td align=center colspan=2><span id=reportText>$biocm</span></td>
			<td align=center colspan=2><span id=reportText>$chemcm</span></td>
			<td align=center colspan=2><span id=reportText>$phycm</span></td>
			<td align=center colspan=2><span id=reportText>$hiscm</span></td>
			<td align=center colspan=2><span id=reportText>$geocm</span></td>
			<td align=center colspan=2><span id=reportText>$crecm</span></td>
			<td align=center colspan=2><span id=reportText>$agrcm</span></td>
			<td align=center colspan=2><span id=reportText>$bstcm</span></td>
			<td align=center colspan=2>$frecm</td>
			<td align=center colspan=2>$homecm</td>
			<td align=center colspan=2>$computercm</td>
			</tr>
			<tr bgcolor=#E8FFFF>
		   <td><span id=reportText>D+</span></td>
		   <td align=center colspan=2><span id=reportText>$englishadp</span></td>
		    <td align=center colspan=2><span id=reportText>$kisdp</span></td>
			<td align=center colspan=2><span id=reportText>$mathdp</span></td>
			<td align=center colspan=2><span id=reportText>$biodp</span></td>
			<td align=center colspan=2><span id=reportText>$chemdp</span></td>
			<td align=center colspan=2><span id=reportText>$phydp</span></td>
			<td align=center colspan=2><span id=reportText>$hisdp</span></td>
			<td align=center colspan=2><span id=reportText>$geodp</span></td>
			<td align=center colspan=2><span id=reportText>$credp</span></td>
			<td align=center colspan=2><span id=reportText>$agrdp</span></td>
			<td align=center colspan=2><span id=reportText>$bstdp</span></td>
			<td align=center colspan=2>$fredp</td>
			<td align=center colspan=2>$homedp</td>
			<td align=center colspan=2>$computerdp</td>
			</tr>
			<tr bgcolor=WHITE>
		   <td><span id=reportText>D</span></td>
		   <td align=center colspan=2><span id=reportText>$englishad</span></td>
		    <td align=center colspan=2><span id=reportText>$kisd</span></td>
			<td align=center colspan=2><span id=reportText>$mathd</span></td>
			<td align=center colspan=2><span id=reportText>$biod</span></td>
			<td align=center colspan=2><span id=reportText>$chemd</span></td>
			<td align=center colspan=2><span id=reportText>$phyd</span></td>
			<td align=center colspan=2><span id=reportText>$hisd</span></td>
			<td align=center colspan=2><span id=reportText>$geod</span></td>
			<td align=center colspan=2><span id=reportText>$cred</span></td>
			<td align=center colspan=2><span id=reportText>$agrd</span></td>
			<td align=center colspan=2><span id=reportText>$bstd</span></td>
			<td align=center colspan=2>$fred</td>
			<td align=center colspan=2>$homed</td>
			<td align=center colspan=2>$computerd</td>
			</tr>
			<tr bgcolor=#E8FFFF>
		   <td><span id=reportText>D-</span></td>
		   <td align=center colspan=2><span id=reportText>$englishadm</span></td>
		    <td align=center colspan=2><span id=reportText>$kisdm</span></td>
			<td align=center colspan=2><span id=reportText>$mathdm</span></td>
			<td align=center colspan=2><span id=reportText>$biodm</span></td>
			<td align=center colspan=2><span id=reportText>$chemdm</span></td>
			<td align=center colspan=2><span id=reportText>$phydm</span></td>
			<td align=center colspan=2><span id=reportText>$hisdm</span></td>
			<td align=center colspan=2><span id=reportText>$geodm</span></td>
			<td align=center colspan=2><span id=reportText>$credm</span></td>
			<td align=center colspan=2><span id=reportText>$agrdm</span></td>
			<td align=center colspan=2><span id=reportText>$bstdm</span></td>
			<td align=center colspan=2>$fredm</td>
			<td align=center colspan=2>$homedm</td>
			<td align=center colspan=2>$computerdm</td>
			
			</tr>
			<tr bgcolor=WHITE>
		   <td><span id=reportText>E</span></td>
		   <td align=center colspan=2><span id=reportText>$englishade</span></td>
		    <td align=center colspan=2><span id=reportText>$kisde</span></td>
			<td align=center colspan=2><span id=reportText>$mathde</span></td>
			<td align=center colspan=2><span id=reportText>$biode</span></td>
			<td align=center colspan=2><span id=reportText>$chemde</span></td>
			<td align=center colspan=2><span id=reportText>$phyde</span></td>
			<td align=center colspan=2><span id=reportText>$hisde</span></td>
			<td align=center colspan=2><span id=reportText>$geode</span></td>
			<td align=center colspan=2><span id=reportText>$crede</span></td>
			<td align=center colspan=2><span id=reportText>$agrde</span></td>
			<td align=center colspan=2><span id=reportText>$bstde</span></td>
			<td align=center colspan=2>$frede</td>
			<td align=center colspan=2>$homede</td>
			<td align=center colspan=2>$computerde</td>
			</tr>
			
			<tr bgcolor=#E8FFFF>
		   <td><span id=reportText>T.Pts</span></td>
		   <td align=center colspan=2><span id=reportText>$totalEnglishPoints</span></td>
		    <td align=center colspan=2><span id=reportText>$totalKiswahiliPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalMathPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalBioPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalChemPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalPhysPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalHisPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalGeoPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalCrePoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalAgrPoints</span></td>
			<td align=center colspan=2><span id=reportText>$totalBstPoints</span></td>
			<td align=center colspan=2>$totalFrePoints</td>
			<td align=center colspan=2>$totalHomePoints</td>
			<td align=center colspan=2>$totalCompPoints</td>
			</tr>
			<tr bgcolor=white>
		   <td><span id=reportText>Students</span></td>
		   <td align=center colspan=2><span id=reportText>$englishStudents</span></td>
		    <td align=center colspan=2><span id=reportText>$kiswahiliStudents</span></td>
			<td align=center colspan=2><span id=reportText>$mathStudents</span></td>
			<td align=center colspan=2><span id=reportText>$biologyStudents</span></td>
			<td align=center colspan=2><span id=reportText>$chemistryStudents</span></td>
			<td align=center colspan=2><span id=reportText>$physicsStudents</span></td>
			<td align=center colspan=2><span id=reportText>$historyStudents</span></td>
			<td align=center colspan=2><span id=reportText>$geographyStudents</span></td>
			<td align=center colspan=2><span id=reportText>$creStudents</span></td>
			<td align=center colspan=2><span id=reportText>$agrStudents</span></td>
			<td align=center colspan=2><span id=reportText>$bstStudents</span></td>
			<td align=center colspan=2>$freStudents</td>
			<td align=center colspan=2>$homeStudents</td>
			<td align=center colspan=2>$computerStudents</td>
			</tr>
			<tr bgcolor=#E8FFFF>
		   <td><span id=reportText>MEAN</span></td>
		   <td align=center colspan=2><span id=reportText>$engmean</span></td>
		    <td align=center colspan=2><span id=reportText>$kismean</span></td>
			<td align=center colspan=2><span id=reportText>$mathmean</span></td>
			<td align=center colspan=2><span id=reportText>$biomean</span></td>
			<td align=center colspan=2><span id=reportText>$chemmean</span></td>
			<td align=center colspan=2><span id=reportText>$phymean</span></td>
			<td align=center colspan=2><span id=reportText>$hismean</span></td>
			<td align=center colspan=2><span id=reportText>$geomean</span></td>
			<td align=center colspan=2><span id=reportText>$cremean</span></td>
			<td align=center colspan=2><span id=reportText>$agrmean</span></td>
			<td align=center colspan=2><span id=reportText>$bstmean</span></td>
			<td align=center colspan=2>$fremean</td>
			<td align=center colspan=2>$homemean</td>
			<td align=center colspan=2>$compmean</td>
			</tr>
			<tr bgcolor=white>
		   <td><span id=reportText>GRADE</span></td>
		   <td align=center colspan=2><span id=reportText>$efinalgrade</span></td>
		    <td align=center colspan=2><span id=reportText>$kfinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$mfinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$bfinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$chemfinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$phyfinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$hisfinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$geofinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$crefinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$agrfinalgrade</span></td>
			<td align=center colspan=2><span id=reportText>$bstfinalgrade</span></td>
			<td align=center colspan=2>$frefinalgrade</td>
			<td align=center colspan=2>$homefinalgrade</td>
			<td align=center colspan=2>$compfinalgrade</td>
			</tr>
			
	</table>
  </td>
 </tr>
 

<tr>
   <td colspan=28 align=center>
     <table align=center width=400 border=1>
       <tr><td align=center><span id=reportText><font color=#FF00FF>Class Mean Score</font></span></td></tr>
	   <tr><td align=center>No. of Students=$studentsare&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Points=$classtotalp</td></tr>
	  <tr><td align=center>Mean=$cms&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Grade=$finalgrade</td></tr>
	
	</table>
   </td>
 </tr>";
	?>
              </tbody>
            </table></td>
        </tr>
      </table>
    </div>
  </form>
  <iframe name=print_frame width=0 height=0 frameborder=0 src=about:blank></iframe>
  <?php 
  }else{?>
  
  <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">KCSE ENTRIES</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
			 	<th>Admnission No</th>
				<th>Index No</th>
                <th>Student Name</th>
                <th align='center'>KCSE Entry</th>
				 <th align='center'>Action</th>
              </tr>
            </thead>
            <tbody>
			
            </tbody>
          </table></td>
      </tr>
    </table>
	<?php
  }
  }
  ?>
</div>
</body>
</html>
