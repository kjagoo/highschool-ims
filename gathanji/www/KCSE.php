<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  

 include 'includes/functions.php';
$func = new Functions();
$activity = "KCSE ANALYSIS";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet' />
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
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

function commonFunction(id){
loadXMLDoc(id,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("new_Area").innerHTML=xmlhttp.responseText;
    }
  });
}


	</script>
<script type="text/javascript" src="fieldclone.txt"></script>
<script type="text/javascript" src="entertotab.txt"></script>
</head>
<body>
<div class="clear"></div>
<div id="new_Area">
  <div id="page_tabs">
    <ul>
      <li><a class="active" href="KCSE.php">Manage Index No</a></li>
      <li><a href="KCSE_Records.php">Record Entries</a></li>
      <li><a  href="KCSE_Manage.php">Manage Entries</a></li>
      <li><a  href="KCSE_Analysis.php">Generate Analysis</a></li>
    </ul>
  </div>
  <div class="clear"></div>
  <div id="display_Area">
    <div id="page_tabs_content">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="marksform" method="post">
        <table class="borders" width="100%">
          <tr>
            <td class="alterCell" width="20%">Select Year Student Finshed</td>
            <td class="alterCell3" ><select name="years" class="select" tabindex="1">
                <option value=" " >-- Select Year -- </option>
                <?php
				include('includes/dbconnector.php');
		 			  	$query=("select distinct (year_finished) from studentdetails where year_finished>0");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['year_finished'].">".$row['year_finished']."</OPTION>"; }
						?>
              </select></td>
			 <td class="alterCell2" ><input class="btn btn-primary" type="submit" value="Manage Indexes"/></td>
          </tr>
         
        </table>
      </form>
      <div class="spacer"></div>
      <?php  
	  if(isset($_POST['years']) ){
	  $year=$_POST['years'];
	  
	  $query = "SELECT * FROM studentdetails where year_finished ='$year'";
	  $result = mysql_query($query);
	  $rowscount=mysql_num_rows($result);
	 if($rowscount==1 ||$rowscount>1){?>
      <form name="demo" method="post" action="save_index_numbers.php">
        <table class='borders' cellpadding='5' cellspacing="0">
          <tr style='height:30px;'>
            <td class='dataListHeader' colspan='4'><u> Recording <font color='#FF0000'>KCSE INDEX NUMBERS &nbsp;&nbsp;</font>&nbsp;&nbsp;FOR THE CLASS OF &nbsp;<font color='#FF0000'><?php echo $year?></font></u> </td>
          </tr>
          <tr>
            <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>&nbsp;&nbsp;&nbsp;</th>
                    <th><span id=freetext>ADM NO.</span></th>
                    <th ><span id=freetext>Full Name</span></th>
                    <th align=left><span id=freetext>INDEX NUMBER</span></th>
                  </tr>
                </thead>
                <?php
		  $num=0;
		 $index=0;
		 while ($row = mysql_fetch_array($result)) {
		$num++;
		$index++;
		$adm=$row['admno'];
		$fname=$row['fname'];
		$mname=$row['sname'];
		$lname=$row['lname'];
		
		 ?>
                <tr>
                  <td><span id=freetext><?php echo $num?>|</span></td>
                  <td><span id=freetext>
                    <input type="text" value="<?php echo $adm?>" name="adms" id="ad" readonly="readonly" size="5" >
                    </span></td>
                  <td><span id=freetext><?php echo $fname." ".$mname." ".$lname?></span></td>
                  <td ><input type="text"  name="subject" id="inputMarks" size="15" tabindex='<?php echo $index?>' ></td>
                </tr>
                
                <?php
		}
		?>
                <tr>
                  <td colspan=25 align=center><input type="submit" value="Save Record" name="save" class='btn btn-success' onClick='getValues()'/></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <input type="hidden" name="ads" id="sa" value="" />
        <input type="hidden" name="subs" id="subjs" value="" />
        <input type="hidden" name="yr"  value="<?php echo $year?>" />
      </form>
      <?php 
	
	}else{
  ?>
      <div class="clear"></div>
      <table class="tablesorter_ordinary">
        <tr>
          <td align="center"><img src='images/exclamation.png' align='absmiddle'>&nbsp;&nbsp;There are No Students for the selected year</td>
        </tr>
      </table>
      <?php
  }
  
  }
  ?>
    </div>
  </div>
</div>
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
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
