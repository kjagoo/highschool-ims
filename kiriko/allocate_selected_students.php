<?php
	include('includes/dbconnector.php');
if(isset($_POST['delete'])){//CHECK IF THE DELETE BUTTON WAS CLICKED
	
	
	if(isset($_POST['checkbox'])){//CHECK IF THE ANYBOX WAS CLICKED
	
	$checkbox=$_POST['checkbox'];//STORE THE VALUE OF THE CHECKBOX IN A VARIABLE
	$year=$_POST['yr'];
	$term=$_POST['term'];
	$form=$_POST['form'];
	$stream=$_POST['stream'];
	$subject=$_POST['subject'];
	
	
	$cascade_delete = mysql_query("delete from tbl_studentsubjects where  subject='$subject' and  form='$form' and  year='$year' and term='$term' and stream='$stream'");// incase its is an update and one or mode units previously allocated has been removed
	 if (!$cascade_delete) {
		echo 'CASCADE ERROR : ' . mysql_error();
   		 }
		 
	
	$count=count($_POST['checkbox']);//COUNT THE NO OF VALUES STORED(NO OF CHECKBOXES CLICKED)
	for($i=0;$i<$count;$i++){//LOOP THROUGH ALL THE VALUES
	
	$del_id = $checkbox[$i]; //STORE EACH ONE IN A VARIABLE
	
	
	
	$sql = "insert into tbl_studentsubjects (admno, subject, form, year, term, stream)values('$del_id', '$subject', '$form', '$year', '$term', '$stream') on duplicate key update subject='$subject'";//CHANGE THE STATUS OF THE CONTACT TO SHOW THAT IT HAS BEEN DELETED
	$update_result = mysql_query($sql);
	
	
	}//end of for loop
	?>
	
	<script language=javascript>alert("Student(s) have been Allocated")</script>
	<script language=javascript>window.location="marks_subjects_studentview.php?subs=<?php echo $subject?>&form=<?php echo $form?>&term=<?php echo $term?>&year=<?php echo $year?>&stream=<?php echo $stream?>"</script>
	
	<?php
	}
	
	
	
	}
	?>