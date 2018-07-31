

<?php
 
	require_once('auth.php');

$cat1 = $_POST['cat1'];  // Retrieve POST data
$cat2 = $_POST['cat2'];
$exam = $_POST['exam'];

include('includes/dbconnector.php');

if(isset($cat1)){  // Check if selections were made
$total=$cat1+$cat2+$exam;

	$query="insert into standards (cat1,cat2,exam,total) 
	values('$cat1','$cat2','$exam','$total') 
	on duplicate key update cat1='$cat1', cat2='$cat2', exam='$exam',total='$total'";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Standard Marks Have Been Set');</script>";
		echo "<script language=javascript>window.location='dean_exam.php';</script>";
		 }
}else{
echo "Form Error";
 header("Location:dean_exam.php");
}
?>