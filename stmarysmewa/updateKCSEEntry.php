

<?php

	require_once('auth.php');


include('includes/dbconnector.php');

if (isset($_POST['indexn'])) {  // Check if selections were made

$indexn = $_POST['indexn']; 
$exa = $_POST['c1'];
$year=$_POST['yr'];
$toupdate=$_POST['subjectis'];
	
	$query="update kcsemarks set ".$toupdate."='$exa' where year_finished='$year' and index_numbers='$indexn'";//update cat 1
	  $result = mysql_query($query);

		if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		echo "<script language=javascript>alert('Grades Have Been Updated');</script>";
		?>
		<script language=javascript>window.location='KCSE_Manage_View.php?year=<?php echo $year;?>&subjects=<?php echo $toupdate;?>'</script>
		<?php
		}
		
}else{
echo "Form Error";
 //header("Location:setMarks.html");
 echo "<script language=javascript>window.location='KCSE_Manage.php';</script>";
}
?>