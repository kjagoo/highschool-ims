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
<script type="text/javascript" src="fieldclone.txt"></script>
<script type="text/javascript" src="entertotab.txt"></script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a  class="active"  href="finance_recordbal.php">Record Balances</a></li>
    <li><a href="finance_uploadbal.php">Upload Balances</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
$year=$_POST['year'];
$term=$_POST['term'];
$form = $_POST['frms'];
$strm = $_POST['stream'];

if($form=='FORM 1'){
$myform=1;
}
if($form=='FORM 2'){
$myform=2;
}
if($form=='FORM 3'){
$myform=3;
}
if($form=='FORM 4'){
$myform=4;
}

include('includes/dbconnector.php');

if($strm=="Entire"){
$query = "SELECT * FROM studentdetails where form='$form'";
}else{
$query = "SELECT * FROM studentdetails where form='$form' and class='$strm'";
}
// run the query and store the results in the $result variable.
$result = mysql_query($query);
if ($result) {
?>
    <form name="demo" method="post" action="saveBalances.php">
      <table class='borders table-striped table-bordered' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>Recording <u><?php echo $form?></u>&nbsp;&nbsp;Fees Balances <u>Term <?php echo $term?></u>&nbsp;&nbsp;<u>Year  &nbsp;<?php echo $year?></u>
            <div style="float:right; margin-right:20px;"><a href="finance_recordbal.php">close<i class="icon icon-red icon-close"></i></a></div></td>
        </tr>
        <tr>
          <td>#</td>
          <td >Adm No</td>
          <td >Full Name</td>
          <td align='left'>Balance</td>
        </tr>
        <?php
	$num=0;
	 $index=0;
	
	while ($row = mysql_fetch_array($result)) {
	$num++;
	$index++;
	$adm=$row['admno'];
	$fname=str_replace("&","'",$row['fname']);
	$mname=str_replace("&","'",$row['sname']);
	$lname=str_replace("&","'",$row['lname']);
	?>
        <tr>
          <td><?php echo $num?></td>
          <td><div style='display:none'>
              <input type="text" value="<?php echo $adm?>" name="adms" id="ad" readonly="readonly" size="5" >
            </div>
            <?php echo $adm?></td>
          <td><?php echo $fname." ".$mname." ".$lname?></td>
          <td ><input type="text"  name="subject" id="inputMarks" size="15" tabindex='<?php echo $index?>' onkeyup="return checkInput(this.value)" ></td>
        </tr>
        <?php 	  
}//end of while
	?>
        <tr>
          <td colspan='25' align='center'><input type='submit' value='Save Record' name='save' class='btn btn-primary' onClick='getValues()'/></td>
        </tr>
      </table>
      <input type='hidden' name='ads' id='sa' value= />
      <input type='hidden' name='subs' id='subjs' value= />
      <input type='hidden' name='form'  value= '<?php echo $form?>' />
      <input type='hidden' name='term'  value='<?php echo $term ?>'/>
      <input type='hidden' name='yr'  value='<?php echo $year?>' />
      <input type='hidden' name='stream'  value=' <?php echo $strm?>' />
    </form>
    <?php
}

?>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
<script type="text/javascript">
function setTIdx( elem )
{
  var str = "";
  
  str += elem.checked ? "tabindex "  : "";
  
  str += EnterToTab.focusAny ? "focusany" : "";
    
  EnterToTab.init(document.forms.demo, str );
}

EnterToTab.init( document.forms.demo );
document.forms.demo.firstElem.focus();


function getValues() {  
        
		var admisions = new Array();//get admision numbers as an array
		var marks = new Array();// get marks as an array
		
        marks = document.getElementsByName('subject');
		admisions = document.getElementsByName('adms');
       
       //alert("total fields = " + marks.length+"  and adms= "+admisions.length);
		
        var toSave= new Array(admisions.length);// create a new array for storing saved combined array
	   var tomarks= new Array(admisions.length);
		   
		for(var a = 0; a < admisions.length; a++){
		
           var objs = document.getElementsByName('adms').item(a);
		   var obj = document.getElementsByName('subject').item(a);
		   if(obj.value==null || obj.value==""){
		   obj.value=0;
		   }
			toSave[a]=objs.value;
			tomarks[a]=obj.value;
			document.demo.subs.value = toSave.toString();
			document.demo.ads.value = tomarks.toString();
			// alert(toSave[a]);
        }
		
		
    }

</script>
</body>
</html>
