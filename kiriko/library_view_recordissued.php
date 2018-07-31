<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<!--<link href="css/bootstrap.css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">


	</script>
</head>
<body>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
if (isset($_GET['submit'])) {
	include("includes/dbconnector.php");
	$form = $_GET['frms'];
	$strm = $_GET['stream'];
	$subject = $_GET['subjects'];
	//$term=$_REQUEST['term'];
	$year=$_GET['year'];
	
	
	if($form=='1'){
	$myform='FORM 1';
	}
	if($form=='2'){
	$myform='FORM 2';
	}
	if($form=='3'){
	$myform= 'FORM 3';
	}
	if($form=='4'){
	$myform='FORM 4';
	}
	
	//check if there are books for the selected subject and form
	$queryc=("select *  from books_invemtory where category='$subject' and form='$form'");
	$resultc = mysql_query($queryc);
  	$rowscountc=mysql_num_rows($resultc);
	 if($rowscountc==1 ||$rowscountc>1){
	
	$query = "SELECT * FROM studentdetails where form='$myform' and class='$strm'";
	$result = mysql_query($query);
	if ($result) {
	?>
    <form name="demo" method="post" action="save_recordedbooks.php">
      <table class="borders table table-bordered table-striped">
	  
        <thead>
		<tr style="height:30px;">
          <td class="dataListHeader" colspan="6">Manually Issued Books Form <?php echo $form." ". $strm?></td>
        </tr>
          <tr>
            <th >#</th>
            <th >Adm No</th>
            <th >Full Name</th>
            <th align=left>Book Title</th>
            <th align=left>Book No</th>
            <th align=left>Date Due</th>
          </tr>
        </thead>
        <tbody>
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
            <td><?php echo $num?></td>
            <td><div style='display:none'>
                <input type="text" value="<?php echo $adm?>" name="adms" id="ad" readonly="readonly" size="5" >
              </div>
              <?php echo $adm?></td>
            <td><?php echo $fname." ".$mname."  ".$lname?></td>
            <td ><select name="subject" id="inputMarks" class='inputFields' tabindex='<?php echo $index?>'>
                <?php
		$queryb=("select *  from books_invemtory where category='$subject' ");

		$resultb=mysql_query($queryb) ;

		while($rowb=mysql_fetch_array($resultb)){

		echo "<OPTION VALUE=".$rowb['bookid'].">".$rowb['title']."</OPTION>"; }?>
              </select>
            </td>
            <td><input type="text" class='dinputFields'  name="bno" id="bno" /></td>
            <td><input id="datepicker" name="duedate" class='dinputFields' placeholder="yyyy-mm-dd" /></td>
          </tr>
          <?php	  
	}//end of while	
	?>
          <tr>
            <td colspan=25 align=center><input type=submit value='Save Record' name=save class='btn btn-primary' onClick='getValues()'/></td>
          </tr>
        </tbody>
      </table>
      <?php
	}
	?>
      <input type="hidden" name="ads" id="sa" value="" />
      <input type="hidden" name="subs" id="subjs" value="" />
      <input type="hidden" name="bksno" id="bksno" value="" />
      <input type="hidden" name="ddate" id="ddate" value="" />
      <input type="hidden" name="form"  value="<?php echo $myform ?>"/>
      <input type="hidden" name="term"  value="<?php echo $term?>" />
      <input type="hidden" name="yr"  value= "<?php echo $year ?>"/>
      <input type="hidden" name="stream"  value="<?php echo $strm?>" />
      <input type="hidden" name="subject"  value="<?php echo $subject?>" />
    </form>
    <?php

}else{

 ?>
    <table class="table">
      <tr>
        <td align="center"><h2><img src='images/exclamation.png' align='absmiddle'>&nbsp;&nbsp;There are No Books for <?php echo $subject?> <?php echo $myform?></h2></td>
      </tr>
    </table>
    <?php
}
}
 ?>
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
		var bookno = new Array();// get booknos as an array
		
        marks = document.getElementsByName('subject');
		admisions = document.getElementsByName('adms');
		bookno = document.getElementsByName('bno');
		dueDate = document.getElementsByName('duedate');
       
       //alert("total fields = " + marks.length+"  and adms= "+admisions.length);
		
        var toSave= new Array(admisions.length);// create a new array for storing saved combined array
	   var tomarks= new Array(admisions.length);
	    var tobook= new Array(admisions.length);
		 var toDate= new Array(admisions.length);
		   
		for(var a = 0; a < admisions.length; a++){
		
           var objs = document.getElementsByName('adms').item(a);
		   var obj = document.getElementsByName('subject').item(a);
		   var objbk = document.getElementsByName('bno').item(a);
		    var objdue = document.getElementsByName('duedate').item(a);
		   if(obj.value==null || obj.value==""){
		   obj.value=0;
		   }
			toSave[a]=objs.value;
			tomarks[a]=obj.value;
			tobook[a]=objbk.value;
			toDate[a]=objdue.value;
			
			document.demo.subs.value = toSave.toString();
			document.demo.ads.value = tomarks.toString();
			document.demo.bksno.value = tobook.toString();
			document.demo.ddate.value = toDate.toString();
			 //alert(toDate[a]);
        }
		
		
    }

</script>
</body>
</html>
