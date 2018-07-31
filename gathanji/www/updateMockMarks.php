

<?php

	require_once('auth.php');


include('includes/dbconnector.php');

if (isset($_POST['id'])) {  // Check if selections were made

$admn = $_POST['id'];  // Retrieve POST data
$c1 = $_POST['c1'];
$c2 = $_POST['c2'];
$exa = $_POST['ex'];

$form=$_POST['frm'];
$term=$_POST['trm'];
$year=$_POST['yr'];
$toupdate=$_POST['subjectis'];
$stream=$_POST['strm'];
				
	$query="update mockexams set ".$toupdate."1='$c1' ,".$toupdate."2='$c2' ,".$toupdate."3='$exa' where form='$form' 
	and term='$term' and year='$year' and admno='$admn'";//update cat 1
	
	 $result = mysql_query($query);

		if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		echo "<script language=javascript>alert('Marks Have Been Updated');</script>";
		?>
		<script language=javascript>window.location='manage_mock_marks.php?id=<?php echo $form;?>&term=<?php echo $term;?>&year=<?php echo $year;?>&subject=<?php echo $toupdate;?>&stream=<?php echo $stream;?>'</script>
		<?php
		}
		
}else{
echo "Form Error";
 //header("Location:setMarks.html");
 echo "<script language=javascript>window.location='marks_manage.php';</script>";
}
?>