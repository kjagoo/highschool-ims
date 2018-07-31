

<?php

	require_once('auth.php');


include('includes/dbconnector.php');

if (isset($_POST['id'])) {  // Check if selections were made

$admn = $_POST['id'];  // Retrieve POST data
$votehead = $_POST['votehead'];
$amount = $_POST['c2'];


$form=$_POST['frm'];
$term=$_POST['trm'];
$year=$_POST['yr'];
				
	$query="insert into finance_added_fees (admno, fiscal_year, term, votehead, amount) values
	('$admn', '$year', '$term', '$votehead', '$amount') on duplicate key update amount='$amount'";//update cat 1
	
	 $result = mysql_query($query);

		if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		echo "<script language=javascript>alert('Fees Havs Been Updated');</script>";
		?>
		<script language=javascript>window.location='finance_set_fees_additional.php?form=<?php echo $form;?>&term=<?php echo $term;?>&yr=<?php echo $year;?>'</script>
		<?php
		}
		
}else{
echo "Form Error";
 //header("Location:setMarks.html");
 echo "<script language=javascript>window.location='finance_additional_Fees.php';</script>";
}
?>