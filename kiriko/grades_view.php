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
<div id="blocker">
  <div><img src="images/loading.gif" />Loading...</div>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
    <div class="clear"></div>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Available Grades</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Subject</th>
                <th align='center'>Grade</th>
                <th align='center'>Minimum</th>
                <th align='center'>Maximum</th>
                <th align='center'>Points</th>
                <th align='center'>Remarks</th>
				<th align='center'>Class</th>
				<th></th>
				<th></th>
              </tr>
            </thead>
            <tbody>
		<?php
	$myqueryis="select * from tblgrades order by subject desc";
	$toexecute=mysql_query($myqueryis);
	$num=0;
	while ($rowr = mysql_fetch_array($toexecute)) {
	$num++;
	?>
	
	<tr class="record">
	<td> <?php echo $rowr['subject'];?></td>
	<td> <?php echo $rowr['grade'];?></td>
	<td> <?php echo $rowr['minv'];?></td>
	<td> <?php echo $rowr['maxv'];?></td>
	<td> <?php echo $rowr['points'];?></td>
	<td> <?php echo $rowr['remarks'];?></td>
	<td> <?php echo str_replace("-","&",$rowr['form']);?></td>
	<td>
	
	<a href="#openModal<?php echo $num?>" title="Click to Edit Route"><i class="icon icon-orange icon-edit"></i></a>
				<div id="openModal<?php echo $num?>" class="modalDialog">
				  <div> <a href="#close" title="Close" class="close">X</a>
					<form name="subjectform" action="updateGrade.php" method="post">
					  <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
						<tr style='height:30px;'>
						  <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing Grades </font></td>
						</tr>
						<tr>
          <td class="alterCell3" ><select name="subs" class="select" tabindex="1" required>
		  
		  <option value="<?php echo $rowr["subject"]; ?>" selected='selected'><?php echo $rowr["subject"]; ?></option>
		  <option value="">-Select Subject- </option>
              <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATH" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-SCIENCE</option>
                  <option value="CRE" >313-SOCIAL</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
            </select>
			</td>
			<td>
			<select name="form" class="select" tabindex="2" required>
			<option value="<?php echo str_replace(" ","_",$rowr["form"]); ?>" selected='selected'><?php echo $rowr["form"]; ?></option>
		  <option value="">-Select Class- </option>
             <option value="1-2">Form 1 & 2</option>
			 <option value="3-4">Form 3 & 4</option>
            </select></td>
        </tr>
       <tr>
	 	<td class="alterCell3" colspan='2' > 
	 		<select name="grades" class="select" tabindex="3" required>
			 <option value="<?php echo $rowr["grade"]; ?>" selected='selected'><?php echo $rowr["grade"]; ?></option>
	 		<option value="">-Select Grade- </option>
              <option value="E">E</option>
              <option value="D-">D-</option>
              <option value="D">D</option>
              <option value="D+">D+</option>
			  <option value="C-">C-</option>
			  <option value="C">C</option>
			  <option value="C+">C+</option>
			  <option value="B-">B-</option>
			  <option value="B">B</option>
			  <option value="B+">B+</option>
			  <option value="A-">A-</option>
			  <option value="A">A</option>
            </select> 
			
			</td>
		</tr>
        <tr>
          <td class="alterCell3" >Minimum Marks:<input type="text" name="min" tabindex="1" required value='<?php echo $rowr["minv"]; ?>' /></td>
          <td class="alterCell3">Maximum Marks: <input type="text" name="max" tabindex="1" required value='<?php echo $rowr["maxv"]; ?>' /></td>
        </tr>
        <tr>
          <td class="alterCell3" colspan='2'><div style="float:left; width:10%">Points:</div><div style="float:left;"><input type="text" class="inputFields" name="points"  tabindex="1" required value='<?php echo $rowr["points"]; ?>' /></div> </td>
        </tr>
		<tr>
          <td class="alterCell3" colspan='2'><div style="float:left;width:10%">Remarks:</div><div style="float:left;"><input type="text" class="inputFields" name="remarks"  tabindex="1" required value='<?php echo $rowr["remarks"]; ?>' /></div> </td>
        </tr>
						
		<tr>
		<td class="alterCell3" colspan='2'><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
		</tr>
		</table>
					<input type="hidden" name="oldsubject" value="<?php echo $rowr["subject"]; ?>">
				  <input type="hidden" name="oldminv" value="<?php echo $rowr["minv"]; ?>">
				  <input type="hidden" name="oldmaxv" value="<?php echo $rowr["maxv"]; ?>">
				  <input type="hidden" name="oldgrade" value="<?php echo $rowr["grade"]; ?>">
				  <input type="hidden" name="oldform" value="<?php echo $rowr["form"]; ?>">
					</form>
				  </div>
				</div>
	
	</td>
	<td>
	
	<a href="#openModaldelete<?php echo $num?>" title="Click to Delete Class"><span class="icon icon-orange icon-trash"></span></a>
				
				
	<div id="openModaldelete<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="delete_grade.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Delete Grade </font></td>
            </tr>
            <tr>
			<td colspan='2' align='center'>
			<h2>Warning!!</h2>
              You are Deleting <?php echo "Grade  ". $rowr["grade"] ." For ". $rowr["subject"] ."  ". $rowr["form"]?>
			</td>
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Delete Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="oldsubject" value="<?php echo $rowr["subject"]; ?>">
		  <input type="hidden" name="oldminv" value="<?php echo $rowr["minv"]; ?>">
		  <input type="hidden" name="oldmaxv" value="<?php echo $rowr["maxv"]; ?>">
		  <input type="hidden" name="oldgrade" value="<?php echo $rowr["grade"]; ?>">
		  <input type="hidden" name="oldform" value="<?php echo $rowr["form"]; ?>">
        </form>
      </div>
    </div>
	
	</td>
	</tr>
	
	<?php
	}
	?>		
            </tbody>
          </table></td>
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
