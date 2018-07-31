<?php
	if($_POST){
	include('includes/dbconnector.php');
	date_default_timezone_set('Africa/Nairobi');
	$admno = $_POST['admno']; 
	$comment = $_POST['comment']; 
	$date_added =date("Y-m-d h:i:sa");
	
	$query="insert into guidance(admno, date_added, comments)values('$admno', '$date_added', '$comment')";
	 $result = mysql_query($query);

		if (!$result) {
		echo 'Invalid query: ' . mysql_error();
   		 }
	
	echo "Report Saved Successfully";
	}
	?>