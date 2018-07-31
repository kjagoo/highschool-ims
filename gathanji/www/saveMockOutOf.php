

<?php

	require_once('auth.php');

$form = $_POST['formm'];
$year = $_POST['yrs'];
$term = $_POST['termm'];
$subje = $_POST['subm'];
$p1 = $_POST['p1']; 
$p2 = $_POST['p2'];
$p3 = $_POST['p3'];
$total = $_POST['total'];

include('includes/dbconnector.php');

if(isset($total)){  // Check if selections were made

	$query="insert into mocks (subject,p1,p2,p3,total,form,term,year,states) 
	values('$subje','$p1','$p2','$p3','$total','$form','$term','$year','set') 
	on duplicate key update p1='$p1',p2='$p2', p3='$p3' ,total='$total'";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Marks Have Been Set');</script>";
		echo "<script language=javascript>window.location='marks_set.php';</script>";
		 }
}else{
echo "Form Error";
 header("Location:marks_set.php");
}
?>