

<?php

	require_once('auth.php');


include('includes/dbconnector.php');

if (isset($_POST['id'])) {  // Check if selections were made

$admn = $_POST['id'];  // Retrieve POST data
$sub = $_POST['subjects'];
$frm=$_POST['frms'];
$form=$_POST['frm'];
$term=$_POST['trm'];
$year=$_POST['yr'];
$toupdate=$_POST['subjectis'];

/*where form='"+forms+"' and term='"+terms+"' and year='"
						+EditMarks.yeartxt.getSelectedItem()+"' and cat=1 and admno='"+
						selectedTable+"'");
	*/					
	$query="update subjectsforstudent set subjects='$sub' where admno='$admn' and form='$frm'";
	 $result = mysql_query($query);

		if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		echo "<script language=javascript>alert('Subjects Done Have Been Updated');</script>";
		?>
		<script language=javascript>window.location='view_subjects_done.php?forms=<?php echo $form;?>&term=<?php echo $term;?>&years=<?php echo $year;?>&subjects=<?php echo $toupdate;?>'</script>
		<?php
		}
		
}
?>