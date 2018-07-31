<?php
require_once('auth.php');
include 'includes/DAO.php';
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';

$username=$_SESSION['SESS_MEMBER_ID_'];
$func = new Functions();
$activity = "Viewed books inventory";
$func->addAuditTrail($activity,$username);



$dao = new DAO();
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
function Warn(){
	alert('ERROR!\n\nYou cannot delete this book from the list because it has unreturned books');
	return false
}
	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="library_inventory.php">Books Inventory</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Books Inventory
          <div style="float:right; margin-right:20px;"><a href="pdf_books_inventory.php"  title="Click to Print">
            <button><i class="icon icon-orange icon-print"></i>Print</button>
            </a> </div></td>
      </tr>
      <tr>
        <td colspan="2"><table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th width="20%">Title</th>
                <th  width="15%">Publisher</th>
                <th width="15%">Subject</th>
                <th>Book Type</th>
                <th>YR Edn</th>
                <th>Copies </th>
                <th>Issued </th>
                <th> </th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
              <?php 
	$result = mysql_query("SELECT * FROM books_invemtory order by title desc");
 		$num=0;
		while($row = mysql_fetch_array($result)){
		$num++;
		$issuedBooks=$dao->getBooksIssued($row['bookid']);
		echo '<tr class="record"  title="'. $row['comments'].'">';
				echo '<td>'.$num.'</td>';
				//echo '<td>'.$row['sn'].'</td>';
        		echo '<td>'.$row['title'].'</td>';
				?>
            <td><script type="text/javascript">
var test = "<?php echo $row['publisher']; ?>";
document.write(test.parseURL());
</script></td>
              <?php
				echo '<td>'.$row['category'].'</td>';
				
				echo '<td>'.$row['btype'].'</td>';
				//echo '<td>'.$row['form'].'</td>';
				echo '<td>'.$row['yrofedition'].'</td>';
				echo '<td align=center>'.$row['noofpcs'].'</td>';
				echo '<td align=center>'.$issuedBooks.'</td>';
				
				if($issuedBooks==0){?>
              <td align="center"><a href="#" id="<?php echo $row["bookid"]; ?>" class="delbutton"><i class="icon icon-orange icon-trash"></i></a></td>
              <?php }
				else{
				?>
              <td><a href="#" onClick="return Warn()"> <i class="icon icon-orange icon-info"></i></a></td>
              <?php
				}
				?>
              <td><a href="" title="Click To Edit"><i class="icon icon-orange icon-edit"></i> </a> </td>
              <?php
				echo '</tr>';
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
 if(confirm("Warning!\n\nYou are about to delete this Book Details.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_book.php",
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
