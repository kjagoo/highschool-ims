 <?php
	if( isset($_POST['serial_no']) ){
	require_once("includes/dbconnector.php");
	$serialno=$_POST['serial_no'];
	 $from=$_POST['from'];
	  $to=$_POST['to'];
	  $status="CANCELLED";
	$results=mysql_query("update finance_feestructures set statusis='$status'  WHERE receipt_no='$serialno'");
	if($results){
	?>
	<script>alert("<?php echo $serialno?> Has been Canceled")</script>
	<script>window.location='finance_report_view_receipts.php?date4=<?php echo $from?>&date5=<?php echo $to?>'</script>
	<?php
	}else{
	?>
	<script>alert("Error!! <?php echo mysql_error()?>")</script>
	<script>window.location='finance_report_view_receipts.php?date4=<?php echo $from?>&date5=<?php echo $to?>'</script>
	<?php
	}
	}
	?>