 <?php
	if( isset($_POST['vh']) && isset($_POST['amt']) ){
	require_once("includes/dbconnector.php");
	require_once('auth.php');
  include 'includes/fees.php';
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 $fee = new fees();
 

$func = new Functions();


	$year=$_POST['year'];
	$term=$_POST['term'];
	$form=$_POST['form'];
	$votehead=str_replace(" ","_",$_POST['vh']);
	$votehead=str_replace("/","&",$votehead);
	$amt=$_POST['amt'];
	
	
	
	$qury="insert into finance_fees (fiscal_yr,term,form,votehead,amount) values ('$year','$term','$form','$votehead','$amt') on duplicate key update amount='$amt'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
		$amt=$fee->getVoteheadSum($year,$term,$form);
		$query2="update finance_student_invoices set amount='$amt' where form='$form' and year='$year' and term='$term'";
 $result2 = mysql_query($query2);
 if(!$result2){
	die('Invalid query: ' . mysql_error());
	}
	
	$activity = "New Votehead Fees ".$votehead;
	$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Fees Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='finance_view_fees.php?year=$year&form=$form&term=$term' </script>";
	}
	}
	
?>