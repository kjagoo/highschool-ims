<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
   include 'includes/functions.php';
   include 'includes/DAO.php';
$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$dao = new DAO();
	$activity = "Viewed student list";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

 $statement = "studentdetails where form='FORM 1' Or form='FORM 2' or form='FORM 3' or form='FORM 4' order by admno asc";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );

String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};

	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}
function Warning(){

	alert("WARNING !!\n\nThis student cannot be cleared\n\nCheck Lost Books\nUn-Returned Books\nUn-Cleared Fees");
	return false;
}
function WarningDelete(id){

 if(confirm("WARNING !!\n\nYou are about to delete this student\n\nDo you want to continue?")){

window.location="delete_student_trans.php?id="+id;
/* $.ajax({
   type: "GET",
   url: "delete_student_trans.php",
   data: info,
   success: function(){
   
   }
 });*/
 }else{
	return false;
	}
}


	</script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script>
</head>
<body>
<div id="blocker">
  <div><img src="images/loading.gif" />Loading...</div>
</div>

      <?php
	  include('includes/dbconnector.php');
	if (isset ($_POST['studend'])){
	
	if($_POST['studend']=="available"){
	 $statements = "studentdetails where form='FORM 1' Or form='FORM 2' or form='FORM 3' or form='FORM 4' order by admno asc";
	 }
	 if($_POST['studend']=="alumini"){
 		$statements = "studentdetails where form='FORM 5' order by admno asc";
	}

 $result = mysql_query("SELECT * FROM $statements");
 ?>
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">Student Information: <?php echo $_POST['studend']?> <div style="float:right; margin-right:20px;"><a href="pdf_students_list.php?id=<?php echo $_POST['studend']?>"  title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a>
	<a href="csv_parentslist.php?type=<?php echo $_POST['studend']?>" class="noline"><i class='icon icon-orange icon-xls'></i>&nbsp;Parent Contacts Export CSV</a></td>
   
</div>
                
        </tr>
		<tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th> No.</th>
                  <th> Student Name </th>
                  <th> Gender</th>
                  <th> Admno </th>
                  <th> Form </th>
                  <!--    <th> Stream</th>
              <th> Religion </th>-->
                  <th> YrIn</th>
				  <th> YrOut </th>
                  <th> </th>
				   <th> </th>
				    <th> </th>
					  <th> </th>
                </tr>
              </thead>
              <tbody>
                <?php
		$num=0;
    //$query="SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}";
		//$result = mysql_query($query);
		//$result = mysql_query("SELECT * FROM licences ");
		while($row = mysql_fetch_array($result)){
		$num++;
		$adm=$row['admno'];
		$fname=$row['fname'];
		$mname=$row['sname'];
		$lname=$row['lname'];
		$gender=$row['gender'];
		$dob=$row['form'];
		$age=$row['class'];
		//$reli=$row['religion'];
		
		$name=$fname." &nbsp;".$mname."&nbsp;".$lname;
		
	
	echo "<tr class='record'>";
	echo '<td>'.$num.'</td>';
	
	echo '<td>'.str_replace("&","'",$row['fname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['sname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['lname']).'</td>';?>
	<td><script type="text/javascript">
			var test = "<?php echo $row['gender'] ?>";
			document.write(test.parseURL());
			</script></td>
	<?php
	echo '<td>'.$row['admno'].'</td>';
	echo '<td>'.$row['form']." ".$row['class'].'</td>';
	//echo '<td>'.$row['class'].'</td>';
	//echo '<td>'.$row['religion'].'</td>';
	echo '<td>'.$row['yrofadmn'].'</td>';
	if($_POST['studend']=="available"){
	echo '<td>Current</td>';
	}else{
	echo '<td>'.$row['year_finished'].'</td>';
	}
	?>
	<td> <a href="#" id="<?php echo $row['admno']?>&fname=<?php echo $row['fname']?>&sname=<?php echo $row['sname']?>&lname=<?php echo $row['lname']?>&gender=<?php echo $gender?>&form=<?php echo $dob?>" class="delbutton" title="Click To Delete"><i class="icon icon-orange icon-trash"></i></a></td>
				
               <td><a href="edit_student.php?id=<?php echo $row['admno']?>" title="Click to Edit Student Details"><i class="icon icon-orange icon-edit"></i></a></td>
				  <td><a href="student_profile.php?id=<?php echo $row['admno']?>" title="Student Profile"><i class="icon icon-orange icon-document"></i></a></td>
                <?php
				if( ($dao->getStudentLostBooks($row['admno'])>0) || ($dao->getIssuedBooks($row['admno'])>0)  ){?>
				<td><a href="#" title="Warning" onclick="return Warning()"><i class="icon icon-red icon-flag"></i></a></td>
				<?php
				}else{?>
				  
                <td><a href="student_leaving_certificate.php?id=<?php echo $row['admno']?>" title="Leaving Certificate"><i class="icon icon-orange icon-bookmark"></i></a></td>
				<?php }?>
              </tr>
              <?php
			}
		?>
              </tbody>
              
            </table></td>
        </tr>
      </table>
      <?php
 }//end of if isset
 else{
 
 $result = mysql_query("SELECT * FROM $statement");
	 $rowscounts=mysql_num_rows($result);
		 if($rowscounts==1 ||$rowscounts>1){
	?>
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">Student Information: Current<div style="float:right; margin-right:20px;"><a href="pdf_students_list.php?id=available"  title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a>
	  </div></td>
        </tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th> No.</th>
                  <th> Student Name </th>
				   <th> Admno </th>
                  <th> Gender</th>
                 
                  <th> Form </th>
                  <!--<th> Stream</th>
                  <th> Religion </th>-->
                  <th> YrIn </th>
                  <th>  </th>
				   <th>  </th>
				    <th>  </th>
					 <th>  </th>
                </tr>
              </thead>
              <tbody>
                <?php
    
		$num=0;
    //$query="SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}";
		//$result = mysql_query($query);
		//$result = mysql_query("SELECT * FROM licences ");
		while($row = mysql_fetch_array($result)){
		$num++;
		$adm=$row['admno'];
		$fname=$row['fname'];
		$mname=$row['sname'];
		$lname=$row['lname'];
		$gender=$row['gender'];
		$dob=$row['form'];
		$age=$row['class'];
		$reli=$row['religion'];
		
		$name=$fname." &nbsp;".$mname."&nbsp;".$lname;
		
	
	echo "<tr class='record'>";
	echo '<td>'.$num.'</td>';
	
	echo '<td>'.str_replace("&","'",$row['fname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['sname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['lname']).'</td>';
	echo '<td>'.$row['admno'].'</td>'; ?>
	 <td><script type="text/javascript">
			var test = "<?php echo $row['gender'] ?>";
			document.write(test.parseURL());
			</script></td>
	<?php
	
	echo '<td>'.$row['form']."  ".$row['class'].'</td>';
	//echo '<td>'.$row['class'].'</td>';
	//echo '<td>'.$row['religion'].'</td>';
	echo '<td>'.$row['yrofadmn'].'</td>';
	?>
	
	
	
	<td> <a href="#" onclick="return WarningDelete(<?php echo $row['admno']?>);" title="Click To Delete"><i class="icon icon-orange icon-trash"></i></a></td>
				
				
				
				
				
              <td><a href="edit_student.php?id=<?php echo $row['admno']?>" title="Click to Edit Student Details"><i class="icon icon-orange icon-edit"></i></a></td>
				  <td><a href="student_profile.php?id=<?php echo $row['admno']?>" title="Student Profile"><i class="icon icon-orange icon-document"></i></a></td>
				  
				<?php
				if( ($dao->getStudentLostBooks($row['admno'])>0) || ($dao->getIssuedBooks($row['admno'])>0)  ){?>
				<td><a href="#" title="Warning" onclick="return Warning()"><i class="icon icon-red icon-flag"></i></a></td>
				<?php
				}else{?>
				  
                <td><a href="student_leaving_certificate.php?id=<?php echo $row['admno']?>" title="Leaving Certificate"><i class="icon icon-orange icon-bookmark"></i></a></td>
				<?php }?>
				
              </tr>
              <?php
			}
		?>
              </tbody>
              
            </table></td>
        </tr>
      </table>
      <?php
}else{
 echo 'There are no students';

}
}
?>
   
<!--end of display area. 
This area changes when a user searches for an item-->
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("You are about to delete this Student Details.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_student_trans.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
		//alert('Deletion Successful');

 }

return false;

});

});
</script>

</body>
</html>
