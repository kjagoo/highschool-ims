<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];



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
    $('#example').dataTable();
} );


String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};
	</script>
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
<script type="text/javascript">

function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}
function download(){
	window.location='files.xls';
}

	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}
var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function changeDisplay(id){
loadXMLDoc(id,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("search_area").innerHTML=xmlhttp.responseText;
    }
  });
}
	</script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script></head>
<body>
<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="hr_stafflist.php"><i class="icon icon-green icon-contacts"></i>Staff List</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <div id="search_area">
      <div class="clear"></div>
      <?php
	   $statement = "SELECT * FROM staff  order by category asc";
    $result = mysql_query($statement);
	 $rowscounts=mysql_num_rows($result);
	  $recordcount=mysql_num_rows( mysql_query("select * from staff"));

if($rowscounts==1 ||$rowscounts>1){
?>
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
         <td class="dataListHeader">Staff Information: 
		 <div style=" width:150px; float:right; margin-right:20px;">
		 <table width="100%">
		 <tr>
		 <td><a href="hr_stafflist.php"  title="Refresh Page" class="noline"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
		 <td align="right"><a href="pdf_hrstaff_list.php"  title="Click to Print" class="noline"><i class="icon icon-green icon-print"></i>Print</a></td>
		 </tr>
		 </table>
	  </div></td>
        </tr>
		<tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th> No.</th>
                  <th> FULLNAMES</th>
                  <!--<th> Gender</th>-->
                  <th> ID/ PASSPORT </th>
                  <th> TELEPHONE #</th>
                  <th> TYPE </th>
                  <th> </th>
                  <th> </th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>
                <?php
		$num=0;
		while($row = mysql_fetch_array($result)){
		$nameis=strtoupper($row['fname']);
		$mname=strtoupper($row['mname']);
		$lname=strtoupper($row['lname']);
		$idpass=$row['idpass'];
		$tel=$row['telephone'];
		$cat=$row['category'];
		$num++;
	
	echo "<tr class='record'>";
	echo '<td>'.$num.'</td>';
	echo '<td>'.str_replace("&","'",$row['fname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['mname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['lname']).'</td>';
	//echo '<td>'.$row['gender'].'</td>';
	echo '<td>'.$row['idpass'].'</td>';
	echo '<td>'.$row['telephone'].'</td>';
	echo '<td>'.$row['category'].'</td>';
	
				?>
              <td><a href="#" id="<?php echo $row["idpass"]; ?>" class="delbutton"><span class="icon icon-orange icon-trash"></span></a></td>
                <input type="hidden" name="id" id="id" class="inputFields" value="<?php echo $row['idpass'];?>">
                <td><a href="hr_editStaff.php?id=<?php echo $idpass;?>"  title="Click To Edit"><span class="icon icon-orange icon-edit"></span> </a> </td>
                <td><a href="hr_staffprofile.php?id=<?php echo $row['idpass'];?>" title="Employee Profile"><span class="icon icon-orange icon-user"></span> </a> </td>
              </tr>
              <?php
			}
		?>
              </tbody>
              
            </table></td>
        </tr>
      </table>
      <?php
}else{?>
      <fieldset>
      <h2 align="center">There are no Staff Record</h2>
      </fieldset>
      <?php
}
?>
    </div>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->

</body>
<!--<script src="js/jquery.js"></script>-->
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("WARNING !\n\nYou are about to delete this Staff record.\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_staff.php",
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
</html>
