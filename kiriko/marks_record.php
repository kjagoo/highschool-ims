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
<link href="css/styles_vtab.css" type="text/css" rel="stylesheet">
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

	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}

</script>
<script language="javascript" type="text/javascript">
   
     function disableTextBox(obj){
	 
        var selected=document.marksform.types.options[obj.selectedIndex].value;
		   
		   if(selected=="Exam"){
		  document.marksform.cats.disabled=true; 
		   }
		   if(selected=="Cat"){
		  document.marksform.cats.disabled=false; 
		   }
      }
	  
	  function year() {        
        var newOpt;     
        var i;     
        var selectLength = 0;     
        for(i=2010;i<2050;i++,selectLength ++){     
            newOpt = new Option(i,i);           
            document.marksform.year.options[selectLength ]  = newOpt;       
}        
    } 
      
   </script>
<script type="text/javascript" src="js/jquery.min_vtab.js"></script>
<script type="text/javascript" src="js/script_vtab.js"></script>
<link rel="stylesheet" href="css/styles_vtab.css" />
</head>
<body onLoad="year()">
<div id="page_tabs">
  <ul>
    <li><a class="active" href="marks_record.php">Record Marks</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <div class="wrapper">
      <div id="v-nav">
        <ul>
          <li tab="tab1" class="first current">General Exams</li>
          <li tab="tab4" class="last">Mock Exams</li>
        </ul>
        <div class="tab-content">
          <form action="recordStudentMarks.php" name="marksform" method="post">
            <table class="borders" width="100%">
              <tr>
                <td class="alterCell" width="20%"><strong>Marks Type</strong></td>
                <td class="alterCell3">
				<select name="types" id="inputMarks" class="select" onchange="disableTextBox(this)" required>
                     <option value="" >-- Select Exam Type --</option>
					<option value="Cat" >CATs </option>
                    <option value="Exam" >Exam</option>
                  </select>
                </td>
				</tr>
				<tr>
                <td class="alterCell" width="20%"><strong>Select Exam</strong></td>
                <td class="alterCell3"><select name="cats" id="inputMarks" class="select">
                    <option value="1" >Tune-Up</option>
                    <option value="2" >Mid-Term</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="alterCell" width="20%"><strong>Form</strong></td>
                <td class="alterCell3"><select name="frms" id="inputMarks" class="select" required>
				<option value="" >-- Select Form --</option>
                    <?php
		 			if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryf=("select distinct (form) from initials order by form asc ");
				 }else{
		 			  	$queryf=("select distinct (form) from initials where fullname='$username' order by form asc ");
				 }

						$resultf=mysql_query($queryf) ;

						while($rowf=mysql_fetch_array($resultf)){

						echo "<OPTION VALUE=".str_replace(" ","_",$rowf['form']).">".$rowf['form']."</OPTION>"; 
						}
					?>
                  </select>
                <select name="stream" id="select" class="select" >
				<option value="" >-- Select Class --</option>
                    <?php
		 			  if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryst=("select distinct (stream) from initials order by form asc ");
				 }else{
		 			  	$queryst=("select distinct (stream) from initials where fullname='$username'  order by form asc ");
				 }

						$resultst=mysql_query($queryst) ;

						while($rowst=mysql_fetch_array($resultst)){

						echo "<OPTION VALUE=".$rowst['stream'].">".$rowst['stream']."</OPTION>"; 
						}
					?>
                  </select></td>
              </tr>
              <tr>
                <td class="alterCell" width="20%"><strong>Term</strong></td>
                <td class="alterCell3"><select name="term" id="inputMarks" class="select" required>
				<option value="" >-- Select Term --</option>
                    <option value="1" >TERM 1 </option>
                    <option value="2" >TERM 2 </option>
                    <option value="3" >TERM 3 </option>
                  </select>
                </td>
				</tr>
				<tr>
                <td class="alterCell" width="20%"><strong>Year</strong></td>
                <td valign="middle"><select name="year" id="inputMarks" class="select" required>
				<option value="" selected="selected">-- Select Year --</option>
                    <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="alterCell" width="20%"><strong>Subject</strong></td>
                <td valign="middle"><select name="subjects" id="inputMarks" class="select" required>
				<option value="" >-- Select Subject --</option>
                 <?php
				 if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $querys=("select distinct (subject) from initials");
				 }else{
		 			  	$querys=("select distinct (subject) from initials where fullname='$username' ");
				 }
						$results=mysql_query($querys) ;

						while($rows=mysql_fetch_array($results)){

						echo "<OPTION VALUE=".$rows['subject'].">".$rows['subject']."</OPTION>"; 
						}
					?>
                  </select>
                </td>
              </tr>
              <tr>
			  <td class="alterCell" width="20%"></td>
                <td class="alterCell2" align="center"><input class="btn btn-primary" type="submit" value="Record Marks"/></td>
              </tr>
            </table>
          </form>
        </div>
        <div class="tab-content">
          <form action="recordMockExams.php" name="marksform" method="post">
            <table class="borders" width="100%">
              <tr>
                <td class="alterCell" width="20%">Form</td>
                <td valign="middle"><select name="frms" class="select" required>
				<option value="" >-- Select Form --</option>
                  <?php
		 			if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryf=("select distinct (form) from initials");
				 }else{
		 			  	$queryf=("select distinct (form) from initials where fullname='$username' ");
				 }

						$resultf=mysql_query($queryf) ;

						while($rowf=mysql_fetch_array($resultf)){

						echo "<OPTION VALUE=".str_replace(" ","_",$rowf['form']).">".$rowf['form']."</OPTION>"; 
						}
					?>
                  </select>
                <select name="stream" id="select" class="select" required>
				<option value="">-- Select Class --</option>
                    <?php
		 			  if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryst=("select distinct (stream) from initials");
				 }else{
		 			  	$queryst=("select distinct (stream) from initials where fullname='$username' ");
				 }

						$resultst=mysql_query($queryst) ;

						while($rowst=mysql_fetch_array($resultst)){

						echo "<OPTION VALUE=".$rowst['stream'].">".$rowst['stream']."</OPTION>"; 
						}
					?>
                  </select></td>
              </tr>
              <tr>
                <td class="alterCell" width="20%"><strong>Term:</strong></td>
                <td valign="middle"><select name="term" class="select" required>
				<option value="" >-- Select Term --</option>
                    <option value="1" >TERM 1 </option>
                    <option value="2" >TERM 2 </option>
                    <option value="3" >TERM 3 </option>
                  </select>
                </td>
				</tr>
				<tr>
                <td class="alterCell" width="20%">Year</td>
                <td valign="middle"><select name="year" class="select">
				<option value="" selected="selected">-- Select Year --</option>
                    <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="alterCell" width="20%">Subject</td>
                <td valign="middle"><select name="subjects" class="select" required>
				<option value="" >-- Select Subject --</option>
                  <?php
				 if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $querys=("select distinct (subject) from initials");
				 }else{
		 			  	$querys=("select distinct (subject) from initials where fullname='$username' ");
				 }
						$results=mysql_query($querys) ;

						while($rows=mysql_fetch_array($results)){

						echo "<OPTION VALUE=".$rows['subject'].">".$rows['subject']."</OPTION>"; 
						}
					?>
                  </select>
                </td>
			</tr>
			<tr>
                <td class="alterCell" width="20%">Paper</td>
                <td valign="middle"><select name="papers" class="select" required>
				<option value="" >-- Select Paper --</option>
                    <option value="1" >Paper 1 </option>
                    <option value="2" >Paper 2 </option>
                    <option value="3" >Paper 3 </option>
                  </select>
                </td>
              </tr>
              <tr>
			  <td class="alterCell" width="20%"></td>
                <td class="alterCell2" align="center"><input class="btn btn-primary" type="submit" value="Record Marks"/></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
    <!--end of div wrapper-->
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
