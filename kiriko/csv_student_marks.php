<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=classlist-export.xls");
include('includes/dbconnector.php');
 $form=$_GET['id'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	$subje=$_GET['subject'];
	$stream=$_GET['stream'];
if($form=='FORM 1'){
$myform=1;
}
if($form=='FORM 2'){
$myform=2;
}
if($form=='FORM 3'){
$myform=3;
}
if($form=='FORM 4'){
$myform=4;
}
?>
<table border="1">
<thead>
<th colspan="4">Student Marks List  <?php echo $form."  ".$stream." ".$subje." ".$year?></th>
</thead>
    <tr>
    	<th>NO.</th>
		<th >Admno</th>
                <th >Full Name</th>
                <th align='righ't>CAT 1</th>
                <th align='right'>CAT 2</th>
                <th align='right'>Final</th>
	</tr>
	  <?php	
	$num=0;
	$sub=0;
	
	$ads = "SELECT distinct(admno) FROM tbleperformancetrack where form='$myform' and year='$year' and term='$term' and stream='$stream' and s_status=0";//admno query
	$resultad = mysql_query($ads);
	while ($rowad = mysql_fetch_array($resultad)) {// get admno
	$num++;
	$admno=$rowad['admno'];
	
	$sub=0;
	$cat1 = "SELECT * FROM markscats where form='$myform' and term='$term' and year='$year' and cat='1' and admno='$admno'";//cat 1 query
	$result = mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get cat1 marks
	$sub=$row[$subje];
	
	}
	$getnames = "SELECT fname,sname,lname from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	
	}
	$ca2=0;
	
	$cat2 = "SELECT * FROM markscats where form='$myform' and term='$term' and year='$year' and cat='2' and admno='$admno'";// cat 2 query
	$result2 = mysql_query($cat2);
	while ($row3= mysql_fetch_array($result2)) {// get cat 2 marks
	$ca2=$row3[$subje];
	
	}
	$exams=0;
	$exam = "SELECT * FROM marksemams where form='$myform' and term='$term' 
	and year='$year' and admno='$admno'";// exam query
	$result4 = mysql_query($exam);
	while ($row4 = mysql_fetch_array($result4)) {// get exam marks
	$exams=$row4[$subje];
	}
?>
              <tr class="record">
                <td><?php echo $num?></td>
                <td><?php echo  $admno?></td>
                <td><?php echo str_replace("&","'",$fname)." ".str_replace("&","'",$mname)." ".str_replace("&","'",$lasname)?></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo $sub ?></font></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo $ca2?></font></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo $exams?></font></td>
				</tr>
		<?php
		}
		?>
</table>