<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=Parentslist-export.xls");

$type=$_GET["type"];
  include('includes/dbconnector.php');
$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
		$schoolname=$de['schname'];
		$address=$de['box']." , ".$de['place'];
		//$logref=$de['logref'];
		$tele=$de['telphone'];
		$email=$de['email'];
		$web=$de['website'];
	}
	
?>
<table border="1">
<thead>
<th colspan="8"><?php echo $schoolname?> <br/>Students List  <?php echo $type?></th>
</thead>
    <tr>
    	<th> No.</th>
                  <th> Student Name </th>
				   <th> Admno </th>
                    <th> CLass </th>
				   <th>Stream </th>
				   
                  <th> Contact</th>
				 
	</tr>
	<?php
	//connection to mysql
	
	if($type=="available"){
	 $statements = "studentdetails s,parentdetails p where form!='FORM 5' and p.admno=s.admno order by form asc, s.admno asc";
	 }
	 if($type=="alumini"){
 		$statements = "studentdetails s,parentdetails p  where form='FORM 5' and s.admno=p.admno order by admno asc";
	}

	//query get data
	$sql = mysql_query("SELECT * FROM $statements");
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.str_replace("&","'",$data['fname']).'&nbsp;&nbsp;'.str_replace("&","'",$data['sname']).'&nbsp;&nbsp;'.str_replace("&","'",$data['lname']).'</td>
			<td>'.$data['admno'].'</td>
			
			<td>'.$data['form'].'</td>
			<td>'.$data['class'].'</td>
			<td>'.$data['telephone'].'</td>
			
		';
		$no++;
	}
	?>
</table>