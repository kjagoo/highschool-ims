<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Settings streams page";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>
<!-- Initiate tablesorter script -->
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
 
String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};

	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="library_subjects.php">Subjects</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
     <table width="80%">
        <tr>
          <td valign="middle" rowspan="2"><a href="#openModal" class="btn btn-primary"><span class="icon icon-green icon-plus"></span> Add New Subject</a></td>
        </tr>
      </table>
    </fieldset>
    <div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;Adding New Subject</td>
            </tr>
            <tr>
              <td class="alterCell" width="20%"><b>Subject:</b></td>
              <td class="alterCell2"><input type="text" name="subject" class="inputFields" autofocus required  tabindex="1"/></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Save Record" class="btn btn-primary"/></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
	 <?php
	if(isset($_POST['subject'])){
	require_once("includes/dbconnector.php");
	
	$subject=$_POST['subject'];
	$subject=str_replace(" ","-",$subject);
	$date=date("Y-m-d H:i:s a");
	$qury="insert into subjects (subject) values ('$subject')";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
		echo "<script language=javascript>alert('Subject Category has been added') </script>";
		 echo "<script language=javascript>window.location='library_subjects.php' </script>";
	}
	}
	
?>
    <div class="clear">&nbsp;</div>
    <?php
    $result = mysql_query("SELECT * FROM subjects order by subject desc");
	
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Available Subjects List</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="10%">#</th>
                <th>Subject</th>
                <th width="10%"></th>
                <th width="10%"></th>
              </tr>
            </thead>
            <tbody>
              <?php
			  $num=0;
			while($row = mysql_fetch_array($result)){
			$num++;
			?>
              <tr class="record">
                <td><?php echo $num?></td>
                <td><?php echo str_replace("-"," ",$row["subject"]);?></td>
                <td align="center"><a href="#" id="<?php echo $row["subject"]; ?>" class="delbutton"><span class="icon icon-orange icon-trash"></span> </a></td>
                <td><a href="#" title="Click to Edit Class Details"><span class="icon icon-orange icon-edit"></span></a></td>
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
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("You are about to delete this Subject from the List.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_subject.php",
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
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
