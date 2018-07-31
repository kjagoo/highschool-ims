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
</head>
<body onLoad="year()">
<div id="page_tabs">
  <ul>
    <li><a class="active" href="library_recordissued_book.php">Record Issued Books</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <form method="get" action="library_view_recordissued.php" target="reportView">
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader" colspan="7">Record Already Manually Issued Books
            <div style="float:right; margin-right:20px;"><a href="pdf_books_inventory.php"  title="Click to Print"><i class="icon32 icon-orange icon-print"></i></a> </div></td>
        </tr>
        <tr>
          <td class="alterCell"><strong>Form</strong></td>
          <td class="alterCell3"><select name="frms" id="inputMarks" class="select" required>
              <option value="" >-- Select Form --</option>
              <option value="1" >FORM 1 </option>
              <option value="2" >FORM 2</option>
              <option value="3" >FORM 3</option>
              <option value="4" >FORM 4</option>
            </select>
            <select name="stream" id="select" class="select" >
              <option value="" >-- Class --</option>
              <?php
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
            </select></td>
          <td class="alterCell"><strong>Year</strong></td>
          <td valign="middle"><select name="year" id="inputMarks" class="select" required>
              <option value="" selected="selected">-- Select Year --</option>
              <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select>
          </td>
          <td class="alterCell"><strong>Subject</strong></td>
          <td valign="middle"><select name="subjects" id="inputMarks" class="select" required>
              <option value="" >-- Select Subject --</option>
              <?php
			$querysubs=("select distinct (subject) from subjects ");

			$resultsubs=mysql_query($querysubs) ;

			while($rowsubs=mysql_fetch_array($resultsubs)){

			echo "<OPTION VALUE='".$rowsubs['subject']."'>".str_replace("-"," ",$rowsubs['subject'])."</OPTION>"; 
			}
			?>
            </select>
          </td>
          <td><input class="btn btn-primary" type="submit" name="submit" value="Record"/></td>
        </tr>
      </table>
    </form>
	<div class="clear"></div>
	  <iframe name="reportView" src="library_view_recordissued.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
	 
  </div>
</div>
<!--end of display area. This area changes when a user searches for an item-->

</body>
</html>
