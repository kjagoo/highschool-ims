

<?php
require_once('auth.php');
$fname = str_replace("'","&",$_POST['fname']);  // Retrieve POST data
$mname = str_replace("'","&",$_POST['mname']);
$lname = str_replace("'","&",$_POST['lname']);
$idpas = $_POST['idpassp'];
$category=$_POST['cates'];
$staffno = $_POST['staffn'];
$estatus = $_POST['estatus'];
$pinnumber = $_POST['pinnumber'];
$salary = $_POST['salary'];
$qualification = $_POST['qualification'];
$telep = $_POST['tele'];
$address = str_replace("'","&",$_POST['address']);


include('includes/dbconnector.php');

if(isset($_POST['idpassp'])){  // Check if selections were made

	$query="update staff set fname='$fname', mname='$mname',lname='$lname',telephone='$telep',category='$category',staffno='$staffno', employement_type='$estatus', kra_pin='$pinnumber', salary='$salary', qualification='$qualification', address='$address' where idpass='$idpas'";
	 $result = mysql_query($query);

		if (!$result) {
        die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Staff Record Have Been Updated');</script>";
		echo "<script language=javascript>window.location='hr_stafflist.php';</script>";
		 }
}else{
echo "Form Error";
 header("Location:hr_stafflist.php");
}
?>