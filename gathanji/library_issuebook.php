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
    <li><a class="active" href="library_issuebook.php">Issue Book</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
	
	<form method="get" action="library_view_issuebook.php" target="reportView">
          <div id="holder">
            <div style="float:left;">Student ADM NO:</div>
            <div style="float:left;">
              <input type="text" class="input" name="keyword" id="keyword" tabindex="0" required>
            </div>
            <input type="submit" name="submit" value="Process Request" class="btn btn-primary" />
          </div>
          <div style="float:left;"><img src="images/loading.gif" id="loading" align="right"></div>
          <div id="ajax_response"></div>
        </form>
	</fieldset>
	  <iframe name="reportView" src="library_view_issuebook.php" style="width: 100%; height: 400px;" frameborder="0"></iframe>
	 
  </div>
</div>
<!--end of display area. This area changes when a user searches for an item-->

</body>
</html>
