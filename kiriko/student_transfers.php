<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 

 $statement = "transfers order by deleted asc, form asc";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
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
<link href='css/opa-icons.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="syntax/shCore.css" />
<link rel="stylesheet" type="text/css" href="syntax/demo.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="syntax/shCore.js"></script>
<script type="text/javascript" language="javascript" src="syntax/demo.js"></script>
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

function restoreConfirm(){
 if(confirm("You are about to Restore this Student From Deleted.\n\n Do you Want to Continue?")){
 
 return true;
 }else{
 return false;
 }

}	

function deleteConfirm(){
 if(confirm("You are about to Delete this Student Completely.\n\n Do you Want to Continue?")) {
		  
	return true;
 }else{
 return false;
 }	  
		  
}
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}



	</script>
</head>
<body>
<div id="page_tabs"> 
  <ul> 
    <li><a  class="active" href="student_transfers.php">Transferred Students</a></li>
  </ul> 

</div> 
<div class="clear"></div>
<div id="display_Area">
<div id="page_tabs_content">

<table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">Deleted/ Transferred Student Information</td>
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
			<th> Date Deleted</th>
			<th> </th>
			<th> </th>
          </tr>
        </thead>
        <tbody>
          <?php
    $result = mysql_query("SELECT * FROM $statement");
		$num=0;
		while($row = mysql_fetch_array($result)){
		$num++;
	
	echo "<tr class='record'>";
	echo '<td>'.$num.'</td>';
	
	echo '<td>'.str_replace("&","'",$row['name']).'</td>';?>
	 <td><script type="text/javascript">
			var test = "<?php echo $row['gender'] ?>";
			document.write(test.parseURL());
			</script></td>
	<?php
	echo '<td>'.$row['admno'].'</td>';
	echo '<td>'.$row['form'].'</td>';
	echo '<td>'.$row['deleted'].'</td>'; ?>
	
	<td><a href="restore_student_trans.php?id=<?php echo $row['admno']?>&form=<?php echo $row['form']?>"  onclick="return restoreConfirm();" title="Click To Restore"><i class="icon icon-orange icon-undo"></i></a></td>
	
        <td>
          <a href="delete_student_complete.php?id=<?php echo $row['admno']?>" onclick="return deleteConfirm();" title="Click To Delete Student record Completely"><i class="icon icon-orange icon-trash"></i>
          </a>
        </td>
        <?php
				echo '</tr>';
			}
		?>
        </tbody>
      </table>
	  </td>
	  </tr>
</table>


</div> 
</div>
<!--end of display area. 
This area changes when a user searches for an item-->


</body>
</html>
