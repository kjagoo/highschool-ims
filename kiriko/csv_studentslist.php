<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=Studentslist-export.xls");

$type=$_GET["type"];
?>
<table border="1">
<thead>
<th colspan="8"><br/>Students List  <?php echo $type?></th>
</thead>
    <tr>
    	<th> No.</th>
                  <th> Student Name </th>
				   <th> Admno </th>
                  <th> Gender</th>
                  <th> Form </th>
				   <th>Stream </th>
                  <th> Yr Admitted </th>
				  <th> Yr Finished </th>
				  <th> Contacts </th>
	</tr>
	<?php
	//connection to mysql
	  include('includes/dbconnector.php');
	if($type=="available"){
	 $statements = "studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form in('FORM 1','FORM 2','FORM 3','FORM 4') order by sd.admno asc";
	 }
	 if($type=="alumini"){
 		$statements = "studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and  pd.form='FORM 5' order by pd.admno asc";
	}

	//query get data
	$sql = mysql_query("SELECT sd.*,pd.telephone FROM $statements");
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.str_replace("&","'",$data['fname']).'&nbsp;&nbsp;'.str_replace("&","'",$data['sname']).'&nbsp;&nbsp;'.str_replace("&","'",$data['lname']).'</td>
			<td>'.$data['admno'].'</td>
			<td>'.$data['gender'].'</td>
			<td>'.$data['form'].'</td>
			<td>'.$data['class'].'</td>
			<td>'.$data['yrofadmn'].'</td>
			<td>'.$data['year_finished'].'</td>
			<td>'.$data['telephone'].'</td>
		</tr>
		';
		$no++;
	}
	?>
</table>