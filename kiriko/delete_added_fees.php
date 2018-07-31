<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
$func = new Functions();

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
if($_GET['id'])
{
$id=$_GET['id'];
$admno=$_GET['admno'];
$year=$_GET['year'];
$term=$_GET['term'];

 $sql = "delete from finance_added_fees where votehead='$id' and admno='$admno' and term='$term' and fiscal_year='$year'";
$result = mysql_query($sql);

		if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		 $activity = "Deleted Added Fees for".$id;
		$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Fees Havs Been Updated');</script>";
		?>
		<script language=javascript>window.location='finance_set_fees_additional_manage.php?admno=<?php echo $admno;?>&term=<?php echo $term;?>&yr=<?php echo $year;?>'</script>
		<?php
		}


}

?>