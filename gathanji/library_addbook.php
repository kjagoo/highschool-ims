<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed books inventory";
$func->addAuditTrail($activity,$username);
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

<script type="text/javascript">

String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};

	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="library_addbook.php">Add Book</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
    <form name="printed" action="save_books_record.php" method="post">
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">Add Books to Inventory</td>
        </tr>
        <tr>
          <td><table width="100%">
              <tr>
                <td><strong>Book Title</strong></td>
                <td><input type="text" name="title" class="inputFields" required autofocus tabindex="1" /></td>
                <td><strong>Book Author</strong></td>
                <td><input type="text" name="author" class="inputFields" required  tabindex="2"/></td>
              </tr>
              <tr>
                <td><strong>Publisher</strong></td>
                <td><input type="text" name="publisher" class="inputFields" required  tabindex="3"/></td>
                <td><strong>Year of Edition</strong></td>
                <td><input type="number" name="yr" class="inputFields" required  tabindex="4"/></td>
              </tr>
              <tr>
			  <td><strong>Subject Category</strong></td>
                <td><select name="category" class="select" tabindex="5">
				<option value="">-- Select Subject --</option>
                    <?php
						include('includes/dbconnector.php');
		 			  	$querysubs=("select distinct (subject) from subjects ");

						$resultsubs=mysql_query($querysubs) ;

						while($rowsubs=mysql_fetch_array($resultsubs)){

						echo "<OPTION VALUE=".$rowsubs['subject'].">".str_replace("-"," ",$rowsubs['subject'])."</OPTION>"; }?>
                  </select>
                </td>
                <td><strong>No of Copies</strong></td>
                <td><input type="number" name="pcs" class="inputFields" required  tabindex="6"/></td>
                
              </tr>
			  <tr>
                <td><strong>Book Type</strong></td>
                <td><select name="btype" class="select"required  tabindex="7">
				<option value="">-- Select Book Type --</option>
                    <option value="CD">Media -CD/DVD</option>
					<option value="Hard_Copy">Text Book</option>
					<option value="Magazine">Magazine</option>
					<option value="Map">Map/ Chart</option>
					<option value="Newspaper">Newspaper</option>
					
                  </select>
                </td>
			</tr>
              <tr>
                <td><strong>Form</strong></td>
                <td><select name="frm" class="select"required  tabindex="7">
				<option value="">-- Select Form --</option>
                    <option value="1">Form 1</option>
                    <option value="2">Form 2</option>
                    <option value="3">Form 3</option>
                    <option value="4">Form 4</option>
                  </select>
                </td>
                <td><strong>Status</strong></td>
                <td><select name="status" class="select" required  tabindex="8">
				<option value="">-- Select Book Status --</option>
                    <option value="Available">Available</option>
					 <option value="Archived">Archived</option>
                    <option value="Lost">Lost</option>
                    <option value="SFR">Subject for Replacement</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>Comments</strong></td>
                <td colspan="3"><textarea cols="50" rows="5" name="comment"   tabindex="9"></textarea></td>
              </tr>
              
              <tr>
			  <td></td>
                <td class="alterCell3" colspan="2"><input type="submit" name="submit" value="Save Record" class="btn btn-primary"/></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </form>
    </fieldset>
  </div>
</div>
</body>
</html>
