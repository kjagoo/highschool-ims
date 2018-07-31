

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

$date=date("Y-m-d");
include('includes/dbconnector.php');

if(isset($fname)){  // Check if selections were made

include 'includes/functions.php';
$username=$_SESSION['SESS_MEMBER_ID_'];
$func = new Functions();
$activity = "Added new Staff ".$idpas;
$func->addAuditTrail($activity,$username);

// Configuration - Your Options
      $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // These will be the types of file that will pass the validation.
      $max_filesize = 524288; // Maximum filesize in BYTES (currently 0.5MB).
      $upload_path = 'Staff/'; // The place the files will be uploaded to (currently a 'files' directory).
 
   $filename = $_FILES['userfile']['name']; // Get the name of the file (including file extension).
     echo $filename;
	if(!$filename){
	$newFilename="blur.PNG";
	}else{
	$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
   	$newFilename = $idpas . $ext;
	}
	

	$query="insert into staff (fname,mname,lname,idpass,imgref,telephone,category,staffno,employement_type,kra_pin,salary,qualification,address,passwrd,dateJoined,dateLeft) values('$fname','$mname','$lname','$idpas','$newFilename','$telep','$category','$staffno','$estatus','$pinnumber','$salary','$qualification','$address','$idpas','$date','_')";
	 $result = mysql_query($query);

		if (!$result) {
        die('Invalid query: ' . mysql_error());
   		 }else{
		 if(!$filename){}else{
		 $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
   	$newFilename = $idpas . $ext;
		 move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $newFilename);
		 }
		echo "<script language=javascript>alert('A New Staff Have Been Added');</script>";
echo "<script language=javascript>window.location='hr_newstaff.php';</script>";
		 }
}else{
echo "Form Error";
 header("Location:hr_newstaff.php");
}
?>