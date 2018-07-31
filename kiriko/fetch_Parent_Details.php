<?php
	include("includes/dbconnector.php");
	$selected = $_GET['q'];	
?>

<input type="checkbox" id="selectall" onClick="selectAll(this)" />Select All
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th>#</th>
	<th>X</th>
    <th>Student Name</th>
    <th>Mobile No</th>
  </tr>
</thead>
<tbody>
<?php	
 $num=0;
 $query=("select sd.admno,sd.fname,sd.lname,sd.sname,pd.telephone from studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno where sd.form='$selected'");
	$result=mysql_query($query) ;
while($row=mysql_fetch_array($result)){
$num++;
?>
<tr>
  <td><span id=freetext><?php echo $num?></span></td>
  <td> <input type="checkbox"  name="checkbox[]"  value="<?php echo $row['telephone']?>"></td>
  <td align=left><span id=freetext><?php echo str_replace("&","'",$row['fname'])." ".str_replace("&","'",$row['sname'])." ".str_replace("&","'",$row['lname'])?></span></td>
  <td><span id=freetext><?php echo $row['telephone']?></span></td>
 </tr>
 <?php
}
?>
</tbody>
 </table>
  
