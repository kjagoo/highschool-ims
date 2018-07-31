<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
//$usercat=$_SESSION['SESS_CATEGORY_'];
require_once("includes/dbconnector.php");  
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
<style type="text/css" class="init">

	</style>
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
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a href="dean_exam.php">Standard Marks</a></li>
    <li><a class="active" href="dean_grading.php">Grade Settings</a></li>
    <li><a href="dean_subjects_done.php">Subjects Done</a></li>
    <li><a href="dean_position_by.php">Positioning</a></li>
    <li><a href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a href="dean_report_forms.php">Report Form Lock</a></li>
  </ul>
</div>
<div class="clear"></div>


<div id="blocker">
  <div><img src="images/loading.gif" />Loading...</div>
</div>

</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <fieldset>
  <form id="contact-form" action="dean_edit_grades.php" name="catsform" method="post">
     <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Grades Setting</font></td>
            </tr>
        <tr>
          <td class="alterCell" width="20%">Select Subject</td>
          <td class="alterCell3" ><select name="subject" class="select" tabindex="1" required>
		  <option value="">-Select Subject- </option>
              <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATHS" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-BIOLOGY</option>
                  <option value="PHYSICS" >232-PHYSICS</option>
                  <option value="CHEMISTRY" >233-CHEMISTRY</option>
                  <option value="HISTORY" >311-HISTORY</option>
                  <option value="GEOGRAPHY" >312-GEOGRAPHY</option>
                  <option value="CRE" >313-CRE</option>
                  <option value="AGRICULTURE" >443-AGRICULTURE</option>
                  <option value="B/STUDIES" >565-B/STUDIES</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
				  <option value="FRENCH">501-FRENCH</option>
            </select>
			<select name="form" class="select" tabindex="2" required>
		  <option value="">-Select Form- </option>
		 	 <option value="1-2" >FORM 1 & Form 2</option>
			 <option value="3-4" >FORM 3 & Form 4</option>
              
            </select></td>
        </tr>
      
        
      </table>
    <input name="h" type="submit" class="btn btn-primary" value="Edit Grading Scheme"/>
	</form>
 
  
    </div></fieldset> 
    <div class="clear"></div>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Available Grades</td>
      </tr>
      <tr>
        <td>
		<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Subject</th>
                <th align='center'>Grade</th>
                <th align='center'>Minimum</th>
                <th align='center'>Maximum</th>
                <th align='center'>Points</th>
                <th align='center'>Remarks</th>
				<th align='center'>Form</th>
				<th></th>
              </tr>
            </thead>
			<?php
	


	
	

?>

            <tbody>
		<?php
		if(isset($_GET['id'])){
	 $form=$_GET['form'];
	$subject=$_GET['subject'];
	
	
 }else{		
	$subject = $_POST['subject']; 
	$form = $_POST['form']; 
    
}
	$myqueryis="select * from tblgrades where form='$form' and subject='$subject' order by points asc";
	
	$toexecute=mysql_query($myqueryis);
	$num=0;
	while ($rowr = mysql_fetch_array($toexecute)) {
	$num++;
	?>
	
	<tr class="record">
	<td> <div align="center"><?php echo $rowr['subject'];?></div></td>
	<td> <div align="center"><?php echo $rowr['grade'];?></div></td>
	<td><div align="center"><?php echo $rowr['minv'];?> </div></td>
	<td> <div align="center"><?php echo $rowr['maxv'];?></div></td>
	<td> <div align="center"><?php echo $rowr['points'];?></div></td>
	<td><div align="center"><?php echo $rowr['remarks'];?></div></td>
	<td> <div align="center"><?php echo str_replace("-","&",$rowr['form']);?></div></td>
	<td><div align="center">
	<a href="#openModal<?php echo $num?>" title="Click to Edit Grades"><i class="icon icon-orange icon-edit"></i></a></div>
	<div id="openModal<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="save_Grading.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Edit Grade setting <?php echo $rowr['grade']?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%"><b>Min:</b></td>
              <td class="alterCell2"><input type="text" name="min" class="inputFields" autofocus required  tabindex="1" value="<?php echo $rowr['minv'] ?>"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Max:</b></td>
              <td class="alterCell2"><input type="text" name="max" class="inputFields" autofocus required  tabindex="2" value="<?php echo $rowr['maxv'] ?>"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Remarks:</b></td>
              <td class="alterCell2"><input type="text" name="remarks" class="inputFields" autofocus required  tabindex="3" value="<?php echo $rowr['remarks'] ?>"/></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input name="subjects" type="hidden"  value="<?php echo $rowr['subject'];?>" />
	<input name="grades" type="hidden" value="<?php echo $rowr['grade'];?>" />
	<input name="points" type="hidden" value="<?php echo $rowr['points'];?>" />
	<input name="form" type="hidden" value="<?php echo $rowr['form'];?>" />
		 
        </form>
	</td>
	
	
	</tr>
	
	<?php
	
	 }
	?>		
	       </tbody> 
	  <tr><td></td></tr>  <?php ?> 
		  </table>
        </td>
      </tr>
	  
	  
    </table>
    </div>
  </div>
  	
  <!-- end of login form-->
</div>
</div>
<!--end of display area-->
 <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("You are about to delete Grade SET.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_grade.php",
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
