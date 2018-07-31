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

 $statement = "studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and  sd.form in('FORM 1','FORM 2','FORM 3','FORM 4') order by sd.admno asc";
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
	 $statements = "studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form in('FORM 1','FORM 2','FORM 3','FORM 4') order by sd.admno asc";
	 }
	 if($_POST['studend']=="alumini"){
 		$statements = "studentdetails AS sd INNER JOIN parentdetails pd ON sd.admno=pd.admno AND sd.form ='FORM 5' ORDER BY sd.admno ASC";
	}

 $result = mysql_query("SELECT sd.*,pd.telephone FROM $statements");
 ?>
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">Student Information: <?php echo $_POST['studend']?> 
		  <div style="float:right; margin-right:20px; width:50%;">
		  
		  <table align="right" width="60%">
                <tr>
				<td> <a href="pdf_students_list.php?id=<?php echo $_POST['studend']?>"  title="Click to Print"><i class="icon icon-orange icon-print"></i>Export PDF</a></td>
				<td><a href="csv_studentslist.php?type=<?php echo $_POST['studend']?>" class="noline"><i class='icon icon-orange icon-xls'></i>&nbsp;Export CSV</a></td>
                 
                </tr>
              </table>
		 
		  
	  		</div>
	  </td>
        </tr>
		<tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th> No.</th>
                  <th> Student Name </th>
				    <th>KCPE</th>
                  <th> Gender</th>
                  <th> Admno </th>
                  <th> Form </th>
                  <th> YrIn</th>
				  <th> YrOut </th>
				  <th> Contacts </th>
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
	
	echo '<td>'.str_replace("&","'",$row['fname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['sname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['lname']).'</td>';
	echo '<td>'.$row['marks'].'</td>';
	?>
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
	echo '<td>'.$row['telephone'].'</td>';
	?>
	<td> <a href="#" id="<?php echo $row['admno']?>&fname=<?php echo $row['fname']?>&sname=<?php echo $row['sname']?>&lname=<?php echo $row['lname']?>&gender=<?php echo $gender?>&form=<?php echo $dob?>" class="delbutton" title="Click To Delete"><i class="icon icon-orange icon-trash"></i></a></td>
				
               <td><a href="edit_student.php?id=<?php echo $row['admno']?>" title="Click to Edit Student Details"><i class="icon icon-orange icon-edit"></i></a></td>
				  <td><a href="student_profile.php?id=<?php echo $row['admno']?>" title="Student Profile"><i class="icon icon-orange icon-document"></i></a></td>
                <?php
				if( ($dao->getStudentLostBooks($row['admno'])>0) || ($dao->getIssuedBooks($row['admno'])>0)  ){?>
				<td><a href="#" title="Warning" onclick="return Warning()"><i class="icon icon-red icon-flag"></i></a></td>
				<?php
				}else{?>
				  
               <td>
				<a href="#openModal<?php echo $row['admno']?>" title="Click to Add Remarks"><i class="icon icon-orange icon-bookmark"></i></a>
				
				
	<div id="openModal<?php echo $row['admno']?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="student_leaving_certificate1.php" method="GET">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Student Remarks <?php echo $row['admno']?></font></td>
            </tr>
			 <tr>
			 <td width="20%">Remarks</td>
              <td><textarea name='ability' rows="7" cols="30" autofocus  tabindex="1" ></textarea></td>
            </tr>
            <tr>
			
            <tr>
             
              <td class="alterCell3" colspan='2'><input type="submit" name="submit" value="Generate Certificate" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input  type="hidden" name="id" value="<?php echo $row['admno'] ?>">
        </form>
      </div>
    </div>
	 	
				
				</td>
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
 
 $result = mysql_query("SELECT sd.*,pd.telephone FROM $statement");
	 $rowscounts=mysql_num_rows($result);
		 if($rowscounts==1 ||$rowscounts>1){
	?>
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">Student Information: Current
		  <div style="float:right; margin-right:20px; width:50%">
		  
		  <table align="right" width="60%" >
                <tr>
				<td> <a href="pdf_students_list.php?id=available"  title="Click to Print"><i class="icon icon-orange icon-print"></i>Export PDF</a></td>
				<td><a href="csv_studentslist.php?type=available" class="noline"><i class='icon icon-orange icon-xls'></i>&nbsp;Export CSV</a></td>
                 
                </tr>
              </table>
	  	</div>
	  </td>
        </tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th> No.</th>
                  <th> Student Name </th>
				   <th> KCPE </th>
				   <th> Admno </th>
                  <th> Gender</th>
                 
                  <th> Form </th>
                  <!--<th> Stream</th>
                  <th> Religion </th>-->
                  <th> YrIn </th>
				  <th> Contacts </th>
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
	echo '<td>'.$row['marks'].'</td>';
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
	echo '<td>'.$row['telephone'].'</td>';
	?>
	
	
	
	<td> <a href="#" onclick="return WarningDelete(<?php echo $row['admno']?>);" title="Click To Delete"><i class="icon icon-orange icon-trash"></i></a></td>
				
				
				
				
				
              <td><a href="edit_student.php?id=<?php echo $row['admno']?>" title="Click to Edit Student Details"><i class="icon icon-orange icon-edit"></i></a></td>
				  <td><a href="student_profile.php?id=<?php echo $row['admno']?>" title="Student Profile"><i class="icon icon-orange icon-document"></i></a></td>
				  
				<?php
				if( ($dao->getStudentLostBooks($row['admno'])>0) || ($dao->getIssuedBooks($row['admno'])>0)  ){?>
				<td><a href="#" title="Warning" onclick="return Warning()"><i class="icon icon-red icon-flag"></i></a></td>
				<?php
				}else{?>
				  
				  <td>
				<a href="#openModal<?php echo $row['admno']?>" title="Click to Add Remarks"><i class="icon icon-orange icon-bookmark"></i></a>
				
				
	<div id="openModal<?php echo $row['admno']?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="student_leaving_certificate1.php" method="GET">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Student Remarks <?php echo $row['admno']?></font></td>
            </tr>
			 <tr>
			 <td width="20%">Remarks</td>
              <td><textarea name='ability' rows="10" cols="40" autofocus  tabindex="1" ></textarea></td>
            </tr>
            <tr>
			
            <tr>
             
              <td class="alterCell3" colspan='2'><input type="submit" name="submit" value="Generate Certificate" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input  type="hidden" name="id" value="<?php echo $row['admno'] ?>">
        </form>
      </div>
    </div>
				
				</td>
				  
				  
               
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
