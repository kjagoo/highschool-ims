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

if($form==1){
$myform='FORM 1';
}
if($form==2){
$myform='FORM 2';
}
if($form==3){
$myform='FORM 3';
}
if($form==4){
$myform='FORM 4';
}

/*where form='"+forms+"' and term='"+terms+"' and year='"
						+EditMarks.yeartxt.getSelectedItem()+"' and cat=1 and admno='"+
						selectedTable+"'");
	*/					
	$query="update markscats set ".$toupdate."='$c1' where form='$form' 
	and term='$term' and year='$year' and cat='1' and admno='$admn'";//update cat 1
	
	$query2="update markscats set ".$toupdate."='$c2' where form='$form' 
	and term='$term' and year='$year' and cat='2' and admno='$admn'";//update cat 1
	
	$query3="update marksemams set ".$toupdate."='$exa' where form='$form' 
	and term='$term' and year='$year' and admno='$admn'";//update cat 1
	
	 $result = mysql_query($query);
	 $result2 = mysql_query($query2);
	  $result3 = mysql_query($query3);

		if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		echo "<script language=javascript>alert('Marks Have Been Updated');</script>";
		?>
		<script language=javascript>window.location='manage_student_marks.php?id=<?php echo $myform;?>&term=<?php echo $term;?>&year=<?php echo $year;?>&subject=<?php echo $toupdate;?>&stream=<?php echo $stream;?>'</script>
		<?php
		}
		
}else{
echo "Form Error";
 //header("Location:setMarks.html");
 echo "<script language=javascript>window.location='marks_manage.php';</script>";
}
?>