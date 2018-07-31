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
				<th align='center'>Form</th>
				<th></th>
				<th></th>
              </tr>
            </thead>
            <tbody>
		<?php
	$myqueryis="select * from tblgrades order by subject desc, form asc,points asc";
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
	<td><a href="#openModal<?php echo $num?>" title="Click to Edit Grades"><i class="icon icon-orange icon-edit"></i></a></td>
	<td><a href="#" id="<?php echo $row["id"]; ?>" class="delbutton"><i class="icon icon-orange icon-trash"></i></a></td>
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
