<?php
require_once('auth.php');

$adms = $_POST['adm']; 
$fname = $_POST['fname']; 
$mname = $_POST['mname']; 
$lname = $_POST['lname']; 
$gender = $_POST['pick']; 
$dob = $_POST['yob']; 
$age = $_POST['age']; 
$relig = $_POST['reli']; 
$yearadm = $_POST['yearad']; 
$pres = $_POST['pschool']; 
$marks = $_POST['kmarks']; 
$grades = $_POST['kgrade']; 
$form = $_POST['form']; 
$stream = $_POST['stream']; 
$category = $_POST['cate']; 
$house = $_POST['house']; 

$pfname = $_POST['pfname']; 
$pmname = $_POST['pmname']; 
$plname = $_POST['plname']; 
$idp = $_POST['idpass'];
$address = $_POST['address'];  
$telep = $_POST['telephone']; 

$fname=str_replace('\'','&',$fname);
$mname=str_replace('\'','&',$mname);
$lname=str_replace('\'','&',$lname);

$pfname=str_replace('\'','&',$pfname);
$pmname=str_replace('\'','&',$pmname);
$plname=str_replace('\'','&',$plname);

$address=str_replace('\'','&',$address);
$pres=str_replace('\'','&',$pres);
$house=str_replace('\'','&',$house);
include('includes/dbconnector.php');

   // Configuration - Your Options
      $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // These will be the types of file that will pass the validation.
      $max_filesize = 524288; // Maximum filesize in BYTES (currently 0.5MB).
      $upload_path = 'Image/'; // The place the files will be uploaded to (currently a 'files' directory).
 
   $filename = $_FILES['userfile']['name']; // Get the name of the file (including file extension).
    
	if(!$filename){
	//record studnt without photo
	
	$query="insert into studentdetails (admno,fname,lname,sname,gender,dob,age,
					religion,previouschool,marks,picture,yrofadmn,form,forminto,category,house,grade,class)
					values('$adms','$fname','$lname','$mname','$gender','$dob','$age',
					'$relig','$pres','$marks','-','$yearadm','$form','$form','$category','$house','$grades','$stream')";
	 $result = mysql_query($query);
	if (!$result) {
       // die('Invalid query: ' . mysql_error());
	   echo "<script language=javascript>alert('A student with such admission number is already registered.') </script>";
	echo "<script language=javascript>window.location='student_list.php' </script>";
   		 }else{
		 //save parent details
		 $query2="insert into parentdetails (admno,fname,lname,sname,idpass,address,telephone)
		 					values('$adms','$pfname','$plname','$pmname','$idp','$address','$telep')";
		$commad=mysql_query($query2);
		if (!$commad) {
        die('Invalid commad: ' . mysql_error());
   		 }	else{		
		echo "<script language=javascript>alert('New Student Have Been Recorded Without A photo') </script>";
		 echo "<script language=javascript>window.location='student_addnew.php' </script>";
		 }
		 }
	}
	else{
	
	//record studnt details and add a photo
	$query="insert into studentdetails (admno,fname,lname,sname,gender,dob,age,
					religion,previouschool,marks,picture,yrofadmn,form,forminto,category,house,grade,class)
					values('$adms','$fname','$lname','$mname','$gender','$dob','$age',
					'$relig','$pres','$marks','-','$yearadm','$form','$form','$category','$house','$grades','$stream')";
	 $result = mysql_query($query);
	if (!$result) {
        //die('Invalid query: ' . mysql_error());
		 echo "<script language=javascript>alert('A student with such admission number is already registered.') </script>";
	echo "<script language=javascript>window.location='student_addnew.php' </script>";
   		 }else{
		 //save parent details
		 $query2="insert into parentdetails (admno,fname,lname,sname,idpass,address,telephone)
		 					values('$adms','$pfname','$plname','$pmname','$idp','$address','$telep')";
		$commad=mysql_query($query2);
		if (!$commad) {
         die('Invalid commad: ' . mysql_error());
   		 }	else{		
		
		$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
   	$newFilename = $adms . $ext;

 	 move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $newFilename);
	echo "<script language=javascript>alert('Student Details Were Saved.') </script>";
	echo "<script language=javascript>window.location='student_addnew.php' </script>";
		 }
		 }
         //echo 'Your file upload was successful, view the file <a href="' . $upload_path . $newFilename . '" 
		 //title="Your File">here</a>'; // It worked.
     
 }
 
?>