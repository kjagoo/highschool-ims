<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Exam Status Page";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href="css/tablesorter_ordinary.css"  type="text/css" rel="stylesheet" >
<link href='css/opa-icons.css' rel='stylesheet'>
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

<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
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

 function searchFunction(str)
    {
    if (str=="")
    {
    document.getElementById("display_Area").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display_Area").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","search.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
	 window.frames["print_frame"].document.getElementById('example').border="1px #FF0000 solid";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}



	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="dean_exam_status.php">Marks Recording Status</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="page_tabs_content">
  <fieldset>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table width="100%" class="tablesorter_ordinary">
      <tr>
        <td valign="middle"><strong>Form:</strong></td>
        <td valign="middle"><select name="forms" class="select" required tabindex="1">
		 <option value="" >--Select -- </option>
            <option value="1" >FORM 1 </option>
            <option value="2" >FORM 2 </option>
            <option value="3" >FORM 3 </option>
            <option value="4" >FORM 4 </option>
          </select>
      
       
          <select name="stream" id="select" class="select" required tabindex="2">
		   <option value="Entire" >Entire</option>
            <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
          </select>
        </td>
        <td valign="middle"><strong>Term</strong></td>
        <td valign="middle"><select name="term" class="select" required tabindex="3">
            <option value="" >--Select -- </option>
            <option value="1" >Term 1 </option>
            <option value="2" >Term 2 </option>
			 <option value="3" >Term 3 </option>
          </select>
        </td>
		<td><strong>Year</strong></td>
                <td valign="middle"><select name="year" class="select" required tabindex="4">
				<option value="" selected="selected">-- Select --</option>
                    <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
                  </select>
        </td>
		
        <td align="right"><input class="btn btn-primary" type="submit" value="View Status" onclick="return validateForm();"/></td>
      </tr>
    </table>
  </form>
  </fieldset>
  <div class="clear"></div>
  <?php
	  include('includes/dbconnector.php');
	if (isset ($_POST['forms']) && isset ($_POST['stream']) && isset ($_POST['term'])  && isset ($_POST['year'])){
	
	
	$form=$_REQUEST["forms"];
	$stream=$_REQUEST["stream"];
	$term=$_REQUEST["term"];
	$year=$_REQUEST["year"];
	$etype="";
	
	//echo $form."  ".$stream."  ".$term;
	
if($stream=='Entire'){
$query = "SELECT * FROM examstatus where year='$year' and term='$term' and form='$form'  group by stream,subject order by subject ASC";
}else{
$query = "SELECT * FROM examstatus where year='$year' and term='$term' and form='$form' and stream='$stream' group by stream,subject order by subject ASC";
}
// run the query and store the results in the $result variable.
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
 if ($num_rows==1 ||$num_rows>1) { ?>

 <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>Recorded Marks Term <?php echo $term?>  Year <?php echo $year?> Form <?php echo $form." ".$stream?>
		  
		  </td>
        </tr>
        <tr>
          <td>
		  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
              <tr>
                <th>#</th>
                <th>SUBJECT</th>
				<th>Paper</th>
				<th>Class</th>
                <th align='right'></th>
              </tr>
			</thead>
             <tbody>
			 <?php
			 $num=0;
			 while ($row4 = mysql_fetch_array($result)) {// get exam marks 
			 $num++;
			 ?>
			<tr class="record">
                <td><?php echo $num?></td>
                <td><?php echo  $row4['subject']?></td>
				<td><?php echo  $row4['examtype']?></td>
				<td><?php echo $row4['form']." ".$row4['stream']?></td>
                <td align="right" width="15%"><a href="#" id="<?php echo $row4['year']?>&term=<?php echo $row4['term']?>&form=<?php echo $row4['form']?>&stream=<?php echo $row4['stream']?>&subject=<?php echo $row4['subject']?>&etype=<?php echo $row4['examtype']?>"  class="delbutton" title="Allow for RE-Entering Marks"><i class="icon icon-blue icon-arrowrefresh-s"></i>Re-Enter</a></td>
			</tr>
			<?php
			}
			?>
			 </tbody>
			 
			 </table>
		</td>
		</tr>
	</table>

	
<?php
 }else{ ?>
 
 <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>Recorded Marks For  <?php  if($etype==1 || $etype==2){echo "Cat ". $etype;}else {echo $etype;} ?>Term <?php echo $term?>  Year <?php echo $year?> Form <?php echo $form?>
		  
		  </td>
        </tr>
        <tr>
          <td>
		  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
              <tr>
                <th>#</th>
                <th>SUBJECT</th>
				<th>Class</th>
                <th align='right'></th>
              </tr>
			</thead>
             <tbody>
			 
			 </tbody>
			 
			 </table>
		</td>
		</tr>
	</table>

 
 <?php
 }
 
 
}//end of if post


	?>
</div>
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
 if(confirm("You are about to Allow RE-Entering of These Marks.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_examstatus.php",
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
