 <?php
 require_once('auth.php'); 
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
$func = new Functions();



	if(isset($_POST['keyword2']) && isset($_POST['userid'])){
	require_once("includes/dbconnector.php");
	$keywords=$_POST['keyword2'];
	$datedue=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$arr=explode(" ",$keywords);
	
	$bookid=$arr[0];
	$admno=$_POST['userid'];
	$bookno=$_POST['bookno'];
	$comments=$_POST['comment'];
	$date=date("Y-m-d");
	
	//check if this student has been issued with this books
	$query="SELECT * from issued_books where bookid='$bookid' and bookno='$bookno' and userid='$admno'";
    $result = mysql_query($query);
	 $rowscount=mysql_num_rows($result);
  
   if($rowscount==1 ||$rowscount>1){
   ?>
  <script language=javascript>alert('ISSUE ERROR!\n\nThe student has already been issued with this books and has not returned') </script>
	<script language=javascript>window.location='library_view_issuebook.php' </script>
	<?php
	}else{
	
	$qury="insert into issued_books (bookid,bookno,userid,dateissued,datedue,issuer,comments) values ('$bookid','$bookno','$admno','$date','$datedue','$username','$comments')";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "Issued book to ".$admno." REF ID ". $bookid;
$func->addAuditTrail($activity,$username);
	echo "<script language=javascript>alert('Issued Books Record Has been Updated') </script>";
		 echo "<script language=javascript>window.location='library_view_issuebook.php' </script>";
	}
	}
}
	
?>