

<?php
 
	require_once('auth.php');

$name = $_POST['consti'];  // Retrieve POST data
$box = $_POST['box'];
$telephone = $_POST['telephone'];
$email= $_POST['email'];
$web= $_POST['web'];
//$email= $_POST['telephone'];

include('includes/dbconnector.php');

if(isset($_POST['consti'])){  // Check if selections were made

	$query="insert into schoolname (schname,box,place,telphone,email,website) 
	values('$name','$box','','$telephone','$email','$web') 
	on duplicate key update schname=schname";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('System Details Have Been Set');</script>";
		echo "<script language=javascript>window.location='system.php';</script>";
		 }
}else{
echo "Form Error";
 header("Location:system.php");
}
?>