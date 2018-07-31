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

$(document).ready(function() {
	$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
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
<?php
if (isset($_GET['forms'])) {
include("includes/dbconnector.php");
	
$form = $_GET['forms'];
$year=$_GET['years'];
$term=$_GET['term'];
$subjects=$_GET['subjects'];

$query = "SELECT * FROM studentdetails where form='$form'";
 $frms;
 
if($form=='FORM 1'){
	//$subjects='11';
	$frms='1';
	}
	if($form=='FORM 2'){
	//$subjects='9';
	$frms='2';
	}
	if($form=='FORM 3'){
	//$subjects='7';
	$frms='3';
	}
	if($form=='FORM 4'){
	//$subjects='7';
	$frms='4';
	}
$cq="SELECT * FROM subjectsforstudent where form='$form'";

// run the query and store the results in the $result variable.
$result = @mysql_query($query);
if ($result) {
$num=0;
 $index=0;
 
 $data = array();
 $subjects;
$setname="";

$check = @mysql_query($cq);
while ($row = mysql_fetch_array($check)) {
$setname=$row['Form'];
}

if($setname == ""){

while ($row = mysql_fetch_array($result)) {
$num++;
$index++;
$adm=$row['admno'];
$fname=$row['fname'];
$mname=$row['sname'];
$lname=$row['lname'];
$religion=$row['religion'];

$data[] = $row['admno'];


	if($form=='FORM 1'){
	//$subjects='11';
	$frms='1';
	}
	if($form=='FORM 2'){
	//$subjects='9';
	$frms='2';
	}
	if($form=='FORM 3'){
	//$subjects='7';
	$frms='3';
	}
	if($form=='FORM 4'){
	//$subjects='7';
	$frms='4';
	}
	$ful=$fname;
	$ful2=$mname;
	$ful3=$lname;
	$act="insert into subjectsforstudent (admno,subjects,form,fname,mname,lname,religion,year,term) values('$adm','$subjects','$frms','$ful','$ful2','$ful3','$religion','$year','$term') on duplicate key update subjects='$subjects' ,religion='$religion'";
	//on duplicate key update subjects='$subjects'
 	$resultin=mysql_query($act); 
	if(!$resultin){
	echo"failed". mysql_error();
	}//end of checking if it have been inserted
}//end of while
}//end of checking if exists

}

$frm;
if($form=='FORM 1'){
	$frm='1';
	}
	if($form=='FORM 2'){
	$frm='2';
	}
	if($form=='FORM 3'){
	$frm='3';
	}
	if($form=='FORM 4'){
	$frm='4';
	}

$query = "SELECT * FROM subjectsforstudent where form='$frm' and year='$year' and term='$term'";

// run the query and store the results in the $result variable.
$result = mysql_query($query);
if ($result) {
	?>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Subjects Done: Form <?php echo $frm?> - Year <?php echo $year?> - Term <?php echo $term?></td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th> No.</th>
			<th> Adm #</th>
			<th> Full Name</th>
			<th> Religion </th>
			<th> Subjects Done</th>
			<th> </th>
          </tr>
        </thead>
        <tbody>
     	<?php
	 $num=0;
	while ($row = mysql_fetch_array($result)) {
	$num++;
	
	$adminis=$row['admno'];
	$subje=$row['subjects'];
	
	$full=$row['fname'];
	$full2=$row['mname'];
	$full3=$row['lname'];
	$reli=$row['religion'];
	?>
	 
	  <tr>
	  <td><?php echo $num?></td>
		<td><?php echo $adminis?></td> 
		<td><?php echo $full." ".$full2." ".$full3?></td>
		 <td><?php echo $reli?></td>
      <td><?php echo $subje?></td>
		<td>
		<a href="#openModal<?php echo $row['admno']?>" title="Click to Edit Marks"><i class="icon icon-blue icon-edit"></i></a>
		
		
		<div id="openModal<?php echo $row['admno']?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="updateSubjectsDone.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing Subjects Done <?php echo $row['admno']?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%"><b>Subjects Done:</b></td>
              <td class="alterCell2"><input type="text" name="subjects" class="inputFields" autofocus required  tabindex="1" value="<?php echo $subje ?>"/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="id" value="<?php echo $row['admno'] ?>">
		  <input type="hidden" name="frms" value="<?php echo $frm; ?>">
		  <input type="hidden" name="frm" value="<?php echo $form; ?>">
		  <input type="hidden" name="trm" value="<?php echo $term; ?>">
		  <input type="hidden" name="yr" value="<?php echo $year; ?>">
		    <input type="hidden" name="subjectis" value="<?php echo $subjects; ?>">
        </form>
      </div>
    </div>
		
		
		
		</td>
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
}


}else{
?>

<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Subjects Done </td>
    <td class="dataListHeader"></td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th> No.</th>
			<th> Adm #</th>
			<th> Full Name</th>
			<th> Religion </th>
			<th> Subjects Done</th>
			<th> </th>
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
?>

</body>
</html>
