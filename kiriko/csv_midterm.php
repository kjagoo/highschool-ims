<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=midterm-export.xls");

	$form=$_GET['form'];
	$strm=$_GET['class'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	$wat=$_GET['wat'];
	$positionby=$_GET['by'];
	$mode=$_GET['mode'];
	
	if($wat=='12'){
	$mywat='1 & 2';
	}else{
	$mywat=$wat;
	}
	
	function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}

?>

<table border="1">
  <thead>
  <th colspan="35">Cat <?php echo $mywat ?> Analysis: Form <?php echo $form." ".$strm." Term: ".$term." Positioned By: ".$positionby?></th>
    </thead>
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
  <?php
	//connection to mysql
	  include('includes/dbconnector.php');
	
	
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
	 $numb=0;
	if($strm=="Entire"){
$myquerydis="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc";


//$myquerydis="select * from totalygradedmidterm where form='$form' and term='$term' and year='$year' order by $positionby desc,$alternatepositionby desc";
}else{
$myquerydis="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' and t1.stream='$strm' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
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
	$resultf = mysql_query("select * from totalperformanceindex where adm='$admno' and  year='$year' and form='$form' and term='$term' and exam='$wat'");
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
		$q="select distinct stream, (sum(averagepoints)/ count(adm)) as mean,  count(adm) as stds from totalygradedmidterm where fgrade!='F' and form='$form' and term='$term' and year='$year' group by stream desc";

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

</table>
