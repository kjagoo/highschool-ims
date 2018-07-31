<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=classlist-export.xls");

$form=$_GET["forms"];
	$stream=$_GET["stream"];
?>
<table border="1">
<thead>
<th colspan="4">Class List  <?php echo $form."  ".$stream?></th>
</thead>
    <tr>
    	<th>No.</th>
		<th>Adm. No.</th>
		<th>KCPE</th>
		<th>Student's Name</th>
		<th>Contact</th>
	</tr>
	<?php
	//connection to mysql
	  include('includes/dbconnector.php');
		
	$form=$_REQUEST["forms"];
	$stream=$_REQUEST["stream"];
	$genders=$_REQUEST["genders"];
	
	//echo $form."  ".$stream."  ".$genders;
	
if($genders=="Entire"){
$query = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' ORDER BY sd.ADMNO ASC";
}
if($genders=="Boys"){
$query = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' and sd.gender='Male'  ORDER BY sd.ADMNO ASC";
}
if($genders=="Girls"){
$query = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' and sd.gender='Female'  ORDER BY sd.ADMNO ASC";
}

	//query get data
	$sql = mysql_query($query);
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['admno'].'</td>
			<td>'.$data['marks'].'</td>
			<td>'.$data['fname']." ".$data['lname']." ".$data['sname'].'</td>
			<td>'.$data['telephone'].'</td>
		</tr>
		';
		$no++;
	}
	?>
</table>