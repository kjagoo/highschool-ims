<?php
	include('includes/dbconnector.php');
if(isset($_POST['delete'])){//CHECK IF THE DELETE BUTTON WAS CLICKED
	
	
	if(isset($_POST['checkbox'])){//CHECK IF THE ANYBOX WAS CLICKED
	
	$checkbox=$_POST['checkbox'];//STORE THE VALUE OF THE CHECKBOX IN A VARIABLE
	$yrtod=$_POST['yrtodelete'];
	$trmtod=$_POST['termtodelete'];
	$mod=$_POST['modetodelete'];
	$fm=$_POST['formtodelete'];
	$srm=$_POST['streamtodelete'];
	$amode=$_POST['gradebytodelete'];
	
	$count=count($_POST['checkbox']);//COUNT THE NO OF VALUES STORED(NO OF CHECKBOXES CLICKED)
	for($i=0;$i<$count;$i++){//LOOP THROUGH ALL THE VALUES
	
	$del_id = $checkbox[$i]; //STORE EACH ONE IN A VARIABLE
	$sql = "UPDATE tbleperformancetrack SET s_status='1' WHERE (admno='$del_id' and year='$yrtod' and term='$trmtod')";//CHANGE THE STATUS OF THE CONTACT TO SHOW THAT IT HAS BEEN DELETED
	$update_result = mysql_query($sql);
	$delete_result = mysql_query("delete from totalygradedmarks where adm='$del_id' and  year='$yrtod' and term='$trmtod'");
	
	
	}//end of for loop
	?>
	
	<script language=javascript>alert("Student(s) have been removed")</script>
	<script language=javascript>window.location="report_forms_view_general.php?amode=<?php echo $mod?>&form=<?php echo $fm?>&term=<?php echo $trmtod?>&year=<?php echo $yrtod?>&stream=<?php echo $srm?>&gradeby=<?php echo $amode?>"</script>
	
	<?php
	}
	
	
	
	}
	?>