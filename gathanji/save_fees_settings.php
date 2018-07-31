<?php
if(isset($_POST['votehead']) && isset($_POST['term']) && isset($_POST['form'])){
 require_once("includes/dbconnector.php"); 
$votehead = $_POST['votehead'];
$yr= $_POST['year'];
$term= $_POST['term'];
$form= $_POST['form'];

$numded = count($votehead);

for ($i=0; $i < $numded; $i++){
$voteheadname=$_POST['votehead'][$i];
$amount=$_POST['payableamount'][$i];

 $query="insert into finance_fees (fiscal_yr,term,form,votehead,amount) 
	values('$yr','$term','$form','$voteheadname','$amount') 
	on duplicate key update fiscal_yr='$yr'";
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}

}?>

 <script language=javascript> alert('Fees Have been set Successfuly');</script>
 <script type='text/javascript'>window.open('finance_setfees.php','content');</script>
<?php 
	}
 ?>