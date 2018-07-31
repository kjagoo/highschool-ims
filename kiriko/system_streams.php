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
    <li><a class="active" href="system_streams.php">Streams Setup</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
    <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="catsform" method="post">
      <table width="80%">
        <tr>
          <td >Class Name </td>
          <td><input type="text" name="class" class="inputFields" tabindex="1" required autofocus placeholder="E.g. Form 1" />
          </td>
          <td valign="middle" rowspan="2"><button type="submit"  class="btn btn-primary"><span class="icon icon-green icon-plus"></span>&nbsp;Add Record</button></td>
        </tr>
        <tr>
          <td >Stream</td>
          <td><input type="text" name="stream" class="inputFields" tabindex="1" required placeholder="E.g. West"/>
          </td>
        </tr>
      </table>
    </form>
    <?php
	if(isset($_POST['class']) && isset($_POST['stream'])){
	$class = $_POST['class'];  // Retrieve POST data
	$stream = $_POST['stream']; 
	include('includes/dbconnector.php');
	$query="insert into streams (form, stream) values('$class','$stream') on duplicate key update form=form";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Class Details has been added');</script>";
		echo "<script language=javascript>window.location='system_streams.php';</script>";
		 }
	}
	?>
    </fieldset>
    <div class="clear">&nbsp;</div>
    <?php
    $result = mysql_query("SELECT * FROM streams order by form asc");
	$rowscounts=mysql_num_rows($result);
	  $recordcount=mysql_num_rows( mysql_query("select * from streams"));
		 if($rowscounts==1 ||$rowscounts>1){
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Student Information</td>
      </tr>
      <tr>
        <td>
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Form</th>
                <th>Stream</th>
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
              <tr class='record'>
                <td width="5%"><?php echo $num;?></td>
                <td><script type="text/javascript">
			var test = "<?php echo $row['form'] ?>";
			document.write(test.parseURL());
			</script></td>
                <td><?php echo $row['stream'];?></td>
                <td align="center"><a href="#" id="<?php echo $row["form"]; ?>&stream=<?php echo $row['stream']?>" class="delbutton"><span class="icon icon-orange icon-trash"></span> </a></td>
                <td><a href="#" title="Click to Edit Class Details"><span class="icon icon-orange icon-edit"></span></a></td>
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
?>
    <table>
      <thead>
        <tr>
          <th valign="middle"><h3 align="center"><i class="icon icon-orange icon-alert"></i>There are no Streams Listed</h3></th>
        </tr>
      </thead>
    </table>
    <?php
}

?>
  </div>
</div>
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");
var str = element.attr("stream");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("You are about to delete this Class Details from the List.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_Stream.php",
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
